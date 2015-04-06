<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Installation extends CI_Controller {

    public function __construct() {

        parent::__construct();
        
        /*
         * Load helpers
         */
        $this->load->helper(array('file', 'url'));
        
        /*
         * Load model
         */ 
        $this->load->model('installer_model', 'inst');
        
        /*
         * Load language file
         */ 
        $this->lang->load('installer');
    }
    
    /**
     * Index page for installer
     */
    public function index() {    
        $this->load->view('installation');
    }

    /**
     * Steps page
     */
    public function steps() {    
        
        $error = '';        
        
        if($status = $this->input->get('status')) {
            switch($status) {
                case 1:
                    $error = $this->lang->line('invalid_req_method');
                    break;
                
                case 2:
                    $error = sprintf($this->lang->line('file_read_error'), 'initial config ');
                    break;
                
                case 3:
                    $error = sprintf($this->lang->line('file_write_error'), 'main config ');
                    break;
                                
                case 5:
                    $error = $this->lang->line('password_mismatch');
                    break;
                
                case 6:
                    $error = $this->lang->line('account_not_created');                
                    break;
                
                case 4:
                case 7:
                    $error = $this->lang->line('database_not_created');
                    break;
                
                case 8:
                case 9:
                    $error = $this->lang->line('empty_form_field');  
                    break;
                
            
            }
        }
        
        // Get error message if there are any.       
        $data['error'] = $error;
        
        $this->load->view('install_steps', $data);
    }
    
    /**
     * Verify submitted data
     */
    public function verify_steps() {    

        if($this->input->server('REQUEST_METHOD') == 'POST'){
//            var_dump($this->input->post());
//            exit;
            // Set up application file
            $db_config = $this->input->post('db');
            $acct_params = $this->input->post('acct');
            $sch_params = $this->input->post('sch');
            $sch_params['domainstring'] = strtolower(url_title($sch_params['shortname'])); 
            $this->setup($db_config, $sch_params, $acct_params);
                
            $host = $this->input->server('HTTP_HOST');
            redirect("http://{$host}/install/complete/");
        }else {
            redirect(site_url('steps?status=1'));
        }
    }
    
    private function setup(array $db_params, array $sch_params, array $acct_params) {

        // Expected field names
        $expected = array('server', 'username', 'password', 'database', 'driver');
        
        // Default database config values 
        $defaults = array(
                            'server' => $db_params['server'] != ''? $db_params['server']: 'localhost',
                            'driver' => $db_params['driver'] != ''? $db_params['driver']: 'mysqli'
                        );
        
        // Validate fields
        $this->validate($expected, $db_params, $defaults);
        
        // Initiate config write
        // Get path to placeholder config file
        $file_path = realpath(APPPATH.'files/database');

        // Read content of the file
        $file_contents = read_file($file_path);

        // Set error and redirect if file wasn't read 
        if(!$file_contents) {
            redirect(site_url('steps?status=2'));
        }
        
        // Fill placeholders with database parameters
        $new_content =  sprintf($file_contents,
                            $db_params['server'],
                            $db_params['username'],
                            $db_params['password'],
                            $db_params['database'],
                            $db_params['driver']
                        );

        // Open real database config file for writing
        $config_file = realpath(APPPATH.'config/database.php');
        $inst_config_file = realpath(INSTAPPPATH.'config/database.php');
        
        // Write contents to file, set error and redirect if there was an error
        if(!(write_file($inst_config_file, $new_content, 'w') && write_file($config_file, $new_content, 'w'))) {            
            redirect(site_url('steps?status=3'));
        }
        
        // Load database library to test config file
        $this->load->database();
        
        // Run database setup script
        $setup_sql = $this->load->file(APPPATH.'files/setup_script.sql', TRUE);
        $ret = $this->inst->run_db_script($setup_sql);
        
        switch($ret) {
            
            case DEFAULT_ERROR:
                redirect(site_url('steps?status=4'));
                break;
        }        

        $this->setup_accounts($sch_params, $acct_params);  
        
        // Run database script
        $sql = $this->load->file(APPPATH.'files/install_script.sql', TRUE);
        
        $ret = $this->inst->run_db_script($sql);
        
        switch($ret) {
            
            case DEFAULT_ERROR:
                redirect(site_url('steps?status=4'));
                break;
        }
        
        return;            
    }
    
    private function setup_accounts(array $sch_params, array $adm_params) {

        // Define expected school field names and validate
        $sch_expected = array('name', 'phone', 'email', 'shortname', 'unitname');       
        $this->validate($sch_expected, $sch_params);
        
        // Define expected account field names and validate check password
        $adm_expected = array('fname', 'lname', 'email', 'password', 'cpassword'); 
        $this->validate($adm_expected, $adm_params);
        
        
        // Ensure passwords match
        if($adm_params['password'] !== $adm_params['cpassword']) {
            redirect(site_url('steps?status=5'));
        }
        
        // Call this method to load the driver class, required for the Auth driver. 
        $this->load->driver();
        
        // Load Authentication provider to encrypt password
        require_once INSTAPPPATH."libraries/Auth/drivers/Auth_site.php";
        
        $authenticator = new Auth_site();
        $adm_params['password'] = $authenticator->encrypt($adm_params['password']);
        
        // Create account entry in database
        $ret = $this->inst->setup_accounts($sch_params, $adm_params);
       
        switch($ret) {
            
            case DEFAULT_ERROR:
                redirect(site_url('steps?status=6'));
                break;
            
            case DEFAULT_NOT_EXIST:
                redirect(site_url('steps?status=7'));
                break;
        }
        
        return;            
    }
    
    private function validate($expected, &$received, $defaults = array()) {
        
        // Check which of the expected fields are present in the received fields array.
        $present = array_intersect($expected, array_keys($received));
        
        // Compare size of present fields to expected fields.
        if(count($present) !== count($expected)) {           
            redirect(site_url('steps?status=8'));
        }  
        
        // Use default where no value is supplied
        foreach($defaults as $d => $v) {
            if($received[$d] == '')
                $received[$d] = $v;
        }
        
        // Check if any values is blank
        $key = array_search('', $received);
        if($key) {
            //if(in_array($key, $allowed)) 
            redirect(site_url('steps?status=9'));
        }
    }
    
    public function complete_installation($domain_string) {        
        
        // Load file helper
        $this->load->helper('file');
        
        // Delete files in installation folder
        delete_files(realpath('../installation'), TRUE, 1);
        
        $data['domain_string'] = $domain_string;
        $this->load->view('install_complete', $data);    
    }
}

/* End of file installation.php */
/* Location: ./application/controllers/installation.php */
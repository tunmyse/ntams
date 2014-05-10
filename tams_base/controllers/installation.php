<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Installation extends CI_Controller {

    public function __construct() {

        parent::__construct();
        
        /*
         * Load helpers
         */
        $this->load->helper(array('file'));
        
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
        $this->load->view('app/installation');
    }

    /**
     * Steps page
     */
    public function steps() {    
        
        // Get error message if there are any. 
        $error = $this->main->get_notification_messages(MSG_TYPE_ERROR, 1);
        
        $data['error'] = $error;
        
        $this->load->view('app/install_steps', $data);
    }
    
    /**
     * Verify submitted data
     */
    public function verify_steps() {    

//        var_dump($this->session->all_userdata());
//        echo $this->input->server('REQUEST_METHOD');
//        exit;
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            
//            var_dump($this->input->post());
//            exit;

            // Set up database config file
            $db_config = $this->input->post('db');
            $this->set_database_config($db_config);
            
            // Set up admin and school account
            $acct_params = $this->input->post('acct');
            $sch_params = $this->input->post('sch');
            $this->setup_accounts($sch_params, $acct_params);  
            
            redirect('installation/complete');
        }else {
            $error_msg = $this->lang->line('invalid_req_method');
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            redirect(site_url('installation/steps'));
        }
    }
    
    private function set_database_config(array $db_params) {

        // Expected field names
        $expected = array('server', 'username', 'password', 'database', 'driver');
        
        // Default database config values 
        $defaults = array(
                            'server' => 'localhost',
                            'driver' => 'mysqli'
                        );
        
        // Validate fields
        $this->validate($expected, $db_params, $defaults);
        
        // Initiate config write
        // Get path to placeholder config file
        $file_path = realpath(APPPATH.'installation/database');

        // Read content of the file
        $file_contents = read_file($file_path);

        // Set error and redirect if file wasn't read 
        if(!$file_contents) {
            $error_msg = sprintf($this->lang->line('file_read_error'), 'initial config ');
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            redirect(site_url('installation/steps'));
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
        
        // Write contents to file, set error and redirect if there was an error
        if(!write_file($config_file, $new_content, 'w')) {
            $error_msg = sprintf($this->lang->line('file_write_error'), 'main config ');
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            redirect(site_url('installation/steps'));
        }
        
        // Load database library to test config file
        $this->load->database();
        
        // Run database script
        $sql = $this->load->file(APPPATH.'installation/install_script.sql', TRUE);
        $ret = $this->inst->run_db_script($sql);
        
        switch($ret) {
            
            case DEFAULT_ERROR:
                $error_msg = $this->lang->line('database_not_created');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                redirect(site_url('installation/steps'));
                break;
        }
        
        $this->copy_files();
        
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
            $error_msg = $this->lang->line('password_unmatch');
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            redirect(site_url('installation/steps'));
        }
        
        // Load Authentication provider to encrypt password
        $this->load->driver("Auth/Auth", array(), 'auth_prov');  
        $adm_params['password'] = $this->auth_prov->encrypt($adm_params['password']);
        
        // Create account entry in database
        $ret = $this->inst->setup_accounts($sch_params, $adm_params);
       
        switch($ret) {
            
            case DEFAULT_ERROR:
                $error_msg = $this->lang->line('account_not_created');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                redirect(site_url('installation/steps'));
                break;
            
            case DEFAULT_NOT_EXIST:
                $error_msg = $this->lang->line('database_not_created');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                redirect(site_url('installation/steps'));
                break;
        }
        
        return;            
    }
    
    private function copy_files() {        
        
        // Copy files from installation folder to main application
        
        // Files to copy
        $files = array(
                    'autoload' =>   array(
                                        'from' => APPPATH.'installation/autoload',
                                        'to'   => APPPATH.'config/autoload.php'
                                    )
                );
        
        foreach($files as $name => $f) {
            
            // Get path to file
            $file_path = realpath($f['from']);

            // Read content of the file
            $file_contents = read_file($file_path);

            // Set error and redirect if file wasn't read 
            if(!$file_contents) {
                $error_msg = sprintf($this->lang->line('file_read_error'), $name);
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                redirect(site_url('installation/steps'));
            }
            
            // Open destination file for writing
            $dest_file = realpath($f['to']);

            // Write contents to file, set error and redirect if there was an error
            if(!write_file($dest_file, $file_contents, 'w')) {
                $error_msg = sprintf($this->lang->line('file_write_error'), $name);
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                redirect(site_url('installation/steps'));
            }
        }
        
    }
    
    private function validate($expected, &$received, $defaults = array()) {
        
        // Check which of the expected fields are present in the received fields array.
        $present = array_intersect($expected, array_keys($received));
        
        // Compare size of present fields to expected fields.
        if(count($present) !== count($expected)) {
            // Set error message for incomplete form fields
            $error_msg = $this->lang->line('empty_form_field');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            redirect(site_url('installation/steps'));
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
            // Set error message for incomplete form fields
            $error_msg = $this->lang->line('empty_form_field');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            redirect(site_url('installation/steps'));
        }
    }
}

/* End of file installation.php */
/* Location: ./application/controllers/installation.php */
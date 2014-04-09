<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Main application controller
 * 
 * @category   Controller
 * @package    Application
 * @subpackage 
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Application extends CI_Controller {

    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    
    private $folder_name = 'app';
    
    /*
     * Class constructor
     * 
     * @access public 
     * @retun void
     */
    public function __construct() {

        parent::__construct();

        /*
         * Load libraries
         */
        //$this->load->library(array('page/page', ''));

        /*
         * Load helpers
         */
        $this->load->helper(array('auth'));
        
        // Initialize class variables
        $this->user_id = $this->main->get('user_id');
        $this->user_type = $this->main->get('user_type');
        
    }// End func __construct
    
    /**
     * Index page for the application.	 
     */
    public function index() {        
        /**
         * Calls login method to display login page.
         * In a multi-school environment, this should link to either the login page or TAMS homepage.
         * This is based on the subdomain name (tasued).tams.com.ng
         * 
         * if($this->main->check_domain()) {
         *     $this->login(); 
         * }else {
         *     $this->load->view('tams/tams');
         * }
         */ 
        $this->login();        
    }// End of func index
    
    /**
     * Login page for the application.	 
     */
    public function login() {
        $page_name = 'login'; 
        
        // Get login error message, if any.
        $data['login_error'] = $this->main->get_notification_messages(MSG_TYPE_ERROR, 1);
        
        // Load the login view
        $this->load->view($this->folder_name.'/'.$page_name, $data);
    }// End of func login
    
    /**
     * Reset password.	 
     */
    public function reset_password($uid='') {
        $page_name = 'reset_password';
        $this->load->view($this->folder_name.'/'.$page_name);
    }// End of func reset_pasword
    
    /**
     * Forgot password.	 
     */
    public function forgot_password($query=NULL) {
        
        $page_name = 'forgot_password';
//        
//        var_dump($this->input->server());
//        exit;
        // Check request to either show the view or send a reset email.
        if($this->input->server('REQUEST_METHOD') != 'POST' || isset($query)){
            echo $query;
            // Set notification message and type to the query string
            $data['msg'] = $data['msg_type'] = $query;
            
            // Check if query string is set, to get appropriate notifiction message - the first message only.
            if(isset($query))
                echo $data['msg'] = $this->main->get_notification_messages($query, 1);
            
            // Load view forgot password view
            $this->load->view($this->folder_name.'/'.$page_name, $data);
            
        }else {
            
            // Retrieve user's username
            $uname = $this->input->post('uname', TRUE);
            
            // Validate user's username
            if(!check_field($uname, USERNAME_FIELD_TYPE)) {
                $error_msg = $this->lang->line('invalid_username');  
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                $this->forgot_password(MSG_TYPE_ERROR);
            }

            // Send reset password email
            $status = $this->main->send_reset_email($uname);
        
            // Redirect to forgot_password view to display appropriate message to user
            $this->forgot_password($status);
        }
        
    }// End of func forgot_pasword
    
    /**
     * Authenticate users of the application
     * 
     * @access public
     * @param string $method optional
     * @return void
     */
    public function authenticate($method='site') {
        
        // Check if request method is a POST
        if($this->input->server('REQUEST_METHOD') != 'POST'){
            $error_msg = $this->lang->line('invalid_req_method');
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            redirect(site_url('login'));
        }
        
        // Retrieve user's login credential
        $uname = $this->input->post('uname', TRUE);
        $upw = $this->input->post('upw', TRUE);
        
        // Validate user's credentials
        if(!check_field($uname, USERNAME_FIELD_TYPE) || !check_field($upw, PASSWORD_FIELD_TYPE)) {
            $error_msg = $this->lang->line('invalid_credentials');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, sprintf($error_msg, PASSWORD_LENGTH_MIN));
            redirect(site_url('login'));
        }
        
        $credentials = array(
            'username' => $uname,
            'password' => $upw
        );
        
        // Authenticate user using specified authentication type and credentials
        $authenticated = $this->main->authenticate($method, $credentials);
        
        // Redirect back to login screen if login fails
        if(!$authenticated) {
            redirect(site_url('login'));
        }        
        
        // Retrieve user_type from session
        $this->user_type = $this->main->get('user_type');
        
        // Redirect to user's dashboard based on user type (student | staff | admin)
        redirect("{$this->user_type}/dashboard");
        
    }// End of func authenticate    
    
}

/* End of file application.php */
/* Location: ./application/controllers/application.php */
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
        $this->load->helper(array('validation'));
        
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
         * 
         */ 
        $this->login();        
    }// End of func index
    
    /**
     * Login page for the application.	 
     */
    public function login() {
        $page_name = 'login'; 
        
        // Logged in, NO neeed to log in anymore, redirect.
        if($this->main->logged_in()) {
            //redirect("$this->user_type/dashboard?".urlencode(implode(',', $this->input->get)));
        }
        // Set school name
        $school_names = $this->main->get_school_name();
        $data['short_name'] = $school_names['short'];
        
        // Set redirection url if any.
        $redirect_uri = $this->input->get('rdr');
        $data['redirect'] = $redirect_uri == ''? '': '?rdr='.urlencode($redirect_uri);
        
        // Get login error message, if any.
        $data['login_error'] = $this->main->get_notification_messages(MSG_TYPE_ERROR, 1);
        
        // Load the login view
        $this->load->view($this->folder_name.'/'.$page_name, $data);
    }// End of func login
    
    /**
     * Logout function for the application.	 
     */
    public function logout() {
        
        // Call logout in Main Library
        $this->main->logout();
        
        // Redirect to the login view
        redirect(site_url('login'));
        
    }// End of func logout
    
    /**
     * Reset password.
     * 
     * @access public
     * @param string $uid
     * @return void	 
     */
    public function reset_password($uid = NULL) {
        $page_name = 'change_password';
        
         // Set page parameters. 
        $data['msg_type'] = $data['msg'] = '';
        $data['collapse']   = false;   
        
        // Check request to either show the view or initiate a password change.
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            $error = false;
            
            // Retrieve user's password
            $upw = $this->input->post('upw', TRUE);
            $cpw = $this->input->post('cpw', TRUE);
            
            // Validate user's password
            if(!check_field($upw, FIELD_TYPE_PASSWORD)) {
                // Set error to true
                $error              = true;
                
                // Set error message and type
                $data['msg']        = $this->lang->line('invalid_password');  
                $data['msg_type']   = MSG_TYPE_ERROR;
            }
            
            // Ensure passwords match
            if($upw !== $cpw) {
                // Set error to true
                $error              = true;
                
                // Set error message and type
                $data['msg']        = $this->lang->line('password_mismatch');    
                $data['msg_type']   = MSG_TYPE_ERROR;                               
            }
            
            if(!$error) {
                // Initiate password reset
                $status = $this->main->change_password($upw);

                switch ($status) {
                    case DEFAULT_SUCCESS:
                        $data['collapse']   = true;
                        $data['msg_type']   = MSG_TYPE_SUCCESS;
                        $data['msg']        = sprintf($this->lang->line('password_change_success'), site_url('login'));
                        break;

                    case DEFAULT_ERROR:
                        $data['collapse']   = false;
                        $data['msg_type']   = MSG_TYPE_ERROR;
                        $data['msg']        = sprintf($this->lang->line('password_change_error'), 'resetting', 'Try your reset link again');
                        break;
                }
            }
            
        }else {            
            
            // Check if query string - reset_id is set.
            if(!isset($uid)) {
                $data['collapse']   = true;
                $data['msg_type']   = MSG_TYPE_ERROR;
                $data['msg']        = sprintf($this->lang->line('invalid_reset_link'), site_url('forgot_password'));
            }else {
                
                // Check if $uid is a success or error message
                switch($uid) {
                    
                    case MSG_TYPE_ERROR:
                        $data['msg_type']   = MSG_TYPE_ERROR;
                        $data['msg']        = sprintf($this->lang->line('password_change_error'), 'resetting', 'Try your reset link again');
                        break;
                
                    case MSG_TYPE_SUCCESS: 
                        $data['msg_type']   = MSG_TYPE_SUCCESS;
                        $data['msg']        = sprintf($this->lang->line('password_change_success'), site_url('login'));
                        $this->main->set('userid', '', true);
                        break;
                    
                    default:
                        // Check if query string is valid
                        $status = $this->main->check_reset_link($uid);
                        
                        // Check if link exists
                        switch($status) {
                            case DEFAULT_NOT_EXIST:
                                $data['collapse']   = true;
                                $data['msg_type']   = MSG_TYPE_ERROR;
                                $data['msg']        = sprintf($this->lang->line('invalid_reset_link'), site_url('forgot_password'));
                                break;

                            case DEFAULT_EXPIRED: 
                                $data['collapse']   = true;
                                $data['msg_type']   = MSG_TYPE_ERROR;
                                $data['msg']        = sprintf($this->lang->line('reset_link_expired'), site_url('forgot_password'));
                                break;
                            
                            default:
                        }
                }  
            }
        }
        
        // Load reset password view
        $this->load->view($this->folder_name.'/'.$page_name, $data);
        
    }// End of func reset_pasword
    
    /**
     * Forgot password.	 
     */
    public function forgot_password($query=NULL) {
        
        $page_name = 'forgot_password';
        
        // Check request to either show the view or send a reset email.
        if($this->input->server('REQUEST_METHOD') != 'POST' || isset($query)) {
            
            // Set notification message and type to the query string
            $data['msg'] = $data['msg_type'] = $query;
            
            // Check if query string is set, to get appropriate notification message - the first message only.
            if(isset($query))
                $data['msg'] = $this->main->get_notification_messages($query, 1);
            
            // Load view forgot password view
            $this->load->view($this->folder_name.'/'.$page_name, $data);
            
        }else {
            
            // Retrieve user's username
            $uname = $this->input->post('uname', TRUE);
            
            // Validate user's username
            switch(check_field($uname, FIELD_TYPE_USERNAME)) {
                case DEFAULT_EMPTY:
                    $error_msg = $this->lang->line('empty_form_field');  
                    $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                    redirect(site_url('forgot_password/'.MSG_TYPE_ERROR));
                    
                case DEFAULT_NOT_VALID:
                    $error_msg = $this->lang->line('invalid_username');  
                    $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                    redirect(site_url('forgot_password/'.MSG_TYPE_ERROR));
            }

            // Send reset password email
            $status = $this->main->send_reset_email($uname);
        
            // Redirect to forgot_password view to display appropriate message to user
            switch($status) {            
                case MSG_TYPE_ERROR:
                    redirect(site_url('forgot_password/'.MSG_TYPE_ERROR));
                    break;

                case MSG_TYPE_WARNING:
                    redirect(site_url('forgot_password/'.MSG_TYPE_WARNING));
                    break;  
                
                case MSG_TYPE_SUCCESS:
                    redirect(site_url('forgot_password/'.MSG_TYPE_SUCCESS));
                    break;
                
            }            
            
        }
        
    }// End of func forgot_pasword
    
    /**
     * Authenticate users of the application
     * 
     * @access public
     * @param string $method optional
     * @return void
     */
    public function authenticate($method = 'Auth_site') {
        // Get redirect uri, if any.
        $redirect_uri = $this->input->get('rdr');
        $dest_uri = $redirect_uri == ''? "login": 'login?rdr='.urlencode($redirect_uri);
        
        // Check if request method is a POST
        if($this->input->server('REQUEST_METHOD') != 'POST'){
            $error_msg = $this->lang->line('invalid_req_method');
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            redirect(site_url($dest_uri));
        }
        
        // Retrieve user's login credential
        $uname = $this->input->post('uname', TRUE);
        $upw = $this->input->post('upw', TRUE);
        
        $err = array(DEFAULT_EMPTY, DEFAULT_NOT_VALID);
        
        // Validate user's credentials
        if(in_array(check_field($uname, FIELD_TYPE_USERNAME), $err) 
                || in_array(check_field($upw, FIELD_TYPE_PASSWORD), $err)) {
            $password_length = $this->config->item('password_min_length');
            $username_length = $this->config->item('username_min_length');
            $error_msg = $this->lang->line('invalid_credentials');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, sprintf($error_msg, $password_length, $username_length));
            redirect(site_url($dest_uri));
        }
        
        $credentials = array(
            'username' => $uname,
            'password' => $upw
        );
        
        // Authenticate user using specified authentication type and credentials
        $authenticated = $this->main->authenticate($method, $credentials);
        
        // Redirect back to login screen if login fails
        if(!$authenticated) {
            redirect(site_url($dest_uri));
        }        
        
        // Retrieve user_type from session
        $this->user_type = $this->main->get('user_type');
        
        // Redirect to user's dashboard based on user type (student | staff | admin) or redirect_url       
        $dest_uri = $redirect_uri == ''? "{$this->user_type}/dashboard": $redirect_uri;
        
        redirect(site_url($dest_uri));
        
    }// End of func authenticate    
    
    /**
     * Complete TAMS installation.
     * Delete all installaton files
     * 
     * @access public
     * @param string $domain_string optional
     * @return void
     */
    public function complete_installation($domain_string = NULL) {
        
        // Load file helper
        $this->load->helper('file');
        
        // Delete files in installation folder
        delete_files(realpath(APPPATH.'../installation'), TRUE, 1);
        $this->load->view('app/install_complete');       
    }
}

/* End of file application.php */
/* Location: ./application/controllers/application.php */
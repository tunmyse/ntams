<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Main Application library
 * 
 * @category   Library
 * @package    Application
 * @subpackage 
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Main {
	
    /**
     * User email
     * 
     * @access private
     * @var string
     */
    
    private $user_email;

    /**
     * User type (student | staff | admin)
     * 
     * @access private
     * @var string
     */
    
    private $user_type;
    
    /**
     * User id
     * 
     * @access private
     * @var int
     */
    
    private $user_id;

    
    /**
     * School Id
     * @var int 
     */
    
    private $school_id;
	
    /**
     * Codeigniter instance
     * 
     * @access private
     * @var object
     */
    
    private $CI;
	
    /**
     * Class constructor
     * 
     * @access public
     * @return void
     */
    public function __construct() {	

            // Load CI object
            $this->CI = get_instance();

            // Load libraries
            
            // Set user email value form sessions
            $this->user_email = $this->CI->session->userdata('email');
            $this->user_id = $this->CI->session->userdata('user_id');
            $this->user_type = $this->CI->session->userdata('user_type_id');
            $this->school_id = 1;

    } // End func __construct

    /*
     * Authenticate a user using a specified authentication protocol
     * @access public 
     * @param $method (string), $credentials (array)
     * @return mixed (bool | array)
     */
    public function authenticate($method, $credentials) {
        
        // Add schoolid to credentials
        $credentials['school_id'] = $this->school_id;
        $credentials['method'] = $method;
        $this->CI->load->driver("auth/Auth", $credentials, 'auth_prov');
        $authenticated = $this->CI->auth_prov->authenticate();
        if(!$authenticated) {
            return false;
        }
        
        return $this->build_user_session($authenticated );
        
    }// End func authenticate    	
	
    /**
     * Populate session with essential user information
     *
     * @access private
     * @param array $params
     * @return bool
     **/
    private function build_user_session($params) {
        
        if(empty($params)) {   
            $error_msg = $this->CI->lang->line('session_build_error');      
            $this->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            return false;
        }
        
        $user_data = array(
            'user_id' => $params['userid'],
            'user_type_id' => $params['usertypeid'],
            'email' => $params['email'],
            'first_name' => $params['fname'],
            'last_name' => $params['lname'],
            'user_type' => $params['usertype']
        );
        
        // Add user information to session
        $this->CI->session->set_userdata($user_data);
        return true;
    }
    
    /**
     * Logout method
     *
     * @access public
     * @return void
     **/
    public function logout() {  
        // Destroy current user session
        $this->CI->session->sess_destroy();

    } // End func logout
	
    /**
     * Redirect to login page if user is not logged in.
     * 
     * @access public
     * @return void
     */
    public function check_login() {

        if(!$this->logged_in()) {
            redirect(site_url('login'), 'refresh');
        }

    }

    /**
     * Send email reset email
     *
     * @access public
     * @param string $username 
     * @return string $status
     **/
    public function send_reset_email($username) {
        $params = array('school_id' => $this->school_id, 'username' => $username);
        
        // Generate unique id for this particular request.
        $uid = md5(uniqid(rand(),1));
        
        // Log the entry into the database and return user information for the email template
        $status = $this->CI->user_model->create_request_entry($uid, $params);
        
        // If user not found, or request could not be logged, set error and return.
        if(!$status) {
            $error_msg = $this->CI->lang->line('user_not_found');      
            $this->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            return MSG_TYPE_ERROR;
        }
            
        // Build reset link
        $reset_link = site_url("reset_password/{$uid}");
        
        // Build email parameters for template
        $email_params = array(
            'reset_link'    => $reset_link,
            'title'         => '',
            'display_name'  => '',
            'department'    => '',
            'college'   => ''
        );
        
        // Send email
        $email = $this->CI->Message->send_email_from_template($email_params);
        
        
        if(!$email) {
            $error_msg = $this->CI->lang->line('send_email_failed');      
            $this->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            return MSG_TYPE_ERROR;
        }
        
        // Set successs notification message
        $success_msg = $this->CI->lang->line('send_email_succeeded');      
        $this->set_notification_message(MSG_TYPE_SUCCESS, $success_msg);
        
        return MSG_TYPE_SUCCESS;
    }
    
    /**
     * Set notification messages
     *
     * @access public
     * @param string $msg_type, (string | array) $msg 
     * @return void
     **/
    public function set_notification_message($msg_type, $msg) {  
        $msg_bank = $this->CI->session->flashdata($msg_type);
        
        if(empty($msg_bank)) {
            $msg_bank = array();
        }

        if(is_array($msg))
            $msg_bank = array_merge($msg_bank, $msg);
        else 
            array_push($msg_bank, $msg);
        
        $this->CI->session->set_flashdata($msg_type, $msg_bank);
    } // End func set_notification_message
	
    /**
     * Get notification messages
     *
     * @access public
     * @param $msg_type (string), $limit (int)
     * @return mixed (string | array)
     **/
    public function get_notification_messages($msg_type, $limit=0) {  
        $msg_bank = $this->CI->session->flashdata($msg_type);
        
        if(empty($msg_bank) && $limit == 1) {
            return '';
        }elseif(empty($msg_bank)) {
            return array();
        }
        
        if($limit == 0)
            return $msg_bank;
        elseif($limit == 1) 
            return $msg_bank[0];
        else 
            return array_slice($msg_bank, 0, $limit);
    } // End func get_notification_messages
    
    /**
     * Check if user is logged in
     *
     * @access public
     * @return bool
     **/
    public function logged_in() {

        $cdata = array(
            'email' => $this->CI->session->userdata('email'),
            'status' => $this->CI->session->userdata('status'),
            'type' => $this->CI->session->userdata('user_type')
        );

        foreach($cdata as $data) {
            if(trim($data) == '') {
                return false;
            }
        }

        $s_k = $this->CI->session->userdata('k');
        $c_k = sha1($cdata['email'] . '_' . $cdata['status'] . '_' . $cdata['user_type']);

        if($s_k != $c_k) {
            return false;
        }

        return true;

    } // End func logged_in

    /**
     * Get session variable value assigned to user. 
     * 
     * @access public
     * @param string $item
     * @return mixed (bool | string)
     */
    public function get($item) {
//        if(!$this->logged_in()) {
//            return false;
//        }

        return $this->CI->session->userdata($item);

    } // End func get

    /**
     * Redirect to user's access denied page, if user have no permission.
     * 
     * @access public 
     * @param type $id_perm 
     * @return void
     */
    public function check_perm($id_perm) {
        if(!$this->have_perm($id_perm)) {
            redirect(site_url('user/access_denied'), 'refesh');
        }
    }

    /**
     * Check if user has permission 
     * 
     * @access public
     * @param int $id_perm
     * @param int user_id
     * @return bool
     */
     public function have_perm($id_perm){
            
        if(!is_numeric($id_perm) or !is_numeric($this->user_id)) {
            return false;
        }

        $ret = $this->CI->user_model->get_user_perm(
                array(
                    "user_id" => $this->user_id,
                    "id_perm" => $id_perm
                ));

        return $ret;
     }// End func have_perm
     
} // End class user_auth

// End file user_auth.php

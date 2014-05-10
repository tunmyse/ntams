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
     * School Id
     * @var int 
     */
    
    private $school_name = NULL;
	
    /**
     * School Id
     * @var int 
     */
    
    private $college_name = NULL;
	
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
        $this->CI =& get_instance();
        
        // Load certain required classes that wouldnt have been loaded by the framework!        
        // Load models
        $this->CI->load->model('util_model');
        
        $this->_init();
    } // End func __construct

    /**
     * Initialize class variables from session
     */
    private function _init() {
        
        $this->user_email = $this->get('email');
        $this->user_id = $this->get('user_id');
        $this->user_type = $this->get('user_type');
        $this->user_type_id = $this->get('user_type_id');
        $this->college_name = $this->get('college_name');
        $this->school_id = $this->get('school_id');
        $this->school_name = $this->get('school_name');
        
        if(!isset($this->school_id) || $this->school_id == '') {
            $school_details = $this->CI->util_model->get_school_name();
            
            switch($school_details) {

                case DEFAULT_EMPTY:
                    break;

                case DEFAULT_NOT_VALID:
                    break;

                default:
                    $this->school_id = $school_details[0]->schoolid;
                    $this->school_name = $school_details[0]->shortname;
                    $this->set('school_name', $this->school_name);
                    $this->set('school_id', $this->school_id);
            }   
        }

        if(!isset($this->college_name) || $this->college_name == '') {

            $college_name = $this->CI->util_model->get_school_college();

            switch($college_name) {

                case DEFAULT_EMPTY:
                    break;

                case DEFAULT_NOT_VALID:
                    break;

                default:
                    $this->college_name = $college_name[0]->unitname;
                    $this->set('college_name', $this->college_name);
            }                 
        }
    }// End func _init
    
    /*
     * Encrypt passsord using Site authentication method
     * @access public 
     * @param string $password
     * @return mixed (bool | array)
     */
    public function encrpyt($password) {
        
        $this->CI->load->driver("Auth/Auth", array(), 'auth_prov');      
        $crypt_password = $this->CI->auth_prov->site->encrypt($password);
        
        return $crypt_password;
        
    }// End func authenticate  
    
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
        $this->CI->load->driver("Auth/Auth", $credentials, 'auth_prov');
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
            'user_type' => $params['usertype'],
            'school_name' => 'Tasued'
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
    public function get_college_name() {  
        return $this->college_name;

    } // End func get_college_name
    
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
        $this->CI->load->helper('auth');
        
        $params = array('school_id' => $this->school_id, 'username' => $username);
        $user_info = $this->CI->user_model->get_user_info($params);
        
        // Check if user exists.
        if(!$user_info) {
            $error_msg = $this->CI->lang->line('user_not_found');      
            $this->set_notification_message(MSG_TYPE_ERROR, sprintf($error_msg, 'username'));
            return MSG_TYPE_ERROR;
        }
        
        // Check if email exist or is valid.
        if(!check_field($user_info->email, FIELD_TYPE_EMAIL)) {
            $error_msg = $this->CI->lang->line('invalid_email');      
            $this->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            return MSG_TYPE_ERROR;
        }
        
        // Generate unique id for this particular request.
        $uid = md5(uniqid(rand(),1));          
        
        $reset_params = array(
            'userid'    => $user_info->userid,
            'uid'       => $uid,
            'date'      => date('Y-m-d H:i:s')
        );
        
        // Log the entry into the database and return user information for the email template
        $status = $this->CI->user_model->create_request_entry($reset_params);
        
        // Check if reset request was successfully logged into database.
        switch($status) {            
            case DEFAULT_ERROR:
                $error_msg = $this->CI->lang->line('operation_error');      
                $this->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                return MSG_TYPE_ERROR;
            
            case DEFAULT_EXIST:
                $error_msg = $this->CI->lang->line('reset_pending');      
                $this->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                return MSG_TYPE_WARNING;        
        }
        
        // Build reset link
        $reset_link = site_url("reset_password/{$uid}");
        
        // Build email parameters for template
        $email_params = array(
            'reset_link'    => $reset_link,
            'title'         => '',
            'display_name'  => '',
            'department'    => '',
            'college'       => ''
        );
        
        // Send email using reset password template
        $email_status = $this->CI->message->send_email_from_template($user_info->email, $email_params, EMAIL_TEMPLATE_RESET);
        
        // Check if email was sent
        if(!$email_status) {
            $error_msg = $this->CI->lang->line('reset_email_failed');      
            $this->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            return MSG_TYPE_ERROR;
        }
        
        // Set successs notification message
        $success_msg = $this->CI->lang->line('reset_email_succeeded');      
        $this->set_notification_message(MSG_TYPE_SUCCESS, $success_msg);
        
        return MSG_TYPE_SUCCESS;
    }
    
    /**
     * Check reset link
     *
     * @access public
     * @param string $uid
     * @return int $status
     **/
    public function check_reset_link($uid) {
        $status = $this->CI->user_model->check_reset_link($uid);
        
        if($status !== DEFAULT_NOT_EXIST && $status !== DEFAULT_EXPIRED) {
            $this->set('userid', $status->userid);
            return DEFAULT_EXIST;
        }
            
        return $status;
    }// End func check_reset_link
    
    /**
     * Change user password
     *
     * @access public
     * @param string $new_password
     * @return int $status
     **/
    public function change_password($new_password) {
        // Set credentials
        $credentials['password'] = $new_password;
        $credentials['user_id'] = $this->get('userid');
        
        // Load Authentication driver
        $this->CI->load->driver("Auth/Auth", $credentials, 'auth_prov');
        
        // Change user password
        return $this->CI->auth_prov->change_password();
    }// End func change_password
    
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
     * Set a session variable. 
     * 
     * @access public
     * @param string $item
     * @return mixed (bool | string)
     */
    public function set($key, $value = '', $clear = FALSE) {
//        if(!$this->logged_in()) {
//            return false;
//        }
        
        if($clear) {
            $this->CI->session->unset_userdata($key);
            return;
        }
        
        if(is_array($key)) {
            $this->CI->session->set_userdata($key);
            return;
        }
        
        $sess_data = array($key => $value);
        $this->CI->session->set_userdata($sess_data);

    } // End func set

    
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
     
} // End class Main

// End file Main.php

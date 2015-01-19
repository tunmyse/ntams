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
     * User's last name
     * 
     * @access private
     * @var string
     */
    
    private $user_lname;
    
    /**
     * User's first name
     * 
     * @access private
     * @var string
     */
    
    private $user_fname;
    
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
     * User type id
     * 
     * @access private
     * @var string
     */
    
    private $user_type_id;
    
    /**
     * School Id
     * @var int 
     */
    
    private $school_id;
	
    /**
     * School Name
     * @var int 
     */
    
    private $school_name = NULL;
	
    /**
     * School shortname
     * @var int 
     */
    
    private $school_shortname = NULL;
    
    /**
     * School Unitname
     * @var int 
     */
    
    private $college_name = NULL;
	
    /**
     * Session Id
     * @var int 
     */
    
    private $cur_session = NULL;
    
    /**
     * Session Name
     * @var string 
     */
    
    private $cur_sesname = NULL;
    
    /**
     * Notification Messages
     * 
     * @access private
     * @var array
     */
    
    private $notification = array(MSG_TYPE_ERROR => array(), MSG_TYPE_SUCCESS => array(), MSG_TYPE_WARNING => array());
    
    /**
     * User permissions array
     * 
     * @access private
     * @var array
     */
    
    private $user_perms = array();
    
    /**
     * Navigation content array
     * 
     * @access private
     * @var array
     */
    
    private $nav_content = array();
    
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
                       
        // Get the string representation of this uri
        $uri = $this->CI->uri->uri_string();
        
        // Flag to determine whether this request requires authentication.
        $req = isset($this->CI->router->routes["{$uri}_require"])? false: true;
        
        // Check if the user is logged in.
         $this->check_login($req);
         
        // Retrieve all permissions owned by logged in user.
        $this->get_user_perms();
        
        // Retrieve navigation content.
        $this->get_nav_content($uri);
        
        // Initialize class properties.
        $this->_init();
    } // End func __construct

    
    /*
    |--------------------------------------------------------------------------
    | Initialization functions
    |--------------------------------------------------------------------------
    */
    
    /**
     * Initialize class variables from session
     */
    private function _init() {
        
        $this->user_lname = $this->get('last_name');
        $this->user_fname = $this->get('first_name');
        $this->user_email = $this->get('email');
        $this->user_id = $this->get('user_id');
        $this->user_type = $this->get('user_type');
        $this->user_type_id = $this->get('user_type_id');
        $this->college_name = $this->get('college_name');
        $this->school_id = $this->get('school_id');
        $this->school_name = $this->get('school_name');
        $this->cur_session = $this->get('cur_session');
        $this->cur_sesname = $this->get('cur_sesname');
        
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
        
        if(!isset($this->cur_session) || $this->cur_session == '') {

            $cur_session = $this->CI->util_model->get_current_session();

            if(is_object($cur_session)) {
                $this->cur_session = $cur_session->sesid;
                $this->cur_sesname = $cur_session->sesname;
                $this->set('cur_session', $this->cur_session);
                $this->set('cur_sesname', $this->cur_sesname);
            }else {
                switch($cur_session) {

                    case DEFAULT_EMPTY:
                        break;

                    case DEFAULT_NOT_VALID:
                        break;
                }                 
            }
        }
        
    }// End func _init
    
    /**
     * Get dashboard content.
     *
     * @access public
     * @return void
     **/
    public function get_dashboard() {
        return $this->nav_content;
    }
    
    /**
     * Retrieve navigation contents to build menu.
     *
     * @access public
     * @return array
     **/
    public function get_nav_content($uri) {
        
        // Get first segment of the uri (module's urlprefix)
        $uri_parts = explode('/', $uri);
        
        // Retrieve navigation content from model.
        $contents = $this->CI->util_model->get_nav_content($this->user_perms['ids']);
        
        // Check if returned value is not empty.
        if($contents != DEFAULT_EMPTY) {
            
            // Loop through each content to process it.
            foreach($contents as $content) {
                // If the module name doesn't already exist as a key in the array, initialize it.
                if(!isset($this->nav_content[$content->mname])) {
                    
                    $this->nav_content[$content->mname] = array(
                                                            'urlprefix' => $content->urlprefix,
                                                            'dispname' => $content->dispname,
                                                            'tilecolor' => $content->tilecolor,
                                                            'tileicon' => $content->tileicon,
                                                            'links' => array()
                                                        );
                    if($uri_parts[0] == $content->urlprefix) {
                        $this->nav_content[$content->mname]['active'] = true;
                    }
                }

                // Populate each module with its link. 
                $this->nav_content[$content->mname]['links'][] = array(
                                                                  'url' => $content->url,
                                                                  'name' => $content->name,
                                                              );

            }
            
        }
        
    } // End func get_nav_content
    
    /**
     * Get schools unit name
     *
     * @access public
     * @return void
     **/
    public function get_college_name() {  
        return $this->item('college_name');

    } // End func get_college_name
    
    /**
     * Get School name
     *
     * @access public
     * @return void
     **/
    public function get_school_name() {  
        return $this->item('school_name');

    } // End func get_school_name
    
    /**
     * Get current session information
     *
     * @access public
     * @return void
     **/
    public function get_session() {  
        return array('name' => $this->item('cur_sesname'), 'id' => $this->item('cur_session'));

    } // End func get_school_name
    
    
    /*
    |--------------------------------------------------------------------------
    | Authentication functions
    |--------------------------------------------------------------------------
    */
    
    /*
     * Authenticate a user using a specified authentication protocol
     * 
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
        
        return $this->build_user_session($authenticated);
        
    }// End func authenticate    	
	
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
     * @param bool $require_login
     * @return void
     */
    public function check_login($require_login) {
        if(!$this->logged_in() && $require_login) {
            redirect(site_url('login'), 'refresh');
        }

    } // End of func check_login

    /**
     * Check if user is logged in
     *
     * @access public
     * @return bool
     **/
    public function logged_in() {

        $cdata = array(
            'email' => $this->get('email'),
            'type_id' => $this->get('user_type_id'),
            'user_type' => $this->get('user_type')
        );

        foreach($cdata as $data) {
            if(trim($data) == '') {
                return false;
            }
        }

        $s_k = $this->get('cs');
        $c_k = sha1($cdata['email'] . '_' . $cdata['type_id'] . '_' . $cdata['user_type']);

        if($s_k != $c_k) {
            return false;
        }

        return true;

    } // End func logged_in
    
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
            'cs' => sha1($params['email'] . '_' . $params['usertypeid'] . '_' . $params['usertype'])
        );
        
        // Add user information to session
        $this->CI->session->set_userdata($user_data);
        return true;
    }
    
    
    /*
    |--------------------------------------------------------------------------
    | Password functions
    |--------------------------------------------------------------------------
    */
            
    /*
     * Encrypt passsord using Site authentication provider
     * @access public 
     * @param string $password
     * @return mixed (bool | array)
     */
    public function encrpyt($password) {
        
        $this->CI->load->driver("Auth/Auth", array(), 'auth_prov');      
        $crypt_password = $this->CI->auth_prov->site->encrypt($password);
        
        return $crypt_password;
        
    }// End func authenticate  
    
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
    
    
    /*
    |--------------------------------------------------------------------------
    | Notification functions
    |--------------------------------------------------------------------------
    */
    
    /**
     * Set notification messages
     *
     * @access public
     * @param string $msg_type, (string | array) $msg 
     * @return void
     **/
    public function set_notification_message($msg_type, $msg) {  
        $msg_bank = $this->notification[$msg_type];

        if(is_array($msg)) {
            $this->notification[$msg_type] = $msg_bank = array_merge($msg_bank, $msg);            
        }else {
            array_push($msg_bank, $msg);
            $this->notification[$msg_type] = $msg_bank;
        }
        
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
        
        // Ensure $limit is a non-negative number.
        if($limit < 0)
            $limit = 0;
        
        if(empty($msg_bank) && $limit == 1) {
            return '';
        }elseif(empty($msg_bank)) {
            return array();
        }
        
        $excerpt = array_slice($msg_bank, 0, $limit);
        if($limit == 0)
            return $msg_bank;
        elseif($limit == 1) 
            return $excerpt[0];
        else
            return $excerpt;
    } // End func get_notification_messages

    
    /*
    |--------------------------------------------------------------------------
    | Session/property functions
    |--------------------------------------------------------------------------
    */
    
    /**
     * Get session variable value assigned to user. 
     * 
     * @access public
     * @param string $item
     * @return mixed (bool | string)
     */
    public function get($item) {
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
     * Get a property in this class. 
     * 
     * @access public
     * @param string $item
     * @return string
     */
    public function item($item) {

        return $this->$item;

    } // End func item

    
    /*
    |--------------------------------------------------------------------------
    | Authorization functions
    |--------------------------------------------------------------------------
    */
    
    /**
     * Check if user is authorized to view requested resource
     * User must have at least one permission specified by the controller for this resource.
     *
     * @access public
     * @return array
     **/
    public function check_auth(Array $mod_perms) {
        // User is unauthorized by default
        $authd = false;
        
        // Iterate through modules in parameter array.
        foreach($mod_perms as $mod => $perms) {
            
            // Iterate through permissions in each module.
            foreach($perms as $perm) {
                
                // Once one permission is found, user is authorized, stop checking for any more permissions.
                if(isset($this->user_perms[$mod]['perms'][$perm])) {
                    $authd = true;
                    break;
                }
            }            
        }
        
        // Redirect to access denied page if user is not authorized. 
        if(!$authd) {
            redirect(site_url("{$this->user_type}/access_denied"), 'refresh');
        }
    } // End func check_auth
    
    /**
     * Retrieve user permissions.
     *
     * @access private
     **/
    private function get_user_perms() {
        // Retrieve all user's permission for all modules in the application.
        $perms = $this->CI->util_model->get_user_perms($this->get('user_id'));
        
        $this->user_perms['ids'] = array();
                
        if($perms != DEFAULT_EMPTY) {
            // Format the permissions.
            foreach($perms as $perm) {
                $this->user_perms[$perm->mname]['perms'][] = $perm->pname;
                $this->user_perms['ids'][] = $perm->permid;
            }
        }
    } // End func get_user_perms
    
    /**
     * Check if a user has a certain permission 
     * 
     * @access public
     * @param string $module, string $perm
     * @return bool
     */
    public function has_perm($module, $perm) {
        return isset($this->user_perms[$module]['perms'][$perm]);
    }// End func has_perm
     
} // End class Main

// End file Main.php

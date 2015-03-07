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
     * Is user super admin.
     * 
     * @access private
     * @var bool
     */
    private $super_admin = false;
    
    /**
     * School Id
     * @var int 
     */
    
    private $school_id;
	
    /**
     * School Name
     * @var string 
     */
    
    private $school_name = NULL;
	
    /**
     * School shortname
     * @var string 
     */
    
    private $school_shortname = NULL;
    
    /**
     * School Unitname
     * @var string
     */
    
    private $unit_name = NULL;
	
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
     * Session Name
     * @var string 
     */
    
    private $domain_string = 'tasued';
    
    
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
     * Current request uri.
     * 
     * @access private
     * @var string
     */
    
    private $uri = '';
    
    /**
     * Url prefix of the module.
     * 
     * @access private
     * @var string
     */
    private $segment = '';
    
    /**
     * Hold user's logged_in status.
     * 
     * @access private
     * @var boolean
     */
    private $logged_in = NULL;
    
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
        
        // Check the domain before any other action
        switch($this->check_domain()) {
            
            case DEFAULT_NOT_EXIST:
                // Account doesn't exist
                echo 'no such account';
                break;      
            
            case DEFAULT_MISMATCH:
                // subdomain doesn't match value in the session.
                echo 'mismatch';
                break;    
            
            case DEFAULT_NOT_VALID:
                
                break;
            
            default :
        }
        
        // Get the first segment of this uri
        $this->segment = $this->CI->uri->segment(1, '');
        
        $this->uri = filter_input(INPUT_SERVER, 'REQUEST_URI');//$this->CI->uri->uri_string();
        
        // Flag to determine whether this request requires authentication.
        $req = isset($this->CI->router->routes["{$this->segment}_require"])? false: true;
        
        // Check if the user is logged in.
        $this->check_login($req);
         
        // Retrieve all permissions owned by logged in user.
        $this->get_user_perms();
        
        // Retrieve navigation content.
        $this->get_nav_content();
        
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
        if($this->logged_in()) {
            $this->user_lname = $this->get('last_name');
            $this->user_fname = $this->get('first_name');
            $this->user_email = $this->get('email');
            $this->user_id = $this->get('user_id');
            $this->user_type = $this->get('user_type');
            $this->user_type_id = $this->get('user_type_id');
            $this->unit_name = $this->get('unit_name');
            $this->school_id = $this->get('school_id');
            $this->school_name = $this->get('school_name');        
            $this->school_shortname = $this->get('school_shortname');
            $this->cur_session = $this->get('cur_session');
            $this->cur_sesname = $this->get('cur_sesname');
            
            if(!isset($this->cur_session) || $this->cur_session == '') {

                $result = $this->CI->util_model->get_current_session();

                switch($result['status']) {

                    case DEFAULT_SUCCESS:
                        $rs_obj = $result['rs'];
                        $this->cur_session = $rs_obj->sesid;
                        $this->cur_sesname = $rs_obj->sesname;
                        $this->set('cur_session', $this->cur_session);
                        $this->set('cur_sesname', $this->cur_sesname);
                        break;

                    case DEFAULT_EMPTY:
                        break;

                    case DEFAULT_NOT_VALID:
                        break;
                }               
            }
        
        }
    }// End func _init
    
    /**
     * Get the subdomain the request is for.
     *
     */ 
    private function check_domain() {
        
        // Build list of subdomain exceptions.
        $exceptions = array('www');
        
        // Get full domain, and split into parts. 
        $host_part = explode('.', filter_input(INPUT_SERVER, 'HTTP_HOST')); 
        $count = count($host_part);
        
        // return false if there is no subdomain string
        if($count < 3) {
            return DEFAULT_NOT_VALID ;
        }
        
        // Retrieve the first section of the domain.
        // NOTE: Default should be an empty string in production.
        $this->domain_string = $count < 3? 'tasued': $host_part[0];
        
        // If user is logged in, subdomain details should exists in the session,
        // check that it does and ensure it is the same as the one in the url.
        if($this->logged_in() && $this->domain_string == $this->get('domain_string')) {
            return DEFAULT_VALID;
        }elseif($this->logged_in() && $this->domain_string != $this->get('domain_string')) {
            return DEFAULT_MISMATCH;
        }
        
        // Get the information for the valid domain_string.
        $result = $this->CI->util_model->get_school_details($this->domain_string);

        switch($result['status']) {

            case DEFAULT_SUCCESS:
                $rs_obj = $result['rs'];
                $this->school_id = $rs_obj->schoolid;
                $this->school_name = $rs_obj->schoolname;
                $this->school_shortname = $rs_obj->shortname;
                $this->unit_name = $rs_obj->unitname;
                $resp = DEFAULT_VALID;
                break;

            case DEFAULT_EMPTY:
                $resp = DEFAULT_NOT_EXIST;
                break;

            case DEFAULT_NOT_VALID:
                $resp = DEFAULT_NOT_VALID;
                break;
        }         
        
        return $resp;
    }// End func check_domain
    
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
    public function get_nav_content() {
        
        // Retrieve navigation content from model.
        $result = $this->CI->util_model->get_nav_content($this->user_perms['ids']);
        
        // Check if returned value is not empty.
        if($result['status'] != DEFAULT_EMPTY) {
            
            // Loop through each content to process it.
            foreach($result['rs'] as $content) {
                // If the module name doesn't already exist as a key in the array, initialize it.
                if(!isset($this->nav_content[$content->mname])) {
                    
                    $this->nav_content[$content->mname] = array(
                                                            'urlprefix' => $content->urlprefix,
                                                            'dispname' => $content->dispname,
                                                            'tilecolor' => $content->tilecolor,
                                                            'tileicon' => $content->tileicon,
                                                            'links' => array()
                                                        );
                    
                    // Check if this module contains the active link.
                    if($this->segment == $content->urlprefix) {
                        $this->nav_content[$content->mname]['active'] = true;
                    }
                }

                // Populate each module with its link. 
                $this->nav_content[$content->mname]['links'][] = array(
                                                                  'url' => $content->url,
                                                                  'name' => $content->name,
                                                              );
                // var_dump($this->nav_content[$content->mname]['links']);
            }
            
        }
        
    } // End func get_nav_content
    
    /**
     * Get schools unit name
     *
     * @access public
     * @return void
     **/
    public function get_unit_name() {  
        return $this->item('unit_name');

    } // End func get_unit_name
    
    /**
     * Get School name
     *
     * @access public
     * @return void
     **/
    public function get_school_name() {  
        return array('full' => $this->school_name, 'short' => $this->school_shortname);

    } // End func get_school_name
    
    /**
     * Get current session information for a school 
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
    
    /**
     * Authenticate a user using a specified authentication protocol
     * 
     * @access public 
     * @param string $method The authentication provider
     * @param array $credentials The authentication credentials
     * @return mixed 
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
            // Get request uri to redirect to on successful login.
            $referer = $this->uri == ''? '': '?rdr='.urlencode($this->uri);
        
            redirect(site_url('login'.$referer), 'refresh');
        }

    } // End of func check_login

    /**
     * Check if user is logged in
     *
     * @access public
     * @return bool
     **/
    public function logged_in() {
        
        // Check if the logged_in variable has been initialized. If it has, no need checking in the session anymore.
        if($this->logged_in != NULL) {
            return $this->logged_in;
        }
        
        // Get the information used to determine logged_in status.
        $cdata = array(
            'email' => $this->get('email'),
            'type_id' => $this->get('user_type_id'),
            'user_type' => $this->get('user_type')
        );

        // Check that no value is empty.
        foreach($cdata as $data) {
            if(trim($data) == '') {
                return $this->logged_in = false;
            }
        }

        // Get the hashed value in the session and compare with the hash of the concatenated retrieved values.
        $s_k = $this->get('cs');
        $c_k = sha1($cdata['email'] . '_' . $cdata['type_id'] . '_' . $cdata['user_type']);

        if($s_k != $c_k) {
            return $this->logged_in = false;
        }

        return $this->logged_in = true;

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
        
        $user_data = [
                        'user_id' => $params['userid'],
                        'user_type_id' => $params['usertypeid'],
                        'email' => $params['email'],
                        'first_name' => $params['fname'],
                        'last_name' => $params['lname'],
                        'user_type' => $params['usertype'],            
                        'super_admin' => true, //TODO Get this from login authentication.
                        'cs' => sha1($params['email'] . '_' . $params['usertypeid'] . '_' . $params['usertype']),
                        'school_id' => $this->school_id,
                        'school_name' => $this->school_name,    
                        'school_shortname' => $this->school_shortname,
                        'unit_name' => $this->unit_name,
                        'domain_string' => $this->domain_string
                    ];
        
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
    public function set_notification_message($msg_type, $msg, $current = FALSE) {  
        
        // If notification is for current request
        if(!$current) {
            $msg_bank = $this->notification[$msg_type];

            if(is_array($msg)) {
                $this->notification[$msg_type] = $msg_bank = array_merge($msg_bank, $msg);            
            }else {
                array_push($msg_bank, $msg);
                $this->notification[$msg_type] = $msg_bank;
            }

        }else {
            if(!is_array($msg)) {
                $msg_bank = [$msg];
            }
        }
        
        $this->CI->session->set_flashdata($msg_type, $msg_bank, $current);
    } // End func set_notification_message
	
    /**
     * Get notification messages
     *
     * @access public
     * @param $msg_type (string), $limit (int)
     * @return mixed (string | array)
     **/
    public function get_notification_messages($msg_type, $limit = 0) {  
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
     * @param array $mod_perms
     * @return array
     **/
    public function check_auth(Array $mod_perms) {
        // User is unauthorized by default
        $authd = false;
        
        //TODO Include extra compulsory parameter to check if a permission is compulsory for a resource.
        

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
        $result = $this->CI->util_model->get_user_perms($this->get('user_id'));
        
        $this->user_perms['ids'] = array();
                
        if($result['status'] != DEFAULT_EMPTY) {
            // Format the permissions.
            foreach($result['rs'] as $perm) {
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
        return $this->super_admin || isset($this->user_perms[$module]['perms'][$perm]);
    }// End func has_perm
     
} // End class Main

// End file Main.php

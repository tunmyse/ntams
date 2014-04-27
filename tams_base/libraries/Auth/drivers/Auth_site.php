<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Site authentication library
 * 
 * @category   Library
 * @package    Authentication
 * @subpackage Site
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Auth_site extends CI_Driver {

    /**
     * Codeigniter instance
     * 
     * @access private
     * @var object
     */
    private $CI;
	
    /**
     * User login credentials
     * @var array
     */
    private $credentials;
	
    /**
     * Class constructor
     * 
     * @access public
     * @return void
     */
    public function __construct(Array $credentials) {	

        // Load CI object
        $this->CI =& get_instance();
    
        // Initialize authentication credentials
        $this->credentials = $credentials;

    } // End func __construct

    /**
     * Encrypt string using md5 
     * 
     * @access public
     * @param string $str
     * @return string
     */
    public function encrypt($str) {
        // Only used for compartibility with existing data
        return md5($str);
    } // End func encrypt

    
    /**
     * Authentication procedure
     *
     * @access public
     * @return mixed (bool | array)
     **/
    public function authenticate() {
        
        // Encrypt password
        $password = $this->encrypt($this->credentials['password']);
        
        // Fetch user data from database by usertypeid, email or phone number and password
        $authenticated = $this->CI->user->authenticate_user(array('school_id' => $this->credentials['school_id'], 'username' => $this->credentials['username'], 'password' => $password));
        
        if(!$authenticated) {
            $error_msg = $this->CI->lang->line('user_not_found');            
            $this->CI->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            return false;
        }
        
        // Get user information
        //$profile = $this->CI->user->get_user_info(array('username' => $this->credentials['username'], 'password' => $password));
        
        return $authenticated;
        
    } // End func authentication
        

        
} // End class Auth_site

// End file Auth_site.php

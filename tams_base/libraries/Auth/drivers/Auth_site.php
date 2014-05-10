<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Site Authentication library
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
     * Encrypt string using md5 
     * 
     * @access public
     * @param string $str
     * @return string
     */
    public function encrypt($str) {
        // Only used for compartibility with existing data
        // Should use a more secure password encrypting function
        
        return md5($str);
    } // End func encrypt

    
    /**
     * Authentication procedure
     *
     * @access public
     * @param string $method
     * @return mixed (bool | array)
     **/
    public function authenticate() {
        // Check if authentication method is a valid auth type
        if(!$this->is_valid_auth_provider($this->credentials['method'])) {   
            $error_msg = $this->CI->lang->line('invalid_auth_method');      
            $this->CI->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            return false;
        }
        
        // Encrypt password
        $password = $this->encrypt($this->credentials['password']);
        
        // Fetch user data from database by usertypeid, email or phone number and password
        $authenticated = $this->CI->user_model->authenticate_user(
                            array(
                                'school_id' => $this->credentials['school_id'], 
                                'username' => $this->credentials['username'], 
                                'password' => $password
                            )
                        );
        
        if(!$authenticated) {
            $error_msg = $this->CI->lang->line('user_not_found');            
            $this->CI->main->set_notification_message(MSG_TYPE_ERROR, sprintf($error_msg, 'credentials'));
            return false;
        }
        
        // Get user information
        //$profile = $this->CI->user->get_user_info(array('username' => $this->credentials['username'], 'password' => $password));
        
        return $authenticated;
        
    } // End func authentication        
     
    /**
     * Change users password.	 
     *
     * @access public
     * @param string $name
     * @return bool
     **/
    public function change_password() {
        
        // Encrypt password
        $password = $this->encrypt($this->credentials['password']);
        
        // Change user password.
        $changed = $this->CI->user_model->change_user_password($this->credentials['user_id'], 
                array( 
                    'password' => $password)
                );
        if(!$changed) {
            return DEFAULT_ERROR;
        }
        
        $this->CI->user_model->invalidate_reset_link($this->credentials['user_id']);
        return DEFAULT_SUCCESS;
        
    }// End of func change_password
    
        
} // End class Auth_site

// End file Auth_site.php

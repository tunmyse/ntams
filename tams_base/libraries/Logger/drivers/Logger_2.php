<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Application logging library
 * 
 * @category   Library
 * @package    Logger
 * @subpackage 
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Logger extends CI_Driver {
	
    /**
     * User email
     * 
     * @access private
     * @var string
     */
    private $email_user;

    /**
     * User id
     * 
     * @access private
     * @var int
     */
    private $id_user;

    /**
     * Codeigniter instance
     * 
     * @access private
     * @var object
     */
    private $CI;
	
    /**
     * User statuses
     * @var type 
     */
    private $statuses;

    /**
     * Class constructor
     * 
     * @access public
     * @return void
     */
    public function __construct() {	

            // Load CI object
            $this->CI = get_instance();

            // Set user email value form sessions
            $this->email_user = $this->CI->session->userdata('email');
            $this->id_user = $this->CI->session->userdata('id_user');

           

    } // End func __construct

    public function statuses() {
            return $this->statuses;
    }

    /**
     * Login method
     *
     * @access public
     * @param string $email
     * @param string $password
     * @return mixed (bool | array)
     **/
    public function authenticate($email, $password) {

        $password = $this->encrypt($password);

        // Fetch user data from database by email and password
        $result = $this->CI->user_model->fetch_account(array('email' => $email, 'password' => $password));

        if(!$result) {
            // User does not exist
            return FALSE;
        }
                
        // Define params
        $status = $result[0]->status;
        $account_type = $result[0]->account_type;

        // Check if user status is ACTIVE
        if($status == USER_STATUS_ACTIVE or $status == USER_STATUS_PROBATION_ACCESS){
 
            $key = sha1($result[0]->email . '_' . $status . '_' . $account_type);

            // Build user session array
            $session_vars = array(
                // More session variables to be added later here.
                'id_user' => $result[0]->id_user,
                'email' => $result[0]->email,
                'status' => $status,
                'account_type' => $account_type,
                'display_name' => $result[0]->first_name,
                'last_name' => $result[0]->last_name,
                'k' => $key,
                'id_company' => $result[0]->id_company,
                'company_name' => $result[0]->company_name,
                'company_id_string' => $result[0]->company_id_string,
            );
                       
            // Add user record details to session
            $this->CI->session->set_userdata($session_vars);
        }

        // Return array with user data
        return array(
               "status" => $status,
               "account_type" => $account_type
              );
		
	} // End func login
	
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
     * Redirect to login page if user not logged in.
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
     * Check if user logged in
     *
     * @access public
     * @return bool
     **/
    public function logged_in() {

        $cdata = array(
                'email' => $this->CI->session->userdata('email'),
                'status' => $this->CI->session->userdata('status'),
                'account_type' => $this->CI->session->userdata('account_type')
        );

        foreach($cdata as $data) {
                if(trim($data) == '') {
                        return false;
                }
        }

        $s_k = $this->CI->session->userdata('k');
        $c_k = sha1($cdata['email'] . '_' . $cdata['status'] . '_' . $cdata['account_type']);

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

        if(!$this->logged_in()) {
                return false;
        }

        return $this->CI->session->userdata($item);

    } // End func get

    /**
     * Encrypt string to sha1 
     * 
     * @access public
     * @param string $str
     * @return string
     */
    public function encrypt($str) {
            return sha1($str);
    } // End func encrypt

    /**
     * Redirect to user's access denied page, if user have not permission.
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
     * @param int id_user
	 * @return bool
	 */
     public function have_perm($id_perm){
            
            if(!is_numeric($id_perm) or !is_numeric($this->id_user)) {
                return false;
            }
            
            $ret = $this->CI->user_model->get_user_perm(
                                                        array(
                                                            "id_user" => $this->id_user,
                                                            "id_perm" => $id_perm
                                                        ));
            
            return $ret;
     }// End func have_perm
	 
} // End class user_auth

// End file user_auth.php
?>

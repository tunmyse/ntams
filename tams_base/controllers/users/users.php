<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Users controller
 * 
 * @category   Controller
 * @package    Users
 * @subpackage 
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
abstract class Users extends CI_Controller {

    /**
     * Folder Name
     * 
     * @access protected
     * @var string
     */
    
    protected $folder_name = 'users';
    
    /**
     * User Id
     * 
     * @access protected
     * @var string
     */
    
    protected $user_id = NULL;
    
    /**
     * User Type
     * 
     * @access protected
     * @var string
     */
    
    protected $user_type = NULL;
    
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
       
               
    }// End of func index
    
    /**
     * change password.
     * 
     * @access protected
     * @param string $uid
     * @return void	 
     */
    protected function change_password($uid=NULL) {
        $page_name = 'change_password';
        
         // Set page parameters. 
        $data['msg_type'] = $data['msg'] = '';
        $data['collapse']   = false;   
        
        // Check request to either show the view or initiate a password change.
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            
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
        
    }// End of func change_password
    
    /**
     * Ensure usertype in session is the same as usertype in url
     * 
     * @access protected
     * @param 
     * @return void	 
     */
    protected function check_user_type() {
        $url = $this->uri->segment(1);
        
        if($this->user_type == $url) {
            return true;
        }
        /* TODO: Insert error into notification and retreive on redirect. Should remove the extra slash on the redict*/
        redirect('error/error_ErrorNum');
    }// End of func reset_pasword
    
    /**
     * Generate the tiles that should be generated on the user's dashboard.
     * 
     * @access protected
     * @param 
     * @return void	 
     */
    protected function dashboard_tiles() {
        
        // Retrieve module tiles to be displayed on the dashboard.
        return $this->main->get_dashboard();
        
    }// End of func dashboard_tiles
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
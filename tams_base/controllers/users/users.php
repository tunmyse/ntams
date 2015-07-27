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
        
    /**
     * Model Name
     * 
     * @access public
     * @var User_model
     */
    
    public $mdl;
    
    /*
     * Class constructor
     * 
     * @access public 
     * @retun void
     */
    public function __construct() {

        parent::__construct();
        
        /*
         * Load models
         */
        $this->load->model("$this->folder_name/user_model", 'mdl');
        
        /*
         * Load helpers
         */
        $this->load->helper(array('validation'));
        
        // Initialize class variables
        $this->user_id = $this->main->get('user_id');
        $this->user_type = $this->main->get('user_type');
        $this->check_user_type();
        
    }// End func __construct
    
    /**
     * Dashboard for all users.	 
     */
    protected function index() {    
        $data = array(
            'tiles' => $this->dashboard_tiles()
        );
        
        $page_name = 'dashboard';
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_content, 'Dashboard', false);  
               
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
    private function check_user_type() {
        $url = $this->uri->segment(1);
        
        if($this->user_type == $url) {
            return true;
        }
        /* TODO: Insert error into notification and retreive on redirect.*/
        // redirect('error/error_ErrorNum');
    }// End of func reset_pasword
    
    /**
     * Generate the tiles that should be displayed on the user's dashboard.
     * 
     * @access protected
     * @return void	 
     */
    protected function dashboard_tiles() {
        
        // Retrieve module tiles to be displayed on the dashboard.
        return $this->main->get_dashboard();
        
    }// End of func dashboard_tiles
    
    /**
     * Get information about the currently logged in user.
     * 
     * @access protected 
     * @return array	 
     */
    protected function get_user_info() {
        
        $params = [
            'school_id' => $this->main->item('school_id'),
            'user_id' => $this->user_id
        ];
        
        $info = $this->mdl->get_user_info($params, true);
        
        return ($info['status'] == DEFAULT_SUCCESS)? $info['rs']: [];
        
    }// End of func get_user_info
    
    /**
     * Edit a user's profile.
     * 
     * @access public 
     * @param string $section
     * @return void	 
     */
    public function edit_profile($section) {
        $dest = "{$this->user_type}/profile";
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            switch($section) {

                case 'change_password':
                    // Load the validation library
                    $this->load->library('form_validation');

                    // Run validation and process request if fields are valid.
                    if($this->form_validation->run('user_change_password') != FALSE) {
                        
                        // Get all input values
                        $fields = $this->input->post(NULL);
                
                        $params = [
                            'password' => $this->main->encrypt($fields['new_password']),
                            'where' => [
                                'password' => $this->main->encrypt($fields['old_password']),
                                'userid' => $this->user_id
                            ]                            
                        ];
                        
                        $this->mdl->update_user_profile($params);                        
                        
                    }else {
                        // Set error message for invalid/incomplete fields
                        $msg = $this->form_validation->_error_array();  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                    }

                    break;

                case 'change_image': 
                    
                    $config['upload_path'] = './img/user/';
                    $config['allowed_types'] = 'jpg';  
                    $config['max_size']	= '100';
                    $config['max_width']  = '400';
                    $config['max_height']  = '400'; 
                    
                    if($this->main->item('image_url') == NULL) {                        
                        $config['encrypt_name']  = TRUE; 
                    }else {                       
                        $config['file_name']  = $this->main->item('image_url');
                        $config['overwrite'] = TRUE;
                    }
                    
                    // Load file upload library
                    $this->load->library('upload', $config);
                    
                    // Attempt upload and check if it is successful
                    if($this->upload->do_upload('imagefile')) {
                        
                        // Skip database update if image_url already exist in database.
                        if($this->main->item('image_url') == NULL) {
                            $params = [
                                'imageurl' => $this->upload->data()['file_name'],
                                'where' => [
                                    'userid' => $this->user_id
                                ]                            
                            ];

                            $this->mdl->update_user_profile($params); 
                            $this->main->set('image_url', $params['imageurl']);
                        }
                    }else {
                        // Error message for failed upload.
                    }
                    
                    break;

                case 'edit_profile':
                    
            }
        }else{
            // Set error message for any request other than POST
            $msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
        }        
        
        redirect($dest, 'refresh');
    }// End of func edit_profile
    
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * User Role controller
 * 
 * @category   Controller
 * @package    Acess Control
 * @subpackage Role
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Role extends CI_Controller {

    /**
     * School id
     * 
     * @access private
     * @var int
     */
    private $school_id;
    
    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    
    private $folder_name = 'access_control';
    
    /**
     * Module Name
     * 
     * @access private
     * @var string
     */
    
    private $module_name = 'access_control';
    
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
        
        /*
         * Load models
         */
        $this->load->model("$this->folder_name/access_control_model", 'mdl');
        
        /*
         * Load language
         */
        $this->lang->load('module_access_control');
        
        /*
         * Load helper
         */
        $this->load->helper(array('validation', 'url'));
        
        // Initialize class variables
        $this->user_id = $this->main->get('user_id');
        $this->user_type = $this->main->get('user_type');
        $this->school_id = $this->main->item('school_id');
        
    }// End func __construct
    
    /**
     * Index page for the role module.	 
     */
    public function index() {
        $data = array();
        $page_name = 'role_view';
        
        // Retrieve all roles.        
        $result = $this->mdl->get_roles();
        
        switch($result['status']) {

            case DEFAULT_SUCCESS:
                $data['roles'] = $result['rs'];
                break;

            case DEFAULT_EMPTY:
                $data['roles'] = [];
                break;

            case DEFAULT_ERROR:
                $data['roles'] = [];
                $msg = $this->lang->line('operation_error');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg, true);
                break;
        }
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);        
        $this->page->build($page_content, $this->folder_name, $page_name, 'User Roles', false);       
        
    }// End of func index
    
    /**
     * Create a new user role.	 
     */
    public function create() {
        $dest = 'access/roles';
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Load the validation library
            $this->load->library('form_validation');
            
            // Run validation and process request if fields are valid.
            if($this->form_validation->run('access_create_role') != FALSE) {
               
                // Get all input values
                $fields = $this->input->post(NULL);
                
                // Prepare parameter
                $params = array(
                            'name' => $fields['role_name'],
                            'description' => $fields['role_desc'],
                            'schoolid' => $this->school_id
                        );
                
                // Call model method to perform insertion
                $result = $this->mdl->create_role($params);
                
                // Process model response
                switch($result['status']) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        // Set error message for unique constraint violation.
                        $msg = sprintf($this->lang->line('duplicate_value'), 'group name');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        // Set error message for problem creating entry.
                        $msg = $this->lang->line('create_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        // Set success message for unique constraint violation.
                        $msg = sprintf($this->lang->line('create_success'), 'User Group', '');  
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS, $msg);
                        $dest = 'access/group?id='.$result['rs'];
                        break;
                    
                    default:
                        break;
                }
            }else {
                // Set error message for invalid/incomplete fields
                $msg = $this->lang->line('validation_error');  
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
            }
            
        }else{
            // Set error message for any request other than POST
            $msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
        }
        
        // Redirect to appropriate page, showing notifiction messages if there are.
        redirect($dest);
    }// End of func create
    
    /**
     * User group information.	 
     */
    public function edit() {

        $data = array();
        $page_name = 'role_edit';
        
        $data['type'] = 'role';
        $data['id'] = $role_id = $this->input->get('id'); // @todo show 404 if null or non-int value.
        
        $ret = $this->mdl->get_role_info($role_id);
        switch($ret['status']) {
            
            case DEFAULT_SUCCESS:
                $data['info'] = $ret['rs'];
                break;

            case DEFAULT_EMPTY:
                // show 404 message.
                break;

            case DEFAULT_ERROR:
                $msg = $this->lang->line('operation_error');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg, true);
                break;
        }
        
        $ret = $this->mdl->get_role_assoc($role_id);
        switch($ret['status']) {
            
            case DEFAULT_SUCCESS:
                $data['assoc'] = $ret['rs'];
                break;

            case DEFAULT_EMPTY:
                $data['assoc'] = [];
                break;

            case DEFAULT_ERROR:
                $data['assoc'] = [];
                $msg = $this->lang->line('operation_error');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg, true);
                break;
        }
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/add_groups', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/add_perms', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/add_users', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_role', $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, 'User Roles'); 
    }// End of func details
    
    /**
     * Update role information.	 
     */
    public function update() {

        $dest = $this->input->server('HTTP_REFERER') == NULL? 'access/roles': $this->input->server('HTTP_REFERER');
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Load the validation library
            $this->load->library('form_validation');
            
            // Run validation and process request if fields are valid.
            if($this->form_validation->run('access_create_role') != FALSE) {
               
                // Get all input values
                $fields = $this->input->post(NULL);
                
                $role_id = $fields['role_id'];                
                $params = [
                    'name' => $fields['role_name'],
                    'desc' => $fields['role_desc']
                ];
                           
                // Call model method to perform update
                $result = $this->mdl->edit_role($role_id, $params);
                
                // Process model response
                switch($result['status']) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        // Set error message for unique constraint violation.
                        $msg = sprintf($this->lang->line('duplicate_value'), 'role name');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        // Set error message for problem creating entry.
                        $msg = $this->lang->line('create_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        // Set success message for unique constraint violation.
                        $msg = sprintf($this->lang->line('create_success'), 'User Role', '');  
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS, $msg);
                        break;
                    
                    default:
                        break;
                }
            }else {              
                // Set error message for invalid/incomplete fields
                $msg = $this->lang->line('validation_error');  
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
            }
            
        }else{
            // Set error message for any request other than POST
            $msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
        }
        
        redirect($dest);
    }// End of func update
    
    /**
     * Assign an object to a role.	 
     */
    public function assign($type) {
        
        $dest = $this->input->server('HTTP_REFERER') == NULL? 'access/roles': $this->input->server('HTTP_REFERER');
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Load the validation library
            $this->load->library('form_validation');
            
            // Run validation and process request if fields are valid.
            if($this->form_validation->run('access_assign') != FALSE) {
               
                // Get all input values
                $fields = $this->input->post(NULL);
                
                $role_id = $fields['obj_id'];                
                $params = [];
                               
                $meta = [
                    'parentid' => $role_id,
                    'parenttype' => 'role',
                    'childtype' => $type
                ];
                
                // TODO check posted items against appropriate table to make sure they are valid
                // Prepare parameter
                foreach($fields['items'] as $item) {
                    if($meta['childtype'] == 'user') {
                        $params[] = [
                                        'roleid' => $role_id,
                                        'userid' => $item
                                    ];
                    }elseif($meta['childtype'] == 'group') {
                        $params[] = [
                                        'parentid' => $item,
                                        'parenttype' => $meta['childtype'],
                                        'childid' => $role_id,
                                        'childtype' => 'role'
                                    ];
                    }else {
                        $params[] = [
                                        'parentid' => $role_id,
                                        'parenttype' => 'role',
                                        'childid' => $item,
                                        'childtype' => $meta['childtype'] // TODO check that type is either perm, or user
                                    ];
                    }
                }
                
                // Call model method to perform insertion
                $result = $this->mdl->assign_to_role($meta, $params);
                
                // Process model response
                switch($result['status']) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        // Set error message for unique constraint violation.
                        $msg = sprintf($this->lang->line('duplicate_value'), 'role name');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        // Set error message for problem creating entry.
                        $msg = $this->lang->line('create_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        // Set success message for unique constraint violation.
                        $msg = sprintf($this->lang->line('create_success'), 'User Role', '');  
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS, $msg);
                        break;
                    
                    default:
                        break;
                }
            }else {              
                // Set error message for invalid/incomplete fields
                $msg = $this->lang->line('validation_error');  
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
            }
            
        }else{
            // Set error message for any request other than POST
            $msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
        }
        
        // Redirect to appropriate page, showing notifiction messages if there are.
        redirect($dest);
    }// End of func create
    
    /**
     * User role information.	 
     */
    public function details() {

        $data = array();
        $page_name = 'role_details';
        
        $role_id = $this->input->get('id'); // @todo show 404 if null or non-int value.
        
        $ret = $this->mdl->get_role_info($role_id);
        switch($ret['status']) {
            
            case DEFAULT_SUCCESS:
                $data['info'] = $ret['rs'];
                break;

            case DEFAULT_EMPTY:
                // show 404 message.
                break;

            case DEFAULT_ERROR:
                $msg = $this->lang->line('operation_error');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg, true);
                break;
        }
        
        $ret = $this->mdl->get_role_assoc($role_id);
        switch($ret['status']) {
            
            case DEFAULT_SUCCESS:
                $data['assoc'] = $ret['rs'];
                break;

            case DEFAULT_EMPTY:
                $data['assoc'] = [];
                break;

            case DEFAULT_ERROR:
                $data['assoc'] = [];
                $msg = $this->lang->line('operation_error');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg, true);
                break;
        }
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'User Roles');    
    }// End of func details
    
}

/* End of file role.php */
/* Location: ./application/controllers/role.php */
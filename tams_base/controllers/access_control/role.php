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
        
    }// End func __construct
    
    /**
     * Index page for the role module.	 
     */
    public function index() {
        $data = array();
        $page_name = 'role_view';
        
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
                $result = $this->mdl->create_group($params);
                
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
     * Create a new college.	 
     */
    public function details() {
        
        $data = array();
        $page_name = 'role_details';
                
//        // Retrieve all groups 
//        $data['groups'] = $this->mdl->get_groups();
//        
//        // Retrieve groups roles 
//        $data['students'] = $this->mdl->get_roles();
//        
//        // Retrieve groups permissions 
//        $data['staffs'] = $this->mdl->get_perms();
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_role', $data, true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'User Roles');    
    }// End of func create
    
    /**
     * College information.	 
     */
    public function info($college_name) {
        $data = array();
        $page_name = 'college_info';
        
        // Format college name from url
        // Format department name from url
        $link_paths = explode('-', $college_name);
        $colid = (int)$link_paths[count($link_paths)-1];
        
        $params = array(
            'colid' => $colid
        );
        // Retrieve all department students 
        $data['info'] = $this->mdl->get_college($params);
        
        if($data['info'] == DEFAULT_NOT_EXIST) {
            redirect('error/errorNum');
        }
        
        $data['college_name'] = $this->main->get_college_name();
        
        // Retrieve all colleges 
        $data['colleges'] = $this->mdl->get_college();
        
        // Retrieve all colleges 
        $data['students'] = $this->mdl->get_college_students($params);
        
        // Retrieve all colleges 
        $data['staffs'] = $this->mdl->get_college_staffs($params);
        
        // Retrieve all colleges 
        $data['depts'] = $this->mdl->get_college_depts($params);
        
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_college', $data['college_name'], true);
        $page_content .= $this->load->view('department/partials/create_dept', $data['college_name'], true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, ucfirst($data['college_name']));    
    }// End of func info
    
}

/* End of file role.php */
/* Location: ./application/controllers/role.php */
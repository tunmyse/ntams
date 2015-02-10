<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * User Group controller
 * 
 * @category   Controller
 * @package    Acess Control
 * @subpackage Group
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Group extends CI_Controller {

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
     * Index page for the college module.	 
     */
    public function index() {
        $data = array();
        $page_name = 'group_view';
        
//        $data['college_name'] = $this->main->get_college_name();
//        
//        $data['dept_count'] = $this->mdl->get_department_count();
//        
//        // Retrieve all colleges 
//        $data['colleges'] = $this->mdl->get_college();
//        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_group', $data, true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'User Groups');       
    }// End of func index
        
    /**
     * Create a new user group.	 
     */
    public function create() {
        $dest = $this->main->item('uri');
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Load the validation library
            $this->load->library('form_validation');
            
            // Run validation and process request if fields are valid.
            if($this->form_validation->run('access_create_group')) {
                
                // Call model method to perform insertion
                $result = $this->mdl->create_group($this->input->post(NULL));
                
                // Process model response
                switch($result['status']) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        // Set error message for unique constraint violation.
                        $error_msg = sprintf($this->lang->line('duplicate_value'), 'group name');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        // Set error message for problem creating entry.
                        $error_msg = $this->lang->line('create_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        // Set error message for unique constraint violation.
                        $error_msg = $this->lang->line('name_exist');  
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS, $error_msg);
                        $dest = 'access/group?id='.$result['rs'];
                        break;
                    
                    default:
                        break;
                }
            }else {
                // Set error message for invalid/incomplete fields
                $error_msg = $this->lang->line('invalid_req_method');  
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            }
            
        }else{
            // Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
        }
        
        // Redirect to appropriate page, showing notifiction messages if there are.
        redirect($dest);
    }// End of func create
    
    /**
     * User group information.	 
     */
    public function details() {
        $data = array();
        $page_name = 'group_details';
                
//        // Retrieve all groups 
//        $data['groups'] = $this->mdl->get_groups();
//        
//        // Retrieve groups roles 
//        $data['students'] = $this->mdl->get_roles();
//        
//        // Retrieve groups permissions 
//        $data['staffs'] = $this->mdl->get_perms();
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_group', $data, true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'User Groups');    
    }// End of func details
    
    /**
     * Validate form fields.	 
     */
    public function validate_fields($received, $expected) {
        
        // Check which of the expected fields are present in the received fields array.
        $present = array_intersect(array_keys($expected), array_keys($received));
        
        // Compare size of present fields to expected fields.
        if(count($present) !== count($expected)) {
            // Set error message for incomplete form fields
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            return true;
        }        
            
        foreach($expected as $exp) {
            if($exp['required']) {
                
            }
        }
        
        if(true) {
            // Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);            
            return true;
        }
        
        return false;
    }// End of func validate_fields
    
}

/* End of file group.php */
/* Location: ./application/controllers/group.php */
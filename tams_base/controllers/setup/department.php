<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * Department controller
 * 
 * @category   Controller
 * @package    Department
 * @subpackage 
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Department extends CI_Controller {

    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    
    private $folder_name = 'setup';
    
    /**
     * Module Name
     * 
     * @access private
     * @var string
     */
    
    private $module_name = 'setup';
    
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
        $this->load->model("$this->folder_name/department_model", 'mdl');
        $this->load->model("$this->folder_name/college_model", 'col_mdl');
        
        /*
         * Load language
         */
        $this->lang->load('module_department');
        
        /*
         * Load helper
         */
        $this->load->helper(array('validation', 'url'));
        
        // Initialize class variables
        $this->user_id = $this->main->get('user_id');
        $this->user_type = $this->main->get('user_type');
        
    }// End func __construct
    
    /**
     * Index page for the department module.	 
     */
    public function index() {
        $data = array();
        $page_name = 'view_dept';
        
        $data['college_name'] = $this->main->get_unit_name();
        
        // Retrieve all departments 
        $data['depts']      = $this->mdl->get_department();
        
        // Retrieve all college
        $data['colleges']   = $this->col_mdl->get_college();
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_dept', $data, true);        
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_dept', $data, true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'Department');       
    }// End of func index
    
    
    /**
     * Create a new department.	 
     */
    public function update() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
            
            // Set expected form field names
//            $fields = array(
//                'college_name'      => array(
//                    'required' => true
//                ),
//                'college_title'     => array(
//                    'required' => true
//                ),
//                'college_code'      => array(
//                    'required' => true
//                ),
//                'college_remark'    => array(
//                    'required' => true
//                ),
//                'special'          => array(
//                    'required' => true
//                )
//            );
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'deptname'   => $form_fields['edit_dept_name'],
                    'deptcode'   => $form_fields['edit_dept_code'],
                    'remark'    => $form_fields['edit_dept_remark'],
                    'colid'     => $form_fields['edit_dept_col']
                );
                
                // Call model method to perform insertion
                $status = $this->mdl->update($params);
                
                // Process model response
                switch($status) {
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        break;
                    
                    default:
                        break;
                }
            }
            
        }else{
            // Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
        }
        
        // Redirect to deprtment page, showing notifiction messages if there are.
        redirect('department');
    }// End of func create
    
    /**
     * Create a new department.	 
     */
    public function create() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
            
            // Set expected form field names
//            $fields = array(
//                'college_name'      => array(
//                    'required' => true
//                ),
//                'college_title'     => array(
//                    'required' => true
//                ),
//                'college_code'      => array(
//                    'required' => true
//                ),
//                'college_remark'    => array(
//                    'required' => true
//                ),
//                'special'          => array(
//                    'required' => true
//                )
//            );
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'deptname'   => $form_fields['dept_name'],
                    'deptcode'   => $form_fields['dept_code'],
                    'remark'    => $form_fields['dept_remark'],
                    'colid'     => $form_fields['dept_col']
                );
                
                // Call model method to perform insertion
                $status = $this->mdl->create($params);
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        break;
                    
                    default:
                        break;
                }
            }
            
        }else{
            // Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
        }
        
        // Redirect to college page, showing notifiction messages if there are.
        redirect('department');
    }// End of func create
    
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
    }// End of func index
    
    /**
     * Department information.	 
     */
    public function info($dept_name) {
        $data = array();
        $page_name = 'dept_info';
        
        // Format department name from url
        $link_paths = explode('-', $dept_name);
        $deptid = (int)$link_paths[count($link_paths)-1];
        
        $params = array(
            'deptid' => $deptid
        );
        // Retrieve all department students 
        $data['info'] = $this->mdl->get_department($params);
        
        if($data['info'] == DEFAULT_NOT_EXIST) {
            redirect('error/errorNum');
        }
        
        $data['college_name'] = $this->main->get_college_name();
        
        // Retrieve all department students 
        $data['students'] = $this->mdl->get_dept_students($params);
        
        // Retrieve all department staffs
        $data['staffs'] = $this->mdl->get_dept_staffs($params);
        
        // Retrieve all programmes
        $data['progs'] = $this->mdl->get_dept_progs($params);
        
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_dept', $data['college_name'], true);
        $page_content .= $this->load->view('programme/partials/create_prog', $data['college_name'], true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, ucfirst($data['college_name']));    
    }// End of func info
}

/* End of file department.php */
/* Location: ./application/controllers/department.php */
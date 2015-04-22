<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * Programme controller
 * 
 * @category   Controller
 * @package    Programme
 * @subpackage 
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Programme extends CI_Controller {

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
        $this->load->model("$this->folder_name/programme_model", 'mdl');
        $this->load->model("$this->folder_name/department_model", 'dpt_mdl');
        
        /*
         * Load language
         */
        $this->lang->load('module_programme');
        
        /*
         * Load helper
         */
        $this->load->helper(array('validation', 'url'));
        
        // Initialize class variables
        $this->user_id = $this->main->get('user_id');
        $this->user_type = $this->main->get('user_type');
        
    }// End func __construct
    
    /**
     * Index page for the application.	 
     */
    public function index() {
        $data = array();
        $page_name = 'view_prog';
        
        // Retrieve departments
        $data['college_name'] = $this->main->get_unit_name();
        
        // Retrieve all colleges 
        $data['progs'] = $this->mdl->get_programme();
        
        // Retrieve departments
        $data['depts'] = $this->dpt_mdl->get_department();
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_prog', $data['depts'], true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_prog', $data['depts'], true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'Programme');       
    }// End of func index
    
    
    /**
     * Create a new programme.	 
     */
    public function create() {
        
        // Initialise data array
        $data = array();
                
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
            
            // Set expected form field names
            // Do form validation here
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
                    'progname'   => $form_fields['prog_name'],
                    'progcode'  => $form_fields['prog_code'],
                    'duration'   => $form_fields['prog_dur'],
                    'deptid'    => $form_fields['prog_dept'],
                    'registration'   => $form_fields['prog_reg'],
                    'remark'   => $form_fields['prog_remark']
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
        
        // Redirect to programme page, showing notifiction messages if there are.
        redirect('programme');
    }// End of func create

       /**
     * Create a new programme.	 
     */
    public function update() {
        
        // Initialise data array
        $data = array();
                
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST'){
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
            
            // Set expected form field names
            // Do form validation here
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
                    'progname'   => $form_fields['prog_name'],
                    'progcode'  => $form_fields['prog_code'],
                    'duration'   => $form_fields['prog_dur'],
                    'deptid'    => $form_fields['prog_dept'],
                    'registration'   => $form_fields['prog_reg'],
                    'remark'   => $form_fields['prog_remark']
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
        
        // Redirect to programme page, showing notifiction messages if there are.
        redirect('programme');
    }// End of func update
    
    
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
    
    
}

/* End of file programme.php */
/* Location: ./application/controllers/programme.php */
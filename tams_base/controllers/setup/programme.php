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
        
        $data['type'] = 'Programme';
        
        // Retrieve departments
        $data['college_name'] = $this->main->get_unit_name();
        
        // Retrieve all colleges 
        $data['progs'] = $this->mdl->get_programme();
        
        // Retrieve departments
        $depts = $this->dpt_mdl->get_department();
        $data['depts'] = $depts['status'] == \DEFAULT_SUCCESS? $depts['rs']: [];
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_prog', $data['depts'], true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_prog', $data['depts'], true);
        $page_content .= $this->load->view($this->folder_name.'/partials/delete_modal', $data['depts'], true);
        
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
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
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
        redirect('setup/programme');
    }// End of func create

    /**      
     * Update a programme.	 
     */
    public function update() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
        
            // Load the validation library
            $this->load->library('form_validation');
            
            // Run validation and process request if fields are valid.
            if($this->form_validation->run('setup_update_prog') != FALSE) {
               
                // Get parameters for entry to be updated.
                $form_fields = $this->input->post(NULL);
                $params = array(
                    'progname'   => $form_fields['prog_name'],
                    'progcode'  => $form_fields['prog_code'],
                    'duration'   => $form_fields['prog_dur'],
                    'deptid'    => $form_fields['prog_dept'],
                    'registration'   => $form_fields['prog_reg'],
                    'remark'   => $form_fields['prog_remark']
                );
                
                $fields = [['field' => 'progid', 'value' => $form_fields['edit_prog_id']]];
                
                // Call model method to perform update
                $ret = $this->mdl->update($params, $fields);
                
                // Process model response
                switch($ret['status']) {
                    
                    // Invalid arguments supplied.
                    case DEFAULT_NOT_VALID:
                        break;
                    
                    // Foreign key constraint violated.
                    case DEFAULT_EXIST:
                        break;
                    
                    // There was a problem updating the entry.
                    case DEFAULT_ERROR:
                        break;
                    
                    // Entry updated successfully.
                    case DEFAULT_SUCCESS:
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
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
        }
        
        // Redirect to programme page, showing notifiction messages if there are.
        redirect('setup/programme');
    }// End of func update
    
    /**
     * Delete a programme.	 
     */
    public function delete() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
        
            // Load the validation library
            $this->load->library('form_validation');
            
            // Run validation and process request if fields are valid.
            if($this->form_validation->run('setup_delete_section') != FALSE) {
               
                // Get id for entry to be deleted.
                $id = $this->input->post('delete_id');
                
                // Call model method to perform deletion
                $ret = $this->mdl->delete([['field' => 'progid', 'value' => $id]]);
                
                // Process model response
                switch($ret['status']) {
                    
                    // Invalid arguments supplied.
                    case DEFAULT_NOT_VALID:
                        break;
                    
                    // Foreign key constraint violated.
                    case DEFAULT_EXIST:
                        $msg = $this->lang->line('validation_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                        break;
                    
                    // There was a problem deleting the entry.
                    case DEFAULT_ERROR:
                        break;
                    
                    // Entry deleted successfully.
                    case DEFAULT_SUCCESS:
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
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
        }
        
        // Redirect to programme page, showing notifiction messages if there are.
        redirect('setup/programme');
    }// End of func delete
    
    /**
     * Programme information.	 
     */
    public function info($prog_name) {
        $data = array();
        $page_name = 'prog_info';
        
        // Format department name from url
        $link_paths = explode('-', $prog_name);
        $progid = (int)$link_paths[count($link_paths)-1];
        
        $params = array(
            'progid' => $progid
        );
        // Retrieve all department students 
        $data['info'] = $this->mdl->get_programme($params);
        
        if($data['info']['status'] == DEFAULT_NOT_EXIST) {
            redirect('error/errorNum');
        }
        
        $data['college_name'] = $this->main->get_unit_name();
        
        // Retrieve all department students 
        $data['students'] = $this->mdl->get_prog_students($params);
                        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_prog', $data['college_name'], true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'Programme');    
    }// End of func info
    
}

/* End of file programme.php */
/* Location: ./application/controllers/programme.php */
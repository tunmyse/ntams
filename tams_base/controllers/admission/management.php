<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * Admission controller
 * 
 * @category   Controller
 * @package    Admission
 * @subpackage Management
 * @author     Suleodu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Management extends CI_Controller {
    
    private $user_id;
    private $user_type;
    private $school_id;
    private $school_name;
    private $page_title;
    private $adm_type;
    
    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    private $folder_name = 'admission';
    
    /**
     * Module Name
     * 
     * @access private
     * @var string
     */
    private $module_name = 'admission';
    
    
    /*
     * Class constructor
     * 
     * @access public 
     * @retun void
     */
    public function __construct() {
        
        parent::__construct();
       
        $this->main->check_auth(
                                array(
                                        'admission' => array('admission','admission.setup.view'),
                                        
                                    )
                                );
        /*
         * Load models
         */
        $this->load->model("$this->folder_name/admission_model", 'adm_mdl');
        $this->load->model("bursary/bursary_model", 'bursary_mdl');
        
        /*
         * Load language
         */
        $this->lang->load('module_admission');
        
        
        /*
         * Load helper
         */
        $this->load->helper(array('validation', 'url', 'form'));
        
        /*
         * Load Form Validation 
         */
        $this->load->library('form_validation');
        
        // Initialize class variables
        $this->user_id = $this->main->get('user_id');
        $this->user_type = $this->main->get('user_type');
        $this->school_id = $this->main->item('school_id');
        $this->school_name = $this->main->get_school_name();
        $this->page_title = "Admission Management";
        
        
    }// End func __construct
    
    
    
    function index(){
        
        $this->main->check_auth(
                                array(
                                        'admission' => array('admission','admission.setup.view'),
                                        
                                    )
                                );
        
        $param = array(
            'status' => "open",
            'schoolid' => $this->school_id
        );
        
        
        $data['this_year'] = date('Y');
        $data['cur_adm'] = $this->adm_mdl->get_current_admission($param);
        
        $data['adm_session'] = $this->adm_mdl->get_cur_adm_session($this->school_id);
        $data['payschedules'] = $this->bursary_mdl->gets('pay_schedule', array('schoolid' => $this->school_id));
        $data['groups'] = $this->adm_mdl->get_group();
        $data['exams'] = $this->adm_mdl->get_exam();
        $data['grades'] = $this->adm_mdl->get_grade();
        $data['subjects'] = $this->adm_mdl->get_subject();
        $data['exam_subjects'] = $this->adm_mdl->get_exam_subject();
        $data['exam_grades'] = $this->adm_mdl->get_exam_grade();
        $data['admissions'] = $this->adm_mdl->get_admission($this->school_id);
        $data['admission_types'] = $this->adm_mdl->get_admission_all_type($this->school_id);
        $data['permission_group'] = $this->adm_mdl->get_perm_groups($this->school_id);
        
//        var_dump($data['permission_group']);
//        exit();
        
        $page_name = 'admission_management';
        
        //build view pade for prospective registration 
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_group', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_exam', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_exam_subject', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_subject', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_grade', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_exam_grade', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_group', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_exam', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_subject', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_exam_subject', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_grade', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_exam_grade', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_admission', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_admission', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_admission_type', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_admission_type', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/upload_help', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/delete_modal', $data, true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
    }
    
    /**
     * Create new exam group.	 
     */
    public function create_group() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'groupname'   => $form_fields['group_name'],
                    'required'   => $form_fields['group_req'],
                    'maxentries'    => $form_fields['group_max'],
                    'status'   => $form_fields['group_status']
                );
                
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_create($params, 'group');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Exam Group is', 'created', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func create_exam_group
    
    
    /**
     * Update  group.	 
     */
    public function update_group() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'groupname'   => $form_fields['edit_group_name'],
                    'required'   => $form_fields['edit_group_req'],
                    'maxentries'    => $form_fields['edit_group_max'],
                    'status'   => $form_fields['edit_group_status']
                );
                
                $id = $form_fields['edit_group_id'];
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_update($id, $params, 'group');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Exam Group is', 'updated', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func update_group
    
    /**
     * Create new exam.	 
     */
    public function create_exam() {
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'groupid'   => $form_fields['exam_group'],
                    'examname'   => $form_fields['exam_name'],
                    'shortname'   => $form_fields['exam_sname'],
                    'validyears'   => $form_fields['exam_valid'],
                    'minsubject'    => $form_fields['exam_min'],
                    'scorebased'   => $form_fields['exam_score'],
                    'status'   => $form_fields['exam_status']
                );
                
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_create($params, 'exam');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Exams is', 'created', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func create_exam
    
     
    /**
     * Update new exam .	 
     */
    public function update_exam() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'groupid'   => $form_fields['exam_group'],
                    'examname'   => $form_fields['exam_name'],
                    'shortname'   => $form_fields['exam_sname'],
                    'validyears'   => $form_fields['exam_valid'],
                    'minsubject'    => $form_fields['exam_min'],
                    'scorebased'   => $form_fields['exam_score'],
                    'status'   => $form_fields['exam_status']
                );
                
                $id = $form_fields['edit_exam_id'];
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_update($id, $params, 'exam');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Exam is', 'updated', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func create_exam_group
    
    /**
     * Create new grade.	 
     */
    public function create_grade() {
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'gradename'   => $form_fields['grade_name']
                );
                
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_create($params, 'grade');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Grade', 'created', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func create_grade
    
     /**
     * Update new Grade.	 
     */
    public function update_grade() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'gradename'   => $form_fields['grade_name']
                );
                
                $id = $form_fields['edit_grade_id'];
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_update($id, $params, 'grade');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Grade is', 'updated', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func create_exam_group
    
    /**
     * Create new Exam grade.	 
     */
    public function create_exam_grade() {
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'examid'   => $form_fields['exam_id'],
                    'gradeid'   => $form_fields['exam_grade'],
                    'gradeweight' => $form_fields['grade_weight'],
                    'gradedesc'   => $form_fields['grade_desc'],
                    
                );
                
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_create($params, 'exam_grade');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Grade added to Exam', '', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func create_grade
    
     /**
     * Update new exam group.	 
     */
    public function update_exam_grade() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'examid'   => $form_fields['exam_id'],
                    'gradeid'   => $form_fields['exam_grade'],
                    'gradeweight' => $form_fields['grade_weight'],
                    'gradedesc'   => $form_fields['grade_desc'],
                    
                );
                
                $id = $form_fields['edit_exam_grade_id'];
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_update($id, $params, 'exam_grade'); 
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Exam Grade', 'updated', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func create_exam_group
    
    /**
     * Create new subject.	 
     */
    public function create_subject() {
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'subname'   => $form_fields['subject_name']
                );
                
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_create($params, 'subject');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                         $success_msg = sprintf($this->lang->line('adm_success'),'Subject is', 'created', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
       
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
        
    }// End of func create_subject
    
    
    /**
     * Update new exam group.	 
     */
    public function update_subject() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'subname'   => $form_fields['subject_name']
                );
                
                $id = $form_fields['edit_subject_id'];
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_update($id, $params, 'subject');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Exam is', 'updated', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func create_exam_group
    
    /**
     * Create new exam subject.	 
     */
    public function create_exam_subject() {
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'examid' => $form_fields['exam_id'],
                    'subjectid'   => $form_fields['subj_id']
                );
                
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_create($params, 'exam_subject');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Subject added to Exam', 'created', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
       
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
        
    }// End of func create_exam_subject

    
    /**
     * Update new exam group.	 
     */
    public function update_exam_subject() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'examid' => $form_fields['exam_id'],
                    'subjectid'   => $form_fields['subj_id']
                );
                
                $id = $form_fields['edit_exam_subject_id'];
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_update($id, $params, 'exam_subject'); 
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Exam Subject ', 'updated', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }// End of func create_exam_group

    
    /**
     * Create Admission 
     */
    public function create_admission(){
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'displayname' => $form_fields['adm_title'],
                    'sesid'   => $form_fields['adm_session'],
                    'group_perm'   => $form_fields['group_perm'],   
                    'schoolid' => $this->school_id
                );
                
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_create($params, 'admissions');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Admission', 'created', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
       
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }
    
    
    public function update_admission($param) {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'displayname' => $form_fields['adm_title'],
                    'sesid'   => $form_fields['adm_session'],
                    'schoolid' => $this->school_id
                );
                
                $id = $form_fields['edit_admission_id'];
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_update($id, $params, 'admissions'); 
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Admission ', 'updated', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }
    /**
     * Create Admission Type
     */
    public function create_admission_type(){
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'admid' => $form_fields['adm'],
                    'type'   => $form_fields['adm_type'],
                    'utme'   => $form_fields['adm_utme'],
                    'status' => $form_fields['adm_status'],
                    'coi_app_fee' => $form_fields['coi_app_fee'],
                    'reg_app_fee' => $form_fields['reg_app_fee'],
                    
                );
                
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_create($params, 'admission_types');
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Admission Type', 'created', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
       
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }
    
    
    public function update_admission_type($param) {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
                        
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'admid' => $form_fields['adm'],
                    'type'   => $form_fields['adm_type'],
                    'utme'   => $form_fields['adm_utme'],
                    'status' => $form_fields['adm_status'],
                    'coi_app_fee' => $form_fields['coi_app_fee'],
                    'reg_app_fee' => $form_fields['reg_app_fee'],
                    'coi_acc_fee' => $form_fields['coi_acc_fee'],
                    'reg_acc_fee' => $form_fields['reg_acc_fee']
                );
                
                $id = $form_fields['edit_admission_type_id'];
                // Call model method to perform insertion
                $status = $this->adm_mdl->exam_update($id, $params, 'admission_type'); 
                
                // Process model response
                switch($status) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        $error_msg = $this->lang->line('adm_entry_exist');  
                        $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        $error_msg = $this->lang->line('adm_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        $success_msg = sprintf($this->lang->line('adm_success'),'Admission Type', 'updated', '');
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
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
        
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));
    }
    
    
    public function upload_utme(){
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            if($this->adm_mdl->adm_has_utme($form_fields['adm_type'])){
                
                if(is_uploaded_file($_FILES['filename']['tmp_name'])){
                    
                    $param = array(
                        'usertype' => 'applicant',
                        'schoolid' => $this->school_id,
                        'admtype' => $form_fields['adm_type']
                        );
                    
                    $uploaded = true;
                    $rec = array();
                    //Import uploaded file to Database	
                    $handle = fopen($_FILES['filename']['tmp_name'], "r");
                    
                    while (($data = fgetcsv($handle, 1500, ",")) !== FALSE) {
                        $rec[] = array(
                                    'user' => array(
                                                'usertypeid' => $data[0],
                                                'fname' => $data[1], 
                                                'lname' => $data[2],
                                                'mname' => $data[3],
                                                'phone' => $data[4],
                                                'email' => $data[5],
                                                'sex' => $data[15],
                                                'usertype' => $param['usertype'],
                                                'schoolid' => $param['schoolid'],
                                                'password' => $this->main->encrypt($data[1])
                                            ),
                                    'pros' => array(
                                                'userid'=>'',
                                                'jambregid' => $data[0],
                                                'admtype' => $param['admtype'],
                                                'prog1' => $data[14],
                                                'formsubmit' => 0
                                            ),
                                    'utme' => array(
                                                'userid'=>'',
                                                'regid' => $data[0],
                                                'year' => $form_fields['utme_year'],
                                                'subject' => array(
                                                                $data[6],
                                                                $data[8],
                                                                $data[10],
                                                                $data[12],
                                                            ),
                                                'score' => array(
                                                                $data[7],
                                                                $data[9],
                                                                $data[11],
                                                                $data[13],
                                                            )           
                                            ),  
                                    'perm'  => array(
                                               'groupid' => $form_fields['group_perm'],
                                               'status' => "active"
                                            ),
                                    'pay' => array(
                                                'scheduleid' => $form_fields['app_fee'],
                                                'percentage' => 0
                                    )        
                                );
                    }
                    
                    fclose($handle);
                    $status = $this->adm_mdl->upload_utme($rec);   
                    // Process model response
                    switch($status) {

                        // Unique constraint violated.
                        case DEFAULT_EXIST:
                            $error_msg = $this->lang->line('adm_entry_exist');  
                            $this->main->set_notification_message(MSG_TYPE_WARNING, $error_msg);
                            break;

                        // There was a problem creating the entry.
                        case DEFAULT_ERROR:
                            $error_msg = $this->lang->line('adm_error');  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                            break;

                        // Entry created successfully.
                        case DEFAULT_SUCCESS:
                            $success_msg = sprintf($this->lang->line('adm_success'),'UTME Result', 'Uploaded', '');
                            $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
                            break;

                        default:
                            break;
                    }
                }
                
                 
            }else{
                // Set error message for any request other than POST
                $error_msg = $this->lang->line('adm_utme_upload_error');  
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);  
            }
            
            
        }else{
            // Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);  
        }
        // Redirect to exam page, showing notifiction messages if there are.
        redirect(site_url('admission/management'));  
    }
}
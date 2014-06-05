<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * Admission controller
 * 
 * @category   Controller
 * @package    Admission
 * @subpackage Admission
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>, Suleodu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Admission extends CI_Controller {

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

        /*
         * Load libraries
         */
        
        /*
         * Load models
         */
        $this->load->model("$this->folder_name/admission_model", 'mdl');
        
        /*
         * Load language
         */
        $this->lang->load('module_admission');
        
        /*
         * Load helper
         */
        $this->load->helper(array('validation', 'url'));
        
        // Initialize class variables
        $this->user_id = $this->main->get('user_id');
        $this->user_type = $this->main->get('user_type');
        
    }// End func __construct
    
    /**
     * Index page for the admission module.	 
     */
    public function index() {
         
    }// End of func index
    
    
    /**
     * Create a new college.	 
     */
    public function create() {
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Set error to true. 
            // This should be changed only if there are no validation errors.
            $error = false;
            
            // Set expected form field names
            $fields = array(
                'college_name'      => array(
                    'required' => true
                ),
                'college_title'     => array(
                    'required' => true
                ),
                'college_code'      => array(
                    'required' => true
                ),
                'college_remark'    => array(
                    'required' => true
                ),
                'special'          => array(
                    'required' => true
                )
            );
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            // Validate form fields.
            //$error = $this->validate_fields($form_fields, $fields);
            
            // Send fields to model if there are no errors
            if(!$error) {
                $params = array(
                    'colname'   => $form_fields['college_name'],
                    'coltitle'  => $form_fields['college_title'],
                    'colcode'   => $form_fields['college_code'],
                    'remark'    => $form_fields['college_remark'],
                    'special'   => $form_fields['special']
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
        redirect('college');
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
    }// End of func validate_fields
    
    /**
     * College information.	 
     */
    public function info($college_name) {
        $data = array();
        $page_name = 'college_info';
        
        
        $this->page->build($page_content, $this->folder_name, $page_name, ucfirst($data['college_name']));    
    }// End of func info
    
    
    /*
     *---------------------------------------------------------------
     * Sule's Registration function
     *---------------------------------------------------------------
     */
    
    /**
     * Prospective Registration.	 
     */
    public function register(){
        //set page title 
        $this->page_title = 'Prospective Registration';
        
        //set session parameter 
        $session = $this->main->get('user_id');
        
        // check registration payment table to verify that 
        // the loging student has actualy make payment to proceed to registration
        $form_payment = $this->mdl->verifyRegPayment($session);
        
        if($session){
            if($form_payment){
                
                $data = $this->user_model->get_user_data();
                $data['state'] = $this->mdl->getState();
                $data['lga'] = $this->mdl->getLga();

                //Set Page name
                $page_name = 'prospective_registration';

                // check if prospective registration form is trigered 
                if($this->input->server('REQUEST_METHOD') == 'POST'){ 

                    $this->mdl->register();
                }

                //build view pade for prospective registration 
                $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
                $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
            
            }else {
                 //rediredt to Prospective dashbord if  no Registration payment 
                redirect(site_url('prospective/dashboard'));
            }
            
        }
    } // End of func register
    
    /**
     * Prospective Application page .	 
     */
    public function application() {             
        
        // Load form helper.
        $this->load->helper('form');
        
        $page_name = 'application'; 
        $data['session'] = $this->main->get_session(); 
        
        $this->load->view($this->folder_name.'/prospective/'.$page_name, $data);  
            
    }// End of func application
    
    /**
     * Process application
     */
    public function apply() {
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Run validation on form field data
            if($this->form_validation->run('pros_application') === TRUE) {

                // Get all field values.
                $form_fields = $this->input->post();

                // Check email and phone uniqueness
                $unique_email = $this->util_model->is_user_unique($form_fields['email'], 'email');
                $unique_phone = $this->util_model->is_user_unique($form_fields['phone'], 'phone');

                // Format post data from db operation
                $params = array(
                    'user' => array(
                        'fname'   => $form_fields['fname'],
                        'lname'   => $form_fields['lname'],
                        'mname'   => $form_fields['mname'],
                        'email'   => $form_fields['email'],
                        'phone'   => $form_fields['phone'],
                        'password' => $this->main->encrypt($form_fields['password'])
                    ),                
                    'pros' => array(
                        'sesid' => $this->main->item('cur_session')
                    )
                );

                if($unique_email && $unique_phone) {
                    $status = $this->mdl->create($params);

                    switch($status) {
                        case DEFAULT_ERROR:
                            $error_msg = $this->lang->line('account_faled');  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                            break;

                        case DEFAULT_SUCCESS:
                            // TODO::Send notification email
                            
                            $success_msg = $this->lang->line('account_created');  
                            $this->main->set_notification_message(MSG_TYPE_SUCCESS, $success_msg);
                            break;
                    }
                }else {
                    // Set error message for duplicate email
                    $violation = (!$unique_email)? 'email': 'phone';
                    $violation .= (!$unique_phone && !$unique_email)? ' and phone': '';
                    
                    $error_msg = sprint($this->lang->line('duplicate_value'), $violation);  
                    $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                }                   
            }
        }else{
            // Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
        }
        
        // Redirect to application page, showing notifiction messages if there are.
        redirect(site_url('admission/application'));        
        
    }// End of func apply
    
}

/* End of file admission.php */
/* Location: ./application/controllers/admission.php */
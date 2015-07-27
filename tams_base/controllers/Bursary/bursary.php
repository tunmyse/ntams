
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * Payment controller
 * 
 * @category   Controller
 * @package    Busary
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Bursary extends CI_Controller {
    
    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    private $folder_name = 'bursary';
    
    private $user_id;
    private $usertype;
    private $school_id;
    private $school_name;
    
    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    private $page_title = 'Busary';
    

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
                                        'payment' => array('payment','payment.setup'),
                                        
                                    )
                                );
        //
        
        /*
         * Load Form Helper 
         */
        $this->load->helper('form');
        
        /*
         * Load Form Validation 
         */
        $this->load->library('form_validation');
        
        
        /*
         * Load language
         */
        $this->lang->load('module_bursary');
        
        /*
         * Load payment model 
         */
        $this->load->model($this->folder_name.'/bursary_model','bsry_mdl' );
        
        /*
         * Load Pay Library  
         */
        $this->load->library('Pay/pay');
        $this->load->library('Pdf/pdf');
        
        $this->school_id = $this->main->item('school_id');
        $this->school_name = $this->main->get_school_name();
        $this->usertype = $this->main->item('user_type');
        $this->user_id = $this->main->item('user_id');
        
        //die(var_dump($this->school_id));
    }
    
    
    /**
     * choose who goes to what page
     * 
     * @return void check if the current visitor is a student or prospective 
     * if student or prospective student he/sheh will will be routed to 
     * payment page else he/she will be routed to payent setup page
     */
    public function index(){
        
        
        
    }//End of func index
    
    
    /*
    * Function Setup: this function handle the setting up of 
    * the payment processes 
    * 
    * @access public
    * @retun void
    */    
    public function management(){
       
        //pre load paysetup dependencies from database 
        $data['merchant'] = $this->gets('pay_merchant');
        $data['exceptions'] = $this->bsry_mdl->gets('pay_exception');
        $data['payschd'] = $this->bsry_mdl->gets('pay_schedule', array('schoolid' => $this->school_id));
        $data['session'] = $this->gets('session');
        $data['payhead'] = $this->gets('pay_head');
        $data['states'] = $this->bsry_mdl->gets('state');
        $data['college'] = $this->gets('college');
        $data['departments'] = $this->gets('departments');
        $data['programmes'] = $this->gets('programmes');
        $data['instalments'] = $this->gets('pay_instalment');
        $data['max_prog_duration'] = $this->bsry_mdl->gets('max_prog_duration');
        
        //die(var_dump($this->bsry_mdl->gets('pay_exception')));
        
        $page_name = 'bursary_management';
        
        //build view page for payment setup 
        $page_content = $this->load->view($this->folder_name.'/bursary/'.$page_name,$data,true);
        
        //build view page modlas 
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/create_merchant',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/edit_merchant',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/view_merchant',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/create_payhead',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/edit_payhead',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/delete_payhead',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/create_instalment',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/edit_instalment',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/create_payschedule',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/edit_payschedule',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/delete_payschedule',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/set_penalty',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/view_exception',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/bursary/partials/create_payexception',$data,true);
        
        
        
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
        
    }
    
    
    
    /**
     * @description This Controler function do all the oeration
     *              that has to do with insertion into the database.
     * @name $Sets.
     * 
     * @param type $what
     * 
     * @return type NULL
     */
    public function sets($what){
        
        switch ($what) {
            case 'merchant':
                
                    // Check for valid request method
                    if($this->input->server('REQUEST_METHOD') == 'POST') {
                        
                        $config = array(
                                    array(
                                          'field'   => 'marchname',
                                          'label'   => 'Marchant Name',
                                          'rules'   => 'required'
                                       ),
                                    array(
                                          'field'   => 'contact',
                                          'label'   => 'Contact Person',
                                          'rules'   => 'required'
                                       ),
                                    array(
                                          'field'   => 'phone',
                                          'label'   => 'Phone Number',
                                          'rules'   => 'required | numeric | integer | is_natural'
                                       ),   
                                    array(
                                          'field'   => 'email',
                                          'label'   => 'Email',
                                          'rules'   => 'required | valid_email'
                                       )
                                );

                        $this->form_validation->set_rules($config);
                        
                        if ($this->form_validation->run() == FALSE){
                            
                            // Set error message for form validation 
                            // Error and specify the field with error 
                            $error_valid_msg = validation_errors();  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                            
                        }
                        else{
                            
                            // Get all field values.
                            $form_fields = $this->input->post(NULL);
                            
                                $params = array(        
                                    'merchname' => $form_fields['marchname'],
                                    'schoolid' =>$this->main->item('school_id'),
                                    'contact' => $form_fields['contact'],
                                    'phone' => $form_fields['phone'],
                                    'email' => $form_fields['email'],
                                    'remark' => $form_fields['remark']   
                                );

                                // Call model method to perform insertion
                                $status = $this->bsry_mdl->create('merchant', $params);

                                // Process model response
                                switch($status) {

                                    // Unique constraint violated.
                                    case DEFAULT_EXIST:
                                        $error_msg = sprintf($this->lang->line('pay_entry_exist'), 'Merchant '.$param['merchname']);  
                                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                        break;

                                    // There was a problem creating the entry.
                                    case DEFAULT_ERROR:
                                        $error_msg = $this->lang->line('pay_error');  
                                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                        break;

                                    // Entry created successfully.
                                    case DEFAULT_SUCCESS:
                                         $success_msg = sprintf($this->lang->line('pay_success'),'Merchant '.$params['merchname'], 'created');
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

                    // Redirect to payment set, showing notifiction messages if there are.
                    redirect(site_url('payment/setup'));
                    
             
                
                
            break;
                
                
            case 'payhead':
                    
                    // Check for valid request method
                    if($this->input->server('REQUEST_METHOD') == 'POST') {
                        
                        $config = array(
                            array(
                                  'field'   => 'type',
                                  'label'   => 'Pay Schedule Type',
                                  'rules'   => 'required'
                               )
                            );
                        
                        $this->form_validation->set_rules($config);
                        
                        if ($this->form_validation->run() == FALSE){
                            
                            // Set error message for form validation 
                            // Error and specify the field with error 
                            $error_valid_msg = validation_errors();  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                            
                        }else{
                            
                            // Get all field values.
                            $form_fields = $this->input->post(NULL);

                            // Validate form fields.

                            // Send fields to model if there are no errors

                            $params = array(
                                'type' => $form_fields['type'],
                                'schoolid' =>$this->main->item('school_id')
                            );


                            // Call model method to perform insertion
                            $status = $this->bsry_mdl->create('payhead', $params);

                            // Process model response
                            switch($status) {

                                // Unique constraint violated.
                                case DEFAULT_EXIST:
                                    // Set warning message for duplicate entry
                                    $error_msg = sprintf($this->lang->line('pay_entry_exist'),$form_fields['type']);  
                                    $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                    break;

                                
                                // There was a problem creating the entry.
                                case DEFAULT_ERROR:
                                    
                                        $error_msg = $this->lang->line('pay_error');  
                                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                    break;

                                
                                // Entry created successfully.
                                case DEFAULT_SUCCESS:
                                        
                                        $success_msg = sprintf($this->lang->line('pay_success'), $form_fields['type'], "created");  
                                        $this->main->set_notification_message(MSG_TYPE_SUCCESS, $success_msg);
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
                
                    // Redirect to payment set, showing notifiction messages if there are.
                    redirect(site_url('bursary/admin'));
                    
                
                break;
            
                
            case 'schedule':
                
                        if($this->input->server('REQUEST_METHOD') == 'POST') {
                        
                            $config = array(
                                        array(
                                              'field'   => 'session_id',
                                              'label'   => 'Session',
                                              'rules'   => 'required'
                                           ),
                                        array(
                                              'field'   => 'pay_head',
                                              'label'   => 'Pay Head',
                                              'rules'   => 'required'
                                           ),
                                        array(
                                              'field'   => 'instalment',
                                              'label'   => 'Instalment',
                                              'rules'   => 'required'
                                           ),   
                                        array(
                                              'field'   => 'amount',
                                              'label'   => 'Amount',
                                              'rules'   => 'required |numeric'
                                           ),
                                        array(
                                              'field'   => 'user_type',
                                              'label'   => 'User Type',
                                              'rules'   => 'required'
                                           ),
                                        array(
                                              'field'   => 'pamount',
                                              'label'   => 'Penalty',
                                              'rules'   => 'required |numeric'
                                           ),
                                    );

                        $this->form_validation->set_rules($config);
                        
                        if ($this->form_validation->run() === FALSE){
                            
                            // Set error message for form validation 
                            // Error and specify the field with error 
                            $error_valid_msg = validation_errors();  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                            
                        }else{
                            
                                // Get all field values.
                                $form_fields = $this->input->post(NULL);
                                
                                
                                $params = array( 
                                    'schoolid' => $this->main->get('school_id'),
                                    'sesid' => $form_fields['session_id'],
                                    'payheadid' => $form_fields['pay_head'],
                                    'instid' => $form_fields['instalment'],
                                    'amount' => $form_fields['amount'],
                                    'penalty' => $form_fields['pamount'],
                                    'revhead' => $form_fields['revhead']
                                );


                                // Call model method to perform insertion
                                $status = $this->bsry_mdl->create('pay_schedule' , $params );

                                // Process model response
                                switch($status) {

                                    // Unique constraint violated.
                                    case DEFAULT_EXIST:
                                        
                                        // Set warning message for duplicate entry
                                        $error_msg = sprintf($this->lang->line('entry_exist'),'');  
                                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                        break;

                                    
                                    // There was a problem creating the entry.
                                    case DEFAULT_ERROR:
                                        
                                        $error_msg = $this->lang->line('pay_error');  
                                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                        break;

                                    
                                    // Entry created successfully.
                                    case DEFAULT_SUCCESS:
                                        
                                         $success_msg = sprintf($this->lang->line('pay_success'),'Schedule', 'created');
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
                    
                    // Redirect to payment set, showing notifiction messages if there are.
                    redirect(site_url('bursary/admin'));
                    
                break;
                
                
            case 'instalment':   
                    if($this->input->server('REQUEST_METHOD') == 'POST'){
                  
                    $config = array(
                            array(
                                'field'   => 'unit',
                                'label'   => 'Unit',
                                'rules'   => 'required|integer'
                             ),
                            array(
                                  'field'   => 'percentage[]',
                                  'label'   => 'Percentage',
                                  'rules'   => 'required|numeric'
                               ),
                        );
                    
                    $this->form_validation->set_rules($config);
                    
                    // Get all field values.
                    $form_fields = $this->input->post(NULL);
                    
                    if($this->form_validation->run() == FALSE){
                        
                        // Set error message for form validation 
                        // Error and specify the field with error 
                        $error_valid_msg = validation_errors();  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                        
                    }
                    else{
                        
                        $total_set_percentage = array_sum($form_fields['percentage']);
                        
                        if($total_set_percentage != 100){
                            
                            $error_percentage_msg = $this->lang->line('pay_instal_percent_error');
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_percentage_msg);
                            
                        }
                        elseif($form_fields['unit'] < 1){
                            
                            $error_unit = $this->lang->line('pay_instal_unit');
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_percentage_msg);
                            
                        }else{
                            
                           $pstg =  implode(':', $form_fields['percentage']);
                           
                            $params = array(        
                                        'unit' => $form_fields['unit'],
                                        'percentage' => $pstg, 
                                        'schoolid' => $this->main->get('school_id'),
                                    );
                           
                            // Call model method to perform insertion
                            $status = $this->bsry_mdl->create('pay_instalment' , $params );

                            // Process model response
                            switch($status) {

                                // Unique constraint violated.
                                case DEFAULT_EXIST:

                                    // Set warning message for duplicate entry
                                    $error_msg = sprintf($this->lang->line('pay_entry_exist'),'Pay Instalment '.$params['percentage']);  
                                    $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                    break;


                                // There was a problem creating the entry.
                                case DEFAULT_ERROR:

                                    break;


                                // Entry created successfully.
                                case DEFAULT_SUCCESS:

                                     $success_msg = sprintf($this->lang->line('pay_success'),'Instalment '.$params['percentage'], 'Added to pay Instalment');
                                    $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);

                                    break;


                                default:
                                    break;
                            }
                        }
                    }
                    
                }else{
                    
                    //Set error message for any request other than POST
                    $error_msg = $this->lang->line('invalid_req_method');  
                    $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                }
                
                // Redirect to payment set, showing notifiction messages if there are.
                redirect(site_url('bursary/admin'));
                
                break;
                
            default:
                break;
        }
    }
    
    
    
     /**
     * This Controler function do all the operation that has to do with  fetching data from database.
     * @name gets().
     * 
     * @param type String $what,  array $param
     * 
     * @return type Object Array
     */
    
    public function gets($what, $param = NULL){
        $result = '';
        
        switch ($what) {
            
            case 'session':
                
                $result = $this->bsry_mdl->gets('session');
                
                break;
            
            
            
            case 'pay_merchant':
                
                $result = $this->bsry_mdl->gets('merchant');
                break;
            
            
            
            case 'pay_head':
                
                $result = $this->bsry_mdl->gets('pay_head');
                break;
            
            
            
            case 'college':
                
                    $result = $this->bsry_mdl->gets('college');
                break;
            
            
            
            case 'programmes':
                
                    $result = $this->bsry_mdl->gets('programmes');
                break;
            
            
            case 'departments':
            
                    $result = $this->bsry_mdl->gets('departments');
                break;
            
            
            
            case 'pay_schedule':
                
                if(isset($param) && $param != NULL){

                    $result = $this->bsry_mdl->gets('pay_schedule', $param);
                    
                }else{
                    
                    $result = $this->bsry_mdl->gets('pay_schedule');
                }
                    
                break;
            
            
            case 'pay_instalment':
                
                    $result = $this->bsry_mdl->gets('pay_instalments');
                break;
            
            
            case 'pay_exceptions':
                
                    $result = $this->bsry_mdl->gets('pay_exception');
                break;
            
            
            case 'student_details':
                    
                    $result = $this->bsry_mdl->gets('student_details', $this->main->get('user_type_id'));
                
                break;
                
            default:
                break;
        }
        
        return $result;
    }
    
    
    
    /**
     * @description This Controler function handles the operation
     *              that has to do with  Updating data on database.
     * @name update().
     * 
     * @param type String $what,  array $param
     * 
     * @return type NULL
     */
    public function update($what, $id = NULL){
        
        switch ($what) {
            case 'merchant':
                
                    // Check for valid request method
                    if($this->input->server('REQUEST_METHOD') == 'POST') {
                        
                        $config = array(
                            array(
                                  'field'   => 'marchname',
                                  'label'   => 'Marchant Name',
                                  'rules'   => 'required'
                               ),
                            array(
                                  'field'   => 'contact',
                                  'label'   => 'Contact Person',
                                  'rules'   => 'required'
                               ),
                            array(
                                  'field'   => 'phone',
                                  'label'   => 'Phone Number',
                                  'rules'   => 'required'
                               ),   
                            array(
                                  'field'   => 'email',
                                  'label'   => 'Email',
                                  'rules'   => 'required | valid_email'
                               )
                         );

                        $this->form_validation->set_rules($config);
                        
                        if ($this->form_validation->run() == FALSE){
                            
                            // Set error message for form validation 
                            // Error and specify the field with error 
                            $error_valid_msg = validation_errors();  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                            
                        }else{
                            
                            // Get all field values.
                            $form_fields = $this->input->post(NULL);
                            
                                $params = array(        
                                    'merchname' => $form_fields['marchname'],
                                    'contact' => $form_fields['contact'],
                                    'schoolid' =>$this->main->item('school_id'),
                                    'phone' => $form_fields['phone'],
                                    'email' => $form_fields['email'],
                                    'remark' => $form_fields['remark'], 
                                    'mid' => $form_fields['mid']
                                );
                                
                                

                                // Call model method to perform update
                                $status = $this->bsry_mdl->update('merchant', $params);

                                // Process model response
                                switch($status) {

                                    // Unique constraint violated.
                                    case DEFAULT_EXIST:
                                            $nochange_made_msg = sprintf($this->lang->line('pay_nochanges'),'Merchant '.$form_fields['marchname'] );  
                                            $this->main->set_notification_message(MSG_TYPE_ERROR, $nochange_made_msg);
                                        break;

                                    // There was a problem creating the entry.
                                    case DEFAULT_ERROR:
                                        
                                            $error_msg = $this->lang->line('pay_error');  
                                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                        break;

                                    // Entry created successfully.
                                    case DEFAULT_SUCCESS:
                                        
                                            $success_msg = sprintf($this->lang->line('pay_success'),'Merchant '.$params['merchname'], 'Updated');
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

                    // Redirect to payment set, showing notifiction messages if there are.
                    redirect(site_url('setup/payment/setup'));
                
            break;
                
                
            case 'payhead':
                
                // Check for valid request method
                    if($this->input->server('REQUEST_METHOD') == 'POST') {
                        
                        $config = array(
                                    array(
                                          'field'   => 'type',
                                          'label'   => 'Pay Schedule Type',
                                          'rules'   => 'required'
                                       )
                                    );
                        
                        $this->form_validation->set_rules($config);
                        
                        if ($this->form_validation->run() == FALSE){
                            
                            // Set error message for form validation 
                            // Error and specify the field with error 
                            $error_valid_msg = validation_errors();  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                            
                        }
                        else{
                            // Get all field values.
                            $form_fields = $this->input->post(NULL);
                            
                                $params = array(        
                                    'type' => $form_fields['type'],
                                    'payheadid' => $form_fields['id'],
                                    'schoolid' => $form_fields['schoolid']
                                );
                                    //die(var_dump($params));
                            // Call model method to perform update
                                $status = $this->bsry_mdl->update('pay_head', $params);

                                // Process model response
                                switch($status) {

                                    // Unique constraint violated.
                                    case DEFAULT_EXIST:
                                            $nochange_made_msg = sprintf($this->lang->line('pay_entry_exist'),'Pay Head '.$form_fields['type'] );  
                                            $this->main->set_notification_message(MSG_TYPE_ERROR, $nochange_made_msg);
                                        break;

                                    // There was a problem creating the entry.
                                    case DEFAULT_ERROR:
                                        
                                            $error_msg = $this->lang->line('pay_error');  
                                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                        break;

                                    // Entry created successfully.
                                    case DEFAULT_SUCCESS:
                                        
                                            $success_msg = sprintf($this->lang->line('pay_success'),'Pay Head '.$params['type'], 'Updated');
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
                
                    // Redirect to payment set, showing notifiction messages if there are.
                    redirect(site_url('bursary/admin'));
                break;
            
                
            case 'schedule':
                
                    if($this->input->server('REQUEST_METHOD') == 'POST') {
                        $config = array(
                            array(
                                  'field'   => 'session',
                                  'label'   => 'Session',
                                  'rules'   => 'required'
                               ),
                            array(
                                  'field'   => 'payhead',
                                  'label'   => 'Pay Head',
                                  'rules'   => 'required'
                               ),
                            array(
                                  'field'   => 'instalment',
                                  'label'   => 'Instalment',
                                  'rules'   => 'required'
                               ),   
                            array(
                                  'field'   => 'amount',
                                  'label'   => 'Amount',
                                  'rules'   => 'required |numeric'
                               )
                         );

                        $this->form_validation->set_rules($config);
                        
                        if ($this->form_validation->run() == FALSE){
                            
                            // Set error message for form validation 
                            // Error and specify the field with error 
                            $error_valid_msg = validation_errors();  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                            
                        }else{
                            
                            // Get all field values.
                            $form_fields = $this->input->post(NULL);

                                $params = array(        
                                    'sesid' => $form_fields['session'],
                                    'payheadid' => $form_fields['payhead'],
                                    'instid' => $form_fields['instalment'],
                                    'amount' => $form_fields['amount'],
                                    'scheduleid' => $form_fields['id']
                                        
                                );


                                // Call model method to perform insertion
                                $status = $this->bsry_mdl->update('pay_schedule' , $params );

                                // Process model response
                                switch($status) {

                                    // Unique constraint violated.
                                    case DEFAULT_EXIST:
                                        
                                        // Set warning message for duplicate entry
                                        $error_msg = sprintf($this->lang->line('entry_exist'),'');  
                                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                        break;

                                    
                                    // There was a problem creating the entry.
                                    case DEFAULT_ERROR:
                                        
                                        break;

                                    
                                    // Entry created successfully.
                                    case DEFAULT_SUCCESS:
                                        
                                         $success_msg = sprintf($this->lang->line('success'),'Schedule', 'created');
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
                    
                    // Redirect to payment set, showing notifiction messages if there are.
                    redirect(site_url('bursary/admin'));
                break;
                
            
            case 'instalment':
                
                if($this->input->server('REQUEST_METHOD') == 'POST'){
                  
                    $config = array(
                            array(
                                'field'   => 'unit',
                                'label'   => 'Unit',
                                'rules'   => 'required|integer'
                             ),
                            array(
                                  'field'   => 'percentage[]',
                                  'label'   => 'Percentage',
                                  'rules'   => 'required|numeric'
                               ),
                        );
                    
                    $this->form_validation->set_rules($config);
                    
                    // Get all field values.
                    $form_fields = $this->input->post(NULL);
                    
                    if($this->form_validation->run() == FALSE){
                        
                        // Set error message for form validation 
                        // Error and specify the field with error 
                        $error_valid_msg = validation_errors();  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                        
                    }
                    else{
                        
                        $total_set_percentage = array_sum($form_fields['percentage']);
                        
                        if($total_set_percentage != 100){
                            
                            $error_percentage_msg = $this->lang->line('pay_instal_percent_error');
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_percentage_msg);
                            
                        }
                        elseif($form_fields['unit'] < 1){
                            
                            $error_unit = $this->lang->line('pay_instal_unit');
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_percentage_msg);
                            
                        }else{
                            
                           $pstg =  implode(' : ', $form_fields['percentage']);
                           
                            $params = array(        
                                        'unit' => $form_fields['unit'],
                                        'percentage' => $pstg,  
                                    );
                           
                            // Call model method to perform insertion
                            $status = $this->bsry_mdl->create('pay_instalment' , $params );

                            // Process model response
                            switch($status) {

                                // Unique constraint violated.
                                case DEFAULT_EXIST:

                                    // Set warning message for duplicate entry
                                    $error_msg = sprintf($this->lang->line('pay_entry_exist'),'Pay Instalment '.$params['percentage']);  
                                    $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                    break;


                                // There was a problem creating the entry.
                                case DEFAULT_ERROR:

                                    break;


                                // Entry created successfully.
                                case DEFAULT_SUCCESS:

                                     $success_msg = sprintf($this->lang->line('pay_success'),'Instalment '.$params['percentage'], 'Added to pay Instalment');
                                    $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);

                                    break;


                                default:
                                    break;
                            }
                        }
                    }
                    
                }else{
                    
                    //Set error message for any request other than POST
                    $error_msg = $this->lang->line('invalid_req_method');  
                    $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                }
                
                // Redirect to payment set, showing notifiction messages if there are.
                redirect(site_url('bursary/admin'));
                
                break;
                
            default:
                break;
        }
    }
    
    
    
    /**
     * 
     * This function handles the Delete operation 
     * 
     * @name deletes.
     * 
     * @param string $what
     * @param array $param
     * 
     * @return NULL
     */
    public function delete($what, $param = NULL){
        
        switch ($what) {
            case 'payhead':
                

                break;

            default:
                break;
        }
    }
    
    
    public function activate_penalty(){
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {

            $config = array(
                            array(
                                  'field'   => 'status',
                                  'label'   => 'Penalty Status',
                                  'rules'   => 'required'
                               )
                        );

            $this->form_validation->set_rules($config);

            if ($this->form_validation->run() == FALSE){

                /*
                 * Set error message for form validation 
                 * Error and specify the field with error  
                 */
                $error_valid_msg = validation_errors();  
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);

            }
            else{

                // Get all field values.
                $form_fields = $this->input->post(NULL);

                $params = array(        
                                'penalty_status' => $form_fields['status'],
                                'scheduleid' => $form_fields['schedule_id']
                            );



                // Call model method to perform update
                $status = $this->bsry_mdl->update('schedule_penalty', $params);

                // Process model response
                switch($status) {

                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                            $nochange_made_msg = sprintf($this->lang->line('pay_nochanges'),'Merchant '.$form_fields['marchname'] );  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $nochange_made_msg);
                        break;

                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:

                            $error_msg = $this->lang->line('pay_error');  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                        break;

                    // Entry created successfully.
                    case DEFAULT_SUCCESS:

                            $success_msg = sprintf($this->lang->line('pay_success'),'Penalty', 'Activated ');
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

        // Redirect to payment set, showing notifiction messages if there are.
        redirect(site_url('bursary/admin'));
    }
    
    
    public function assign_schedule(){
        $data['users'] = array();
        $page_name = 'assign_schedule';
        $this->page_title = 'Assign Schedule';
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('formname') == 'filter') {
            
            $config = array(
                            array(
                                'field'   => 'user_type',
                                'label'   => 'User Type',
                                'rules'   => 'required'
                             ),
                            
                        );     
            $this->form_validation->set_rules($config);
            
            if($this->form_validation->run() == FALSE){
                        
                // Set error message for form validation 
                // Error and specify the field with error 
                $error_valid_msg = validation_errors();  
                $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                
                redirect(site_url('bursary/assign'));
                exit();
                        
            }
            else{

                // Get all field values.
                $form_fields = $this->input->post(NULL);
                
                    
                $param = array(
                        'schoolid' => $this->school_id,
                        'usertype' => $form_fields['user_type'],
                        'college' => $form_fields['college'],
                        'department'=> $form_fields['department'],
                        'programme' => $form_fields['programme'],
                        'level' => $form_fields['level'],
                        'state' => $form_fields['state'],
                        'adm_type' => $form_fields['adm_type'],
                        'coi' => (isset($form_fields['coi'])) ? $form_fields['coi'] : '',
                        'session' => $form_fields['session']
                        );
                
                $data['users'] = $this->bsry_mdl->filter_users($param);
                //die(var_dump($data['users']));
            }
            
        } 
        
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST' && $this->input->post('formname') == 'assign') {
            $rec = array();
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
                //die(var_dump($form_fields));
            
            foreach ($form_fields['userid'] AS $dat):
                
                $values = array(
                        'userid'=> $dat,
                        'scheduleid' =>  $form_fields['scheduleid']
                    );
                    array_push($rec, $values);
                    
            endforeach;
            
            $this->bsry_mdl->assign_schedule($rec);
            
        }
        
        
        
        $data['session'] = $this->bsry_mdl->gets('session', array('schoolid' => $this->school_id));
        $data['payschd'] = $this->bsry_mdl->gets('pay_schedule', array('schoolid' => $this->school_id));
        $data['states'] = $this->bsry_mdl->gets('state');
        $data['college'] = $this->gets('college');
        $data['departments'] = $this->gets('departments', array('schoolid' => $this->school_id));
        $data['programmes'] = $this->bsry_mdl->gets('programmes',array('schoolid' => $this->school_id));
        $data['instalments'] = $this->gets('pay_instalment');
        $data['max_prog_duration'] = $this->bsry_mdl->gets('max_prog_duration');
        $data['adm_type'] = $this->bsry_mdl->gets('adm_type', array('schoolid' => $this->school_id));
        
       //die(var_dump($data));
        
        $page_content = $this->load->view($this->folder_name."/bursary/{$page_name}",$data,true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
    }
    
    
    
    
    
    /**
     * Generate invoice of the specified payment
     * @access public
     * @name $invoice
     * @return void 
     */
    public function invoice(){
        
        //die(var_dump());
        $page_name = 'invoice';
        
        $this->load->helper('num2word');
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get Student details
            $data['student_details'] = $this->bsry_mdl->get_user_details($this->usertype, $this->user_id);
            
            //die(var_dump($data['student_details']));
            
            // Get all form field values.
            $form_fields = $this->input->post(NULL);
            
            
           
            
            $pay_param = array(
                        'percent' => $form_fields['percentage'],
                        'schoolid' => $this->school_id,
                        'can_name' => $data['student_details']['fname'] .' '. $data['student_details']['lname']. ' '.$data['student_details']['mname'],
                        'scheduleid' => $form_fields['scheduleid'],
                        'scheduletype' => $form_fields['scheduletype'],
                        'sessionname' => $form_fields['sessionname'],
                        'sessionid' => $form_fields['sessionid'],
                        'penalty_status' => $form_fields['penalty_status'],
                        'penalty' => $form_fields['penalty'],
                        'userid' => $this->main->item('user_id'),
                        "revenuehead" => $form_fields['revenue_head'],
                        "payid" => $form_fields['payid']
                        );
            
            if($form_fields['penalty_status'] == "active"){
                
                //get the Calculated percentage of the amount to me paid if Penalty is active
                $pay_param['amount'] = (($form_fields['amount'] * $form_fields['percentage']) / 100) + $form_fields['penalty'];
                $pay_param['amount2word'] = convert_number_to_words((double)$pay_param['amount']);
                
            }else{
                
                //get the Calculated percentage of the amount to me paid if Penalty is Inactive 
                $pay_param['amount'] = (($form_fields['amount'] * $form_fields['percentage']) / 100);
                $pay_param['amount2word'] = convert_number_to_words((double)$pay_param['amount']);
                
            }
            
            //die(var_dump($pay_param));
            
            $data['form_fields'] = $pay_param;
            
            //build view page for Payment Invoice  
            $page_content = $this->load->view($this->folder_name.'/bursary/'.$page_name, $data, true);
            $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
        }
        else{

           // Set error message for any request other than POST
           $error_msg = $this->lang->line('invalid_req_method');  
           $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg, TRUE);   
           
           $this->index();
        }
             
        
    }
    
    
    
    public function pending($userid = TRUE){
//      var_dump($a);
//      exit();
        
        if($userid){
            $visitor = $userid;
        }
        
        $visitor = $this->user_id;
        
        $data['schedule'] = $this->bsry_mdl->get_pending_payment($visitor);
        $data['pay_history'] = $this->bsry_mdl->get_pay_history($visitor);
        //die(var_dump($data['schedule']));
        $page_name = "pending_pay";
        $this->page_title = 'Pendingn Payment';
      
        $page_content = $this->load->view($this->folder_name.'/bursary/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );  
    }
    
    
    
    public function paynow($scheduleid, $payid){
        
        $hist_pcnt = array();
        $tot = 0;
        
        $param = array(
                    'scheduleid'=>$scheduleid,
                    'schoolid' => $this->school_id,
                    'userid' => $this->user_id
                );
        
        $hist = $this->bsry_mdl->gets('my_pay_history',$param);
        
        foreach ($hist as $hs):
            array_push($hist_pcnt, $hs['percentage']);
            $tot = $tot + $hs['percentage'];
        endforeach;
        
        $sch = $this->bsry_mdl->gets('pay_schedule',$param);
        
        //die(var_dump($sch ));
        
        $data['schedule'] = $sch;
        $data['schedule']['payid'] = $payid;
   
        $a = $hist_pcnt;
        $b = explode(':', $sch['percentage']);

        foreach ($a as $key => $value) {
            foreach($b as $k => $v){
                if($value == $v){
                    unset($b[$k]);
                    break;
                }
            }
        }
        if($sch['penalty_status'] == 'active'){
            $data['penalty_percentage'] = (100 - $tot);
        }
        
        $data['percentage'] = $b;
        $data['total_percent_paid'] = $tot;
        
       //die(var_dump( $data['percentage']));
        $page_name = 'paynow';
        
        //build view page for pay Now 
        $page_content = $this->load->view($this->folder_name.'/bursary/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
    }
    
    
    public function process_payment(){
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            //die(var_dump($form_fields));
            
            //Set Requiered parameter to be pass to merchant payment process
            $parameter = array(
                                'schedule_id' => $form_fields['schedule_id'],
                                'school_id' => $form_fields['school_id'],
                                'percentage' => $form_fields['percentage'],
                                'schedule_type' => $form_fields['schedule_type'],
                                'session_name' => $form_fields['session_name'],
                                'session_id' => $form_fields['session_id'],
                                'penalty' => $form_fields['penalty'],
                                'user_id' => $form_fields['user_id'],
                                'amount' => $form_fields['amount'],
                                'revenue_head' => $form_fields['revhead'],
                                'payid' => $form_fields['payid']
                        );
         
            //die(var_dump($parameter));
            //initiate pay process : Send the parameter to pay merchant
            $this->pay->process($parameter);
            
            
        }else{
            
            //Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            
            // Redirect to payment set, showing notifiction messages if there are.
            redirect(site_url('payment/myschedule'));
        } 
        
    }
    
    
    
    public function receipt($orderid, $format = FALSE){
        $page_name ='receipt';
        
        // Get transaction details
        $data['trans_details'] = $this->bsry_mdl->get_receipt($orderid);
        //$data['trans_details']['amt2word'] = convert_number_to_words((double)($data['trans_details']['amt'] + $data['trans_details']['penalty']));
        
      
        
        //build view page for Receipt 
        $page_content = $this->load->view($this->folder_name.'/bursary/'.$page_name, $data, true);
        //$this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
        $this->pdf->make_file($page_content, $this->school_name['full'],'Ijebu-ode', 'status' );   
    }
    
    
    
}
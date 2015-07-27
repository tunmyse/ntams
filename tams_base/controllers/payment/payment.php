
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * Payment controller
 * 
 * @category   Controller
 * @package    Payment
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Payment extends CI_Controller {
    
    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    private $folder_name = 'payment';
    
    private $user_id;
    private $usertype;
    private $school_id;
    
    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    private $page_title = 'Payment';
    

    /*
    * Class constructor
    * 
    * @access public 
    * @retun void
    */
    public function __construct() {

        parent::__construct();
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
        $this->lang->load('module_payment');
        
        /*
         * Load payment model 
         */
        $this->load->model($this->folder_name.'/payment_model','pay_mdl' );
        
        /*
         * Load Pay Library  
         */
        $this->load->library('Pay/pay');
        
        $this->school_id = $this->main->item('school_id');
        $this->usertype = $this->main->item('user_type');
        $this->user_id = $this->main->item('user_id');
    }
    
    
    /**
     * choose who goes to what page
     * 
     * @return void check if the current visitor is a student or prospective 
     * if student or prospective student he/sheh will will be routed to 
     * payment page else he/she will be routed to payent setup page
     */
    public function index(){
        
        //Set eligible visitor to page 
        $visitor = array('student', 'applicant');
        
        $user_type = $this->main->get("user_type");
        
        if(in_array($user_type, $visitor)){
            
            $this->user_schedule();
            
        }else{
            
            $this->setup();
        }
       
        
    }//End of func index
    
    
    /*
    * Function Setup: this function handle the setting up of 
    * the payment processes 
    * 
    * @access public
    * @retun void
    */    
    public function setup(){
        $this->main->check_auth(
                                array(
                                        'payment' => array('payment','payment.setup', 'payment.setup.view'),
                                        
                                    )
                                );
        //pre load paysetup dependencies from database 
        $data['merchant'] = $this->gets('pay_merchant');
        $data['payschd'] = $this->gets('pay_schedule');
        $data['exceptions'] = $this->gets('pay_exceptions');
        $data['session'] = $this->gets('session');
        $data['payhead'] = $this->gets('pay_head');
        $data['states'] = $this->pay_mdl->gets('state');
        $data['college'] = $this->gets('college');
        $data['departments'] = $this->gets('departments');
        $data['programmes'] = $this->gets('programmes');
        $data['instalments'] = $this->gets('pay_instalment');
        $data['max_prog_duration'] = $this->pay_mdl->gets('max_prog_duration');
        
        //die(var_dump($this->pay_mdl->gets('pay_exception')));
        
        $page_name = 'payment_management';
        
        //build view page for payment setup 
        $page_content = $this->load->view($this->folder_name.'/'.$page_name,$data,true);
        
        //build view page modlas 
        $page_content .= $this->load->view($this->folder_name.'/partials/create_merchant',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_merchant',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/partials/view_merchant',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/partials/create_payhead',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_payhead',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/partials/delete_payhead',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/partials/create_instalment',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_instalment',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/partials/create_payschedule',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_payschedule',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/partials/delete_payschedule',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/partials/set_penalty',$data,true);
        
        $page_content .= $this->load->view($this->folder_name.'/partials/view_exception',$data,true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_payexception',$data,true);
        
        
        
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
        
    }
    
    
    
   /*
    * Function Setup: this function handle the setting up of 
    * the payment processes 
    * 
    * @access public 
    * @retun void
    */
    public function payinfo(){
        
        
        
        $page_name = 'payment_info';
        
        //build view page for payment 
        $page_content = $this->load->view($this->folder_name.'/'.$page_name,'',true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
    }
    
    
   
    
    
    
    private function has_exceptions($user_rec){
        switch ($user_rec){
            
        }
        
    }
    /**
     * This is call to begin the payment process of user 
     * 
     * @param type $scheduleid
     */
    public function user_paynow($scheduleid){
        switch($this->usertype){
            case 'applicant':
                
                break;
            case 'student':
                break;
            case 'staff':
                break;
            case 'admin':
                break;
            default:
                break;
        }
        
    }
    
    /*
    * Function Pay: this function handle how student make thier payment 
    * and check thier pay history
    * 
    * @name pay
    * @access public 
    * @retun void
    */
    public function myschedule(){
        
        
        $this->main->check_auth(
                                array(
                                        'payment' => array('payment')
                                    )
                                );
        
        $data = array();
        $page_name = 'payment';
        //Get user type
        $user_type = $this->main->item('user_type');
        
        
        switch ($user_type) {
            
                case 'prospective':
                    echo "prospective";

                    break;

                case 'student':
                    // Set User session parameters
                    if(!$this->main->get('level')){

                        $student_details = $this->pay_mdl->gets('student_details', $this->main->item('user_id'));

                        $this->main->set('level',  $student_details['level'] );
                        $this->main->set('colid',  $student_details['colid'] );
                        $this->main->set('deptid',  $student_details['deptid'] );
                        $this->main->set('progid',  $student_details['progid'] );
                        $this->main->set('usertype', $student_details['usertype']);

                    }
        
                    // Get pay schedule base on the session_parameters
                    $session_param = array(
                                           "level" => $this->main->get('level'),
                                           "colid" => $this->main->get('colid'),
                                           "deptid" => $this->main->get('deptid'),
                                           "progid" => $this->main->get('progid')
                                        );
        
       
                    $to_pay = $this->pay_mdl->gets('my_schedule');
                    $my_pending_payment = array();
                    /*
                     * Loop throug all the schedule and get the most specific for the loged in user 
                     */
                    foreach ($to_pay as $val){

                        if( ($val['eligible'] == 'all' && $val['eligtype'] == 'all' && in_array($session_param['level'], json_decode($val['eliglevel'])))
                                ||
                                ($val['eligible'] == 'college' && in_array($session_param['colid'], json_decode($val['eligtype'])) && in_array($session_param['level'], json_decode($val['eliglevel'])))
                                ||
                                ($val['eligible'] == 'department' && in_array($session_param['deptid'], json_decode($val['eligtype'])) && in_array($session_param['level'], json_decode($val['eliglevel'])))
                                ||
                                ($val['eligible'] == 'programme' && in_array($session_param['progid'], json_decode($val['eligtype'])) && in_array($session_param['level'], json_decode($val['eliglevel'])))){

                            array_push($my_pending_payment, $val);
                        }
                    }
                    //var_dump($my_pending_payment);
        
                    $param['userid'] = $this->main->item('user_id');

                    $data['my_pay_schedule'] = $my_pending_payment;

                    $data['my_pay_history'] = $this->pay_mdl->gets('my_pay_history', $param);
           
        
                    break;

                case 'admin':
                    echo "admin";

                    break;

                default:
                    break;
            }
       
       
        
        
        //build view page for payment 
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
        
    }
    
    
    
    /*
     * Get user eligible payment schedule
     */
    public function user_schedule($id = NULL){
        $elig_schedule = array();
        
        $user_details = $this->pay_mdl->get_user_details($this->usertype, $this->user_id);
        //die(var_dump($user_details));
        
        $schedule_param = array(
                    "user_id" => $this->user_id, 
                    "user_type" => $this->usertype,
                    "school_id" => $this->school_id,
                    "sesid" => $user_details['sesid']
                );
        
        $excep_param = array(
                        'usertype' => $user_details['usertype'],
                        'colid'=> $user_details['colid'],
                        'deptid' => $user_details['deptid'],
                        'progid' => ($user_details['usertype'] == 'applicant')? $user_details['prog1'] : $user_details['progid'],
                        'type' => ($user_details['usertype'] == 'applicant')? $user_details['type'] : "",
                        'coi'=>($user_details['usertype'] == 'applicant')? $user_details['coi'] : "",
                        'stid' => $user_details['stid'],
                        'level' => ($user_details['usertype'] == 'student')? $user_details['level'] : "",
                    );
        
        
       
                
        //die(var_dump());
        
        $page_name = 'payment';
        
        $my_schedule = $this->pay_mdl->user_schedule($schedule_param);
        
        //die(var_dump($my_schedule));
        
        foreach($my_schedule as $sch):
            
            if($sch['exceptions'] == 'yes' && $this->pay_mdl->get_user_exceptions($excep_param, $sch['scheduleid'])['status'] == TRUE){
                array_push($elig_schedule, $sch);
                continue;
            }else{
                array_push($elig_schedule, $sch);
                continue;
            } 
            
        endforeach;
        
        //die(var_dump($elig_schedule));
        
        $data['elig_schedule'] = $elig_schedule;
        //build view page for payment 
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
    }
    
    
    /*
    * Function Pay: this function handle how student make thier payment 
    * and check thier pay history
    * 
    * @name pay
    * @access public 
    * @return void
    */  
    public function paynow1($scheduleid){
        //die(var_dump($this->usertype));
        $user_details = $this->pay_mdl->get_user_details($this->usertype, $this->user_id);
        
        $excep_param = array(
                        'usertype' => $user_details['usertype'],
                        'colid'=> $user_details['colid'],
                        'deptid' => $user_details['deptid'],
                        'progid' => ($user_details['usertype'] == 'applicant')? $user_details['prog1'] : $user_details['progid'],
                        'type' => ($user_details['usertype'] == 'applicant')? $user_details['type'] : "",
                        'coi'=>($user_details['usertype'] == 'applicant')? $user_details['coi'] : "",
                        'stid' => $user_details['stid'],
                        'level' => ($user_details['usertype'] == 'student')? $user_details['level'] : "",
                    );
        $excep = $this->pay_mdl->get_user_exceptions($excep_param, $scheduleid)['rs'];
        
        //set pay history parameter
        $pay_hist_param = array(
                                "scheduleid" => $scheduleid,
                                "userid" => $user_details['userid'],
                                "status" => "'APPROVED'"
                            );
        $my_pay_hist =  $this->pay_mdl->gets('my_pay_history', $pay_hist_param );
                
        $data['my_paying'] = '';
        
        
        switch ($this->usertype) {
            case 'applicant':
                

                break;
            case 'student':
                $hist_perc = array();
                $tot = 0;
                $total_paid = 0;


                // Set User session parameters
                if(!$this->main->get('level')){

                    $student_details = $this->pay_mdl->gets('student_details', $this->main->item('user_id'));

                    $this->main->set('level',  $student_details['level'] );
                    $this->main->set('colid',  $student_details['colid'] );
                    $this->main->set('deptid',  $student_details['deptid'] );
                    $this->main->set('progid',  $student_details['progid'] );
                    $this->main->set('usertype', $student_details['usertype']);
                }


                //set pay history parameter
                $pay_hist_param = array(
                                        "scheduleid" => $scheduleid,
                                        "userid" => $this->main->item('user_id'),
                                        "status" => "'APPROVED'"
                                    );
                $my_pay_hist =  $this->pay_mdl->gets('my_pay_history', $pay_hist_param );



                // get the total sum of last payment and percentage 
                if(!empty($my_pay_hist)){

                    foreach($my_pay_hist as $key => $val){

                        $hist_perc[$key] = $my_pay_hist[$key]['percentage'];

                        $tot = $tot + $my_pay_hist[$key]['percentage'];
                        $total_paid = $total_paid + $my_pay_hist[$key]['amt'];
                    }    
                }

                // Get pay schedule base on the session_parameters
                $session_param = array( 
                                        "scheduleid" => $scheduleid,
                                        "level" => $this->main->get('level'),
                                        "colid" => $this->main->get('colid'),
                                        "deptid" => $this->main->get('deptid'),
                                        "progid" => $this->main->get('progid'),
                                        "usertype" => $this->main->get('usertype')
                                    );



                $schedule = $this->pay_mdl->gets('pay_schedule', $session_param);

                //var_dump($schedule);

                /*
                 *  check if schedule have exceptions
                 */
                if($schedule['exceptions'] == 'Yes'){

                    $excep = $this->pay_mdl->gets('my_pay_exception', $session_param);

                    if(is_array($excep) && !empty($excep)){

                        foreach($excep  as $key => $value){

                            if($excep[$key]['unittype'] == 'programme'){

                                $to_pay = array();
                                array_push($to_pay, $excep[$key]);

                                break;

                            }elseif($excep[$key]['unittype'] == 'department'){

                                $to_pay = array();
                                array_push($to_pay, $excep[$key]);

                                break;

                            }elseif($excep[$key]['unittype'] == 'college'){

                                $to_pay = array();
                                array_push($to_pay, $excep[$key]);

                                break; 
                            }   

                        }

                        $my_paying = array(
                                        "schedule_id" => $to_pay[0]['scheduleid'],
                                        "schedule_type" => $to_pay[0]['type'],
                                        "exception_id" => $to_pay[0]['exceptionid'],
                                        "session_name" => $to_pay[0]['sesname'],
                                        "paying_amount" => $to_pay[0]['ex_amount'],
                                        "school_id" => $to_pay[0]['schoolid'],
                                        "session_id" => $this->main->item('cur_session'),
                                        "penalty" => ($schedule['penalty_status'] == 'active')? $schedule['penalty'] : 0,
                                        "penalty_status" => $schedule['penalty_status'],
                                        "adm_status" => $to_pay[0]['admstatus'],
                                        "level" => $to_pay[0]['level'],
                                        "payer_type" => $to_pay[0]['payertype'],
                                        "total_percent_paid" => $tot,
                                        "total_paid" => $total_paid,
                                        "revenue_head" => $schedule['revhead']
                                     );

                        if($schedule['penalty_status'] == 'active'){

                            $my_paying['penalty_percentage'] = (100 - $my_paying['total_percent_paid']);
                            $my_paying['paying_amount'] = (($my_paying['paying_amount'] + $schedule['penalty']) - $total_paid);

                        }else{

                            $percentage_arr = explode(':', $to_pay[0]['percentage']);

                            $a = $hist_perc;
                            $b = $percentage_arr;

                            foreach ($a as $key => $value) {
                                foreach($b as $k => $v){
                                    if($value == $v){
                                        unset($b[$k]);
                                        break;
                                    }
                                }
                            }

                           $my_paying['percentage'] = $b;

                        }// End of penalty Check


                    }else{

                        $to_pay = array();
                        array_push($to_pay, $schedule);

                        $my_paying = array(
                                            "schedule_id" => $to_pay[0]['scheduleid'],
                                            "schedule_type" => $to_pay[0]['type'],
                                            "exception_id" => NULL,
                                            "session_name" => $to_pay[0]['sesname'],
                                            "paying_amount" => $to_pay[0]['amount'],
                                            "penalty" => ($schedule['penalty_status'] == 'active')? $schedule['penalty'] : 0,
                                            "penalty_status" => $schedule['penalty_status'],
                                            "school_id" => $to_pay[0]['schoolid'],
                                            "session_id" => $this->main->item('cur_session'),
                                            "adm_status" => NULL,
                                            "level" => NULL,
                                            "payer_type" => NULL,
                                            "total_percent_paid" => $tot,
                                            "revenue_head" => $schedule['revhead']
                                         );


                        if($schedule['penalty_status'] == 'active'){

                            $my_paying['penalty_percentage'] = (100 - $my_paying['total_percent_paid']);
                            $my_paying['paying_amount'] = (($my_paying['paying_amount'] + $schedule['penalty']) - $total_paid);

                        }else{

                            $percentage_arr = explode(':', $to_pay[0]['percentage']);

                            $a = $hist_perc;
                            $b = $percentage_arr;

                            foreach ($a as $key => $value) {
                                foreach($b as $k => $v){
                                    if($value == $v){
                                        unset($b[$k]);
                                        break;
                                    }
                                }
                            }

                           $my_paying['percentage'] = $b;

                        }// End of penalty Check


                    } // End of Exception is not Empty

                }else{

                    $to_pay = array();
                    array_push($to_pay, $schedule);

                    $my_paying = array(
                                        "schedule_id" => $to_pay[0]['scheduleid'],
                                        "schedule_type" => $to_pay[0]['type'],
                                        "exception_id" => NULL,
                                        "session_name" => $to_pay[0]['sesname'],
                                        "session_id" => $this->main->item('cur_session'),
                                        "paying_amount" => $to_pay[0]['amount'],
                                        "school_id" => $to_pay[0]['schoolid'],
                                        "penalty" => ($schedule['penalty_status'] == 'active')? $schedule['penalty'] : 0,
                                        "penalty_status" => $schedule['penalty_status'],
                                        "adm_status" => NULL,
                                        "level" => NULL,
                                        "payer_type" => NULL,
                                        "total_percent_paid" => $tot,
                                        "revenue_head" => $schedule['revhead']
                                     );

                    if($schedule['penalty_status'] == 'active'){

                            $my_paying['penalty_percentage'] = (100 - $my_paying['total_percent_paid']);
                            $my_paying['paying_amount'] = (($my_paying['paying_amount'] + $schedule['penalty']) - $total_paid);

                        }else{

                            $percentage_arr = explode(':', $to_pay[0]['percentage']);

                            $a = $hist_perc;
                            $b = $percentage_arr;

                            foreach ($a as $key => $value) {
                                foreach($b as $k => $v){
                                    if($value == $v){
                                        unset($b[$k]);
                                        break;
                                    }
                                }
                            }

                           $my_paying['percentage'] = $b;

                        }// End of penalty Check

                }//End of schedule Has Exception Check

                $data['my_paying'] = $my_paying;

                break;

            default:
                break;
        }        
       
        
        
        
        
        
        
        $page_name = 'paynow';
        
        //build view page for pay Now 
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
        
        
        
    }
    
    
    
    /**
     * Generate invoice of the specified payment
     * @access public
     * @name $invoice
     * @return void 
     */
    public function invoice(){
        
        $page_name = 'invoice';
        
        $this->load->helper('num2word');
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get Student details
            $data['student_details'] = $this->pay_mdl->gets('student_details', $this->main->item('user_id'));
            
            // Get all form field values.
            $form_fields = $this->input->post(NULL);
            
            
           
            
            $pay_param = array(
                        'percent' => $form_fields['percentage'],
                        'schoolid' => $form_fields['schoolid'],
                        'exceptionid' => $form_fields['exceptionid'],
                        'can_name' => $data['student_details']['fname'] .' '. $data['student_details']['lname']. ' '.$data['student_details']['mname'],
                        'scheduleid' => $form_fields['scheduleid'],
                        'scheduletype' => $form_fields['scheduletype'],
                        'sessionname' => $form_fields['sessionname'],
                        'sessionid' => $form_fields['sessionid'],
                        'penalty_status' => $form_fields['penalty_status'],
                        'penalty' => $form_fields['penalty'],
                        'userid' => $this->main->item('user_id'),
                        "revenuehead" => $form_fields['revenue_head'],
                        );
            
            if($form_fields['penalty_status'] == "active"){
                
                //get the Calculated percentage of the amount to me paid if Penalty is active
                $pay_param['amount'] = $form_fields['amount'];
                $pay_param['amount2word'] = convert_number_to_words((double)$form_fields['amount']);
                
            }else{
                
                //get the Calculated percentage of the amount to me paid if Penalty is Inactive 
                $paying_amount = (($form_fields['amount'] * $form_fields['percentage']) / 100);
                $pay_param['amount2word'] = convert_number_to_words((double)$paying_amount);
                $pay_param['amount'] = $paying_amount;
            }
            
            
            
            $data['form_fields'] = $pay_param;
            
            //build view page for Payment Invoice  
            $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
            $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
        }
        else{

           // Set error message for any request other than POST
           $error_msg = $this->lang->line('invalid_req_method');  
           $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg, TRUE);   
           
           $this->index();
        }
             
        
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
                                $status = $this->pay_mdl->create('merchant', $params);

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
                            $status = $this->pay_mdl->create('payhead', $params);

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
                    redirect(site_url('payment/setup'));
                    
                
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
                                $status = $this->pay_mdl->create('pay_schedule' , $params );

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
                    redirect(site_url('payment/setup'));
                    
                break;
                
                
            
            case 'exception':
                
                    if($this->input->server('REQUEST_METHOD') == 'POST') {
                    
                        $config = array(
                                        array(
                                              'field'   => 'scheduleid',
                                              'label'   => 'Pay Schedule',
                                              'rules'   => 'required'
                                           ),
                                        array(
                                              'field'   => 'base',
                                              'label'   => 'Unit Type',
                                              'rules'   => 'required'
                                           ),
                                        array(
                                              'field'   => 'baseparam',
                                              'label'   => 'Unit Type',
                                              'rules'   => 'required'
                                           ),   
                                        array(
                                              'field'   => 'amount',
                                              'label'   => 'Amount',
                                              'rules'   => 'required'
                                           ),
                                        array(
                                              'field'   => 'instalment',
                                              'label'   => 'Instalment',
                                              'rules'   => 'required'
                                           )
                                     );

                        $this->form_validation->set_rules($config);
                    
                        if($this->form_validation->run() == FALSE){

                            // Set error message for form validation 
                            // Error and specify the field with error 
                            $error_valid_msg = validation_errors();  
                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);

                        }else{

                            // Get all field values.
                            $form_fields = $this->input->post(NULL);

                            

                                

                                    $params = array(        
                                            'scheduleid' => $form_fields['scheduleid'],
                                            'base' => $form_fields['base'],
                                            'baseparam' => $form_fields['baseparam'],
                                            'instid' => $form_fields['instalment'],
                                            'amount' => $form_fields['amount']  

                                        );

                                    //var_dump($params);

                                    // Call model method to perform insertion
                                    $status = $this->pay_mdl->create('pay_exception' , $params );

                                    // Process model response
                                    switch($status) {

                                        // Unique constraint violated.
                                        case DEFAULT_EXIST:

                                            // Set warning message for duplicate entry
                                            $error_msg = sprintf($this->lang->line('pay_entry_exist'),'');  
                                            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                                            break;


                                        // There was a problem creating the entry.
                                        case DEFAULT_ERROR:

                                            break;


                                        // Entry created successfully.
                                        case DEFAULT_SUCCESS:

                                             $success_msg = sprintf($this->lang->line('pay_success'),'Exception', 'Added to pay Schedule');
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

                    // Redirect to payment setup, showing notifiction messages if there are.
                    redirect(site_url('payment/setup'));
                
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
                            $status = $this->pay_mdl->create('pay_instalment' , $params );

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
                redirect(site_url('payment/setup'));
                
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
                
                $result = $this->pay_mdl->gets('session');
                
                break;
            
            
            
            case 'pay_merchant':
                
                $result = $this->pay_mdl->gets('merchant');
                break;
            
            
            
            case 'pay_head':
                
                $result = $this->pay_mdl->gets('pay_head');
                break;
            
            
            
            case 'college':
                
                    $result = $this->pay_mdl->gets('college');
                break;
            
            
            
            case 'programmes':
                
                    $result = $this->pay_mdl->gets('programmes');
                break;
            
            
            case 'departments':
            
                    $result = $this->pay_mdl->gets('departments');
                break;
            
            
            
            case 'pay_schedule':
                
                if(isset($param) && $param != NULL){

                    $result = $this->pay_mdl->gets('pay_schedule', $param);
                    
                }else{
                    
                    $result = $this->pay_mdl->gets('pay_schedule');
                }
                    
                break;
            
            
            case 'pay_instalment':
                
                    $result = $this->pay_mdl->gets('pay_instalments');
                break;
            
            
            case 'pay_exceptions':
                
                    $result = $this->pay_mdl->gets('pay_exception');
                break;
            
            
            case 'student_details':
                    
                    $result = $this->pay_mdl->gets('student_details', $this->main->get('user_type_id'));
                
                break;
            
            
//            case 'what_to_pay':
//                    if(isset($param) && is_array($param)){
//                        
//                        $result = $this->pay_mdl->gets('what_to_pay', $param );
//                    }
//                    
//                break;
//            

            
//            case 'new_schedule':
//                
//                    if(isset($param) && is_array($param)){
//                        
//                        $result = $this->pay_mdl->gets('new_schedule', $param);
//                    }
//                break;
//            
            
//            case 'my_pay_exception':
//                
//                    if(isset($param) && is_array($param)){
//                        
//                        $result = $this->pay_mdl->gets('my_pay_exception', $param );
//                    }
//                    
//                break;
              
                
//            case 'my_pay_history': 
//                
//                    if(isset($param) && is_array($param)){
//                        
//                        $result = $this->pay_mdl->gets('my_pay_history', $param );
//                    }
//                    
//                break;
//            
                
//            case 'my_schedule':
//                   
//                    $result = $this->pay_mdl->gets('my_schedule');
//                break;
                
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
                                $status = $this->pay_mdl->update('merchant', $params);

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
                                    'payheadid' => $form_fields['id']
                                );
                            
                            // Call model method to perform update
                                $status = $this->pay_mdl->update('pay_head', $params);

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
                    redirect(site_url('setup/payment/setup'));
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
                                $status = $this->pay_mdl->update('pay_schedule' , $params );

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
                    redirect(site_url('setup/payment/setup'));
                break;
                
                
            
            case 'exception':
                
                if($this->input->server('REQUEST_METHOD') == 'POST') {
                    
                        $config = array(
                            array(
                                  'field'   => 'payschedule',
                                  'label'   => 'Pay Schedule',
                                  'rules'   => 'required'
                               ),
                            array(
                                  'field'   => 'unittype',
                                  'label'   => 'Unit Type',
                                  'rules'   => 'required'
                               ),
                            array(
                                  'field'   => 'unitname',
                                  'label'   => 'Unit Name',
                                  'rules'   => 'required'
                               ),   
                            array(
                                  'field'   => 'level',
                                  'label'   => 'Level',
                                  'rules'   => 'required'
                               )
                         );

                    $this->form_validation->set_rules($config);
                    
                    if($this->form_validation->run() == FALSE){
                        
                        // Set error message for form validation 
                        // Error and specify the field with error 
                        $error_valid_msg = validation_errors();  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_valid_msg);
                        
                    }else{
                        
                        // Get all field values.
                        $form_fields = $this->input->post(NULL);

                        $j = 0;
                        do{

                            for($i = 0; $i < count($form_fields['unitname']); $i++ ){

                                $params = array(        
                                        'scheduleid' => $form_fields['payschedule'],
                                        'unittype' => $form_fields['unittype'],
                                        'unitid' => $form_fields['unitname'][$i],
                                        'instid' => $form_fields['instalment'],
                                        'level' => $form_fields['level'][$j],
                                        'payertype' => $form_fields['indigene_status'],
                                        'admstatus' => $form_fields['adm_status'],
                                        'amount' => $form_fields['amount']    
                                    );
                                
                                    //var_dump($params);

                                    // Call model method to perform insertion
                                $status = $this->pay_mdl->create('pay_exception' , $params );

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
                                        
                                         $success_msg = sprintf($this->lang->line('success'),'Exception', 'Added tp pay Schedule');
                                        $this->main->set_notification_message(MSG_TYPE_SUCCESS,$success_msg);
                                        
                                        break;

                                    
                                    default:
                                        break;
                                }
                            }

                            $j++;

                        }while($j < count($form_fields['level']));       
                                
                    }
                
                }else{
                    // Set error message for any request other than POST
                        $error_msg = $this->lang->line('invalid_req_method');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
                }
                    
                // Redirect to payment set, showing notifiction messages if there are.
                redirect(site_url('setup/payment/setup'));
                
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
                            $status = $this->pay_mdl->create('pay_instalment' , $params );

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
                redirect(site_url('setup/payment/setup'));
                
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
                $status = $this->pay_mdl->update('schedule_penalty', $params);

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
        redirect(site_url('payment/setup'));
    }
    
    
    
    public function process_payment(){
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            //Set Requiered parameter to be pass to merchant payment process
            $parameter = array(
                                'schedule_id' => $form_fields['schedule_id'],
                                'exception_id' => $form_fields['exception_id'],
                                'school_id' => $form_fields['school_id'],
                                'percentage' => $form_fields['percentage'],
                                'schedule_type' => $form_fields['schedule_type'],
                                'session_name' => $form_fields['session_name'],
                                'session_id' => $form_fields['session_id'],
                                'penalty' => $form_fields['penalty'],
                                'user_id' => $form_fields['user_id'],
                                'amount' => $form_fields['amount'],
                                'revenue_head' => $form_fields['revhead']
                        );
         
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
    
    
    /**
     * Function to be call Upon payment process = paid 
     * 
     */
    public function paid(){
        
        $result =  $this->pay->paid();
        
        $result['usertypeid'] = $this->main->get('usertypeid');
        $result['usertype'] = $this->main->get('usertype');
        $result['amount2word'] = convert_number_to_words((double)$result['amt']);

        $page_name = 'paid';
        
        $data['result'] = $result;
        
        //build view page for successfull Payment  
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
        
    }
 
    public function decline(){
        
        $result =  $this->pay->decline();
        
        $result['usertypeid'] = $this->main->get('usertypeid');
        $result['usertype'] = $this->main->get('usertype');
        $result['amount2word'] = convert_number_to_words((double)$result['amt']);

        $page_name = 'decline';
        
        $data['result'] = $result;
        
        //build view page for successfull Payment  
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
    }
    
    public function cancel(){
        
        $result =  $this->pay->cancel();
        
        $result['usertypeid'] = $this->main->get('usertypeid');
        $result['usertype'] = $this->main->get('usertype');
        $result['amount2word'] = convert_number_to_words((double)$result['amt']);

        $page_name = 'cancle';
        
        $data['result'] = $result;
        
        //build view page for successfull Payment  
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
        
    }
    
    
    
    
    
}
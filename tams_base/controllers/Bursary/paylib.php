<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * Payment Library controller
 * 
 * @category   Controller
 * @package    Payment Library
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Paylib extends CI_Controller {
    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    private $folder_name = 'payment';
    
    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    private $page_title;
    
    
    private $user_id;
    private $usertype;
    private $school_id;
        
    /*
    * Class constructor
    * 
    * @access public 
    * @retun void
    */
    public function __construct(){

        parent::__construct();
        
        /* Load Form Helper*/
        $this->load->helper('form');
        
        /*Load Form Validation*/
        $this->load->library('form_validation');
        
        $this->load->library('user_agent');
        
        /*Load language*/
        $this->lang->load('module_bursary');
        
        /* Load payment model*/
        $this->load->model($this->folder_name.'/payment_model','pay_mdl' );
        
        /* Load Pay Library */
        $this->load->library('Pay/pay');
        
        $this->school_id = $this->main->item('school_id');
        $this->usertype = $this->main->item('user_type');
        $this->user_id = $this->main->item('user_id');
    }
    
    
    
    public function index(){
       
        $page_name = 'pay';
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
                
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            //die(var_dump( $form_fields));
            $data['rs'] = array(
                        'userid' => $form_fields['userid'],
                        'scheduleid' => $form_fields['scheduleid'],
                        'amount' => $form_fields['amount'],
                        'percentage' => $form_fields['percentage'],
                        'description' => $form_fields['description'],
                        'schoolid' => $form_fields['schoolid'],
                        'penalty' => (isset($form_fields['penalty']))? $form_fields['penalty'] : '',
                        'revhead' => $form_fields['revhead'], 
                        'sesid' =>  $form_fields['sesid'] 
                    );
            
            //build view page for payment 
            $page_content = $this->load->view($this->folder_name.'/paylib/'.$page_name, $data, true);
            $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
        }
        else{
                            
            // Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            
            //Redirect to the referrer page .
            redirect( $this->agent->referrer());   
        }
        
        
    }
    
    
    /**
     * 
     * 
     * @return type void
     */
    public function process_pay(){
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            //Set Requiered parameter to be pass to merchant payment process
            $parameter = array(
                        'schedule_id' => $form_fields['scheduleid'],
                        'school_id' => $form_fields['schoolid'],
                        'percentage' => $form_fields['percentage'],
                        'session_id' => $form_fields['sesid'],
                        'penalty' => $form_fields['penalty'],
                        'user_id' => $form_fields['userid'],
                        'amount' => $form_fields['amount'],
                        'revenue_head' => $form_fields['revhead']        
                        );
         
            //die(var_dump($parameter));
            
            //initiate pay process : Send the parameter to pay merchant
            $this->pay->process($parameter);
            
            
        }else{
            
            //Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            
            // Redirect to referrer Page, showing notifiction messages if any.
            redirect( $this->agent->referrer());
        }
        
    }
    
    /**
     * 
     * 
     * @return type array
     */
    public function paid($payid){
        
        $result = array();
        // Check for valid request method
        
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            if(isset($form_fields["xmlmsg"])) {
                
		$xml = simplexml_load_string($form_fields["xmlmsg"]);

                foreach($xml->children() as $child) {

                        if ($child->getName() == "ResponseDescription"){

                                $res = $child;                
                        }

                        if ($child->getName() == "PurchaseAmountScr") {

                                $amt = $child;                            
                        }

                        if ($child->getName() == "ApprovalCode") {

                                $approvalcode = $child;
                        }

                        if ($child->getName() == "OrderID"){

                                $ordid = $child;
                        }


                        if ($child->getName() == "PAN"){

                                $pan = $child;
                        }

                        if ($child->getName() == "TranDateTime"){

                                $date = $child;
                        }

                        if ($child->getName() == "OrderStatus"){

                                $status = $child;
                        }

                        if ($child->getName() == "Brand"){

                                $brand = $child;
                        }


                        if ($child->getName() == "PurchaseAmount") {

                                 $rawAmount = $child;
                        }

                        if ($child->getName() == "Name"){

                                $name = $child;
                        }


                        if ($child->getName() == "ResponseCode") {

                                $rc = $child;
                        }


                        if ($child->getName() == "ApprovalCode"){

                                $ac = $child;
                        }


                        if ($child->getName() == "TranDateTime"){

                            $dt = $child;
                        }
                        
                $year = date('Y');
                
                }//end for loop
		
                $xmlmsg = $form_fields['xmlmsg'];
			
		$params = array(
                            'status' => "APPROVED",
                            'amt' => $amt,
                            'resp_code' => $rc,
                            'resp_desc' => $res,
                            'auth_code' => $ac,
                            'pan' => $pan,
                            'xml'=> $xmlmsg,
                            'name' => $name,
                            'ordid' => $ordid,
                            'payid' => $payid
                        );
                
		 $status = $this->pay_mdl->pay_success_update($params);
                 $message = '';
                 
                 switch ($status) {
                    case DEFAULT_ERROR :

                        $message = array(
                            'msg' => "Transaction Successful But there is a Minior issue with your Transaction Update. Pls Contact the bursary department for update",
                            'flag' => 2
                        );
                         
                        break;
                    
                    case DEFAULT_SUCCESS :
                        
                        $message = array(
                            'msg' => "Transaction Successful go to pay histry to print your reciept",
                            'flag' => 1
                        );

                        break; 

                     default:
                         break;
                 }
                 
                 $data['message'] = $message;
                /**
                 * 
                 * @todo Send email to user Notifing him/ her about the payment
                 */ 
                     
                $page_name = 'transaction';
        
                //build view page for pay Now 
                $page_content = $this->load->view($this->folder_name.'/paylib/'.$page_name, $data, true);
                $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
                
                }
                
        }else{
            
            //Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            
            // Redirect to payment set, showing notifiction messages if there are.
            redirect( $this->agent->referrer());   
           
        }
        
        
    }
    
    
    
    /**
     * 
     * 
     * @return type array
     */
    public function decline(){
        
        $result = array();
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            if(isset($form_fields["xmlmsg"])) {
                
		$xml = simplexml_load_string($form_fields["xmlmsg"]);

                foreach($xml->children() as $child) {

                        if ($child->getName() == "ResponseDescription"){

                                $res = $child;                
                        }

                        if ($child->getName() == "PurchaseAmountScr") {

                                $amt = $child;                            
                        }

                        if ($child->getName() == "ApprovalCode") {

                                $approvalcode = $child;
                        }

                        if ($child->getName() == "OrderID"){

                                $ordid = $child;
                        }


                        if ($child->getName() == "PAN"){

                                $pan = $child;
                        }

                        if ($child->getName() == "TranDateTime"){

                                $date = $child;
                        }

                        if ($child->getName() == "OrderStatus"){

                                $status = $child;
                        }

                        if ($child->getName() == "Brand"){

                                $brand = $child;
                        }


                        if ($child->getName() == "PurchaseAmount") {

                                 $rawAmount = $child;
                        }

                        if ($child->getName() == "Name"){

                                $name = $child;
                        }


                        if ($child->getName() == "ResponseCode") {

                                $rc = $child;
                        }


                        if ($child->getName() == "ApprovalCode"){

                                $ac = $child;
                        }


                        if ($child->getName() == "TranDateTime"){

                            $dt = $child;
                        }
                        
                $year = date('Y');
                
                }//end for loop
		
                $xmlmsg = $form_fields['xmlmsg'];
			
		$params = array(
                            'status' => "DECLINE",
                            'amt' => 0,
                            'resp_code' => $rc,
                            'resp_desc' => $res,
                            'auth_code' => $ac,
                            'pan' => $pan,
                            'xml'=> $xmlmsg,
                            'name' => $name,
                            'ordid' => $ordid
                        );
                
                $status = $this->pay_mdl->pay_decline_update($params);
                $message = '';

                switch ($status) {
                   case DEFAULT_ERROR :

                       $message = array(
                           'msg' => "Trnsaction Decline with some Error Contact Bursary department for verification",
                           'flag' => 2
                       );

                       break;

                   case DEFAULT_SUCCESS :

                       $message = array(
                           'msg' => "Transaction Decline ",
                           'flag' => 1
                       );

                       break; 

                    default:
                        break;
                }

                $data['message'] = $message;
                /**
                 * 
                 * @todo Send email to user Notifing him/ her about the payment
                 */ 
                     
                $page_name = 'transaction';
        
                //build view page for pay Now 
                $page_content = $this->load->view($this->folder_name.'/paylib/'.$page_name, $data, true);
                $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title ); 
                        
                }
                
        }else{
            
            //Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            
            // Redirect to payment set, showing notifiction messages if there are.
            redirect( $this->agent->referrer());   
           
        }
        
        return $result;
    }
    
    
     /**
     * 
     * 
     * @return type array
     */
    public function cancel(){
        
        $result = array();
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get all field values.
            $form_fields = $this->input->post(NULL);
            
            if(isset($form_fields["xmlmsg"])) {
                
		$xml = simplexml_load_string($form_fields["xmlmsg"]);

                foreach($xml->children() as $child) {

                        if ($child->getName() == "ResponseDescription"){

                                $res = $child;                
                        }

                        if ($child->getName() == "PurchaseAmountScr") {

                                $amt = $child;                            
                        }

                        if ($child->getName() == "ApprovalCode") {

                                $approvalcode = $child;
                        }

                        if ($child->getName() == "OrderID"){

                                $ordid = $child;
                        }


                        if ($child->getName() == "PAN"){

                                $pan = $child;
                        }

                        if ($child->getName() == "TranDateTime"){

                                $date = $child;
                        }

                        if ($child->getName() == "OrderStatus"){

                                $status = $child;
                        }

                        if ($child->getName() == "Brand"){

                                $brand = $child;
                        }


                        if ($child->getName() == "PurchaseAmount") {

                                 $rawAmount = $child;
                        }

                        if ($child->getName() == "Name"){

                                $name = $child;
                        }


                        if ($child->getName() == "ResponseCode") {

                                $rc = $child;
                        }


                        if ($child->getName() == "ApprovalCode"){

                                $ac = $child;
                        }


                        if ($child->getName() == "TranDateTime"){

                            $dt = $child;
                        }
                        
                $year = date('Y');
                
                }//end for loop
		
                $xmlmsg = $form_fields['xmlmsg'];
			
		$params = array(
                            'status' => "CANCEL",
                            'amt' => 0,
                            'resp_code' => $rc,
                            'resp_desc' => $res,
                            'auth_code' => $ac,
                            'pan' => $pan,
                            'xml'=> $xmlmsg,
                            'name' => $name,
                            'ordid' => $ordid
                        );
                
		$status = $this->pay_mdl->pay_decline_update($params);
                $message = '';

                switch ($status) {
                    
                   case DEFAULT_ERROR :

                       $message = array(
                           'msg' => "Trnsaction Canceled with some Error, Contact Bursary department for verification",
                           'flag' => 2
                       );

                       break;

                   case DEFAULT_SUCCESS :

                       $message = array(
                           'msg' => "Transaction Canceled ",
                           'flag' => 1
                       );

                       break; 

                    default:
                        break;
                }

                $data['message'] = $message;
                /**
                 * 
                 * @todo Send email to user Notifing him/ her about the payment
                 */ 
                     
                $page_name = 'transaction';
        
                //build view page for pay Now 
                $page_content = $this->load->view($this->folder_name.'/paylib/'.$page_name, $data, true);
                $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
                }
                
        }else{
            
            //Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            
            // Redirect to payment set, showing notifiction messages if there are.
            redirect( $this->agent->referrer());   
           
        }
        
        
    }
    
    
    
    public function invoice(){
        
    }
    
}
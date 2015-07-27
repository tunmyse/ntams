<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Payment Pay library
 * 
 * @category   Library
 * @package    Payment
 * @subpackage 
 * @author     Sule-Odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */


class Pay {
    
    /**
     * Codeigniter instance
     * 
     * @access private
     * @var CI_Controller
     */
    private $CI;
    
    /**
     * Class constructor
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        
        $this->CI = & get_instance();
        
        /*
         * Load Form Helper 
         */
        $this->CI->load->helper('form');
        
        /*
         * Load payment model 
         */
        $this->CI->load->model('payment/payment_model','pay_mdl' );
        
    }
    
    /**
     * Process Payment function
     * 
     * @access public
     * @return void
     */
    public function process($param){
        
        $schedule_id = $param['schedule_id'];
        $school_id = $param['school_id'];
        $percentage = $param['percentage'];
        $schedule_type = $param['schedule_type'];
        $exception_id = $param['exception_id'];
        $session_name = $param['session_name'];
        $sesid = $param['session_id'];
        $penalty = $param['penalty'];
        $user_id = $param['user_id'];
        $amount = $param['amount'];
        $revenue_head = $param['revenue_head'];
        $paid_url = $param['paid_url'];
        $cancle_url = $param['cancle_url'];
        $decline_url = $param['decline_url'];
        $can_name = $param['can_name'];
        
        $pay_description = $revenue_head."_".$session_name."_".$schedule_type."_".$user_id ;
        
        
        
        $xml = "<?xml version='1.0' encoding='UTF-8'?>
                <TKKPG>
                    <Request>
                        <Operation>CreateOrder</Operation>
                        <Language>EN</Language>
                        <Order>
                            <Merchant>TASUEDEDU</Merchant>
                            <Amount>".$amount."</Amount>
                            <Currency>566</Currency>
                            <Description>".$pay_description."</Description>
                            <ApproveURL>".site_url($paid_url)."</ApproveURL>
                            <CancelURL>".site_url($cancle_url)."</CancelURL>
                            <DeclineURL>".site_url($decline_url)."</DeclineURL>
                        </Order>
                    </Request>
                </TKKPG>";
        
        $ch = curl_init(); 
        
        // former testing url curl_setopt($ch, CURLOPT_URL,"https://196.46.20.36:5443/Exec"); 
        curl_setopt($ch, CURLOPT_URL,"https://mpi.valucardnigeria.com:5443/Exec"); 

        curl_setopt($ch, CURLOPT_VERBOSE, '1');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5000);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, '1');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '1');
        curl_setopt($ch, CURLOPT_CAINFO,  getcwd().'/tasuedcert/CAcert.crt');
        curl_setopt($ch, CURLOPT_SSLCERT, getcwd().'/tasuedcert/TASUEDEDU.pem');
        curl_setopt($ch, CURLOPT_SSLKEY, getcwd().'/tasuedcert/TASUEDEDU.key');
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $xml);

        $response = curl_exec($ch); 
        //echo curl_error($ch);
        
        if(!(curl_errno($ch)>0)){
            
            $parsedxml = simplexml_load_string($response);

            foreach($parsedxml->children() as $RESPONSENODE)
            {	
                    foreach($RESPONSENODE->children() as $ORDERNODE)
                    {
                            foreach($ORDERNODE->children() as $child)
                            {	
                                    if ($child->getName() == "OrderID")
                                            $orderid = $child;

                                    if ($child->getName() == "SessionID")
                                            $sessionid = $child;

                                    if ($child->getName() == "URL")
                                            $url = $child;	
                            }
                            
                    }	
                    
            }//end all loop
             
            $gateway_url = $url."?ORDERID=".$orderid."&SESSIONID=".$sessionid;
            
            date_default_timezone_set('Africa/Lagos');
            $date = date('d/m/Y h:i:s a', time());
            $year = date('Y');
            $ref = date("Ymd").$user_id.time().'TF';
            
            $params = array(

                        'user_id' => $user_id,
                        'schedule_id' => $schedule_id,
                        'exception_id' => $exception_id,
                        'sesid' => $sesid,
                        'can_name' => $can_name,
                        'reference' => $ref,
                        'penalty' => $penalty,
                        'oder_id' => $orderid,
                        'year' => $year,
                        'date_time' => $date,
                        'status' => "PENDING",
                        'session_id' => $sessionid,
                        'gateway' => $gateway_url,
                        'percentage' => $percentage,
                        'pay_desc' => $pay_description
                    );

            $this->CI->pay_mdl->create('pay_transaction', $params );

            header("location: ".$gateway_url); 
             
        }else{
            
           //Set error message for any request other than POST
            $error_msg = curl_error($ch);  
            $this->CI->main->set_notification_message(MSG_TYPE_ERROR, $error_msg ); 
            
            // Redirect to payment set, showing notifiction messages if there are.
            redirect(site_url('payment/myschedule'));
        }
        
    }
    
    /**
     * 
     * 
     * @return type array
     */
    public function paid(){
        
        $result = array();
        // Check for valid request method
        if($this->CI->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get all field values.
            $form_fields = $this->CI->input->post(NULL);
            
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
                            'ordid' => $ordid
                        );
                
		 $this->CI->pay_mdl->update('pay_transaction', $params );
                 
                $result =  $this->CI->pay_mdl->gets('pay_transaction', $params );
                 
                /**
                 * 
                 * @todo Send email to user Notifing him/ her about the payment
                 */
                        
                }
                
        }else{
            
            //Set error message for any request other than POST
            $error_msg = $this->CI->lang->line('invalid_req_method');
            $this->CI->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            
            // Redirect to payment set, showing notifiction messages if there are.
            redirect(site_url('payment/myschedule'));
           
        }
        
        return $result;
    }
    
    
    
    /**
     * 
     * 
     * @return type array
     */
    public function decline(){
        
        $result = array();
        // Check for valid request method
        if($this->CI->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get all field values.
            $form_fields = $this->CI->input->post(NULL);
            
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
                
		 $this->CI->pay_mdl->update('pay_transaction', $params );
                 
                $result =  $this->CI->pay_mdl->gets('pay_transaction', $params );
                 
                /**
                 * 
                 * @todo Send email to user Notifing him/ her about the payment satus
                 */
                        
                }
                
        }else{
            
            //Set error message for any request other than POST
            $error_msg = $this->CI->lang->line('invalid_req_method');
            $this->CI->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            
            // Redirect to payment set, showing notifiction messages if there are.
            redirect(site_url('payment/myschedule'));
           
        }
        
        return $result;
    }
    
    
     /**
     * 
     * 
     * @return type array
     */
    public function cancle(){
        
        $result = array();
        // Check for valid request method
        if($this->CI->input->server('REQUEST_METHOD') == 'POST') {
            
            // Get all field values.
            $form_fields = $this->CI->input->post(NULL);
            
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
                
		 $this->CI->pay_mdl->update('pay_transaction', $params );
                 
                $result =  $this->CI->pay_mdl->gets('pay_transaction', $params );
                 
                /**
                 * 
                 * @todo Send email to user Notifing him/ her about the payment satus
                 */
                        
                }
                
        }else{
            
            //Set error message for any request other than POST
            $error_msg = $this->CI->lang->line('invalid_req_method');
            $this->CI->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            
            // Redirect to payment set, showing notifiction messages if there are.
            redirect(site_url('payment/myschedule'));
           
        }
        
        return $result;
    }
    
    
}
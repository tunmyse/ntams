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
        $this->CI->load->helper('form', 'url');
        
        /*
         * Load payment model 
         */
        $this->CI->load->model('payment/payment_model','pay_mdl' );
        $this->CI->load->model('bursary/bursary_model','bsry_mdl' );
        
        $this->CI->load->library('user_agent');
        
    }
    
    /**
     * Process Payment function
     * 
     * @access public
     * @return void
     */
    public function process($param){
        
        //die(var_dump($param));
        
        $user_id = $param['user_id'];                       //compulsory
        $schedule_id = $param['schedule_id'];               //C
        $school_id = $param['school_id'];                   //C
        $percentage = $param['percentage'];                 //
        $sesid = $param['session_id'];                      //
        $penalty = $param['penalty'];
        $amount = $param['amount'];                         //C
        $revenue_head = $param['revenue_head']; 
        $payid = $param['payid']; //C
        
        $pay_description = $revenue_head."_".$schedule_id."_".$user_id ;
        
        $xml = "<?xml version='1.0' encoding='UTF-8'?>
                <TKKPG>
                    <Request>
                        <Operation>CreateOrder</Operation>
                        <Language>EN</Language>
                        <Order>
                            <Merchant>TASUEDEDU</Merchant>
                            <Amount>".($amount * 100)."</Amount>
                            <Currency>566</Currency>
                            <Description>".$pay_description."</Description>
                            <ApproveURL>".site_url("paylib/paid/$user_id/$payid")."</ApproveURL>
                            <CancelURL>".site_url('paylib/cancel')."</CancelURL>
                            <DeclineURL>".site_url("paylib/decline/$user_id/$payid")."</DeclineURL>
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
                        'sesid' => $sesid,
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
            
             redirect(site_url("{$this->CI->main->get('user_type')}/dashboard"));
             
        }
       //echo base_url(APPPATH.'libraries/Pay/tasuedcert/CAcert.crt');
        //echo getcwd();
       
    }
    
    
    /**
     * Check if user have satisfied a perticular payment schedule
     * 
     * @name has_paid
     * @param Array $param
     * $param = array('scheduleid' => String,'userid' => Int, 'percentage')
     * @return boolean
     */
    public function has_paid($param){
        $query_param = array(
                       'userid' => $param['userid'],
                       'scheduleid' => $param['scheduleid'],
                       'percentage' => $param['percentage']
                    );
        
        return  $this->CI->bsry_mdl->has_paid($query_param);
        
    }   
}
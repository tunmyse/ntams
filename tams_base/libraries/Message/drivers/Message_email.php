<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Email Messaging library
 * 
 * @category   Library
 * @package    Message
 * @subpackage Email
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Message_email extends CI_Driver {
	
    /**
     * User email
     * 
     * @access private
     * @var string
     */
    private $email_user;

    /**
     * Default From email
     * 
     * @access private
     * @var string
     */
    private $from = 'support@tams.com';
    
    /**
     * Default email subject
     * 
     * @access private
     * @var string
     */
    private $subject= 'Email from TAMS';
    
    /**
     * Default email name
     * 
     * @access private
     * @var string
     */
    private $name = '';
    
    /**
     * User id
     * 
     * @access private
     * @var int
     */
    private $id_user;

    /**
     * Codeigniter instance
     * 
     * @access private
     * @var object
     */
    private $CI;

    /**
     * Class constructor
     * 
     * @access public
     * @return void
     */
    public function __construct() {	

        // Load CI object
        $this->CI =& get_instance();

        // Load email library            
        $this->CI->load->library('email'); 

        // Load helper           
        $this->CI->load->helper('auth'); 
            
    } // End func __construct
    
    /**
     * Send an email
     * 
     * @access public
     * @param string $email, string $message
     * @return bool
     */
    public function send($params, $message) {
        // If recipient email is set, return false if it isn't.
        if(!isset($params['to']) || $params['to'] == '') {
            return false;
        }
        
        $to = $params['to'];
        $from = (isset($params['from']))? $params['from']: $this->from;
        $from_name = (isset($params['name']))? $params['name']: $this->name;
        
        // Set email sender and recipient.
        $this->email->from($from, $from_name);
        $this->email->to($to);
        
        if(isset($params['cc'])) {
            $cc = '';
            
            if(is_array($params['cc'])) {
                foreach($params['cc'] as $value) {
                    if(!check_field($value, FIELD_TYPE_EMAIL))
                        continue;
                    
                    $cc[] = $value;
                }
            }else {
                $cc = $params['cc'];
            }
            
            // Set CC emails
            $this->email->cc($cc);
        }
        
        if(isset($params['bcc'])) {
            
            $bcc = '';
            
            if(is_array($params['bcc'])) {
                foreach($params['bcc'] as $value) {
                    if(!check_field($value, FIELD_TYPE_EMAIL))
                        continue;
                    
                    $bcc[] = $value;
                }
            }else {
                $bcc = $params['bcc'];
            }
            
            // Set BCC emails
            $this->email->bcc($bcc);
        }

        // Set email subject.
        $subject = (isset($params['subject']))? $params['subject']: $this->subject;
        $this->email->subject($subject);
        
        // Set message.
        $this->email->message($message);

        // Send email.
        return $this->email->send();
        
    } // End func send
    
} // End class Message_email

// End file Message_email.php
?>

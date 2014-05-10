<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once BASEPATH.'libraries/Driver.php';
/**
 * TAMS
 * Application messaging library
 * 
 * @category   Library
 * @package    Message
 * @subpackage 
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Message extends CI_Driver_Library {

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

    } // End func __construct
 
    /**
     * Send email from an email template
     * 
     * @access public
     * @param string $email, array $params, string $template
     * @return bool
     */
    public function send_email_from_template($email, $params, $template) {
        
        $message = $this->CI->load->view(EMAIL_TEMPLATE_FOLDER.'/'.$template, $params, TRUE);
        
        $email_params = array(
            'to'        => $email,
            'subject'   => 'Password reset on TAMS'
        );
        
        return $this->email->send($params, $message);
        
    } // End func send_email_from_template
    
} // End class Message

// End file Message.php
                                                                                 
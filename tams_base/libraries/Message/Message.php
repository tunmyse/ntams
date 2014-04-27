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
     * Class constructor
     * 
     * @access public
     * @param string $email, array $params, string $template
     * @return bool
     */
    public function send_email_from_template($email, $params, $template) {	
        return true;

    } // End func __construct
    
} // End class Message

// End file Message.php

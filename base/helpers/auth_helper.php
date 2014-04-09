<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Authentication Helper
 * 
 * @category   Helper
 * @package    Authentication
 * @subpackage 
 * @author     Akinsola Tunmise <akinsolatumise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
if ( ! function_exists('check_field')) {
    function check_field($value, $type) {
        if($value == NULL || $value == '')
            return false;
        
        switch ($type) {
            case PASSWORD_FIELD_TYPE:
                if(strlen($value) < PASSWORD_LENGTH_MIN)
                    return false;
                break;

            case USERNAME_FIELD_TYPE:
                if(strlen($value) < USERNAME_LENGTH_MIN)
                    return false;
                break;

            case EMAIL_FIELD_TYPE:
                $CI =& get_instance();
                $CI->load->helper('email');
                if(!valid_email($value))
                    return false;
                break;

            default:
                return false;
                break;
        }        
        return true;
    }
}

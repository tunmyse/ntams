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
        
        $CI =& get_instance();
        
        switch ($type) {
            case FIELD_TYPE_PASSWORD:
                if(strlen($value) < $CI->config->item('password_min_length'))
                    return false;
                break;

            case FIELD_TYPE_USERNAME:
                if(strlen($value) < $CI->config->item('username_min_length'))
                    return false;
                break;

            case FIELD_TYPE_EMAIL:
                $CI->load->helper('email');
                if(!valid_email($value) || strtolower($value) == DEFAULT_EMAIL)
                    return false;
                break;

            default:
                return false;
                break;
        }        
        return true;
    }
}

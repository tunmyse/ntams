<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Get User Pics  Helper
 * 
 * @category   Helper
 * @package    Num2word
 * @subpackage 
 * @author     Sule-Odu Adedaayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

if(!function_exists("get_user_pics")){
    
    function get_user_pics($userid){
        
        $root = 'img/user';
        
        $image_url = 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
        
        $image = array( "{$root}/user_{$userid}.jpg", 
                        "{$root}/user_{$userid}.jpg", 
                        "{$root}/user_".strtolower($userid).".jpg", 
                        "{$root}/user_{$userid}.JPG",
                        "{$root}/user_{$userid}.JPG", 
                        "{$root}/user_".strtolower($userid).".JPG", 
                        "{$root}/user_{$userid}.png", 
                        "{$root}/user_{$userid}.png", 
                        "{$root}/user_".strtolower($userid).".png",
                        "{$root}/user_{$userid}.PNG", 
                        "{$root}/user_{$userid}.PNG", 
                        "{$root}/user_".strtolower($userid).".PNG", 
                        "{$root}/user_{$userid}.gif", 
                        "{$root}/user_{$userid}.gif", 
                        "{$root}/user_".strtolower($userid).".gif", 
                        "{$root}/user_{$userid}.GIF", 
                        "{$root}/user_{$userid}.GIF", 
                        "{$root}/user_".strtolower($userid).".GIF"
                    );

        for($idx = 0; $idx < count($image); $idx++) {
            if(realpath("{$image[$idx]}")) {
                $image_url = site_url().$image[$idx];
                break;
            }
        }
        return $image_url;
    }
}
    
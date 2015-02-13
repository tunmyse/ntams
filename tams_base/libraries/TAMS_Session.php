<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * TAMS
 * Session Override Class
 * 
 * Overrides set_flashdata method to enable adding a notification message to the flash data from the previous request.
 * 
 * @category   CodeIgniter
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class TAMS_Session extends CI_Session {

    /**
     * Add or change flashdata, only available until the next request
     * Overriden to allow adding notification to the ccess
     * 
     * @access	public
     * @param	mixed
     * @param	string
     * @return	void
     */
    function set_flashdata($newdata = array(), $newval = '', $current = FALSE) {
        if (is_string($newdata)) {
            $newdata = array($newdata => $newval);
        }

        if (count($newdata) > 0) {
            foreach ($newdata as $key => $val) {     
                if(!$current) {
                    $flashdata_key = $this->flashdata_key.':new:'.$key;
                    $this->set_userdata($flashdata_key, $val);
                }else {
                    $flashdata_key = $this->flashdata_key.':old:'.$key;
                    $value = $this->userdata($flashdata_key);
                    
                    if(is_array($value)) {
                        $val = array_merge($value, $val);
                    }
                    
                    $this->set_userdata($flashdata_key, $val);
                }
            }
        }
    }
}
// END TAMS_Session Class

/* End of file TAMS_Session.php */
/* Location: ./application/libraries/TAMS_Session.php */
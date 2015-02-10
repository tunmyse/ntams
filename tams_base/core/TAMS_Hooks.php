<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Hooks Override Class
 * 
 * Adds two methods to run custom hooks.
 * 
 * @category   CodeIgniter
 * @package    Hooks
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class TAMS_Hooks extends CI_Hooks {

    /**
     * Raise a custom hook
     *
     * @access	private
     * @param	$string $module, array	the hook details
     * @return	array
     */
    private function raise_hook($module, $data) {
        
        return ['status' => true];
    }

    /**
     * Run actions associated with a custom hook
     *
     * @access	private
     * @param	array	the hook details
     * @return	bool
     */
    private function hook_action($data) {
        
        if ( ! is_array($data)) {
            return FALSE;
        }

        // -----------------------------------
        // Safety - Prevents run-away loops
        // -----------------------------------

        // If the script being called happens to have the same
        // hook call within it a loop can happen

        if ($this->in_progress == TRUE) {
            return;
        }

        // -----------------------------------
        // Set file path
        // -----------------------------------

        if ( ! isset($data['filepath']) OR ! isset($data['filename'])) {
            return FALSE;
        }

        $filepath = APPPATH.$data['filepath'].'/'.$data['filename'];

        if ( ! file_exists($filepath)) {
            return FALSE;
        }

        // -----------------------------------
        // Set class/function name
        // -----------------------------------

        $class		= FALSE;
        $function	= FALSE;
        $params		= '';

        if (isset($data['class']) AND $data['class'] != '') {
            $class = $data['class'];
        }

        if (isset($data['function'])) {
            $function = $data['function'];
        }

        if (isset($data['params'])) {
            $params = $data['params'];
        }

        if ($class === FALSE AND $function === FALSE) {
            return FALSE;
        }

        // -----------------------------------
        // Set the in_progress flag
        // -----------------------------------

        $this->in_progress = TRUE;

        // -----------------------------------
        // Call the requested class and/or function
        // -----------------------------------

        if ($class !== FALSE) {
            if ( ! class_exists($class)) {
                require($filepath);
            }

            $HOOK = new $class;
            $HOOK->$function($params);
        }
        else {
            if ( ! function_exists($function)) {
                require($filepath);
            }

            $function($params);
        }

        $this->in_progress = FALSE;
        return TRUE;
    }
    
}// END TAMS_Hooks class

/* End of file Hooks.php */
/* Location: ./application/core/Hooks.php */
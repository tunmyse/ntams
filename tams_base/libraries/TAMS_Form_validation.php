<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * TAMS
 * Form Validation Override Class
 * 
 * Overrides run method to load validation file for current module.
 * 
 * @category   CodeIgniter
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class TAMS_Form_validation extends CI_Form_validation {

    /**
     * Run the Validator
     *
     * This function does all the work.
     * Overriden to load the custom validation file for a module
     *
     * @access	public
     * @return	bool
     */
    public function run($group = '', $prefix = '') {
        // Do we even have any data to process?  Mm?
        if (count($_POST) == 0) {
            return FALSE;
        }

        // Does the _field_data array containing the validation rules exist?
        // If not, we look to see if they were assigned via a config file
        if (count($this->_field_data) == 0) {
            
            // Get url prefix for current executing module.
            $prefix = $this->CI->main->item('segment');
            
            $config_path = "{$prefix}_form_validation";
            
            // Load form validation config file for the current module and merge it with the existing config rules.
            if(!isset($this->_config_rules[$group]) && 
                    $this->CI->config->load($config_path, true, true) && 
                    is_array($config = $this->CI->config->item($config_path))) {
                
                $this->_config_rules = array_merge($this->_config_rules, $config);
                unset($config);
                
                // This is NOT advisable, but expedient!
                unset($this->CI->config->config[$config_path]);
            }
            
            // No validation rules?  We're done...
            if (count($this->_config_rules) == 0) {
                    return FALSE;
            }

            // Is there a validation rule for the particular URI being accessed?
            $uri = ($group == '') ? trim($this->CI->uri->ruri_string(), '/') : $group;

            if ($uri != '' AND isset($this->_config_rules[$uri])) {
                $this->set_rules($this->_config_rules[$uri]);
            }else {
                $this->set_rules($this->_config_rules);
            }

            // We're we able to set the rules correctly?
            if (count($this->_field_data) == 0) {
                log_message('debug', "Unable to find validation rules");
                return FALSE;
            }
        }

        // Load the language file containing error messages
        $this->CI->lang->load('form_validation');

        // Cycle through the rules for each field, match the
        // corresponding $_POST item and test for errors
        foreach ($this->_field_data as $field => $row) {
            // Fetch the data from the corresponding $_POST array and cache it in the _field_data array.
            // Depending on whether the field name is an array or a string will determine where we get it from.

            if ($row['is_array'] == TRUE) {
                $this->_field_data[$field]['postdata'] = $this->_reduce_array($_POST, $row['keys']);
            } else {
                if (isset($_POST[$field]) AND $_POST[$field] != "") {
                    $this->_field_data[$field]['postdata'] = $_POST[$field];
                }
            }

            $this->_execute($row, explode('|', $row['rules']), $this->_field_data[$field]['postdata']);
        }

        // Did we end up with any errors?
        $total_errors = count($this->_error_array);

        if ($total_errors > 0) {
            $this->_safe_form_data = TRUE;
        }

        // Now we need to re-set the POST data with the new, processed data
        $this->_reset_post_array();

        // No errors, validation passes!
        if ($total_errors == 0) {
            return TRUE;
        }

        // Validation fails
        return FALSE;
    }

}
// END Form Validation Class

/* End of file TAMS_Form_validation.php */
/* Location: ./application/libraries/TAMS_Form_validation.php */

<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Config Override Class
 *
 * Overrides the constructor to add another config path.
 * 
 * @category   CodeIgniter
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class TAMS_Config extends CI_Config {

    /**
     * Constructor
     *
     * Sets the $config data from the primary config.php file as a class variable
     *
     * @access   public
     * @param   string	the config file name
     * @param   boolean  if configuration values should be loaded into their own section
     * @param   boolean  true if errors should just return false, false if an error message should be displayed
     * @return  boolean  if the file was successfully loaded or not
     */
    function __construct() {
        parent::__construct();
        array_push($this->_config_paths, APPPATH.'custom/');
    }
        
}// END TAMS_Config class

/* End of file TAMS_Config.php */
/* Location: ./application/core/TAMS_Config.php */

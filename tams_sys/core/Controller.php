<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * CodeIgniter Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		ExpressionEngine Dev Team
 * @link		http://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	private static $instance;
        
        /**
         *  @var Main TAMS library class 
         */ 
        public $main;
        
        /**
         *  @var CI_Input CI Input class
         */ 
        public $input;
        
        /**
         *  @var CI_Loader CI Loader class
         */ 
        public $load;
        
        /**
         *  @var CI_URI CI URI class
         */ 
        public $uri;
        
        /**
         *  @var CI_Benchmark CI Benchmark class
         */ 
        public $benchmark;
        
        /**
         *  @var TAMS_Config TAMS Config override class
         */ 
        public $config;        
        
        /**
         *  @var TAMS_Form_validation TAMS Form Validation override class
         */ 
        public $form_validation;
        
        /**
         *  @var TAMS_Session TAMS Session override class
         */ 
        public $session;
        
        /**
         *  @var Util_model TAMS Utility Model class
         */ 
        public $util_model;
        
        /**
         *  @var CI_Lang CI Language class
         */ 
        public $lang;
        
        /**
         *  @var TAMS_Hooks TAMS Hook override class 
         */ 
        public $hooks;
        
	/**
	 * Constructor
	 */
	public function __construct()
	{
		self::$instance =& $this;
		
		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');

		$this->load->initialize();
		
		log_message('debug', "Controller Class Initialized");
	}

	public static function &get_instance()
	{
		return self::$instance;
	}
}
// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */
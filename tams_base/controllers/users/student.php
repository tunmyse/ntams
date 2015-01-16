<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'controllers/users/Users.php';

/**
 * Student controller
 * 
 * @category   Controller
 * @package    Users
 * @subpackage Student
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Student extends Users {

    /*
     * Class constructor
     * 
     * @access public 
     * @retun void
     */
    public function __construct() {

        parent::__construct();

        /*
         * Load libraries
         */
        
        // Initialize class variables
        
    }// End func __construct
    
    /**
     * Index page for the application.	 
     */
    public function index() { 
        
        $this->check_user_type();
        
        $data = array(
            'tiles' => $this->dashboard_tiles()
        );
        
        $page_name = 'dashboard';
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_content, 'Dashboard', false);       
    }// End of func index
    
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'controllers/users/uers.php';

/**
 * TAMS
 * Admin controller
 * 
 * @category   Controller
 * @package    Users
 * @subpackage Admin
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Staff extends Users {

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
     * Dashboard for admin.	 
     */
    public function index() { 
        parent::index();   
    }// End of func index
    
    /**
     * Show a user's profile.
     * 
     * @access public
     * @return void	 
     */
    public function view_profile() {
        
        $data['user_info'] = $this->get_user_info();
        $data['user_type'] = $this->user_type;
        
        $page_name = "{$this->user_type}_profile";
        $title = "{$this->main->item('user_lname')}'s Profile";
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/change_image', $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $title, false);
    }// End of func view_profile
    
    /**
     * Edit an admin's profile.
     * 
     * @access public 
     * @param string $section
     * @return void	 
     */
    public function edit_profile($section) {                
        parent::edit_profile($section);        
    }// End of func edit_profile
}

/* End of file admin.php */
/* Location: ./application/controllers/admin.php */
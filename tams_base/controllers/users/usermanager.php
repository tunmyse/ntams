<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'controllers/users/users.php';

/**
 * User Manager controller
 * 
 * @category   Controller
 * @package    Users
 * @subpackage Manager
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class UserManager extends Users {

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
     * Dashboard profile tile.	 
     */
    public function index() { 
        if($this->main->is_admin()) {
            $this->manage_users();
            return;
        }
        
        redirect("{$this->user_type}/profile");
    }// End of func index
    
    /**
     * Show a user's profile from dashboard tile.
     * 
     * @access public 
     * @return void	 
     */
    public function profile() {        
        redirect("{$this->user_type}/profile");
    }// End of func profile
    
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
        $page_content .= $this->load->view($this->folder_name.'/partials/change_password', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials//change_image', $data, true);
//        $page_content .= $this->load->view($this->folder_name.'/partials/edit_profile', $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $title, false);
    }// End of func view_profile
    
    /**
     * Edit a student's profile.
     * 
     * @access public 
     * @param string $section
     * @return void	 
     */
    public function edit_profile($section) {
        parent::edit_profile($section);        
    }// End of func edit_profile
    
    /**
     * Edit a student's profile.
     * 
     * @access public 
     * @param string $section
     * @return void	 
     */
    public function manage_users() {
        
        $data = [];
        $page_name = "manage_users";
        $title = "{$this->main->item('user_lname')}'s Profile";
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $title, false);
    }// End of func manage_users
}

/* End of file users.php */
/* Location: ./application/controllers/users.php */
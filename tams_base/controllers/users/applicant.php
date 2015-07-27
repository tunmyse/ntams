<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once APPPATH.'controllers/users/users.php';

/**
 * Applicant controller
 * 
 * @category   Controller
 * @package    Users
 * @subpackage Applicant
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Applicant extends Users {
       
    /*
     * Class constructor
     * 
     * @access public 
     * @retun void
     */
            
    public function __construct(){
        
        parent::__construct();
        
    } 
    
    /**
     * Prospective Application page .	 
     */
    public function index() {
        parent::index();
    }
     
    
    /**
     * Get academic information for this user.
     * 
     * @access protected 
     * @return array	 
     */
    private function get_acad_info() {
        
        $params = [
            'school_id' => $this->main->item('school_id'),
            'user_id' => $this->user_id,
            'user_type' => 'prospective'
        ];
        
        $info = $this->mdl->get_app_acad_info($params);
        
        return ($info['status'] == DEFAULT_SUCCESS)? $info['rs']: [];
        
    }// End of func get_acad_info
    
    /**
     * Show a user's profile.
     * 
     * @access public 
     * @return void	 
     */
    public function view_profile() {
        
        $data['user_info'] = $this->get_user_info();
        
        //$data['acad_info'] = $this->get_acad_info(); 
        
        $data['user_type'] = $this->user_type;
        
        $page_name = "{$this->user_type}_profile";
        $title = "{$this->main->item('user_lname')}'s Profile";
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/change_password', $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/change_image', $data, true);
//        $page_content .= $this->load->view($this->folder_name.'/partials/edit_profile', $data, true);
        $this->page->build($page_content, $this->folder_name, $page_name, $title, false);
    }// End of func view_profile
    
    /**
     * Edit a applicant's profile.
     * 
     * @access public 
     * @param string $section
     * @return void	 
     */
    public function edit_profile($section) {
        parent::edit_profile($section);        
    }// End of func edit_profile
}// End class Applicant

// End file Applicant.php
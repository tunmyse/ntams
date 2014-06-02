<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * Exam controller
 * 
 * @category   Controller
 * @package    Admission
 * @subpackage Exam
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Exam extends CI_Controller {

    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    
    private $folder_name = 'admission';
    
    /**
     * Module Name
     * 
     * @access private
     * @var string
     */
    
    private $module_name = 'admission';
    
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
        
        /*
         * Load models
         */
        $this->load->model("$this->folder_name/exam_model", 'mdl');
        
        /*
         * Load language
         */
        $this->lang->load('module_exam');
        
        /*
         * Load helper
         */
        $this->load->helper(array('validation', 'url'));
        
        // Initialize class variables
        $this->user_id = $this->main->get('user_id');
        $this->user_type = $this->main->get('user_type');
        
    }// End func __construct
    
    /**
     * Index page for the college module.	 
     */
    public function index() {
        $data = array();
        $page_name = 'manage_exam';
                        
        $page_content = $this->load->view($this->folder_name.'/exam/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_group', '', true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_exam', '', true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_subject', '', true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_grade', '', true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_group', '', true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_exam', '', true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_subject', '', true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_grade', '', true);
        $page_content .= $this->load->view($this->folder_name.'/partials/delete_modal', '', true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'Exam Management');       
    }// End of func index
    
    /**
     * Create new exam group.	 
     */
    public function create_exam_group($received, $expected) {
        
        
    }// End of func create_exam_group
    
    /**
     * Create new exam.	 
     */
    public function create_exam($received, $expected) {
        
        
    }// End of func create_exam
    
    /**
     * Create new exam .	 
     */
    public function create_grade($received, $expected) {
        
        
    }// End of func create_grade
    
    /**
     * Validate form fields.	 
     */
    public function validate_fields($received, $expected) {
        
        // Check which of the expected fields are present in the received fields array.
        $present = array_intersect(array_keys($expected), array_keys($received));
        
        // Compare size of present fields to expected fields.
        if(count($present) !== count($expected)) {
            // Set error message for incomplete form fields
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);
            return true;
        }        
            
        foreach($expected as $exp) {
            if($exp['required']) {
                
            }
        }
        
        if(true) {
            // Set error message for any request other than POST
            $error_msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $error_msg);            
            return true;
        }
        
        return false;
    }// End of func validate_fields
    
    /**
     * College information.	 
     */
    public function info($college_name) {
        $data = array();
        $page_name = 'college_info';
        
        // Format college name from url
        // Format department name from url
        $link_paths = explode('-', $college_name);
        $colid = (int)$link_paths[count($link_paths)-1];
        
        $params = array(
            'colid' => $colid
        );
        // Retrieve all department students 
        $data['info'] = $this->mdl->get_college($params);
        
        if($data['info'] == DEFAULT_NOT_EXIST) {
            redirect('error/errorNum');
        }
        
        $data['college_name'] = $this->main->get_college_name();
        
        // Retrieve all colleges 
        $data['colleges'] = $this->mdl->get_college();
        
        // Retrieve all colleges 
        $data['students'] = $this->mdl->get_college_students($params);
        
        // Retrieve all colleges 
        $data['staffs'] = $this->mdl->get_college_staffs($params);
        
        // Retrieve all colleges 
        $data['depts'] = $this->mdl->get_college_depts($params);
        
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_college', $data['college_name'], true);
        $page_content .= $this->load->view('department/partials/create_dept', $data['college_name'], true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, ucfirst($data['college_name']));    
    }// End of func info
    
}

/* End of file exam.php */
/* Location: ./application/controllers/exam.php */
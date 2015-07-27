<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * User Manager controller
 * 
 * @category   Controller
 * @package    User Manager
 * @subpackage 
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class UserManager extends CI_Controller {

    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */ 
    
    private $folder_name = 'profile_manager';
    
    /**
     * Module Name
     * 
     * @access private
     * @var string
     */
    
    private $module_name = 'profile_manager';
    
    /**
     * Model Name
     * 
     * @access public
     * @var Access_Control_model
     */
    
    public $mdl;
    
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
        $this->load->model("$this->folder_name/access_control_model", 'mdl');
        
        /*
         * Load language
         */
        $this->lang->load('module_access_control');
        
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
        $page_name = 'view_college';
        
        $data['college_name'] = $this->main->get_college_name();
        
        $data['dept_count'] = $this->mdl->get_department_count();
        
        // Retrieve all colleges 
        $data['colleges'] = $this->mdl->get_college();
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/edit_college', $data['college_name'], true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, ucfirst($data['college_name']));       
    }// End of func index
    
    
    /**
     * Create a new college.	 
     */
    public function create() {
        
    }// End of func create
    
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
     * Get suggestions for a certain certain access object.	 
     */
    public function suggestions() {
        /**
        * @todo 
        * 
        * Modify core DB_active_rec for suggestions, to be able to group where and like clauses.
        * Create four new methods, one to begin the group and the other to end it, for both where and like.
        * This methods just adds '(' and ')' to the $this->ar_where and $this->ar_like arrays.
        * See _compile_select
        * 
        */
        
        $params = [
            "query" => $this->input->get('query'),
            "type" => $this->input->get('type'),
            "exclude" => explode('_', $this->input->get('exclude')),
            "module_id" => $this->input->get('module'), // To further filter permissions
            "school_id" => $this->main->item('school_id')
        ];

        $result = $this->mdl->get_suggestions($params);
        
        switch($result['status']) {

            case DEFAULT_ERROR:
                set_status_header(500, $this->lang->line('operation_error'));
                break;

            case DEFAULT_EMPTY:
                $result['rs'] = [];
            case DEFAULT_SUCCESS:
                set_status_header(200);
                $this->output->set_content_type('application/json')->set_output(json_encode($result['rs']));

        }
        
//        set_status_header(200);
//        $this->output->set_content_type('application/json')->set_output(json_encode($result['rs']));
//        set_status_header(403);//, $this->lang->line('invalid_req_method'));
        
    }// End of func suggestions
    
}

/* End of file accesscontrol.php */
/* Location: ./application/controllers/accesscontrol.php */
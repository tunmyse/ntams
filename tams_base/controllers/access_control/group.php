<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * TAMS
 * User Group controller
 * 
 * @category   Controller
 * @package    Acess Control
 * @subpackage Group
 * @author     Tunmise Akinsola <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
class Group extends CI_Controller {

    /**
     * User id
     * 
     * @access private
     * @var int
     */
    private $user_id;
    
    /**
     * User account_type
     * 
     * @access private
     * @var string
     */
    private $user_type;
    
    /**
     * Is user super admin.
     * 
     * @access private
     * @var bool
     */
    private $super_admin;
    
    /**
     * School id
     * 
     * @access private
     * @var int
     */
    private $school_id;
    
    /**
     * Folder Name
     * 
     * @access private
     * @var string
     */
    
    private $folder_name = 'access_control';
    
    /**
     * Model Name
     * 
     * @access private
     * @var Access_Control_model
     */
    
    public $mdl;
    
    /**
     * Module Name
     * 
     * @access private
     * @var string
     */
    
    private $module_name = 'access_control';
    
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
        $this->load->helper(array('validation'));
        
        // Initialize class variables
        $this->user_id = $this->main->item('user_id');
        $this->user_type = $this->main->item('user_type');
        $this->super_admin = $this->main->item('super_admin');
        $this->school_id = $this->main->item('school_id');

    }// End func __construct
    
    /**
     * Index page for the group view.	 
     */
    public function index() {
        $data = array();
        $page_name = 'group_view';
        
        // Retrieve the groups for this user. If 'admin', retrieve all groups.
        $id = ($this->super_admin)? '': $this->user_id;
        
        $result = $this->mdl->get_groups($id);
        
        switch($result['status']) {

            case DEFAULT_SUCCESS:
                $data['groups'] = $result['rs'];
                break;

            case DEFAULT_EMPTY:
                $data['groups'] = [];
                break;

            case DEFAULT_ERROR:
                $data['groups'] = [];
                $msg = $this->lang->line('operation_error');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg, true);
                break;
        }
                
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        $page_content .= $this->load->view($this->folder_name.'/partials/create_group', $data, true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'User Groups');       
    }// End of func index
        
    /**
     * Create a new user group.	 
     */
    public function create() {
        $dest = 'access/groups';
        
        // Check for valid request method
        if($this->input->server('REQUEST_METHOD') == 'POST') {
            
            // Load the validation library
            $this->load->library('form_validation');
            
            // Run validation and process request if fields are valid.
            if($this->form_validation->run('access_create_group') != FALSE) {
               
                // Get all input values
                $fields = $this->input->post(NULL);
                
                // Prepare parameter
                $params = array(
                            'name' => strtolower(ucwords($fields['group_name'])),
                            'owner' => $this->user_id,
                            'description' => $fields['group_desc'],
                            'schoolid' => $this->school_id
                        );
                
                // Call model method to perform insertion
                $result = $this->mdl->create_group($params);
                
                // Process model response
                switch($result['status']) {
                    
                    // Unique constraint violated.
                    case DEFAULT_EXIST:
                        // Set error message for unique constraint violation.
                        $msg = sprintf($this->lang->line('duplicate_value'), 'group name');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                        break;
                    
                    // There was a problem creating the entry.
                    case DEFAULT_ERROR:
                        // Set error message for problem creating entry.
                        $msg = $this->lang->line('create_error');  
                        $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
                        break;
                    
                    // Entry created successfully.
                    case DEFAULT_SUCCESS:
                        // Set success message for unique constraint violation.
                        $msg = sprintf($this->lang->line('create_success'), 'User Group', '');  
                        $this->main->set_notification_message(MSG_TYPE_SUCCESS, $msg);
                        $dest = 'access/group?id='.$result['rs'];
                        break;
                    
                    default:
                        break;
                }
            }else {
                // Set error message for invalid/incomplete fields
                $msg = $this->lang->line('validation_error');  
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
            }
            
        }else{
            // Set error message for any request other than POST
            $msg = $this->lang->line('invalid_req_method');  
            $this->main->set_notification_message(MSG_TYPE_ERROR, $msg);
        }
        
        // Redirect to appropriate page, showing notifiction messages if there are.
        redirect($dest);
    }// End of func create
    
    
    /**
     * User group information.	 
     */
    public function details() {

        $data = array();
        $page_name = 'group_details';
        
        $group_id = $this->input->get('id'); // @todo show 404 if null or non-int value.
        
        $ret = $this->mdl->get_group_info($group_id);
        switch($ret['status']) {
            
            case DEFAULT_SUCCESS:
                $data['info'] = $ret['rs'];
                break;

            case DEFAULT_EMPTY:
                // show 404 message.
                break;

            case DEFAULT_ERROR:
                $msg = $this->lang->line('operation_error');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg, true);
                break;
        }
        
        $ret = $this->mdl->get_group_assoc($group_id);
        switch($ret['status']) {
            
            case DEFAULT_SUCCESS:
                $data['assoc'] = $ret['rs'];
                break;

            case DEFAULT_EMPTY:
                $data['assoc'] = [];
                break;

            case DEFAULT_ERROR:
                $data['assoc'] = [];
                $msg = $this->lang->line('operation_error');
                $this->main->set_notification_message(MSG_TYPE_ERROR, $msg, true);
                break;
        }
        
        $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
        
        $this->page->build($page_content, $this->folder_name, $page_name, 'User Groups');    
    }// End of func details
    
}

/* End of file group.php */
/* Location: ./application/controllers/group.php */
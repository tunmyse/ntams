 <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Page Builder library
 * 
 * @category   Library
 * @package    Page
 * @subpackage Builder
 * @author     Akinsola Tunmise <akinsolatumise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Page {
    
    /**
     * Codeigniter instance
     * 
     * @access private
     * @var object
     */
    private $CI;
    
    /**
     * User id
     * 
     * @access private
     * @var int
     */
    private $user_id;
    
    /**
     * User id
     * 
     * @access private
     * @var string
     */
    private $school_name;
    
    /**
     * User account_type
     * 
     * @access private
     * @var string
     */
    private $user_type;
    
    /**
     * Class constructor
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        
	// Load CI object
        $this->CI =& get_instance();
        
        // Initialize class variables
        $this->user_id = $this->CI->main->get('user_id');
        $this->user_type = $this->CI->main->get('user_type');
        $this->school_name = "Tasued";//$this->CI->main->get('school_name');
        
    }

    /**
     * Retrieve contents to build menu
     *
     * @access private
     * @return mixed (bool | array)
     **/
    private function get_menu_content() {
        
    } // End func get_menu_content
	
    /*
     * Build page
     * 
     * @access public 
     * @return void
     */
    public function build($page_content_buffer, $folder_name, $page_name, $title = '') {

        $header_data['page_title'] = 'TAMS - '.$title;
        
        
        if(file_exists(APPPATH.'views/'.$folder_name.'/include.json')) {
            $includes = $this->CI->load->file(APPPATH.'views/'.$folder_name.'/include.json', TRUE);
            $incl_array = json_decode($includes, TRUE);
            if(array_key_exists($page_name, $incl_array)) {
                $header_data['includes'] = $this->build_includes($incl_array[$page_name]);
            }
        }
        
        $header_buffer = $this->CI->load->view(TMPLPATH.'header', $header_data, true);

        $nav_menu = $this->get_menu_content();
        
        $top_menu_build = $this->build_top_menu($nav_menu, $this->user_type);
        $top_menu = array(
            'topmenu_content' => $top_menu_build,
            'dashboard_url' => '/'.$this->user_type.'/dashboard',
            'logout_url' => '/logout',
            'display_name' => 'Test',
            'display_img' => '/img/demo/user-avatar.jpg'
        );
        $top_menu_buffer = $this->CI->load->view(TMPLPATH.'top_menu', $top_menu, true);        

        $left_sidebar_content = $this->build_sidebar_menu($nav_menu);
        $left_sidebar = array(
            'school_name' => $this->school_name,
            'sidemenu_content' => $left_sidebar_content
        );        
        $left_sidebar_buffer = $this->CI->load->view(TMPLPATH.'left_sidebar', $left_sidebar, true);
        
        $footer_buffer = $this->CI->load->view(TMPLPATH.'footer', '', true);

        $body_parts = array(
            'page_content' => $page_content_buffer,
            'top_nav' => $top_menu_buffer,
            'left_sidebar' => $left_sidebar_buffer,
            'footer' => $footer_buffer
        );
        $body_buffer = $this->CI->load->view(TMPLPATH.'body', $body_parts, true);
        
        $page_parts = array(
            'header_content' => $header_buffer,
            'body_content' => $body_buffer
        );

        $page_content = $this->CI->load->view(TMPLPATH.'page', $page_parts, true);
        echo $page_content;
    } // End func build
    
    /*
     * Build page
     * 
     * @access public 
     * @return void
     */
    private function build_includes($includes) {
        
        return array();
    } // End func build_includes
    
    private function build_top_menu($nav_arr, $main_link = NULL) {		
		
        $buffer = '<li><a href="'.site_url($main_link.'/dashboard').'">Dashboard</a></li>';

//        if(!is_array($nav_arr) or empty($nav_arr)) { 
//            return $buffer;
//        }
//
//        foreach($nav_arr as $label => $modules) {
//
//            $buffer .= '<li>
//                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">
//                                    <span>'.$label.'</span>
//                                    <span class="caret"></span>
//                            </a>
//                            <ul class="dropdown-menu">';
//
//            foreach($modules as $id => $item) {
//
//                    if(count($modules) == 1) {
//
//                        foreach($item['items'] as $a => $c) {
//                            if($c['in_menu'] == 1) {
//                                $buffer .= '<li><a href="'.site_url($c['module_id_string'].'/'.$c['perm_id_string']).'">'.$c['perm_subject'].'</a></li>';
//                            }	
//                        }	
//
//                    } else {
//
//                    $buffer .= '<li class="dropdown-submenu">
//                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">
//                                            <span>'.$item['subject'].'</span>
//                                    </a>
//                                    <ul class="dropdown-menu">';
//
//                    foreach($item['items'] as $i => $v) {
//
//                        if($v['in_menu'] == 1) {
//                            $buffer .= '<li><a href="'.site_url($v['module_id_string'].'/'.$v['perm_id_string']).'">'.$v['perm_subject'].'</a></li>';
//                        }
//                    }
//
//                    $buffer .= '</ul>';
//                    $buffer .= '</li>';
//                }
//            } // End modules
//
//            $buffer .= '</ul></li>';
//
//        } // End nav_arr

        return $buffer;
    } // End func build_top_menu
    
    private function build_sidebar_menu($nav_arr) {
        $sidebar = '<div class="subnav">
                            <div class="subnav-title">
                                    <a class="toggle-subnav" href="#"><i class="icon-angle-down"></i><span>Academic Set-up</span></a>
                            </div>
                            <ul class="subnav-menu">
                                    <li>
                                            <a href="'.site_url('college').'">College</a>
                                    </li>
                                    <li>
                                            <a href="'.site_url('department').'">Departments</a>
                                    </li>
                                    <li>
                                            <a href="'.site_url('programme').'">Programmes</a>
                                    </li>
                                    <li>
                                            <a href="'.site_url('course').'">Courses</a>
                                    </li>
                            </ul>
			</div>';
        return $sidebar;
        if(!is_array($nav_arr) or empty($nav_arr)) {
                return false;
        }

        $buffer = '';

//        foreach($nav_arr as $subject => $modules) {
//
//                $buffer .= '<div class="subnav">
//                        <div class="subnav-title">
//                                <a href="#" class="toggle-subnav"><i class="icon-angle-down"></i><span>'.$subject.'</span></a>
//                        </div>
//                        <ul class="subnav-menu">';
//
//                foreach($modules as $item => $value) {
//
//                        if(count($modules) == 1) {
//
//                                foreach($value['items'] as $i) {
//
//                                        if($i['in_menu'] == 1) {
//                                                $buffer .= '<li>
//                                                                        <a href="'.site_url($i['module_id_string'].'/'.$i['perm_id_string']).'">'.$i['perm_subject'].'</a>
//                                                                </li>';
//                                        }	
//                                }	
//
//                        } else {
//
//                                $buffer .= '<li class="dropdown">
//                                                                <a href="#" data-toggle="dropdown">'.$value['subject'].'</a>
//                                                                <ul class="dropdown-menu">';
//
//                                foreach($value['items'] as $p) {
//                                        if($p['in_menu'] == 1) {
//                                                $buffer .= '<li>
//                                                                        <a href="'.site_url($p['module_id_string'].'/'.$p['perm_id_string']).'">'.$p['perm_subject'].'</a>
//                                                                </li>';
//                                        }	
//                                }
//
//                                $buffer .= '</ul></li>';
//
//                        }
//
//                }	
//
//                $buffer .= '</ul></div>';
//
//        } // End groups

        return $buffer;
    } // End func build_sidebar_menu
    
}
    
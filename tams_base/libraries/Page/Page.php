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
     * User id
     * 
     * @access private
     * @var int
     */
    private $user_id;
    
    /**
     * User name
     * 
     * @access private
     * @var string
     */
    private $user_name;
    
    /**
     * User account_type
     * 
     * @access private
     * @var string
     */
    private $user_type;
    
    /**
     * School name
     * 
     * @access private
     * @var string
     */
    private $school_name;
    
    /**
     * Codeigniter instance
     * 
     * @access private
     * @var object
     */
    private $CI;
    
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
        $this->user_id = $this->CI->main->item('user_id');
        $this->user_name = $this->CI->main->item('user_lname');
        $this->user_type = $this->CI->main->item('user_type');
        $this->school_shortname = $this->CI->main->item('school_shortname');
        $this->school_name = $this->CI->main->item('school_name');
        
    }

    /**
     * Retrieve navigation contents to build menu
     *
     * @access private
     * @return array
     **/
    private function get_nav_content() {
        return $this->CI->main->item('nav_content');
    } // End func get_nav_content
	
    /*
     * Build page
     * 
     * @access public 
     * @return void
     */
    public function build($page_content_buffer, $folder_name, $page_name, $title = '', $dashboard = TRUE) {
        // Do not display activity feed
        $feedbar = false;
        
        // Set page title.
        $title = ($title == '')? 'TAMS': 'TAMS - '.$title;
        $header_data['page_title'] = $title;        
        $header_data['includes'] = array('css' => '', 'js' => '');
        
        // Get page specific styles and scripts to include in the page. 
        $param_file = APPPATH.'views/'.$folder_name.'/include.json';
        if(file_exists($param_file)) {
            $includes = $this->CI->load->file($param_file, TRUE);
            $incl_array = json_decode($includes, TRUE);
            $all_incl = array();
            
            if(array_key_exists('all', $incl_array)) {
                $all_incl = isset($incl_array['all'])? $incl_array['all']: array();
                $feedbar = isset($incl_array['all']['feedbar'])? $incl_array['all']['feedbar']: $feedbar;                
            }
            
            if(array_key_exists($page_name, $incl_array)) {
                $feedbar = isset($incl_array[$page_name]['feedbar'])? $incl_array[$page_name]['feedbar']: $feedbar;
                $header_data['includes'] = $this->build_includes($all_incl, $incl_array[$page_name]);
            }else {
                $header_data['includes'] = $this->build_includes($all_incl);
            }
        }
        
        // Header content
        $header_buffer = $this->CI->load->view(TMPLPATH.'header', $header_data, true);

        // Get all modules and associated links to build application menu.
        $nav_content = $this->get_nav_content();
        
        // Generate menu from navigation content.
        $menu_content = $this->build_menu($nav_content, $this->user_type);        
        
        $top_menu = array(
            'topmenu_content' => $menu_content['top'],
            'dashboard_url' => site_url('/'.$this->user_type.'/dashboard'),
            'logout_url' => site_url('/logout'),
            'message_count' => 2,//TODO get actually message count
            'display_name' => $this->user_name,
            'display_img' => base_url('img/user/user-avatar.jpg')
        );
        $top_menu_buffer = $this->CI->load->view(TMPLPATH.'top_menu', $top_menu, true);        

        $left_sidebar = array(
            'school_name' => $this->school_shortname,
            'sidemenu_content' => $menu_content['side']
        );        
        $left_sidebar_buffer = $this->CI->load->view(TMPLPATH.'left_sidebar', $left_sidebar, true);
        
        $footer_buffer = $this->CI->load->view(TMPLPATH.'footer', '', true);

        // Set width to determine whether to show or hide feedbar.
        $width = ($feedbar)? 9: 12;        
        
        // Set notification message       
        $notification = $this->build_notification();
        
        $body_parts = array(
            'school_name' => $this->school_name,
            'short_name' => $this->school_shortname,
            'page_content' => $page_content_buffer,
            'top_nav' => $top_menu_buffer,
            'left_sidebar' => $left_sidebar_buffer,
            'footer' => $footer_buffer,
            'width' => $width,
            'dashboard' => $dashboard,
            'notification' => $notification
        );
        $body_buffer = $this->CI->load->view(TMPLPATH.'body', $body_parts, true);
        
        $page_parts = array(
            'header_content' => $header_buffer,
            'body_content' => $body_buffer
        );

        $this->CI->load->view(TMPLPATH.'page', $page_parts);
        
    } // End func build
    
    /*
     * Build additional style/script for the page
     * 
     * @access private 
     * @return array
     */
    private function build_includes($all, $includes = array()) {
        $css_files = '';
        $js_files = '';
        
        // Build css file include for all pages in this module
        if(isset($all['css'])) {
            foreach($all['css'] as $css) {
                $url = base_url("css/{$css}");
                $css_files .=  "<link rel='stylesheet' href='{$url}'>\n";                
            }
        }
        
        // Build specific css file include
        if(isset($includes['css'])) {
            foreach($includes['css'] as $css) {
                $url = base_url("css/{$css}");
                $css_files .=  "<link rel='stylesheet' href='{$url}'>\n";                
            }
        }
        
        // Build js file include for all pages in this module
        if(isset($all['js'])) {
            foreach($all['js'] as $js) {
                $url = base_url("js/{$js}");
                $js_files .=  "<script src='{$url}'></script>\n";              
            }
        }
        
        // Build specific js file include
        if(isset($includes['js'])) {
            foreach($includes['js'] as $js) {
                $url = base_url("js/{$js}");
                $js_files .=  "<script src='{$url}'></script>\n";
            }
        }
        
        return array(
            'css' => $css_files,
            'js' => $js_files
        );
    } // End func build_includes
    
    /*
     * Build notification message set by different parts of the application
     * Note: All other message types are ignored if an error is found!
     * 
     * @access private 
     * @return array
     */
    private function build_notification() {
        
        // Array to hold processed notification messages.
        $ret = array();
                
        // All notification message types.
        $msg_types = array(MSG_TYPE_ERROR, MSG_TYPE_WARNING, MSG_TYPE_SUCCESS);
        
        // Get all error messages.
        $errors = $this->CI->main->get_notification_messages($msg_types[0]);        
        
        // Process messages for all message types except 'MSG_TYPE_ERROR'.
        if(empty($errors)) {            
            
            // Loop through all message types, skipping 'MSG_TYPE_ERROR'
            for($idx = 1; $idx < count($msg_types); $idx++) {                
            
                // Get messages for the specific message type.
                $messages = $this->CI->main->get_notification_messages($msg_types[$idx]);
                
                // End processing if there are no messages for this message type.
                if(empty($messages)) {
                    continue;
                }
                
                $ret[$msg_types[$idx]]['msg'] = implode('<br/>', $messages);           
            }            
            
        } else { // Processing for error messages.
            $ret[$msg_types[0]]['msg'] = implode('<br/>', $errors);            
        }
        
        return $ret;
    } // End func build_notification
    
    /*
     * Build menu structure for both the top menu and the sidebar.
     * 
     * @access private 
     * @return string
     */
    private function build_menu($nav_content, $user_type = NULL) {	
        
        // Array to hold menu content for both the top and side menu.
        $menu = array('top' => '', 'side' => '');
        
        // 'Dashboard' menu is always shown on the top menu.
        $menu['top'] = '<li><a href="'.site_url($user_type.'/dashboard').'">Dashboard</a></li>';
            
        // If navigation content is empty, return only the dashboard menu
        if(!is_array($nav_content) or empty($nav_content)) { 
            return $menu;
        }

        // Loop through navigation content to build application menu.
        foreach($nav_content as $module) {
            
            // Add class to sidebar menu to expand only the subnav with the active link.
            $subnav_class = isset($module['active'])? '': 'subnav-hidden';
            
            // Process each module in the nav content, and append to its holding array (top and side).
            $processed_module = $this->process_module($module, $subnav_class);
            
            $menu['top'] .= $processed_module['top'];
            
            $menu['side'] .= $processed_module['side'];
        }  

        return $menu;
    } // End func build_menu
        
    /*
     * Build menu structure for a module.
     * 
     * @access private
     * @param array $module 
     * @return string
     */
    private function process_module($module, $hidden) {
        
        $module_buffer = array('top' => '', 'side' => '');
        
        $processed_links = $this->process_module_links($module['links'], $module['urlprefix']);        
        
        if(empty($module['links'])) {

        }else {
            $module_buffer['top'] = '<li>
                                        <a href="#" data-toggle="dropdown" class="dropdown-toggle">
                                            <span>'.$module['dispname'].'</span>
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">';

            $module_buffer['top'] .= $processed_links;

            $module_buffer['top'] .= '</ul></li>';
        }


        $module_buffer['side'] = '<div class="subnav '.$hidden.'">
                                    <div class="subnav-title">
                                        <a class="toggle-subnav" href="#">
                                            <i class="icon-angle-down"></i>
                                            <span>'.$module['dispname'].'</span>
                                        </a>
                                    </div>
                                    <ul class="subnav-menu">';

        $module_buffer['side'] .= $processed_links;

        $module_buffer['side'] .= '</ul></div>';        
        
        return $module_buffer;
    } // End func process_module
    
    /*
     * Build menu link structure for a module.
     * 
     * @access private
     * @param array $links 
     * @return string
     */
    private function process_module_links($links, $url_prefix) {
       
        $link_buffer = '';
        
        if(is_array($links)) {
            foreach($links as $link) {
                $link_buffer .= '<li>
                                    <a href="'.site_url("{$url_prefix}/{$link['url']}").'">'.$link['name'].'</a>
                                </li>';
            }
        }
                
        return $link_buffer;
    } // End func process_module_links
    
}// End of class Page
// End of file Page.php
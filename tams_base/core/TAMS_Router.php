<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * TAMS
 * Router Override Class
 * 
 * Overrides the _set_routing method.
 * Enables loading of route definitions from each module's route files
 * 
 * @category   CodeIgniter
 * @package    Router
 * @author     Akinsola Tunmise <akinsolatumise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class TAMS_Router extends CI_Router {
    /**
     * Set the route mapping
     *
     * This function determines what should be served based on the URI request,
     * as well as any "routes" that have been set in the routing config file.
     *
     * @access	private
     * @return	void
     */
    function _set_routing() {
        // Are query strings enabled in the config file?  Normally CI doesn't utilize query strings
        // since URI segments are more search-engine friendly, but they can optionally be used.
        // If this feature is enabled, we will gather the directory/class/method a little differently
        $segments = array();
        if ($this->config->item('enable_query_strings') === TRUE AND isset($_GET[$this->config->item('controller_trigger')]))
        {
                if (isset($_GET[$this->config->item('directory_trigger')]))
                {
                        $this->set_directory(trim($this->uri->_filter_uri($_GET[$this->config->item('directory_trigger')])));
                        $segments[] = $this->fetch_directory();
                }

                if (isset($_GET[$this->config->item('controller_trigger')]))
                {
                        $this->set_class(trim($this->uri->_filter_uri($_GET[$this->config->item('controller_trigger')])));
                        $segments[] = $this->fetch_class();
                }

                if (isset($_GET[$this->config->item('function_trigger')]))
                {
                        $this->set_method(trim($this->uri->_filter_uri($_GET[$this->config->item('function_trigger')])));
                        $segments[] = $this->fetch_method();
                }
        }

        // Load the routes.php file.
        if (defined('ENVIRONMENT') AND is_file(APPPATH.'config/'.ENVIRONMENT.'/routes.php'))
        {			

                // Custom tams modularized implementation of routes
                // Route definition for each module is placed in the routes directory.
                if(is_dir(APPPATH.ENVIRONMENT.'/routes')) {
                    $files = get_filenames(APPPATH.ENVIRONMENT.'/routes', TRUE);

                    foreach ($files as $file) {
                        include($file);
                    }

                }

                include(APPPATH.'config/'.ENVIRONMENT.'/routes.php');

        }
        elseif (is_file(APPPATH.'config/routes.php'))
        {
                // Custom tams modularized implementation of routes
                // Route definition for each module is placed in the routes directory.
                if(is_dir(APPPATH.'/routes')) {
                    $files = get_filenames(APPPATH.'/routes', TRUE);

                    foreach ($files as $file) {
                        include($file);
                    }

                }

                include(APPPATH.'config/routes.php');

        }

        $this->routes = ( ! isset($route) OR ! is_array($route)) ? array() : $route;
        unset($route);

        // Set the default controller so we can display it in the event
        // the URI doesn't correlated to a valid controller.
        $this->default_controller = ( ! isset($this->routes['default_controller']) OR $this->routes['default_controller'] == '') ? FALSE : strtolower($this->routes['default_controller']);

        // Were there any query string segments?  If so, we'll validate them and bail out since we're done.
        if (count($segments) > 0)
        {
                return $this->_validate_request($segments);
        }

        // Fetch the complete URI string
        $this->uri->_fetch_uri_string();

        // Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
        if ($this->uri->uri_string == '')
        {
                return $this->_set_default_controller();
        }

        // Do we need to remove the URL suffix?
        $this->uri->_remove_url_suffix();

        // Compile the segments into an array
        $this->uri->_explode_segments();

        // Parse any custom routing that may exist
        $this->_parse_routes();

        // Re-index the segment array so that it starts with 1 rather than 0
        $this->uri->_reindex_segments();
    }

}
// END TAMS_Router Class

/* End of file Router.php */
/* Location: ./application/core/Router.php */
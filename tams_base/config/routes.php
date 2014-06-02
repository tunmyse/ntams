<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "application";

/**
 * Installation routes
 */
$route['tams_installation'] = "installation";
$route['tams_installation/complete'] = "application/complete_installation";
$route['tams_installation/(:any)'] = "installation/$1";

/**
 * General application routing rules.
 */

// Login rules
$route['login'] = "application/login";
$route['authenticate'] = "application/authenticate";

// Forgot password rules
$route['forgot_password/(:any)'] = "application/forgot_password/$1";
$route['forgot_password'] = "application/forgot_password";

// Reset password rules
$route['reset_password/(:any)'] = "application/reset_password/$1";
$route['reset_password'] = "application/reset_password";
    
// Change password rules
$route['change_password'] = "application/change_password";

// User route rules
$route['(:any)/dashboard'] = "users/$1";

// College route
$route['college'] = "college/college";
$route['college/(:any)'] = "college/college/$1";
$route['college/info/(:any)'] = "college/college/details/$1";

// Department route
$route['department'] = "department/department";
$route['department/(:any)'] = "department/department/$1";
$route['department/info/(:any)'] = "department/department/details/$1";

// Programme route
$route['programme'] = "programme/programme";
$route['programme/(:any)'] = "programme/programme/$1";
$route['programme/info/(:any)'] = "programme/programme/details/$1";

// Admission route
$route['admission'] = "admission/admission";
$route['admission/(:any)'] = "admission/$1";
$route['admission/(:any)/(:any)'] = "admission/$1/$2";

$route['exam/(:any)/create'] = "admission/exam/create_$1";
$route['exam/(:any)/update'] = "admission/exam/update_$1";
$route['exam/(:any)/delete'] = "admission/exam/delete_$1";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
<?php  if ( !defined('BASEPATH')) exit('No direct script access allowed');
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


/*
 *---------------------------------------------------------------
 * Installation routes
 *---------------------------------------------------------------
 */

$route['tams_installation'] = "installation";
$route['tams_installation/complete'] = "application/complete_installation";
$route['tams_installation/(:any)'] = "installation/$1";
$route['tams_installation_require'] = false;

/*
 *---------------------------------------------------------------
 * General application routing rules.
 *---------------------------------------------------------------
 */

// Login rules
$route['login'] = "application/login";
$route['authenticate'] = "application/authenticate";
$route['logout'] = "application/logout";

$route['login_require'] = false;
$route['authenticate_require'] = false;
$route['logout_require'] = false;
$route['_require'] = false;

// Forgot password rules
$route['forgot_password/(:any)'] = "application/forgot_password/$1";
$route['forgot_password'] = "application/forgot_password";
$route['forgot_password_require'] = false;

// Reset password rules
$route['reset_password/(:any)'] = "application/reset_password/$1";
$route['reset_password'] = "application/reset_password";
$route['reset_password_require'] = false;

// Change password rules
$route['change_password'] = "application/change_password";

// User route rules
$route['(:any)/dashboard'] = "users/$1";

/*
 *---------------------------------------------------------------
 * Set-up routes.
 *---------------------------------------------------------------
 */

// College route
$route['college'] = "setup/college";
$route['college/(:any)'] = "setup/college/$1";
$route['college/info/(:any)'] = "setup/college/details/$1";

// Department route
$route['department'] = "setup/department";
$route['department/(:any)'] = "setup/department/$1";
$route['department/info/(:any)'] = "setup/department/details/$1";

// Programme route
$route['programme'] = "setup/programme";
$route['programme/(:any)'] = "setup/programme/$1";
$route['programme/info/(:any)'] = "setup/programme/details/$1";


/*
 *---------------------------------------------------------------
 * Access Control routes.
 *---------------------------------------------------------------
 */

$route['(:any)/access_denied'] = "accesscontrol/access_denied/$1";
$route['access'] = "access_control/group";
$route['access/groups'] = "access_control/group";
$route['access/group'] = "access_control/group/details";
$route['access/group/(:any)'] = "access_control/group/$1";

$route['access/roles'] = "access_control/role";
$route['access/role'] = "access_control/role/details";
$route['access/role/(:any)'] = "access_control/role/$1";

$route['access/permissions'] = "access_control/permission";
$route['access/permission'] = "access_control/permission/details";
$route['access/permission/(:any)'] = "access_control/permission/details/$1";

$route['404_override'] = '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */
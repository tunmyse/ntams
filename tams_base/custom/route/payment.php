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


/*
 *---------------------------------------------------------------
 * Payment Management routes.
 *---------------------------------------------------------------
 */

// Payment route
$route['payment'] = "payment/payment/index";
$route['payment/index'] = "payment/payment/index";

$route['payment/setup/penalty'] = "payment/payment/activate_penalty";
$route['payment/pay/paid'] = "payment/payment/paid";
$route['payment/pay/decline'] = "payment/payment/decline";
$route['payment/pay/cancle'] = "payment/payment/cancle";


$route['payment/setup'] = "payment/payment/setup";
$route['setup/payment/payinfo'] = "payment/payment/payinfo";
$route['payment/myschedule'] = "payment/payment/user_schedule";
$route['payment/myschedule/(:any)'] = "payment/payment/user_schedule/$1";
$route['payment/process_pay'] = "payment/payment/process_payment";
$route['payment/paynow/(:any)'] = "payment/payment/paynow/$1";
$route['payment/invoice'] = "payment/payment/invoice";


$route['setup/payment/gets/(:any)'] = "payment/payment/gets/$1";
$route['payment/setup/sets/(:any)'] = "payment/payment/sets/$1";
$route['setup/payment/update/(:any)'] = "payment/payment/update/$1";
$route['setup/payment/delete/(:any)'] = "payment/payment/update/$1";
$route['payment/setup/setexception/(:any)'] = "payment/payment/setexception/$1";






/* End of file routes.php */
/* Location: ./application/config/routes.php */
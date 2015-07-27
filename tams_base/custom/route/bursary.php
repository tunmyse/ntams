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

// Busary route
$route['bursary'] = "bursary/bursary/index";
$route['bursary/admin'] = "bursary/bursary/management";
$route['bursary/assign'] = "bursary/bursary/assign_schedule";
//$route['bursary/assign/#filter_result'] = "bursary/bursary/assign_schedule#filter_result";
$route['bursary/pending/(:any)/(:any)'] = "bursary/bursary/pending/$1/$2";
$route['bursary/pending'] = "bursary/bursary/pending";
$route['bursary/paynow/(:any)'] = "bursary/bursary/paynow/$1";
$route['bursary/invoice'] = "bursary/bursary/invoice";
$route['bursary/process_pay'] = "bursary/bursary/process_payment";
//$route['bursary/pdf'] = "bursary/bursary/get_pdf";
$route['bursary/receipt/(:any)'] = "bursary/bursary/receipt/$1";


$route['bursary/setup/penalty'] = "bursary/bursary/activate_penalty";



//$route['bursary/setup'] = "bursary/bursary/setup";
//$route['setup/bursary/payinfo'] = "bursary/bursary/payinfo";
//$route['bursary/myschedule'] = "bursary/bursary/user_schedule";
//$route['bursary/myschedule/(:any)'] = "bursary/bursary/user_schedule/$1";
//$route['bursary/process_pay'] = "bursary/bursary/process_bursary";
//$route['bursary/paynow/(:any)'] = "bursary/bursary/paynow/$1";
//$route['bursary/invoice'] = "bursary/bursary/invoice";


$route['setup/bursary/gets/(:any)'] = "bursary/bursary/gets/$1";

$route['bursary/setup/sets/(:any)'] = "bursary/bursary/sets/$1";

$route['bursary/update/(:any)'] = "bursary/bursary/update/$1";
$route['bursary/delete/(:any)'] = "bursary/bursary/update/$1";

//$route['busary/fetch'] = "busary/busary/fetch_users";





/* End of file routes.php */
/* Location: ./application/config/routes.php */
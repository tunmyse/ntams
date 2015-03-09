<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Admission Route File
 * 
 * @category   Route
 * @package    Admission
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

/*
 *---------------------------------------------------------------
 * Admission Management routes.
 *---------------------------------------------------------------
 */

// Admission route
$route['admission'] = "admission/admission";

$route['admission/register'] = "admission/admission/register";
$route['admission/create_account'] = "admission/admission/create_account";
$route['admission/application'] = "admission/admission/application";
$route['admission/application/(:any)'] = "admission/admission/$1";

$route['admission/(:any)'] = "admission/$1";
$route['admission/(:any)/(:any)'] = "admission/$1/$2";

// Exam routes
$route['admission/exam/(:any)/create'] = "admission/exam/create_$1";
$route['admission/exam/(:any)/update'] = "admission/exam/update_$1";
$route['admission/exam/(:any)/delete'] = "admission/exam/delete_$1";


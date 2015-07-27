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
$route['admission/create_account_require'] = FALSE;

$route['admission/create_account'] = "admission/admission/create_account";
$route['admission/register'] = "admission/admission/register";
$route['admission/regform1'] = "admission/admission/reg_form1";

$route['admission/view_register/(:any)/(:any)'] = "admission/admission/view_reg_from/$1/$2";
$route['admission/view_register/(:any)'] = "admission/admission/view_reg_from/$1";
$route['admission/view_register'] = "admission/admission/view_reg_from";
$route['admission/registration_submit/(:any)'] = "admission/admission/registration_submit/$1";
$route['admission/status'] = "admission/admission/admission_status";


$route['admission/management'] = "admission/management/index";

$route['admission/create_group'] = "admission/management/create_group";
$route['admission/update_group'] = "admission/management/update_group";

$route['admission/create_exam'] = "admission/management/create_exam";
$route['admission/update_exam'] = "admission/management/update_exam";

$route['admission/create_subject'] = "admission/management/create_subject";
$route['admission/update_subject'] = "admission/management/update_subject";

$route['admission/create_exam_subject'] = "admission/management/create_exam_subject";
$route['admission/update_exam_subject'] = "admission/management/update_exam_subject";

$route['admission/create_grade'] = "admission/management/create_grade";
$route['admission/update_grade'] = "admission/management/update_grade";

$route['admission/create_exam_grade'] = "admission/management/create_exam_grade";
$route['admission/update_exam_grade'] = "admission/management/update_exam_grade";

$route['admission/create_admission'] = "admission/management/create_admission";
$route['admission/update_admission'] = "admission/management/update_admission";

$route['admission/create_admission_type'] = "admission/management/create_admission_type";
$route['admission/update_admission_type'] = "admission/management/update_admission_type";

$route['admission/upload_utme'] = "admission/management/upload_utme";

$route['admission/(:num)/print/form'] = "admission/admission/print_form/$1";

$route['admission/updateform/(:num)/(:num)'] = "admission/admission/update_formnum/$1/$2";

$route['admission/submit/utme'] = "admission/admission/submit_utme";
$route['admission/submit/passport'] = "admission/admission/upload_passport";
$route['admission/submit/personal_info'] = "admission/admission/submit_personal_info";
$route['admission/submit/olevel'] = "admission/admission/submit_olevel";
$route['admission/submit/sponsor'] = "admission/admission/submit_sponsor";
$route['admission/submit/prog_choice'] = "admission/admission/submit_prog_choice";
$route['admission/submit/prev_qualif'] = "admission/admission/submit_prev_qualif";





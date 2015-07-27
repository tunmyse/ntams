<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| User Module Validation Rules
|--------------------------------------------------------------------------
|
|
*/

$config = array(
    'user_change_password' => array(
        array(
            'field' => 'old_password',
            'label' => 'Old Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'new_password',
            'label' => 'New Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'required|matches[new_password]'
        )
    ),
    'access_assign' => array(
        array(
            'field' => 'obj_id',
            'label' => '',
            'rules' => 'required|is_natural_no_zero'
        ),
        array(
            'field' => 'items[]',
            'label' => '',
            'rules' => 'required'
        )
    )       
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validaton.php */

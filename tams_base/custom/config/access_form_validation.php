<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Access Module Validation Rules
|--------------------------------------------------------------------------
|
|
*/

$config = array(
    'access_create_group' => array(
        array(
            'field' => 'group_name',
            'label' => 'Group Name',
            'rules' => 'required'
        )
    ),
    'access_create_role' => array(
        array(
            'field' => 'role_name',
            'label' => 'Role Name',
            'rules' => 'required'
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

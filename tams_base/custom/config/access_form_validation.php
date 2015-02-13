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
    )                          
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validaton.php */

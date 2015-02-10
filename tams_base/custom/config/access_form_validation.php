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
            'rules' => 'required|alpha_dash'
        )
    ),
    'email' => array(
        array(
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => 'required|valid_email'
        ),
        array(
                'field' => 'name',
                'label' => 'Name',
                'rules' => 'required|alpha'
        ),
        array(
                'field' => 'title',
                'label' => 'Title',
                'rules' => 'required'
        ),
        array(
                'field' => 'message',
                'label' => 'MessageBody',
                'rules' => 'required'
        )
    )                          
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validaton.php */

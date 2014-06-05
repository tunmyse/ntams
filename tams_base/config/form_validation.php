<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Form validation Rules
|--------------------------------------------------------------------------
|
|
*/

$config = array(
    'pros_application' => array(
        array(
            'field' => 'fname',
            'label' => 'First Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'lname',
            'label' => 'Last Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'mname',
            'label' => 'Middle Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'phone',
            'label' => 'Phone No',
            'rules' => 'required'
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required'
        ),
        array(
            'field' => 'passconf',
            'label' => 'Password Confirmation',
            'rules' => 'required|matches[password]'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
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

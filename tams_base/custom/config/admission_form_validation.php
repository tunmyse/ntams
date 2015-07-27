<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Admission Module Form Validation Rules
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
                                                'rules' => 'required|min_length[5]'
                                            ),
                                             array(
                                                'field' => 'confPassword',
                                                'label' => 'Password Confirmation',
                                                'rules' => 'matches[password]'
                                            ),
                                            array(
                                                'field' => 'email',
                                                'label' => 'Email',
                                                'rules' => 'required|valid_email'
                                            )
                                           
                                        )
    
                        );
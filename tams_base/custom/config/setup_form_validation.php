<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Setup Module Validation Rules
|--------------------------------------------------------------------------
|
|
*/

$config = array(
    'setup_delete_section' => array(
        array(
            'field' => 'delete_id',
            'label' => '',
            'rules' => 'required|is_natural_no_zero'
        )
    ),
    'setup_update_college' => array(
        array(
            'field' => 'college_name',
            'label' => '',
            'rules' => 'required'
        ),
        array(
            'field' => 'college_title',
            'label' => '',
            'rules' => 'required|alpha'
        ),
        array(
            'field' => 'college_code',
            'label' => '',
            'rules' => 'required|alpha_numeric'
        ),
        array(
            'field' => 'college_remark',
            'label' => '',
            'rules' => ''
        ),
        array(
            'field' => 'special',
            'label' => '',
            'rules' => ''
        ),
        array(
            'field' => 'edit_college_id',
            'label' => '',
            'rules' => 'required|is_natural_no_zero'
        )
    ),
    'setup_update_dept' => array(
        array(
            'field' => 'dept_name',
            'label' => '',
            'rules' => 'required'
        ),
        array(
            'field' => 'dept_code',
            'label' => '',
            'rules' => 'required|alpha_numeric'
        ),
        array(
            'field' => 'dept_remark',
            'label' => '',
            'rules' => ''
        ),
        array(
            'field' => 'dept_col',
            'label' => '',
            'rules' => 'required|is_natural_no_zero'
        ),
        array(
            'field' => 'edit_dept_id',
            'label' => '',
            'rules' => 'required|is_natural_no_zero'
        )
    ),
    'setup_update_prog' => array(
        array(
            'field' => 'prog_name',
            'label' => '',
            'rules' => 'required'
        ),
        array(
            'field' => 'prog_code',
            'label' => '',
            'rules' => 'required|alpha_numeric'
        ),
        array(
            'field' => 'prog_remark',
            'label' => '',
            'rules' => ''
        ),
        array(
            'field' => 'prog_dur',
            'label' => '',
            'rules' => 'required|is_natural_no_zero'
        ),
        array(
            'field' => 'prog_reg',
            'label' => '',
            'rules' => 'required'
        ),
        array(
            'field' => 'prog_dept',
            'label' => '',
            'rules' => 'required|is_natural_no_zero'
        ),
        array(
            'field' => 'edit_prog_id',
            'label' => '',
            'rules' => 'required|is_natural_no_zero'
        )
    )
);

/* End of file form_validation.php */
/* Location: ./application/config/form_validaton.php */

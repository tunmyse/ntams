<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Department Model
 * 
 * @category   Model
 * @package    Department
 * @subpackage 
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Department_model extends CI_Model {
	
    /**
     * Class constructor
     * 
     * @access public
     * @return void
     */
    public function __construct() {
            parent::__construct();
            $this->load->database();

    } // End func __construct

    /**
     * Create a new college
     * 
     * @access public
     * @param array $params
     * @return void
     */
    public function create($params) {
        $status = $this->db->insert('departments', $params); 
    }// End func create
	
    /**
     * Get departments
     * 
     * @access public
     * @param array ids
     * @return void
     */
    public function get_department($ids = array()) {
        // Build query parameters
        $table_name = 'departments d';
        $select = ['*'];
        $join = array(
                    array('table' => 'colleges c', 'on' => 'd.colid = c.colid')
                );
                
        // Retrieve all departments if no id is not specified.
        if(empty($ids)) {            
            return $this->util_model->get_data($table_name, $select, [], [], $join);
        } else {
            $where = [];
            
            // Create where condition for deptid
            if(isset($ids['deptid']) && is_numeric($ids['deptid']) && $ids['deptid'] > 0) {  
                $where[] = ['field' => 'deptid', 'value' => $ids['deptid']];
            }
            
            // Create where condition for colid
            if(isset($ids['colid']) && is_numeric($ids['colid']) && $ids['colid'] > 0) {  
                $where[] = ['field' => 'd.colid', 'value' => $ids['colid']];
            }
            
            $ret = $this->util_model->get_data($table_name, $select, $where, [], $join);
                
            if ($ret['status'] === DEFAULT_EMPTY) {
                $ret['status'] = \DEFAULT_NOT_EXIST;
            }

            return $ret;
        }
        
    }// End func get_department
    
    /**
     * Get all student in a department
     * 
     * @access public
     * @param array $params
     * @return void
     */
    public function get_dept_students(array $params) {
        
        // Check if param is empty
        if(empty($params)) {
            return ['status' => DEFAULT_NOT_VALID];
        }
        
        $table_name = 'users u';
        
        $select = array(
                    'u.userid',
                    'u.usertypeid',
                    'u.fname',
                    'u.lname'
                );
        
        $joins = array(
                    array('table' => 'students s', 'on' => 'u.userid = s.userid'),
                    array('table' => 'programmes p', 'on' => 's.progid = p.progid'),
                    array('table' => 'departments d', 'on' => 'p.deptid = d.deptid')                       
                );
        
        foreach($params as $field => $value) {
            $where = array(
                        array('field' => "d.{$field}", 'value' => $value)
                    );
        }
        
        $order = array(
                    array('field' => 'u.usertypeid', 'dir' => 'asc')
                );
        
        return $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
    }// End func get_dept_students
    
    /**
     * Get all programmes in a department
     * 
     * @access public
     * @param array $params
     * @return void
     */
    public function get_dept_progs(array $params) {
        
        // Check if param is empty
        if(empty($params)) {
            return ['status' => DEFAULT_NOT_VALID];
        }
        
        $table_name = 'programmes p';
        
        $select = array(
                    'p.progid',
                    'p.progname'
                );
        
        $joins = array(
                    array('table' => 'departments d', 'on' => 'p.deptid = d.deptid')                        
                );
        
        foreach($params as $field => $value) {
            $where = array(
                        array('field' => "d.{$field}", 'value' => $value)
                    );
        }
        
        $order = array(
                    array('field' => 'd.deptid', 'dir' => 'asc')
                );
        
        return $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
    }// End func get_dept_progs
    
    /**
     * Get all staff in a department
     * 
     * @access public
     * @param array $params
     * @return void
     */
    public function get_dept_staffs(array $params) {
        
        // Check if param is empty
        if(empty($params)) {
            return ['status' => DEFAULT_NOT_VALID];
        }
        
        $table_name = 'users u';
        
        $select = array(
                    'u.userid',
                    'u.usertypeid',
                    'u.fname',
                    'u.lname'
                );
        
        $joins = array(
                    array('table' => 'staffs s', 'on' => 'u.userid = s.userid'),
                    array('table' => 'departments d', 'on' => 's.deptid = d.deptid'),                       
                );
        
        foreach($params as $field => $value) {
            $where = array(
                        array('field' => "d.{$field}", 'value' => $value)
                    );
        }
        $order = array(
                    array('field' => 'u.usertypeid', 'dir' => 'asc')
                );
        
        return $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
    }// End func get_dept_staffs
    
    
} // End class College_model

// End file college_model.php

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
        
        // Retrieve all progrmmes if a programme id is not specified.
        if(empty($ids)) {
            
            // Construct sql query
            $this->db->select('*');
            $this->db->from('departments d');
            $this->db->join('colleges c', 'd.colid = c.colid');
            $query = $this->db->get();
            
            // Check if $query is not empty
            if($query->num_rows() > 0) {
                return $query->result();
            }
            
            return DEFAULT_EMPTY;
        } else {
            
            $this->db->select('*');
            $this->db->from('departments d');
            $this->db->join('colleges c', 'd.colid = c.colid');
            
            // Create where condition for deptid
            if(isset($ids['deptid']) && is_numeric($ids['deptid']) && $ids['deptid'] > 0) {  
                $this->db->where('deptid', $ids['deptid']);
            }
            
            // Create where condition for colid
            if(isset($ids['colid']) && is_numeric($ids['colid']) && $ids['colid'] > 0) {  
                $this->db->where('colid', $ids['colid']);
            }
            
            $query = $this->db->get(); 
                
            if($query->num_rows() > 0) {
                return $query->result();
            }

            return DEFAULT_NOT_EXIST;
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
            return DEFAULT_NOT_VALID;
        }
        
        return DEFAULT_EMPTY;
        
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
        
        $ret = $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
        return $ret;
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
            return DEFAULT_NOT_VALID;
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
        
        $ret = $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
        return $ret;
    }// End func get_dept_depts
    
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
            return DEFAULT_NOT_VALID;
        }
        
        return DEFAULT_EMPTY;
        
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
        
        $ret = $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
        return $ret;
    }// End func get_dept_staffs
    
    
} // End class College_model

// End file college_model.php

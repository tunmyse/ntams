<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * College Model
 * 
 * @category   Model
 * @package    College
 * @subpackage 
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class College_model extends CI_Model {
    
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
    public function update($params) {
        $status = $this->db->insert('colleges', $params); 
    }// End func create
	
    /**
     * Create a new college
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_college($id = NULL) {
        $ret = ['status' => DEFAULT_NOT_VALID];
        
        // Set table name
        $table_name = 'colleges';
        $order = array(
                    array('field' => 'colid', 'dir' => 'asc')
                );
        
        // Retrieve all colleges if a college id is not specified.
        if($id == NULL) {
            $ret = $this->util_model->get_data($table_name, array('*'), array(), $order);
        } else {
            
            // Check if id parameter is a valid integer
            if(is_int($id) && $id > 0) {
                
                $where = [
                    ['field' => 'colid', 'value' => $id]
                ];
                
                $ret = $this->util_model->get_data($table_name, ['*'], $where, $order);
                
                if ($ret['status'] === DEFAULT_EMPTY) {
                    $ret['status'] = \DEFAULT_NOT_EXIST;
                }
            }            
            
        }
        
        return $ret;
    }// End func get_college
    
    /**
     * Create a new college
     * 
     * @access public
     * @param array $params
     * @return void
     */
    public function create($params) {
        $status = $this->db->insert('colleges', $params); 
    }// End func create
	
    /**
     * Get all student in a college
     * 
     * @access public
     * @param array $params
     * @return void
     */
    public function get_college_students(array $params) {
        
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
                    array('table' => 'departments d', 'on' => 'p.deptid = d.deptid'),
                    array('table' => 'colleges c', 'on' => 'd.colid = c.colid')                        
                );
        
        $where = array(
                    array('field' => "c.{$field}", 'value' => $value)
                );
        
        $order = array(
                    array('field' => 'u.usertypeid', 'dir' => 'asc')
                );
        
        $ret = $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
        return $ret;
    }// End func get_college_students
    
    /**
     * Get all departments in a college
     * 
     * @access public
     * @param array $params
     * @return void
     */
    public function get_college_depts(array $params) {
        
        // Check if param is empty
        if(empty($params)) {
            return DEFAULT_NOT_VALID;
        }
        
        $table_name = 'departments d';
        
        $select = array(
                    'd.deptid',
                    'd.deptname'
                );
        
        $joins = array(
                    array('table' => 'colleges c', 'on' => 'd.colid = c.colid')                        
                );
        
        foreach($params as $field => $value) {
            $where = array(
                        array('field' => "c.{$field}", 'value' => $value)
                    );
        }
        
        $order = array(
                    array('field' => 'd.deptid', 'dir' => 'asc')
                );
        
        $ret = $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
        return $ret;
    }// End func get_college_depts
    
    /**
     * Get all staff in a college
     * 
     * @access public
     * @param array $params
     * @return void
     */
    public function get_college_staffs(array $params) {
        
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
                    array('table' => 'colleges c', 'on' => 'd.colid = c.colid')                        
                );
        
        foreach($params as $field => $value) {
            $where = array(
                        array('field' => "c.{$field}", 'value' => $value)
                    );
        }
        $order = array(
                    array('field' => 'u.usertypeid', 'dir' => 'asc')
                );
        
        $ret = $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
        return $ret;
    }// End func get_college_staffs
    
    /**
     * Get college department count
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_department_count($id = NULL) {
        
        // Retrieve department count for all colleges.
        if($id == NULL) {
            $this->db->select('*, count(deptid) as count');
            $this->db->group_by('colid');
            $this->db->order_by("colid", "asc"); 
            
            $query = $this->db->get('departments');
            
            // Check if $query is not empty
            if($query->num_rows() > 0) {
                return $query->result();
            }
            
            return DEFAULT_EMPTY;
        } else {
            
            // Check if id parameter is a valid integer
            if(is_numeric($id) && $id > 0) {
                
                // Set id parameter
                $this->db->select('*, count(deptid) as count');
                $this->db->where('colid', $id);
                $this->db->order_by("colid", "asc"); 
                
                $query = $this->db->get('departments');
                
                if($query->num_rows() > 0) {
                    return $query->result();
                }
                
                return DEFAULT_NOT_EXIST;
            }
            
            return DEFAULT_NOT_VALID;
        }
        
    }// End func get_department_count
    
} // End class College_model

// End file college_model.php

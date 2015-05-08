<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Programme Model
 * 
 * @category   Model
 * @package    Programme
 * @subpackage 
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Programme_model extends CI_Model {
	
    /**
     * Table name
     * 
     * @access private
     * @var string
     */
    
    private $table = 'programmes';
    
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
        $status = $this->db->insert($this->table, $params); 
    }// End func create
	
    /**
     * Update a programme
     * 
     * @access public
     * @param array $params
     * @param array $fields
     * @return array
     */
    public function update($params, $fields) {
        return $this->util_model->update($this->table, $params, $fields); 
    }// End func update
    
    /**
     * Delete a department
     * 
     * @access public
     * @param array $fields
     * @return array
     */
    public function delete($fields) {
        return $this->util_model->delete($this->table, $fields); 
    }// End func delete
    
    /**
     * Get programmes
     * 
     * @access public
     * @param array ids
     * @return void
     */
    public function get_programme($ids = array()) {
        // Build query parameters
        $table_name = $this->table.' p';
        $select = ['*', 'p.remark AS prog_remark'];
        $join = [
            ['table' => 'departments d', 'on' => 'p.deptid = d.deptid'],
            ['table' => 'colleges c', 'on' => 'd.colid = c.colid']
        ];
                
        // Retrieve all progrmmes if a programme id is not specified.
        if(empty($ids)) {
            return $this->util_model->get_data($table_name, $select, [], [], $join);
                       
        } else {
            $where = [];
                    
            // Create where condition for progid
            if(isset($ids['prog_id']) && is_numeric($ids['prog_id']) && $ids['prog_id'] > 0) {
                $where[] = ['field' => 'progid', 'value' => $ids['prog_id']];
            }
            
            // Create where condition for deptid
            if(isset($ids['dept_id']) && is_numeric($ids['dept_id']) && $ids['dept_id'] > 0) {  
                $where[] = ['field' => 'deptid', 'value' => $ids['dept_id']];
            }
            
            // Create where condition for colid
            if(isset($ids['col_id']) && is_numeric($ids['col_id']) && $ids['col_id'] > 0) {  
                $where[] = ['field' => 'colid', 'value' => $ids['col_id']];   
            }
            
            $ret = $this->util_model->get_data($table_name, $select, $where, [], $join);
                
            if ($ret['status'] === DEFAULT_EMPTY) {
                $ret['status'] = \DEFAULT_NOT_EXIST;
            }

            return $ret;
        }
        
    }// End func get_programme
    
    /**
     * Get all student in a programme
     * 
     * @access public
     * @param array $params
     * @return void
     */
    public function get_prog_students(array $params) {
        
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
                    array('table' => 'programmes p', 'on' => 's.progid = p.progid')                      
                );
        
        foreach($params as $field => $value) {
            $where = array(
                        array('field' => "p.{$field}", 'value' => $value)
                    );
        }
        
        $order = array(
                    array('field' => 'u.usertypeid', 'dir' => 'asc')
                );
        
        return $this->util_model->get_data($table_name, $select, $where, $order, $joins);
        
    }// End func get_prog_students
    
} // End class Programme_model

// End file programme_model.php

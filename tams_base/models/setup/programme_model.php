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
        $status = $this->db->insert('programmes', $params); 
    }// End func create
	
    /**
     * Get programmes
     * 
     * @access public
     * @param array ids
     * @return void
     */
    public function get_programme($ids = array()) {
        // Build query parameters
        $table_name = 'programmes p';
        $select = ['*'];
        $join = [
            ['table' => 'departments d', 'on' => 'p.deptid = d.deptid'],
            ['table' => 'colleges c', 'on' => 'd.colid = c.colid']
        ];
                
        // Retrieve all progrmmes if a programme id is not specified.
        if(empty($ids)) {
            return $this->util_model->get_data($table_name, $select, [], [], $join);
                       
        } else {
            
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
} // End class Programme_model

// End file programme_model.php

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
        
        // Retrieve all progrmmes if a programme id is not specified.
        if(empty($ids)) {
            
            // Construct sql query
            $this->db->select('*');
            $this->db->from('programmes p');
            $this->db->join('departments d', 'p.deptid = d.deptid');
            $this->db->join('colleges c', 'd.colid = c.colid');
            $query = $this->db->get();
            
            // Check if $query is not empty
            if($query->num_rows() > 0) {
                return $query->result();
            }
            
            return DEFAULT_EMPTY;
        } else {
            
            $this->db->select('*');
            $this->db->from('programmes p');
            $this->db->join('departments d', 'p.deptid = d.deptid');
            $this->db->join('colleges c', 'd.colid = c.colid');
            
            // Create where condition for progid
            if(isset($ids['prog_id']) && is_numeric($ids['prog_id']) && $ids['prog_id'] > 0) {  
                $this->db->where('progid', $ids['prog_id']);
            }
            
            // Create where condition for deptid
            if(isset($ids['dept_id']) && is_numeric($ids['dept_id']) && $ids['dept_id'] > 0) {  
                $this->db->where('deptid', $ids['dept_id']);
            }
            
            // Create where condition for colid
            if(isset($ids['col_id']) && is_numeric($ids['col_id']) && $ids['col_id'] > 0) {  
                $this->db->where('colid', $ids['col_id']);            
            }
            
            $query = $this->db->get(); 
                
            if($query->num_rows() > 0) {
                return $query->result();
            }

            return DEFAULT_NOT_EXIST;
        }
        
    }// End func get_programme
} // End class Programme_model

// End file programme_model.php

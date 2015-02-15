<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Access Control Model
 * 
 * @category   Model
 * @package    Access Control
 * @subpackage Admission
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>, Suleodu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Access_Control_model extends CI_Model {
	
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
 
    
    /*
    |--------------------------------------------------------------------------
    | Group related functions
    |--------------------------------------------------------------------------
    */
    
    /**
     *  Get groups belonging to a user
     * 
     * @access public
     * @param int $owner
     * @return array
     */
    public function get_groups($owner) {
        $table_name = 'groups g';
        
        $select = array(
                    'g.groupid',
                    'g.name',
                    'g.owner',
                    'CONCAT(u.lname, " ", u.fname) AS ownername',
                    'u.userid',
                    'u.usertype',
                    FALSE
                );
        
        $joins = array(
                    array('table' => 'users u', 'on' => 'u.userid = g.owner')                  
                );
        
        $where = [];
        if(is_int($owner)) {
            $where = array(
                        array('field' => "g.owner", 'value' => $owner)
                    );
        }
        return $this->util_model->get_data($table_name, $select, $where, array(), $joins);
    }// end func get_groups
    
    /**
     *  Get groups belonging to a user
     * 
     * @access public
     * @param int $group_id
     * @return array
     */
    public function get_group_info($group_id) {
        $table_name = 'groups g';
        
        $select = array(
                    'g.groupid',
                    'g.name',
                    'g.owner',
                    'g.description',
                    'CONCAT(u.lname, " ", u.fname) AS ownername',
                    'u.userid',
                    'u.usertype',
                    FALSE
                );
        
        $joins = array(
                    array('table' => 'users u', 'on' => 'u.userid = g.owner')                  
                );
        
        $where = array(
                    array('field' => "g.groupid", 'value' => $group_id)
                );
        
        return $this->util_model->get_data($table_name, $select, $where, [], $joins, [], QUERY_OBJECT_ROW);
    }// end func get_group_info
    
    /**
     *  Get associations for a certain group
     * 
     * @access public
     * @param int $group_id
     * @return array
     */
    public function get_group_assoc($group_id) {
        $table_name = 'groups g';
        
        $select = array(
                    'g.groupid',
                    'g.name',
                    'g.owner',
                    'u.lname',
                    'u.fname',
                    'u.userid'
                );
        
        $joins = array(
                    array('table' => 'users u', 'on' => 'u.userid = g.owner')                  
                );
        
        $where = [];
        if(is_int($owner)) {
            $where = array(
                        array('field' => "g.owner", 'value' => $owner)
                    );
        }
        return $this->get_data($table_name, $select, $where, array(), $joins);
    }// end func get_group_assoc
    
    /**
     * Create a new user group
     * 
     * @access public
     * @param array $param
     * @return array
     */
    public function create_group($param) {
        // Set response message.
        $resp = array('status' => DEFAULT_ERROR);  
        
        // Perform insert.
        $ret = $this->db->insert('groups', $param);

        // Set success response message
        if($ret) {
            $resp['status'] = DEFAULT_SUCCESS;
            $resp['rs'] = $this->db->insert_id();
        }else {
            if($this->db->_error_number() == 1062) {
                $resp['status'] = DEFAULT_EXIST;
            }else {
                $resp['status'] = DEFAULT_ERROR;
            }
        }

        return $resp;
    } //End of func create_group
    
    
    /*
    |--------------------------------------------------------------------------
    | Role related functions
    |--------------------------------------------------------------------------
    */
    
    /**
     * Create a new user role
     * 
     * @access public
     * @param array $param
     * @return array
     */
    public function create_role($param) {
        // Set response message.
        $resp = array('status' => DEFAULT_ERROR);  
        
        // Perform insert.
        $ret = $this->db->insert('roles', $param);

        // Set success response message
        if($ret) {
            $resp['status'] = DEFAULT_SUCCESS;
            $resp['rs'] = $this->db->insert_id();
        }else {
            if($this->db->_error_number() == 1062) {
                $resp['status'] = DEFAULT_EXIST;
            }else {
                $resp['status'] = DEFAULT_ERROR;
            }
        }

        return $resp;
    } //End of func create_role
    
} // End class Access_Control_model

// End file access_control_model.php

<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Utility Model
 * 
 * @category   Model
 * @package    Util
 * @subpackage 
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Util_model extends CI_Model {
	
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
     * Log request for a password reset
     * 
     * @access public
     * @param array $query_fields
     * @return int
     */
    public function create_request_entry($query_fields) {
        
        // Check if user has a pending reset request
        $query = $this->db->get_where('reset_request', array('userid' => $query_fields['userid']));
        $result = $query->row();
        
        if($query->num_rows() > 0) {
            
            // Get reset link expiration time
            $expiration_time = $this->config->item('password_expiration_time');

            // Construct date objects to check if link has expired.
            $cur_date = new DateTime('now');
            $exp_date = new DateTime(date('Y-m-d H:i:s', strtotime($result->date)));
            $exp_date->modify("+{$expiration_time} hour");
            
            if($cur_date > $exp_date) {
                $this->invalidate_reset_link($result->userid); 
            }else {
                return DEFAULT_EXIST;
            }
        }
        
        // Insert new entry if no entry already exists
        $ret = $this->db->insert('reset_request', $query_fields);
        
        if(!$ret)
            return DEFAULT_ERROR;
        
        return DEFAULT_SUCCESS;
    }
    
    /**
     * Check if a reset link exists, or is valid
     * 
     * @access public
     * @param string $uid
     * @return uid (string)
     */
    public function check_reset_link($uid) {
        
        $query = $this->db->get_where('reset_request', array('uid' => $uid));
        
        if($query->num_rows() > 0) {
            
            $result = $query->row();
            // Get reset link expiration time
            $expiration_time = $this->config->item('password_expiration_time');

            // Check if link has expired.
            $cur_date = new DateTime('now');
            $exp_date = new DateTime(date('Y-m-d H:i:s', strtotime($result->date)));
            $exp_date->modify("+{$expiration_time} hour");
            
            if($cur_date > $exp_date) {
                $this->invalidate_reset_link($result->userid);
                return DEFAULT_EXPIRED;
            }else {
                return $result;
            }
        
        }
        
        return DEFAULT_NOT_EXIST;
        
    }// End func check_reset_link
    
    /**
     * Delete any reset id for a particular user
     * 
     * @access public
     * @param int $userid
     * @return void
     */
    public function invalidate_reset_link($userid) {
        $this->db->delete('reset_request', array('userid' => $userid)); 
    }// End func invalidate_reset_link
    
    /**
     * Check if a user value is unique
     * 
     * @access public
     * @param string value, string $type
     * @return uid (string)
     */
    public function is_user_unique($value, $type) {
        
        // Get schoolid
        $schoolid = $this->main->item('school_id');
        
        $query = $this->db->get_where('users', array('schoolid' => $schoolid, $type => $value));
        
        return ($query->num_rows() > 0)? false: true;
        
    }// End func is_user_unique
    
    /**
     * Retrieve school information
     * 
     * @access public
     * @return void
     */
    public function get_current_session() {
        return $this->get_data(
                            'session', 
                            array('*'), 
                            array(
                                array('field' => 'status', 'value' => 'Active')
                            ),
                            array(),
                            array(),
                            array(),
                            QUERY_OBJECT_ROW
                        );
    }// End func get_school_name
    
    /**
     * Retrieve school information
     * 
     * @access public
     * @return void
     */
    public function get_school_name() {
        return $this->get_data(
                            'schools', 
                            array('schoolid', 'shortname')                            
                        );
    }// End func get_school_name
    
    /**
     * Retrieve school's college name
     * 
     * @access public
     * @param int $userid
     * @return void
     */
    public function get_school_college() {
        return $this->get_data(
                            'schools', 
                            array('unitname')                            
                        );
    }// End func get_school_college
    
    
    /**
     * Get data from a table
     * 
     * @access public
     * @param string $table, array $fields, array $where, array $order, array $join, array group, int r_set, array $limit
     * @return mixed (int | array | object)
     */
    public function get_data(
            $table, 
            array $fields = array('*'), 
            array $where = array(), 
            array $order = array(), 
            array $join = array(), 
            array $group = array(), 
            $r_set = 3, 
            array $limit = array()) {
                
        // Check if table name is supplied
        if(!isset($table) || $table == '') {            
            return DEFAULT_NOT_VALID;
        }
        
        // Prepare select fields 
        $select = implode(',', $fields);        
        
        $this->db->select($select);
        $this->db->from($table);
        
        // Prepare join clause
        foreach($join as $j) {
            $this->db->join($j['table'], $j['on']);
        }
        
        // Prepare where clause
        foreach($where as $w) {
            $this->db->where($w['field'], $w['value']);
        }
        
        // Prepare group by clause
        foreach($group as $g) {
            $this->db->group_by($g);
        }
        
        // Prepare order by clause
        foreach($order as $o) {
            $this->db->order_by($o['field'], $o['dir']);
        }
        
        // Prepare limit clause
        if(!empty($limit)) {
            $size = count($limit);
            $offset = ($size > 1)? $limit[0]: 0;
            $count = ($size == 1)? $limit[0]: $limit[1];
            
            $this->db->limit($offset, $count);
        }        
        
        // Run query
        $query = $this->db->get();
        
        // Check if query is empty
        if($query->num_rows() > 0) {
            switch($r_set) {
                case QUERY_ARRAY_ROW:
                     $result_set = $query->row_array();
                    break;
                
                case QUERY_ARRAY_RESULT:
                    $result_set = $query->result_array();
                    break;
                
                case QUERY_OBJECT_ROW:
                    $result_set = $query->row();
                    break;
                    
                default:
                    $result_set = $query->result();
            }
            
            return $result_set;
        }
        
        return DEFAULT_EMPTY;
    }
    
} // End class Util_model

// End file util_model.php

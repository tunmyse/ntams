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
        
        if($query->num_rows() > 0) {
            
            $result = $query->row();
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
     * Retrieve session information
     * 
     * @access public
     * @return void
     */
    public function get_current_session() {
        return $this->get_data(
                            'session', 
                            array('*'), 
                            array(
                                array('field' => 'status', 'value' => 'active')
                            )
                        );
    }// End func get_current_session
    
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
     * Retrieve all user's permission.
     *
     * @access public
     * @return array
     **/
    public function get_user_perms($userid) {
        
        $table_name = 'permissions p';
        
        $select = array(
                    'p.permid',
                    'p.name as pname',
                    'm.name as mname'
                );
        
        $joins = array(
                    array('table' => 'role_perms r', 'on' => 'r.permid = p.permid'),
                    array('table' => 'group_roles g', 'on' => 'g.roleid = r.roleid'),
                    array('table' => 'group_users gu', 'on' => 'gu.groupid = g.groupid'),
                    array('table' => 'modules m', 'on' => 'm.moduleid = p.moduleid')                     
                );
        
        
        $where = array(
                    array('field' => "gu.userid", 'value' => $userid)
                );
                
        return $this->get_data($table_name, $select, $where, array(), $joins);
        
        
    } // End func get_user_perms
       
    /**
     * Retrieve navigation contents to build menu
     *
     * @access public
     * @param array $perms
     * @return array
     **/
    public function get_nav_content(Array $perms) {
        
        $perms = empty($perms)? ['0']: $perms;
        
   
//         "SELECT `ml`.`url`, `ml`.`name`, `m`.`dispname`, `m`.`urlprefix` "
//                . "FROM ".$this->db->protect_identifiers('module_links', TRUE)." ml "
//                //. "JOIN `tams_link_perms` l ON `l`.`linkid` = `ml`.`linkid` AND l.permid IN ( 1, 2, 3 ) "
//                . "JOIN ".$this->db->protect_identifiers('modules', TRUE)." m ON `m`.`moduleid` = `ml`.`moduleid` "
//                . "AND m.status = 'active' "
//                . "AND ml.status = 'active' "
//                . "AND ml.linkid IN "
//                . "()";
        

//        $table_name = 'module_links ml';
//        $select = array(
//                    'ml.url',
//                    'ml.name',
//                    'm.dispname',
//                    'm.urlprefix'
//                ); 
//        
//        $on['l'] = 'l.linkid = ml.linkid ';
//        $on['l'] .= empty($perms)? 'AND l.permid IS NULL': 'AND l.permid IN ('.implode(',', $perms).') ';
//        $on['l'] .= "AND ml.status = 'active'";
//        
//        $on['m'] = 'm.moduleid = ml.moduleid ';
//        $on['m'] .= "AND m.status = 'active'";
//        
//        $joins = array(
//                    array('table' => 'link_perms l', 'on' => $on['l'], 'type' => 'left'),
//                    array('table' => 'modules m', 'on' => $on['m'])                     
//                );
//        
//                
//        return $this->get_data($table_name, $select, [], [], $joins);
        
        $query = "SELECT `ml`.`url`, `ml`.`name`, `m`.`name` as `mname`, `m`.`dispname`,"
                . " `m`.`tilecolor`, `m`.`tileicon`, `m`.`urlprefix` "
                . "FROM ".$this->db->protect_identifiers('module_links', TRUE)." ml "
                . "JOIN ".$this->db->protect_identifiers('link_perms', TRUE)." l ON `l`.`linkid` = `ml`.`linkid` "
                . "JOIN ".$this->db->protect_identifiers('modules', TRUE)." m ON `m`.`moduleid` = `ml`.`moduleid` "
                . "WHERE `ml`.`status` = 'active' AND `m`.`status` = 'active' AND `l`.`permid` IN (".implode(',', $perms).") "
                . "UNION "
                . "SELECT `ml`.`url`, `ml`.`name`, `m`.`name` as `mname`, `m`.`dispname`, "
                . "`m`.`tilecolor`, `m`.`tileicon`, `m`.`urlprefix` "
                . "FROM ".$this->db->protect_identifiers('module_links', TRUE)." ml "
                . "JOIN ".$this->db->protect_identifiers('modules', TRUE)." m ON `m`.`moduleid` = `ml`.`moduleid` "
                . "WHERE `ml`.`status` = 'active' AND `m`.`status` = 'active' "
                . "AND NOT EXISTS (SELECT linkid FROM tams_link_perms".$this->db->protect_identifiers('link_perms', TRUE).")";
             
        return $this->get_query_data($query);
    } // End func get_nav_content
    
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
            $type = isset($j['type'])? $j['type']: '';
            
            $this->db->join($j['table'], $j['on'], $type);
        }
        
        // Prepare where clause
        foreach($where as $w) {
            
            $quote = isset($w['quote'])? false: true;
            $logic = isset($w['logic']);
            $mod = isset($w['mod'])? $w['mod']: '';
            switch($mod) {
                case 'in':
                    $logic? $this->db->or_where_in($w['field'], $w['value']): $this->db->where_in($w['field'], $w['value']);
                    break;
                      
                case 'like':
                    $logic? $this->db->or_like($w['field'], $w['value']): $this->db->like($w['field'], $w['value']);
                    break;
                
                default:
                    $logic? $this->db->or_where($w['field'], $w['value']): $this->db->where($w['field'], $w['value']);
                    
            }
            
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
    
    
    /**
     * Get data from a table
     * 
     * @access public
     * @param string $table, array $fields, array $where, array $order, array $join, array group, int r_set, array $limit
     * @return mixed (int | array | object)
     */
    public function get_query_data($query, $r_set = 3) {
        
        // Check if query is supplied
        if(!isset($query) || $query == '') {            
            return DEFAULT_NOT_VALID;
        }
        
        // Run query
        $result = $this->db->query($query);
        
        // Check if result is empty
        if($result->num_rows() > 0) {
            switch($r_set) {
                case QUERY_ARRAY_ROW:
                     $result_set = $result->row_array();
                    break;
                
                case QUERY_ARRAY_RESULT:
                    $result_set = $result->result_array();
                    break;
                
                case QUERY_OBJECT_ROW:
                    $result_set = $result->row();
                    break;
                    
                default:
                    $result_set = $result->result();
            }
            
            return $result_set;
        }
        
        return DEFAULT_EMPTY;
    }
} // End class Util_model

// End file util_model.php

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
        
        // Check if the user has an unused reset request
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
                            ),
                            array(),
                            array(),
                            array(),
                            QUERY_OBJECT_ROW
                        );
    }// End func get_current_session
    
    /**
     * Retrieve school information
     * 
     * @access public
     * @return void
     */
    public function get_school_details($domain) {
        return $this->get_data(
                            'schools', 
                            array('schoolid', 'shortname', 'schoolname', 'unitname', 'domainstring', 'admin'), 
                            array(
                               // Uncomment to use in multi-tenant environment.
                               // array('field' => "domainstring", 'value' => strtolower($domain))
                            ),
                            array(),
                            array(),
                            array(),
                            QUERY_OBJECT_ROW
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
     * @param int $user_id The user to retrieve permissions for.
     * @return array
     **/
    public function get_user_perms($user_id) {
        
        $query_data = [$user_id, $user_id, $user_id, $user_id];
        
        $query = "SELECT `p`.`permid`, `p`.`name` as `pname`, `m`.`name` as `mname`, `a`.`parenttype`, `a`.`extradata` "
                . "FROM ".$this->db->protect_identifiers('permissions', TRUE)." p "
                . "JOIN ".$this->db->protect_identifiers('modules', TRUE)." m ON `m`.`moduleid` = `p`.`moduleid` "
                . "JOIN ".$this->db->protect_identifiers('access_assigns', TRUE)." a ON `a`.`childid` = `p`.`permid` "
                . "AND `a`.`childtype` = 'perm' "
                
                // get direct assignments
                . "WHERE (`a`.`parenttype` = 'user' AND `a`.`parentid` = ?) "
                
                // direct assignments to roles
                . "OR (`a`.`parenttype` = 'role' AND `a`.`parentid` IN " 
                . "(SELECT `roleid` FROM ".$this->db->protect_identifiers('role_users', TRUE)
                . " WHERE `status` = 'active' AND `userid` = ?)) "
                
                // direct assignments to groups 
                . "OR (`a`.`parenttype` = 'group' AND `a`.`parentid` IN " 
                . "(SELECT groupid FROM ".$this->db->protect_identifiers('group_users', TRUE)
                . " WHERE `status` = 'active' AND  `userid` = ?)) "
                
                // assignments to group roles
                . "UNION ALL "
                . "SELECT `p`.`permid`, `p`.`name`, `m`.`name`, `a`.`parenttype`, `a`.`extradata` "
                . "FROM ".$this->db->protect_identifiers('permissions', TRUE)." p "
                . "JOIN ".$this->db->protect_identifiers('modules', TRUE)." m ON `m`.`moduleid` = `p`.`moduleid` "
                . "JOIN ".$this->db->protect_identifiers('access_assigns', TRUE)." a ON `a`.`childid` = `p`.`permid` "
                . "AND `a`.`childtype` = 'perm' AND `a`.`parenttype` = 'role' "
                . "WHERE `a`.`parentid` IN " 
                . "(SELECT `childid` FROM ".$this->db->protect_identifiers('access_assigns', TRUE)." a "
                . "JOIN ".$this->db->protect_identifiers('group_users', TRUE)." g ON `g`.`groupid` = `a`.`parentid` "
                . "AND `a`.`parenttype` = 'group' "
                . "WHERE `g`.`userid` = ?) ";
             
        return $this->util_model->get_query_data($query, $query_data);
       
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

        // TODO one query can get all the results required here.
        // Simply LEFT JOIN link_perms table, the null fields are the links without permissions.
        // NB: Done, watch for anomalies.
        $query = "SELECT `ml`.`url`, `ml`.`name`, `m`.`name` as `mname`, `m`.`dispname`,"
                . " `m`.`tilecolor`, `m`.`tileicon`, `m`.`urlprefix`, `m`.`order` as `mod_order`"
                . "FROM ".$this->db->protect_identifiers('module_links', TRUE)." ml "
                . "JOIN ".$this->db->protect_identifiers('modules', TRUE)." m ON `m`.`moduleid` = `ml`.`moduleid` "
                . "LEFT JOIN ".$this->db->protect_identifiers('link_perms', TRUE)." l ON `l`.`linkid` = `ml`.`linkid` AND `l`.`permid` IN (".implode(',', $perms).") "
                . "WHERE `ml`.`status` = `m`.`status` AND `m`.`status` = 'active' "
                . "ORDER BY `mod_order` ASC";
//                . "UNION "
//                . "SELECT `ml`.`url`, `ml`.`name`, `m`.`name` as `mname`, `m`.`dispname`, "
//                . "`m`.`tilecolor`, `m`.`tileicon`, `m`.`urlprefix`, `m`.`order` as `mod_order` "
//                . "FROM ".$this->db->protect_identifiers('module_links', TRUE)." ml "
//                . "JOIN ".$this->db->protect_identifiers('modules', TRUE)." m ON `m`.`moduleid` = `ml`.`moduleid` "
//                . "WHERE `ml`.`status` = `m`.`status` AND `m`.`status` = 'active' "
//                . "AND `ml`.linkid NOT IN (SELECT linkid FROM ".$this->db->protect_identifiers('link_perms', TRUE).")";
             
        return $this->get_query_data($query);
    } // End func get_nav_content
    
    /**
     * Get data from a table
     * 
     * @access public     * 
     * @param string $table Table to query from
     * @param array $fields Fields to include in the result set
     * @param array $where Where clause to include in the query
     * @param array $order Order by clause to in the query
     * @param array $join Join clause to include in the query
     * @param array $group Group by clause to include in the query
     * @param int $r_set The type of the resultset returned
     * @param array $limit The number of rows to include in the result set (Two values indicate offset and amount)
     * @return array Status of the query, and the resultset, only if query was successful
     */
    public function get_data(
            $table, 
            array $fields = array('*'), 
            array $where = array(), 
            array $order = array(), 
            array $join = array(), 
            array $group = array(), 
            $r_set = QUERY_OBJECT_RESULT, 
            array $limit = array()) {
                
        // Check if table name is supplied
        if(!isset($table) || $table == '') {            
            return array('status' => DEFAULT_NOT_VALID);
        }
        
        // Prepare select fields 
        $quote = true;
        if(($pos = count($fields) - 1) > 0 && $fields[$pos] === false) {
            unset($fields[$pos]);
            $quote = false;
        }
        
        $select = implode(',', $fields);        
        
        $this->db->select($select, $quote);
        $this->db->from($table);
        
        // Prepare join clause
        foreach($join as $j) {
            $type = isset($j['type'])? $j['type']: '';
            
            $this->db->join($j['table'], $j['on'], $type);
        }
        
        // Prepare where clause
        foreach($where as $w) {
            // TODO add not clauses
            $quote = isset($w['quote'])? false: true;
            $logic = isset($w['logic']);
            $mod = isset($w['mod'])? $w['mod']: '';
            $negate = isset($w['negate']);
            
            switch($mod) {
                case 'in':
                    if($negate) {
                        $logic? $this->db->or_where_not_in($w['field'], $w['value']): 
                            $this->db->where_not_in($w['field'], $w['value']);
                    }else {
                        $logic? $this->db->or_where_in($w['field'], $w['value']): 
                            $this->db->where_in($w['field'], $w['value']);
                    }                    
                    break;
                      
                case 'like':
                    if($negate) {
                        $logic? $this->db->or_not_like($w['field'], $w['value']): 
                            $this->db->not_like($w['field'], $w['value']);
                    }else {
                        $logic? $this->db->or_like($w['field'], $w['value']): 
                            $this->db->like($w['field'], $w['value']);
                    } 
                    
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
            
            $this->db->limit($count, $offset);
        }        
        
        // Run query
        $result = $this->db->get();
        
        if($result) {
            
            // Set default return value 
            $ret = array('status' => DEFAULT_EMPTY);
            
            // Check if query is not empty
            if($r_count = $result->num_rows() > 0) {
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

                $ret = array('status' => DEFAULT_SUCCESS, 'rs' => $result_set, 'cursor' => &$result, 'count' => $r_count);
            }
            
        }else {
            $ret = array('status' => DEFAULT_ERROR);
        }
        
        return $ret;
    } // End func get_data
    
    
    /**
     * Get data from a table
     * 
     * @access public
     * @param string $query Query to be executed
     * @param array $data Data to be bound with the query
     * @param int $r_set The type of the result returned
     * @return array Status of the query, and the resultset, only if query was successful
     */
    public function get_query_data($query, $data = array(), $r_set = QUERY_OBJECT_RESULT) {
        
        // Check if query is supplied
        if(!isset($query) || $query == '') {            
            return array('status' => DEFAULT_NOT_VALID);
        }
               
        // Run query
        $result = empty($data)? $this->db->query($query): $this->db->query($query, $data);
        
        if($result) {
            // Set default return value 
            $ret = array('status' => DEFAULT_EMPTY);
            
            // Check if result is empty
            if($r_count = $result->num_rows() > 0) {
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

                $ret = array('status' => DEFAULT_SUCCESS, 'rs' => $result_set, 'cursor' => $result, 'count' => $r_count);
            }
            
        }else {
            $ret = array('status' => DEFAULT_ERROR);
        }
        
        return $ret;
    }// End func get_query_data
    
    /**
     * Delete data from a table
     * 
     * @access public
     * @param string $table Table to delete from
     * @param array $fields Fields used to build where clause for the delete
     * @return array Status of the query
     */
    public function delete($table, array $fields) {
                
        // Check if proper arguments are supplied
        if(!isset($table) || $table == '' || !is_array($fields) || empty($fields)) {            
            return array('status' => DEFAULT_NOT_VALID);
        }
        
        foreach ($fields as $field) {
            $this->db->where($field['field'], $field['value']);
        }
        
        // Run query
        $result = $this->db->delete($table);
        
        if($result) {
            
            // Set default return value 
            $ret = array('status' => DEFAULT_EMPTY);
            
            // Check if affected_rows is not empty
            if($r_count = $this->db->affected_rows() > 0) {                
                $ret = array('status' => DEFAULT_SUCCESS, 'count' => $r_count);
            }
            
        }else {
            $ret = array('status' => DEFAULT_ERROR);
            
            switch($this->db->_error_number()) {
                case 1451:
                    $ret['status'] = \DEFAULT_EXIST;
                    break;
                
                case 1054:
                    $ret['status'] = \DEFAULT_NOT_VALID;
                    break;
            }
        }
        
        return $ret;
    } // End func delete
    
    /**
     * Update data in a table
     * 
     * @access public
     * @param string $table Table to update
     * @param array $params Data to update
     * @param array $fields Fields used to build where clause for the update
     * @return array Status of the query
     */
    public function update($table, array $params, array $fields) {
                
        // Check if proper arguments are supplied
        if(!isset($table) || $table == '' || !is_array($params) || empty($params) || !is_array($fields) || empty($fields)) {            
            return array('status' => DEFAULT_NOT_VALID);
        }
        
        foreach ($fields as $field) {
            $this->db->where($field['field'], $field['value']);
        }
        
        // Run query
        $result = $this->db->update($table, $params);
        
        if($result) {
            
            // Set default return value 
            $ret = array('status' => DEFAULT_EMPTY);
            
            // Check if affected_rows is not empty
            if($r_count = $this->db->affected_rows() > 0) {                
                $ret = array('status' => DEFAULT_SUCCESS, 'count' => $r_count);
            }
            
        }else {
            $ret = array('status' => DEFAULT_ERROR);
            
            switch($this->db->_error_number()) {
                case 1062:
                    $ret['status'] = \DEFAULT_EXIST;
                    break;
                
                case 1054:
                    $ret['status'] = \DEFAULT_NOT_VALID;
                    break;
            }
        }
        
        return $ret;
    } // End func update
    
} // End class Util_model

// End file util_model.php

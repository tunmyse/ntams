<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * User Manager Model
 * 
 * @category   Model
 * @package    User Manager
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class User_Manager_model extends CI_Model {
	
    /**
     * School id
     * 
     * @access private
     * @var int
     */
    private $school_id;
    
    /**
     * Class constructor
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();

        $this->school_id = $this->main->item('school_id');
    } // End func __construct
 
    /**
     *  Get suggestions for a access assignments
     * 
     * @access public
     * @param int $owner
     * @return array
     */
    public function get_suggestions($params) {        
        
        $id_field = '';
        $table = 'user';
        $fields = ['*'];
        $where = [];
        
        switch($params['type']) {

            case 'Permission':
                $id_field = 'permid';
                $table = 'permissions';
                $fields = ['permid AS id', 'name'];
                array_push($where, ['field' => "name", 'value' => $params['query'], 'mod' => "like"]);
//                                    ['field' => "moduleid", 'value' => $params['module_id']]);
                break;
            
            case 'Role':
                $id_field = 'roleid';
                $table = 'roles';
                $fields = ['roleid AS id', 'name'];
                array_push($where, ['field' => "schoolid", 'value' => $params['school_id']],
                                    ['field' => "name", 'value' => $params['query'], 'mod' => "like"]);
                break;

            case 'Group':
                $id_field = 'groupid';
                $table = 'groups';
                $fields = ['groupid AS id', 'name'];
                array_push($where, ['field' => "schoolid", 'value' => $params['school_id']],
                                    ['field' => "name", 'value' => $params['query'], 'mod' => "like"]);
                break;
                
            case 'User':
                $id_field = 'userid';
                $table = 'users';
                $fields = ['userid AS id', 'CONCAT(lname, " ", fname) AS name', FALSE];
                array_push($where, ['field' => "schoolid", 'value' => $params['school_id']],
                            ['field' => "fname", 'value' => $params['query'], 'mod' => "like"],
                            ['field' => "lname", 'value' => $params['query'], 'mod' => "like", 'logic' => true],
                            ['field' => "mname", 'value' => $params['query'], 'mod' => "like", 'logic' => true]
                        );

        }
        
        array_push($where, ['field' => $id_field, 'value' => $params['exclude'], 'mod' => "in", 'negate' => true]);
        
        return $this->util_model->get_data($table, $fields, $where, [], [], [], QUERY_OBJECT_RESULT, [10]);
    }
    
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
        
        $select = [
                    'g.groupid',
                    'g.name',
                    'g.owner',
                    'CONCAT(u.lname, " ", u.fname) AS ownername',
                    'u.userid',
                    'u.usertype',
                    FALSE
                ];
        
        $joins = [
                    ['table' => 'users u', 'on' => 'u.userid = g.owner']                
                ];
        
        $where[] = ['field' => "g.schoolid", 'value' => $this->school_id];
        
        if(is_int($owner)) {
            $where[] = ['field' => "g.owner", 'value' => $owner];
        }
        
        return $this->util_model->get_data($table_name, $select, $where, [], $joins);
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
        
        $select = [
                    'g.groupid',
                    'g.name',
                    'g.owner',
                    'g.description',
                    'CONCAT(u.lname, " ", u.fname) AS ownername',
                    'u.userid',
                    'u.usertype',
                    FALSE
                ];
        
        $joins = [
                    ['table' => 'users u', 'on' => 'u.userid = g.owner']                  
                ];
        
        $where = [
                    ['field' => "g.groupid", 'value' => $group_id]
                ];
        
        return $this->util_model->get_data($table_name, $select, $where, [], $joins, [], QUERY_OBJECT_ROW);
    }// end func get_group_info
    
    /**
     *  Get associations for a certain group
     * 
     * @access public
     * @param int $group_id The group to retrieve associations about
     * @return array
     */
    public function get_group_assoc($group_id) {
        
        $query_data = [$group_id, $group_id, $group_id, $group_id];
        // TODO check if result is unique without using DISTINCT
        $query = "SELECT `r`.`roleid` as `id`, `r`.`name`, 'role' as `type`, `r`.`description`, 0 as `exid`, 'NULL' as `exname` "
                . "FROM ".$this->db->protect_identifiers('roles', TRUE)." r "
                . "JOIN ".$this->db->protect_identifiers('access_assigns', TRUE)." a ON `a`.`childid` = `r`.`roleid` "
                . "AND `a`.`childtype` = 'role' "
                . "WHERE `a`.`parenttype` = 'group' AND `a`.`parentid` = ? "
                . "LIMIT 50 "
                . "UNION "
                . "SELECT DISTINCT(`p`.`permid`), `p`.`name`, 'perm' as `type`, `p`.`description`, `m`.`moduleid`, `m`.`dispname` "
                . "FROM ".$this->db->protect_identifiers('permissions', TRUE)." p "
                . "JOIN ".$this->db->protect_identifiers('modules', TRUE)." m ON `m`.`moduleid` = `p`.`moduleid` "
                . "JOIN ".$this->db->protect_identifiers('access_assigns', TRUE)." a ON `a`.`childid` = `p`.`permid` "
                . "AND `a`.`childtype` = 'perm' "
                . "WHERE (`a`.`parenttype` = 'group' AND `a`.`parentid` = ?) OR "
                . "(`a`.`parenttype` = 'role' AND `a`.`parentid` IN "
                . "(SELECT childid FROM ".$this->db->protect_identifiers('access_assigns', TRUE)
                . "WHERE parentid = ? AND parenttype = 'group' AND childtype = 'role')) "
                . "LIMIT 50 "
                . "UNION "
                . "SELECT `u`.`userid`, CONCAT(u.lname,' ', u.fname), `u`.`usertype`, 'NULL', 0, 'NULL' "
                . "FROM ".$this->db->protect_identifiers('users', TRUE)." u "
                . "JOIN ".$this->db->protect_identifiers('group_users', TRUE)." g ON `g`.`userid` = `u`.`userid` "
                . "WHERE `g`.`groupid` = ? "
                . "LIMIT 50";
             
        return $this->util_model->get_query_data($query, $query_data);
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
    
    /**
     * Assign access object to group
     * 
     * @access public
     * @param array $meta
     * @param array $params
     * @return array
     */
    public function assign_to_group($meta, $params) {
        // Set response message.
        $resp = array('status' => DEFAULT_ERROR);  
        $table_name = $meta['childtype'] == 'user'? 'group_users': 'access_assigns';        
        
        $ret = $this->db->insert_batch($table_name, $params);
        
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
    }// end func assign_to_group
    
    
    /*
    |--------------------------------------------------------------------------
    | Role related functions
    |--------------------------------------------------------------------------
    */
    
    /**
     *  Get roles.
     * 
     * @access public
     * @return array
     */
    public function get_roles() {
        $table_name = 'roles r';
        
        $select = ['r.roleid', 'r.name'];
        
        $where = [['field' => "r.schoolid", 'value' => $this->school_id]];
        
        return $this->util_model->get_data($table_name, $select, $where, [], []);
    }// end func get_groups
    
    /**
     *  Get role's information
     * 
     * @access public
     * @param int $role_id
     * @return array
     */
    public function get_role_info($role_id) {
        $table_name = 'roles r';
        
        $select = [
                    'r.roleid',
                    'r.name',
                    'r.description'
                ];
        
        $where = [
                    ['field' => "r.roleid", 'value' => $role_id]
                ];
        
        return $this->util_model->get_data($table_name, $select, $where, [], [], [], QUERY_OBJECT_ROW);
    }// end func get_role_info
    
    /**
     *  Get associations for a certain role
     * 
     * @access public
     * @param int $role_id The role to retrieve associations about
     * @return array
     */
    public function get_role_assoc($role_id) {
        
        $query_data = [$role_id, $role_id, $role_id];
        // TODO check if result is unique without using DISTINCT
        $query = "SELECT `g`.`groupid` as `id`, `g`.`name`, 'group' as `type`, `g`.`description`, 0 as `exid`, 'NULL' as `exname` "
                . "FROM ".$this->db->protect_identifiers('groups', TRUE)." g "
                . "JOIN ".$this->db->protect_identifiers('access_assigns', TRUE)." a ON `a`.`parentid` = `g`.`groupid` "
                . "AND `a`.`parenttype` = 'group' "
                . "WHERE `a`.`childtype` = 'role' AND `a`.`childid` = ? "
                . "LIMIT 50 "
                . "UNION "
                . "SELECT DISTINCT(`p`.`permid`), `p`.`name`, 'perm' as `type`, `p`.`description`, `m`.`moduleid`, `m`.`dispname` "
                . "FROM ".$this->db->protect_identifiers('permissions', TRUE)." p "
                . "JOIN ".$this->db->protect_identifiers('modules', TRUE)." m ON `m`.`moduleid` = `p`.`moduleid` "
                . "JOIN ".$this->db->protect_identifiers('access_assigns', TRUE)." a ON `a`.`childid` = `p`.`permid` "
                . "AND `a`.`childtype` = 'perm' "
                . "WHERE `a`.`parenttype` = 'role' AND `a`.`parentid` = ? "
                . "LIMIT 50 "
                . "UNION "
                . "SELECT `u`.`userid`, CONCAT(u.lname,' ', u.fname), `u`.`usertype`, 'NULL', 0, 'NULL' "
                . "FROM ".$this->db->protect_identifiers('users', TRUE)." u "
                . "JOIN ".$this->db->protect_identifiers('role_users', TRUE)." r ON `r`.`userid` = `u`.`userid` "
                . "WHERE `r`.`roleid` = ? "
                . "LIMIT 50";
             
        return $this->util_model->get_query_data($query, $query_data);
    }// end func get_role_assoc
    
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
    
    /**
     * Assign access object to role
     * 
     * @access public
     * @param array $meta
     * @param array $params
     * @return array
     */
    public function assign_to_role($meta, $params) {
        // Set response message.
        $resp = array('status' => DEFAULT_ERROR);         
        $table_name = $meta['childtype'] == 'user'? 'role_users': 'access_assigns'; 
                
        $ret = $this->db->insert_batch($table_name, $params);

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
    }// end func assign_to_role
    
    
    /*
    |--------------------------------------------------------------------------
    | User related functions
    |--------------------------------------------------------------------------
    */
    
    /**
     * Assign access object to user
     * 
     * @access public
     * @param array $meta
     * @param array $params
     * @return array
     */
    public function assign_to_user($meta, $params) {
        // Set response message.
        $resp = array('status' => DEFAULT_ERROR);        
        $type_map = ['group' => 'group_users', 'role' => 'role_users', 'perm' => 'access_assigns'];
        $table_name = $type_map[$meta['childtype']]; 
        
        $ret = $this->db->insert_batch($table_name, $params); 
        
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
    }// end func assign_to_user
    
} // End class Access_Control_model

// End file access_control_model.php

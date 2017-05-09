<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * User Model
 * 
 * @category   Model
 * @package    Users
 * @subpackage User
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class User_model extends CI_Model {
        
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
     * Authenticate user against database
     * Returns false if record does not exist.
     * 
     * @access public
     * @param array $query_fields
     * @return mixed (bool | array)
     */
    public function authenticate_user(array $query_fields) {

        // Build query to authenticate user against a database entry
        $tablename = $this->db->dbprefix('users');
        $sql = "SELECT * "
                . "FROM {$tablename} "
                . "WHERE schoolid = ? "
                . "AND password = ? "
                . "AND (email LIKE ? OR usertypeid LIKE ? OR phone LIKE ?) ";


        $result = $this->db->query($sql, 
                        array(
                            $query_fields['school_id'], 
                            $query_fields['password'], 
                            $query_fields['username'], 
                            $query_fields['username'], 
                            $query_fields['username']
                        )
                    )->row_array();
        
        if(empty($result))
            return false;
        
        return $result;

    } // End func authenticate_user        
   
    /**
     * Change a users password
     * 
     * @access public
     * @param int $userid, array $params
     * @return bool
     */
    public function change_user_password($userid, $params) {
        // Build sql
        $this->db->where('userid', $userid);
        $ret = $this->db->update('users', $params);
        
        if($ret)
            return true;
            
        return false;
    }// End func change_user_password
    
    /**
     * Get user information
     * 
     * @access public
     * @param array $params
     * @return array
     */
    public function get_user_info($params, $ext = FALSE){
        
        $join = [];
        $table_name = 'users u';
            
        $select = isset($params['fields'])? $params['fields']: ['*'];

        $where[] = ['field' => "u.schoolid", 'value' => $params['school_id']];
        
        if(array_key_exists('user_id', $params)) {            
            $where[] = ['field' => "u.userid", 'value' => $params['user_id']];        
        }else {
            $where[] = ['field' => "u.email", 'value' => $params['username'], 'mod' => 'like'];        
            $where[] = ['field' => "u.usertypeid", 'value' => $params['username'], 'logic' => true, 'mod' => 'like'];        
            $where[] = ['field' => "u.phone", 'value' => $params['username'], 'logic' => true, 'mod' => 'like'];       
        }    
        
        if($ext) {
            $table_map = [
                'applicant' => 'prospective jt',
                'student' => 'students jt',
                'staff' => 'staffs jt',
                
            ];
            
            if(!$this->main->is_admin()) {
                $join_table = $table_map[$this->main->item('user_type')];
                $join[] = ['table' => $join_table, 'on' => 'u.userid = jt.userid', 'type' => 'LEFT'];
            }
            
            $join[] = ['table' => 'states s', 'on' => 'u.stid = s.stateid', 'type' => 'LEFT'];
            $join[] = [
                'table' => 'state_lga sl', 'on' => 'u.lgaid = sl.lgaid and s.stateid = sl.stateid', 'type' => 'LEFT'
            ];
        }       
        
        return $this->util_model->get_data($table_name, $select, $where, [], $join, [], QUERY_OBJECT_ROW);
    } // End func get_user_info      
    
    /**
     * Get applicant's academic information
     * 
     * @access public
     * @param array $params
     * @return array
     */
    public function get_app_acad_info($params){
        
        $join = [];
        $table_name = $params['user_type'].' ut';
            
        $select = ['ut.*', 'p1.progname as progname1', 'p2.progname as progname2', 'p0.progname as offered', 'a.*'];

        $where[] = ['field' => "ut.userid", 'value' => $params['user_id']];
        
        $join[] = ['table' => 'programmes p1', 'on' => 'ut.prog1 = p1.progid', 'type' => 'LEFT'];
        $join[] = ['table' => 'programmes p2', 'on' => 'ut.prog2 = p2.progid', 'type' => 'LEFT'];
        $join[] = ['table' => 'programmes p0', 'on' => 'ut.offered = p0.progid', 'type' => 'LEFT'];       
        $join[] = ['table' => 'adm_types a', 'on' => 'ut.admtype = a.typeid', 'type' => 'LEFT']; 
        
        return $this->util_model->get_data($table_name, $select, $where, [], $join, [], QUERY_OBJECT_ROW);
    } // End func get_app_acad_info    
    
    /**
     * Get user's academic information
     * 
     * @access public
     * @param array $params
     * @return array
     */
    public function get_acad_info($params){
        
        $join = [];
        $table_name = $params['user_type'].' ut';
            
        $select = isset($params['fields'])? $params['fields']: ['*'];

        $where[] = ['field' => "ut.userid", 'value' => $params['user_id']];
        
        $join[] = ['table' => 'programmes p', 'on' => 'ut.progid = p.progid', 'type' => 'LEFT'];
        $join[] = ['table' => 'departments d', 'on' => 'p.deptid = d.deptid', 'type' => 'LEFT'];
        $join[] = ['table' => 'colleges c', 'on' => 'd.colid = c.colid', 'type' => 'LEFT'];           
        $join[] = ['table' => 'session s', 'on' => 'ut.sesid = s.sesid', 'type' => 'LEFT'];         
        $join[] = ['table' => 'adm_types a', 'on' => 'ut.admtype = a.typeid', 'type' => 'LEFT']; 
        
        return $this->util_model->get_data($table_name, $select, $where, [], $join, [], QUERY_OBJECT_ROW);
    } // End func get_acad_info  
    /**
     * Update a user's profile
     * 
     * @access public
     * @param array $params
     * @return array
     */
    public function update_user_profile($params) {
        $where = [];
        
        if(isset($params['where']) && is_array($params['where'])) {
            foreach($params['where'] as $f => $v) {
                $where[] = ['field' => $f, 'value' => $v];     
            }
        }        
        unset($params['where']);
        
        return $this->util_model->update('users', $params, $where);
    } // End func update_user_profile  
    
} // End class User_model

// End file user_model.php

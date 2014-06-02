<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Exam Model
 * 
 * @category   Model
 * @package    Admission
 * @subpackage Exam
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Exam_model extends CI_Model {
	
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

        //echo $this->db->last_query();
        
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
     * @param (int | array) $params, bool $extended optional
     * @return bool | array
     */
    public function get_user_info($params, $extended=FALSE){
        
        // Add prefix to table name
        $tablename = $this->db->dbprefix('users');
        
        // Build query to retrieve userid and email of user 
        if(array_key_exists('user_id', $params)) {
            $sql = "SELECT * "
               . "FROM {$tablename} "
               . "WHERE schoolid = ? "
               . "AND userid = ?";
            $param = array($params['school_id'], $params['user_id']);
        }else {
            $sql = "SELECT * "
               . "FROM {$tablename} "
               . "WHERE schoolid = ? "
               . "AND (email LIKE ? OR usertypeid LIKE ? OR phone LIKE ?) ";
            $param = array($params['school_id'], $params['username'], $params['username'], $params['username']);
        }
        
        $query = $this->db->query($sql, $param);
        
        if($query->num_rows() < 1) 
            return false;
        
        $result = $query->row();
        
        // Get extended results from appropriate user_type table 
        if($extended && isset($result->usertype)) {
            $this->db->select('*');
            $this->db->from('users u');
            $this->db->join("{$usertype} ut", 'u.userid = ut.userid');
            $query = $this->db->get();
            return $query->row();
        }else{
            return $result;
        }
        
    } // End func get_user_info      
	
    /**
     * Get user's data
     * 
     * @access public
     * @param int $userid
     * @return void
     */
    public function get_user() {
        return $this->util_model->get_data(
                            'schools', 
                             array('unitname')                            
                        );
    }// End func invalidate_reset_link
    
} // End class Exam_model

// End file exam_model.php

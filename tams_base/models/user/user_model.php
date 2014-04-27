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

        //echo $this->db->last_query();
        
        if(empty($result))
            return false;
        
        return $result;

    } // End func authenticate_user        
        
    /**
     * Log request for a password reset
     * 
     * @access public
     * @param array $query_fields
     * @return uid (string)
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
                $this->db->delete('reset_request', array('resetid' => $result->resetid));   
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
     * @param array $query_fields
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
                $this->db->delete('reset_request', array('resetid' => $result->resetid)); 
                return DEFAULT_EXPIRED;
            }else {
                return $result;
            }
        
        }
        
        return DEFAULT_NOT_EXIST;
        
    }// End func check_reset_link
    
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
            $this->db->join("{$usertype}", 'u.userid = ut.userid');
            $query = $this->db->get();
            return $query->row();
        }else{
            return $result;
        }
        
    } // End func get_user_info      
	
} // End class User_model

// End file user_model.php

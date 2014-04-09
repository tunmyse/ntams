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
        $sql = "SELECT * "
                . "FROM tams_users "
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
     * @param tring $uid, array $qurery_fields
     * @return uid (string)
     */
    public function create_request_entry($uid, $query_fields) {
        // Build query to retrieve userid and email of user
        $sql = "SELECT userid, email "
                . "FROM tams_users "
                . "WHERE schoolid = ? "
                . "AND (email LIKE ? OR usertypeid LIKE ? OR phone LIKE ?) ";


        $result = $this->db->query($sql, 
                        array(
                            $query_fields['school_id'], 
                            $query_fields['username'], 
                            $query_fields['username'], 
                            $query_fields['username']
                        )
                    );
        
        if($result->num_rows() < 1) 
            return false;
        
        $info = $result->row();
        
        $insert_data = array(
            'userid'    => $info->userid,
            'uid'       => $uid,
            'date'      => date('Y-m-d H:i:s')
        );
        
        $ret = $this->db->insert($insert_data);
        
        if($ret) {
            return array('email' => $info->email, 'uid' => $uid);
        }
        
        return false;
    }
    
    /**
     * fetch user groups, modules and permissions
     * 
     * @access public
     * @param user id
     * @param account type 
     * @return bool
     */
    public function get_user_info($id_user){

        if(empty($id_user)){
            return false;
        }

        $sql = "select 
                                    g.subject as group_subject,
                                    m.id_module, 
                m.subject as module_subject, 
                m.id_string as module_id_string,
                                    p.subject as perm_subject, 
                p.id_perm, 
                                    p.id_string as perm_id_string,
                                    p.in_menu,
                                    u.id_user 
                from user_perms u
                left join module_perms p on p.id_perm = u.id_perm
                                    and p.in_menu = 1
                left join modules m on m.id_module = p.id_module
                left join module_group g on g.id_group = m.id_group
                where u.id_user = ". $id_user ."
                group by u.id_perm";

        $result = $this->db->query($sql)->result_array();

        if(empty($result)){
            return false;
        }

        return $result;
    } // End func fetch_user_modules_perms

        
	
} // End class User_model

// End file user_model.php
?>

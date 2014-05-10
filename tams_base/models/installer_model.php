<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Installation Model
 * 
 * @category   Model
 * @package    Installation
 * @subpackage 
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Installer_model extends CI_Model {
	
    /**
     * Class constructor
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        parent::__construct();
    } // End func __construct
   
    /**
     * Setup admin and school account
     * 
     * @access public
     * @param array $sch_params, array $adm_params
     * @return void
     */
    public function setup_accounts(array $sch_params, array $adm_params) {
        
        $exist = true;
        
        $exist = $this->db->table_exists($this->db->dbprefix('schools'));
        $exist = $this->db->table_exists($this->db->dbprefix('users'));
        
        if($exist) {
            $this->db->trans_start();
            
            $sch_data = array(
                            'schoolname' => $sch_params['name'],
                            'email' => $sch_params['email'],
                            'phone' => $sch_params['phone'],
                            'shortname' => $sch_params['shortname'],
                            'unitname' => $sch_params['unitname'],
                            'domainstring' => $sch_params['shortname']
                        );      
            $this->db->insert('schools', $sch_data);
            
            $adm_data = array(
                            'fname' => $adm_params['fname'],
                            'lname' => $adm_params['lname'],
                            'email' => $adm_params['email'],
                            'usertype' => 'admin',
                            'schoolid' => $this->db->insert_id(),
                            'password' => $adm_params['password']
                        );     
            $this->db->insert('users', $adm_data);
            
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
               return DEFAULT_ERROR;
            }
            
            return DEFAULT_SUCCESS;
        } else {
            return DEFAULT_NOT_EXIST;
        }
        
    }// End func setup_accounts
    
    /**
     * Run database setup scripts
     * 
     * @access public
     * @param string $sql
     * @return void
     */
    public function run_db_script($sql) {
        
        $this->db->trans_start();
        $this->db->query($sql);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return DEFAULT_ERROR;
        }
        
        return DEFAULT_SUCCESS;
    }// End func setup_accounts
    
} // End class installer_model

// End file installer_model.php

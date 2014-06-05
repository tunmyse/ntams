<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Exam Model
 * 
 * @category   Model
 * @package    Admission Management
 * @subpackage Admission
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>, Suleodu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Admission_model extends CI_Model {
	
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
     * Create a new prospective student
     * 
     * @access public
     * @param array $param
     * @return int
     */
    public function create($param) {
        
        //Initiate transaction 
        $this->db->trans_start();
        
        $this->db->insert('tams_users', $param['user']);

        $param['pros']['userid'] = $this->db->insert_id();
        
        $this->db->insert('tams_prospective',$param['pros']);
        
        // End transaction
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            return DEFAULT_ERROR;
        }

        return DEFAULT_SUCCESS;
    } //End of func create
    
    /** 
     * Get subject(s)
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function verifyRegPayment($id){
        $query = $this->db->get_where('reg_payment', array('pstdid' => $id, 'status' => 'paid'));
        if($query->num_rows()> 0){
            return $query->result_array(); 
        }
        return FALSE;
    }
} // End class Exam_model

// End file exam_model.php

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Payment Model
 * 
 * @category   Model
 * @package    Payment
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Payment_model extends CI_Model{
    
    
    /**
     * Class constructor for payment Model
     * 
     * @access public
     * @return void
     */
    public function __construct() {
        
        parent::__construct();
        $this->load->database();
        
       
    }//end of constructor 
   
    
    public function pay_success_update($params){
        
        //format data to conform to the table structure
        $trans_param = array(
                    'status' => $params['status'],
                    'amt' => $params['amt'],
                    'resp_code' =>($params['resp_code'])? $params['resp_code']:'' ,
                    'resp_desc' => ($params['resp_desc']) ? $params['resp_desc'] : '',
                    'auth_code' => ($params['auth_code']) ? $params['auth_code'] : '',
                    'pan' => ($params['pan'])? $params['pan'] : '',
                    'xml'=> ($params['xml']) ? $params['xml'] : '',
                    'name' => ($params['name']) ? $params['name'] : ''
                );
        
        $this->db->trans_start();
        
            $this->db->update('pay_transactions', $trans_param, array('ordid' => $params['ordid']));

            $this->db->select('percentage');
            $this->db->where('ordid', $params['ordid']);
            $query = $this->db->get('pay_transactions');
            $row = $query->row_array();

            $prepQuery = sprintf(" UPDATE {$this->db->protect_identifiers('user_pay_schedule', TRUE)} "
                                . "SET percentage = percentage + %s "
                                . "WHERE payid = %s ",
                                $row['percentPaid'], 
                                $params['payid']);
            $this->db->query($prepQuery);
            
        $this->db->trans_complete();
         
        if($this->db->trans_status() === FALSE) {

            $status = DEFAULT_ERROR;
        }
        else{
            $status = DEFAULT_SUCCESS;
            
        }
        
        return $status;
    }
    
    
    public function pay_decline_update($params){
        
        //format data to conform to the table structure
        $trans_param = array(
                    'status' => $params['status'],
                    'amt' => 0,
                    'resp_code' =>($params['resp_code'])? $params['resp_code']:'' ,
                    'resp_desc' => ($params['resp_desc']) ? $params['resp_desc'] : '',
                    'auth_code' => ($params['auth_code']) ? $params['auth_code'] : '',
                    'pan' => ($params['pan'])? $params['pan'] : '',
                    'xml'=> ($params['xml']) ? $params['xml'] : '',
                    'name' => ($params['name']) ? $params['name'] : '',
                    'percentPaid' => 0
                );
        
        $this->db->update('pay_transactions', $trans_param, array('ordid' => $params['ordid']));
        $status = $this->db->affected_rows();
        
        if($status > 0){
            
            $status = DEFAULT_SUCCESS;
        }
        else{
            
            $status = DEFAULT_ERROR; 
        }
        
        return $status;
    } 
            
            
            
    public function has_paid($param){
        
        $status = FALSE;
        
        $this->db->select('*');
        $this->db->from('tams_user_pay_schedule ups');
        $this->db->where('ups.userid', $param['userid']);
        $this->db->where('ups.scheduleid', $param['scheduleid']);
        $this->db->where('ups.percentage', $param['percentage']);
        $query = $this->db->get();
        
        if($query->num_rows() > 0){
            $status = TRUE; 
        }
        
        return $status;
        
        
    }
    
}


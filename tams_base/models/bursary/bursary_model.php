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

class Bursary_model extends CI_Model{
    
    
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
    
    
    /**
     * Create a new Payment Options
     * 
     * @access public
     * @param array $params, string $type
     * @return void
     */
    public function create($type, $params){
        
        switch ($type) {
            
            case 'merchant':
                
                // Check if an entry exists with thesame posted marchant details
                $array = array(
                                'merchname' => $params['merchname'],
                                'contact' => $params['contact'],
                                'schoolid' =>$params['schoolid'],
                                'phone' => $params['phone'],
                                'email' => $params['email'],
                                'remark' => $params['remark']
                            );
                
                $this->db->like($array);
                $query = $this->db->get('pay_merchant');
                
                // Set status 
                if($query->num_rows() > 0) {
                    
                    $status = DEFAULT_EXIST;
                    
                }elseif($this->db->insert('pay_merchant', $params)) {
                    
                    $status = DEFAULT_SUCCESS;
                    
                }else{

                    DEFAULT_ERROR;
                }
                
                break;
                
                
            case 'pay_schedule':
                
                    // Check for an entry exists with the same 'schedule'
                    $array = array(
                            'schoolid' => $params['schoolid'],
                            'sesid'=> $params['sesid'],
                            'payheadid' => $params['payheadid'],
                            'instid' => $params['instid'],
                            'amount' => $params['amount'],
                            'penalty' => $params['penalty'],
                            'revhead' => $params['revhead']
                        );

                    $this->db->like($array);
                    $query = $this->db->get('pay_schedule');

                    // if Entry exist in the database
                    if($query->num_rows() > 0) { 

                        $status = DEFAULT_EXIST; 

                    }
                    elseif($this->db->insert('pay_schedule', $params)) {

                        $status = DEFAULT_SUCCESS;
                        
                    }
                    else{

                        $status = DEFAULT_ERROR;

                    }
                
                break;
                
                
            case 'payhead':
                
                    // Check to an entry exists with the same 'merchname' 
                    $array = array(
                        'schoolid' => $params['schoolid'],
                        'type' => $params['type']
                    );
                
                
                    $this->db->like($array);
                    $query = $this->db->get('pay_head');

                    // Set status 
                    if($query->num_rows() > 0) {

                        $status = DEFAULT_EXIST;

                    }elseif($this->db->insert('pay_head', $array)) {

                        $status = DEFAULT_SUCCESS;

                    }else{

                        DEFAULT_ERROR;
                    }
                
                break;
                
                
            case 'pay_instalment':
                
                    // Check to an entry exists with the same 'merchname' 
                    $this->db->like('percentage', $params['percentage']);
                    $this->db->like('unit', $params['unit']);
                    $this->db->like('schoolid', $param['schoolid']);
                    $query = $this->db->get('pay_instalment');
                    
                    // Set status 
                    if($query->num_rows() > 0) { 
                        
                        $status = DEFAULT_EXIST;

                    }elseif($this->db->insert('pay_instalment', $params)) {

                        $status = DEFAULT_SUCCESS;

                    }else{

                        $status = DEFAULT_ERROR;
                    }
                    
                break;
            
                
            case 'pay_exception':
                    // Check for an entry exists with the same 'exception'
                    
                
                    $this->db->like($params);
                    $query = $this->db->get('pay_exception');

                    //If exception already exist in the database 
                    if($query->num_rows() > 0) {
                        
                        $status = DEFAULT_EXIST;

                    }
                    elseif($this->db->insert('pay_exception', $params)) {
                        
                        $this->db->where('scheduleid', $params['scheduleid']);
                        $this->db->update('pay_schedule', array('exceptions' => 'yes'));
                        
                        $status = DEFAULT_SUCCESS;
                        
                    }else{
                        
                        $status = DEFAULT_ERROR;
                        
                    }
                    
                break;
                
              
            case 'pay_transaction':
                
                $array = array(
                                'userid' => $params['user_id'],
                                'scheduleid' => $params['schedule_id'],
                                'sesid' =>$params['sesid'],
                                'exceptionid' => $params['exception_id'],
                                'can_name' => $params['can_name'],
                                'reference' => $params['reference'],
                                'penalty' => $params['penalty'],
                                'year' => $params['year'],
                                'ordid' => $params['oder_id'],
                                'date_time' => $params['date_time'],
                                'status' => $params['status'],
                                'date_time' => $params['date_time'],
                                'sessionid' => $params['session_id'],
                                'gatewayurl' => $params['gateway'],
                                'percentage' => $params['percentage'], 
                                'pay_desc' => $params['pay_desc']
                                
                            );
                
                if($this->db->insert('pay_transactions', $array)){
                    
                 $status = DEFAULT_SUCCESS;
                    
                }else{

                    DEFAULT_ERROR;
                }
                
                break;
            
            
            default:
                break;
        }
        
        return $status;
        
    }// End of func create
    
    
    /**
     * Update an payment setups
     * 
     * @access public
     * @param int $id, array $params, string $type
     * @return void
     */
    public function update($type, $params, $id=NULL) {
 
        switch ($type) {
            
            case 'merchant':
                
                // Check if an entry exists with thesame posted marchant details
                $array = array(
                                'merchname' => $params['merchname'],
                                'contact' => $params['contact'],
                                'phone' => $params['phone'],
                                'email' => $params['email'],
                                'remark' => $params['remark']
                            );
                
                $this->db->like($array);
                $this->db->like(array('mid' => $params['mid']));
                $query = $this->db->get('pay_merchant');
                
                // if found marchante with the posted parameters  
                if($query->num_rows() > 0) {
                    
                    $status = DEFAULT_EXIST;
                    
                }elseif($this->db->update('pay_merchant', $array, array('mid' => $params['mid']))) {
                    
                        $status = DEFAULT_SUCCESS;
                }else{
                    
                    $status = DEFAULT_ERROR;
                }
                           
                break;
                
                
            case 'pay_schedule':
                
                // Check if an entry exists with thesame posted marchant details
                $array = array(
                                'sesid' => $params['sesid'],
                                'payheadid' => $params['payheadid'],
                                'instid' => $params['instid'],
                                'amount' => $params['amount']
                            );
                
                $this->db->like($array);
                $this->db->like(array('scheduleid' => $params['scheduleid']));
                $query = $this->db->get('pay_schedule');
                
                // if found marchante with the posted parameters  
                if($query->num_rows() > 0) {
                    
                    $status = DEFAULT_EXIST;
                    
                }elseif($this->db->update('pay_schedule', $params, array('scheduleid' => $params['scheduleid']))) {
                    
                        $status = DEFAULT_SUCCESS;
                }else{
                    
                    $status = DEFAULT_ERROR;
                }
                
                
                break;
                
                
            case 'pay_head':
                $update_param = array('type' =>$params['type']);
                
                $query = $this->db->get_where('pay_head', $params);
                
                // if found marchante with the posted parameters  
                if($query->num_rows() > 0) {
                    
                    $status = DEFAULT_EXIST;
                    
                }
                elseif($this->db->update('pay_head', $update_param, array('payheadid' => $params['payheadid']))) {
                    
                    $status = DEFAULT_SUCCESS;
                }
                else{
                    
                    $status = DEFAULT_ERROR;
                }
                
                break; 
             
                
            case 'schedule_penalty':
                
                if($this->db->update('pay_schedule', $params, array('scheduleid' => $params['scheduleid']))) {
                    
                        $status = DEFAULT_SUCCESS;
                }else{
                    
                    $status = DEFAULT_ERROR;
                }
                           
                break; 
                
                
            case 'pay_transaction':
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
                
                    if($this->db->update('pay_transactions', $params, array('ordid' => $params['ordid']))) {
                    
                        $status = DEFAULT_SUCCESS;
                    }else{

                        $status = DEFAULT_ERROR;
                    }
                
                break;
                
                
            default:
                
                break;
        }

        return $status;
        
    }// End func update
   
    
    
    
    /**
     * Delete  payment setups
     * 
     * @access public
     * @param int $id, string $type
     * @return void
     */
    public function delete($table, $param) {
        
        $status = DEFAULT_ERROR;
        $ret;
        
        switch ($table) {
            
            case 'payhead':
                if($this->db->delete('pay_head', array('payheadid' => $param['id'])))
                    $status = DEFAULT_SUCCESS;
                break;
                
            case 'payschedule':
                if($this->db->delete('pay_schedule', array('id' => $id)))
                    $status = DEFAULT_SUCCESS;
                break;    
            default:
                
                break;
        }

        return $status;
    }// End func delete

    
    
    /**
     * Gets
     * 
     * @access public
     * @param string, int||array()
     * @return array()
     */
    public function gets($type, $param = NULL){
        $result = "";
        
        switch ($type) {
            
            case 'session':
                $query = $this->db->get_where('session',$param);
                $result = $query->result_array();
                
                break;
            
            
            case 'merchant':
                $query = $this->db->get('pay_merchant');
                $result = $query->result_array();
                break;
            
            
            case 'college':
                $query = $this->db->get('colleges');
                $result = $query->result_array();
                break;
            
            case 'state':
                $query = $this->db->get('states');
                $result = $query->result_array();
                break;
            
            
            case 'departments':
                
                if(isset($param) && $param != NULL){
                    
                    $this->db->where('deptid', $param);
                    $query = $this->db->get('departments');
                    $result = $query->result_array();
                    
                }else{
                    
                    $query = $this->db->get('departments');
                    $result = $query->result_array();
                    
                }
                break;
            
            
            case 'programmes':
                
                if(is_array($param)){
                    
                    $this->db->select('pr.*');
                    $this->db->from('programmes pr');
                    $this->db->join('departments d','d.deptid = pr.deptid');
                    $this->db->join('colleges c','c.colid = d.colid');
                    $this->db->where('c.schoolid', $param['schoolid']);
                    $this->db->order_by('pr.progname', "asc");
                    $query = $this->db->get();

                    $result = $query->result_array();
                }
                
                break;
                
                
            case 'pay_head':
                
                $query = $this->db->get('pay_head');
                $result = $query->result_array();
                
                break;
            
            
            case 'pay_schedule':       
                        
                if(isset($param) && is_array($param) && $param != NULL){
                    
                    $this->db->select('sh.*, s.sesname, ph.type, inst.percentage, sh.amount');
                    $this->db->from('pay_schedule sh');
                    $this->db->join('session s','sh.sesid = s.sesid');
                    $this->db->join('pay_head ph','sh.payheadid = ph.payheadid');
                    $this->db->join('pay_instalment inst', 'sh.instid = inst.instid');
                    $this->db->where('sh.schoolid', $param['schoolid']);
                    (isset($param['scheduleid'])) ? $this->db->where('sh.scheduleid', $param['scheduleid']): '';
                    $this->db->order_by('sh.scheduleid', "desc");
                    
                    $query = $this->db->get();

                    $result = (isset($param['scheduleid'])) ?$query->row_array(): $query->result_array();
                
                }else{
                    
//                    $prep_query = "SELECT sh.*, sh.scheduleid, s.sesname, ph.type, inst.percentage, sh.amount
//                                    FROM tams_pay_schedule sh, tams_session s, 
//                                    tams_pay_head ph, tams_pay_instalment inst
//                                    WHERE sh.sesid = s.sesid
//                                    AND sh.payheadid = ph.payheadid
//                                    AND sh.instid = inst.instid ORDER BY sh.scheduleid DESC";
//                    $query = $this->db->query($prep_query);
//                            
//                    
//                    $result = $query->result_array();
                
                }
                
                break;
                
                
            case 'adm_type' :
                    $this->db->select('adt.typeid, adt.type,adm.displayname, s.sesname');
                    $this->db->from('adm_types adt');
                    $this->db->join('admissions adm','adt.admid = adm.admid');
                    $this->db->join('session s','s.sesid = adm.sesid');
                    $this->db->where('adm.schoolid', $param['schoolid']);
                    $query = $this->db->get();
                    
                    $result = $query->result_array();
                    
                break;
                
            case 'my_schedule':
                
                    $prep_query = "SELECT SUM(tr.percentage) AS total_paid, ph.type, s.sesname, tr.userid, sh.* "
                                . "FROM tams_pay_schedule sh "
                                . "LEFT JOIN tams_pay_transactions tr ON tr.scheduleid = sh.scheduleid "
                                . "AND tr.status = 'APPROVED' "
                                . "LEFT JOIN tams_pay_head ph ON  ph.payheadid = sh.payheadid "
                                . "LEFT JOIN tams_session s ON s.sesid = sh.sesid "
                                . "GROUP BY sh.scheduleid "
                                . "HAVING total_paid < 100  "
                                . "OR total_Paid IS NULL ";
                    $query = $this->db->query($prep_query);
                    
                    $result = $query->result_array();
                    
                break;
            
            
            
            case 'max_prog_duration':
                
                    $this->db->select_max('duration', 'duration');
                    $query = $this->db->get('programmes');
                    $result = $query->row_array();
                    
                break;
            
            
            case 'pay_instalments':
                    
                    if(isset($param) && $param != NULL){
                        
                       $query = $this->db->get_where('pay_instalment', array('instid' => $param));
                       $result = $query->row_array();  
                       
                    }else{
                        
                        $query = $this->db->get('pay_instalment');
                        $result = $query->result_array();
                    }
                    
                    
                break;
                
                
            case 'student_details':
                
                    if(isset($param) && $param != NULL){
                       
                        $this->db->select('*');
                        $this->db->from('users');
                        $this->db->join('students','students.userid = users.userid');
                        $this->db->join('programmes','programmes.progid = students.progid');
                        $this->db->join('departments', 'departments.deptid = programmes.deptid');
                        $this->db->join('colleges', 'colleges.colid = departments.colid');
                        $this->db->where('users.userid', $param);
                        $query = $this->db->get();
                        $result = $query->row_array();
                    }
                    
                break;
                
            
            case 'pay_exception':
                
                if(isset($param) && $param != NULL){
                    
                    $query = $this->db->query("SELECT ex.*, ex.amount AS ex_amount, sh.* , p.type, s.sesname, inst.percentage, (
                                            CASE ex.unittype
                                                WHEN 'college'
                                                THEN (
                                                    SELECT colname
                                                    FROM tams_colleges
                                                    WHERE colid = ex.unitid
                                                    )
                                                WHEN 'department'
                                                THEN (
                                                    SELECT deptname
                                                    FROM tams_departments
                                                    WHERE deptid = ex.unitid
                                                    )
                                                WHEN 'programme'
                                                THEN (
                                                    SELECT progname
                                                    FROM tams_programmes
                                                    WHERE progid = ex.unitid
                                                    )
                                                ELSE 
                                                ''
                                            END
                                            ) AS me
                                            FROM tams_pay_exception ex, tams_pay_schedule sh, tams_session s, tams_pay_head p, tams_pay_instalment inst
                                            WHERE ex.scheduleid = sh.scheduleid
                                            AND sh.payheadid = p.payheadid
                                            AND sh.sesid = s.sesid
                                            AND sh.instid = inst.instid 
                                            AND ex.scheduleid = {$param}"
                                                                   );
                    $result = $query->result_array();
                }else{
                    
                    $query = $this->db->query("SELECT ex.*, ex.amount AS ex_amount, sh.*, p.type, s.sesname, inst.percentage, (
                                            CASE 
                                                WHEN ex.base = 'college'
                                                THEN (
                                                    SELECT colname 
                                                    FROM tams_colleges c
                                                    WHERE c.colid = ex.baseparam 
                                                    )
                                                WHEN ex.base = 'department'
                                                THEN (
                                                    SELECT deptname 
                                                    FROM tams_departments
                                                    WHERE deptid = ex.baseparam 
                                                    )
                                                WHEN ex.base = 'programme'
                                                THEN (
                                                    SELECT progname 
                                                    FROM tams_programmes
                                                    WHERE progid = ex.baseparam 
                                                    )
                                                WHEN ex.base = 'state'
                                                THEN (
                                                    SELECT statename 
                                                    FROM tams_states
                                                    WHERE stateid = ex.baseparam 
                                                    )
                                                WHEN ex.base = 'level'
                                                THEN (
                                                        ex.baseparam 
                                                    )
                                                WHEN ex.base = 'coi'
                                                THEN (
                                                        ex.baseparam 
                                                    ) 
                                                WHEN ex.base = 'adm'    
                                                THEN (
                                                        ex.baseparam 
                                                    )     
                                                ELSE 
                                                ''
                                            END
                                             ) AS basename
                                            FROM tams_pay_exception ex, tams_pay_schedule sh, tams_session s, tams_pay_head p, tams_pay_instalment inst
                                            WHERE ex.scheduleid = sh.scheduleid
                                            AND sh.payheadid = p.payheadid
                                            AND sh.sesid = s.sesid
                                            AND sh.instid = inst.instid "
                                                                   );
                    $result = $query->result_array();
                }
                   
                    
                break;
                
                
//            

                    
                    

            case 'my_pay_history':
                
                if(isset($param) && is_array($param)){
                    
                    $prep_query = sprintf("SELECT tr.*, se.sesname, ph.type "
                                        . "FROM tams_pay_transactions tr, tams_session se, "
                                        . "tams_pay_schedule ps, tams_pay_head ph "
                                        . "WHERE tr.scheduleid = ps.scheduleid "
                                        . "AND ps.payheadid = ph.payheadid "
                                        . "AND ps.sesid = se.sesid "
                                        . "AND tr.scheduleid = %s "
                                        . "AND tr.status = 'APPROVED' "
                                        . "AND tr.userid = %s ",
                                        $param['scheduleid'],
                                        $param['userid']);  
                    $query = $this->db->query($prep_query);
                    $result = $query->result_array();
                    
                }else{
                    
                    $result = DEFAULT_ERROR;
                }

                break;
                

            case 'new_schedule':
                
                 if(isset($param) && is_array($param)){
                     
                    $prep_query = sprintf("SELECT SUM(tr.percentage) AS total_paid, ph.type,s.sesname, tr.usertypeid, sh.* "
                                        . "FROM tams_pay_schedule sh "
                                        . "JOIN tams_pay_transactions tr "
                                        . "ON tr.scheduleid = sh.scheduleid "
                                        . "AND tr.userid = %s "
                                        . "AND tr.status = 'APPROVED' "
                                        . "LEFT JOIN tams_pay_head ph "
                                        . "ON ph.payheadid = sh.payheadid "
                                        . "LEFT JOIN tams_session s "
                                        . "ON s.sesid = sh.sesid "
                                        . "GROUP BY tr.usertypeid "
                                        . "HAVING total_paid < 100 ",
                                        $param['userid']);
                    $query = $this->db->query($prep_query);
                    $result = $query->result_array();
                    }
                break;
                
                
            case 'pay_transaction':
                
                $query = $this->db->get_where('pay_transactions', array('ordid' => $param['ordid']));
                $result = $query->result_array();
                 
                break;
                
            default:
                    break;

            } 
            
        return $result;  
    } // End of function gets
    
    /**
     * Get user eligible b=payment Schedule
     * 
     * @param array $param
     */
    public function user_schedule($param){
        $and = (isset($param['scheduleid']))? "AND ps. scheduleid = {$param['scheduleid']} " : " ";
        
        $prep_query = "SELECT SUM(ptr.percentage) AS total_paid,  ps.scheduleid, ps.amount, ps.exceptions, ps.penalty, "
                    . "ps.penalty_status, ps.revhead, ps.created, s.sesname, ph.type, pi.percentage "
                    . "FROM {$this->db->protect_identifiers('pay_schedule', TRUE) } ps "
                    . "LEFT JOIN {$this->db->protect_identifiers('session', TRUE)} s ON s.sesid = ps.sesid "
                    . "LEFT JOIN {$this->db->protect_identifiers('pay_head', TRUE)} ph ON  ph.payheadid = ps.payheadid  "
                    . "LEFT JOIN {$this->db->protect_identifiers('pay_instalment', TRUE)} pi ON pi.instid = ps.instid "
                    . "LEFT JOIN {$this->db->protect_identifiers('pay_transactions', TRUE)} ptr ON ptr.scheduleid = ps.scheduleid "
                    . "AND ptr.status = 'APPROVED' "
                    . "AND ptr.userid = {$param['user_id']} "
                    . "WHERE {$param['sesid']} <= ps.sesid "
                    . "AND ps.usertype = '{$param['user_type']}' "
                    . " {$and} "
                    . "AND ps.schoolid = {$param['school_id']} "
                    . "GROUP BY ps.scheduleid "
                    . "HAVING total_paid < 100  OR total_Paid IS NULL  ";

        $query = $this->db->query($prep_query);
        
        return $query->result_array();
        
    }
    
    
    
    public function get_user_details($usertype, $userid){
        
        
        switch($usertype){ 
            case 'applicant':
                    $this->db->select('*');
                    $this->db->from('users u');
                    $this->db->join('prospective p', 'p.userid = u.userid');
                    $this->db->join('programmes pr', 'pr.progid = p.prog1');
                    $this->db->join('departments d', 'd.deptid = pr.deptid');
                    $this->db->join('colleges c', 'c.colid = d.colid');
                    $this->db->join('adm_types adt', 'p.admtype = adt.typeid');
                    $this->db->join('admissions ad', 'adt.admid = ad.admid');
                    $this->db->where('p.userid', $userid);

                    $query = $this->db->get();

                    return $query->row_array();
                    
                    //die(var_dump($result));
                    
            case 'student':
                    $this->db->select('*');
                    $this->db->from('users u');
                    $this->db->join('students st', 'st.userid = u.userid');
                    $this->db->join('programmes pr', 'pr.progid = st.progid');
                    $this->db->join('departments d', 'd.deptid = pr.deptid');
                    $this->db->join('colleges c', 'c.colid = d.colid');
                    $this->db->where('st.userid', $userid);

                    $query = $this->db->get();

                    return $query->row_array();
                break;
            case 'admin':
                break;
            case 'staff':
                break;
            default:
                break;
                
        }
       
    }
    
    
    
    
    public function get_user_exceptions($param, $id){
        $result = array(
                'status'=>FALSE,
                'rs' => ""
            );
           
        switch ($param['usertype']) { 
            case 'applicant':
                $prep_query = "SELECT ex.*, ex.amount AS ex_amount , sh.*, s.sesname, ph.type, inst.percentage "
                            . "FROM tams_pay_exception ex, tams_pay_instalment inst, "
                            . "tams_pay_schedule sh, tams_session s, tams_pay_head ph "
                            . "WHERE ex.instid = inst.instid "
                            . "AND ph.payheadid = sh.payheadid "
                            . "AND sh.sesid = s.sesid "
                            . "AND ex.scheduleid = {$id} "
                            . "AND ex.scheduleid = sh.scheduleid  "
                            . "AND "
                            . "("
                            . " (base = 'college' AND baseparam = {$param['colid']} ) "
                            . "OR (base = 'department' AND baseparam = {$param['deptid']} ) "
                            . "OR (base = 'programme' AND baseparam = {$param['progid']} ) "
                            . "OR (base = 'adm' AND baseparam = '{$param['type']}'  ) "
                            . "OR (base = 'coi' AND baseparam = '{$param['coi']}'  ) "
                            . "OR (base = 'state' AND baseparam = '{$param['stid']}' ) "
                            . " ) "
                            . "ORDER BY base DESC ";
                    
                $query = $this->db->query($prep_query);
                
                if($query->num_rows() > 0){
                    
                    $result['status'] = TRUE;
                    $result['rs'] = $query->result_array();        
                }
                                    

                break;
            case 'student':
                    $prep_query = "SELECT ex.*, ex.amount AS ex_amount , sh.*, s.sesname, ph.type, inst.percentage "
                            . "FROM tams_pay_exception ex, tams_pay_instalment inst, "
                            . "tams_pay_schedule sh, tams_session s, tams_pay_head ph "
                            . "WHERE ex.instid = inst.instid "
                            . "AND ph.payheadid = sh.payheadid "
                            . "AND sh.sesid = s.sesid "
                            . "AND ex.scheduleid = {$id} "
                            . "AND ex.scheduleid = sh.scheduleid  "
                            . "AND "
                            . "("
                            . "(base = 'college' AND baseparam = {$param['colid']} ) "
                            . "OR (base = 'department' AND baseparam = {$param['deptid']} ) "
                            . "OR (base = 'programme' AND baseparam = {$param['progid']} ) "
                            . "OR (base = 'adm' AND baseparam = '{$param['admode']}' ) "
                            . "OR (base = 'level' AND baseparam = {$param['level']}  ) "
                            . "OR (base = 'state' AND baseparam = {$param['stid']})"
                            . ")"
                            . "ORDER BY unittype DESC ";
                            
                    $query = $this->db->query($prep_query);
                    
                    if($query->num_rows() > 0){
                        $result['status'] = TRUE;
                        $result['rs'] = $query->result_array();        
                    }

                break;
            case 'admin':


                break;
            case 'staff':


                break;

            default:
                break;
        }
        
        return $result;
    }
    
    
    
    public function has_paid($param){
        
        $status = FALSE;
        
        $query = $this->db->get_where('user_pay_schedule', $param);
        $record = $query->num_rows();
        if($record > 0){
            $status = TRUE; 
        }
        
        return $status;
        
        
    }
    
    
    public function filter_users($param){
        
        switch ($param['usertype']) {
            case 'applicant':
                    $this->db->select('*');
                    $this->db->from('users u');
                    $this->db->join('prospective p', 'p.userid = u.userid');
                    $this->db->join('programmes pr', 'pr.progid = p.offered', 'left');
                    $this->db->join('departments d', 'd.deptid = pr.deptid', 'left');
                    $this->db->join('colleges c', 'c.colid = d.colid', 'left');
                    $this->db->join('adm_types adt', 'p.admtype = adt.typeid', 'left');
                    $this->db->join('admissions ad', 'adt.admid = ad.admid', 'left');
                    
                    $this->db->where('u.schoolid', $param['schoolid']);
                    $this->db->where('u.usertype', $param['usertype']);
                    
                    if(isset($param['college']) && $param['college'] != ''){
                        $this->db->where('c.colid', $param['college']);
                    }
                    if(isset($param['department']) && $param['department'] != ''){
                        $this->db->where('pr.deptid', $param['department']);
                    }
                    if(isset($param['programme']) && $param['programme'] != ''){
                        $this->db->where('p.offered', $param['programme']);
                    }
                    if(isset($param['state']) && $param['state'] != ''){
                        $this->db->where('u.stid', $param['state']);
                    }
                    if(isset($param['adm_type']) && $param['adm_type'] != ''){
                        $this->db->where('p.admtype', $param['adm_type']);
                    }
                    if(isset($param['coi']) && $param['coi'] != ''){
                        $this->db->where('p.coi', $param['coi']);
                    }
                    if(isset($param['session']) && $param['session'] != ''){
                        $this->db->where('ad.sesid', $param['session']);
                    }

                    $query = $this->db->get();
                    //die(var_dump($this->db->last_query()));
                    return $query->result_array();
                    
                break;
                
            case 'student':
                    $this->db->select('*');
                    $this->db->from('users u');
                    $this->db->join('students s', 's.userid = u.userid');
                    $this->db->join('programmes pr', 'pr.progid = s.progid', 'left');
                    $this->db->join('departments d', 'd.deptid = pr.deptid', 'left');
                    $this->db->join('colleges c', 'c.colid = d.colid', 'left');
                    $this->db->join('adm_types adt', 's.admtype = adt.typeid', 'left');
                    $this->db->join('admissions ad', 'adt.admid = ad.admid', 'left');
                    
                    if(isset($param['college']) && $param['college'] != ''){
                        $this->db->where('c.colid', $param['college']);
                    }
                    if(isset($param['department']) && $param['department'] != '' ){
                        $this->db->where('pr.deptid', $param['department']);
                    }
                    if(isset($param['programme']) && $param['programme'] != ''){
                        $this->db->where('s.progid', $param['programme']);
                    }
                    if(isset($param['state']) && $param['state'] != ''){
                        $this->db->where('u.stid', $param['state']);
                    }
                    if(isset($param['adm_type']) && $param['adm_type'] != ''){
                        $this->db->where('s.admtype', $param['adm_type']);
                    }
                    if(isset($param['session']) && $param['session'] != ''){
                        $this->db->where('s.sesid', $param['session']);
                    }
                    
                    $this->db->where('u.schoolid', $param['schoolid']);
                    $this->db->where('u.usertype', $param['usertype']);
                    
                    $query = $this->db->get();
                    
                    //die(var_dump($this->db->last_query()));
                    return $query->result_array();
                    
                break;
                
                
            case 'staff':
                return Array();
                break;
            
            case 'admin':
                return Array();
                break;

            default:
                break;
        }
    }
    
    
    
    public function assign_schedule($param){
        
        $this->db->trans_begin();
        
        if($this->db->insert_batch('user_pay_schedule', $param)){ 
            
            $this->db->trans_commit();
            $status = DEFAULT_SUCCESS;           
        }
        else{
            $this->db->trans_rollback();
           $status = DEFAULT_ERROR;
        }
         
    }
    
    
    public function get_pending_payment($userid){
        
        $this->db->select('*');
        $this->db->from('user_pay_schedule ups');
        $this->db->join('pay_schedule ps', 'ups.scheduleid = ps.scheduleid');
        $this->db->join('session s', 's.sesid = ps.sesid');
        $this->db->join('pay_head ph', 'ph.payheadid = ps.payheadid');
        $this->db->where('ups.userid', $userid);
        $this->db->where('ups.percentage <', 100);
        $query = $this->db->get();
        
        return $query->result_array();
//          
//        var_dump($query->result_array());
//        exit();
    }
    
    
    public function get_pay_history($userid){
        
        $this->db->select('s.sesname,ph.type, pt.*');
        $this->db->from('pay_transactions pt');
        $this->db->join('pay_schedule ps','ps.scheduleid = pt.scheduleid');
        $this->db->join('session s','s.sesid = ps.sesid');
        $this->db->join('pay_head ph','ph.payheadid = ps.payheadid');
        $this->db->where('pt.userid', $userid);
        $this->db->order_by('pt.transid', "desc");
        $query = $this->db->get();

        return $result = $query->result_array();
        
    }
    
    
    
    public function get_receipt($ordid){
        
        $this->db->select('s.sesname,ph.type, pt.*, u.*, p.*, std.*');
        $this->db->from('pay_transactions pt');
        $this->db->join('pay_schedule ps','ps.scheduleid = pt.scheduleid');
        $this->db->join('session s','s.sesid = ps.sesid');
        $this->db->join('pay_head ph','ph.payheadid = ps.payheadid');
        $this->db->join('users u','u.userid = pt.userid');
        $this->db->join('prospective p','p.userid = pt.userid', 'left');
        $this->db->join('students std','std.userid = pt.userid', 'left');
        $this->db->where('pt.ordid', $ordid);
        $this->db->order_by('pt.transid', "desc");
        $query = $this->db->get();

        return $result = $query->row_array();
        
    }
    
    public function get_user_pay_schedule($payid){
        
        $this->db->select('ups.*, s.sesname, ph.type ');
        $this->db->from('user_pay_schedule ups');
        $this->db->join('pay_schedule ps', 'ups.scheduleid = ps.scheduleid');
        $this->db->join('session s', 's.sesid = ps.sesid');
        $this->db->join('pay_head ph', 'ph.payheadid = ps.payheadid');
        $this->db->join('pay_instalment pi', 'pi.instid = ps.instid');
        $this->db->where('ups.payid', $payid);
        
        $query = $this->db->get();
        
        return $query->row_array();
        
    }
    
}


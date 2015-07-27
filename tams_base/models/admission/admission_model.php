<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Exam Model
 * 
 * @category   Model
 * @package    Admission Management
 * @subpackage Admission
 * @author     Suleodu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Admission_model extends CI_Model {
	
    
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
     * Create a new prospective student
     * 
     * @access public
     * @param array $param
     * @return int
     */
    public function create($param) {
        
        //Initiate transaction 
        $this->db->trans_start();
        
        $this->db->insert('users', $param['user']);

        $param['pros']['userid'] = $this->db->insert_id();
        
        $this->db->insert('prospective',$param['pros']);
        
        $param['app_fee']['userid'] = $param['pros']['userid'];
        $param['permission']['userid'] = $param['pros']['userid'];
        
        $this->db->insert('user_pay_schedule',$param['app_fee']);
        $this->db->insert('group_users',$param['permission']);
        
        
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
    
    /**
     * Get Current Admission Session 
     * 
     * 
     */
    public function get_cur_adm_session($param) {
        
        $this->db->limit(1);
        $this->db->where('schoolid', $param);
        $this->db->where('application', 'Open');
        $this->db->where('status', 'inactive');
        $query = $this->db->get('session');
        $result = $query->result_array();
        
        return $result;
    }
    
    /**
     * Create a new admission requirement
     * 
     * @access public
     * @param array $params, string $type
     * @return void
     */
    public function exam_create($params, $type) {
        
        $status = DEFAULT_ERROR;
        
        switch ($type) {
            
            case 'group':
                
                // Check to an entry exists with the same 'groupname' 
                $this->db->like('groupname', $params['groupname']);
                $query = $this->db->get('exam_groups');
                
                // Set status 
                if($query->num_rows() > 0) { 
                    $status = DEFAULT_EXIST;
                }else {
                    if($this->db->insert('exam_groups', $params)) {
                        $status = DEFAULT_SUCCESS;
                    }
                }
                
                break;

                
            case 'exam':
                
                // Check to an entry exists with the same 'groupname' 
                $this->db->like('examname', $params['examname']);                
                $this->db->or_like('shortname', $params['shortname']);
                $query = $this->db->get('exams');
                
                // Set status 
                if($query->num_rows() > 0) { 
                    $status = DEFAULT_EXIST;
                }else {
                    if($this->db->insert('exams', $params)) {
                        $status = DEFAULT_SUCCESS;
                    }
                }

                break;
            
                
            case 'grade':
                
                // Check to an entry exists with the same 'groupname' 
                $this->db->like('gradename', $params['gradename']);
                $query = $this->db->get('grades');
                
                // Set status 
                if($query->num_rows() > 0) { 
                    $status = DEFAULT_EXIST;
                }else {
                    if($this->db->insert('grades', $params)) {
                        $status = DEFAULT_SUCCESS;
                    }
                }

                break;
            
                
            case 'subject':
                
                // Check to an entry exists with the same 'groupname' 
                $this->db->like('subname', $params['subname']);
                $query = $this->db->get('subjects');
                
                // Set status 
                if($query->num_rows() > 0) { 
                    $status = DEFAULT_EXIST;
                }else {
                    if($this->db->insert('subjects', $params)) {
                        $status = DEFAULT_SUCCESS;
                    }
                }

                break;
                
                
            case 'exam_subject':
                
                // Check to an entry exists with the same 'examid' and 'subjectid' 
                $this->db->like('subjectid', $params['subjid']);
                $this->db->like('examid', $params['examid']);
                $query = $this->db->get('exam_subjects');
                
                // Set status 
                if($query->num_rows() > 0) { 
                    $status = DEFAULT_EXIST;
                }else {
                    if($this->db->insert('exam_subjects', $params)) {
                        $status = DEFAULT_SUCCESS;
                    }
                }

                break;
                
            case 'exam_grade':
                
                // Check to an entry exists with the same 'examid' and 'subjectid' 
                $this->db->like('examid', $params['examid']);
                $this->db->like('gradeid', $params['gradeid']);
                $this->db->like('gradeweight', $params['gradeweight']);
                $query = $this->db->get('exam_grades');
                
                // Set status 
                if($query->num_rows() > 0) { 
                    $status = DEFAULT_EXIST;
                }else {
                    if($this->db->insert('exam_grades', $params)) {
                        $status = DEFAULT_SUCCESS;
                    }
                }

                break;
                
            case 'admissions':
                
                // Check to an entry exists with the same 'examid' and 'subjectid' 
                $this->db->like('displayname', $params['displayname']);
                $this->db->like('schoolid', $params['schoolid']);
                $this->db->like('sesid', $params['sesid']);
                $query = $this->db->get('admissions');
                
                // Set status 
                if($query->num_rows() > 0) { 
                    $status = DEFAULT_EXIST;
                }else {
                    if($this->db->insert('admissions', $params)) {
                        $status = DEFAULT_SUCCESS;
                    }
                }
                
                break;
             
            case 'admission_types':
                
                // Check to an entry exists with the same 'examid' and 'subjectid' 
                $this->db->like('admid', $params['admid']);
                $this->db->like('type', $params['type']);
                $this->db->like('utme', $params['utme']);
                $this->db->like('status', $params['status']);
                $query = $this->db->get('adm_types');
                
                // Set status 
                if($query->num_rows() > 0) { 
                    $status = DEFAULT_EXIST;
                }else {
                    if($this->db->insert('adm_types', $params)) {
                        $status = DEFAULT_SUCCESS;
                    }
                }
                
                break;    
                
            default:
                
                break;
        }
         
        return $status;
    }// End func create
	
    /**
     * Update an admission requirement
     * 
     * @access public
     * @param int $id, array $params, string $type
     * @return void
     */
    public function exam_update($id, $params, $type) {
        
        $status = DEFAULT_ERROR;
        $ret;
        
        switch ($type) {
            
            case 'group':
                
                // Set status 
                $ret = $this->db->update('exam_groups', $params, array('groupid' => $id));                
                break;

            case 'exam':
                
                // Set status 
                $ret = $this->db->update('exams', $params, array('examid' => $id));
                break;
            
            case 'grade':
                
                // Set status                 
                $ret = $this->db->update('grades', $params, array('gradeid' => $id));
                break;
            
            case 'subject':
                
                // Set status 
                $ret = $this->db->update('subjects', $params, array('subid' => $id));
                break;
            
            case 'exam_subject':
                
                // Set status 
                $ret = $this->db->update('exam_subjects', $params, array('examsubjectid' => $id));
                break;
            
            case 'exam_grade':
                
                // Set status 
                $ret = $this->db->update('exam_grades', $params, array('examgradeid' => $id));
                break;
            
            case 'admissions':
                
                // Set status 
                $ret = $this->db->update('admissions', $params, array('admid' => $id));
                break;
            
            case 'admission_type':
                
                // Set status 
                $ret = $this->db->update('adm_types', $params, array('typeid' => $id));
                break;
            default:
                
                break;
        }
        
        if($ret)
            
            $status = DEFAULT_SUCCESS;
            //echo $this->db->last_query();
        return $status;
    }// End func update
    
    /** 
     * Get active admission for the session
     * 
     * @access public
     * @param array $param
     * @return array
     */
    public function get_current_admission($param){
        
        $this->db->select('*');
        $this->db->from('adm_types typ');
        $this->db->join('admissions adm', 'adm.admid = typ.admid');
        $this->db->join('session s', 's.sesid = adm.sesid');
        $this->db->where('typ.status', $param['status']);
        $this->db->where('adm.schoolid', $param['schoolid']);
        (isset($param['typeid']))? $this->db->where('typ.typeid', $param['typeid']): '';
        $query = $this->db->get();
        
        $result = (isset($param['typeid']))? $query->row_array(): $query->result_array();
        
        return $result;
        
    }
    
    /** 
     * submit all prospective information supply at registration 
     * 
     * @access public
     * @param array $param
     * @return integer
     */
    public function register($param, $form){
        
        switch ($form) {
            case '1':
                $record['user'] = array(
                            'fname' => $param['fname'],
                            'lname' => $param['lname'],
                            'mname' => $param['mname'],
                            'email' => $param['email'],
                            'phone' => $param['phone'],
                            'sex' => $param['sex'],
                            'dob' => $param['dob'],
                            'stid' => $param['soforig'],
                            'lgaid' => $param['lgaoforig'],
                            'address' => $param['address'],
                            'nationality' => $param['nationality'],
                            'marital' => $param['marital'],
                            'blood' => $param['blood'],
                            'religion' => $param['religion'],
                            
                        );
                
                $record['pros'] = array(
                                    'formsubmit' => $form,
                                    'disablility' => ($param['disable'] == 'yes') ? $param['disable_desc'] : $param['disable'],
                                    'hobby' => $param['hobby'],
                                );
                //Initiate transaction 
                $this->db->trans_start();
                
                $this->db->update('users', $record['user'], array('userid' => $param['userid']));
                $this->db->update('prospective', $record['pros'], array('userid' => $param['userid']));
                
                // End transaction
                $this->db->trans_complete();
                
                if($this->db->trans_status() === FALSE){
                    
                    $status = DEFAULT_ERROR;
                }else{
                    
                    $status = DEFAULT_SUCCESS;
                }
                break;
                
            case '2':
                $record['pros'] = array(
                            'spname' => $param['sp_flname'],
                            'spaddress' => $param['sp_address'],
                            'spphone' => $param['sp_phone'],
                            'spemail' => $param['sp_mail'],

                            'nkfname' => $param['nkfname'],
                            'nkoname' => $param['nkoanme'],
                            'nkphone' => $param['nkphone'],
                            'nkmail' => $param['nkmail'],
                            'nkaddress' => $param['nkaddress'],
                            'nkrelation' => $param['relationship'],
                            'formsubmit' => $form,
                        );
               
               
                if($this->db->update('prospective', $record['pros'], array('userid' => $param['userid']))){

                    $status = DEFAULT_SUCCESS;

                }else{

                   $status = DEFAULT_ERROR; 
                }
                
                break;
                
                
            case '3':
                
                //Initiate transaction 
                $this->db->trans_start();
                
                foreach($param['prev_qualif'] AS $qual){
                
                    if(isset($qual['cert']) && isset($qual['school']) && isset($qual['from']) && $qual['to']){
                        
                        $this->db->set('userid', $param['userid']);
                        $this->db->set('certificate', $qual['cert']);
                        $this->db->set('schoolname', $qual['school']);
                        $this->db->set('from', $qual['from']);
                        $this->db->set('to', $qual['to']);
                        $this->db->insert('prev_qualification');  
                        
                    }  
                    
                }
                
                foreach($param['olevel'] AS $olvl){
                    
                    if(isset($olvl['examnum']) && ($olvl['examnum'] != "") && isset($olvl['examyr']) && ($olvl['examyr'] != "")){
                        $olv_param = array(
                                        'userid' => $param['userid'],
                                        'examtype' => $olvl['examtype'],
                                        'examyear' => $olvl['examyr'],
                                        'examnumber' => $olvl['examnum'],
                                        'sitting' => $olvl['sitting']
                                    );
                        
                        $this->db->insert('olevel',$olv_param); 
                        $result_id = $this->db->insert_id();

                        $olv_reslt_param = array();
                       
                        for($idx = 0; $idx < count($olvl['subject']); $idx++){
                            
                            if($olvl['subject'][$idx] != "" && $olvl['grade'][$idx] != ""){
                               
                                $olv_reslt_param[$idx] = array(
                                                    'olevelid' => $result_id,
                                                    'subject' => $olvl['subject'][$idx],
                                                    'grade' => $olvl['grade'][$idx]
                                                );
                               
                            }
                           
                        }
                        
                        $this->db->insert_batch('olevel_result', $olv_reslt_param);
                       
                    }
                    
                }
                
                $record['pros'] = array(
                                    'formsubmit' => $form,
                                );
                
                $this->db->update('prospective', $record['pros'], array('userid' => $param['userid']));
                
                // End transaction
                $this->db->trans_complete();
                
                if($this->db->trans_status() === FALSE){
                    
                    $status = DEFAULT_ERROR;
                }else{
                    
                    $status = DEFAULT_SUCCESS;
                }
                
                break;
            
             case '4':
                 
                if($param['extype'] == 'no'){
                 
                    $record['de_result'] = array(
                                        'schoolname' => $param['inst_name'],
                                        'schooladdress' => $param['inst_address'],
                                        'certobtain' => $param['cert_obtain'],
                                        'gradyear' => $param['grad_year'],
                                        'grade' => $param['grade'],
                                        'userid' => $param['userid']
                                    );
                    $record['pros'] = array(
                                    'formsubmit' => $form,
                                );
               
                    //Initiate transaction 
                    $this->db->trans_start();

                    $this->db->insert('de_result', $record['de_result']);
                    $this->db->update('prospective', $record['pros'], array('userid' => $param['userid']));

                    // End transaction
                    $this->db->trans_complete();

                    if($this->db->trans_status() === FALSE){

                        $status = DEFAULT_ERROR; 

                    }else{
                        $status = DEFAULT_SUCCESS;
                       
                    }

                }
                elseif($param['extype'] == 'yes'){
                    
                    $this->db->like('userid', $param['userid']);
                    $query = $this->db->get('utme');
                    $found_utme = $query->num_rows();
                    
                    if($found_utme < 1){
                        
                        //Initiate transaction 
                        $this->db->trans_start();

                        $utme_param = array(
                                        'userid' => $param['userid'],
                                        'year' => $param['utme']['examyr'],
                                        'regid' => $param['utme']['examnum'], 
                                    );

                        $this->db->insert('utme',$utme_param); 
                        $result_id = $this->db->insert_id();

                        for($idx = 0; $idx < count($param['utme']['subject']); $idx++){

                            if($param['utme']['subject'][$idx] != "" && $param['utme']['grade'][$idx] != ""){

                                $utme_result_param[$idx] = array(
                                                    'utmeid' => $result_id,
                                                    'subject' => $param['utme']['subject'][$idx],
                                                    'score' => $param['utme']['grade'][$idx]
                                                );

                            }

                        }

                        $this->db->insert_batch('utme_result', $utme_result_param);

                        $record['pros'] = array(
                                    'formsubmit' => $form,
                                );

                        $this->db->update('prospective', $record['pros'], array('userid' => $param['userid']));

                        // End transaction
                        $this->db->trans_complete();

                        if($this->db->trans_status() === FALSE){

                            
                            $status = DEFAULT_ERROR; 
                        }else{

                           $status = DEFAULT_SUCCESS;
                        }
                        
                    }else{
                        
                        $record['pros'] = array(
                                    'formsubmit' => $form,
                                );

                        $this->db->update('prospective', $record['pros'], array('userid' => $param['userid']));
                        
                        $status = DEFAULT_SUCCESS;
                    }
                }
                
                break;
             
            case '5':
                $record['pros'] = array(
                                    'prog1' => $param['prog1'],
                                    'prog2' => $param['prog2'],
                                    'formsubmit' => $form,
                                );
                
                if($this->db->update('prospective', $record['pros'], array('userid' => $param['userid']))){

                    $status = DEFAULT_SUCCESS;

                }else{

                   $status = DEFAULT_ERROR; 
                }   
                
                break;
            
            default:
                break;
        }
        
        return $status;
    }
    
    /** 
     * submit previous qualification  
     * 
     * @access private
     * @param array $param 
     * @param integer $id
     * @return array
     */
    private function insert_prev_qualification($param, $id){
        
       foreach($param as $pvq){
           
           if($pvq['cert'] != NULL && 
                $pvq['school'] != NULL && 
                $pvq['from'] != NULL && 
                $pvq['to'] != NULL){
               
                $this->db->set('userid', $id);
                $this->db->set('certificate', $pvq['cert']);
                $this->db->set('school', $pvq['school']);
                $this->db->set('from', $pvq['from']);
                $this->db->set('to', $pvq['to']);
                $this->db->insert('prev_qualification');
                
            }
            
       } 
       
    }
    
    
    /** 
     * submit olevel result  
     * 
     * @access private
     * @param array $param 
     * @param integer $id
     * @return void
     */
    private function insert_olevel_result($param, $id){
        
        foreach ($param['olevel'] as $olevel){
            
            if(isset($olevel['examtype']) && isset($olevel['examyr']) && isset($olevel['examnum'])){
                
                $this->db->set('userid', $id);
                $this->db->set('examtype', $olevel['examtype']);
                $this->db->set('examyear', $olevel['examyr']);
                $this->db->set('examnumber', $olevel['examnum']);
                $this->db->set('sitting', $olevel['sitting']);
                $this->db->insert('olevel');
                
                $resultid = $this->db->insert_id();
                
                for($idx = 0; $idx <= count($olevel['subject']); $idx++){
                    
                    if(isset($olevel['subject'][$idx]) && isset($olevel['grade'][$idx])){
                        
                        $this->db->set('olevelid', $resultid);
                        $this->db->set('subject', $olevel['subject'][$idx]);
                        $this->db->set('grade', $olevel['subject'][$idx]);
                        $this->db->insert('olevel_result');
                        
                    }
                }
            }
        }
    }//End of function insert_olevel_result
    
    /** 
     * Insert Utme record  
     * 
     * @access private
     * @param array $param 
     * @param integer $id
     * @return void
     */
    private function insert_utme($param, $id){
        
        if(isset($param['utme']['year']) && isset($param['utme']['regid'])){
            
            $this->db->set('userid', $id);
            $this->db->set('regid', $param['utme']['regid']);
            $this->db->set('year', $param['utme']['year']);
            $this->db->insert('utme');
            
            $utmeid = $this->db->insert_id();
            
            for($idx = 0; $idx <= count($param['utme']['subject']); $idx++){
                    
                if(isset($param['utme']['subject'][$idx]) && isset($param['utme']['score'][$idx])){

                    $this->db->set('utmeid', $resultid);
                    $this->db->set('subject', $param['utme']['subject'][$idx]);
                    $this->db->set('score', $param['utme']['score'][$idx]);
                    $this->db->insert('utme_result');

                }
            }
        }
    }
    
    
    
    /** 
     * Get adm status record  
     * 
     * @access public
     * @param array $param 
     * @param integer $id
     * @return void
     */
    public function get_adm_status($id){
        
        echo  $prep_query = sprintf("SELECT u.*, p.*, pr1.progname AS pro_chc1,pr2.progname AS pro_chc2, pr3.progname AS pro_offered "
                            . "FROM {$this->db->protect_identifiers('users', TRUE)} u, "
                            . "{$this->db->protect_identifiers('prospective', TRUE)} p, "
                            . "{$this->db->protect_identifiers('programmes', TRUE)} pr1, "
                            . "{$this->db->protect_identifiers('programmes', TRUE)} pr2, "
                            . "{$this->db->protect_identifiers('programmes', TRUE)} pr3 "
                            . "WHERE u.userid = p.userid "
                            . "AND p.prog1 = pr1.progid "
                            . "AND p.prog2 = pr2.progid "
                            . "AND p.offered = pr3.progid "
                            . "AND u.userid = %s",$id);
                            exit();
//        $query = $this->db->query($prep_query);   
//        
//        $result = $query->row_array();
//        
//        return $result;
    }
    
    
    /**
     * Get exam group(s)
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_group($id = NULL) {
        
        // Initialize where clause and result set
        $where = array();
        $result_set = QUERY_ARRAY_RESULT;
         
        // Create where clause and set the result set if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'groupid', 'value' => $id)
            );
            $result_set = QUERY_ARRAY_ROW;
        }
        
        // Call get_data from utl_model
        return $this->util_model->get_data('exam_groups', 
                                            array(), 
                                            $where ,
                                            array(),
                                            array(),
                                            array(),
                                            $result_set
                                        );
        
    }// End func get_group
    
    
    
    /**
     * Get exam(s)
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_exam($id = NULL) {
        
        // Initialize where clause
        $where = array();
        $result_set = QUERY_ARRAY_RESULT;
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'examid', 'value' => $id)
            );
            $result_set = QUERY_ARRAY_ROW;
        }
        
        // Call get_data from utl_model
        return $this->util_model->get_data('exams', 
                                            array(), 
                                            $where ,
                                            array(),
                                            array(),
                                            array(),
                                            $result_set
                                        );
        
    }// End func get_exam
    
    
    
    
    /**
     * Get grade(s)
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_grade($id = NULL) {
        
        // Initialize where clause
        $where = array();
        $result_set = QUERY_ARRAY_RESULT;
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'gradeid', 'value' => $id)
            );
            
            $result_set = QUERY_ARRAY_ROW;
        }
        
        
        // Call get_data from utl_model
        return $this->util_model->get_data('grades', 
                                            array(), 
                                            $where ,
                                            array(),
                                            array(),
                                            array(),
                                            $result_set
                                        );
        
    }// End func get_grade
    
    
    /**
     * Get exam grade(s)
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_exam_grade($id = NULL) {
        
        // Initialize where clause
        $where = array();
        $result_set = QUERY_ARRAY_RESULT;
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'examgradeid', 'value' => $id)
            );
            
            $result_set = QUERY_ARRAY_ROW;
        }
        
        
        // Call get_data from utl_model
        return $this->util_model->get_data('exam_grades eg', 
                                            array(), 
                                            $where ,
                                            array(),
                                            array(
                                                    array('table' => 'exams e', 'on'=> 'e.examid = eg.examid'),
                                                    array('table' => 'grades g', 'on'=> 'g.gradeid = eg.gradeid')
                                                ),
                                            array(),
                                            $result_set
                                        );
        
    }// End func get_grade
    
    
    /**
     * Get subject(s)
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_subject($id = NULL) {
        
        // Initialize where clause
        $where = array();
        $result_set = QUERY_ARRAY_RESULT;
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'subid', 'value' => $id)
            );
            
            $result_set = QUERY_ARRAY_ROW;
        }
        
        
        // Call get_data from utl_model
        return $this->util_model->get_data('subjects', 
                                            array(), 
                                            $where ,
                                            array(),
                                            array(),
                                            array(),
                                            $result_set
                                        );
        
    }// End func get_subject
    
    /**
     * Get exam subject(s)
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_exam_subject($id = NULL) {
        
        // Initialize where clause
        $where = array();
        $result_set = QUERY_ARRAY_RESULT;
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'examsubjectid', 'value' => $id)
            );
            
            $result_set = QUERY_ARRAY_ROW;
        }
        
        
        // Call get_data from utl_model
        return $this->util_model->get_data('exam_subjects es', 
                                            array(), 
                                            $where ,
                                            array(),
                                            array(
                                                    array('table' => 'exams e', 'on'=> 'e.examid = es.examid'),
                                                    array('table' => 'subjects s', 'on'=> 's.subid = es.subjectid')
                                                ),
                                            array(),
                                            $result_set
                                        );
        
    }// End func get_subject
    
    
    /**
     * Get Admission
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_admission($id = NULL) {
        
        // Initialize where clause
        $where = array();
        $result_set = QUERY_ARRAY_RESULT;
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'adm.schoolid', 'value' => $id)
            );
            $result_set = QUERY_ARRAY_ROW;
        }
        
        // Call get_data from utl_model
        return $this->util_model->get_data('admissions adm', 
                                            array(), 
                                            $where ,
                                            array(),
                                            array(
                                                array('table' => 'session s', 'on'=> 'adm.sesid = s.sesid')
                                            ),
                                            array(),
                                            QUERY_ARRAY_RESULT
                                        );
        
    }// End func get_exam
    
    /**
     * Get Admission
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_admission_all_type($id = NULL) {
        
        // Initialize where clause
        $where = array();
        $result_set = QUERY_ARRAY_RESULT;
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'adm.schoolid', 'value' => $id)
            );
            $result_set = QUERY_ARRAY_ROW;
        }
        
        // Call get_data from utl_model
        return $this->util_model->get_data('adm_types typ', 
                                            array('adm.admid','typ.typeid','adm.displayname', 's.sesname', 'typ.type', 'typ.status','adm.sesid', 'typ.utme', 'typ.coi_app_fee','typ.reg_app_fee'), 
                                            $where ,
                                            array(),
                                            array(
                                                array('table' => 'admissions adm', 'on'=> 'adm.admid = typ.admid'),
                                                array('table' => 'session s', 'on'=> 'adm.sesid = s.sesid')
                                            ),
                                            array(),
                                            QUERY_ARRAY_RESULT
                                        );
        
    }// End func get_exam
    
    
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function get_adm_payschedule($id){
        
        $this->db->select('*');
        $this->db->from('adm_types');
        $this->db->where('typeid', $id); 
        $query = $this->db->get();
        
        return $query->row_array();
    }
    
    
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function get_admission_record($id = NULL){
        
        $this->db->select('p.*, u.*, s.*, lg.*, pr1.progname AS prg1, pr2.progname AS prg2');
        $this->db->from('prospective p');
        $this->db->join('users u', 'u.userid = p.userid');
        $this->db->join('programmes pr1', 'p.prog1 = pr1.progid');
        $this->db->join('programmes pr2', 'p.prog2 = pr2.progid');
        $this->db->join('states s', 's.stateid = u.stid');
        $this->db->join('state_lga lg', 'lg.lgaid = u.lgaid');
        $this->db->where('u.userid', $id);
        $query = $this->db->get();
        
        return $query->row_array();
    }
    
    
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function get_prog_choice($id){
       
        $this->db->select('u.regid, u.year, s.subname, r.score');
        $this->db->from('utme u');
        $this->db->join('utme_result r', 'u.utmeid = r.utmeid');
        $this->db->join('subjects s', 's.subid = r.subject');
        $this->db->where('u.userid', $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    
    
    /**
     * 
     * @param type $id
     * @return type
     */
    public function get_utme($id){
       
        $this->db->select('u.regid, u.year, s.subname, r.score');
        $this->db->from('utme u');
        $this->db->join('utme_result r', 'u.utmeid = r.utmeid');
        $this->db->join('subjects s', 's.subid = r.subject');
        $this->db->where('u.userid', $id);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    
    /**
     * Get Apliccant previouse Qualification
     * @param type $userid
     */
    public function get_prev_qual($userid){
        
        $query = $this->db->get_where('prev_qualification', array('userid' => $userid));
        
        return $query->result_array();
        
    }
    
    
    
    /**
     * 
     * @param type $id
     * @param type $sit
     * @return type
     */
    public function get_olevel($id, $sit){
       
        $this->db->select('e.shortname, o.examyear, o.examnumber, s.subname, g.gradename');
        $this->db->from('olevel o');
        $this->db->join('olevel_result r', 'o.olevelid = r.olevelid');
        $this->db->join('exams e', 'e.examid = o.examtype');
        $this->db->join('subjects s', 's.subid = r.subject');
        $this->db->join('grades g', 'g.gradeid = r.grade');
        $this->db->where('o.userid', $id);
        $this->db->where('o.sitting', $sit);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    
    
    /**
     * 
     * @param type $userid
     * @return type
     */
    public function get_prospective($userid){
       return $this->util_model->get_data('prospective p', 
                                    array(), 
                                    array(
                                        array('field' => "p.userid", 'value' => $userid)
                                    ),
                                    array(),
                                    array(
                                        array('table' => 'adm_types typ', 'on'=> 'p.admtype = typ.typeid')
                                    )
                                    ,array(),
                                    QUERY_ARRAY_ROW);
    }
    
    
    
    /**
     * 
     * @param type $userid
     * @return type
     */
    public function get_user($userid){
       return $this->util_model->get_data('users', 
                                            array(), 
                                            array(
                                                array('field' => "userid", 'value' => $userid)
                                            ),
                                            array(),
                                            array()
                                            ,array(),
                                            QUERY_ARRAY_ROW);
    }
    
    
    
    /**
     * 
     * @return type
     */
    public function get_state(){
        return $this->util_model->get_data('states', 
                                            array(), 
                                            array(),
                                            array(),
                                            array(),
                                            array(),
                                            QUERY_ARRAY_RESULT);
    }
    
    
    /**
     * 
     * @return type
     */
    public function get_programmes(){
        return $this->util_model->get_data('programmes', 
                                            array(), 
                                            array(),
                                            array(),
                                            array(),
                                            array(),
                                            QUERY_ARRAY_RESULT);
    }
    
    
    /**
     * 
     * @return type
     */
    public function get_lga(){
        return $this->util_model->get_data('state_lga', 
                                            array(), 
                                            array(),
                                            array(),
                                            array(),
                                            array(),QUERY_ARRAY_RESULT);
    }
    
    /**
     * 
     * @return type
     */
    public function get_exam_group(){
        return $this->util_model->get_data('exam_groups',
                                            array(),
                                            array(
                                                array('field' => "status", 'value' => "Active")
                                            ),
                                            array(),
                                            array(),
                                            array(),
                                            QUERY_ARRAY_RESULT);
    }
    
    
    /**
     * 
     * @return type
     */
    public function get_exam_type_period(){
       return  $this->util_model->get_data('exams e',
                                            array(),
                                            array(
                                                array('field' => "status", 'value' => "Active")
                                            ),
                                            array(),
                                            array(),
                                            array(),
                                            QUERY_ARRAY_RESULT);
    }
    
    
    
    /**
     * 
     * @param type $type
     * @return boolean
     */
    public function adm_has_utme($type){
        $status = FALSE;
        $this->db->select('utme');
        $this->db->where('typeid', $type); 
        $query = $this->db->get('adm_types');
        
         $row = $query->row(); 
         if($row->utme == 'yes'){
             $status = TRUE;
         }
         
         return $status;
    }
    
    
    /**
     * 
     * @param type $resource
     * @return type
     */
    public function upload_utme($resource){
        
        $this->db->trans_start();
                
        foreach($resource as $rec){
            
            $this->db->insert('users', $rec['user']); 

            $rec['pros']['userid'] = $this->db->insert_id();
            $rec['utme']['userid'] = $this->db->insert_id();
            $rec['perm']['userid'] = $this->db->insert_id();
            $rec['pay']['userid'] = $this->db->insert_id();
            
            $this->db->insert('prospective', $rec['pros']);
            $this->db->insert('group_users', $rec['perm']);
             $this->db->insert('user_pay_schedule', $rec['pay']);
            
            $this->db->set('userid', $rec['utme']['userid']);
            $this->db->set('regid', $rec['utme']['regid']);
            $this->db->set('year', $rec['utme']['year']);
            $this->db->insert('utme');
            $utmeid = $this->db->insert_id();
            
            
            for($idx = 0; $idx < count($rec['utme']['subject']); $idx++){
                
                $this->db->set('utmeid', $utmeid);
                $this->db->set('subject', $rec['utme']['subject'][$idx]);
                $this->db->set('score', $rec['utme']['score'][$idx]);
                $this->db->insert('utme_result');
                
            }
           
        }
        
        // End transaction
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            
            return DEFAULT_ERROR;
        }

        return DEFAULT_SUCCESS;  
    }
    
    
    
    /**
     * 
     * @param type $userid
     * @return type
     */
    public function get_applicant_record($userid){
        
        $this->db->select('*, s.sesname');
        $this->db->from('users u');
        $this->db->join('prospective p', 'p.userid = u.userid');
        $this->db->join('programmes pr', 'pr.progid = p.prog1');
        $this->db->join('departments d', 'd.deptid = pr.deptid');
        $this->db->join('colleges c', 'c.colid = d.colid');
        $this->db->join('adm_types adt', 'p.admtype = adt.typeid');
        $this->db->join('admissions ad', 'adt.admid = ad.admid');
        $this->db->join('session s', 's.sesid = ad.sesid');
        $this->db->where('p.userid', $userid);

        $query = $this->db->get();
        
        return $query->row_array();
    }
    
    
    /**
     * 
     * @param type $userid
     * @return type
     */
    public function user_pay_schedule($userid) {
        
        $this->db->select('*');
        $this->db->from('user_pay_schedule');
        $this->db->where('userid', $userid );
        $this->db->where('percentage != ', 100);
        $query =$this->db->get();
                
        return $query->row_array();
    }
    
    
    
    public function get_perm_groups($school){
        
        $query =$this->db->get_where('groups',  array('schoolid' => $school));
                
        return $query->result_array();
    }
    
    
    public function get_form_num($userid){
        
        $this->db->select('formsubmit');
        $this->db->from('prospective');
        $this->db->where('userid', $userid );
        $query =$this->db->get();
                
        return $query->row(); 
    }
    
    
    public function update_form_num($param){
        
        $p = array('formsubmit' => $param['form']);
        
        $this->db->update('prospective', $p, "userid = {$param['userid']}");
        
        if($this->db->affected_rows() > 0){
            
            return DEFAULT_SUCCESS;
        }else{
            
           return  DEFAULT_ERROR;
        }
    }
    
    
    public function get_user_utme($userid){
        
        $this->db->select('u.*,ur.*,s.*');
        $this->db->from('utme u');
        $this->db->join('utme_result ur', 'ur.utmeid = u.utmeid', 'left');
        $this->db->join('subjects s', 's.subid = ur.subject','left' );
        $this->db->where('u.userid', $userid );
        $query =$this->db->get();
                
        return $query->result_array();  
        
    }
    
    
    
    public function submit_utme($param){
        
        //die(var_dump($param));
        
        $this->db->like('userid', $param['userid']);
        $query = $this->db->get('utme');
        $found_utme = $query->num_rows();
                    
        if($found_utme < 1){

            //Initiate transaction 
            $this->db->trans_start();

            $utme_param = array(
                            'userid' => $param['userid'],
                            'year' => $param['utme']['examyr'],
                            'regid' => $param['utme']['examnum'], 
                        );

            $this->db->insert('utme', $utme_param); 
            $result_id = $this->db->insert_id();

            for($idx = 0; $idx < count($param['utme']['subject']); $idx++){

                if($param['utme']['subject'][$idx] != "" && $param['utme']['grade'][$idx] != ""){

                    $utme_result_param[$idx] = array(
                                        'utmeid' => $result_id,
                                        'subject' => $param['utme']['subject'][$idx],
                                        'score' => $param['utme']['grade'][$idx]
                                    );
                    
                    $this->db->insert('utme_result', $utme_result_param[$idx]);
                }
                continue; 
            }

            $record['pros'] = array(
                        'formsubmit' => $param['formnum'],
                    );

            $this->db->update('prospective', $record['pros'], array('userid' => $param['userid']));

            // End transaction
            $this->db->trans_complete();

            if($this->db->trans_status() === FALSE){


                $status = DEFAULT_ERROR; 
            }else{

               $status = DEFAULT_SUCCESS;
            }

        }
       return $status;         
    }
    
    
    /**
     * Save applicant personal information 
     * 
     * @param Array $param
     */
    public function submit_personal_info($param){
        
        $record['user'] = array(
                            'fname' => $param['fname'],
                            'lname' => $param['lname'],
                            'mname' => $param['mname'],
                            'email' => $param['email'],
                            'phone' => $param['phone'],
                            'sex' => $param['sex'],
                            'dob' => $param['dob'],
                            'stid' => $param['soforig'],
                            'lgaid' => $param['lgaoforig'],
                            'address' => $param['address'],
                            'nationality' => $param['nationality'],
                            'marital' => $param['marital'],
                            'blood' => $param['blood'],
                            'religion' => $param['religion'],
                            'disablility' => ($param['disable'] == 'yes') ? $param['disable_desc'] : $param['disable']
                        );
                
        $record['pros'] = array(
                            'formsubmit' => $param['formnum'],
                            'hobby' => $param['hobby'],
                        );
        
        //Initiate transaction 
        $this->db->trans_start();

            $this->db->update('users', $record['user'], array('userid' => $param['userid']));
            $this->db->update('prospective', $record['pros'], array('userid' => $param['userid']));

        // End transaction
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){

            $status = DEFAULT_ERROR;
        }else{

            $status = DEFAULT_SUCCESS;
        }
        
        return $status;
    }
    
    
    
    /**
     * Save applicant O'level Result
     * 
     * @param type $param
     */
    public function submit_olevel($param){
        
        //die(var_dump($param));
        
        //Initiate transaction 
        $this->db->trans_start();
        
            $this->db->select('olevelid');
            $query = $this->db->get_where('olevel',array('userid' => $param['userid'])); 
             
            
            if($query->num_rows() > 0){
                
                $result = $query->row();
                
                $tables = array('olevel', 'olevel_result');
                $this->db->where('olevelid', $result->olevelid);
                $this->db->delete($tables);
                
            }
            

            foreach($param['olevel'] AS $olvl){

                if(isset($olvl['examnum']) && ($olvl['examnum'] != "") && isset($olvl['examyr']) && ($olvl['examyr'] != "")){
                    $olv_param = array(
                                    'userid' => $param['userid'],
                                    'examtype' => $olvl['examtype'],
                                    'examyear' => $olvl['examyr'],
                                    'examnumber' => $olvl['examnum'],
                                    'sitting' => $olvl['sitting']
                                );

                    $this->db->insert('olevel',$olv_param); 
                    $result_id = $this->db->insert_id();

                    $olv_reslt_param = array();

                    for($idx = 0; $idx < count($olvl['subject']); $idx++){

                        if($olvl['subject'][$idx] != "" && $olvl['grade'][$idx] != ""){

                            $olv_reslt_param[$idx] = array(
                                                'olevelid' => $result_id,
                                                'subject' => $olvl['subject'][$idx],
                                                'grade' => $olvl['grade'][$idx]
                                            );

                        }

                    }

                    $this->db->insert_batch('olevel_result', $olv_reslt_param);

                }

            }

            $record['pros'] = array(
                                'formsubmit' => $param['formnum'],
                            );

            $this->db->update('prospective', $record['pros'], array('userid' => $param['userid']));

        // End transaction
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){

            $status = DEFAULT_ERROR;
            
        }else{

            $status = DEFAULT_SUCCESS;
        }
        
        return $status;
    }
    
    
    
    /**
     * 
     * @param type $param
     * @return type
     */
    public function submit_sponsor($param) {
        
        $record['pros'] = array(
                    'spname' => $param['sp_flname'],
                    'spaddress' => $param['sp_address'],
                    'spphone' => $param['sp_phone'],
                    'spemail' => $param['sp_mail'],

                    'nkfname' => $param['nkfname'],
                    'nkoname' => $param['nkoanme'],
                    'nkphone' => $param['nkphone'],
                    'nkmail' => $param['nkmail'],
                    'nkaddress' => $param['nkaddress'],
                    'nkrelation' => $param['relationship'],
                    'formsubmit' => $param['formnum'],
                );
               
               
        if($this->db->update('prospective', $record['pros'], array('userid' => $param['userid']))){

            $status = DEFAULT_SUCCESS;

        }else{

           $status = DEFAULT_ERROR; 
        }
      
        return $status;
        
    }
    
    
    public function submit_prog_choice($param){
        
        $record['pros'] = array(
                        'prog1' => $param['prog1'],
                        'prog2' => $param['prog2'],
                        'formsubmit' => $param['formnum'],
                    );
                
        if($this->db->update('prospective', $record['pros'], array('userid' => $param['userid']))){

            $status = DEFAULT_SUCCESS;

        }else{

           $status = DEFAULT_ERROR; 
        }  
        
        return $status;
    }
    
    /**
     * 
     * @param type $param
     * @return type 
     */
    public function submit_prev_qualif($param){
        
        $prev_qualif_param = array();

        for($idx = 0; $idx < count($param['prev_qualif']['school']); $idx++){

            if($param['prev_qualif']['school'][$idx] != "" && $param['prev_qualif']['school'][$idx] != ""){

                $prev_qualif_param[$idx] = array(
                                'userid' => $param['userid'],
                                'schoolname' => $param['prev_qualif']['school'][$idx],
                                'schladdress' => $param['prev_qualif']['address'][$idx],
                                'certificate' => $param['prev_qualif']['cert'][$idx],
                                'grade'=> $param['prev_qualif']['grade'][$idx],
                                'year' => $param['prev_qualif']['year'][$idx]    
                );

            }
        }
        
        $record['pros'] = array(
                        'formsubmit' => $param['formnum']
                    );
               
        //Initiate transaction 
        $this->db->trans_start();

            $this->db->insert_batch('prev_qualification', $prev_qualif_param);
            $this->db->update('prospective', $record['pros'], array('userid' => $param['userid']));

        // End transaction
        $this->db->trans_complete();

        if($this->db->trans_status() === FALSE){

            $status = DEFAULT_ERROR; 

        }else{
            $status = DEFAULT_SUCCESS;

        }
        
        return $status;
    }
    
} // End class addmission_model




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
     * Create a new admission requirement
     * 
     * @access public
     * @param array $params, string $type
     * @return void
     */
    public function create($params, $type) {
        
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
    public function update($id, $params, $type) {
        
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
                $ret = $this->db->update('subjects', $params, array('subjectid' => $id));
                break;
                
            default:
                
                break;
        }
        
        if($ret)
            $status = DEFAULT_SUCCESS;
        echo $this->db->last_query();
        return $status;
    }// End func update
    
    /**
     * Get exam group(s)
     * 
     * @access public
     * @param int $id
     * @return void
     */
    public function get_group($id = NULL) {
        
        // Initialize where clause
        $where = array();
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'groupid', 'value' => $id)
            );
        }
        
        // Call get_data from utl_model
        return $this->util_model->get_data(
                            'exam_groups', 
                             array('*'),
                             $where
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
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'examid', 'value' => $id)
            );
        }
        
        // Call get_data from utl_model
        return $this->util_model->get_data(
                            'exams', 
                             array('*'),
                             $where
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
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'gradeid', 'value' => $id)
            );
        }
        
        // Call get_data from utl_model
        return $this->util_model->get_data(
                            'grades', 
                             array('*'),
                             $where
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
        
        // Create where clause if id is set.
        if($id != NULL) {
            $where = array(
                array('field' => 'subid', 'value' => $id)
            );
        }
        
        // Call get_data from utl_model
        return $this->util_model->get_data(
                            'subjects', 
                             array('*'),
                             $where
                        );
        
    }// End func get_subject
    
} // End class Exam_model

// End file exam_model.php

<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Main application controller
 * 
 * @category   Controller
 * @package    Prospective
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

class Prospective extends CI_Controller{
    /**
     * View Folder Name
     * 
     * @access private
     * @var string
     */
    
    private $folder_name = 'prospective';
   
    private $page_title = '';
    
   
    
    /*
     * Class constructor
     * 
     * @access public 
     * @retun void
     */
            
    public function __construct(){
        
        parent::__construct();
        /*
         * Load Form Helper 
         */
        $this->load->helper('form');

        /*
         * Load Form Validation And Email Library 
         */
        $this->load->library(array('form_validation','email'));
        /*
         * Load Prospective and Session model 
         */
        $this->load->model('prospective/prospective_model','prs_mdl' );
        $this->load->model('session/session_model','ses_mdl' );

        /*
         * Load language
         */
        $this->lang->load('module_prospective');
        
        
        // Initialize class variables
        $this->user_id = $this->main->get('user_id');
        $this->user_type = $this->main->get('user_type');

    } 
    
    /**
     * Prospective Application page .	 
     */
    public function index() {
             
           
            $page_name = 'application'; 
            $data = array();
            $data['msg']= '';

            $data['session'] = $this->ses_mdl->getCurSession();

            $this->form_validation->set_rules('lname','Last Name','required');
            $this->form_validation->set_rules('mname','Middle Name','required');
            $this->form_validation->set_rules('fname','First Name','required');
            $this->form_validation->set_rules('phone','Phone No','required');
            $this->form_validation->set_rules('email','E_mail','required|valid_email');
            $this->form_validation->set_rules('password','Password','required|matches[confPassword]');
            $this->form_validation->set_rules('confPassword','Confirm Password','required');

            if($this->form_validation->run() === TRUE){
                    //Get all Posted data 
                    $postData = array(
                            'lname' => $this->input->post('lname'),
                            'mname' => $this->input->post('mname'),
                            'fname' => $this->input->post('fname'),
                            'email' => $this->input->post('email'),
                            'phone' => $this->input->post('phone'),
                            'usertype' => $this->input->post('usertype'),
                            'password' => md5($this->input->post('password'))
                            );
                    //Check if posted E-mail Already Exist
                   if($this->prs_mdl->verifyEmail($postData['email']) == 0){
                        $data['result'] = $this->prs_mdl->create($postData);
                        if($data['result']){
                            $data['msg'] = $this->lang->line('application_reg_success');


                                           $data['link'] = 'mvc.tams.com';

                                            //send confrimation E-MAIL
                                            $this->email->from('noreply@tams.com', 'TAMS');
                                            $this->email->to($this->input->post('email'));
                                            $this->email->subject('Application Registration');
                                            $this->email->message($this->load->view('email_template/prospective_application_email', $data, TRUE));
                                            $this->email->send();

//                            $val_link = 'www.link.com';
//                            $email_params = array(
//                            'validate_link'    => $val_link,
//                            'subject'    => 'Registration Succesfull'
//                            );
//
//                        // Send email using reset password template
//                        $email_status = $this->message->send_email_from_template($this->input->post('email'), $email_params, EMAIL_TEMPLATE_PROSPECTIVE);

                        // Set error message for incomplete form fields
                            $success_msg = $this->lang->line('application_reg_success');  
                            $this->main->set_notification_message(MSG_TYPE_SUCCESS, $success_msg); 
                        }

                   }
                           else
                               {
                                   //$data['msg'] = $this->lang->line('application_reg_fail_email_exist');
                                   // Set error message for incomplete form fields
                                   $error_msg = $this->lang->line('application_reg_fail_email_exist');  
                                   $this->main->set_notification_message(MSG_TYPE_SUCCESS, $error_msg); 
                               }

               }

                $this->load->view($this->folder_name.'/'.$page_name, $data);   
    }
    
    /**
     * Prospective Registartion page .	 
     */
    public function register(){
        //set page title 
        $this->page_title = 'Prospective Registration';
        
        //set session parameter 
        $session = $this->main->get('user_id');
        
        // check registration payment table to verify that 
        // the loging student has actualy make payment to proceed to registration
        $form_payment = $this->prs_mdl->verifyRegPayment($session);
        
        if($session){
            if($form_payment){
                
                $data = $this->user_model->get_user_data();
                $data['state'] = $this->prs_mdl->getState();
                $data['lga'] = $this->prs_mdl->getLga();

                //Set Page name
                $page_name = 'prospective_registration';

                // check if prospective registration form is trigered 
                if($this->input->server('REQUEST_METHOD') == 'POST'){ 

                    $this->prs_mdl->register();
                }

                //builld view pade for prospective registration 
                $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
                $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
            
            } 
            else{
                 //rediredt to Prospective dashbord if  no Registration payment 
                redirect(site_url('prospective/dashboard'));
            }
            
        }
            else{
                //rediredt to login if session not exist 
                redirect(site_url());
            }
    }  
    
    
     /**
      * Prospective Registartion page .	 
      * 
      * 
      */
    public function postUtme(){
        
       //set page title 
        $this->page_title = 'Post UTME';
        
        //set session parameter 
        $session = $this->main->get('user_id');
        
        // check registration payment table to verify that 
        // the loging student has actualy make payment to proceed to registration
        $form_payment = $this->prs_mdl->verifyRegPayment($session);
        
        if($session){
            if($form_payment){
                
                $data = $this->user_model->get_user_data();
                $data['state'] = $this->prs_mdl->getState();
                $data['lga'] = $this->prs_mdl->getLga();

                //Set Page name
                $page_name = 'post_utme';

                // check if prospective registration form is trigered 
                if($this->input->server('REQUEST_METHOD') == 'POST'){ 

                    $this->prs_mdl->register();
                }

                //builld view pade for prospective registration 
                $page_content = $this->load->view($this->folder_name.'/'.$page_name, $data, true);
                $this->page->build($page_content, $this->folder_name, $page_name, $this->page_title );
            
            } 
            else{
                 //rediredt to Prospective dashbord if  no Registration payment 
                redirect(site_url('prospective/dashboard'));
            }
            
        }
            else{
                //rediredt to login if session not exist 
                redirect(site_url());
            }
    }  
    
    
}// End class Prospective

    


// End file Prospective.php
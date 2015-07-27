<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 


class pdf {
    
    private  $CI ;
    
    function __construct(){
        
        $this->CI = & get_instance();
        
        log_message('Debug', 'mPDF class is loaded.');
    }
 
    
    function load($param=NULL){
        include_once APPPATH.'/third_party/mpdf60/mpdf.php';
         
        if ($param == NULL){
            
            $param = '"en-GB-x","A4","","",50,50,50,50,50,50, "L"';
            //$param = '"en-GB-x","A4","","",10,10,15,15,15,3';
            //$param = '"en-GB-x","A4","","",10,10,10,10,6,3,"L"'; // Landscape
            //$param = '"en-GB-x","A4","","",10,10,10,10,6,3,"P"'; // Portrait
            //$param = "'c','Legal-L','','',10,10,50,15,5,5";
         
                   
        }
         
        return new mPDF($param);
    }
    
    
    public function make_file($pagefile, $domain, $docname, $requesttype = 'I'){
        
        $school = $this->CI->util_model->get_school_details($domain)['rs'];
        
        
        $data['school_name'] = $school->schoolname;
        $data['school_address'] = $school->address;
        $data['logo'] = strtolower($school->shortname);
        $filename = "$docname.pdf";
        
        ini_set('memory_limit','100M');

        $header = $this->CI->load->view('pdf/pdf_header', $data, true); // render the view into HTML
        $body = $pagefile; // render the view into HTML
        
        //load pdf library
        $this->CI->load->library('Pdf/pdf');
        
        //Fetch the css file 
        $stylesheet2 = file_get_contents(FCPATH.'css/themes.css');
        $stylesheet1 = file_get_contents(FCPATH.'css/mpdfstylesheet.css');
        

        $pdf = $this->load();
        //attached style to page file  
        $pdf->WriteHTML($stylesheet2, 1);
        $pdf->WriteHTML($stylesheet1, 1);
        
        


        $pdf->SetHTMLHeader($header);

        $pdf->SetFooter('Powerd by Tams'.'|{PAGENO}|'.date(DATE_RFC822)); // Add a footer for good measure <img src="https://davidsimpson.me/wp-includes/images/smilies/icon_wink.gif" alt=";)" class="wp-smiley">

        $pdf->WriteHTML($body); // write the HTML into the PDF
        $pdf->Output($filename, $requesttype); // save to file because we can
       

        
    }
}
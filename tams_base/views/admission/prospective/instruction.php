<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Application form instruction page 
 * 
 * @category   View
 * @package    Admission
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
//var_dump($applicant);
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Registration Instruction</h3>
            </div>
            <div class="box-content">
                <form 
                    class="form-horizontal  form-inline" 
                    method="POST" 
                    action="<?= site_url(sprintf('admission/updateform/2/%d',$applicant['userid']))?>">
                    <div class="well well-large">
                        <div class="alert alert-info">
                            <ol style="list-style: decimal">
                                    <li style="font-weight: bold">
                                        <u> THOSE WHO MAY APPLY </u>
                                    </li>
                                    <P>
                                        <ol style="list-style: lower-roman">
                                            <li>
                                                <p> 
                                                    Candidates who chose TASUED as their <u>first most preferred</u> institution in the
                                                    <?= explode('/',$applicant['sesname'])[0]?> Unified Tertiary  Matriculation Examination (UTME), and scored a minimum 
                                                    of <strong>180</strong> in <?= explode('/',$applicant['sesname'])[0]?> UTME.
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    Direct Entry candidates who chose TASUED as their first most preferred and/or second
                                                    most preferred institution for the <?= explode('/',$applicant['sesname'])[0]?> Academic Session and have applied through 
                                                    Joint Admission And Matriculation Board (JAMB).
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    Candidates seeking a change of institution to TASUED through JAMB, having scored a minimum 
                                                    of 180 in <?= explode('/',$applicant['sesname'])[0]?> UTME.
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    Direct Entry candidates seeking a change of institution to Tai Solarin University of Education
                                                    and obtained <?= explode('/',$applicant['sesname'])[0]?> Direct Entry JAMB form.
                                                </p>
                                            </li>
                                        </ol>
                                    </P>
                                    <li style="font-weight: bold">
                                        <u> METHOD OF APPLICATION (LOG IN PROCEDURE)   </u>
                                    </li>
                                    <P>
                                        <ol style="list-style: lower-roman">
                                            <li>
                                                <p> 
                                                    Candidates should apply online with the payment of application fee of One thousand naira only (#1,000.00). 
                                                    In addition, a processing fee of four thousand two hundred naira only (#4,200) for first choice candidates 
                                                    and Nine thousand two hundred naira (#9200) for categories of candidates in (iii) and (iv) above seeking 
                                                    change of institution to TASUED, payable with Master card or VISA ATM card
                                                    (Please print out your receipt after payment)
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    Visit the TASUED website by typing www.tasued.edu.ng on the web page. 
                                                    NB: Only the www.tasued.edu.ng that has the legitimate and authentic 
                                                    platform for the post UTME registration form. 
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    Click Post-UTME Registration Form. 
                                                    Candidates are strongly advised to click the University Degree Brochure and carefully study the 
                                                    O’Level requirements for the courses applied for, before registration on the TASUED website, www.tasued.edu.ng

                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    Complete the Registration Form by providing the required information; 
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    Submit your form by clicking submit button. 
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    Print out an identification slip containing your colour passport photograph.
                                                    The printed slip will serve as candidate’s
                                                    identification/admission card for the screening test
                                                </p>
                                            </li>
                                            <li>
                                                <p> 
                                                    The sale of online form/registration commences on Monday, 7th July, 2014 and closes 
                                                    Friday 8th August, 2014.
                                                </p>
                                            </li>
                                        </ol>
                                        <p>
                                            Note that false information provided by any candidate shall be detected by the special 
                                            TASUED software application and such candidates shall be disqualified.
                                        </p>
                                    </P>
                                    <li style="font-weight: bold">
                                        <u> SCREENING DATES</u>
                                    </li>
                                    <p>
                                        Screening shall be conducted on Saturday 9th 
                                        August and Sunday 10th August, 2014 for all 
                                        UTME candidates at the Ososa Campus of the 
                                        University, by 7.00am The screening date for Direct Entry (200 Level) 
                                        applicants shall be on Tuesday 2nd September and Wednesday 3rd September, 2014 at
                                        the University Main Campus, Ijagun by 8.00am.
                                        <p style="font-weight: bold">
                                            Candidates’ participation in the screening exercise is a mandatory requirement 
                                            for entry into Tai Solarin University of Education.  
                                        </p>
                                    </p>
                                    <li style="font-weight: bold">
                                        <u> REQUIRED INFORMATION FOR POST UTME/DIRECT ENTRY SCREENING REGISTRATION</u>
                                    </li>
                                    <p>
                                        <ol style="list-style: lower-roman">
                                            <li style="font-weight: bold">Bio-Data</li>
                                            <p>
                                                <ol style="list-style: lower-alpha">
                                                    <li>Surname</li>
                                                    <li>First Name</li>
                                                    <li>Middle Name</li>
                                                    <li>sex</li>
                                                    <li>Date of Birth</li>
                                                    <li>Age</li>
                                                    <li>Passport Size Picture (File Size: <strong>20KB</strong> max, File Format:
                                                        <strong>JPEG</strong> (i.e. <strong>jpg</strong>)</li>
                                                </ol>
                                            </p>
                                            <li style="font-weight: bold">Academic Data </li>
                                            <p>
                                                <ol style="list-style: lower-alpha">
                                                    <li>JAMB Registration Number</li>
                                                    <li>Course </li>
                                                    <li>Post O’Level Qualifications obtained with grade (where applicable)</li>
                                                    <li>UTME Score (Range: 180-400) (where applicable)</li>
                                                    <li>Detailed O’Level Results</li>
                                                </ol>
                                            </p>
                                        </ol>
                                    </p>
                                </ol>
                        </div>
                    </div>
                    
                    <div class="span12">
                        <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Proceed with Application</button>
                        </div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

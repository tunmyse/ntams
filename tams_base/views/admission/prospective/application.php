<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Prospective Registartion form 
 * 
 * @category   View
 * @package    Prospective
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>, Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
?>

<div>
    <div class="box box-bordered box-color">
        <div class="box-title">
             <h3>
                <i class="icon-magic"></i>
                Prospective Registration Form
            </h3>
        </div>
        <div class="box-content">
            <form novalidate="novalidate" 
                  action="<?php echo site_url('admission/applicaton/apply')?>" 
                  method="POST" 
                  class="form-horizontal form-wizard ui-formwizard" 
                  id="ss">
                <div class="step ui-formwizard-content" id="secondStep">
                    <ul class="wizard-steps steps-4">
                        <li>
                            <div class="single-step">
                                <span class="title">1</span>
                                <span class="circle"></span>
                                <span class="description">Personal Information</span>
                            </div>
                        </li>
                        <li class="active">
                            <div class="single-step">
                                <span class="title">2</span>
                                <span class="circle">
                                    <span class="active"></span>
                                </span>
                                <span class="description">Academic Information</span>
                            </div>
                        </li>
                        <li>
                            <div class="single-step">
                                <span class="title">3</span>
                                <span class="circle"></span>
                                <span class="description">Sponsor's Information</span>
                            </div>
                        </li>
                        <li>
                            <div class="single-step">
                                <span class="title">4</span>
                                <span class="circle"></span>
                                <span class="description">Check again</span>
                            </div>
                        </li>
                    </ul>
                    
                    <div class="row-fluid">
                        <h4><i class="icon-list"></i> Programme Choice </h4>
                        
                        <div class="control-group span5">
                            <label  for="prog[]">First Choice of Programme</label> 
                            <select name="prog[]"  class="input-xlarge" id="prog1" class="chosen-select">
                                <option value="">--Programme 1--</option>
                                <option value="CSC">Computer Science</option>
                                <option value="Law">Law</option>
                                <option value="Math">Mathematics</option>
                            </select>
                        </div>
                        <div class="control-group span5">
                           <label  for="prog[]">Second Choice of Programme</label> 
                            <select name="prog[]"  class="input-xlarge" id="prog2" class="chosen-select">
                                <option value="">--Programme 2--</option>
                                <option value="CSC">Computer Science</option>
                                <option value="Law">Law</option>
                                <option value="Math">Mathematics</option>
                            </select>
                        </div>
                    </div>

                    <div class="row-fluid">
                        <div class="box-title">
                           <h3><i class="icon-list"></i> Previous Qualification Obtained </h3>
                       </div>
                        <p>&nbsp;</p>
                       <?php $i = 0; do{?>
                       <div class="row center">
                           <div class="control-group">
                               <input type="text" name="certobtained[]" id="certobtained" placeholder="Certificate Obtained" class="input-medium"> 
                               <input type="text" name="schoolname[]" id="schoolname" placeholder="School Name" class="input-xlarge">
                               <select name="from[]"  class="input-small" id="from" >
                                   <option value="">--From--</option>
                                   <option value="1999">1999</option>
                                   <option value="2000">2000</option>
                                   <option value="2001">2001</option>
                               </select>
                               <select name="to[]"  class="input-small" id="to" >
                                   <option value="">--To--</option>
                                   <option value="1999">1999</option>
                                   <option value="2000">2000</option>
                                   <option value="2001">2001</option>
                               </select>
                           </div>

                       </div>
                       <?php $i++; } while($i < PREVIOUS_QUALIFICATION_FIELD);?>
                   </div>

                    <div class="row-fluid">
                        <div class="span6">
                            <div class="box-title">
                               <h4><i class="icon-list"></i> 1st Sitting O'level Result </h4>
                            </div>
                            <p></p>
                            <ol>
                                <div class="row-fluid">
                                    <select name="examtype[first]"  class="input-medium" id="religion" >
                                        <option value="">--Exam Type--</option>
                                        <option value="WAEC">WAEC</option>
                                        <option value="WAEC PRIVATE">WAEC PRIVATE</option>
                                        <option value="NECO">NECO</option>
                                        <option value="NECO PRIVATE">NECO PRIVATE</option>
                                    </select>
                                    <select name="examyr[first]"  class="input-small" id="examyear" >
                                        <option value="">--Year--</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                    </select>
                                    <input type="text" name="examnum[first]" id="textfield" placeholder="Exam No " class="input-small">
                                </div>
                                <p></p>
                                <?php $i = 0; do{?>
                                <li>
                                    <select name="olevel[subject][first][]">
                                        <option value="">--Subject--</option>
                                        <option value="maths">Math</option>
                                        <option value="Eng">Eng</option>
                                        <option value="Yoruba">Yor</option>
                                    </select> 
                                    <select name="olevel[grade][first][]" class="input-small">
                                        <option value="">--Grade--</option>
                                        <option value="A1">A1</option>
                                        <option value="B2">B2</option>
                                        <option value="C2">C2</option>
                                    </select> 
                                </li>
                                <?php $i++; }while($i < OLEVEL_SUBJECT_TOTAL);?>
                            </ol>
                        </div>
                        <div class="span6">
                            <ol>
                                <div class="box-title">
                                    <h4><i class="icon-list"></i> 2nd Sitting O'level Result </h4>
                                </div>
                            <p></p>
                                <div class="row-fluid ">
                                    <select name="examtype[second]"  class="input-medium" id="religion" >
                                        <option value="">--Exam Type--</option>
                                        <option value="WAEC">WAEC</option>
                                        <option value="WAEC PRIVATE">WAEC PRIVATE</option>
                                        <option value="NECO">NECO</option>
                                        <option value="NECO PRIVATE">NECO PRIVATE</option>
                                    </select>
                                    <select name="examyr[second]"  class="input-small" id="examyear" >
                                        <option value="">--Year--</option>
                                        <option value="1990">1990</option>
                                        <option value="1991">1991</option>
                                        <option value="1992">1992</option>
                                        <option value="1993">1993</option>
                                    </select>
                                    <input type="text" name="examnum[second]" id="textfield" placeholder="Exam No " class="input-small">
                                </div>
                            <p></p>
                                <?php $i = 0; do{?>
                                <li>
                                    <select name="olevel[subject][second][]">
                                        <option value="">--Subject--</option>
                                        <option value="maths">Math</option>
                                        <option value="Eng">Eng</option>
                                        <option value="Yoruba">Yor</option>
                                    </select> 
                                    <select name="olevel[grade][second][]" class="input-small">
                                        <option value="">--Grade--</option>
                                        <option value="A1">A1</option>
                                        <option value="B2">B2</option>
                                        <option value="C2">C2</option>
                                    </select> 
                                </li>
                                <?php $i++; }while($i < OLEVEL_SUBJECT_TOTAL);?>
                            </ol>
                        </div>

                    </div>
                </div>
                <div class="form-actions">
                    <input class="btn ui-wizard-content ui-formwizard-button" value="Back" id="back" type="reset">
                    <input class="btn btn-primary ui-wizard-content ui-formwizard-button" value="Next" id="next" type="submit">
                </div>
            </form>
        </div>
    </div>
</div>
			
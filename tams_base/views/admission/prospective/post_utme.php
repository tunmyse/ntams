<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Post UTME form 
 * 
 * @category   View
 * @package    Prospective
 * @subpackage post_utme
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
?>

<div class="span12">
        <div class="box box-color box-bordered">
                <div class="box-title">
                        <h3>
                                <i class="icon-magic"></i>
                                Post UTME Registration Form
                        </h3>
                </div>
                <div class="box-content">
                    <form novalidate="novalidate" action="<?php echo site_url('prospective/register')?>" method="POST" class="form-horizontal form-wizard ui-formwizard" id="ss">
                                <div style="display: none;" class="step ui-formwizard-content" id="firstStep">
                                        <ul class="wizard-steps steps-4">
                                                <li class="active">
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        1</span>
                                                                <span class="circle">
                                                                        <span class="active"></span>
                                                                </span>
                                                                <span class="description">
                                                                        Personal Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        2</span>
                                                                <span class="circle">
                                                                </span>
                                                                <span class="description">
                                                                        Academic Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        3</span>
                                                                <span class="circle">
                                                                </span>
                                                                <span class="description">
                                                                        Sponsor's Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        4</span>
                                                                <span class="circle">
                                                                </span>
                                                                <span class="description">
                                                                        Check again
                                                                </span>
                                                        </div>
                                                </li>
                                        </ul>
                                   
                                        <div class="step-forms">
                                            <div class=" box-title">
                                                <h3><i class="icon-list"></i> Personal Information</h3>
                                            </div>
                                            
                                             <!--  Fisrt Row Field -->
                                             <p></p>
                                             
                                             <div class="row-fluid"> 
                                                <div class="control-group span6">
                                                    <label for="imagefile" class="control-label">Passport </label>
                                                    <div class="controls">
                                                        <div class="fileupload fileupload-new" data-provides="fileupload"><input type="hidden">
                                                                <div class="fileupload-new thumbnail" style="max-width: 200px; max-height: 150px;"><img src="img/demo/user-1.jpg"></div>
                                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                                <div>
                                                                        <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input name="imagefile" type="file"></span>
                                                                        <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                                                </div>
                                                        </div>
                                                    </div>    
                                                </div>    
                                            </div>	
                                             
                                            <div class="row-fluid">
                                                <div class="control-group span6">
                                                    <label for="firstname" class="control-label">First name</label>
                                                    <div class="controls">                                                        
                                                        <span class='uneditable-input'><?php echo $fname?></span>
                                                    </div>
                                                </div>
                                                <div class="control-group span6">
                                                    <label for="middlename" class="control-label">Middle Name</label>
                                                    <div class="controls">
                                                            <span class='uneditable-input'><?php echo $mname?></span>
                                                    </div>
                                                </div>
                                            </div> 
                                             <!--  END Fisrt Row Field -->
                                             <!--  Second Row Field -->
                                            <div class="row-fluid">
                                                <div class="control-group span6">
                                                    <label for="lastname" class="control-label">Last Name</label>
                                                    <div class="controls">
                                                        <span class='uneditable-input'><?php echo $lname?></span>
                                                    </div>
                                                </div>
                                                <div class="control-group span6">
                                                        <label for="maiden_name" class="control-label">Maiden Name</label>
                                                        <div class="controls">
                                                            <input type="text" name="maiden_name" id="maiden_name" class="input-medium" >
                                                        </div>
                                                </div>
                                            </div>
                                           <!--  END Second Row Field --> 
                                           
                                           <!--  Third Row Field -->
                                            <div class="row-fluid">
                                                <div class="control-group span6">
                                                        <label for="address" class="control-label"> Address </label>
                                                        <div class="controls">
                                                            <textarea name="address" id="textare2" class="span12" rows="3" placeholder="Residential Address"></textarea>
                                                        </div>
                                                </div>
                                                <div class="control-group span6">
                                                    <label for="phone" class="control-label">Phone No</label>
                                                    <div class="controls">                                                        
                                                        <span class='uneditable-input'> <?php echo $phone?></span>
                                                    </div>
                                                </div>
                                            </div> 
                                            <!--  END Third Row Field -->
                                            
                                            <!--  Forth Row Field -->
                                             <div class="row-fluid">                                                                                        
                                                <div class="control-group span6">
                                                    <label for="sex" class="control-label">Sex</label>
                                                    <div class="controls">
                                                        <select name="sex" class="input-medium" id="sex" data-rule-required="true">
                                                                <option value="">-Sex-</option>
                                                                <option value="M">Male</option>
                                                                <option value="F">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group span6">
                                                    <label for="marital_status" class="control-label">Marital Status</label>
                                                    <div class="controls">
                                                        <select name="marital_status" class="input-medium" id="maritalStatus" data-rule-required="true" >
                                                            <option value="">-Status-</option>
                                                            <option value="Single">Single</option>
                                                            <option value="Married">Married</option>
                                                            <option value="Divorce">Divorce</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- END  Forth Row Field -->
                                            
                                            <!--   Fifth Row Field -->
                                            <div class="row-fluid">
                                                <div class="control-group span6">
                                                    <label for="religion" class="control-label"> Religion </label>
                                                    <div class="controls">
                                                        <select name="religion"  class="input-medium" id="religion" data-rule-required="f">
                                                            <option value="">-Religion-</option>
                                                            <option value="Christianity">Christianity</option>
                                                            <option value="Islam">Islamic</option>
                                                            <option value="Others">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group span6">
                                                    <label for="nationality" class="control-label">Nationality</label>
                                                        <div class="controls">
                                                            <select id='nationalty' data-rule-required='true' name='nationalty' class="input-medium">
                                                                <option value=''>-Nationalty-</option>
                                                                <option value='1'>Nigeria</option>
                                                            </select>
                                                        </div>
                                                </div>
                                            </div>
                                             <!--   END Fifth Row Field -->
                                             
                                             <!--   Sixth Row Field -->
                                             <div class="row-fluid">
                                                <div class="control-group span6">
                                                    <label class="control-label" for="state">State of Origin</label>
                                                        <div class="controls">
                                                            <select id='nationalty' data-rule-required='true' name='state' class="input-medium">
                                                                <option value=''>-State-</option>
                                                                <?php foreach($state as $st){?>
                                                                <option value='<?php echo $st['stid']?>'><?php echo $st['stname']?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                </div>
                                                <div class="control-group span6">
                                                    <label for="lga" class="control-label">L.G.A</label>
                                                        <div class="controls">
                                                            <select id='nationalty' data-rule-required='true' name='lga' class="input-medium">
                                                                <option value=''>-L.G.A-</option>
                                                                <?php foreach($lga as $lg){?>
                                                                <option value='<?php echo $lg['lgaid']?>'><?php echo $lg['lganame']?></option>
                                                                <?php }?>
                                                            </select>
                                                        </div>
                                                </div>
                                            </div>
                                            <!--   End Sixth Row Field --> 
                                            
                                            <!--   Seventh Row Field --> 
                                             <div class="row-fluid">
                                                <div class="control-group span6">
                                                    <label for="dob" class="control-label">Date Of Birth</label>
                                                        <div class="controls">
                                                            <input id="textfield" class="input-medium datepick" type="text" name="dob">
                                                        </div>
                                                </div>
                                                <div class="control-group span6">
                                                    <label for="extra_cur" class="control-label">Extra Curricular Activities</label>
                                                    <div class="controls">
                                                        <textarea name="extra_cur" id="extarCur" class="span11" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                           <!--   End seventh Row Field --> 
                                        </div>
                                </div>
                                <div style="display: block;" class="step ui-formwizard-content" id="secondStep">
                                        <ul class="wizard-steps steps-4">
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        1</span>
                                                                <span class="circle">

                                                                </span>
                                                                <span class="description">
                                                                        Personal Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li class="active">
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        2</span>
                                                                <span class="circle">
                                                                        <span class="active"></span>
                                                                </span>
                                                                <span class="description">
                                                                        Academic Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        3</span>
                                                                <span class="circle">
                                                                </span>
                                                                <span class="description">
                                                                        Sponsor's Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        4</span>
                                                                <span class="circle">
                                                                </span>
                                                                <span class="description">
                                                                        Check again
                                                                </span>
                                                        </div>
                                                </li>
                                        </ul>
                                        <div class=" row-fluid span11">
                                            <div class="box-title">
                                               <h3><i class="icon-list"></i> JAMB / UTME Result </h3>
                                           </div>
                                            <p>&nbsp;</p>
                                           
                                           <div class="row center">
                                               <div class="control-group">
                                                   
                                                   <ol>
                                                       <input type="text" name="utme_reg" id="jamb_reg" placeholder="UTME Registration Number" class="input-medium"> <p></p>
                                                       <li>
                                                            <select name="utme_subj1">
                                                                <option value="">--Subject--</option>
                                                                <option value="1">Math</option>
                                                                <option value="2">Eng</option>
                                                                <option value="2">Yor</option>
                                                            </select>
                                                            <input type="text" name="utme_score1" id="utme_score1" placeholder="Score" class="input-mini"> 
                                                       </li>
                                                       <li>
                                                            <select name="utme_subj2">
                                                                <option value="">--Subject--</option>
                                                                <option value="1">Math</option>
                                                                <option value="2">Eng</option>
                                                                <option value="3">Yor</option>
                                                            </select> 
                                                            <input type="text" name="utme_score2" id="utme_score1" placeholder="Score" class="input-mini"> 
                                                       </li>
                                                       <li>
                                                            <select name="utme_subj3">
                                                                <option value="">--Subject--</option>
                                                                <option value="1">Math</option>
                                                                <option value="2">Eng</option>
                                                                <option value="3">Yor</option>
                                                            </select> 
                                                           <input type="number" name="utme_score3" id="utme_score3" placeholder="Score" class="input-mini"> 
                                                       </li>
                                                   </ol>
                                               </div>

                                           </div>
                                           
                                       </div>
                                        <div class="row-fluid span11">
                                            <div class="box-title">
                                                <h4><i class="icon-list"></i> Programme Choice </h4>
                                            </div><p></p>
                                            <div class="control-group span5">
                                                <label  for="prog1">First Choice of Programme</label> 
                                                <select name="prog1"  class="input-xlarge" id="prog1" >
                                                    <option value="">--Programme 1--</option>
                                                    <option value="CSC">Computer Science</option>
                                                    <option value="Law">Law</option>
                                                    <option value="Math">Mathematics</option>
                                                </select>
                                            </div>
                                            <div class="control-group span5">
                                               <label  for="prog2">Second Choice of Programme</label> 
                                                <select name="prog2"  class="input-xlarge" id="prog2" >
                                                    <option value="">--Programme 2--</option>
                                                    <option value="CSC">Computer Science</option>
                                                    <option value="Law">Law</option>
                                                    <option value="Math">Mathematics</option>
                                                </select>
                                            </div>
                                        </div>
                                    
                                        <div class=" row-fluid span11">
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
                                    
                                    <div class="row-fluid span12">
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
                                <div style="display: none;" class="step ui-formwizard-content" id="thirdStep">
                                        <ul class="wizard-steps steps-4">
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        1</span>
                                                                <span class="circle">

                                                                </span>
                                                                <span class="description">
                                                                        Personal Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        2</span>
                                                                <span class="circle">

                                                                </span>
                                                                <span class="description">
                                                                        Academic Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li class="active">
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        3</span>
                                                                <span class="circle">
                                                                        <span class="active"></span>
                                                                </span>
                                                                <span class="description">
                                                                        Sponsor's Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        4</span>
                                                                <span class="circle">
                                                                </span>
                                                                <span class="description">
                                                                        Check again
                                                                </span>
                                                        </div>
                                                </li>
                                        </ul>
                                        <div class="box-title">
                                            <h4><i class="icon-list"></i> Sponsor's Details </h4>
                                        </div>
                                        <p></p>
                                        <div class="row-fluid ">
                                            <div class="control-group span6">
                                                <label for="spon_fname" class="control-label">First Name</label>
                                                <div class="controls">
                                                    <input type="text" name="spon_fname" id="spon_fname" class="input-medium" >
                                                </div>
                                            </div>
                                            <div class="control-group span6">
                                                <label for="spon_oname" class="control-label">Other Name</label>
                                                <div class="controls">
                                                    <input type="text" name="spon_oname" id="spon_oname" class="input-large" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid ">
                                            <div class="control-group span6">
                                                 <label for="text" class="control-label">Residential Address</label>
                                                <div class="controls">
                                                    <textarea name="spon_address" id="spon_address" class="span11" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="control-group span6">
                                                <label for="spon_phone" class="control-label">Phone Number</label>
                                                    <div class="controls">
                                                        <input type="number" name="spon_phone" id="spon_phone" class="input-medium" >
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row-fluid ">
                                            <div class="control-group span6">
                                                <label for="spon_email" class="control-label">E-mail</label>
                                                    <div class="controls">
                                                        <input type="email" name="spon_email" id="spon_email" class="input-medium" >
                                                    </div>
                                            </div>
                                        </div>
                                </div>
                                <div style="display: none;" class="step ui-formwizard-content" id="fourthstep">
                                        <ul class="wizard-steps steps-4">
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        1</span>
                                                                <span class="circle">

                                                                </span>
                                                                <span class="description">
                                                                        Personal Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        2</span>
                                                                <span class="circle">

                                                                </span>
                                                                <span class="description">
                                                                        Academic Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li>
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        3</span>
                                                                <span class="circle">
                                                                </span>
                                                                <span class="description">
                                                                        Sponsor's Information
                                                                </span>
                                                        </div>
                                                </li>
                                                <li class="active">
                                                        <div class="single-step">
                                                                <span class="title">
                                                                        4</span>
                                                                <span class="circle">
                                                                        <span class="active"></span>
                                                                </span>
                                                                <span class="description">
                                                                        Check again
                                                                </span>
                                                        </div>
                                                </li>
                                        </ul>
                                        <div class="control-group">
                                                <label for="text" class="control-label">Check again</label>
                                                <div class="controls">
                                                        <label class="checkbox"><input class="ui-wizard-content" disabled="disabled" name="form_submit" value="yes" data-rule-required="true" type="checkbox"> Everything is ok. Submit</label>
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
			
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Prospective Registartion form 
 * 
 * @category   View
 * @package    Prospective
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

//var_dump($exam_grade['rs']);

?>

<div class="row-fluid">
    <div class="span12">
            <div class="box box-color box-bordered">
                    <div class="box-title">
                            <h3>
                                <i class="icon-magic"></i>
                                Prospective Registration Form
                            </h3>
                    </div>
                    <div class="box-content nopadding">
                            <form id="ss" 
                                  class="form-horizontal form-wizard ui-formwizard"
                                  enctype="multipart/form-data"
                                  method="POST" 
                                  action="<?php echo site_url('admission/register')?>" 
                                  novalidate="novalidate">
                                
                                    <div id="firstStep" class="step ui-formwizard-content" style="display: none;">
                                            <ul class="wizard-steps steps-5">
                                                    <li class="active">
                                                            <div class="single-step">
                                                                    <span class="title">1</span>
                                                                    <span class="circle">
                                                                            <span class="active"></span>
                                                                    </span>
                                                                    <span class="description">
                                                                            Personal information
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li class="">
                                                            <div class="single-step">
                                                                    <span class="title">2</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                            Next of Kin / Sponsor's Details
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">3</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                             Education Background
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">4</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                            Programme Applying For
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">5</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                            Declaration
                                                                    </span>
                                                            </div>
                                                    </li>
                                            </ul>
                                        <h4 class="span"><i class="glyphicon-user"></i> Personal Information </h4>
                                        <div class="span12 span">
                                                <div class="control-group">
                                                    <label class="control-label" for="passport">Passport </label>
                                                    <div class="controls">
                                                        <div data-provides="fileupload" class="fileupload fileupload-new"><input type="hidden">
                                                            <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"></div>
                                                            <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                                            <div>
                                                                <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name="imagefile"></span>
                                                                <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        <div class="row-fluid span12">
                                            
                                            <div class="span6">
                                                <div class="control-group">
                                                    <label class="control-label" for="fname">Surname</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large ui-wizard-content" id="firstname" name="fname" placeholder="Enter Surname here " data-rule-required="false">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="manme">Middle name</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large ui-wizard-content" id="additionalfield" name="mname" data-rule-required="false">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="dob">Date of Birth</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large ui-wizard-content datepick" id="additionalfield" name="dob" data-rule-required="false">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="address">Contact Address</label>
                                                    <div class="controls">
                                                        <textarea class="input-large" name="address" required="" rows="3" data-rule-required="false"></textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="nationality">Nationality</label>
                                                    <div class="controls input-large">
                                                        <select id="nationality" name="nationality" class="ui-wizard-content chosen-select " data-rule-required="false">
                                                            <option value="">Choose</option>
                                                            <option value="1">Nigeria</option>
                                                            <option value="2">Others</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="marital">Marital Status</label>
                                                    <div class="controls input-large">
                                                        <select id="marital" name="marital" class="ui-wizard-content chosen-select" data-rule-required="false">
                                                            <option value="">Choose</option>
                                                            <option value="married">Married</option>
                                                            <option value="single">Single</option>
                                                            <option value="divorce">Divorce</option>
                                                            <option value="widow">Widow</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="blood">Blood Group</label>
                                                    <div class="controls input-large">
                                                        <select id="blood" name="blood" class="ui-wizard-content chosen-select " data-rule-required="false">
                                                            <option value="">Choose</option>
                                                            <option value="O">O</option>
                                                            <option value="A">A</option>
                                                            <option value="B">B</option>
                                                            <option value="AB">AB</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="hobby">Hobby</label>
                                                    <div class="controls">
                                                        <div class="span10"><input type="text" name="hobby" id="hobby" class="ui-wizard-content tagsinput input-large" value=""></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="control-group">
                                                    <label class="control-label" for="lname">first name</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large ui-wizard-content" id="anotherelem" name="lname" data-rule-required="false">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="sex">Sex</label>
                                                    <div class="controls input-large">
                                                        <select id="sex" name="sex" class="ui-wizard-content chosen-select " data-rule-required="false">
                                                            <option value="">Choose</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="phone">phone</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large ui-wizard-content" id="additionalfield" name="phone" data-rule-required="false">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="email">Email</label>
                                                    <div class="controls">
                                                        <input type="email" class="input-large ui-wizard-content" id="additionalfield" name="email" data-rule-required="false">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="soforig">State of Origin</label>
                                                    <div class="controls input-large">
                                                        <select id="soforig" name="soforig" ng-model="state" class="ui-wizard-content chosen-select " data-rule-required="false">
                                                            <option value="">Choose</option>
                                                            <?php foreach($state['rs'] as $st){?>
                                                            <option value="<?php echo $st['stateid']?>"><?php echo $st['statename']?></option>
                                                            <?php }?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="lgaoforig">Local Govt Areal</label>
                                                    <div class="controls input-large">
                                                        <select id="lgaoforig" name="lgaoforig" class="ui-wizard-content" data-rule-required="false">
                                                            <option value="">Choose</option>
                                                            <option ng-repeat="n in state_local" value="{{n.lgaid}}">{{n.lganame}}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="disable">Physical Disability</label>
                                                    <div class="controls input-large">
                                                        <select id="disable" name="disable" ng-model="disable" class="ui-wizard-content chosen-select " data-rule-required="false">
                                                            <option value="">Choose</option>
                                                            <option value="yes">Yes</option>
                                                            <option value="no">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="control-group" ng-show="disable == 'yes'">
                                                    <label class="control-label" for="disable">Disability Description</label>
                                                    <div class="controls input-large">
                                                        <textarea class="input-large" name="disable_desc" required="" rows="3" data-rule-required="false"></textarea>
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="religion">Religion</label>
                                                    <div class="controls input-large">
                                                        <select id="religion" name="religion" class="ui-wizard-content chosen-select " data-rule-required="false">
                                                            <option value="">Choose</option>
                                                            <option value="Christianity">Christianity</option>
                                                            <option value="Islam">Islam</option>
                                                            <option value="Others">Others</option>      
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="secondStep" class="step ui-formwizard-content" style="display: none;">
                                            <ul class="wizard-steps steps-5">
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">1</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                           Personal information
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li class="active">
                                                            <div class="single-step">
                                                                    <span class="title"> 2</span>
                                                                    <span class="circle">
                                                                        <span class="active"></span>
                                                                    </span>
                                                                    <span class="description">
                                                                            Next of Kin / Sponsor's Details
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">3</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                            Education Background
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">4</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                            Programmme Applying For
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">5</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                           Declaration
                                                                    </span>
                                                            </div>
                                                    </li>
                                            </ul>
                                            <h4 class="span"><i class="glyphicon-parents"></i> Next of Kin / Sponsor's Details </h4>
                                            <div class="row-fluid span12">
                                                <div class="span6">
                                                    <div class="box-bordered">
                                                        <h6><i class="icon-list"></i>  Next of Kin Details</h6>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="nkfname">Next of Kin Surname</label>
                                                        <div class="controls">
                                                            <input type="text" class="input-large ui-wizard-content" id="nkfname" name="nkfname" placeholder="Enter Next of kin Surname  " data-rule-required="false">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="nkoname">Next of Kin Other names</label>
                                                        <div class="controls">
                                                            <input type="text" class="input-large ui-wizard-content" id="nkoanme" name="nkoanme" placeholder="Enter Next of kin Other names" data-rule-required="false">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="nkphone">Next of Kin Phone</label>
                                                        <div class="controls">
                                                            <input type="text" class="input-large ui-wizard-content" id="nkphone" name="nkphone" placeholder="Enter Next of kin phone"data-rule-required="false">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="nkmail">Next of Kin E-mail</label>
                                                        <div class="controls">
                                                            <input type="text" class="input-large ui-wizard-content " id="nkphone" name="nkmail" placeholder="Enter Next of kin E-mail" data-rule-required="false">
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="nkaddress">Next of Kin Contact Address</label>
                                                        <div class="controls">
                                                            <textarea class="input-large" name="nkaddress" rows="3" placeholder="Enter Next of kin Contact Address" data-rule-required="false"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="control-group">
                                                        <label class="control-label" for="relationship">Relationship</label>
                                                        <div class="controls">
                                                            <input type="text" class="input-large ui-wizard-content " id="nkphone" name="relationship" placeholder="Relationship with Next of kin" data-rule-required="false">
                                                        </div>
                                                    </div>
                                                </div>
                                            <!--Sponsor Details -->
                                            <div class="span6">
                                                <div class="box-bordered">
                                                    <h6><i class="icon-list"></i>  Sponsor's Details</h6>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="sp_flname">Sponsor's Full Name</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large ui-wizard-content" id="sp_flname" name="sp_flname" placeholder="Enter Sponsor's Full Name"data-rule-required="false">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="sp_phone">Sponsor's Phone</label>
                                                    <div class="controls">
                                                        <input type="text" class="input-large ui-wizard-content" id="sp_phone" name="sp_phone" placeholder="Enter Sponsor's Phone No" data-rule-required="false">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="sp_mail">Sponsor's E-mail</label>
                                                    <div class="controls">
                                                        <input type="email" class="input-large ui-wizard-content" id="sp_phone" name="sp_mail" placeholder="Enter Sponsor's E-mail" data-rule-required="false">
                                                    </div>
                                                </div>
                                                <div class="control-group">
                                                    <label class="control-label" for="sp_address">Sponsor's Contact Address</label>
                                                    <div class="controls">
                                                        <textarea class="input-large" name="sp_address" rows="3" placeholder="Enter Sponsor's Contact Address" data-rule-required="false"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="thirdStep" class="step ui-formwizard-content" style="display: block;">
                                            <ul class="wizard-steps steps-5">
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">
                                                                            1</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                            Personal information
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">2</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                            Next of Kin / Sponsor's Details
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li class="active">
                                                            <div class="single-step">
                                                                    <span class="title">3</span>
                                                                    <span class="circle">
                                                                        <span class="active"></span>
                                                                    </span>
                                                                    <span class="description">
                                                                             Education Background
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">4</span>
                                                                    <span class="circle">

                                                                    </span>
                                                                    <span class="description">
                                                                            Programme Applying For
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">5</span>
                                                                    <span class="circle">

                                                                    </span>
                                                                    <span class="description">
                                                                            Declaration
                                                                    </span>
                                                            </div>
                                                    </li>
                                            </ul>
                                            <h4 class="span"><i class="icon-list"></i> Education Background </h4>
                                            <h6 class="span"><i class="icon-list"></i> Previous Qualification </h6>
                                            <div class="control-group">
                                                <label class="control-label" for="unit">No of Previous Qualification </label>
                                                <div class="controls">
                                                    <input type="number" class="input-mini ui-wizard-content"  ng-model="unit" min="1" name="unit" >
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <div class="controls-row" ng-repeat="d in dt">
                                                    <input type="text" name="prev_qualif[{{$index}}][cert]" id="prev_qualif[][cert]" placeholder="Certificate Obtained" class="input-medium span2">
                                                    <input type="text" name="prev_qualif[{{$index}}][school]" id="prev_qualif[][school]" placeholder="School Name" class="input-large span6">
                                                    <input type="text" name="prev_qualif[{{$index}}][from]" id="from[]" class=" ui-wizard-content input-mini span2 datepick" placeholder="From" data-rule-required="false"> 
                                                    <input type="text" name="prev_qualif[{{$index}}][to]" id="to[]" class="ui-wizard-content input-mini span2 datepick" placeholder="To" data-rule-required="false"> 
                                                </div>
                                            </div>
                                            <p>&nbsp;</p>
                                            <div class="control-group">
                                                <label class="control-label" for="exam_group">Exam goups</label>
                                                <div class="controls input-large">
                                                    <select id="exam_group" name="exam_group" ng-model="exam_group" class="ui-wizard-content chosen-select " data-rule-required="true">
                                                        <option value="">Choose</option>
                                                        <?php foreach ($exam_group['rs'] as $group){ ?>
                                                        <option value="<?php echo $group['groupid']?>"> <?php echo $group['groupname']?></option>
                                                        <?php }?>
                                                    </select>
                                                </div>
                                            </div>
                                        <h4 class="span"><i class="icon-list"></i> {{group_exam[0].groupname}} Result </h4>
                                        <div class="span12">
                                            <div class="row-fluid">
                                                
                                                <div class="span6">
                                                    <div class="box-bordered">
                                                        <h6><i class="icon-list"></i> {{group_exam[0].groupname}} Result Sitting 1</h6>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <select name="olevel[0][examtype]"  class="input-medium"   ng-model="exam_type1" >
                                                            <option value="">--Exam Type--</option>
                                                            <option ng-repeat="ex in ex_typ_periods" value="{{ex.examid}}">{{ex.shortname}}</option>
                                                        </select>
                                                       <input type="hidden" name="olevel[0][sitting]" value="first"> 
                                                        <select name="olevel[0][examyr]" class="ui-wizard-content input-small" >
                                                            <option value="">--Exam Year--</option>
                                                            <?php 
                                                            $i =0;
                                                            do{
                                                               $year = $this_year - $i;  
                                                            ?>
                                                            <option value="<?php echo $year?>"><?php echo $year?></option>
                                                            <?php 
                                                            $i++;
                                                            }while($i <= 30)?>
                                                        </select>
                                                        <input type="text" name="olevel[0][examnum]" id="examnum[first]" placeholder="Exam No " class="ui-wizard-content input-small">
                                                        <ol>
                                                            <br/>
                                                            <?php 
                                                            $i=1;
                                                            do {?>
                                                            <li>
                                                                <select name="olevel[0][subject][]">
                                                                    <option value="">--Subject--</option>
                                                                    <option value="{{sbj.examsubjectid}}" ng-repeat="sbj in subject1">{{sbj.subname}}</option>
                                                                </select> 
                                                                <select name="olevel[0][grade][]" class="input-small">
                                                                    <option value="">--Grade--</option>
                                                                    <option value="{{gr.examgradeid}}" ng-repeat="gr in grade1">{{gr.gradename}}</option> 
                                                                </select>
                                                               
                                                            </li>
                                                            <?php 
                                                            $i++;
                                                            }while ( $i <= 9)?>
                                                        </ol>
                                                    </div>
                                                </div>
                                                <div class="span6">
                                                    <div class="box-bordered">
                                                        <h6><i class="icon-list"></i> {{group_exam[0].groupname}} Result Sitting 1</h6>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <select name="olevel[1][examtype]"  class="input-medium"   ng-model="exam_type2" >
                                                            <option value="">--Exam Type--</option>
                                                            <option ng-repeat="ex in ex_typ_periods" value="{{ex.examid}}">{{ex.shortname}}</option>
                                                        </select>
                                                        <input type="hidden" name="olevel[1][sitting]" value="second">
                                                        <select name="olevel[1][examyr]" class="ui-wizard-content input-small">
                                                            <option value="">--Exam Year--</option>
                                                            <?php 
                                                            $i =0;
                                                            do{
                                                               $year = $this_year - $i;  
                                                            ?>
                                                            <option value="<?php echo $year?>"><?php echo $year?></option>
                                                            <?php 
                                                            $i++;
                                                            }while($i <= 30)?>
                                                        </select>
                                                        <input type="text" name="olevel[1][examnum]" id="examnum[first]" placeholder="Exam No " class="ui-wizard-content input-small">
                                                        <ol>
                                                            <br/>
                                                            <?php 
                                                            $i=1;
                                                            do {?>
                                                            <li>
                                                                <select name="olevel[1][subject][]">
                                                                    <option value="">--Subject--</option>
                                                                    <option value="{{sbj.examsubjectid}}" ng-repeat="sbj in subject2">{{sbj.subname}}</option>
                                                                </select> 
                                                                <select name="olevel[1][grade][]" class="input-small">
                                                                    <option value="">--Grade--</option>
                                                                    <option value="{{gr.examgradeid}}" ng-repeat="gr in grade2">{{gr.gradename}}</option>
                                                                </select> 
                                                            </li>
                                                            <?php 
                                                            $i++;
                                                            }while ( $i <= 9)?>
                                                        </ol>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <p>&nbsp;</p>
                                    </div>
                                    <div id="fourthStep" class="step ui-formwizard-content" style="display: block;">
                                            <ul class="wizard-steps steps-5">
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">
                                                                            1</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                            Personal information
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
                                                                            Next of Kin / Sponsor's Details
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">3</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                           Education Background  
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li class="active">
                                                            <div class="single-step">
                                                                    <span class="title">4</span>
                                                                    <span class="circle">
                                                                        <span class="active"></span> 
                                                                    </span>
                                                                    <span class="description">
                                                                            Programme Applying For
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">5</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                           Declaration 
                                                                    </span>
                                                            </div>
                                                    </li>
                                            </ul>
                                            <h4 class="span"><i class="icon-list"></i> Programme Applying For </h4>
                                            <div class="span12">
                                            <div class="row-fluid">
                                                <div class="span9">
                                                    <div class="box-bordered">
                                                        <h6><i class="icon-list"></i> UTME Result</h6>
                                                    </div>
                                                    <div class="row-fluid">
                                                        <select name="utme[year]"  class="input-small" id="examyear" data-rule-required="false">
                                                            <option value="">--Year--</option>
                                                            <option value="1990">1990</option>
                                                            <option value="1991">1991</option>
                                                            <option value="1992">1992</option>
                                                            <option value="1993">1993</option>
                                                        </select>
                                                        <input type="text" name="utme[regid]" id="textfield" placeholder="Jamb Registration No " class="input-large" data-rule-required="false">
                                                        <ol>
                                                            <br/>
                                                            <?php $j = 0;
                                                            do{?>
                                                            <li>
                                                                <select name="utme[subject][<?php echo $j?>]">
                                                                    <option value="">--Subject--</option>
                                                                    <option value="maths">Math</option>
                                                                    <option value="Eng">Eng</option>
                                                                    <option value="Yoruba">Yor</option>
                                                                </select> 
                                                                <input type="number" name="utme[score][<?php echo $j?>]" class="input-small">
                                                            </li>
                                                            <?php
                                                              $j++; 
                                                            }while($j < 4);
                                                            ?>
                                                            
                                                        </ol>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <p>&nbsp;</p>
                                        <h6 class="span"><i class="icon-list"></i> Programme Choice </h6>
                                        <div class="span12">
                                            <div class="span6">
                                                <div class="control-group">
                                                    <label class="control-label" for="prog1">First Choice of Programme</label> 
                                                    <div class="controls input-xlarge">
                                                        <select name="prog1"  class="ui-wizard-content chosen-select " id="firstprog" data-rule-required="false">
                                                            <option value="">--Programme 1--</option>
                                                            <option value="CSC">Computer Science</option>
                                                            <option value="Law">Law</option>
                                                            <option value="Math">Mathematics</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="span6">
                                                <div class="control-group">
                                                    <label class="control-label" for="prog2">Second Choice of Programme</label> 
                                                    <div class="controls input-large">
                                                        <select name="prog2"  class="ui-wizard-content chosen-select " id="secondprog" data-rule-required="false">
                                                            <option value="">--Programme 1--</option>
                                                            <option value="CSC">Computer Science</option>
                                                            <option value="Law">Law</option>
                                                            <option value="Math">Mathematics</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="fifthStep" class="step ui-formwizard-content" style="display: block;">
                                            <ul class="wizard-steps steps-5">
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">
                                                                            1</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                            Personal information
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
                                                                            Next of Kin / Sponsor's Details
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">3</span>
                                                                    <span class="circle">
                                                                    </span>
                                                                    <span class="description">
                                                                           Education Background  
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li>
                                                            <div class="single-step">
                                                                    <span class="title">4</span>
                                                                    <span class="circle">
                                                                        
                                                                    </span>
                                                                    <span class="description">
                                                                            Programme Applying For
                                                                    </span>
                                                            </div>
                                                    </li>
                                                    <li class="active">
                                                            <div class="single-step">
                                                                    <span class="title">5</span>
                                                                    <span class="circle">
                                                                        <span class="active"></span> 
                                                                    </span>
                                                                    <span class="description">
                                                                           Declaration 
                                                                    </span>
                                                            </div>
                                                    </li>
                                            </ul>
                                            <div class="control-group">
                                                    <label class="control-label" for="text">Final information</label>
                                                    <div class="controls">
                                                        <label class="checkbox">
                                                            <input class="ui-wizard-content" type="checkbox" data-rule-required="true" value="agree" name="policy">
                                                            I agree that all the information i provided is correct to my best of knowledge 
                                                        </label>
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="form-actions">
                                            <input type="reset" id="back" value="Back" class="btn ui-wizard-content ui-formwizard-button">
                                            <input type="submit" id="next" value="Submit" class="btn btn-primary ui-wizard-content ui-formwizard-button">
                                    </div>
                            </form>
                    </div>
            </div>
    </div>
</div>
<script>
    var state = <?php echo (is_array($state['rs']))? json_encode($state['rs']): '[]'?>;
    var lga = <?php echo (is_array($lga['rs']))? json_encode($lga['rs']): '[]'?>;
    var exam_groups = <?php echo (is_array($exam_group['rs']))? json_encode($exam_group['rs']): '[]'?>;
    var exam_type_period = <?php echo (is_array($exam_type_period['rs']))? json_encode($exam_type_period['rs']): '[]'?>;
    var exam_subjects = <?php echo (is_array($exam_subject['rs']))? json_encode($exam_subject['rs']): '[]'?>;
    var exam_grades = <?php echo (is_array($exam_grade['rs']))? json_encode($exam_grade['rs']): '[]'?>;
</script>
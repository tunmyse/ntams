9-<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Prospective Registartion Personal Information Page 
 * 
 * @category   View
 * @package    Admission
 * @subpackage Prospective registaration
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

//var_dump($users);
?>
<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3><i class="icon-th-list"></i> Application Form - 4 of 8 </h3>
                
            </div>
            <div class="box-content">
                <h4 class="span"><i class="glyphicon-user"></i> Personal Information </h4>
                <form class="form-horizontal form-bordered" 
                    method="POST" 
                    action="<?= site_url('admission/submit/personal_info')?>">
                    <div class="row-fluid">
                        <table class="table table-bordered table-condensed table-striped">
                            <thead>
                                <tr>
                                    <th colspan="4">Bio Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Surname : </td>
                                    <td>
                                        <input type="text" class="input-large "  name="fname" value="<?= $users['rs']['fname']?>" placeholder="Enter Surname here " required="required">
                                    </td>
                                    <td>First Name :</td>
                                    <td>
                                        <input type="text" class="input-large " value="<?= $users['rs']['lname']?>" name="lname" required="required">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Middle Name : </td>
                                    <td><input type="text" class="input-large "  value="<?= $users['rs']['mname']?>" name="mname" required="required"></td>
                                    <td>Sex :</td>
                                    <td>
                                        <div class="span4">
                                            <select id="sex" name="sex" class=" input-small chosen-select " required="required">
                                                <option value="">Choose</option>
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date Of Birtd: </td>
                                    <td>
                                        <div class="span4">
                                            <input type="date" class="input-large datepick" id="dob" value="<?= $users['rs']['dob']?>"  name="dob" required="required">
                                        </div>
                                         
                                    </td>
                                    <td>Phone :</td>
                                    <td>
                                        <input type="text" class="input-large" value="<?= $users['rs']['phone']?>" id="phone" name="phone" required="required">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Address: </td>
                                    <td>
                                        <textarea class="input-large" name="address"   rows="3" required="required"><?= $users['rs']['address']?></textarea>
                                    </td>
                                    <td>E-Mail :</td>
                                    <td>
                                        <input type="email" class="input-large " id="additionalfield" value="<?= $users['rs']['email']?>" name="email" required="required">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nationality : </td>
                                    <td>
                                        <div class="span4">
                                            <select id="nationality" name="nationality" class=" input-large chosen-select " data-rule-required="true">
                                                <option value="">Choose</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="otders">Otders</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>State Of Origin :</td>
                                    <td>
                                        <div class="span6">
                                            <select id="soforig" name="soforig" ng-model="state" class=" input-large chosen-select " required="required">
                                                <option value="">Choose</option>
                                                <?php foreach($state['rs'] as $st){?>
                                                <option value="<?= $st['stateid']?>"><?= $st['statename']?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Marital Status  : </td>
                                    <td>
                                        <div class="span6">
                                            <select id="marital" name="marital" class=" input-large chosen-select" required="required">
                                                <option value="">Choose</option>
                                                <option value="married">Married</option>
                                                <option value="single">Single</option>
                                                <option value="divorce">Divorce</option>
                                                <option value="widow">Widow</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>Lga :</td>
                                    <td>
                                        <div class="span6">
                                            <select id="lgaoforig" name="lgaoforig" class=" input-large" required="required">
                                                <option value="">Choose</option>
                                                <option ng-repeat="n in state_local" value="{{n.lgaid}}">{{n.lganame}}</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Blood Group: </td>
                                    <td>
                                        <div class="span6">
                                            <select id="blood" name="blood" class=" input-large chosen-select " required="required">
                                                <option value="">Choose</option>
                                                <option value="O">O</option>
                                                <option value="A">A</option>
                                                <option value="B">B</option>
                                                <option value="AB">AB</option>
                                            </select>
                                        </div> 
                                    </td>
                                    <td>Physical Disability :</td>
                                    <td>
                                        <div class="span6">
                                            <select id="disable" name="disable" ng-model="disable"  class=" input-large chosen-select " required="required">
                                                <option value="">Choose</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            <span ng-show="disable == 'yes'">
                                                <textarea class="input-large" name="disable_desc"  rows="3" placeholder="Describe your disability"></textarea>
                                            </span>
                                        </div> 
                                    </td>
                                </tr>
                                <tr>
                                    <td>Hobby : </td>
                                    <td>
                                         <div class="span6"><input type="text" name="hobby" id="hobby" class=" tagsinput input-large"></div>
                                    </td>
                                    <td>Religion :</td>
                                    <td>
                                        <div class="span6">
                                            <select id="religion" name="religion" class=" input-large chosen-select " required="required">
                                                <option value="">Choose</option>
                                                <option value="Christianity">Christianity</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Otders">Otders</option>      
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>
                    <input type="hidden" name="formnum" value="5">
                    <div class="form-actions">
                            <button class="btn btn-primary" type="submit">Save changes</button>
                            <button class="btn" type="button">Cancel</button>
                    </div>
                </form>
            </div>  
        </div>
    </div>
</div>
<script>
    var state = <?= (is_array($state['rs']))? json_encode($state['rs']): '[]'?>;
    var lga = <?= (is_array($lga['rs']))? json_encode($lga['rs']): '[]'?>;
    var exam_groups = <?= (is_array($exam_group['rs']))? json_encode($exam_group['rs']): '[]'?>;
    var exam_type_period = <?= (is_array($exam_type_period['rs']))? json_encode($exam_type_period['rs']): '[]'?>;
    var exam_subjects = <?= (is_array($exam_subject['rs']))? json_encode($exam_subject['rs']): '[]'?>;
    var exam_grades = <?= (is_array($exam_grade['rs']))? json_encode($exam_grade['rs']): '[]'?>;
</script>
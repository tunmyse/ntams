<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Payment Managent 
 * 
 * @category   View
 * @package    assign Schedule
 * @subpackage 
 * @author     Sule-odu Adedayo <suleodu.adedayo@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

//var_dump($payschd);
?>
<style>
   .scrolable {
            /*width: 100%;*/
            height: 700px;
            overflow: scroll;
        }
</style>


<div class="row-fluid">
    <div class="span12">
        <div class="box box-bordered box-color">
            <div class="box-title">
                <h3>
                    <i class="icon-money"></i>
                    Schedule Assignment
                </h3>
            </div>
            <div class="box-content">
                <?php if($this->main->has_perm('payment', 'payment.setup.view') && $this->main->has_perm('payment', 'payment.setup.view.payexception')){?>
                <h3>Filter</h3>
                <div class="well well-small">
                    <form class="form-vertical" method="POST" action="<?= site_url('bursary/assign/#filter_result')?>">
                        <div class="row-fluid">
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label" for="user_type">User Type</label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level " name="user_type" >
                                            <option value="">-- Choose --</option>
                                            <option value="admin" <?= ('admin' == set_value('user_type'))? 'selected' : ''?>>Admin</option>
                                            <option value="applicant" <?= ('applicant' == set_value('user_type'))? 'selected' : ''?>>Applicant</option>
                                            <option value="staff" <?= ('staff' == set_value('user_type'))? 'selected' : ''?>>Staff</option>
                                            <option value="student" <?= ('student' == set_value('user_type'))? 'selected' : ''?>>Student</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label" for="college"><?= $this->main->get('unit_name')?></label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level" name="college">
                                            <option value="">-- Choose --</option>
                                            <?php foreach ($college as  $col):?>
                                            <option value="<?= $col['colid']?>"><?= $col['coltitle']?></option>
                                            <?php endforeach;?>  
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label" for="department">Department</label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level" name="department">
                                            <option value="">-- Choose --</option>
                                            <?php foreach ($departments as  $dept):?>
                                            <option value="<?= $dept['deptid']?>" ><?= $dept['deptname']?></option>
                                            <?php endforeach;?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label" for="programme">Programme</label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level" name="programme">
                                            <option value="">-- Choose --</option>
                                            <?php foreach ($programmes as  $prog):?>
                                            <option value="<?php echo $prog['progid']?>" ><?php echo $prog['progname']?></option>
                                            <?php endforeach;?> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid ">
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label" for="level">Level</label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level" name="level">
                                            <option value="">-- Choose --</option>
                                            <?php for($idx = 1; $idx <= $max_prog_duration['duration']; $idx++){?>
                                            <option value="<?php echo  $idx?>"><?php echo $idx.'00'?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label" for="state">State</label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level" name="state">
                                            <option value="">-- Choose --</option>
                                            <?php foreach ($states as  $st):?>
                                            <option value="<?php echo  $st['stateid']?>"><?php echo $st['statename']?></option>
                                            <?php endforeach;?> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span6">
                                <div class="control-group">
                                    <label class="control-label" for="adm_type">Admission Type</label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level" name="adm_type">
                                            <option value="">-- Choose --</option>
                                            <?php foreach ($adm_type as  $admt) {?>
                                            <option value="<?php echo  $admt['typeid']?>"><?php echo $admt['sesname'] ." ".$admt['displayname']."-". $admt['type']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid ">
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label" for="coi">Change of Institustion</label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level" name="coi">
                                            <option value="">-- Choose --</option>
                                            <option value="yes">Yes</option>
                                            <option value="no">No</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="span3">
                                <div class="control-group">
                                    <label class="control-label" for="session">Session</label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level" name="session">
                                            <option value="">-- Choose --</option>
                                            <?php foreach($session as $ses){?>
                                            <option value="<?php echo $ses['sesid']?>"><?php echo $ses['sesname']?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12" style="text-align: right">
                                <button type="submit" class="btn btn-primary btn-large btn-magenta ">Search</button>
                                <input type="hidden" name="formname" value="filter">
                            </div>
                        </div>
                    </form>
                </div>
                
                <div class="well well-small">
                    <form method="POST" action="<?= site_url('busary/assign/')?>">
                        <p id="filter_result">&nbsp;</p>
                        <h3>Filter Result</h3>
                        <table class="table table-hover table-nomargin table-bordered dataTable dataTable-fixedcolumn  dataTable-scroll-y">
                            <thead>
                                <tr>
                                    <th>S/n</th>
                                    <th>User type ID</th>
                                    <th>Full Name</th>
                                    <th>College</th>
                                    <th>Department</th>
                                    <th>Level</th>
                                </tr>
                            </thead>
                            <tbody>       
                                    <?php foreach ($users as $key => $user) :?>
                                    <tr>
                                        <td><?= $key + 1?></td>
                                        <td><?= $user['usertypeid']?></td>
                                        <td ><?= strtoupper($user['fname']).', '.$user['lname'].' '.$user['mname']?></td>
                                        <td ><?= $user['coltitle']?></td>
                                        <td><?= $user['deptname']?></td>
                                        <td><?= (isset($user['level']))? $user['level']: '-'?></td>
                                        <input type="hidden" name="userid[]" value="<?= $user['userid']?>">
<!--                                        <input type="hidden" name="schedule[sche][]" value="{{just}}">-->
                                    </tr>
                                    <?php endforeach;?>
                            </tbody>
                        </table> 
                        <p>&nbsp;</p>
                        <div class="clearfix"></div>
                        <p>&nbsp;</p>
                        <p>&nbsp;</p>
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="control-group">
                                    <label class="control-label" for="textfield">Select Payment Schedule</label>
                                    <div class="controls controls-row">
                                        <select class=" chosen-select input-block-level" name="scheduleid" ng-model="just">
                                            <option value="">-- Choose --</option>
                                            <?php foreach($payschd as $schdl){?>
                                            <option value="<?= $schdl['scheduleid']?>"> <?= "{$schdl['sesname']} {$schdl['type']} Details( Amount => NGN {$schdl['amount']}, InstalmentOption => {$schdl['percentage']}, Penalty =>  NGN {$schdl['penalty'] }}"?></option>
                                            <?php }?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12" style="text-align: left">
                                <button type="submit" class="btn btn-primary btn-large btn-green ">Assign</button>
                            </div>
                        </div>
                        <input type="hidden" name="formname" value="assign">
                    </form>
                </div>
                <?php }else{?>
                <table class="table table-bordered table-condensed table-striped">
                    <thead>
                        <tr>
                            <td style="text-align: center" >
                                <div class="span alert alert-danger">
                                    <?= $this->lang->line('busary_access_denied')?>
                                </div>
                            </td>
                        </tr>
                    </thead>
                </table>
                <?php }?>
            </div>
        </div>
    </div>
</div>






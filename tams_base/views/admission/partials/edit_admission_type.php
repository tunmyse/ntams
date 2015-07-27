<!-- Edit Admission Type modal -->
<div 
    class="modal hide fade" 
    id="edit_admission_type_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Update Admission Type</h4>
    </div>
    
    <form 
        id="create_exam_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/update_admission_type')?>">
        <div class="modal-body">
            <table class="table table-bordered table-condensed table-colored-header table-striped">
                <thead>
                    <tr>
                        <th colspan="2">Set Admission Type</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Admission Type : </td>
                        <td>
                            <input type="text" name="adm_type" id="adm_title" value="{{current.type}} "class="input-xlarge">
                        </td>
                    </tr>
                    <tr>
                        <td>Admission: </td>
                        <td>
                            <div class="input-xlarge">
                                <select name="adm" 
                                    id="edtadm" 
                                    class="chosen-select"> 
                                    <option value="">--Choose--</option>
                                    <option ng-repeat="adm in data.admissions" ng-selected="current.admid == adm.admid" value="{{adm.admid}}" >{{adm.displayname}}</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Status : </td>
                        <td>
                            <div class="input-xlarge">
                                <select name="adm_status" id="edtadm_status" class="chosen-select"> 
                                    <option value="">--Choose--</option>
                                    <option value="open" ng-selected="current.status =='open'">Open</option>
                                    <option value="close" ng-selected="current.status =='close'">Close</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Enable UTME Exam : </td>
                        <td>
                            <div class="input-xlarge">
                                <select name="adm_utme" id="adm_status" class="chosen-select"> 
                                    <option value="">--Choose--</option>
                                    <option value="yes" ng-selected="current.utme =='yes'">Yes</option>
                                    <option value="no" ng-selected="current.utme =='no'">No</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-bordered table-condensed table-colored-header table-striped ">
                <thead>
                    <tr>
                        <th colspan="2"><i class="icon-money"></i> Set Admission Payment</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="2">Regular Applicant</th>
                    </tr>
                    <tr>
                        <td>Application Fee: </td>
                        <td>
                            <div class="input-xlarge">
                                <select name="reg_app_fee" id="edtregappfee"  required class="chosen-select"> 
                                    <option value="">--Choose--</option>
                                    <?php foreach($payschedules AS $schedule):?>
                                    <option ng-selected="current.reg_app_fee == <?=$schedule['scheduleid']?>" value="<?= $schedule['scheduleid']?>"><?= "{$schedule['sesname']} {$schedule['type']} : NGN {$schedule['amount']}"?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="2">C O I Applicant</th>
                    </tr>
                    <tr>
                        <td>Application Fee: </td>
                        <td>
                            <div class="input-xlarge">
                                <select name="coi_app_fee" id="edtcoiappfee"  required class="chosen-select"> 
                                    <option value="">--Choose--</option>
                                    <?php foreach($payschedules AS $schedule):?>
                                    <option ng-selected="current.coi_app_fee == <?=$schedule['scheduleid']?>" value="<?= $schedule['scheduleid']?>"><?= "{$schedule['sesname']} {$schedule['type']} : NGN {$schedule['amount']}"?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
        <input type="hidden" name="edit_admission_type_id" value="{{current.typeid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_exam_button">Update</button>
        </div>
    </form>
</div>
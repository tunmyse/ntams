<!-- Create exam dialog -->
<div 
    class="modal hide fade" 
    id="create_admission_type_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Add Type To Admission</h4>
    </div>
    
    <form 
        id="create_exam_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/create_admission_type')?>">
        
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
                            <input type="text" name="adm_type" id="adm_title" class="input-xlarge" required="">
                        </td>
                    </tr>
                    <tr>
                        <td>Admission: </td>
                        <td>
                            <div class="input-xlarge">
                                <select name="adm" 
                                    id="adm" 
                                     required=""> 
                                    <option value="">--Choose--</option>
                                    <option ng-repeat="adm in data.admissions" value="{{adm.admid}}" >{{adm.displayname}}</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Status : </td>
                        <td>
                            <div class="input-xlarge">
                                <select name="adm_status" id="adm_status"  required=""> 
                                    <option value="">--Choose--</option>
                                    <option value="open">Open</option>
                                    <option value="close">Close</option>
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Enable UTME Exam : </td>
                        <td>
                            <div class="input-xlarge">
                                <select name="adm_utme" id="admstatus"  required=""> 
                                    <option value="">--Choose--</option>
                                    <option value="yes">Yes</option>
                                    <option value="no">No</option>
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
                                <select name="reg_app_fee" id="regappfee"  required class="chosen-select"> 
                                    <option value="">--Choose--</option>
                                    <?php foreach($payschedules AS $schedule):?>
                                    <option value="<?= $schedule['scheduleid']?>"><?= "{$schedule['sesname']} {$schedule['type']} : NGN {$schedule['amount']}"?></option>
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
                                <select name="coi_app_fee" id="coiappfee"  required class="chosen-select"> 
                                    <option value="">--Choose--</option>
                                    <?php foreach($payschedules AS $schedule):?>
                                    <option value="<?= $schedule['scheduleid']?>"><?= "{$schedule['sesname']} {$schedule['type']} : NGN {$schedule['amount']}"?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_exam_button">Create</button>
        </div>
    </form>
</div>
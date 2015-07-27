<!-- edit pay head modal-->
<div 
    class="modal hide fade" 
    id="create_payexception_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true" 
    ng-controller="ExceptionController">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Add Pay Exception</h4>
    </div>
      <form id="create_college_form"
          class="form-horizontal form-striped"
          method="post"
          action="<?php echo base_url('payment/setup/sets/exception')?>">
    <div class="modal-body">
        <div class="control-group">
            <label for="session" class="control-label">Pay Schedule :</label>
            <div class="controls">
                <div class="input-xlarge">
                    <select name="payschedule"  class='chosen-select' required="required" ng-model="payschedule" ng-change="getSchedule(payschedule)">
                        <option value="">Choose</option>
                        <?php foreach ($payschd as  $schdl) { ?>
                        <option value="<?php echo $schdl['scheduleid']?>"><?php echo $schdl['sesname'].' - '.$schdl['type']?></option>
                       <?php  }?>
                    </select>                                                                     
                </div>
            </div>
        </div>
        <div class="control-group">
            <label for="payhead" class="control-label">Unit Type</label>
            <div class="controls">
                <div class="input-xlarge">
                    <select name="unittype" class='chosen-select' id="unit_type11" ng-model="unittype"  ng-change="getUnit(unittype)">
                        <option value=""> Choose </option>
                        <option value="college">College</option>
                        <option value="department">Department</option>
                        <option value="programme">Programme</option>
                    </select>                                                                     
                </div>
            </div>
        </div>
        <div class="control-group" >
            <label for="payhead" class="control-label">Unit name </label>
            <div class="controls">
                
                <div class="input-xlarge" ng-show="college" ng-disabled="">
                    <select name="unitname[]" id="unit_name11" class='chosen-select' multiple="" >
                        <?php foreach ($college as  $col) {?>
                        <option value="<?php echo $col['colid']?>"><?php echo $col['coltitle']?></option>
                        <?php }?>       
                    </select>
                </div>
                
                <div class="input-xlarge" ng-show="department" >
                    <select name="unitname[]" id="unit_name12" class='chosen-select'  multiple="">
                        <?php foreach ($departments as  $dept) {?>
                        <option value="<?php echo $dept['deptid']?>"><?php echo $dept['deptname']?></option>
                        <?php }?>
                    </select>
                </div>
                
                <div class="input-xlarge" ng-show="programme" >
                    <select name="unitname[]" id="unit_name13" class='chosen-select' multiple="">
                        <?php foreach ($programmes as  $prog) {?>
                        <option value="<?php echo $prog['progid']?>"><?php echo $prog['progname']?></option>
                        <?php }?>  
                    </select>
                </div>
                
            </div>
        </div>    
        <div class="control-group">
            <label for="instalment" class="control-label">Instalment :</label>
            <div class="controls">
                <div class="input-xlarge">
                    <select name="instalment" id="inst13" class='chosen-select'>
                        <?php foreach ($instalments as $inst) {?>
                        <option value="<?php echo $inst['instid']?>"><?php echo $inst['percentage']?></option>
                       <?php } ?>
                        
                    </select>                                                                     
                </div>
            </div>
        </div>
        <div class="control-group">
            <label for="exlevel" class="control-label">Level :</label>
            <div class="controls">
                <div class="input-xlarge">
                    <select  class='chosen-select' id="exlevel11" name="level[]" ng-model="level" multiple="" >
                            <?php for($idx = 1; $idx <= $max_prog_duration['duration']; $idx++){?>
                            <option value="<?php echo $idx?>"><?php echo $idx.'00'?></option>
                            <?php }?>     
                    </select>                                                                    
                </div>
            </div>
        </div>
        <div class="control-group">
            <label for="indigene" class="control-label">Indigene Status :</label>
            <div class="controls">
                <div class="input-xlarge">
                    <select  class='chosen-select' id="indigene" name="indigene_status" >
                        <option value="" selected="selected">Choose</option>
                        <option value="indigene">Indigen</option> 
                        <option value="non-indigene">Non-Indigen</option>
                        <option value="foreign">Foreign</option> 
                    </select>                                                                    
                </div>
            </div>
        </div>
        <div class="control-group">
            <label for="instalment" class="control-label">Admission Type :</label>
            <div class="controls">
                <div class="input-xlarge">
                    <select  class='chosen-select' id="adm_status" name="adm_status" >
                        <option value="" selected="selected">Choose</option>
                        <option value="UTME" selected="selected">UTME</option>
                    </select>                                                                    
                </div>
            </div>
        </div>
        <div class="control-group">
            <label for="level" class="control-label">Amount:</label>
            <div class="controls">
                <div class="input-append input-prepend">
                    <span class="add-on">NGN</span>
                    <input class="input-small" type="text" name="amount" placeholder="XX">
                    <span class="add-on">.00</span>
                </div>
            </div>
        </div>
        </div>                                          
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_college_button">Add</button>
        </div> 
    </form>
</div>
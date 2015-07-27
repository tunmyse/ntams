<!-- edit pay head modal-->
<div 
    class="modal hide fade" 
    id="create_payexception_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true" 
    >

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Add Pay Exception {{current[0].scheduleid}} </h4>
    </div>
    <form id="create_college_form"
          class="form-horizontal form-striped"
          method="post"  
          action="<?php echo base_url('payment/setup/sets/exception')?>" >
        
        <div class="modal-body" >
            <div  ng-if="current[0].usertype == 'applicant'">
                <div class="control-group">
                    <label for="base" class="control-label">Unit Type</label>
                    <div class="controls">
                        <div class="input-xlarge">
                            <select name="base" class='chosen-select' id="appluniy" ng-model="unittype"  ng-change="getUnit(unittype)">
                                <option value=""> Choose </option>
                                <option value="college">College</option>
                                <option value="department">Department</option>
                                <option value="programme">Programme</option>
                                <option value="adm">Admission Type</option>
                                <option value="coi">COI</option>
                                <option value="state">State</option>
                            </select>                                                                     
                        </div>
                    </div>
                </div>
                <div class="control-group" >
                    <label for="payhead" class="control-label">Base </label>
                    <div class="controls">

                        <div class="input-xlarge" ng-if="college" >
                            <select name="baseparam" id="unit_name11" class='chosen-select' >
                                <?php foreach ($college as  $col) {?>
                                <option value="<?php echo $col['colid']?>"><?php echo $col['coltitle']?></option>
                                <?php }?>       
                            </select>
                        </div>

                        <div class="input-xlarge" ng-if="department" >
                            <select name="baseparam" id="unit_name12" class='chosen-select'>
                                <?php foreach ($departments as  $dept) {?>
                                <option value="<?php echo $dept['deptid']?>"><?php echo $dept['deptname']?></option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="input-xlarge" ng-if="programme" >
                            <select name="baseparam" id="unit_name13" class='chosen-select'>
                                <?php foreach ($programmes as  $prog) {?>
                                <option value="<?php echo $prog['progid']?>"><?php echo $prog['progname']?></option>
                                <?php }?>  
                            </select>
                        </div>
                        <div class="input-xlarge" ng-if="state" >
                            <select name="baseparam" id="unit_name13" class='chosen-select'>
                                <?php foreach ($states as  $st) {?>
                                <option value="<?php echo $st['stateid']?>"><?php echo $st['statename']?></option>
                                <?php }?>  
                            </select>
                        </div>
                        <div class="input-xlarge" ng-if="coi" >
                            <select name="baseparam" id="unit_name13" class='chosen-select'>
                                <option value="">-- Choose --</option>
                                <option value="yes">Yes</option> 
                                <option value="no">No</option> 
                            </select>
                        </div>
                        <div class="input-xlarge" ng-if="adm">
                            <select name="baseparam" id="unit_name13" class='chosen-select'>
                                <option value="">-- Choose --</option>
                                <option value="UTME">UTME</option> 
                                <option value="DE">DE</option> 
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
                    <label for="level" class="control-label">Amount:</label>
                    <div class="controls">
                        <div class="input-append input-prepend">
                            <span class="add-on">NGN</span>
                            <input class="input-small" type="text" name="amount" placeholder="XX">
                            <span class="add-on">.00</span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="scheduleid" value="{{current[0].scheduleid}}">
            </div>
<!--applicant exception -->

            <div ng-if="current[0].usertype == 'student'">
                <div class="control-group">
                    <label for="base" class="control-label">Unit Type</label>
                    <div class="controls">
                        <div class="input-xlarge">
                            <select name="base" class='chosen-select' id="appluniy" ng-model="unittype"  ng-change="getUnit(unittype)">
                                <option value=""> Choose </option>
                                <option value="college">College</option>
                                <option value="department">Department</option>
                                <option value="programme">Programme</option>
                                <option value="adm">Admission Type</option>
                                <option value="coi">COI</option>
                                <option value="state">State</option>
                                <option value="level">Level</option>
                            </select>                                                                     
                        </div>
                    </div>
                </div>
                <div class="control-group" >
                    <label for="baseparam" class="control-label">Base </label>
                    <div class="controls">

                        <div class="input-xlarge" ng-if="college" >
                            <select name="baseparam" id="unit_name11" class='chosen-select' >
                                <?php foreach ($college as  $col) {?>
                                <option value="<?php echo $col['colid']?>"><?php echo $col['coltitle']?></option>
                                <?php }?>       
                            </select>
                        </div>

                        <div class="input-xlarge" ng-if="department" >
                            <select name="baseparam" id="unit_name12" class='chosen-select'>
                                <?php foreach ($departments as  $dept) {?>
                                <option value="<?php echo $dept['deptid']?>"><?php echo $dept['deptname']?></option>
                                <?php }?>
                            </select>
                        </div>

                        <div class="input-xlarge" ng-if="programme" >
                            <select name="baseparam" id="unit_name13" class='chosen-select'>
                                <?php foreach ($programmes as  $prog) {?>
                                <option value="<?php echo $prog['progid']?>"><?php echo $prog['progname']?></option>
                                <?php }?>  
                            </select>
                        </div>
                        <div class="input-xlarge" ng-if="state" >
                            <select name="baseparam" id="unit_name13" class="chosen-select">
                                <?php foreach ($states as  $st) {?>
                                <option value="<?php echo $st['stateid']?>"><?php echo $st['statename']?></option>
                                <?php }?>  
                            </select>
                        </div>
                        <div class="input-xlarge" ng-if="coi" >
                            <select name="baseparam" id="unit_name13" class='chosen-select'>
                                <option value="">-- Choose --</option>
                                <option value="yes">Yes</option> 
                                <option value="no">No</option> 
                            </select>
                        </div>
                        <div class="input-xlarge" ng-if="adm">
                            <select name="baseparam" id="unit_name13" class='chosen-select'>
                                <option value="">-- Choose --</option>
                                <option value="UTME">UTME</option> 
                                <option value="DE">DE</option> 
                            </select>
                        </div>
                    </div>
                    <div class="input-xlarge" ng-if="level">
                        <select  class='chosen-select' id="exeplevel" name="level" ng-model="level">
                                <?php for($idx = 1; $idx <= $max_prog_duration['duration']; $idx++){?>
                                <option value="<?php echo $idx?>"><?php echo $idx.'00'?></option>
                                <?php }?>     
                        </select>                                                                    
                    </div>
                </div>
                
                <div class="control-group">
                    <label for="instalment" class="control-label">Instalment :</label>
                    <div class="controls">
                        <div class="input-xlarge">
                            <select name="instalment" id="stdexcinst" class='chosen-select'>
                                <?php foreach ($instalments as $inst) {?>
                                <option value="<?php echo $inst['instid']?>"><?php echo $inst['percentage']?></option>
                               <?php } ?>
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
                <input type="hidden" name="scheduleid" value="{{current[0].scheduleid}}">
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_college_button">Add</button>
        </div> 
    </form>
</div>
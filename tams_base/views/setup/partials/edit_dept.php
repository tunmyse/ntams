<!-- Create department dialog -->
<div 
    class="modal hide fade" 
    id="edit_dept_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Department</h4>
    </div>
    
    <form 
        id="edit_dept_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('setup/department/update')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="dept_name" class="control-label">Department Name:</label>
                <div class="controls">
                    <input type="text" name="dept_name" value="{{current.deptname}}" id="edit_dept_name" class="input-xlarge">
                </div>
            </div>
            <div class="control-group">
                <label for="dept_code" class="control-label">Department Code:</label>
                <div class="controls">
                    <input type="text" value="{{current.deptcode}}" name="dept_code" id="edit_dept_code" class="input-xlarge">
                </div>
            </div>
            <div class="control-group">
                <label for="dept_col" class="control-label"><?php echo ucfirst($college_name)?>:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="dept_col" id="edit_dept_col" class='chosen-select' ng-model="current.colid">
                        <?php foreach($colleges['rs'] as $c) {?>                        
                            <option value="<?php echo $c->colid?>"><?php echo $c->colname?></option>                     
                        <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="dept_remark" class="control-label">Remark:</label>
                <div class="controls">
                    <input type="text" name="dept_remark" value="{{current.remark}}" id="edit_dept_remark" class="input-xlarge" >
                </div>
            </div>
        </div>
        
        <input type="hidden" name="edit_dept_id" value="{{current.deptid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_dept_button">Create</button>
        </div>
    </form>
</div>
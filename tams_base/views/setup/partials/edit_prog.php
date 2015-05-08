<!-- Edit programme dialog -->
<div 
    class="modal hide fade" 
    id="edit_prog_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Programme</h4>
    </div>
    
    <form 
        id="edit_prog_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('setup/programme/update')?>">
        
        <div class="modal-body">                   
            <div class="control-group">
                <label for="prog_name" class="control-label">Programme Name:</label>
                <div class="controls">
                    <input type="text" name="prog_name" value="{{current.progname}}" id="edit_prog_name" class="input-xlarge"/>
                </div>
            </div>
            <div class="control-group">
                <label for="prog_code" class="control-label">Programme Code:</label>
                <div class="controls">
                    <input type="text" name="prog_code" value="{{current.progcode}}" id="edit_prog_code" class="input-xlarge"/>
                </div>
            </div>
            <div class="control-group">
                <label for="prog_dur" class="control-label">Duration:</label>
                <div class="controls">
                    <input type="text" min='0' max='7' name="prog_dur" value="{{current.duration}}" id="edit_prog_dur" 
                           class="spinner input-mini uneditable-input"/>
                </div>
            </div>
            <div class="control-group">
                <label for="prog_dept" class="control-label">Department:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="prog_dept" id="edit_prog_dept" class='chosen-select' ng-model="current.deptid">
                        <?php foreach($depts as $d) {?>                        
                            <option value="<?php echo $d->deptid?>"><?php echo $d->deptname?></option>                     
                        <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="prog_reg" class="control-label">Allow Registration:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="prog_reg" id="edit_prog_reg" class='chosen-select' ng-model="current.registration">
                            <option value="allow">Allow</option>
                            <option value="disallow">Disallow</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="prog_remark" class="control-label">Remark:</label>
                <div class="controls">
                    <input type="text" name="prog_remark" value="{{current.prog_remark}}" 
                           id="edit_prog_remark" class="input-xlarge"/>
                </div>
            </div>
        </div>
        
        <input type="hidden" name="edit_prog_id" value="{{current.progid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="update_prog_button">Update</button>
        </div>
    </form>
    
</div>
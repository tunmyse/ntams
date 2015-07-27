<!-- Edit college dialog -->
<div 
    class="modal hide fade" 
    id="create_group_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Create Exam Group</h4>
    </div>
    
    <form 
        id="create_group_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/create_group')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="group_name" class="control-label">Group Name:</label>
                <div class="controls">
                    <input type="text" name="group_name" id="group_name" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="group_req" class="control-label">Required:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="group_req" id="group_req" class='chosen-select'>
                            <option value="TRUE" selected="true">True</option>
                            <option value="FALSE">False</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="group_max" class="control-label">Maximum Entries:</label>
                <div class="controls">
                    <input value="1" type="text" min="1" max="5" name="group_max" id="group_max" class="spinner input-mini uneditable-input"/>
                </div>
            </div>
            <div class="control-group">
                <label for="group_status" class="control-label">Status:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="group_status" id="group_status" class='chosen-select'>
                            <option value="Active" selected="true">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_group_button">Create</button>
        </div>
    </form>
</div>
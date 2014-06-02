<!-- Edit college dialog -->
<div 
    class="modal hide fade" 
    id="edit_group_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Group</h4>
    </div>
    
    <form 
        id="edit_group_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('exam/group/create')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="edit_group_name" class="control-label">Group Name:</label>
                <div class="controls">
                    <input type="text" name="edit_group_name" id="edit_group_name" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="edit_group_req" class="control-label">Required:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="edit_group_req" id="edit_group_req" class='chosen-select'>
                            <option value="TRUE">True</option>
                            <option value="FALSE">False</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="edit_group_max" class="control-label">Maximum Entries:</label>
                <div class="controls">
                    <input value="1" type="text" min="1" max="5" name="edit_group_max" id="edit_group_max" class="spinner input-mini uneditable-input"/>
                </div>
            </div>
            <div class="control-group">
                <label for="edit_group_status" class="control-label">Status:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="edit_group_status" id="edit_group_status" class='chosen-select'>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_group_button">Create</button>
        </div>
    </form>
</div>
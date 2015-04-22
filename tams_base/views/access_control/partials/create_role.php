<!-- Create group dialog -->
<div 
    class="modal hide fade" 
    id="create_role_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Create User Role</h4>
    </div>
    
    <form 
        id="create_role_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('access/role/create')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="role_name" class="control-label">Role Name:</label>
                <div class="controls">
                    <input type="text" name="group_name" id="role_name" class="input-xlarge" placeholder="Enter role name">
                </div>
            </div>
            <div class="control-group">
                <label for="role_desc" class="control-label">Group Description:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <textarea name="role_desc" class="" rows="5" placeholder="Enter description here"></textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_role_button">Create</button>
        </div>
    </form>
</div>
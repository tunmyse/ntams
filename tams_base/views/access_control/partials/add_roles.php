<!-- Create group dialog -->
<div 
    class="modal hide fade" 
    id="add_role_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Add Roles</h4>
    </div>
    
    <form 
        id="create_group_form" 
        class="form-horizontal" 
        method="post" 
        action="<?php echo site_url("access/{$type}/assign/role")?>">
                
        <div class="modal-body" style="min-height: 300px">
            <div class="control-group">
                <boot-ahead search-type="Role" holder-text="Type role name to see suggestions" 
                            url="<?php echo site_url("access/suggestions")?>"></boot-ahead>        
            </div>          
        </div>
        
        <div class="modal-footer">
            <input type="hidden" name="obj_id" value="<?php echo $id?>"/>
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="add_roles_button">Add</button>
        </div>
    </form>
</div>
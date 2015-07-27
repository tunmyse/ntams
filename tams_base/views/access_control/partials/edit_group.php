<!-- Create group dialog -->
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
        action="<?php echo site_url("access/group/update")?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="group_name" class="control-label">Group Name:</label>
                <div class="controls">
                    <input type="text" name="group_name" id="group_name" 
                           value="<?php echo $info->name?>" class="input-xlarge" placeholder="Enter group name">
                </div>
            </div>
            <div class="control-group">
                <label for="group_desc" class="control-label">Group Description:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <textarea name="group_desc" class="" rows="5" placeholder="Enter description here">
                            <?php echo $info->description?>
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <input type="hidden" name="group_id" value="<?php echo $id?>">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_group_button">Edit</button>
        </div>
    </form>
</div>
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
        action="<?php echo site_url('exam/group/update')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="edit_group_name" class="control-label">Group Name:</label>
                <div class="controls">
                    <input type="text" 
                           ng-model="current.groupname" 
                           name="edit_group_name" 
                           id="edit_group_name" 
                           class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="edit_group_req" class="control-label">Required:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="edit_group_req" 
                                ng-model="current.required" 
                                id="edit_group_req" 
                                class="chosen-select"
                               >
                            <option value="TRUE" ng-selected="current.required=='TRUE'">True</option>
                            <option value="FALSE" ng-selected="current.required=='FALSE'">False</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="edit_group_max" class="control-label">Maximum Entries:</label>
                <div class="controls">
                    <input value="1" 
                           ng-model="current.maxentries" 
                           type="text" min="1" max="5" 
                           name="edit_group_max" 
                           id="edit_group_max" 
                           class="spinner input-mini uneditable-input"/>
                </div>
            </div>
            <div class="control-group">
                <label for="edit_group_status" class="control-label">Status:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="edit_group_status" 
                                ng-model="current.status" 
                                id="edit_group_status" 
                                class="chosen-select">
                            <option value="Active" ng-selected="current.status=='Active'">Active</option>
                            <option value="Inactive" ng-selected="current.status=='Inactive'">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="edit_group_id" value="{{current.groupid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_group_button">Update</button>
        </div>
    </form>
</div>
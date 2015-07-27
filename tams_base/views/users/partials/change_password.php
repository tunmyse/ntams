<!-- Change password dialog -->
<div 
    class="modal hide fade" 
    id="change_password_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Change Account Password</h4>
    </div>
    
    <form 
        id="change_password_form" 
        class="form-horizontal form-validate" 
        method="post" 
        action="<?php echo site_url("{$user_type}/profile/edit/change_password")?>">
                
        <div class="modal-body">         
            <div class="control-group">
                <label for="old_password" class="control-label">Old Password:</label>
                <div class="controls">
                    <input type="password" name="old_password" id="old_password" placeholder="Enter Old Password" 
                           data-rule-required="true">
                </div>
            </div>
            <div class="control-group">
                <label for="new_password" class="control-label">New Password:</label>
                <div class="controls">
                    <input type="password" name="new_password" id="new_password" placeholder="Enter New Password" 
                           data-rule-required="true"/>
                </div>
            </div>
            <div class="control-group">
                <label for="confirm_password" class="control-label">Confirm New Password:</label>
                <div class="controls">
                    <input type="password" name="confirm_password" placeholder="Confirm New Password" 
                           data-rule-required="#new_password" data-rule-equalto="#new_password"/>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="change_password_button">Change</button>
        </div>
    </form>
</div>
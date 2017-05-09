<!-- Create group dialog -->
<div 
    class="modal hide fade" 
    id="edit_profile_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
    </div>
    
    <form 
        id="edit_profile_form" 
        class="form-horizontal" 
        method="post" 
        action="<?php echo site_url("{$user_type}/profile/edit/personal")?>">
                
        <div class="modal-body" style="min-height: 300px">
            
        </div>
        
        <div class="modal-footer">            
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_profile_button">Add</button>
        </div>
    </form>
</div>
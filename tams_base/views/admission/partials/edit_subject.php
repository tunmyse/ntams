<!-- Edit subject dialog -->
<div 
    class="modal hide fade" 
    id="edit_subject_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Subject</h4>
    </div>
    
    <form 
        id="edit_subject_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/update_subject')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="subject_name" class="control-label">Subject Name:</label>
                <div class="controls">
                    <input type="text" 
                           ng-model="current.subname" 
                           name="subject_name" 
                           id="edit_subject_name" 
                           class="input-xlarge" >
                </div>
            </div>
        </div>
        <input type="hidden" name="edit_subject_id" value="{{current.subid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_subject_button">Update</button>
        </div>
    </form>
</div>
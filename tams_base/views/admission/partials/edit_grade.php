<!-- Edit grade dialog -->
<div 
    class="modal hide fade" 
    id="edit_grade_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Grade</h4>
    </div>
    
    <form 
        id="edit_grade_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/update_grade')?>">
        
        <div class="modal-body">
            <div class="control-group">
                <label for="grade_name" class="control-label">Grade Name:</label>
                <div class="controls">
                    <input ng-model="current.gradename" 
                           type="text" 
                           name="grade_name" 
                           id="edit_grade_name" 
                           class="input-xlarge" >
                </div>
            </div>
        </div>
        <input type="hidden" name="edit_grade_id" value="{{current.gradeid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_grade_button">Update</button>
        </div>
    </form>
</div>
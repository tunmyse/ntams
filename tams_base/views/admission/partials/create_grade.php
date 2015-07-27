<!-- Create grade dialog -->
<div 
    class="modal hide fade" 
    id="create_grade_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Create Grade</h4>
    </div>
    
    <form 
        id="create_grade_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/create_grade')?>">
        
        <div class="modal-body">                    
            <div class="control-group">
                <label for="grade_name" class="control-label">Grade Name:</label>
                <div class="controls">
                    <input type="text" name="grade_name" id="grade_name" class="input-xlarge" />
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_grade_button">Create</button>
        </div>
    </form>
</div>
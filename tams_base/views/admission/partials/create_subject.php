<!-- Create subject dialog -->
<div 
    class="modal hide fade" 
    id="create_subject_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Create Subject</h4>
    </div>
    
    <form 
        id="create_subject_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('exam/subject/create')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="subject_name" class="control-label">Subject Name:</label>
                <div class="controls">
                    <input type="text" name="subject_name" id="subject_name" class="input-xlarge" >
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_subject_button">Create</button>
        </div>
    </form>
</div>
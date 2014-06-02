<!-- Create exam dialog -->
<div 
    class="modal hide fade" 
    id="create_exam_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Create Exam</h4>
    </div>
    
    <form 
        id="create_exam_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('exam/exam/create')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="exam_name" class="control-label">Exam Name:</label>
                <div class="controls">
                    <input type="text" name="exam_name" id="exam_name" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="exam_sname" class="control-label">Short Name:</label>
                <div class="controls">
                    <input type="text" name="exam_sname" id="exam_sname" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="exam_group" class="control-label">Group:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="exam_group" id="exam_group" class='chosen-select'>
                            
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_valid" class="control-label">Valid Years:</label>
                <div class="controls">
                    <input value="1" type="text" min="1" max="20" name="exam_valid" id="exam_valid" class="spinner input-mini uneditable-input"/>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_min" class="control-label">Minimum Subjects Required:</label>
                <div class="controls">
                    <input value="1" type="text" min="1" max="20" name="exam_min" id="exam_min" class="spinner input-mini uneditable-input"/>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_score" class="control-label">Score Based:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="exam_score" id="exam_score" class='chosen-select'>
                            <option value="FALSE">False</option>
                            <option value="TRUE">True</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_status" class="control-label">Status:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="exam_status" id="exam_status" class='chosen-select'>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_exam_button">Create</button>
        </div>
    </form>
</div>
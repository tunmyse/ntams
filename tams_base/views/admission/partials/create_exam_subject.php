<!-- Create exam dialog -->
<div 
    class="modal hide fade" 
    id="create_exam_subject_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Create Exam Subject</h4>
    </div>
    <form 
        id="create_exam_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/create_exam_subject')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="exam_id" class="control-label">Exam Name:</label>
                <div class="controls">
                    <select name="exam_id" 
                        id="examid" 
                        class='chosen-select' required="required">   
                        <option ng-repeat="exam in data.exams" 
                            value="{{exam.examid}}" 
                            ng-bind="exam.shortname"></option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label for="subj_id" class="control-label">Subject :</label>
                <div class="controls">
                    <select name="subj_id" 
                        id="subjid" 
                        class='chosen-select' required="required">   
                        <option ng-repeat="subj in data.subjects" 
                            value="{{subj.subid}}" 
                            ng-bind="subj.subname"></option>
                    </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_exam_button">Create</button>
        </div>
    </form>
</div>
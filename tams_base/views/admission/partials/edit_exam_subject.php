<!-- Edit exam dialog -->
<div 
    class="modal hide fade" 
    id="edit_exam_subject_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Exam Subject</h4>
    </div>
    
    <form 
        id="create_exam_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/update_exam_subject')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="exam_id" class="control-label">Exam Name:</label>
                <div class="controls">
                    <select name="exam_id" 
                        id="examid" 
                        class='chosen-select' required="required">   
                        <option ng-repeat="exam in data.exams"
                            ng-selected="current.examid == exam.examid"
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
                            ng-selected="current.subjectid == subj.subid"
                            ng-bind="subj.subname"></option>
                    </select>
                </div>
            </div>
        </div>
        <input type="hidden" name="edit_exam_subject_id" value="{{current.examsubjectid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_exam_button">Update</button>
        </div>
    </form>
</div>
<!-- Edit exam dialog -->
<div 
    class="modal hide fade" 
    id="edit_exam_grade_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Exam Grade</h4>
    </div>
    <form 
        id="edit_exam_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/update_exam_grade')?>">
        
        <div class="modal-body">     
            <div class="control-group">
                <label for="exam_name" class="control-label">Exam Name:</label>
                <div class="controls">
                    <select name="exam_id" 
                        id="exam_group" 
                        class='chosen-select'>   
                        <option ng-repeat="exam in data.exams" 
                            ng-selected="current.examid == exam.examid"
                            value="{{exam.examid}}"
                            ng-bind="exam.shortname"></option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_grade" class="control-label">Grade:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="exam_grade" 
                            id="exam_grade" 
                            class='chosen-select' required="required">   
                            <option ng-repeat="grd in data.grades"
                                ng-selected="current.gradeid == grd.gradeid"    
                                value="{{grd.gradeid}}"
                                ng-bind="grd.gradename"></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="grade_weight" class="control-label">Grade Weight:</label>
                <div class="controls">
                    <input value="{{current.gradeweight}}"
                            type="number" 
                           min="1" 
                           max="9" 
                           name="grade_weight" 
                           id="grade_weight" 
                           class="spinner input-mini uneditable-input" required="required"/>
                </div>
            </div>
            <div class="control-group">
                <label for="grade_desc" class="control-label">Grade Description:</label>
                <div class="controls">
                    <input type="text"
                           value="{{current.gradedesc}}"
                           name="grade_desc" 
                           id="grade_desc" 
                           class="input-xlarge" >
                </div>                           
            </div>
        </div>
        <input type="hidden" name="edit_exam_grade_id" value="{{current.examgradeid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_exam_button">Update</button>
        </div>
    </form>
</div>
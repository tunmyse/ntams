<!-- Create exam dialog -->
<div 
    class="modal hide fade" 
    id="create_exam_grade_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Create Exam Grade</h4>
    </div>
    <form 
        id="create_exam_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/create_exam_grade')?>">
        
        <div class="modal-body">     
            <div class="control-group">
                <label for="exam_name" class="control-label">Exam Name:</label>
                <div class="controls">
                    <select name="exam_id" 
                        id="exam_group" 
                        class='chosen-select'>   
                        <option ng-repeat="exam in data.exams" 
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
                                value="{{grd.gradeid}}"
                                ng-bind="grd.gradename"></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="grade_weight" class="control-label">Grade Weight:</label>
                <div class="controls">
                    <input type="number" 
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
                           name="grade_desc" 
                           id="grade_desc" 
                           class="input-xlarge" >
                </div>                           
            </div>
        </div>
        
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_exam_button">Create</button>
        </div>
    </form>
</div>
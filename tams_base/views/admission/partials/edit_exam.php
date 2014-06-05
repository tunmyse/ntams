<!-- Edit exam dialog -->
<div 
    class="modal hide fade" 
    id="edit_exam_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Exam</h4>
    </div>
    
    <form 
        id="edit_exam_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('exam/exam/update')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="exam_name" class="control-label">Exam Name:</label>
                <div class="controls">
                    <input type="text" 
                           name="exam_name" 
                           ng-model="current.examname" 
                           id="edit_exam_name" 
                           class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="exam_sname" class="control-label">Short Name:</label>
                <div class="controls">
                    <input type="text" 
                           name="exam_sname" 
                           ng-model="current.shortname" 
                           id="edit_exam_sname" 
                           class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="exam_group" class="control-label">Group:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select ng-model="current.groupid" 
                                name="exam_group" 
                                id="edit_exam_group" 
                                class='chosen-select'>
                            <option ng-repeat="group in data.groups"  
                                    value="{{group.groupid}}" 
                                    ng-bind="group.groupname" 
                                    ng-selected="current.groupid==group.groupid"></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_valid" class="control-label">Valid Years:</label>
                <div class="controls">
                    <input value="1" 
                           type="text" 
                           ng-model="current.validyears" 
                           min="1" max="20" 
                           name="exam_valid" 
                           id="edit_exam_valid" 
                           class="spinner input-mini uneditable-input"/>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_min" class="control-label">Minimum Subjects Required:</label>
                <div class="controls">
                    <input value="1" 
                           ng-model="current.minsubject" 
                           type="text" 
                           min="1" 
                           max="20" 
                           name="exam_min" 
                           id="edit_exam_min" 
                           class="spinner input-mini uneditable-input"/>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_score" class="control-label">Score Based:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="exam_score" 
                                ng-model="current.scorebased" 
                                id="edit_exam_score" 
                                class='chosen-select'>
                            <option value="TRUE" ng-selected="current.scorebased=='TRUE'">True</option>
                            <option value="FALSE" ng-selected="current.scorebased=='FALSE'">False</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_status" class="control-label">Status:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="exam_status" 
                                ng-model="current.status" 
                                id="edit_exam_status" 
                                class='chosen-select'>
                            <option value="Active" ng-selected="current.status=='Active'">Active</option>
                            <option value="Inactive" ng-selected="current.status=='Inactive'">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <input type="hidden" name="edit_exam_id" value="{{current.examid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_exam_button">Update</button>
        </div>
    </form>
</div>
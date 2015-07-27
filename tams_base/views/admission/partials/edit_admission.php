<!-- Create exam dialog -->
<div 
    class="modal hide fade" 
    id="edit_admission_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Update Admission</h4>
    </div>
    
    <form 
        id="create_exam_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('admission/update_admission')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="exam_valid" class="control-label">Admission Title:</label>
                <div class="controls">
                    <input type="text" name="adm_title" value="{{current.displayname}}" id="adm_title" class="input-xlarge"/>
                </div>
            </div>
            <div class="control-group">
                <label for="exam_group" class="control-label">Admission Session:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="adm_session" 
                            id="edtadmsesion" 
                            class="chosen-select"> 
                            <option value="">--Choose--</option>
                            <option ng-repeat="admses in data.cur_adm_ses" ng-selected="current.sesid == admses.sesid" value="{{admses.sesid}}" >{{admses.sesname}}</option>
                        </select>
                    </div>
                </div>
            </div>           
        </div>
        <input type="hidden" name="edit_admission_id" value="{{current.admid}}"/>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_exam_button">Update</button>
        </div>
    </form>
</div>
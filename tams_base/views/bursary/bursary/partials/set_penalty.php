<!-- Edit college dialog -->
<div 
    class="modal hide fade" 
    id="set_payschedule_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Activate / Deactivate Penalty for Schedule {{current.sesname}} {{current.type}}</h4>
    </div>
    
    <form 
        id="delete_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo base_url('bursary/setup/penalty')?>">
        
        <div class="modal-body">
            <div class="control-group">
                <label for="pamount" class="control-label">Penalty Amount :</label>
                <div class="controls">
                    <div class="input-append input-prepend">
                        <span class="add-on">NGN</span>
                        <input class="input-small" type="text" name="pamount" ng-model="current.penalty">
                        <span class="add-on">.00</span>
                    </div>
                </div>  
            </div>
            <div class="control-group">
                <label for="session" class="control-label">Status : </label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="status"  class='chosen-select' required="">
                            <option value="">Choose</option>
                            <option value="active" ng-selected="current.panalty_status == 'active'">Activate</option>
                            <option value="inactive" ng-selected="current.panalty_status == 'inactive'">Deactive</option>
                        </select>                                                                     
                    </div>
                </div>
            </div>
            <input type="hidden" name="schedule_id" value="{{current.scheduleid}}">
            <p>&nbsp;&nbsp;&nbsp;</p>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="delete_button">Set</button>
        </div>
    </form>
</div>
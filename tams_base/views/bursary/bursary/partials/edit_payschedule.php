<!--create Pay schedule modal-->
<div 
    class="modal hide fade" 
    id="edit_payschedule_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Pay Schedule</h4>
    </div>
    <form id="create_college_form"
          class="form-horizontal form-striped" 
          method="post"
          action="<?php echo base_url('setup/bursary/update/schedule')?>">
    <div class="modal-body">
        
        <div class="control-group">
            <label for="session" class="control-label">Session :</label>
            <div class="controls">
                <div class="input-xlarge">
                    <select name="session"  id="ses22" class='chosen-select'>
                        <option value="{{current.sesid}}" ng-selected="{{current.sesid}}">{{current.sesname}}</option>
                    </select>                                                                     
                </div>
            </div>
        </div>
        <div class="control-group">
            <label for="payhead" class="control-label">Pay Head</label>
            <div class="controls">
                <div class="input-xlarge">
                    <select name="payhead"  id="pay" class="chosen-select">
                        <option value="">Choose</option>
                        <option ng-repeat="ph in data.payheads" value="{{ph.payheadid}}" ng-selected="{{ph.payheadid}}">{{ph.type}}</option>
                    </select>
                </div>
            </div>
        </div>           
        <div class="control-group">
            <label for="instalmet" id="inst" class="control-label">Instalment :</label>
            <div class="controls">
                <div class="input-xlarge">
                    <select name="instalmet" class="chosen-select">
                        <option value="">Choose</option>
                        <option ng-repeat="i in data.instalments"  value="{{i.instid}}" ng-selected="{{i.instid}}">{{i.percentage}}</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="control-group">
            <label for="level" class="control-label">Amount:</label>
            <div class="controls">
                <div class="input-append input-prepend">
                    <span class="add-on">NGN</span>
                    <input class="input-small" type="text" name="amount"  value="{{current.amount}}"placeholder="XX">
                    <span class="add-on">.00</span>
                </div>
            </div>
        </div>
        <input type="hidden" name="id" value="{{current.scheduleid}}" >
        </div>                                          
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_college_button">Add</button>
        </div> 
    </form>
</div> 

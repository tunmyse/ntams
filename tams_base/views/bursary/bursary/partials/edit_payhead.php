<!-- edit pay head modal-->
<div 
    class="modal hide fade" 
    id="edit_payhead_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Pay Head</h4>
    </div>
    <form id="create_type_form" class="form-horizontal form-striped" method="post" action="<?php echo base_url('bursary/update/payhead')?>">                                                                           
            <div class="control-group">
               <label for="college_name" class="control-label">Type:</label>
                <div class="controls">
                    <input type="text" ng-model="current.type" name="type" class="input-xlarge" >
                </div>
            </div>
        <input type="hidden"  name="id" id="payhead_id"  value="{{current.payheadid}}" >
        <input type="hidden"  name="schoolid" id="school_id"  value="{{current.schoolid}}" >
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_type_button">Update</button>
        </div> 
    </form>
</div>
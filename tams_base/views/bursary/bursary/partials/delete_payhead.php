<!-- edit pay head modal-->
<div 
    class="modal hide fade" 
    id="delete_payhead_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Delete Pay Head</h4>
    </div>
    <form id="create_type_form" class="form-horizontal form-striped" method="post" action="<?php echo base_url('payment/deletepayhead')?>">                                                                           
        <p class="alert">Are you sure you really want to delete<strong> {{current.type}} </strong>?</p>
        <input type="hidden"  name="payheadid" id="payhead_id"  value="{{current.payheadid}}" >
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">No</button>
            <button class="btn btn-primary" type="submit" id="create_type_button">Yes</button>
        </div> 
    </form>
</div>
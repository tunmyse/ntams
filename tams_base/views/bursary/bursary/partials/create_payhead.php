<!--create pay head modal-->
<div 
    class="modal hide fade" 
    id="create_payhead_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Add Payhead Type</h4>
    </div>
    <form id="create_type_form" class="form-horizontal form-striped" method="post" action="<?php echo base_url('bursary/setup/sets/payhead')?>">                                                                           
            <div class="control-group">
               <label for="type" class="control-label">Type:</label>
                <div class="controls">
                    <input type="text" name="type" id="payhead_type" class="input-xlarge" >
                </div>
            </div>                                                                                                                                                                                                                                                                                                                                                    
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_type_button">Add</button>
        </div> 
    </form>
</div>
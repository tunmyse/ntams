<!--add_new_merchant modal-->
<div 
    class="modal hide fade" 
    id="create_merchant_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true" >

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Add New Merchant</h4>
    </div>
    <form id="add_merchant" class="form-horizontal form-striped" method="post" action="<?php echo base_url('bursary/setup/sets/merchant')?>">
        <div class="modal-body">
            <div class="control-group">
               <label for="marchname" class="control-label">Merchant Name:</label>
                <div class="controls">
                    <input type="text" name="marchname" id="college_name" class="input-xlarge" required="required">
                </div>
            </div>
            <div class="control-group">
               <label for="contact" class="control-label">Contact Person:</label>
                <div class="controls">
                    <input type="text" name="contact" id="cont_name" class="input-xlarge" required="required">
                </div>
            </div> 
            <div class="control-group">
               <label for="phone" class="control-label">Phone Number:</label>
                <div class="controls">
                    <input type="text" name="phone" id="phone" class="input-xlarge" required="required">
                </div>
            </div>
            <div class="control-group">
               <label for="email" class="control-label">E-mail:</label>
                <div class="controls">
                    <input type="email" name="email" id="email" class="input-xlarge" required="required">
                </div>
            </div>
             <div class="control-group">
               <label for="remark" class="control-label">Remark:</label>
                <div class="controls">
                    <textarea name="remark" id="college_name" class="input-xlarge"></textarea>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_college_button">Add</button>
        </div> 
    </form>
</div>
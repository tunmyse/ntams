<!--merchant info modal-->
<div 
    class="modal hide fade" 
    id="view_merchant_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Merchant Information</h4>
    </div>
    <div class="modal-body">
        <div class="control-group">
           <label for="marchname" class="control-label">Merchant Name:</label>
            <div class="controls">
                {{current.merchname}}
            </div>
        </div>
        <div class="control-group">
           <label for="contact" class="control-label">Contact Person:</label>
            <div class="controls">
                {{current.contact}}
            </div>
        </div> 
        <div class="control-group">
           <label for="phone" class="control-label">Phone Number:</label>
            <div id = "me" class="controls">
                {{current.phone}}
            </div>
        </div>
        <div class="control-group">
           <label for="email" class="control-label">E-mail:</label>
            <div class="controls">
                {{current.email}}
            </div>
        </div>
         <div class="control-group">
           <label for="remark" class="control-label">Remark:</label>
            <div class="controls">
                {{current.remark}}
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Close</button>
    </div> 
</div> 
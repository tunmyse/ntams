<!--View Pay schedule modal-->
<div 
    class="modal hide fade" 
    id="view_schedule_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">View Pay Schedule</h4>
    </div>
    <form id="create_college_form" class="form-horizontal form-striped" >
    <div class="modal-body">
            <div class="control-group">
                <label for="session" class="control-label">Session</label>
                <div class="controls">
                    <div class="input-xlarge">
                        {{current.sesname}}
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="level" class="control-label">Level:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        {{current.level}}00
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="payhead" class="control-label">Pay Head</label>
                <div class="controls">
                    <div class="input-xlarge">
                        {{current.type}}                                                                  
                    </div>
                </div>
            </div>
            <div class="control-group">
            <label for="ind_amount" class="control-label inline">Amount</label>
            <div class="controls">
                
                <div class="control-group">
                    <label for="ind_amount" class="control-label inline">Indegene Amount</label>
                    <div class="controls">
                        <div class="input-append inline">
                            <input name="ind_amount" class="span9" readonly="readonly" ng-model="current.indamount" id="appendedPrependedInput" type="text">
                            <span class="add-on">.00</span>
                        </div>
                    </div>    
                </div>
               <div class="control-group">
                    <label for="nonind_amount" class="control-label inline">Non Indegene</label>
                    <div class="controls">
                        <div class="input-append inline">
                            <input name="nonind_amount" class="span9" readonly="readonly" ng-model="current.nonindamount" id="appendedPrependedInput" type="text">
                            <span class="add-on">.00</span>
                        </div>
                    </div>    
                </div>
               <div class="control-group">
                    <label for="for_amount" class="control-label inline">Foreign Amount</label>
                    <div class="controls">
                        <div class="input-append inline">
                            <input name="for_amount"class="span9" readonly="readonly" ng-model="current.foriegnamount" id="appendedPrependedInput" type="text">
                            <span class="add-on">.00</span>
                        </div>
                    </div>    
                </div>
            </div>
        </div>                                                                                                     
        </div>                                          
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Close </button>
            
        </div> 
    </form>
</div> 

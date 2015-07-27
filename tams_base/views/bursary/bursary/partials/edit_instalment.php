 <!--Edit Instalment-->
<div 
    class="modal hide fade" 
    id="edit_instalment_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
   
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
            <h4 class="modal-title" id="myModalLabel">Edit Installment Payment </h4>
            
        </div>
    <form name="form1" class="form-horizontal form-striped" method="post" action="<?php echo base_url('bursary/update/instalment')?>">
        <div class="modal-body">
            <div class="control-group " style="color: red">
                <div class=" alert alert-info">
                    <strong>Note:</strong> The Sum of your type Must Not Exceed 100
                </div>   
            </div>
            
            <div class="control-group">
               <label for="unit" class="control-label">Number of Installment </label>
                <div class="controls">
                    <input type="number" class="input-mini"  min="0" name="unit" ng-model="unit" id="unit_instalment" >
                    <span style="float: right" ></span>
                </div>
            </div>
            <div class="controls">
                
            </div>
            <div class="control-group">
               <label for="college_name" class="control-label">Installment Type</label>
               <div class="controls" >
                    
                    <ul ng-repeat="p in dt">
                        <li>
                            {{$index + 1}} 
                            <div class="input-append">
                                    <input type="number"  name='percentage[]'  min="1" max="100" class="input-small"/>
                                    <span class="add-on">%</span>
                            </div>
                        </li>
                    </ul>

                </div>
            </div>
            <input type="hidden" name="id" value="{{current.instid}}">
            <input type="hidden" name="schoolid" value="{{current.schoolid}}">
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" name="submit" id="create_college_button">Add</button>
        </div> 
    </form>
</div>

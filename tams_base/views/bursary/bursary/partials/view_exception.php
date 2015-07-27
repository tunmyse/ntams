<!--View Pay schedule modal-->
<div 
    class="modal hide fade" 
    id="view_exception_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true"  style="alignment-adjust: central">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">View exception for Schedule # {{current}}</h4>
    </div>
    <div class="modal-body">
        <table class="table table-bordered table-colored-header table-condensed table-striped">
            <thead>
                <tr>
                    <th>S/N {{current}}</th>
                    <th>Unit Type</th>
                    <th>Unit name</th>
                    <th>instalment</th>
                    <th>level</th>
                    <th>Adm. type</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr ng-repeat="excep in current">
                    <td>{{$index + 1}}</td>
                    <td>{{current.unittype}}</td>
                    <td>{{current.me}}</td>
                    <td>{{current.instid}}</td>
                    <td>{{current.level}}</td>
                    <td>{{current.admstatus}}</td>
                    <td>{{current.amount | currency :" NGN"}}</td>
                </tr>
                <tr>
                    <td colspan="7"></td>
                </tr>
            </tbody>            
        </table>    
            
            
                                                                                                             
    </div>                                          
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn btn-primary" aria-hidden="true">Close </button>

    </div> 
</div> 

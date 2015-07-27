<!--Edit_ pay_option_modal-->
<div 
    class="modal hide fade" 
    id="edit_payoption_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit Option</h4>
    </div>
    <form id="create_college_form" class="form-horizontal form-striped" method="post" action="#">
        <div class="modal-body">
            <div class="control-group">
               <label for="college_name" class="control-label">Name:</label>
                <div class="controls">
                    <input type="text" name="name" id="college_name" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
               <label for="college_name" class="control-label">Type:</label>
                <div class="controls">
                    <input type="text" name="type" id="college_name" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
               <label for="college_name" class="control-label">Api:</label>
                <div class="controls">
                    <textarea name="textarea" id="college_name" class="input-xlarge"></textarea>
                </div>
            </div>                                                                                                                                                                                           
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_college_button">Add</button>
        </div> 
    </form>
</div>
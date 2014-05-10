<!-- Edit college dialog -->
<div 
    class="modal hide fade" 
    id="edit_college_modal" 
    tabindex="-1" 
    role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Edit <?php echo ucfirst($college_name)?></h4>
    </div>
    
    <form 
        id="edit_college_form" 
        class="form-horizontal form-striped" 
        method="post" 
        action="<?php echo site_url('college/update')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="college_name" class="control-label"><?php echo ucfirst($college_name)?> Name:</label>
                <div class="controls">
                    <input type="text" name="college_name" id="edit_college_name" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="college_title" class="control-label"><?php echo ucfirst($college_name)?> Title:</label>
                <div class="controls">
                    <input type="text" name="college_title" id="edit_college_title" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="college_code" class="control-label"><?php echo ucfirst($college_name)?> Code:</label>
                <div class="controls">
                    <input type="text" name="college_code" id="edit_college_code" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="college_remark" class="control-label">Remark:</label>
                <div class="controls">
                    <input type="text" name="college_remark" id="edit_college_remark" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="special" class="control-label">Special:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="special" id="edit_special" class='chosen-select'>
                            <option value="No" selected="true">False</option>
                            <option value="Yes">True</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="edit_college_button">Update</button>
        </div>
    </form>
</div>
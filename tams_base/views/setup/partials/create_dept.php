<!-- Create department dialog -->
<div class="modal hide fade" 
     id="create_dept_modal" 
     tabindex="-1" role="dialog" 
     aria-labelledby="basicModal" 
     aria-hidden="true">
    
    <?php if($colleges != DEFAULT_EMPTY) {?>
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Create New Department</h4>
    </div>
    
    <form id="create_dept_form" class="form-horizontal form-striped" method="post" 
          action="<?php echo site_url('setup/department/create')?>">
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="dept_name" class="control-label">Department Name:</label>
                <div class="controls">
                    <input type="text" name="dept_name" id="dept_name" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="dept_code" class="control-label">Department Code:</label>
                <div class="controls">
                    <input type="text" name="dept_code" id="dept_code" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="dept_col" class="control-label"><?php echo ucfirst($college_name)?>:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="dept_col" id="dept_col" class='chosen-select'>
                        <?php foreach($colleges as $c) {?>                        
                            <option value="<?php echo $c->colid?>"><?php echo $c->colname?></option>                     
                        <?php }?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="control-group">
                <label for="dept_remark" class="control-label">Remark:</label>
                <div class="controls">
                    <input type="text" name="dept_remark" id="dept_remark" class="input-xlarge" >
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_dept_button">Create</button>
        </div>
    </form>
    
    <?php }else {?>
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Notice</h4>
    </div>
    
    <div class="modal-body">
        <div class="alert clearfix">
            <div class="pull-left" style="font-size: 40px; margin-right: 10px">
                <i class="icon-warning-sign"> </i>
            </div>
            <div class="pull-left" style="width: 80%">
                <?php echo sprintf($this->lang->line('create_dependency'), $college_name);?>
            </div>
        </div>
    </div>
    
    <div class="modal-footer">
        <button data-dismiss="modal" class="btn" aria-hidden="true">Close</button>
    </div>
    
    <?php }?>
</div>
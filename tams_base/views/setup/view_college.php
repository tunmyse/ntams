<div>
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-globe"></i>
                <?php echo ucfirst($college_name)?> in the University                                        
            </h3>
        </div>
        <div class="box-content nopadding"> 
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <button href="#create_college_modal" data-toggle="modal" class="btn btn-green">
                                <i class="icon-plus"> </i> 
                                Add
                            </button>
                        </th>
                        <th>Actions</th>
                    </tr>                                        
                </thead>
                <tbody>
                    <?php 
                        if($colleges['status'] == DEFAULT_SUCCESS) {
                            foreach($colleges['rs'] as $key => $c) {
                    ?>
                    <tr>                                                 
                        <td>
                            <a 
                                data-toggle="modal" 
                                href="<?php echo site_url('setup/college/info/'.url_title("{$c->colname} {$c->colid}", '-', TRUE))?>">
                                <?php echo $c->colname?>
                            </a>
                        </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn dropdown-toggle" href="#" data-toggle="dropdown">
                                    <i class="icon-cog"> </i>
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-success">
                                    <li>
                                        <a 
                                            href="#edit_college_modal" 
                                            data-toggle="modal" 
                                            data-id="<?php echo $c->colid?>">Edit</a>
                                    </li>
                                    <?php //if($dept_count[$key]) {?>
                                    <li>
                                        <a href="#">Delete</a>
                                    </li>
                                    <?php //}?>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    <?php                       
                            } // end of foreach loop 
                        } else {
                    ?>
                    <tr>                                                 
                        <td colspan="2">
                            <?php echo sprintf($this->lang->line('no_entries'), $college_name)?>
                        </td>                        
                    </tr>
                        <?php } // end of else statement?>
                </tbody>
            </table>
        </div>
    </div>                                
</div>           

<!-- Create college dialog -->
<div 
    class="modal hide fade" 
    id="create_college_modal" 
    tabindex="-1" role="dialog" 
    aria-labelledby="basicModal" 
    aria-hidden="true">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
        <h4 class="modal-title" id="myModalLabel">Create New <?php echo ucfirst($college_name)?></h4>
    </div>
    
    <form 
        id="create_college_form" 
        class="form-horizontal form-striped" 
        method="post" action="<?php echo site_url('setup/college/create')?>">
        
        <div class="modal-body">
                    
            <div class="control-group">
                <label for="college_name" class="control-label"><?php echo ucfirst($college_name)?> Name:</label>
                <div class="controls">
                    <input type="text" name="college_name" id="college_name" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="college_title" class="control-label"><?php echo ucfirst($college_name)?> Title:</label>
                <div class="controls">
                    <input type="text" name="college_title" id="college_title" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="college_code" class="control-label"><?php echo ucfirst($college_name)?> Code:</label>
                <div class="controls">
                    <input type="text" name="college_code" id="college_code" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="college_remark" class="control-label">Remark:</label>
                <div class="controls">
                    <input type="text" name="college_remark" id="college_remark" class="input-xlarge" >
                </div>
            </div>
            <div class="control-group">
                <label for="special" class="control-label">Special:</label>
                <div class="controls">
                    <div class="input-xlarge">
                        <select name="special" id="special" class='chosen-select'>
                            <option value="No" selected="true">False</option>
                            <option value="Yes">True</option>
                        </select>
                    </div>
                </div>
            </div>
            
        
    </div>
        <div class="modal-footer">
            <button data-dismiss="modal" class="btn" aria-hidden="true">Cancel</button>
            <button class="btn btn-primary" type="submit" id="create_college_button">Create</button>
        </div>
    </form>
</div>
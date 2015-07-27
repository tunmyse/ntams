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
                            <?php if($this->main->has_perm('', ['setup.college.create'])):?>
                            <button href="#create_college_modal" data-toggle="modal" class="btn btn-green">                            
                                <i class="icon-plus"> </i> 
                                Add
                            </button>
                            <?php endif;?>
                        </th>
                        <th>Actions</th>
                    </tr>                                        
                </thead>
                <tbody>
                    <?php $json_colleges = [];
                        if($colleges['status'] == DEFAULT_SUCCESS) {
                            $json_colleges = json_encode($colleges['rs']);
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
                                    <?php if($this->main->has_perm('', ['setup.college.edit'])):?>
                                    <li>
                                        <a ng-click="openEditDialog('college', <?php echo $key?>, $event)">Edit</a>
                                    </li>
                                    <?php endif;?>
                                    
                                    <?php //if($dept_count[$key]) {?>
                                    <?php if($this->main->has_perm('', ['setup.college.delete'])):?>
                                    <li>
                                        <a ng-click="openDeleteDialog('college', <?php echo $key?>, $event)">Delete</a>
                                    </li>
                                    <?php endif;?>
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

<script type="text/javascript">

    var colleges = <?php echo $json_colleges?>;
    var depts = {};
    var progs = {};

</script>
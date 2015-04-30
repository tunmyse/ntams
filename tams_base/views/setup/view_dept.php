<div>
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-globe"></i>
                Departments in the University                                        
            </h3>
        </div>
        <div class="box-content nopadding"> 
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <button href="#create_dept_modal" data-toggle="modal" class="btn btn-green">
                                <i class="icon-plus"> </i> 
                                Add
                            </button>
                        </th>
                        <th>Actions</th>
                    </tr>                                        
                </thead>
                <tbody>
                    <?php 
                        $json_depts = [];
                        if($depts['status'] == DEFAULT_SUCCESS) {
                            $json_depts = json_encode($depts['rs']);
                            foreach($depts['rs'] as $key => $d) {
                    ?>
                    <tr>                                                 
                        <td>
                            <a 
                                data-toggle="modal" 
                                href="<?php echo site_url('setup/department/info/'.url_title("{$d->deptname} {$d->deptid}", '-', TRUE))?>">
                                <?php echo $d->deptname?>
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
                                        <a ng-click="openEditDialog('dept', <?php echo $key?>, $event)">Edit</a>
                                    </li>
                                    <li>
                                        <a ng-click="openDeleteDialog('dept', <?php echo $key?>, $event)">Delete</a>
                                    </li>
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
                            <?php echo sprintf($this->lang->line('no_entries'), 'departments')?>
                        </td>                        
                    </tr>
                    
                    <?php } // end of else statement?>
                </tbody>
            </table>
        </div>
    </div>                                
</div>
<script type="text/javascript">

    var colleges = {};
    var depts = <?php echo $json_depts?>;
    var progs = {};

</script>
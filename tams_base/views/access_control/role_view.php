<div>
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="glyphicon-sort"></i>
                 User Roles                                       
            </h3>
        </div>
        <div class="box-content nopadding"> 
            <table class="table table-striped table-hover dataTable dataTable-columnfilter">
                <thead>
                    <tr class="thefilter">
                        <th>Role Name</th>
                        <th>Actions</th>
                    </tr>                                          
                </thead>
                <tbody>
                    <?php foreach($roles as $role) : ?>
                    <tr>                                                 
                        <td>
                            <a href="<?php echo site_url("access/role?id={$role->roleid}")?>">
                                <h4><?php echo $role->name?></h4>
                            </a>
                        </td> 
                        <td>
                            <div class="btn-group">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="icon-cog"></i> 
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo site_url("access/role?id={$role->roleid}")?>">View Details</a>
                                    </li>
                                    <li>
                                        <a href="#">Edit Role</a>
                                    </li>
                                </ul>
                            </div>
                        </td>                         
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>                                
</div>           
<script type="text/javascript">
    //Customise 'no data' message.
   $(function() {var table = $('#DataTables_Table_0').dataTable();
        table.fnSettings().oLanguage.sEmptyTable = "<?php echo sprintf($this->lang->line('no_entries'), 'roles')?>";
        table.fnDraw();
   });
   
</script>
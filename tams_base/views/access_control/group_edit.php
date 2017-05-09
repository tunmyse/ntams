<div>
    <h2 style="display: inline-block">Edit "<?php echo $info->name?>"</h2>
    <a data-toggle="modal" href="#edit_group_modal">edit name</a>
                
    <p>
        <?php echo $info->description?> 
        <a data-toggle="modal" href="#edit_group_modal"><?php echo $info->description != NULL? 'edit':'add'?> description</a> 
    </p>
    <p>
        <?php echo $info->ownername?>  
        <a data-toggle="modal" href="#change_owner_modal">change owner</a>
    </p>
    
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="glyphicon-group"></i>
                 Group Association                                      
            </h3>
            <ul class="tabs">
                <li class="active">
                    <a data-toggle="tab" href="#roles">Group Roles</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#perms">Group Permissions</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#users">Group Users</a>
                </li>
            </ul>
        </div>
        <div class="box-content nopadding"> 
            <div class="tab-content">
                <div id="roles" class="tab-pane active">
                    <p class="clearfix pad-1">
                        <a class="btn btn-green pull-right" data-toggle="modal" href="#add_role_modal">
                            Add Role(s)
                        </a>
                    </p>
                    
                    <table class="table table-striped table-hover dataTable dataTable-columnfilter">
                        <thead>   
                            <tr class="thefilter">
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($assoc as $key => $role) : 
                                    if($role->type !== 'role') :
                                        break;
                                    endif;
                            ?>
                            <tr>                                                 
                                <td>
                                    <a href='<?php echo site_url("access/role?id={$role->id}")?>'>
                                        <h4><?php echo $role->name?></h4>
                                    </a>
                                </td>
                                <td>
                                    <i class="icon-trash"></i>
                                </td>                         
                            </tr>
                            <?php 
                                unset($assoc[$key]); 
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <div id="perms" class="tab-pane">
                    <p class="clearfix pad-1">
                        <a class="btn btn-green pull-right" data-toggle="modal" href="#add_perm_modal">
                            Add Permission(s)
                        </a>
                    </p>
                    <table class="table table-striped table-hover dataTable dataTable-columnfilter">
                        <thead>
                            <tr class="thefilter">
                                <th>Permission</th>
                                <th>Module</th>
                                <th>Actions</th>
                            </tr>                                       
                        </thead>
                        <tbody>
                            <?php 
                                foreach($assoc as $key => $perm) : 
                                    if($perm->type !== 'perm') :
                                        break;
                                    endif;
                            ?>
                            <tr>                                                 
                                <td>
                                    <a href='<?php echo site_url("access/permission?id={$perm->id}")?>'>
                                        <h4><?php echo $perm->name?></h4>
                                    </a>
                                </td>
                                <td>
                                    <a href='<?php echo site_url("module-manager/module?id={$perm->exid}")?>'>
                                        <?php echo $perm->exname?>
                                    </a>
                                </td>
                                <td>
                                    <i class="icon-trash"></i>
                                </td>                         
                            </tr>
                            <?php 
                                unset($assoc[$key]); 
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
                
                <div id="users" class="tab-pane">
                    <p class="clearfix pad-1">
                        <a class="btn btn-green pull-right" data-toggle="modal" href="#add_user_modal">
                            Add User(s)
                        </a>
                    </p>
                    <table class="table table-striped table-hover dataTable dataTable-columnfilter">
                        <thead>
                            <tr class="thefilter">
                                <th>Users</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr> 
                        </thead>
                        <tbody>
                            <?php foreach($assoc as $key => $user) : ?>
                            <tr>                                                 
                                <td>
                                    <a href='<?php echo site_url("{$user->type}/profile?id={$user->id}")?>'>
                                        <h4><?php echo $user->name?></h4>
                                    </a>
                                </td>
                                <td><?php echo ucfirst($user->type)?></td>
                                <td>
                                    <i class="icon-trash"></i>
                                </td>                         
                            </tr>
                            <?php endforeach; ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>                                
</div>           
<script type="text/javascript">
    //Customise 'no data' message.
   $(function() {
       
        var table = $('#DataTables_Table_0').dataTable();
        table.fnSettings().oLanguage.sEmptyTable = "<?php echo sprintf($this->lang->line('no_entries'), 'roles')?>";
        table.fnDraw();
        
        var table = $('#DataTables_Table_1').dataTable();
        table.fnSettings().oLanguage.sEmptyTable = "<?php echo sprintf($this->lang->line('no_entries'), 'permissions')?>";
        table.fnDraw();
        
        var table = $('#DataTables_Table_2').dataTable();
        table.fnSettings().oLanguage.sEmptyTable = "<?php echo sprintf($this->lang->line('no_entries'), 'users')?>";
        table.fnDraw();
   });
   
</script>
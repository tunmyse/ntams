<div>
    <h2>
        <?php echo $info->name?>
        <a ng-show="data.edit" data-toggle="modal" href="#edit_group_modal" style="font-size: 13px; font-weight: normal">edit name</a>
    </h2>
    <p>
        <?php echo $info->description?>
        <a ng-show="data.edit" data-toggle="modal" href="#edit_group_modal">
            <?php echo $info->description != NULL? 'edit':'add'?> description
        </a> 
    </p>
    <p>
        <?php echo $info->ownername?> &nbsp;&nbsp; 
        <a ng-show="data.edit" data-toggle="modal" href="#change_owner_modal">change owner</a>
        <span class="pull-right">
            <a ng-click="enableEdit()" class="btn btn-green" href="#">
                Edit Group
            </a>
        </span>
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
                            <tr>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>      
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
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="icon-cog"></i><span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href='<?php echo site_url("access/role?id={$role->id}")?>'>
                                                    View Details
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Remove Role</a>
                                            </li>
                                        </ul>
                                    </div>
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
                            <tr>
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
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="icon-cog"></i> 
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="#">View Details</a>
                                            </li>
                                            <li>
                                                <a href="">Remove Permission</a>
                                            </li>
                                        </ul>
                                    </div>
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
                            <tr>
                                <th>Users</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr> 
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
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="icon-cog"></i> 
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href='<?php echo site_url("{$user->type}/profile?id={$user->id}")?>'>
                                                    View Profile
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">Remove User</a>
                                            </li>
                                        </ul>
                                    </div>
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
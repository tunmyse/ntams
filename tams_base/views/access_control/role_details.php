<div>
    <h2><?php echo $info->name?></h2>
    <p><?php echo $info->description?></p>
    <p>
        &nbsp;&nbsp; 
        <span class="pull-right">
            <a class="btn btn-green" href="<?php echo site_url("access/role/edit?id={$info->roleid}")?>">Edit Role</a>
        </span>
    </p>
    
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="glyphicon-group"></i>
                 Role Association                                      
            </h3>
            <ul class="tabs">
                <li class="active">
                    <a data-toggle="tab" href="#groups">Role Groups</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#perms">Role Permissions</a>
                </li>
                <li>
                    <a data-toggle="tab" href="#users">Role Users</a>
                </li>
            </ul>
        </div>
        <div class="box-content nopadding"> 
            <div class="tab-content">
                <div id="groups" class="tab-pane active">
                    <table class="table table-striped table-hover dataTable dataTable-columnfilter">
                        <thead>                                      
                            <tr class="thefilter">
                                <th>Group</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                foreach($assoc as $key => $group) : 
                                    if($group->type !== 'group') :
                                        break;
                                    endif;
                            ?>
                            <tr>                                                 
                                <td>
                                    <a href='<?php echo site_url("access/group?id={$group->id}")?>'>
                                        <h4><?php echo $group->name?></h4>
                                        </a>
                                </td>                         
                                <td>
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="icon-cog"></i><span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href='<?php echo site_url("access/group?id={$group->id}")?>'>
                                                    View Details
                                        </a>
                                            </li>
                                            <li>
                                                <a href="#">Remove Group</a>
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
        table.fnSettings().oLanguage.sEmptyTable = "<?php echo sprintf($this->lang->line('no_entries'), 'groups')?>";
        table.fnDraw();
        
        var table = $('#DataTables_Table_1').dataTable();
        table.fnSettings().oLanguage.sEmptyTable = "<?php echo sprintf($this->lang->line('no_entries'), 'permissions')?>";
        table.fnDraw();
        
        var table = $('#DataTables_Table_2').dataTable();
        table.fnSettings().oLanguage.sEmptyTable = "<?php echo sprintf($this->lang->line('no_entries'), 'users')?>";
        table.fnDraw();
   });
   
</script>

<div>
    <h2><?php echo $info->name?></h2>
    <p><?php echo $info->description?></p>
    <p><?php echo $info->ownername?></p>
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
                    <table class="table table-striped table-hover dataTable dataTable-columnfilter">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>                                        
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($assoc['roles'])) {
                                    foreach($roles as $role) {
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
                            <?php }}else {?>
                            <tr>                                                 
                                <td colspan="2"><?php echo sprintf($this->lang->line('no_entries'), 'roles')?></td>                         
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
                
                <div id="perms" class="tab-pane">
                    <table class="table table-striped table-hover dataTable dataTable-columnfilter">
                        <thead>
                            <tr>
                                <th>Permission</th>
                                <th>Module</th>
                                <th>Actions</th>
                            </tr>                                        
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($assoc['perms'])) {
                                    foreach($perms as $perm) {
                            ?>
                            <tr>                                                 
                                <td>
                                    <a href='<?php echo site_url("access/permission?id={$perm->id}")?>'>
                                        <h4><?php echo $perm->name?></h4>
                                    </a>
                                </td>
                                <th><?php echo $perm->module?></th>
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
                            <?php }}else {?>
                            <tr>                                                 
                                <td colspan="3"><?php echo sprintf($this->lang->line('no_entries'), 'permissions')?></td>                         
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
                
                <div id="users" class="tab-pane">
                    <table class="table table-striped table-hover dataTable dataTable-columnfilter">
                        <thead>
                            <tr>
                                <th>Users</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>                                        
                        </thead>
                        <tbody>
                            <?php 
                                if(!empty($assoc['users'])) {
                                    foreach($users as $user) {
                            ?>
                            <tr>                                                 
                                <td>
                                    <a href='<?php echo site_url("{$user->usertype}/profile?id={$user->id}")?>'>
                                        <h4><?php echo $user->name?></h4>
                                    </a>
                                </td>
                                <td><?php echo ucfirst($user->usertype)?></td>
                                <td>
                                    <div class="btn-group">
                                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                            <i class="icon-cog"></i> 
                                            <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href='<?php echo site_url("{$user->usertype}/profile?id={$user->id}")?>'>
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
                            <?php }}else {?>
                            <tr>                                                 
                                <td colspan="3"><?php echo sprintf($this->lang->line('no_entries'), 'users')?></td>                         
                            </tr>
                            <?php }?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>                                
</div>           

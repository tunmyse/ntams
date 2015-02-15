<div>
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="glyphicon-group"></i>
                 User Groups                                   
            </h3>
            <a class="btn pull-right" data-toggle="modal" href="#create_group_modal">New User Group</a>
        </div>
        <div class="box-content nopadding"> 
            <table class="table table-striped table-hover dataTable dataTable-columnfilter">
                <thead>
                    <tr>
                        <th>Group Name</th>
                        <th>Owner</th>
                        <th>Actions</th>
                    </tr>                                        
                </thead>
                <tbody>
                    <?php 
                        if(!empty($groups)) {
                            foreach($groups as $group) {
                    ?>
                    <tr>                                                 
                        <td>
                            <a href="<?php echo site_url("access/group?id={$group->groupid}")?>">
                                <h4><?php echo $group->name?></h4>
                            </a>
                        </td>  
                        <td>
                            <a href="<?php echo site_url("{$group->usertype}/profile?id={$group->userid}")?>">
                                <?php echo "{$group->ownername}"?>
                            </a>, 
                        </td> 
                        <td>
                            <div class="btn-group">
                                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="icon-cog"></i> 
                                    <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="<?php echo site_url("access/group?id={$group->groupid}")?>">
                                            View Details
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url("access/group/edit?id={$group->groupid}")?>">
                                            Edit Group
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url("access/group/delete?id={$group->groupid}")?>">
                                            Delete Group
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>                         
                    </tr>
                    <?php }}else {?>
                    <tr>                                                 
                        <td colspan="3"><?php echo sprintf($this->lang->line('no_entries'), 'user groups')?></td>                         
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
    </div>                                
</div>           

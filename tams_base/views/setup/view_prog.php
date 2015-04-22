<div>
    <div class="box box-color box-bordered">
        <div class="box-title">
            <h3>
                <i class="icon-globe"></i>
                Programmes in the University                                        
            </h3>
        </div>
        <div class="box-content  nopadding"> 
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>
                            <button href="#create_prog_modal" data-toggle="modal" class="btn btn-green">
                                <i class="icon-plus"> </i> 
                                Add
                            </button>
                        </th>
                        <th>Actions</th>
                    </tr>                                        
                </thead>
                <tbody>
                    <?php 
                        if($progs['status'] == DEFAULT_SUCCESS) {
                            foreach($progs['rs'] as $p) {
                    ?>
                    <tr>                                                 
                        <td>
                            <a 
                                data-toggle="modal" 
                                href="<?php echo site_url('setup/programme/info/'.url_title("{$p->progname} {$p->progid}", '-', TRUE))?>">
                                <?php echo $p->progname?>
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
                                            href="#edit_prog_modal" 
                                            data-toggle="modal" 
                                            data-id="<?php echo $p->progid?>">Edit</a>
                                    </li>
                                    <li>
                                        <a href="#">Delete</a>
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
                        <td colspan='2'>
                            <?php echo sprintf($this->lang->line('no_entries'), 'programmes')?>
                        </td>                        
                    </tr>
                    
                    <?php } // end of else statement?>
                </tbody>
            </table>
        </div>
    </div>                                
</div>           
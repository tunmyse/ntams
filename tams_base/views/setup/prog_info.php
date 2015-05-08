<div>
    <div class="box span6"><br/>
        <h4> <i class="icon-magic"></i> Stat Dashboard</h4>
        <div class="box-title">                                                        
            <h3>Students</h3>
        </div>
        <div class="box-content">
            <div id="flot-5" class='flot' style="width:270px; height:250px;"></div>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="box"><br/>
        <div class="box-title">
            <h3>
                <i class="icon-magic"></i>
                Extended Information
            </h3>
            <ul class="tabs">
                <li class="active"><a data-toggle="tab" href="#t9">Students</a></li>
            </ul>
        </div>
        <div class="box-content">
            <div class="tab-content">
                <div id="t9" class="tab-pane active">                
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>                                        
                        </thead>
                        <tbody>
                            <?php 
                                if($students['status'] != DEFAULT_EMPTY) {
                                    foreach($students['rs'] as $count => $s) {
                            ?>
                            <tr>
                                <td><?php echo $count+1?></td>
                                <td><?php echo "{$s->fname} {$s->lname}"?></td>
                                <td>
                                    <a 
                                        href="
                                            <?php 
                                                $link = url_title("{$s->fname} {$s->lname} {$s->userid}", '-', TRUE);
                                                echo site_url('student/profile/'.$link)
                                            ?>" 
                                        class="btn">
                                        View
                                    </a>
                                </td>
                            </tr>
                            <?php                                 
                                    }
                                }else {
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php echo sprintf($this->lang->line('no_entries'), 'students')?>
                                </td>
                            </tr>
                            <?php }?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
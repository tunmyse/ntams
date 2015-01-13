<div>
    <ul class="tiles">  
        <?php 
            if(!empty($tiles)) {
                foreach($tiles as $tile) {
        ?>
        <li class="<?php echo $tile['tilecolor']?>" style="background: none repeat scroll 0 0 #<?php echo $tile['tilecolor']?>;">                                                
            <a href="<?php echo site_url($tile['urlprefix'])?>">
                <span>                                                        
                    <i class="<?php echo $tile['tileicon']?>"></i>
                </span>
                <span class="name"><?php echo $tile['dispname']?></span>
            </a>
        </li>
        <?php }}?>
    </ul>
</div>
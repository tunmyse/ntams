<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<?php echo $top_nav; ?>
<div class="container-fluid" id="content" style="height:auto !important;min-height:800px !important;">
    
    <?php echo $left_sidebar; ?>
    
    <div id="main">
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <?php echo $page_content;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo $footer;
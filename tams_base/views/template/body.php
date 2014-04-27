<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Body Template
 * 
 * @category   Views
 * @package    Template
 * @subpackage Body
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
?>
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
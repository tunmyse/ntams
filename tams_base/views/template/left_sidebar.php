<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

/**
 * TAMS
 * Left Sidebar Template
 * 
 * @category   Views
 * @package    Template
 * @subpackage Left Sidebar
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
?>
<div id="left">
    <div class="subnav">
        <div class="subnav-title">
            <span><strong><?php echo $school_name; ?></strong></span>
        </div>
    </div>
    <?php echo $sidemenu_content; ?>
</div>
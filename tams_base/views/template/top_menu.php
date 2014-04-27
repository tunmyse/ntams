<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Top Menu Template
 * 
 * @category   Views
 * @package    Template
 * @subpackage Top Menu
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
?>
<div id="navigation">
    <div class="container-fluid">
        <a href="<?php echo $dashboard_url; ?>" id="brand">TAMS</a>
        <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
        <ul class='main-nav'>
            <?php echo $topmenu_content; ?>
        </ul>
        <div class="user">
            <div class="dropdown">
                <a href="#" class='dropdown-toggle' data-toggle="dropdown">
                    <?php echo $display_name;?> 
                    <img src="<?php echo $display_img;?>" alt="">
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="<?php echo $logout_url; ?>">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

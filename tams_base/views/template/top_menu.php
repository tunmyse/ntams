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
<div id="navigation" class="navbar-fixed-top">
    <div class="container-fluid">
        <a href="#" class="mobile-sidebar-toggle"><i class="icon-th-list"></i></a>
        <a href="<?php echo $dashboard_url; ?>" id="brand">TAMS</a>
        <a href="#" class="toggle-nav" rel="tooltip" data-placement="bottom" title="Toggle navigation"><i class="icon-reorder"></i></a>
        <ul class='main-nav'>
            <?php echo $topmenu_content; ?>
        </ul>
        <div class="user">
            <ul class="icon-nav">
                <li class='dropdown' title="Messages">
                    <a href="#" class='dropdown-toggle' data-toggle="dropdown">
                        <i class="icon-envelope-alt">
                        </i><span class="label label-lightred"><?php echo $message_count; ?></span>
                    </a>
                    <ul class="dropdown-menu pull-right message-ul">
                        <?php {?>
                        <li>						
                            <a href="#">
                                <img src="<?php echo base_url('img/demo/user-1.jpg')?>" alt="">
                                <div class="details">
                                    <div class="name">Mrs Abimbola</div>
                                    <div class="message">
                                            Hello admin ...
                                    </div>
                                </div>
                            </a>
                        </li>
                        <?php }?>

                        <li>
                            <a href="components-messages.html" class='more-messages'>Go to Message center <i class="icon-arrow-right"></i></a>
                        </li>                                    								
                    </ul>
                </li> 

                <li class="dropdown sett" rel="tooltip" data-placement="bottom" title="configuration">     

                </li>
            </ul>
            
            <div class="dropdown pull-right">
                <a href="#" class='dropdown-toggle' data-toggle="dropdown">
                    <img src="<?php echo $display_img;?>" style="height:27px; width:27px" alt=" ">
                    <?php echo $display_name;?> 
                </a>
                <ul class="dropdown-menu pull-right">
                    <li>
                        <a href="<?php echo $profile_url; ?>">My Profile</a>
                    </li>
                    <li>
                        <a href="<?php echo $change_pwd;?>" data-toggle="modal">Change Password</a>
                    </li>
                    <li>
                        <a href="<?php echo $edit_profile;?>" data-toggle="modal">Edit Profile</a>
                    </li>
<!--                    <li>
                        <a href="#">Account settings</a>
                    </li>-->
                    <li>
                        <a href="<?php echo $logout_url; ?>">Sign out</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

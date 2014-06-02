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
<div class="container-fluid" id="content">
    
    <?php echo $left_sidebar; ?>
    
    <div id="main" style="margin-bottom: 50px">
        <div class="container-fluid">
            <div class="page-header">
                <div class="pull-left">                                
                    <input id="logo" type="image" src="/img/logo.jpg" name="logo">
                </div>

                <div class="pull-right">
                    <ul class="stats">
                        <li class="lightred">
                            <i class="icon-calendar"></i>
                            <div class="details">
                                <span class="big">March 13, 2014</span>
                                <span>Thursday, 17:01</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>    

            <div class="breadcrumbs">
                <ul>                                
                    <li>
                        <a href="index.html">Dashboard</a>
                        <i class="icon-angle-right"></i>
                    </li>                              
                </ul>                              
            </div>
            
            <div class="row-fluid">
                
                <div class="span9" ng-controller="PageController">
                    <?php echo $page_content;?>
                </div>
                
                <div class="span3">                                
                    <div class="box">
                        <div class="box-title">
                            <h3>
                                <i class="icon-bullhorn"></i>Feeds                                            
                            </h3>
                            <div class="pull-right">
                                <div class="action">
                                    <a class="btn btn-mini custom-checkbox checkbox-active" href="#">
                                        Automatic refresh
                                        <i class="icon-check"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="box-content nopadding scrollable" data-height="400" data-visible="true">
                            <table id="randomFeed" class="table table-nohead">
                                <tbody>
                                    <tr>
                                        <td><span class="label"><i class="icon-plus"></i></span> <a href="#">Admin</a> added a new H.O.D</td>
                                    </tr>
                                    <tr>
                                        <td><span class="label label-success"><i class="icon-book"></i></span> New courses uploaded</td>
                                                                            </tr>
                                    <tr>
                                        <td><span class="label label-info"><i class="icon-user"></i></span> New Students added</td>
                                    </tr>
                                    <tr>
                                        <td><span class="label label-warning"><i class="icon-comment"></i></span> <a href="#">Mrs Abimbola</a> commented on <a href="#">Cosit News</a></td>
                                    </tr>
                                    <tr>
                                        <td><span class="label label-success"><i class="icon-globe"></i></span> New session created</td>
                                    </tr>
                                    <tr>
                                        <td><span class="label label-info"><i class="icon-book"></i></span> Course allocation updated</td>
                                    </tr>
                                    <tr>
                                        <td><span class="label label-warning"><i class="icon-comment"></i></span> <a href="#">Dean</a> added a <a href="#">new course</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>                                    
                    </div>                               
                </div>
            </div>  
        </div>
    </div>
</div>
<?php echo $footer;
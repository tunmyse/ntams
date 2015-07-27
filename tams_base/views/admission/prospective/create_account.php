<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Admission
 * 
 * @category   Views
 * @package    Admission
 * @subpackage Registration
 * @author     Suleodu Adedayo <suleodu.adedayo@gmail.com>, Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */

//var_dump($perm_group);
//exit();
?>
<!doctype html>
<html ng-app="tams-app">
    <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>TAMS - Prospective </title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="<?php echo site_url(); ?>css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="<?php echo site_url(); ?>css/bootstrap-responsive.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="<?php echo site_url(); ?>css/plugins/icheck/all.css">
        
        <!-- Choosen -->
	<link rel="stylesheet" href="<?php echo site_url(); ?>css/plugins/chosen/chosen.css">
        
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo site_url(); ?>css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo site_url(); ?>css/themes.css">
        
        <!-- jQuery -->
	<script src="<?php echo site_url(); ?>js/jquery.min.js"></script>
        
        <!-- Choosen -->
	<script src="<?php echo site_url(); ?>js/plugins/chosen/chosen.jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="<?php echo site_url(); ?>js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
        
	<!-- Validation -->
	<script src="<?php echo site_url(); ?>js/plugins/validation/jquery.validate.min.js"></script>
	<script src="<?php echo site_url(); ?>js/plugins/validation/additional-methods.min.js"></script>
        
	<!-- icheck -->
	<script src="<?php echo site_url(); ?>js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="<?php echo site_url(); ?>js/bootstrap.min.js"></script>
	<script src="<?php echo site_url(); ?>js/eakroko.js"></script>
        <!--Lodash -->
        <script src="<?php echo site_url(); ?>js/lodash/lodash.min.js"></script>
        <!--Angular -->
        <script src="<?php echo site_url(); ?>js/angular/angular.min.js"></script>
        
        <script lang="text/javascript">
            var admission_details = <?= (is_array($admission))? json_encode($admission): '[]'?>;
            
            var admissionModule = angular.module('tams-app', []);

            admissionModule.controller('PageController', function($scope){

                $scope.data = {
                    "admission_details" : admission_details,
                    "utme":'no'
                };
                $scope.utme = null;
                $scope.adm_type = null;
                $scope.$watch('adm_type', function() {
                    
                   $scope.data.utme = checkUtme($scope.adm_type);
                   
                });
                function checkUtme(id){
                    return _.result(_.find(admission_details, {'typeid' : id}), 'utme');
                }
                
                
            });
        </script>
        

	<!--[if lte IE 9]>
		<script src="<?php echo site_url(); ?>js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
                            $('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="<?php echo site_url(); ?>img/icon.png" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="<?php echo site_url(); ?>img/apple-touch-icon-precomposed.png" />

        <style>
            .wrapper{
                width:500px;
                height:230px;
                position:absolute;
                top:30%;
                left:10%;
                margin: -165px -150px;
                    
            }
            
        </style>
    </head>
    <body class="login" ng-controller="PageController">
        <div class="wrapper" style="top:35%; width:800px;  left:33%; ">
            <h1>
                <a href="#">
                    <img src="<?php echo site_url();?>img/logo@2x.png" 
                         alt="" class='retina-ready' width="59" height="49"/><?php echo strtoupper($school_name['short']) ?>
                </a>
            </h1>
            <div class="login-body span10" style="width:800px; padding-left: 30px; padding-right: 30px">
                <?php if(!empty($admission)) {?>
                <form action="<?php echo site_url('admission/create_account')?>" 
                          method='post' 
                          class='form-validate form-inline form-column' 
                          >
                    
                    <div class="row row-fluid">
                        <div class="span6">
                       <h4 style=" text-align: center">
                            <i class="icon-bullhorn"></i> INSTRUCTIONS
                        </h4>
                        
                            <div class="text-info alert alert-success" style=" font-size: 14px">
                            <ul>
                                <li>
                                    You are required to supply correct and valued information 
                                    as incorrect information will affect the success of your application
                                </li><br/>
                                <li>After submitting your initial application an email will be sent to you</li><br/>
                                <li>Follow the link in your email to complete the application process</li><br/>
                                <li>
                                    If you have already filled the <?php echo $admission[0]['displayname']?> 
                                    application form before, click here to check 
                                    the status of your application
                                </li><br/>
                            </ul>
                        </div>
                        <div class="submit pull-left">
                            <a href="<?php echo site_url('login?rdr=admission/status')?>" class="btn btn-primary" >
                                Login to your Application
                            </a>                                               
                        </div>
                        <div class="submit pull-right">
                            <a href="#" style=" color: red">
                                Helpdesk Support
                            </a>                                               
                        </div>
                        <p>&nbsp;</p>
                    </div>
                        <div class="span6" style=" padding-left: 50px; padding-right: 10px">
                            <h4 style=" text-align: center">
                              <?= $admission[0]['sesname']." <br/>".$admission[0]['displayname']?> 
                        </h4>
                            <?php
                            if($msg)
                                echo $msg;
                            ?>
                        <div class="control-group">
                            <div class="controls">
                                <select id="admutme" name="admtype" class="input-block-level chosen-select" ng-model="adm_type" required="true">
                                    <option value=""> -- Choose Admission -- </option>
                                    <?php foreach($admission As $adm):?>
                                    <option  value="<?php echo $adm['typeid']?>"><?php echo $adm['displayname'].' '.$adm['type']?> </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group" ng-if="data.utme == 'yes'" >
                            <div class="controls">
                                <input type="text" 
                                       name="jambregid" 
                                       placeholder="Enter JAMB Reg. No." 
                                       class='input-block-level' 
                                       data-rule-required="true" 
                                       value="<?php echo set_value('jambregid'); ?>"/>
                            </div>
                        </div>
                            
                        <div class="control-group">
                            <div class="controls">
                                <input type="text" 
                                       name='lname' 
                                       placeholder="Enter your Surname" 
                                       class='input-block-level' 
                                       data-rule-required="true" 
                                       value="<?php echo set_value('lname'); ?>"/>
                            </div>
                        </div>                        

                        <div class="control-group">
                            <div class="controls">
                                <input type="text" 
                                       name="fname" 
                                       placeholder="Enter your First Name" 
                                       class='input-block-level' 
                                       data-rule-required="true" 
                                       value="<?php echo set_value('fname'); ?>"/>
                            </div>
                        </div> 

                        <div class="control-group">
                            <div class="controls">
                                <input type="text" 
                                       name="mname" 
                                       placeholder="Enter your Middle Name" 
                                       class='input-block-level' 
                                       data-rule-required="true" 
                                       value="<?php echo set_value('mname'); ?>"/>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <div class="controls">
                                <input type="text" 
                                       name="phone" 
                                       placeholder="Enter your Phone No" 
                                       class='input-block-level' 
                                       data-rule-required="true" 
                                       value="<?php echo set_value('phone'); ?>"/>
                            </div>
                        </div> 
                        <div class="control-group">
                            <div class="email controls">
                                <input type="text" 
                                       name="email" 
                                       placeholder="Enter your valid Email" 
                                       class='input-block-level' 
                                       data-rule-required="true" 
                                       value="<?php echo set_value('email'); ?>"/>
                            </div>
                        </div> 
                        <div class="control-group">
                            <div class="controls">
                                <select id="prog1" name="prog1" class="input-block-level chosen-select" required="true">
                                    <option value=""> -- Choose Programme Choice -- </option>
                                    <?php foreach($programmes As $prog):?>
                                    <option  value="<?php echo $prog['progid']?>"><?php echo $prog['progname']?> </option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="pw controls">
                                <input type="password" 
                                       name="password" 
                                       placeholder="Enter your Password" 
                                       class='input-block-level' 
                                       data-rule-required="true"/>
                            </div>
                        </div> 
                        <div class="control-group">
                            <div class="pw controls">
                                <input type="password" 
                                       name="passconf" 
                                       placeholder="Confirm Password" 
                                       class='input-block-level' 
                                       data-rule-required="true"/>
                            </div>
                        </div> 
                        <input type="hidden" name="group_perm" value="{{data['admission_details']['0']['group_perm']}}">
                        <div class="submit">
                            <input type="submit" value="Create an Account" class='btn btn-primary'/>                      
                        </div>
                    </div>
                    </div>
                    
                    
                </form>
                  
                <?php }else {?>
                <div class="well well-large">
                    Application cannot take place at the moment, please check back at a later date!
                </div>
                <?php }?>
            </div>
        </div>
    </body>
</html>


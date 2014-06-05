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

?>
<!doctype html>
<html>
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
	<!-- Theme CSS -->
	<link rel="stylesheet" href="<?php echo site_url(); ?>css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="<?php echo site_url(); ?>css/themes.css">
        
        <!-- jQuery -->
	<script src="<?php echo site_url(); ?>js/jquery.min.js"></script>
	
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

    </head>

   <body class='login'>
       <div class="wrapper" style="margin-left: -435px">
            <h1>
                <a href="#">
                    <img src="<?php echo site_url();?>img/logo2.png" 
                         alt="" class='retina-ready' width="59" height="49"/>TASUED
                </a>
            </h1>
           
            <div class="login-body span9"> 
                <?php if(isset($session['id']) && $session['id'] != '') {?>
                <div class="span3">                  
                    <h3>
                        <i class="icon-bullhorn"></i>
                        INSTRUCTIONS
                    </h3>
                    <br/>
                    <div class="text-info">
                        <ul>
                            <li>
                                You are required to supply correct and valued information 
                                as incorrect information will affect the success of your application
                            </li><br/>
                            <li>After submitting your initial application an email will be sent to you</li><br/>
                            <li>Follow the link in your email to complete the application process</li><br/>
                            <li>
                                If you have already filled the <?php echo $session['name']?> 
                                application form before, click here to check 
                                the status of your application
                            </li><br/>
                        </ul>
                    </div>  <br/><br/><br/>
                    <div class="submit pull-left">
                        <a href="<?php echo site_url('login?rdr=apply')?>" class="btn btn-primary" >
                            Check App. Status
                        </a>                                               
                    </div>
                </div>
                
                <div class="span5">                    
                    <p></p>                 
                    <form action="<?php echo site_url('admission/application/create_account')?>" 
                          method='post' 
                          class='form-validate' 
                          id="login">
                        <h3>
                            <i class="icon-edit"></i><?php echo " ".$session['name']?> APPLICATION FORM
                        </h3>
                        <br/>
                        <div class="text-info"><?php echo validation_errors()?></div>
                        <div class="control-group">
                            <div class="controls">
                                <input type="text" 
                                       name='lname' 
                                       placeholder="Enter your Surnname" 
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
                                       name="confPassword" 
                                       placeholder="Confirm Password" 
                                       class='input-block-level' 
                                       data-rule-required="true"/>
                            </div>
                        </div> 

                        <div class="submit">
                            <input type="submit" value="Submit Application" class='btn btn-primary'/>                      
                        </div>
                        <br/><br/>
                    </form>  
                </div> 
                <?php }else {?>
                <div class="well-large">
                    Application cannot take place at the moment, please check back at a later date!
                </div>
                <?php }?>
            </div>
           
             <div class="forget">
                 <a href="#">Powered by TAMS.<img src="<?php echo site_url(); ?>img/powered.png" alt=""></a>                                                                  
             </div>  
	</div>	
    </body>

</html>

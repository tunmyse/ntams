<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Reset password view
 * 
 * @category   Views
 * @package    User
 * @subpackage Reset password
 * @author     Bada Gabriel <gabbibada@gmail.com>
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
	
	<title>TAMS - Change Password</title>

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
	<div class="wrapper">
            <h1>
                <a href="<?php echo site_url()?>">
                    <img src="<?php echo site_url(); ?>img/logo2.png" alt="" class='retina-ready' width="59" height="49">TASUED
                </a>
            </h1>
            <div class="login-body" style="padding-top: 20px">
                <p class="small text-<?php echo $msg_type;?>" style="padding: 0 30px"><?php echo $msg?></p>
                <h2> </h2>
                <?php if(!$collapse) {?>
                <form action="<?php echo site_url('reset_password')?>" method='post' class='form-validate' id="reset_password">
                    <div class="control-group">
                        <div class="pw controls">
                            <input type="password" name="upw" placeholder="Enter new password" class='input-block-level' data-rule-required="true">
                        </div>
                    </div> 
                    <div class="control-group">
                        <div class="pw controls">
                            <input type="password" name="cpw" placeholder="Confirm new password" class='input-block-level' data-rule-required="true" >
                        </div>
                    </div>                                                              
                    <div class="submit pull-left">
                        <input type="submit" value="Change Password" class='btn btn-primary'>                                        

                    </div>
                    <br/><br/>                                                                
                </form>
                <?php }?>
                <div class="forget">
                    <a href="#">Powered by TAMS.<img src="<?php echo site_url(); ?>img/powered.png" alt=""></a>                                                                  
                </div>                                          
            </div>
	</div>	
    </body>

</html>

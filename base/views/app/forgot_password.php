<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Forgot password view
 * 
 * @category   Views
 * @package    User
 * @subpackage Forgot password
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
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
	
	<title>TAMS - Forgot password</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">


	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/eakroko.js"></script>

	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/icon.png" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

    </head>

    <body class='login'>
	<div class="wrapper">
            <h1><a href="<?php echo site_url()?>"><img src="img/logo2.png" alt="" class='retina-ready' width="59" height="49">TASUED</a></h1>
            <div class="login-body" style="padding-top: 20px">
                <p class="small text-<?php echo $msg_type;?>" style="padding: 0 30px"><?php echo $msg?></p>
                <h2>FORGOT PASSWORD</h2>
                <form action="<?php echo site_url("forgot_password"); ?>" method='POST' class='form-validate' id="forgot_password">
                    
                    <div class="control-group">
                        <div class="email controls">
                            <input type="text" name='uname' placeholder="Enter Your Username" class='input-block-level' data-rule-required="true">
                        </div>
                    </div>
                    <div class="submit">
                        <input type="submit" value="Request Password Reset" class='btn btn-primary'>
                    </div>
                </form>
                <div class="forget">
                    <a>Powered by TAMS.<img src="img/powered.png" alt=""></a>  
                </div>
            </div>
	</div>
    </body>
</html>

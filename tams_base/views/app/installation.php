<!doctype html>
<html>
    <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
            <!-- Apple devices fullscreen -->
            <meta name="apple-mobile-web-app-capable" content="yes" />
            <!-- Apple devices fullscreen -->
            <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

            <title>TAMS - Installation</title>

            <!-- Bootstrap -->
            <link rel="stylesheet" href="<?php echo base_url('../css/bootstrap.min.css')?>">
            <!-- Bootstrap responsive -->
            <link href="<?php echo base_url('../css/docs.css')?>" rel="stylesheet">
            <link rel="stylesheet" href="<?php echo base_url('../css/bootstrap-responsive.min.css')?>">
            
            <!-- Theme CSS -->
            <link rel="stylesheet" href="<?php echo base_url('../css/style.css')?>">


            <!-- jQuery -->
            <script src="<?php echo base_url('../js/jquery.min.js')?>"></script>

            <!-- Bootstrap -->
            <script src="<?php echo base_url('../js/bootstrap.min.js')?>"></script>
            
            <!-- Theme framework -->
            <script src="<?php echo base_url('../js/eakroko.min.js')?>"></script>
            <!-- Theme scripts -->
            <script src="<?php echo base_url('../js/application.min.js')?>"></script>

            <!--[if lte IE 9]>
                    <script src="<?php echo base_url('../js/plugins/placeholder/jquery.placeholder.min.js')?>"></script>
                    <script>
                            $(document).ready(function() {
                                    $('input, textarea').placeholder();
                            });
                    </script>
            <![endif]-->

            <!-- Favicon -->
            <link rel="shortcut icon" href="<?php echo base_url('../img/icon.ico')?>" />
            <!-- Apple devices Homescreen icon -->
            <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('../img/apple-touch-icon-precomposed.png')?>" />

    </head>
    <body>
        <div class="navbar navbar-inverse navbar-fixed-top">
              <div class="navbar-inner">
                <div class="container">
                  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                    <a class="brand" href="installation.html">TAMS</a>
                  <div class="nav-collapse collapse">
                    <ul class="nav">                      
                      <li class="">
                        <a href="#">Installation guide</a>
                      </li> 
                      <li class="">
                        <a href="#">About Tams</a>
                      </li>
                      <li class="">
                        <a href="#">Tams.org</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
        </div>
        <div class="jumbotron masthead">
            <div class="container">
                <h1>TAMS</h1>
                <p>University administration brought down to its simplest form, <em>garnished</em> with a sleek and powerful interface .</p>
                <p>
                    <a href="<?php echo site_url('installation/steps')?>" class="btn btn-primary btn-large"> Install Tams </a>
                </p>
                <ul class="masthead-links">
                    <li>
                      <a><img src="<?php echo base_url('../img/logo@2x.png')?>" alt="" class='retina-ready' width="39" height="29"></a>
                    </li><br/><br/>
                    <li>
                    <a>Tertiary academic management system</a>
                  </li>                 
                </ul>
            </div>
        </div>    
         <div class="navbar navbar-inverse navbar-fixed-bottom">
              <div class="navbar-inner">
                <div class="container">
                  <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="brand">tams @ 2014</a>
                </div>
              </div>
        </div>
    </body>
</html>
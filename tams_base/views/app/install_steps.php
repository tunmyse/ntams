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
            <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css')?>">
            <!-- Bootstrap responsive -->
            <link href="<?php echo base_url('css/docs.css')?>" rel="stylesheet">
            <link rel="stylesheet" href="<?php echo base_url('css/bootstrap-responsive.min.css')?>">
            <!-- jQuery UI -->
            <link rel="stylesheet" href="<?php echo base_url('css/plugins/jquery-ui/smoothness/jquery-ui.css')?>">
            <link rel="stylesheet" href="<?php echo base_url('css/plugins/jquery-ui/smoothness/jquery.ui.theme.css')?>">      
            <!-- Theme CSS -->
            <link rel="stylesheet" href="<?php echo base_url('css/style.css')?>">       
            <!-- jQuery -->
            <script src="<?php echo base_url('js/jquery.min.js')?>"></script>


            <!-- Nice Scroll -->
            <script src="<?php echo base_url('js/plugins/nicescroll/jquery.nicescroll.min.js')?>"></script>
            <!-- jQuery UI -->
            <script src="<?php echo base_url('js/plugins/jquery-ui/jquery.ui.core.min.js')?>"></script>
            <script src="<?php echo base_url('js/plugins/jquery-ui/jquery.ui.widget.min.js')?>"></script>
            <script src="<?php echo base_url('js/plugins/jquery-ui/jquery.ui.mouse.min.js')?>"></script>
            <script src="<?php echo base_url('js/plugins/jquery-ui/jquery.ui.draggable.min.js')?>"></script>
            <script src="<?php echo base_url('js/plugins/jquery-ui/jquery.ui.resizable.min.js')?>"></script>
            <script src="<?php echo base_url('js/plugins/jquery-ui/jquery.ui.sortable.min.js')?>"></script>
            <!-- Touch enable for jquery UI -->
            <script src="<?php echo base_url('js/plugins/touch-punch/jquery.touch-punch.min.js')?>"></script>
            <!-- slimScroll -->
            <script src="<?php echo base_url('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
            <!-- Bootstrap -->
            <script src="<?php echo base_url('js/bootstrap.min.js')?>"></script>
 
            <script src="<?php echo base_url('js/plugins/imagesLoaded/jquery.imagesloaded.min.js')?>"></script>
       
            <!-- Validation -->
            <script src="<?php echo base_url('js/plugins/validation/jquery.validate.min.js')?>"></script>
            <script src="<?php echo base_url('js/plugins/validation/additional-methods.min.js')?>"></script>
            <!-- Wizard -->
            <script src="<?php echo base_url('js/plugins/wizard/jquery.form.wizard.min.js')?>"></script>
    
            <!-- Theme framework -->
            <script src="<?php echo base_url('js/eakroko.min.js')?>"></script>
            <!-- Theme scripts -->
            <script src="<?php echo base_url('js/application.min.js')?>"></script>
            <!-- Just for demonstration -->
            <script src="<?php echo base_url('js/demonstration.min.js')?>"></script>

            <!--[if lte IE 9]>
                    <script src="<?php echo base_url('js/plugins/placeholder/jquery.placeholder.min.js')?>"></script>
                    <script>
                            $(document).ready(function() {
                                    $('input, textarea').placeholder();
                            });
                    </script>
            <![endif]-->

            <!-- Favicon -->
            <link rel="shortcut icon" href="<?php echo base_url('img/icon.ico')?>" />
            <!-- Apple devices Homescreen icon -->
            <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('img/apple-touch-icon-precomposed.png')?>" />

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
        <div class="row-fluid">
            <div class="span12">
                <?php
                    if($error != '') {
                ?>
                <div class="alert alert-error"><?php echo $error?></div>
                <?php }?>
                <div class="box">
                     <div class="box-title">
                        <h3>
                            <a><img src="<?php echo base_url('img/logo@2x.png')?>" alt="" class='retina-ready' width="29" height="19"></a>
                            Installation wizard
                        </h3>
                    </div>
                    <div class="box-content">       
                        <form action="<?php echo site_url('tams_installation/verify_steps')?>" method="POST" class='form-horizontal form-wizard' id="setup_form">
                            <div class="step" id="firstStep">
                                 <ul class="wizard-steps steps-4">
                                    <li class='active'>
                                        <div class="single-step">
                                                <span class="title">
                                                        1</span>
                                                <span class="circle">
                                                        <span class="active"></span>
                                                </span>
                                                <span class="description">
                                                        Create Admin Account
                                                </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-step">
                                                <span class="title">
                                                        2</span>
                                                <span class="circle">
                                                </span>
                                                <span class="description">
                                                        Set-Up School
                                                </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-step">
                                                <span class="title">
                                                        3</span>
                                                <span class="circle">
                                                </span>
                                                <span class="description">
                                                        Set-Up Database
                                                </span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="single-step">
                                                <span class="title">
                                                        4</span>
                                                <span class="circle">
                                                </span>
                                                <span class="description">
                                                        Finish Installation
                                                </span>
                                        </div>
                                    </li>
                                 </ul>
                                <div class="step-forms">
                                    <div class="control-group">
                                        <label for="acct[fname]" class="control-label">First name</label>
                                        <div class="controls">
                                            <input type="text" name="acct[fname]" id="firstname" class="input-xlarge" data-rule-required="true">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="acct[lname]" class="control-label">Last name</label>
                                        <div class="controls">
                                            <input type="text" name="acct[lname]" id="lastname" class="input-xlarge" data-rule-required="true">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="acct[email]" class="control-label">Email </label>
                                        <div class="controls">
                                              <input type="email" name="acct[email]" id="email" class="input-xlarge" data-rule-required="true">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="acct[password]" class="control-label">Password</label>
                                        <div class="controls">
                                            <input type="password" name="acct[password]" id="upwfield" class="input-xlarge" data-rule-required="true">
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label for="acct[cpassword]" class="control-label">Confirm password</label>
                                        <div class="controls">
                                            <input type="password" name="acct[cpassword]" id="cpwfield" class="input-xlarge" data-rule-equalTo="#upwfield" data-rule-required="true">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="step" id="secondStep">
                                <ul class="wizard-steps steps-4">
                                        <li>
                                                <div class="single-step">
                                                        <span class="title">
                                                                1</span>
                                                        <span class="circle">

                                                        </span>
                                                        <span class="description">
                                                                Create Admin Account
                                                        </span>
                                                </div>
                                        </li>
                                        <li class='active'>
                                                <div class="single-step">
                                                        <span class="title">
                                                                2</span>
                                                        <span class="circle">
                                                                <span class="active"></span>
                                                        </span>
                                                        <span class="description">
                                                                Set-Up School
                                                        </span>
                                                </div>
                                        </li>
                                        <li>
                                                <div class="single-step">
                                                        <span class="title">
                                                                3</span>
                                                        <span class="circle">
                                                        </span>
                                                        <span class="description">
                                                                Set-Up Database
                                                        </span>
                                                </div>
                                        </li>
                                        <li>
                                                <div class="single-step">
                                                        <span class="title">
                                                                4</span>
                                                        <span class="circle">
                                                        </span>
                                                        <span class="description">
                                                                Finish Installation
                                                        </span>
                                                </div>
                                        </li>
                                </ul>
                                <div class="control-group">
                                    <label for="sch[name]" class="control-label">School name</label>
                                    <div class="controls">
                                        <input type="text" name="sch[name]" id="schname" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="sch[phone]" class="control-label">Phone</label>
                                    <div class="controls">
                                        <input type="number" name="sch[phone]" id="sclphn" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="sch[email]" class="control-label">Email</label>
                                    <div class="controls">
                                        <input type="email" name="sch[email]" id="email2" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="sch[unitname]" class="control-label">Unit Name</label>
                                    <div class="controls">
                                        <input type="text" name="sch[unitname]" id="schname" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="sch[shortname]" class="control-label">Short Name</label>
                                    <div class="controls">
                                        <input type="text" name="sch[shortname]" id="schname" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="step" id="thirdStep">
                                <ul class="wizard-steps steps-4">
                                    <li>
                                            <div class="single-step">
                                                    <span class="title">
                                                            1</span>
                                                    <span class="circle">

                                                    </span>
                                                    <span class="description">
                                                            Create Admin Account
                                                    </span>
                                            </div>
                                    </li>
                                    <li>
                                            <div class="single-step">
                                                    <span class="title">
                                                            2</span>
                                                    <span class="circle">

                                                    </span>
                                                    <span class="description">
                                                            Set-Up School
                                                    </span>
                                            </div>
                                    </li>
                                    <li class='active'>
                                            <div class="single-step">
                                                    <span class="title">
                                                            3</span>
                                                    <span class="circle">
                                                            <span class="active"></span>
                                                    </span>
                                                    <span class="description">
                                                            Set-Up Database
                                                    </span>
                                            </div>
                                    </li>
                                    <li>
                                        <div class="single-step">
                                            <span class="title">
                                                    4</span>
                                            <span class="circle">
                                            </span>
                                            <span class="description">
                                                    Finish Installation
                                            </span>
                                        </div>
                                    </li>
                                </ul>
                                <div class="control-group">
                                    <label for="db[server]" class="control-label">Server</label>
                                    <div class="controls">
                                        <input type="text" name="db[server]" id="dbname" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="db[database]" class="control-label">Database Name</label>
                                    <div class="controls">
                                        <input type="text" name="db[database]" id="database" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="db[username]" class="control-label">Username</label>
                                    <div class="controls">
                                        <input type="text" name="db[username]" id="dbname" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="db[password]" class="control-label">Password</label>
                                    <div class="controls">
                                    <input type="text" name="db[password]" id="pwfield" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label for="db[driver]" class="control-label">Driver name</label>
                                    <div class="controls">
                                        <input type="text" name="db[driver]" id="drivere" class="input-xlarge" data-rule-required="true">
                                    </div>
                                </div>
                            </div>
                            <div class="step" id="fourthstep">
                                    <ul class="wizard-steps steps-4">
                                            <li>
                                                    <div class="single-step">
                                                            <span class="title">
                                                                    1</span>
                                                            <span class="circle">

                                                            </span>
                                                            <span class="description">
                                                                    Create Admin Account
                                                            </span>
                                                    </div>
                                            </li>
                                            <li>
                                                    <div class="single-step">
                                                            <span class="title">
                                                                    2</span>
                                                            <span class="circle">

                                                            </span>
                                                            <span class="description">
                                                                    Set-Up School
                                                            </span>
                                                    </div>
                                            </li>
                                            <li>
                                                    <div class="single-step">
                                                            <span class="title">
                                                                    3</span>
                                                            <span class="circle">
                                                            </span>
                                                            <span class="description">
                                                                    Set-Up Database
                                                            </span>
                                                    </div>
                                            </li>
                                            <li class='active'>
                                                    <div class="single-step">
                                                            <span class="title">
                                                                    4</span>
                                                            <span class="circle">
                                                                    <span class="active"></span>
                                                            </span>
                                                            <span class="description">
                                                                    Finish Installation
                                                            </span>
                                                    </div>
                                            </li>
                                    </ul>
                                    <div class="control-group">
                                        <label for="text" class="control-label">Finish Installation</label>
                                        <div class="controls">
                                            <label class="checkbox"><input type="checkbox" name="policy" value="agree" data-rule-required="true"> Everything is ok. Submit</label>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-actions">
                                <input type="reset" class="btn" value="Back" id="back">
                                <input type="submit" class="btn btn-primary" value="Submit" id="next">
                            </div>
                        </form>
                    </div>
                </div>
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
        <script type="text/javascript">
            $('#setup_form').form-wizard();
        </script>
    </body>
</html>
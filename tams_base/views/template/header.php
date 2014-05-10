<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * TAMS
 * Header Template
 * 
 * @category   Views
 * @package    Template
 * @subpackage Header
 * @author     Akinsola Tunmise <akinsolatunmise@gmail.com>
 * @copyright  Copyright © 2014 TAMS.
 * @version    1.0.0
 * @since      File available since Release 1.0.0
 */
?>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<!-- Apple devices fullscreen -->
<meta name="apple-mobile-web-app-capable" content="yes" />
<!-- Apple devices fullscreen -->
<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />

<title><?php echo $page_title; ?></title>

<link rel="stylesheet" href="<?php echo base_url('css/bootstrap.min.css')?>">
<!-- Bootstrap responsive -->
<link rel="stylesheet" href="<?php echo base_url('css/bootstrap-responsive.min.css')?>">
<!-- jQuery UI -->
<link rel="stylesheet" href="<?php echo base_url('css/plugins/jquery-ui/smoothness/jquery-ui.css')?>">
<link rel="stylesheet" href="<?php echo base_url('css/plugins/jquery-ui/smoothness/jquery.ui.theme.css')?>">
<!-- PageGuide -->
<link rel="stylesheet" href="<?php echo base_url('css/plugins/pageguide/pageguide.css')?>">
<link rel="stylesheet" href="<?php echo base_url('css/plugins/datepicker/datepicker.css')?>">
<!-- chosen -->
<link rel="stylesheet" href="<?php echo base_url('css/plugins/chosen/chosen.css')?>">
<!-- select2 -->
<link rel="stylesheet" href="<?php echo base_url('css/plugins/select2/select2.css')?>">
<!-- icheck -->
<link rel="stylesheet" href="<?php echo base_url('css/plugins/icheck/all.css')?>">
<!-- Theme CSS -->
<link rel="stylesheet" href="<?php echo base_url('css/style.css')?>">
<!-- Color CSS -->
<link rel="stylesheet" href="<?php echo base_url('css/themes.css')?>">
<!-- TalenBase CSS -->
<link rel="stylesheet" href="<?php echo base_url('css/tams.css')?>">

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
<script src="<?php echo base_url('js/plugins/jquery-ui/jquery.ui.spinner.js')?>"></script>
<!-- Touch enable for jquery UI -->
<script src="<?php echo base_url('js/plugins/touch-punch/jquery.touch-punch.min.js')?>"></script>
<!-- slimScroll -->
<script src="<?php echo base_url('js/plugins/slimscroll/jquery.slimscroll.min.js')?>"></script>
<!-- Bootstrap -->
<script src="<?php echo base_url('js/bootstrap.min.js')?>"></script>

<!-- Bootbox -->
<script src="<?php echo base_url('js/plugins/bootbox/jquery.bootbox.js')?>"></script>

<!-- imagesLoaded -->
<script src="<?php echo base_url('js/plugins/imagesLoaded/jquery.imagesloaded.min.js')?>"></script>

<!-- DatePicker -->
<script src="<?php echo base_url('js/plugins/datepicker/bootstrap-datepicker.js')?>"></script>

<!-- Chosen -->
<script src="<?php echo base_url('js/plugins/chosen/chosen.jquery.min.js')?>"></script>
<!-- dataTables -->
<script src="<?php echo base_url('js/plugins/datatable/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('js/plugins/datatable/TableTools.min.js')?>"></script>
<script src="<?php echo base_url('js/plugins/datatable/ColReorder.min.js')?>"></script>
<script src="<?php echo base_url('js/plugins/datatable/ColVis.min.js')?>"></script>
<script src="<?php echo base_url('js/plugins/datatable/jquery.dataTables.columnFilter.js')?>"></script>
<!-- select2 -->
<script src="<?php echo base_url('js/plugins/select2/select2.min.js')?>"></script>

<!-- Theme framework -->
<script src="<?php echo base_url('js/eakroko.js')?>"></script>

<!-- JQuery Validation Plugin -->
<script src="<?php echo base_url('js/jquery.validate.js')?>"></script>
<script src="<?php echo base_url('js/jquery.form.js')?>"></script>

<!--[if lte IE 9]>
        <script src="<?php echo base_url('js/plugins/placeholder/jquery.placeholder.min.js')?>"></script>
        <script>
                $(document).ready(function() {
                        $('input, textarea').placeholder();
                });
        </script>
<![endif]-->

<!-- Angularjs -->

<!-- Theme scripts -->
<script src="<?php echo base_url('js/application.min.js')?>"></script>

<!-- File upload -->
<script src="<?php echo base_url('js/plugins/fileupload/bootstrap-fileupload.min.js')?>"></script>

<!-- Favicon -->
<link rel="shortcut icon" href="<?php echo base_url('img/icon.png')?>" />
<!-- Apple devices Homescreen icon -->
<link rel="apple-touch-icon-precomposed" href="<?php echo base_url('img/apple-touch-icon-precomposed.png')?>" />

<?php //echo $includes;
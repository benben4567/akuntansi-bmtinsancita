<?php
/*
 * Aplikasi AKSIOMA (Aplikasi Keuangan Mikro Masyarakat Ekonomi Syariah) ver. 1.0
 * Copyright (c) 2014
 *
 * file   : pegadaian.php
 * author : Edi Suwoto S.Komp
 * email  : edi.suwoto@gmail.com
 */
/*----------------------------------------------------------*/
?>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>AKSIOMA</title>
    <link rel="icon" href="<?= base_url()?>assets/images/favicon.jpg" type="image/jpg" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<link href="<?= base_url()?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?= base_url()?>assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="<?= base_url()?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="<?= base_url()?>assets/css/style.css" rel="stylesheet" />
	<link href="<?= base_url()?>assets/css/style-responsive.css" rel="stylesheet" />
	<link href="<?= base_url()?>assets/css/themes/default.css" rel="stylesheet" id="style_color" />
	<link href="<?= base_url()?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url()?>assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" rel="stylesheet" type="text/css" />
	<link href="<?= base_url()?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url()?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
	<link href="<?= base_url()?>assets/plugins/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" type="text/css"  />
	<link href="<?= base_url()?>assets/plugins/jqvmap/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />
    
    <script src="<?= base_url()?>assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>	
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->	
	<script src="<?= base_url()?>assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>		
	<script src="<?= base_url()?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<script src="<?= base_url()?>assets/plugins/excanvas.js"></script>
	<script src="<?= base_url()?>assets/plugins/respond.js"></script>	
	<![endif]-->	
	<script src="<?= base_url()?>assets/plugins/breakpoints/breakpoints.js" type="text/javascript"></script>	
	<script src="<?= base_url()?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?= base_url()?>assets/plugins/jquery.blockui.js" type="text/javascript"></script>	
	<script src="<?= base_url()?>assets/plugins/jquery.cookie.js" type="text/javascript"></script>
	<script src="<?= base_url()?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>	
	<script src="<?= base_url()?>assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="<?= base_url()?>assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="<?= base_url()?>assets/plugins/jquery.peity.min.js" type="text/javascript"></script>	
	<script src="<?= base_url()?>assets/plugins/jquery-knob/js/jquery.knob.js" type="text/javascript"></script>	
    <script type="text/javascript" src="<?= base_url()?>assets/js/jq/jquery.jclock.js"></script>
    <script type="text/javascript" src="<?= base_url()?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>   
   
    <script src="<?= base_url()?>assets/scripts/app.js" type="text/javascript"></script>
	<script src="<?= base_url()?>assets/scripts/form-components.js"></script> 
	<script>
		jQuery(document).ready(function() {		
			App.init(); // initlayout and core plugins
			FormComponents.init();
		});
	</script>
    <?php $this -> load -> view( 'header' );?>
    <link type="text/css" href="assets/css/welcome.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/js/welcome.js"></script>
    <!-- <script type="text/javascript" src="assets/js/menu.js"></script> -->
</head>
<body class="fixed-top">
    <div id="header" class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="."><img src="assets/img/logoc.png" alt="MES"/></a>
				<a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="arrow"></span>
				</a>          			
				<div class="top-nav">
					<span class="jclock"></span>				
					<ul class="nav pull-right" id="top_menu">
						<li class="divider-vertical hidden-phone hidden-tablet"></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user"></i>
							<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="profile" class="logut"><i class="icon-user"></i> Profile</a></li>
								<li><a href="auth/logout" class="logut"><i class="icon-key"></i> Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div id="container" class="row-fluid">
		<div id="sidebar" class="nav-collapse collapse">
			<div class="sidebar-toggler hidden-phone"></div>
            <?php //$this -> load -> view( 'menu' );?>
            <?php foreach($menunya as $item) {echo $item;}?>
		</div>
		<div id="body">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">		
						<h3 class="page-title">
							Dashboard
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href=".">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Dashboard</a></li>
							
						</ul>
					</div>
				</div>
				<div id="page" class="dashboard">
					<div class="row-fluid">
						<div class="span6">
							<div class="widget-title">
                                <h4><i class="icon-reorder"></i>Login Terakhir</h4>
                            </div>
                            <br>
                            <div id="table_session">
                                <?php
                                $datases['tabel_head'][] = array("","3%","No");
                                $datases['tabel_head'][] = array("","20%","User");
                                $datases['tabel_head'][] = array("nama","25%","Nama Komputer");
                                $datases['tabel_head'][] = array("nama","25%","Waktu");
                                $this -> load -> view( 'table_layout',$datases);
                                $this -> load -> view( 'filter_layout',$datases );
                                ?>
                            </div>
						</div>
					</div>
				</div>
			</div>	
		</div>
	</div>
	<div id="footer">
		<p align="center">copyright &copy; <?=date('Y');?> APLIKASI KSP SYARIAH</p>
		
	</div>
	
</body>
<!-- END BODY -->
</html>

<?php
/*
 * Aplikasi AKSIOMA (Aplikasi Keuangan Mikro Masyarakat Ekonomi Syariah) ver. 1.0
 * Copyright (c) 2014
 *
 * file   : tool/hitungbasil.php
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
				<title>BMT</title>
				<link rel="icon" href="../assets/images/favicon.jpg" type="image/jpg" />
				<meta content="width=device-width, initial-scale=1.0" name="viewport" />
				<link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
				<link href="../assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
				<link href="../assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
				<link href="../assets/css/style.css" rel="stylesheet" />
				<link href="../assets/css/style-responsive.css" rel="stylesheet" />
				<link href="../assets/css/themes/default.css" rel="stylesheet" id="style_color" />
				<link href="../assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
				<link href="../assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" rel="stylesheet" type="text/css" />
				<link href="../assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css" />
				<link href="../assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
				<link href="../assets/plugins/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" type="text/css"  />
				<link href="../assets/plugins/jqvmap/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />

				<link rel="stylesheet" type="text/css" href="../assets/plugins/chosen-bootstrap/chosen/chosen.css" />

				<script src="../assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>	
				<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->	
				<script src="../assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>		
				<script src="../assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<script src="../assets/plugins/excanvas.js"></script>
	<script src="../assets/plugins/respond.js"></script>	
<![endif]-->	
	<script src="../assets/plugins/breakpoints/breakpoints.js" type="text/javascript"></script>	
	<script src="../assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery.blockui.js" type="text/javascript"></script>	
	<script src="../assets/plugins/jquery.cookie.js" type="text/javascript"></script>
	<script src="../assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>	
	<script src="../assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="../assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="../assets/plugins/jquery.peity.min.js" type="text/javascript"></script>	
	<script src="../assets/plugins/jquery-knob/js/jquery.knob.js" type="text/javascript"></script>	
	<script type="text/javascript" src="../assets/js/jq/jquery.jclock.js"></script>

	<script type="text/javascript" src="../assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="../assets/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="../assets/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
	<script type="text/javascript" src="../assets/plugins/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
	<script type="text/javascript" src="../assets/plugins/clockface/js/clockface.js"></script>
	<script type="text/javascript" src="../assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>   
	<script type="text/javascript" src="../assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>

	<script type="text/javascript" src="../assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
	<script type="text/javascript" src="../assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
	<script type="text/javascript" src="../assets/plugins/jquery.pulsate.min.js"></script>
	<script type="text/javascript" src="../assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>

	<script src="../assets/scripts/app.js" type="text/javascript"></script>
	<script src="../assets/scripts/form-components.js"></script>     
	<script src="../assets/scripts/form-wizard.js"></script> 
	<script src="../assets/scripts/ui-general.js"></script>
	<script src="../assets/scripts/form-validationtabungan.js"></script> 
	<script>
		jQuery(document).ready(function() {		
			App.init(); // initlayout and core plugins
			FormComponents.init();
			FormWizard.init();
			UIGeneral.init();
			FormValidation.init();
		});
	</script>
	<?php $this -> load -> view( 'header' );?>
	<link rel="stylesheet" href="assets/css/autocomplete.css" type="text/css" media="screen" />
	<script type="text/javascript" src="assets/js/tool/shu.js"></script>
	<script type="text/javascript" src="assets/js/jq/jquery.autocomplete.js"></script>

</head>
<body class="fixed-top">
	<div id="header" class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="brand" href="."><img src="assets/img/logoc.png"/></a>
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
			<?php foreach($menunya as $item) {echo $item;}?>
		</div>
		<div id="body">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">		
						<h3 class="page-title">
							Tool
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="..">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li>
								<a href="#">Tool</a>
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">SHU</a></li>
						</ul>
					</div>
				</div>
				<div id="page" class="dashboard">
					<div class="row-fluid">
						<div class="span12" style="background-color: #fff; padding: 10px; margin: 0 0 20px 0;">
							<form class="form-horizontal" id="filter_shu">
								<div class="control-group">
									<label class="control-label">Start Date</label>
									<div class="controls">
										<input type="date" class="input-large" id="start_date" name="start_date">
									</div>
								</div>
								<div class="control-group">
									<label class="control-label">End Date</label>
									<div class="controls">
										<input type="date" class="input-large" id="end_date" name="end_date">
									</div>
								</div>

								<div class="">
									<button class="btn btn-primary" type="button" id="generate_shu" style="margin-left:160px;"><i class="icon-ok"></i> Filter Data</button>
								</div>
							</form>
							<hr>
							<div id="printableArea">
								<div style="text-align: center;">
									<h5>Laporan Pembagian SHU Periode : <span id="val_date"></span></h5>
								</div>
								<table border="1" style="border-collapse: collapse;" width="100%">
									<tbody>
										<tr>
											<td colspan="2" style="padding: 5px;">SHU Sebelum pajak</td>
											<td width="10%" align="right" style="padding: 5px;" id="val_shu_before_tax">0</td>
										</tr>
										<tr>
											<td colspan="2" style="padding: 5px;">Pajak PPh (5%)</td>
											<td width="10%" align="right" style="padding: 5px;" id="val_shu_tax">0</td>
										</tr>
										<tr>
											<td colspan="2" style="padding: 5px;">SHU Setelah Pajak</td>
											<td width="10%" align="right" style="padding: 5px;" id="val_shu_after_tax">0</td>
										</tr>
									</tbody>
								</table>
								<div id="form_add_shu">
									
									<form class="form-inline">
										<input type="text" id="title_shu" class="input-large" placeholder="Nama SHU">
										<input type="number" id="val_shu" class="input-large" max="" placeholder="Nilai SHU (%)">
										<button type="button" class="btn" id="add_shu">Add SHU</button>
									</form>
									<p id="sisa_shu">Sisa persentase SHU : <span id="val_sisa_shu"></span> </p>
								</div>
								<table border="1" style="border-collapse: collapse;" width="100%">
									<tbody id="new_shu">
									</tbody>
								</table>
							</div>
							<button type="button" class="btn" id="cetak_shu" target="_blank" onclick="printDiv('printableArea')">Print</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="footer">
		<p align="center">copyright &copy; <?=date('Y');?> APLIKASI KSP SYARIAH</p>
		<div class="span pull-right">
			<span class="go-top"><i class="icon-arrow-up"></i></span>
		</div>
	</div>
</body>
</html>
<?php
/*
 * Aplikasi AKSIOMA (Aplikasi Keuangan Mikro Masyarakat Ekonomi Syariah) ver. 1.0
 * Copyright (c) 2014
 *
 * file   : angsuran.php
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
    <link rel="icon" href="<?=base_url();?>assets/images/favicon.jpg" type="image/jpg" />
	<meta content="width=device-width, initial-scale=1.0" name="viewport" />
	<link href="<?=base_url();?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
	<link href="<?=base_url();?>assets/plugins/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
	<link href="<?=base_url();?>assets/plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="<?=base_url();?>assets/css/style.css" rel="stylesheet" />
	<link href="<?=base_url();?>assets/css/style-responsive.css" rel="stylesheet" />
	<link href="<?=base_url();?>assets/css/themes/default.css" rel="stylesheet" id="style_color" />
	<link href="<?=base_url();?>assets/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />
	<link href="<?=base_url();?>assets/plugins/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" type="text/css"  />
	<link href="<?=base_url();?>assets/plugins/jqvmap/jqvmap/jqvmap.css" media="screen" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/plugins/chosen-bootstrap/chosen/chosen.css" />
    
    <script src="<?=base_url();?>assets/plugins/jquery-1.8.3.min.js" type="text/javascript"></script>	
	<!-- IMPORTANT! Load jquery-ui-1.10.1.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->	
	<script src="<?=base_url();?>assets/plugins/jquery-ui/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>		
	<script src="<?=base_url();?>assets/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
	<!--[if lt IE 9]>
	<script src="<?=base_url();?>assets/plugins/excanvas.js"></script>
	<script src="<?=base_url();?>assets/plugins/respond.js"></script>	
	<![endif]-->	
	<script src="<?=base_url();?>assets/plugins/breakpoints/breakpoints.js" type="text/javascript"></script>	
	<script src="<?=base_url();?>assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/plugins/jquery.blockui.js" type="text/javascript"></script>	
	<script src="<?=base_url();?>assets/plugins/jquery.cookie.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/plugins/uniform/jquery.uniform.min.js" type="text/javascript" ></script>	
	<script src="<?=base_url();?>assets/plugins/flot/jquery.flot.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/plugins/flot/jquery.flot.resize.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/plugins/jquery.peity.min.js" type="text/javascript"></script>	
	<script src="<?=base_url();?>assets/plugins/jquery-knob/js/jquery.knob.js" type="text/javascript"></script>	
    <script type="text/javascript" src="<?=base_url();?>assets/js/jq/jquery.jclock.js"></script>
    
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/select2/select2.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/jquery-tags-input/jquery.tagsinput.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/bootstrap-toggle-buttons/static/js/jquery.toggle.buttons.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/clockface/js/clockface.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js"></script>   
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/jquery.input-ip-address-control-1.0.min.js"></script>
   
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/jquery.pulsate.min.js"></script>
	<script type="text/javascript" src="<?=base_url();?>assets/plugins/jquery-validation/dist/jquery.validate.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/plugins/jquery-validation/dist/additional-methods.min.js"></script>
   
    <script src="<?=base_url();?>assets/scripts/app.js" type="text/javascript"></script>
	<script src="<?=base_url();?>assets/scripts/form-components.js"></script>     
   <script src="<?=base_url();?>assets/scripts/form-wizard.js"></script> 
   <script src="<?=base_url();?>assets/scripts/ui-general.js"></script>
   <script src="<?=base_url();?>assets/scripts/form-validationtabungan.js"></script> 
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
    <script type="text/javascript" src="assets/js/angsuran.js"></script>
    <script type="text/javascript" src="assets/js/jq/jquery.autocomplete.js"></script>
    
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
			<?php foreach($menunya as $item) {echo $item;}?>
		</div>
		<div id="body">
			<div class="container-fluid">
				<div class="row-fluid">
					<div class="span12">		
						<h3 class="page-title">
							Transaksi Umum
						</h3>
						<ul class="breadcrumb">
							<li>
								<i class="icon-home"></i>
								<a href="..">Home</a> 
								<i class="icon-angle-right"></i>
							</li>
							<li><a href="#">Transaksi Umum</a></li>
						</ul>
					</div>
				</div>
				<div id="page" class="dashboard">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="tabbable tabbable-custom boxless">
                                <ul class="nav nav-tabs">
                                   <li class="active"><a href="#tabs-1" data-toggle="tab">Setor Angsuran</a></li>
                                   <li><a href="#tabs-2" data-toggle="tab">Search</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tabs-1">
                                        <form class="form-horizontal" id="form_angsuran" method="post">
                                        <div class="span6 ">
                                            <div class="control-group fm-req">
                                                <label class="control-label">Tanggal Transaksi</label>
                                                <div class="controls">
                                                    <input name="tgl_transaksi" tabindex="0" type="text" size="16" class="inp m-wrap m-ctrl-medium date-picker input-small">
                                                </div>
                                            </div>
                                            <div class="control-group fm-req">
                                                <label class="control-label">No. Jurnal <span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="nomor_jurnal" tabindex="1" type="text" class="inp input-small">
                                                    <input name="id_jurnal" type="hidden">
                                                    <input name="gl_administrasi" type="hidden">
                                                    <input name="gl_marginditangguhkan" type="hidden">
                                                    <input name="gl_pendapatanmargin" type="hidden">
                                                    <input name="gl_diskon" type="hidden">
                                                    <input name="gl_pendapatanbagihasil" type="hidden">
                                                    <input name="gl_bonusalqardh" type="hidden">
                                                    <input name="gl_pendapatanbagihasilmusy" type="hidden">
                                                    <input name="gl_activaijarah" type="hidden">
                                                    <input name="gl_pendapatanijarah" type="hidden">
                                                    <input name="gl_asetistishna" type="hidden">
                                                    <input name="gl_pendapatanmarjinistishna" type="hidden">
                                                    <input name="gl_diskonistishna" type="hidden">
                                                    <input name="gl_pendapatankeuntungansalam" type="hidden">
                                                    <input name="pembiayaandetail_id" type="hidden">
                                                    <input name="jenis_pembiayaan" type="hidden">
                                                </div>
                                            </div>
                                            <div class="control-group fm-req">
                                                <label class="control-label">No. Ref <span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="nomor_ref" id="nomor_ref" tabindex="2" type="text" class="inp input-small">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Wilayah Kerja</label>
                                                <div class="controls">
                                                    <select tabindex="3" class="inp input-large" name="wilayah_id"></select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="span6 ">
                                            <div class="control-group fm-req">
                                                <label class="control-label">No. Rekening <span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="nomor_rekening" id="nomor_rekening" tabindex="4" type="text" class="inp input-large"> <a class="btn searchact"><i class="icon-search"></i></a>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Nama</label>
                                                <div class="controls">
                                                    <input name="nama" id="nama" tabindex="5" type="text" class="input-large">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Alamat</label>
                                                <div class="controls">
                                                    <input name="alamat" tabindex="6" type="text" class="input-xlarge">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Kota / Kode pos</label>
                                                <div class="controls">
                                                    <input name="kota" tabindex="7" type="text" class="input-large">
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="span6">
                                            <hr>
                                            <div class="control-group fm-req">
                                                <label class="control-label">Jumlah <span class="required">*</span></label>
                                                <div class="controls">
                                                    <input name="jumlah" tabindex="9" type="text" class="input-large" style="text-align: right;">
                                                    <input name="pokok" id="pokok" type="hidden">
                                                    <input name="margin" id="margin" type="hidden">
                                                    
                                                </div>
                                            </div>
                                            <div class="control-group fm-req">
                                                <label class="control-label"></label>
                                                <div class="controls">
                                                    <span class="badge badge-inverse jumlahket"><b></b></span>
                                                </div>
                                            </div>
                                            <div class="control-group fm-req">
                                                <label class="control-label">Pokok</label>
                                                <div class="controls">
                                                    <input name="pokokinfo" id="pokokinfo" type="text" class="input-large" style="text-align: right;">
                                                </div>
                                            </div>
                                            <div class="control-group fm-req">
                                                <label class="control-label">Margin</label>
                                                <div class="controls">
                                                    <input name="margininfo" id="margininfo" type="text" class="input-large" style="text-align: right;">
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Terbilang : </label>
                                                <div class="controls">
                                                    <span id="terbilang" class="alert-info"></span>
                                                </div>
                                            </div>
                                            <div class="control-group">
                                                <label class="control-label">Keterangan</label>
                                                <div class="controls">
                                                    <input name="ket" tabindex="9" type="text" class="input-xlarge">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span5">
                                            <hr>
                                            <div class="widget box blue">
                                                <div class="widget-title">
                                                   <h4><i class="icon-reorder"></i> Setoran yang telah dilakukan</h4>
                                                </div>
                                                <table style="width:100%;color:#000" border="0" bgcolor="#fff">
                                                    <thead class="jdl">
                                                        <tr>
                                                            <td align=\"center\"><b>Kode</b></td>
                                                            <td align=\"center\"><b>Tanggal</b></td>
                                                            <td align=\"center\"><b>Jumlah</b></td>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="tb_view"></tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="span11 ">
                                            <div class="form-actions">
                                                <button class="btn btn-primary" id="save_a"><i class="icon-ok"></i> Save</button>
                                            </div>
                                            <p class="infonya"></p>
                                         </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane" id="tabs-2">
                                        <div class="widget box blue">
                                            <div class="widget-title">
                                               <h4><i class="icon-reorder"></i> Data pembiayaan</h4>
                                            </div>
                                            <div id="table_datapembiayaan">
                                                <?php
                                                $nasabah['option'][] = array("nama","Nama Nasabah"); // value,title
                                                $nasabah['option'][] = array("nomor_rekening","Nomor Rekening"); // value,title
                                                $nasabah['tabel_head'][] = array("","5%","No"); // id,width,title
                                                $nasabah['tabel_head'][] = array("nomor_nasabah","10%","No. Rekening");
                                                $nasabah['tabel_head'][] = array("","18%","Nama nasabah");
                                                $nasabah['tabel_head'][] = array("","20%","Jenis Pembiayaan");
                                                $nasabah['tabel_head'][] = array("","15%","Jumlah pengajuan");
                                                $nasabah['tabel_head'][] = array("","10%","Tgl pengajuan");
                                                $nasabah['tabel_head'][] = array("","5%","Manage");
                                                $nasabah['tabel_head'][] = array("pembiayaan_id","5%","ID");
                                                $this -> load -> view( 'filter_layout',$nasabah );
                                                $this -> load -> view( 'table_layout',$nasabah );
                                                $this -> load -> view( 'paging_layout',$nasabah );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
	<iframe name="ctkframe" id="ctkframe" style="width:0px;height:0px;border:0" src="angsuran/cetak"></iframe>
    <!-- Dialog Area -->
    
</body>
</html>

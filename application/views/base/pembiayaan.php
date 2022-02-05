<?php
/*
 * Aplikasi AKSIOMA (Aplikasi Keuangan Mikro Masyarakat Ekonomi Syariah) ver. 1.0
 * Copyright (c) 2014
 *
 * file   : base/pembiayaan.php
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
                <script src="../assets/scripts/form-validationpembiayaan.js"></script> 
                <script>
                    jQuery(document).ready(function() {		
                        App.init();
                        FormComponents.init();
                        FormWizard.init();
                        UIGeneral.init();
                        FormValidation.init();
                    });
                </script>
                <?php $this -> load -> view( 'header' );?>
                <link rel="stylesheet" href="assets/css/autocomplete.css" type="text/css" media="screen" />
                <script type="text/javascript" src="assets/js/base/pembiayaan.js"></script>
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
                                    <h3 class="page-title">Base</h3>
                                    <ul class="breadcrumb">
                                        <li>
                                            <i class="icon-home"></i>
                                            <a href="..">Home</a> 
                                            <i class="icon-angle-right"></i>
                                        </li>
                                        <li><a href="#">Base</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div id="page" class="dashboard">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <div class="tabbable tabbable-custom boxless">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#tabs-1" data-toggle="tab">Data Pembiayaan</a></li>
                                                <li><a href="#tabs-2" data-toggle="tab">Form Pembiayaan</a></li>
                                                <li><a href="#tabs-3" data-toggle="tab">Search AO</a></li>
                                                <li><a href="#tabs-4" data-toggle="tab">Search Nasabah</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tabs-1">
                                                    <div class="widget box blue">
                                                        <div class="widget-title">
                                                            <h4><i class="icon-reorder"></i> Data pembiayaan</h4>
                                                        </div>
                                                        <div id="table_datapembiayaan">
                                                            <?php
                                                            $pembiayaan['option'][] = array("nama","Nama Nasabah"); 
                                                            $pembiayaan['option'][] = array("nomor_rekening","Nomor Rekening"); 
                                                            $pembiayaan['tombol'] = '<button id="addpembiayaan" class="fg-button ui-state-default ui-corner-all"><img src="assets/images/addicon.png" />Tambah pembiayaan</button>';
                                                            $pembiayaan['tabel_head'][] = array("","5%","No");
                                                            $pembiayaan['tabel_head'][] = array("nomor_nasabah","10%","No. Rekening");
                                                            $pembiayaan['tabel_head'][] = array("","18%","Nama nasabah");
                                                            $pembiayaan['tabel_head'][] = array("","20%","Jenis Pembiayaan");
                                                            $pembiayaan['tabel_head'][] = array("","15%","Jumlah pengajuan");
                                                            $pembiayaan['tabel_head'][] = array("","10%","Tgl pengajuan");
                                                            $pembiayaan['tabel_head'][] = array("","5%","Status");
                                                            $pembiayaan['tabel_head'][] = array("","5%","Manage");
                                                            $pembiayaan['tabel_head'][] = array("pembiayaan_id","5%","ID");
                                                            $this -> load -> view( 'filter_layout',$pembiayaan );
                                                            $this -> load -> view( 'table_layout',$pembiayaan );
                                                            $this -> load -> view( 'paging_layout',$pembiayaan );
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tabs-2">
                                                    <div class="form">
                                                        <form class="form-horizontal" id="form_pemb" method="post">
                                                            <div class="row">
                                                                <div class="span6">
                                                                    <input name="id_pemb" id="id_pemb" type="hidden">
                                                                    <div class="control-group">
                                                                        <label class="control-label">Tanggal dibuka<span class="required">*</span></label>
                                                                        <div class="controls">
                                                                            <input name="tgl_dibuka" type="text" size="16" class="input-large m-wrap m-ctrl-medium date-picker" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">No. Pembiayaan<span class="required">*</span></label>
                                                                        <div class="controls">
                                                                            <input name="nomor_rekening" type="text" class="input-large" readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">AO<span class="required">*</span></label>
                                                                        <div class="controls">
                                                                            <input name="nomor_ao" type="hidden" class="input-large">
                                                                            <input name="nomor_aoname" type="text" class="input-large"> <a class="btn searchfo"><i class="icon-search"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Cari Nama Nasabah<span class="required">*</span></label>
                                                                        <div class="controls">
                                                                            <input name="nama" type="text" class="input-large">
                                                                            <input name="nomor_nasabah" type="hidden" class="input-large"> <a class="btn searchnasabah"><i class="icon-search"></i></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Nomor Akad</label>
                                                                        <div class="controls">
                                                                            <input name="nomor_akad" type="text" class="input-large">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Tanggal akad</label>
                                                                        <div class="controls">
                                                                            <input name="tgl_akad" type="text" size="16" class="input-large m-wrap m-ctrl-medium date-picker">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Jenis Pembiayaan</label>
                                                                        <div class="controls">
                                                                            <select class="input-large" name="jenis_pembiayaan"></select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Jumlah pengajuan</label>
                                                                        <div class="controls">
                                                                            <input name="jumlah_pengajuan" type="text" class="input-large">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Lama angsuran</label>
                                                                        <div class="controls">
                                                                            <input name="lama_angsuran" type="text" class="input-small">
                                                                            <select class="input-small" name="type_angsuran" id="type_angsuran">
                                                                                <option value="HARI">HARI</option>
                                                                                <option value="MINGGU">MINGGU</option>
                                                                                <option value="BULAN">BULAN</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                  
                                                                    <div class="control-group">
                                                                        <label class="control-label">Mulai angsuran<span class="required">*</span></label>
                                                                        <div class="controls">
                                                                            <input name="mulai_angsuran" type="text" size="16" class="input-large m-wrap m-ctrl-medium date-picker">
                                                                            <input name="selesai_angsuran" type="hidden" size="16"> 
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="control-group">
                                                                        <label class="control-label">Status</label>
                                                                        <div class="controls">
                                                                            <select class="input-large" name="status">
                                                                                <option value="0">Aktif</option>
                                                                                <option value="1">Lunas</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="span6" id="pengeluaran">
                                                                    <div class="control-group">
                                                                        <label class="control-label">Tempat Tinggal</label>
                                                                        <div class="controls">
                                                                            <select class="input-large" name="tempat_tinggal">
                                                                                <option value="0"> ------ </option>
                                                                                <option value="1">Milik Sendiri</option>
                                                                                <option value="2">Milik Orang Tua</option>
                                                                                <option value="3">Milik Keluarga</option>
                                                                                <option value="4">Mengontrak</option>
                                                                                <option value="5">Kos</option>
                                                                                <option value="6">Apartemen / Rusun</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group" id="no_telpon_pemilik">
                                                                        <label class="control-label">Nomor Telpon Pemilik</label>
                                                                        <div class="controls">
                                                                            <input name="no_telpon_pemilik" type="text" class="input-large">
                                                                        </div>
                                                                    </div>

                                                                    <div class="control-group">
                                                                        <label class="control-label">No. SK</label>
                                                                        <div class="controls">
                                                                            <input name="sk" type="text" class="input-large">
                                                                        </div>
                                                                    </div>

                                                                    <div class="control-group">
                                                                        <label class="control-label">SKU</label>
                                                                        <div class="controls">
                                                                            <input name="sku" type="text" class="input-large">
                                                                        </div>
                                                                    </div>

                                                                    <div class="control-group">
                                                                        <label class="control-label">Lap. Inventory</label>
                                                                        <div class="controls">
                                                                            <input name="lap_inventory" type="text" class="input-large">
                                                                        </div>
                                                                    </div>

                                                                    <div class="control-group">
                                                                        <label class="control-label">Net Income</label>
                                                                        <div class="controls">
                                                                            <input type="number" class="input-large" name="net_income">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Slip Gaji</label>
                                                                        <div class="controls">
                                                                            <select name="slip_gaji" class="input-large">
                                                                                <option value="1">Ya</option>
                                                                                <option value="2">Tidak</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Gaji & Tunjangan</label>
                                                                        <div class="controls">
                                                                            <input type="number" class="input-large" name="gaji_tunjangan">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Biaya Konsumsi</label>
                                                                        <div class="controls">
                                                                            <input type="number" class="input-large" name="biaya_konsumsi">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Biaya Listrik</label>
                                                                        <div class="controls">
                                                                            <input type="number" class="input-large" name="biaya_listrik">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Biaya PDAM</label>
                                                                        <div class="controls">
                                                                            <input type="number" class="input-large" name="biaya_pdam">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Total Hutang</label>
                                                                        <div class="controls">
                                                                            <input type="number" class="input-large" name="hutang">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Total BBM</label>
                                                                        <div class="controls">
                                                                            <input type="number" class="input-large" name="biaya_bbm">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Biaya Pendidikan</label>
                                                                        <div class="controls">
                                                                            <input type="number" class="input-large" name="biaya_pendidikan">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Biaya Lain-lain</label>
                                                                        <div class="controls">
                                                                            <input type="number" class="input-large" name="biaya_lain_lain">
                                                                        </div>
                                                                    </div>
                                                                    <div class="control-group">
                                                                        <label class="control-label">Total  Pengeluaran</label>
                                                                        <div class="controls">
                                                                            <input type="text" id="total_pengeluaran" readonly class="input-large">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="span12">
                                                                    <hr>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="span6">
                                                                    <!--murabahah-->
                                                                    <div id="info_murabahah">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Harga pokok</label>
                                                                            <div class="controls">
                                                                                <input name="harga_pokok" readonly type="text" class="input-large">
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Marjin</label>
                                                                            <div class="controls">
                                                                                <input name="marjin" type="text" class="input-large">
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Harga jual</label>
                                                                            <div class="controls">
                                                                                <input name="harga_jual" type="text" class="input-large" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Uang muka</label>
                                                                            <div class="controls">
                                                                                <input name="uang_muka" type="text" class="input-large">
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                    </div>
                                                                    <div id="info_mudharobah">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Modal</label>
                                                                            <div class="controls">
                                                                                <input name="modal" readonly type="text" class="input-large">
                                                                            </div>
                                                                        </div>
                                                                        <div class="control-group">
                                                                            <label class="control-label">Nisbah (Bank : Nasabah)</label>
                                                                            <div class="controls">
                                                                                <input name="nisbah_bank" type="text" class="input-small"> % / <input name="nisbah_nasabah" type="text" class="input-small"> %
                                                                            </div>
                                                                        </div>
                                                                        <hr>
                                                                    </div>

                                                                    <div id="info_qordh">
                                                                        <div class="control-group">
                                                                            <label class="control-label">Pinjaman</label>
                                                                            <div class="controls">
                                                                                <input name="pinjaman" readonly type="text" class="input-large">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn" id="buatjadwal" style="margin-left: 200px;"><i class="icon-list-ul"></i> Buat jadwal</button>
                                                                    <hr>
                                                                </div>
                                                                <div class="span6">
                                                                    <h5>Table  Scoring</h5>
                                                                    <table border="1" style="border-collapse: collapse;" width="100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Jenis</th>
                                                                                <th>Grade</th>
                                                                                <th>Value</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td width="70%">Kelengkapan Dokumen</td>
                                                                                <td id="grade_kelengkapan_dokumen"></td>
                                                                                <td id="val_kelengkapan_dokumen"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Status Rumah</td>
                                                                                <td id="grade_status_rumah"></td>
                                                                                <td id="val_status_rumah"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Status Pekerjaan</td>
                                                                                <td id="grade_status_pekerjaan"></td>
                                                                                <td id="val_status_pekerjaan"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Net Income</td>
                                                                                <td id="grade_net_income"></td>
                                                                                <td id="val_net_income"></td>
                                                                            </tr>
                                                                        </tbody>
                                                                        <tfoot>
                                                                            <tr>
                                                                                <td>Grade</td>
                                                                                <td id="grade"></td>
                                                                                <td id="value"></td>
                                                                            </tr>
                                                                        </tfoot>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="span12">
                                                                    <div id="showangsuran"></div>
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="span12">
                                                                    <button class="btn btn-primary" id="savedata" style="margin-left: 200px;"><i class="icon-ok"></i> Save</button>
                                                                    <p class="infonya"></p>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tabs-3">
                                                    <div class="widget box blue">
                                                        <div class="widget-title">
                                                            <h4><i class="icon-reorder"></i> Data FO</h4>
                                                        </div>
                                                        <div id="table_pegawai">
                                                            <?php
                                                            $pegawai['option'][] = array("nama_pegawai","Nama Pegawai");
                                                            $pegawai['option'][] = array("nip","NIP");
                                                            $pegawai['option'][] = array("nama_jabatan","Jabatan");
                                                            $pegawai['option'][] = array("nama_panggilan","Panggilan");
                                                            $pegawai['tombol'] = false;
                                                            $pegawai['tabel_head'][] = array("","5%","No","1",""); 
                                                            $pegawai['tabel_head'][] = array("nama_pegawai","10%","Nama","1","");
                                                            $pegawai['tabel_head'][] = array("nama_panggilan","7%","Panggilan","1","");
                                                            $pegawai['tabel_head'][] = array("","20%","Alamat","1","");
                                                            $pegawai['tabel_head'][] = array("nama_jabatan","10%","Jabatan","1","");
                                                            $pegawai['tabel_head'][] = array("","7%","Manage","1","");
                                                            $pegawai['tabel_head'][] = array("pegawai_id","5%","ID","1","");
                                                            $this -> load -> view( 'filter_layout',$pegawai );
                                                            $this -> load -> view( 'table_layout',$pegawai );
                                                            $this -> load -> view( 'paging_layout',$pegawai );
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="tabs-4">
                                                    <div class="widget box blue">
                                                        <div class="widget-title">
                                                            <h4><i class="icon-reorder"></i> Nasabah</h4>
                                                        </div>
                                                        <div id="table_datanasabah">
                                                            <?php
                                                            $nasabah['option'][] = array("nama","Nama Nasabah"); 
                                                            $nasabah['option'][] = array("nomor_nasabah","Nomor Nasabah"); 
                                                            $nasabah['tombol'] = false;
                                                            $nasabah['tabel_head'][] = array("","5%","No"); 
                                                            $nasabah['tabel_head'][] = array("nomor_nasabah","12%","Nomor nasabah");
                                                            $nasabah['tabel_head'][] = array("","20%","Nama nasabah");
                                                            $nasabah['tabel_head'][] = array("","25%","Alamat");
                                                            $nasabah['tabel_head'][] = array("","10%","Kota");
                                                            $nasabah['tabel_head'][] = array("","5%","Manage");
                                                            $nasabah['tabel_head'][] = array("nasabah_id","5%","ID");
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
            </body>
            </html>

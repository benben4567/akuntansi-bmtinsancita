/*
 * Aplikasi AKSIOMA (Aplikasi Keuangan Mikro Masyarakat Ekonomi Syariah) ver. 1.0
 * Copyright (c) 2014
 *
 * file   : base/pembiayaan.js
 * author : Edi Suwoto S.Komp
 * email  : edi.suwoto@gmail.com
 */
 /*----------------------------------------------------------*/
 $(document).ready(function(){
    //---- Inisialisasi
    $("#tab-utama").tabs();
    $('input[name="harga_pokok"],input[name="jumlah_pengajuan"],input[name="marjin"],input[name="uang_muka"],input[name="biaya_konsumsi"],input[name="biaya_listrik"],input[name="biaya_pdam"],input[name="hutang"],input[name="biaya_bbm"],input[name="biaya_pendidikan"],input[name="biaya_lain_lain"]').inputInteger();
/*
 *  --------------------- pembiayaan -----------------------------------------
 */
 $('#button-previous ,#button-next').click(function() {
    $("html, body").animate({ scrollTop: 300 }, "slow");
    return false;
});
 var produkcode = ajak('base/pembiayaan/produk_code');
 var count      = ajak('base/pembiayaan/run_code',"id="+ produkcode);
 var cab        = ajak('base/pembiayaan/cab_code');
 $("#form_pemb input[name='nomor_rekening']").val(produkcode+""+cab+""+count);
 $("#form_pemb input[name='tgl_dibuka']").val(isitglskrg());
 $("#info_murabahah").hide();
 $('#addpembiayaan').click(function() {
    $('#form_pemb input').val('');
    $('#form_pemb select').val('');
    $('#form_pemb textarea').val('');
    isi                       = ajak('base/pembiayaan/isi_pembiayaan');
    $("#form_pemb select[name ='jenis_pembiayaan']").html(isi);
    var cab                   = ajak('base/pembiayaan/cab_code');
    var produkcode            = ajak('base/pembiayaan/produk_code');
    var count                 = ajak('base/pembiayaan/run_code',"id="+ produkcode);
    $("#form_pemb input[name='nomor_rekening']").val(produkcode+""+cab+""+count);
    $("#form_pemb input[name='tgl_dibuka']").val(isitglskrg());
    $('.nav-tabs li:eq(0)').removeClass('active').addClass('');
    $('.nav-tabs li:eq(1)').removeClass('').addClass('active');
    $('#tabs-1').removeClass('active').addClass('');
    $('#tabs-2').removeClass('').addClass('active');

    $('#id_pemb').val('0');
    $("#info_murabahah").show();
    return false;
});
 $('#buatjadwal').click(function() {
    var type_angsuran  = $("#type_angsuran").val();
    var lama_angsuran  = $("#form_pemb input[name='lama_angsuran']").val();
    var mulai_angsuran = $("#form_pemb input[name='mulai_angsuran']").val();
    var pokok          = 0;
    var margin         = 0;

    var produk         =  $("#form_pemb select[name='jenis_pembiayaan']").val();
    var nameproduk     = ajak('base/pembiayaan/produk_name','id='+produk);

    $("#showangsuran").html("");
    var isi ="<div class=\"widget-title\"><h4><i class=\"icon-reorder\"></i> Jadwal angsuran</h4></div>";
    isi +="<table style=\"width:100%;color:#000\" border=\"0\" bgcolor=\"#fff\"><thead><tr style=\"background:#fff\">";

    if(nameproduk == "MURABAHAH"){
     isi    +="<td align=\"center\"><b>No</b></td><td align=\"center\"><b>Tanggal</b></td><td align=\"center\"><b>Pokok</b></td><td align=\"center\"><b>Margin</b></td><td align=\"center\"><b>Jumlah</b></td></tr></thead><tbody>";
     pokok  = $("#form_pemb input[name='harga_pokok']").val();
     margin = $("#form_pemb input[name='marjin']").val();

 }else if(nameproduk == "MUDHARABAH"){
     isi    +="<td align=\"center\"><b>No</b></td><td align=\"center\"><b>Tanggal</b></td><td align=\"center\"><b>Pokok</b></td><td align=\"center\"><b>Basil</b></td><td align=\"center\"><b>Jumlah</b></td></tr></thead><tbody>";
     pokok  = $("#form_pemb input[name='modal']").val();
     margin = 0;
 }else if(nameproduk == "AL-QARDH"){
     isi    +="<td align=\"center\"><b>No</b></td><td align=\"center\"><b>Tanggal</b></td><td align=\"center\"><b>Pokok</b></td></tr></thead><tbody>";
     pokok  = $("#form_pemb input[name='pinjaman']").val();
     margin = 0;
 }else if(nameproduk == "MUSYARAKAH"){
     isi +="<td align=\"center\"><b>No</b></td><td align=\"center\"><b>Tanggal</b></td><td align=\"center\"><b>Pokok</b></td><td align=\"center\"><b>Basil</b></td><td align=\"center\"><b>Jumlah</b></td></tr></thead><tbody>";
     pokok = $("#form_pemb input[name='modal']").val();
     margin = 0;
 }
 nr = 1;
 var totpokok = 0, totmargin=0, totjumlah =0,tglangs,minggu = 6;
 for(i = 0; i < lama_angsuran; i++) {
     if(type_angsuran =="HARI"){
      tglangs = isiharinextvalue(mulai_angsuran,i);
  }else if(type_angsuran == "MINGGU"){
      tglangs = isiminggunextvalue(mulai_angsuran,minggu);
      minggu += 7;
  }else if(type_angsuran == "BULAN"){
      tglangs = isitglnextvalue(mulai_angsuran,i);
  } 
  valpokok  = pokok / lama_angsuran;
  valmargin = margin / lama_angsuran;
  valjumlah = eval(valpokok) + eval(valmargin);
  totpokok  += valpokok;
  totmargin += valmargin;
  totjumlah += valjumlah;
  rc = (i%2 == 0) ? "#F2F2F2" : "#fff";
  isi += "<tr style=\"background:" + rc + ";\">"
  + "<td align=\"center\">"+ nr +"</td>" 
  + "<td align=\"center\">"+ tglangs +"</td>" 
  + "<td align=\"right\">"+ format_uang(valpokok) +"</td>";
  if(nameproduk != "AL-QARDH"){
    isi += "<td align=\"right\">"+ format_uang(valmargin) +"</td>" 
    + "<td align=\"right\">"+ format_uang(valjumlah) +"</td>"; 
}
isi += "</tr>";
nr++;
}
totpokok  = Math.floor(totpokok);
totmargin = Math.floor(totmargin);
totjumlah = Math.floor(totjumlah);
if(nameproduk != "AL-QARDH"){
 isi += "<tr style=\"background:#EFF1F1\"><td colspan=\"2\" style=\"border-top:1px solid #000\" align=\"right\"><b>TOTAL</b></td><td align=\"right\" style=\"border-top:1px solid #000\"><b>" + format_uang(totpokok) + "</b></td><td align=\"right\" style=\"border-top:1px solid #000\"><b>" + format_uang(totmargin) + "</b></td><td align=\"right\" style=\"border-top:1px solid #000\"><b>" + format_uang(totjumlah) + "</b></td></tr>"
}else{
 isi += "<tr style=\"background:#EFF1F1\"><td colspan=\"2\" style=\"border-top:1px solid #000\" align=\"right\"><b>TOTAL</b></td><td align=\"right\" style=\"border-top:1px solid #000\"><b>" + format_uang(totpokok) + "</b></td></tr>"
}
isi +="</tbody></table>";
$("#showangsuran").html(isi);
return false;
});
 function loadjadwalpembiayaan(norekening){
    $.post("base/pembiayaan/get_jadwalview","id="+ norekening,
        function(json){
            var isi ="<div class=\"widget-title\"><h4><i class=\"icon-reorder\"></i> Riwayat penonaktifan rekening</h4></div>";
            isi +="<table style=\"width:100%;color:#000\" border=\"0\" bgcolor=\"#fff\"><thead><tr style=\"background:#ff\">";
            isi +="<td align=\"center\"><b>No</b></td><td align=\"center\"><b>Tanggal</b></td><td align=\"center\"><b>Pokok</b></td><td align=\"center\"><b>Margin</b></td><td align=\"center\"><b>Jumlah</b></td></tr></thead><tbody>";
            nr = 1;
            for(i = 0; i < json['alldata'].length; i++) {
                rc = (i%2 == 0) ? "#F2F2F2" : "#fff";
                isi += "<tr style=\"background:" + rc + ";\">"
                + "<td align=\"center\">"+ nr +"</td>" 
                + "<td align=\"center\">"+ json['alldata'][i].accounttrans_code +"</td>" 
                + "</tr>";
                nr++;
            }
            isi +="</tbody></table>";
            $("#showangsuran").html(isi);
        }, "json");
    return false;
}

$("#form_pemb").change(function(){
    var net_income       = $("#pengeluaran input[name='net_income']").val();
    var gaji             = $("#pengeluaran input[name='gaji_tunjangan']").val();

    var biaya_konsumsi   = $("#form_pemb input[name='biaya_konsumsi']").val();
    var biaya_listrik    = $("#form_pemb input[name='biaya_listrik']").val();
    var biaya_pdam       = $("#form_pemb input[name='biaya_pdam']").val();
    var hutang           = $("#form_pemb input[name='hutang']").val();
    var biaya_bbm        = $("#form_pemb input[name='biaya_bbm']").val();
    var biaya_pendidikan = $("#form_pemb input[name='biaya_pendidikan']").val();
    var biaya_lain_lain  = $("#form_pemb input[name='biaya_lain_lain']").val();
    var lama_angsuran    = $("#form_pemb input[name='lama_angsuran']").val();

    var total_pengeluaran = parseInt(biaya_konsumsi ? biaya_konsumsi : 0)+parseInt(biaya_listrik ? biaya_listrik : 0)+parseInt(biaya_pdam ? biaya_pdam : 0)+parseInt(hutang ? hutang : 0)+parseInt(biaya_bbm ? biaya_bbm : 0)+parseInt(biaya_pendidikan ? biaya_pendidikan : 0)+parseInt(biaya_lain_lain ? biaya_lain_lain : 0);
    $("#total_pengeluaran").val(format_uang(total_pengeluaran));

    var total_pemasukan = parseInt(gaji ? gaji : 0)+parseInt(net_income ? net_income : 0);
    $("#form_pemb input[name='harga_pokok']").val((total_pemasukan-total_pengeluaran)*lama_angsuran);
    $("#form_pemb input[name='modal']").val((total_pemasukan-total_pengeluaran)*lama_angsuran);
    $("#form_pemb input[name='pinjaman']").val((total_pemasukan-total_pengeluaran)*lama_angsuran);

});





$('#savedata').click(function() {
    hasil = validform("form_pemb");
    if (hasil['isi'] != "invalid") {
        if($('#id_pemb').val() == "0"){
            respon = ajak("base/pembiayaan/savepembiayaan",$('#form_pemb').serialize());
            if(respon == 1){
                window.location.replace("base/pembiayaan");
            }else{
                showinfo("Error : " + respon);
                return false;
            }
        }else{
            respon = ajak("base/pembiayaan/editpembiayaan",$('#form_pemb').serialize());
            if(respon == 1){
                window.location.replace("base/pembiayaan");
            }else{
                showinfo("Error : " + respon);
                return false;
            }
        }
    } else {
        showinfo("Form dengan tanda * harus Diisi");
        hasil['focus'].focus();
        return false;
    }

});
$("#form_pemb input[name='marjin']").blur(function() {
    nilai = eval($("#form_pemb input[name='marjin']").val()) + eval($("#form_pemb input[name='harga_pokok']").val());
    $("#form_pemb input[name='harga_jual']").val(nilai);
});

$("#info_mudharobah").hide();
$("#info_qordh").hide();
$("#form_pemb select[name='jenis_pembiayaan']").change(function() {
    var cab = ajak('base/pembiayaan/cab_code');
    var produk =  $("#form_pemb select[name='jenis_pembiayaan']").val();
    var count = ajak('base/pembiayaan/run_code',"id="+ produk);
    $("#form_pemb input[name='nomor_rekening']").val(produk+""+cab+""+count);
    var nameproduk = ajak('base/pembiayaan/produk_name','id='+produk);

    if(nameproduk == "MURABAHAH"){
        $("#info_mudharobah").hide();
        $("#info_qordh").hide();
        $("#info_murabahah").show();
    }else if(nameproduk == "MUDHARABAH"){
        $("#info_murabahah").hide();
        $("#info_qordh").hide();
        $("#info_mudharobah").show();
    }else if(nameproduk == "AL-QARDH"){
        $("#info_murabahah").hide();
        $("#info_mudharobah").hide();
        $("#info_qordh").show();
    }else if(nameproduk == "MUSYARAKAH"){
        $("#info_murabahah").hide();
        $("#info_qordh").hide();
        $("#info_mudharobah").show();
    }
    return false;
});

// scoring

$('#no_telpon_pemilik').hide();
$("#form_pemb select[name='tempat_tinggal']").change(function() {
    var nilai = $('select[name=tempat_tinggal] option').filter(':selected').val();
    if(nilai=='4'){
        $('#no_telpon_pemilik').show();
    } else {
        $('#no_telpon_pemilik').hide();
    }
});

$('.searchnasabah').click(function() {
    $('.nav-tabs li:eq(1)').removeClass('active').addClass('');
    $('.nav-tabs li:eq(3)').removeClass('').addClass('active');
    $('#tabs-2').removeClass('active').addClass('');
    $('#tabs-4').removeClass('').addClass('active');
    return false;
});
    /*//autocomplite nasabah
    $("#form_pemb input[name='nama']").autocomplete('base/pembiayaan/search_nasabah', {
            multiple: false,
            parse: function(data) {
                return $.map(eval(data), function(row) {
                    return {
                        data: row,
                        value: row.nomor_nasabah,
                        result: row.nama
                    }
                });
            },
            formatItem: function(item) {
                return item.nomor_nasabah + ' - ' + item.nama;
            }
     }).result(function(e, item) {
            $("#form_pemb input[name='nama']").val(item.nama);
            $("#form_pemb input[name='nomor_nasabah']").val(item.nomor_nasabah);
            $("#form_pemb input[name='alamat']").val(item.alamat+" RT/RW "+item.rtrw);
            kab = ajak('base/nasabah/single_kabupaten','&kab='+item.kabupaten);
            $("#form_pemb input[name='kota']").val(kab);
    });
    */
    $('.searchfo').click(function() {
        $('.nav-tabs li:eq(1)').removeClass('active').addClass('');
        $('.nav-tabs li:eq(2)').removeClass('').addClass('active');
        $('#tabs-2').removeClass('active').addClass('');
        $('#tabs-3').removeClass('').addClass('active');
        return false;
    });
    /*
    //autocomplite ao
    $("#form_pemb input[name='nomor_aoname']").autocomplete('base/pembiayaan/search_ao', {
            multiple: false,
            parse: function(data) {
                return $.map(eval(data), function(row) {
                    return {
                        data: row,
                        value: row.nip,
                        result: row.nama_pegawai
                    }
                });
            },
            formatItem: function(item) {
                return item.nip + ' - ' + item.nama_pegawai;
            }
     }).result(function(e, item) {
            $("#form_pemb input[name='nomor_ao']").val(item.nip);
            $("#form_pemb input[name='nomor_aoname']").val(item.nama_pegawai);
    });
    */
    //autocomplite jaminan
    $("#form_pemb input[name='nomor_jaminan']").autocomplete('base/pembiayaan/search_jaminan', {
        multiple: false,
        parse: function(data) {
            return $.map(eval(data), function(row) {
                return {
                    data: row,
                    value: row.nomor_jaminan,
                    result: row.nilai_jaminan
                }
            });
        },
        formatItem: function(item) {
            return item.nomor_jaminan + ' - ' + item.pemilik + ' - '+ format_uang(item.nilai_jaminan) ;
        }
    }).result(function(e, item) {
        $("#form_pemb input[name='nomor_jaminan']").val(item.nomor_jaminan);
        $("#form_pemb input[name='nilai_jaminan']").val(format_uang(item.nilai_jaminan));
    });
     //---- Tabel pembiayaan
     $("#table_datapembiayaan").mastertable({
        urlGet:"base/pembiayaan/get_pembiayaan",
        flook:"nomor_rekening"
    },
    function(hal,juml,json) {
        var isi="";
        var jenis="";
        if(json['alldata'].length != 0){
            for(i = 0; i < json['alldata'].length; i++) {
                idx = "k" + json['alldata'][i].pembiayaan_id;
                dtx = json['alldata'][i];
                jSimpan(idx,dtx);
                jenis = ajak('base/pembiayaan/filterpembiayaan','&jenis='+json['alldata'][i].jenis_pembiayaan);
                managejab = "<img  class=\"cedt\" title=\"Edit\" src=\"assets/images/editicon.png\"/>";
                if(json['alldata'][i].status == 0){
                	status = "Aktiv";
                }else{
                	status = "Lunas";
                }
                isi += "<tr style=\"vertical-align:top;\">"
                + "<td align  =\"center\">" + (((hal - 1) * juml ) + (i + 1)) + "</td>"
                + "<td align  =\"left\">" + json['alldata'][i].nomor_rekening + "</td>"
                + "<td align  =\"left\">" + json['alldata'][i].nama + "</td>"
                + "<td align  =\"left\">" + jenis + "</td>"
                + "<td align  =\"right\">" + format_uang(json['alldata'][i].jumlah_pengajuan) + "</td>"
                + "<td align  =\"center\">" + revDate(json['alldata'][i].tgl_dibuka,'-') + "</td>"
                + "<td align  =\"center\">" + status + "</td>"
                + "<td nowrap =\"nowrap\" align=\"center\">" + managejab + "</td>"
                + "<td align  =\"center\">" + json['alldata'][i].pembiayaan_id + "</td>"
                + "</tr>";
            }
        }
        return isi;
    },
    function domIsi() {
        //---- Edit
        $('.cedt').click( function() {
            $(".infonya").hide();
            obj = jAmbil("k" + $(this).parent().next().text());
            $('.nav-tabs li:eq(0)').removeClass('active').addClass('');
            $('.nav-tabs li:eq(1)').removeClass('').addClass('active');
            $('#tabs-1').removeClass('active').addClass('');
            $('#tabs-2').removeClass('').addClass('active');
            
            $("#form_pemb input[name='id_pemb']").val(obj.pembiayaan_id);
            $("#form_pemb input[name='tgl_dibuka']").val(revDate(obj.tgl_dibuka,'-'));
            $("#form_pemb input[name='nomor_rekening']").val(obj.nomor_rekening);
            peg = ajak('base/pembiayaan/single_pegawai','&peg='+obj.nomor_ao );
            $("#form_pemb input[name='nomor_ao']").val(obj.nomor_ao);
            $("#form_pemb input[name='nomor_aoname']").val(peg);
            
            $("#form_pemb input[name='nama']").val(obj.nama);
            $("#form_pemb input[name='nomor_nasabah']").val(obj.nomor_nasabah);
            $("#form_pemb input[name='alamat']").val(obj.alamat+" RT/RW "+obj.rtrw);
            kab = ajak('base/nasabah/single_kabupaten','&kab='+obj.kabupaten);
            $("#form_pemb input[name='kota']").val(kab);
            
            isi = ajak('base/pembiayaan/isi_pembiayaan');
            $("#form_pemb select[name='jenis_pembiayaan']").html(isi);
            $("#form_pemb select[name='jenis_pembiayaan']").val(obj.jenis_pembiayaan);
            $("#form_pemb select[name='status']").val(obj.status);
            
            $("#form_pemb input[name='jumlah_pengajuan']").val(obj.jumlah_pengajuan);
            $("#form_pemb input[name='nomor_akad']").val(obj.nomor_akad);
            $("#form_pemb input[name='tgl_akad']").val(revDate(obj.tgl_akad,'-'));
            
            var nameproduk = ajak('base/pembiayaan/produk_name','id='+obj.jenis_pembiayaan);
            if(nameproduk == "MURABAHAH"){
                $("#info_mudharobah").hide();
                $("#info_qordh").hide();
                $("#info_murabahah").show();
                $("#form_pemb input[name='harga_pokok']").val(obj.harga_pokok);
                $("#form_pemb input[name='marjin']").val(obj.marjin);
                $("#form_pemb input[name='harga_jual']").val(obj.harga_jual);
                $("#form_pemb input[name='uang_muka']").val(obj.uang_muka);
            }else if(nameproduk == "MUDHARABAH"){
                $("#info_murabahah").hide();
                $("#info_qordh").hide();
                $("#info_mudharobah").show();
                $("#form_pemb input[name='modal']").val(obj.modal);
                $("#form_pemb input[name='nisbah_bank']").val(obj.nisbah_bank);
                $("#form_pemb input[name='nisbah_nasabah']").val(obj.nisbah_nasabah);
            }else if(nameproduk == "AL-QARDH"){
                $("#info_murabahah").hide();
                $("#info_mudharobah").hide();
                $("#info_qordh").show();
                $("#form_pemb input[name='pinjaman']").val(obj.pinjaman);
            }else if(nameproduk == "MUSYARAKAH"){
                $("#info_murabahah").hide();
                $("#info_qordh").hide();
                $("#info_mudharobah").show();
                $("#form_pemb input[name='modal']").val(obj.modal);
                $("#form_pemb input[name='nisbah_bank']").val(obj.nisbah_bank);
                $("#form_pemb input[name='nisbah_nasabah']").val(obj.nisbah_nasabah);
            }
            $("#form_pemb input[name='lama_angsuran']").val(obj.lama_angsuran);
            $("#form_pemb select[name='type_angsuran']").val(obj.type_angsuran);
            $("#form_pemb input[name='mulai_angsuran']").val(revDate(obj.mulai_angsuran,'-'));
            //$("#form_pemb input[name='selesai_angsuran']").val(revDate(obj.selesai_angsuran,'-'));
            
            return false;
        });
        $("#form_pemb input[name='marjin']").blur(function() {
            nilai = eval($("#form_pemb input[name='marjin']").val()) + eval($("#form_pemb input[name='harga_pokok']").val());
            $("#form_pemb input[name='harga_jual']").val(nilai);
        });
        warnatable();
    });
$("#table_pegawai").mastertable({
    urlGet:"param/pegawai/get_pegawai",
    flook:"nama_pegawai"
},
function(hal,juml,json) {
    var isi="";
    for(i = 0; i < json['alldata'].length; i++) {
        idx = "a" + json['alldata'][i].pegawai_id;
        dtx = json['alldata'][i];
        jSimpan(idx,dtx);
        managejab = "<img class=\"cadd1\" title=\"Add\" src=\"assets/images/addicon.png\"/>";
        isi += "<tr style=\"vertical-align:top;\">"
        + "<td align=\"center\">" + (((hal - 1) * juml ) + (i + 1)) + "</td>"
        + "<td align=\"left\">" + json['alldata'][i].nama_pegawai + "</td>"
        + "<td align=\"left\">" + json['alldata'][i].nama_panggilan + "</td>"
        + "<td>" + json['alldata'][i].alamat + "<br />" + json['alldata'][i].kota + "</td>"
        + "<td align=\"center\">" + json['alldata'][i].nama_jabatan + "</td>"
        + "<td align=\"center\">" + managejab + "</td>"
        + "<td align=\"center\">" + json['alldata'][i].pegawai_id + "</td>"
        + "</tr>";
    }
    return isi;
},
function domIsi() {
    $('.cadd1').click( function() {
        $(".infonya").hide();
        obj = jAmbil("a" + $(this).parent().next().text());
        $('.nav-tabs li:eq(2)').removeClass('active').addClass('');
        $('.nav-tabs li:eq(1)').removeClass('').addClass('active');
        $('#tabs-3').removeClass('active').addClass('');
        $('#tabs-2').removeClass('').addClass('active');
        $("#form_pemb input[name='nomor_ao']").val(obj.nip);
        $("#form_pemb input[name='nomor_aoname']").val(obj.nama_pegawai);
        return false;
    });
    warnatable();
});
     //---- Tabel Nasabah
     $("#table_datanasabah").mastertable({
        urlGet:"base/nasabah/get_nasabah",
        flook:"nomor_nasabah"
    },
    function(hal,juml,json) {
        var isi  = "";
        var kec  = "";
        var kab  = "";
        var prov = "";
        for(i = 0; i < json['alldata'].length; i++) {
            idx = "s" + json['alldata'][i].nasabah_id;
            dtx = json['alldata'][i];
            jSimpan(idx,dtx);
            kec = ajak('base/nasabah/single_kecamatan','&kec='+json['alldata'][i].kecamatan);
            kab = ajak('base/nasabah/single_kabupaten','&kab='+json['alldata'][i].kabupaten);
            managejab = "<img class=\"cadd\" title=\"Add\" src=\"assets/images/addicon.png\"/>";
            isi += "<tr style=\"vertical-align:top;\">"
            + "<td align=\"center\">" + (((hal - 1) * juml ) + (i + 1)) + "</td>"
            + "<td align=\"left\">" + json['alldata'][i].nomor_nasabah + "</td>"
            + "<td align=\"left\">" + json['alldata'][i].nama + "</td>"
            + "<td align=\"left\">" + json['alldata'][i].alamat + " RT/RW " + json['alldata'][i].rtrw + " Kec. " + kec + " Kode pos " + json['alldata'][i].kode_pos + "</td>"
            + "<td align=\"left\">" + kab + "</td>"
            + "<td nowrap=\"nowrap\" align=\"center\">" + managejab + "</td>"
            + "<td align=\"center\">" + json['alldata'][i].nasabah_id + "</td>"
            + "</tr>";
        }
        return isi;
    },
    function domIsi() {
        $('.cadd').click( function() {
            $(".infonya").hide();
            obj = jAmbil("s" + $(this).parent().next().text());
            $('.nav-tabs li:eq(3)').removeClass('active').addClass('');
            $('.nav-tabs li:eq(1)').removeClass('').addClass('active');
            $('#tabs-4').removeClass('active').addClass('');
            $('#tabs-2').removeClass('').addClass('active');

            $("#form_pemb input[name='nama']").val(obj.nama);
            $("#form_pemb input[name='nomor_nasabah']").val(obj.nomor_nasabah);

            $("#form_pemb").change(function() {
                var no_sk         = $("#pengeluaran input[name='sk']").val();
                var sku           = $("#pengeluaran input[name='sku']").val();
                var lap_inventory = $("#pengeluaran input[name='lap_inventory']").val();
                var slip_gaji     = $('select[name=slip_gaji] option').filter(':selected').val();
                console.log(no_sk)
                console.log(sku)
                console.log(lap_inventory)
                console.log(slip_gaji)

                var val_dokumen   = "";
                var grade_dokumen = "";
                
                if(obj.nomor_identitas.length>0){
                    val_dokumen   = '5';
                    grade_dokumen = 'C';
                }
                if(obj.nomor_identitas.length>0 && obj.nomor_npwp.length>0){
                    val_dokumen   = '7';
                    grade_dokumen = 'B-';
                }
                if(obj.nomor_identitas.length>0 && obj.nomor_npwp.length>0 && obj.nomor_bpjs.length>0){
                    val_dokumen   = '10';
                    grade_dokumen = 'B';
                }
                if(obj.nomor_identitas.length>0 && obj.nomor_npwp.length>0 && obj.nomor_bpjs.length>0 && slip_gaji==='1' && no_sk.length>0){
                    val_dokumen   = '15';
                    grade_dokumen = 'A';
                }
                if(obj.nomor_identitas.length>0 && obj.nomor_npwp.length>0 && obj.nomor_bpjs.length>0 && slip_gaji==='1' && no_sk.length>0 && sku.length>0 && lap_inventory.length>0 ){
                    val_dokumen   = '20';
                    grade_dokumen = 'A+';
                }

                $('#grade_kelengkapan_dokumen').html(grade_dokumen ? grade_dokumen : '-');
                $('#val_kelengkapan_dokumen').html(val_dokumen ? val_dokumen : '-');


                var tempat_tinggal     = $('select[name=tempat_tinggal] option').filter(':selected').val();
                var val_status_rumah   = "";
                var grade_status_rumah = "";
                if(tempat_tinggal==1){
                    val_status_rumah   = '20';
                    grade_status_rumah = 'A+';
                }
                if(tempat_tinggal==2){
                    val_status_rumah   = '15';
                    grade_status_rumah = 'A';
                }
                if(tempat_tinggal==3){
                    val_status_rumah   = '10';
                    grade_status_rumah = 'B';
                }
                if(tempat_tinggal==4 && tempat_tinggal==6){
                    val_status_rumah   = '5';
                    grade_status_rumah = 'C';
                }
                if(tempat_tinggal==5){
                    val_status_rumah   = '2';
                    grade_status_rumah = 'C-';
                }
                $('#grade_status_rumah').html(grade_status_rumah ? grade_status_rumah : '-');
                $('#val_status_rumah').html(val_status_rumah ? val_status_rumah : '-');

                var val_pekerjaan   = "";
                var grade_pekerjaan = "";
                if(obj.bidang_pekerjaan==1 || obj.bidang_pekerjaan==7){
                    val_pekerjaan = '5';
                    grade_pekerjaan = 'C';
                }
                if(obj.bidang_pekerjaan==2 || obj.bidang_pekerjaan==5 || obj.bidang_pekerjaan==6){
                    val_pekerjaan = '10';
                    grade_pekerjaan = 'B';
                }
                if(obj.bidang_pekerjaan==3){
                    val_pekerjaan = '12';
                    grade_pekerjaan = 'B+';
                }
                if(obj.bidang_pekerjaan==4){
                    val_pekerjaan = '15';
                    grade_pekerjaan = 'A';
                }
                $('#grade_status_pekerjaan').html(grade_pekerjaan ? grade_pekerjaan : '-');
                $('#val_status_pekerjaan').html(val_pekerjaan ? val_pekerjaan : '-');

                $("#pengeluaran input[name='net_income']").change(function(){
                    var net_income       = $("#pengeluaran input[name='net_income']").val();
                    console.log(net_income)
                    var val_net_income   = "";
                    var grade_net_income = "";
                    if(net_income>=50000 && net_income<= 150000){
                        val_net_income   = '0';
                        grade_net_income = 'D';
                    }
                    if(net_income>=150000 && net_income<= 300000){
                        val_net_income   = '5';
                        grade_net_income = 'C';
                    }
                    if(net_income>=300000 && net_income<= 600000){
                        val_net_income   = '10';
                        grade_net_income = 'B';
                    }
                    if(net_income>=600000 && net_income<= 1500000){
                        val_net_income   = '15';
                        grade_net_income = 'A';
                    }
                    if(net_income>=1500000){
                        val_net_income   = '20';
                        grade_net_income = 'A+';
                    }
                    $('#grade_net_income').html(grade_net_income ? grade_net_income : '-');
                    $('#val_net_income').html(val_net_income ? val_net_income : 0);


                    var val_final = parseInt(val_dokumen.length>0 ?val_dokumen:0 )+parseInt(val_pekerjaan.length>0?val_pekerjaan:0)+parseInt(val_status_rumah.length>0?val_status_rumah:0)+parseInt(val_net_income.length>0?val_net_income:0);
                    console.log('val_final : '+val_final);
                    var values = "";
                    var grade_scoring = "";

                    if(val_final>=20){
                        values = '20';
                        grade_scoring = 'A+';                    
                    }
                    if(val_final>=15 && val_final<= 19.9){
                        values = '15';
                        grade_scoring = 'A';                    
                    }
                    if(val_final>=12 && val_final<= 14.9){
                        values = '12';
                        grade_scoring = 'B+';                    
                    }
                    if(val_final>=10 && val_final<= 11.9){
                        values = '10';
                        grade_scoring = 'B';                    
                    }
                    if(val_final>=5 && val_final<= 9.9){
                        values = '5';
                        grade_scoring = 'C';                    
                    }
                    if(val_final>=2 && val_final<= 4.9){
                        values = '2';
                        grade_scoring = 'C';                    
                    } 
                    if(val_final<= 1.9){
                        values = '0';
                        grade_scoring = '0';                    
                    }

                    $('#form_pemb #grade').html(grade_scoring ? grade_scoring : '-');
                    $('#form_pemb #value').html(val_final ? val_final : '-');
                });

            });
return false;
});
warnatable();
});
/*
 *  ----------------------- RESET -------------------------------
 */
 $(".reset").click();
});

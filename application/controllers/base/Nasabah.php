<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * Aplikasi AKSIOMA (Aplikasi Keuangan Mikro Masyarakat Ekonomi Syariah) ver. 1.0
* Copyright (c) 2014
*
* file   : base/nasabah.php
* author : Edi Suwoto S.Komp
* email  : edi.suwoto@gmail.com
*/
/*----------------------------------------------------------*/
class Nasabah extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->authlib->cekcontr();
        $this->tema = $this->allfunct->getSetupapp('tema');
        $this->load->model('master_model','master');
        $this->load->model('admin_model','modelku');
        $this->nama_group = $this->authlib->getGroup($this->encrypt->decode($this->session->userdata('id_group')));
        $this->menuact = "base";
        $this->menuactsub = "nasabah";
        $this->load->library('Excel');
    }

    //---- Admin
    function index()
    {
        $data['idpeg'] = $this->session->userdata('username');
        $data['menunya'] = $this->authlib->loadMenu('0',$this->nama_group,$this->menuact,$this->menuactsub);
        $data['tema'] = $this->tema;
        $data['excel'] = true;
        $data['excelclass'] = "excel_nasabah";
        $query = $this->db->query("SELECT kode_produk,grouptabungan_nama FROM master_grouptabungan");
        $data['jenis_tabungan'] = $query->result_array();
        $this->load->view('base/nasabah',$data);
    }
    function cetak_excel(){
        $alldata 	= $this->modelku->getAllNasabah($ff,$if,$fd,$adsc,$awal,$juml);

        $data['hasi'] = $alldata;
        $data['filename'] = "data_nasabah";
        $this->load->view('spreadsheet_view',$data);
    }

    function run_code()
    {
        $query = $this->db->query("SELECT kode FROM bmt_wilayah AS t1 INNER JOIN bmt AS t2 ON t2.wilayah_kerja =t1.kode");
        $data = $query->result_array();
        $cabang = $data[0]["kode"];

        $num = $this->db->count_all_results('tb_nasabah') + 1;
        $paddedNum = sprintf("%03d", $num);

        echo  $cabang."".date('m')."".date('y')."".$paddedNum;
    }
    function cab_code()
    {
        $query = $this->db->query("SELECT kode FROM bmt_wilayah AS t1 INNER JOIN bmt AS t2 ON t2.wilayah_kerja =t1.kode");
        $data = $query->result_array();
        echo $data[0]["kode"];
    }
    /// save new Nasabah
    function saveNasabah(){
        $data = $this->allfunct->securePost();
        if($data['tgl_masuk'] !=""){
            $data['tgl_masuk'] = $this->allfunct->revDate($data['tgl_masuk']);
        }
        if($data['tanggal_lahir'] !=""){
            $data['tanggal_lahir'] = $this->allfunct->revDate($data['tanggal_lahir']);
        }
        if($data['berlaku_identitas_waris'] !=""){
            $data['berlaku_identitas_waris'] = $this->allfunct->revDate($data['berlaku_identitas_waris']);
        }
        if($data['berlaku_identitas'] !=""){
            $data['berlaku_identitas'] = $this->allfunct->revDate($data['berlaku_identitas']);
        }
        $data['create_by'] = $this->session->userdata('username');
        $data['update_by'] = $this->session->userdata('username');
        echo $this->master->simpan('tb_nasabah',$data);
    }
    function editNasabah(){
        $data = $this->allfunct->securePost();
        $id	= $data['nomor_nasabah'];
        unset($data['nomor_nasabah']);
        unset($data['tgl_masuk']);
        if($data['tanggal_lahir'] !=""){
            $data['tanggal_lahir'] = $this->allfunct->revDate($data['tanggal_lahir']);
            $data['berlaku_identitas'] = $this->allfunct->revDate($data['berlaku_identitas']);
            $data['berlaku_identitas_waris'] = $this->allfunct->revDate($data['berlaku_identitas_waris']);
        }
        $data['update_by'] = $this->session->userdata('username');
        $where = array('nomor_nasabah' => $id);
        echo $this->master->update("tb_nasabah",$data,$where);
    }
    function get_nasabah()
    {
        $ff			= $this->input->post('ff'); // Jenis Filter
		$if			= $this->input->post('if'); // Value Filter
		$fd			= $this->input->post('fd'); // Field Sorting
		$adsc		= $this->input->post('adsc'); // Asc or Desc
		$hal		= $this->input->post('hal'); // Offset Limit
		$juml		= $this->input->post('juml'); // Jumlah Limit
		$awal 		= $juml * ($hal - 1);
		$alldata 	= $this->modelku->getAllNasabah($ff,$if,$fd,$adsc,$awal,$juml);
		$records 	= $alldata['numrow'];
		$page_num 	= ceil($records / $juml);
		if ($records > 0)
        {

            $hasil['total'] = $page_num;
            $hasil['alldata'] = $alldata['result'];
            echo json_encode($hasil);
        }
    }
    
    function isi_propinsi()
    {
        $hasil = $this->db->select('kodeBPS,namaProvinsi')->get('provinsi')->result();
        $i=0;
        $pTitle = "<option style=\"background:#EFF1F1\" value=\"0\">--------pilih propinsi-------</option>";
        foreach ($hasil as $row)
        {
            $clr = (($i%2) == 0) ? '#fff' : '#EFF1F1';
            $pTitle .= "<option style=\"background:".$clr."\" value=\"".$row->kodeBPS."\">".$row->namaProvinsi."</option>";
            $i++;
        }
        echo $pTitle;
    }
    function isi_kabupaten()
    {
        $data = $this->allfunct->securePost();
        $prov	= $data['prov'];
        $hasil = $this->db->query("SELECT kodeBPS,namaKabupaten, case when substring(kodeBPS, 3, 1) = '7' then concat('KOTA ', namaKabupaten) else namaKabupaten end AS titlename 
            FROM kabupaten
            WHERE kodeProvinsi='".$prov."' order by namaKabupaten")->result();
        $i=0;
        $pTitle = "<option style=\"background:#EFF1F1\" value=\"0\">--------pilih kabupaten-------</option>";
        foreach ($hasil as $row)
        {
            $clr = (($i%2) == 0) ? '#fff' : '#EFF1F1';
            $item = explode(' ', $row->titlename);
            if($item[0] == "KOTA"){
                $n1 = "KOTA";
                $n2 = $item[1];
            }else{
                $n1 = "KABUPATEN";
                $n2 = $row->titlename;
            }
            $pTitle .= "<option style=\"background:".$clr."\" value=\"".$row->kodeBPS."\">".$n1." ".$n2."</option>";
            $i++;
        }
        echo $pTitle;
    }
    function isi_kecamatan()
    {
        $data = $this->allfunct->securePost();
        $kab	= $data['kab'];
        $hasil = $this->db->query("SELECT kodeBps,namaKecamatan
            FROM kecamatan
            WHERE kodeKabupaten='".$kab."' order by namaKecamatan")->result();
        $i=0;
        $pTitle = "<option style=\"background:#EFF1F1\" value=\"0\">--------pilih kecamatan-------</option>";
        foreach ($hasil as $row)
        {
            $clr = (($i%2) == 0) ? '#fff' : '#EFF1F1';
            $pTitle .= "<option style=\"background:".$clr."\" value=\"".$row->kodeBps."\">".$row->namaKecamatan."</option>";
            $i++;
        }
        echo $pTitle;
    }
    function single_kabupaten()
    {
        $data  = $this->allfunct->securePost();
        $kab   = $data['kab'];
        $query = $this->db->query("SELECT namaKabupaten FROM kabupaten WHERE kodeBPS='".$kab."'");
        $data  = $query->result_array();
        if($query->num_rows() > 0) {
            $pkab = $data[0]["namaKabupaten"];
            echo $pkab;
        }else{
            echo "";
        }
    }
    function single_kecamatan()
    {
        $data  = $this->allfunct->securePost();
        $kec   = $data['kec'];
        $query = $this->db->query("SELECT namaKecamatan FROM kecamatan WHERE kodeBps='".$kec."'");
        $data  = $query->result_array();
        if($query->num_rows() > 0) {
            $pkec = $data[0]["namaKecamatan"];
            echo $pkec;
        }else{
            echo "";
        }
    }

    function get_filter_nasabah()
    {
        $jenis_tabungan = $this->input->post('jenis_tabungan');
        $start_date     = date('Y-m-d',strtotime($this->input->post('start_date')));
        $end_date       = date('Y-m-d',strtotime($this->input->post('end_date')));

        $this->db->select('tb_tabungan.*, gt.*,tb_nasabah.nama, gt.grouptabungan_nama as jenis_tabungan, tb_nasabah.kecamatan, tb_nasabah.kabupaten, tb_nasabah.propinsi');
        $this->db->from('tb_tabungan');
        $this->db->where('jenis_simpanan', $jenis_tabungan);
        $this->db->join('tb_nasabah', 'tb_nasabah.nomor_nasabah=tb_tabungan.nomor_nasabah');
        $this->db->join('master_grouptabungan as gt', 'gt.kode_produk=tb_tabungan.jenis_simpanan');
        $this->db->where('tgl_dibuka >=', $start_date);
        $this->db->where('tgl_dibuka <=', $end_date);
        $this->db->order_by('tgl_dibuka', 'asc');
        $filter_data_nasabah = $this->db->get()->result_array();
        echo json_encode($filter_data_nasabah);
    }

    public function import_excel(){
        if (isset($_FILES["file"]["name"])) {

            $path   = $_FILES["file"]["tmp_name"];
            $object = PHPExcel_IOFactory::load($path);

            foreach($object->getWorksheetIterator() as $worksheet)
            {
                $highestRow    = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();    

                for($row=2; $row<=$highestRow; $row++)
                {
                    $tgl_masuk       = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $nomor_nasabah   = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nama            = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $nama_panggilan  = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $tempat_lahir    = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $tanggal_lahir   = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $jenis_kelamin   = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $agama           = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $pendidikan      = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $nomor_identitas = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

                    if($jenis_kelamin=='laki-laki'){
                        $new_jk = 1;
                    } else {
                        $new_jk = 2;
                    }

                    if(strtolower($agama)=='islam'){
                        $new_agama = 1;
                    } else if(strtolower($agama)=='kristen'){
                        $new_agama = 2;
                    } else if(strtolower($agama)=='hindu'){
                        $new_agama = 3;
                    } else if(strtolower($agama)=='budha'){
                        $new_agama = 4;
                    } else if(strtolower($agama)=='katolik'){
                        $new_agama = 5;
                    } else if(strtolower($agama)=='kepercayaan'){
                        $new_agama = 6;
                    } else{
                        $new_agama = 7;
                    }

                    if(strtoupper($pendidikan)=='SD'){
                        $new_pendidikan = 1;
                    } else if(strtoupper($pendidikan)=='SMP'){
                        $new_pendidikan = 2;
                    } else if(strtoupper($pendidikan)=='SMA' || strtoupper($pendidikan)=='SMU/SMK'){
                        $new_pendidikan = 3;
                    } else if(strtoupper($pendidikan)=='D1'){
                        $new_pendidikan = 4;
                    } else if(strtoupper($pendidikan)=='D2'){
                        $new_pendidikan = 5;
                    } else if(strtoupper($pendidikan)=='D3'){
                        $new_pendidikan = 6;
                    } else if(strtoupper($pendidikan)=='D4'){
                        $new_pendidikan = 7;
                    } else if(strtoupper($pendidikan)=='S1'){
                        $new_pendidikan = 8;
                    } else if(strtoupper($pendidikan)=='S2'){
                        $new_pendidikan = 9;
                    } else if(strtoupper($pendidikan)=='S3'){
                        $new_pendidikan = 10;
                    } else {
                        $new_pendidikan = 11;
                    }

                    $temp_data[] = array(
                        "code_wilayah"    => '01',
                        "tgl_masuk"       => date('Y-m-d', strtotime($tgl_masuk)),
                        "nomor_nasabah"   => $nomor_nasabah,
                        "nama"            => $nama,
                        "nama_pangilan"   => $nama_panggilan,
                        "tempat_lahir"    => $tempat_lahir,
                        "tanggal_lahir"   => date('Y-m-d', strtotime($tanggal_lahir)),
                        "jenis_kelamin"   => $new_jk,
                        "agama"           => $new_agama,
                        "pendidikan"      => $new_pendidikan,
                        "nomor_identitas" => $nomor_identitas,
                        "alamat"          => " ",
                        "kecamatan"       => " ",
                        "kabupaten"       => " ",
                        "propinsi"        => " ",
                        "rtrw"            => " ",
                        "kode_pos"        => " ",
                        "create_by"       => $this->session->userdata('username'),
                        "update_by"       => $this->session->userdata('username')
                    );  
                }
                $this->db->insert_batch('tb_nasabah', $temp_data);
                redirect("base/nasabah");
            }
        }else{
            redirect("base/nasabah");
        }
    }
}


/* End of file */
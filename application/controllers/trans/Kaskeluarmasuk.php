<?php
/*
 * Aplikasi AKSIOMA (Aplikasi Keuangan Mikro Masyarakat Ekonomi Syariah) ver. 1.0
 * Copyright (c) 2014
 *
 * file   : trans/kaskeluarmasuk.php
 * author : Edi Suwoto S.Komp
 * email  : edi.suwoto@gmail.com
 */
/*----------------------------------------------------------*/
class Kaskeluarmasuk extends CI_Controller {

	function __construct()
	{
        parent::__construct();
        $this->authlib->cekcontr();
        $this->tema       = $this->allfunct->getSetupapp('tema');
        $this->load->model('master_model','master');
        $this->load->model('admin_model','modelku');
        $this->nama_group = $this->authlib->getGroup($this->encrypt->decode($this->session->userdata('id_group')));
        $this->menuact    = "transaksikas";
        $this->menuactsub = "kaskeluarmasuk";
        $this->load->library('Excel');
    }

    //---- Admin
    function index()
    {
        $data['idpeg']   = $this->session->userdata('username');
        $data['menunya'] = $this->authlib->loadMenu('0',$this->nama_group,$this->menuact,$this->menuactsub);
        $data['tema']    = $this->tema;
        $this->load->view('trans/kaskeluarmasuk',$data);
    }

    function tarikkas(){
        $data = $this->allfunct->securePost();
        //kas keluar
        if($data['accounttrans_type'] == "02"){
            $data1['accounttrans_date']   = $this->allfunct->revDate($data['tgl_transaksi']);
            $data1['accounttrans_value']  = $this->allfunct->uangDB($data['jumlah']);
            $data1['accounttrans_desc']   = $data['ket'];
            $data1['accounttrans_code']   = $data['nomor_ref']."-01";
            $data1['accounttrans_type']   = "01";
            $data1['accounttrans_listid'] = "19";
            $data1['create_date']         = date("Y-m-d H:i:s");
            $data1['create_by']           = $this->session->userdata('username');
            $data1['update_by']           = $this->session->userdata('username');
            $this->master->simpan('tb_accounttemp',$data1);

            $data2['accounttrans_date']   = $this->allfunct->revDate($data['tgl_transaksi']);
            $data2['accounttrans_value']  = $this->allfunct->uangDB($data['jumlah']);
            $data2['accounttrans_desc']   = $data['ket'];
            $data2['accounttrans_code']   = $data['nomor_ref']."-02";
            $data2['accounttrans_type']   = "02";
            $data2['accounttrans_listid'] = "568";
            $data2['create_date']         = date("Y-m-d H:i:s");
            $data2['create_by']           = $this->session->userdata('username');
            $data2['update_by']           = $this->session->userdata('username');
            echo $this->master->simpan('tb_accounttemp',$data2);

        // kas masuk
        }elseif($data['accounttrans_type'] == "01"){
            $data1['accounttrans_date']   = $this->allfunct->revDate($data['tgl_transaksi']);
            $data1['accounttrans_value']  = $this->allfunct->uangDB($data['jumlah']);
            $data1['accounttrans_desc']   = $data['ket'];
            $data1['accounttrans_code']   = $data['nomor_ref']."-02";
            $data1['accounttrans_type']   = "02";
            $data1['accounttrans_listid'] = "19";
            $data1['create_date']         = date("Y-m-d H:i:s");
            $data1['create_by']           = $this->session->userdata('username');
            $data1['update_by']           = $this->session->userdata('username');
            $this->master->simpan('tb_accounttemp',$data1);

            $data2['accounttrans_date']   = $this->allfunct->revDate($data['tgl_transaksi']);
            $data2['accounttrans_value']  = $this->allfunct->uangDB($data['jumlah']);
            $data2['accounttrans_desc']   = $data['ket'];
            $data2['accounttrans_code']   = $data['nomor_ref']."-01";
            $data2['accounttrans_type']   = "01";
            $data2['accounttrans_listid'] = "568";
            $data2['create_date']         = date("Y-m-d H:i:s");
            $data2['create_by']           = $this->session->userdata('username');
            $data2['update_by']           = $this->session->userdata('username');
            echo $this->master->simpan('tb_accounttemp',$data2);
        }
    }
    function single_pegawai()
    {
        $data = $this->allfunct->securePost();
        $peg	= $data['peg'];
        $query = $this->db->query("SELECT nama_pegawai FROM pegawai WHERE nip='".$peg."'");
        $data = $query->result_array();
        if($query->num_rows() > 0) {
            $ppeg = $data[0]["nama_pegawai"];
            echo $ppeg;
        }else{
            echo "";
        }
    }
    function login()
    {
      $data = $this->allfunct->securePost();
      $login = array($data['username'], $data['password']);
      $resp = $this->authlib->login1($login);
      echo $resp;
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
                $accountrans_date   = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                $accounttrans_code  = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                $accounttrans_type  = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                $accounttrans_value = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                $accounttrans_desc  = $worksheet->getCellByColumnAndRow(4, $row)->getValue();

                if(strtolower($accounttrans_type)=='kas keluar'){
                    $new_accounttrans_type     = '01';
                    $new_accounttrans_listid   = '19';
                    $new_accounttrans_type_o   = '02';
                    $new_accounttrans_listid_o = '568';

                    $temp_data[] = array(
                        "accounttrans_date"   => $this->allfunct->revDate($accountrans_date),
                        "accounttrans_value"  => $this->allfunct->uangDB($accounttrans_value),
                        "accounttrans_desc"   => $accounttrans_desc,
                        "accounttrans_code"   =>  $accounttrans_code."-01",
                        "accounttrans_type"   => $new_accounttrans_type,
                        "accounttrans_listid" => $new_accounttrans_listid,
                        "create_date"         => date("Y-m-d H:i:s"),
                        "create_by"           => $this->session->userdata('username'),
                        "update_by"           => $this->session->userdata('username')
                    );
                    $temp_data_o[] = array(
                        "accounttrans_date"   => $this->allfunct->revDate($accountrans_date),
                        "accounttrans_value"  => $this->allfunct->uangDB($accounttrans_value),
                        "accounttrans_desc"   => $accounttrans_desc,
                        "accounttrans_code"   =>  $accounttrans_code."-02",
                        "accounttrans_type"   => $new_accounttrans_type_o,
                        "accounttrans_listid" => $new_accounttrans_listid_o,
                        "create_date"         => date("Y-m-d H:i:s"),
                        "create_by"           => $this->session->userdata('username'),
                        "update_by"           => $this->session->userdata('username')
                    );
        echo "<pre>";
        echo print_r($temp_data);
        echo "</pre>";
        die();
        
                    // $this->db->insert_batch('tb_accounttemp', $temp_data);
                    // $this->db->insert_batch('tb_accounttemp', $temp_data_o);

                } else {
                    $new_accounttrans_type     = '02';
                    $new_accounttrans_listid   = '19';
                    $new_accounttrans_type_o   = '01';
                    $new_accounttrans_listid_o = '568';

                    $temp_data[] = array(
                        "accounttrans_date"   => $this->allfunct->revDate($accountrans_date),
                        "accounttrans_value"  => $this->allfunct->uangDB($accounttrans_value),
                        "accounttrans_desc"   => $accounttrans_desc,
                        "accounttrans_code"   =>  $accounttrans_code."-02",
                        "accounttrans_type"   => $new_accounttrans_type,
                        "accounttrans_listid" => $new_accounttrans_listid,
                        "create_date"         => date("Y-m-d H:i:s"),
                        "create_by"           => $this->session->userdata('username'),
                        "update_by"           => $this->session->userdata('username')
                    );
                    $temp_data_o[] = array(
                        "accounttrans_date"   => $this->allfunct->revDate($accountrans_date),
                        "accounttrans_value"  => $this->allfunct->uangDB($accounttrans_value),
                        "accounttrans_desc"   => $accounttrans_desc,
                        "accounttrans_code"   =>  $accounttrans_code."-01",
                        "accounttrans_type"   => $new_accounttrans_type_o,
                        "accounttrans_listid" => $new_accounttrans_listid_o,
                        "create_date"         => date("Y-m-d H:i:s"),
                        "create_by"           => $this->session->userdata('username'),
                        "update_by"           => $this->session->userdata('username')
                    );

                    $this->db->insert_batch('tb_accounttemp', $temp_data);
                    $this->db->insert_batch('tb_accounttemp', $temp_data_o);
                }
            }
            redirect("trans/kaskeluarmasuk");
        }
    }else{
        redirect("trans/kaskeluarmasuk");
    }
}

}

/* End of file */
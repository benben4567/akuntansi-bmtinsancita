<?php
/*
 * Aplikasi AKSIOMA (Aplikasi Keuangan Mikro Masyarakat Ekonomi Syariah) ver. 1.0
 * Copyright (c) 2014
 *
 * file   : tool/shu.php
 * author : Edi Suwoto S.Komp
 * email  : edi.suwoto@gmail.com
 */
/*----------------------------------------------------------*/
class Shu extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->authlib->cekcontr();
        $this->tema       = $this->allfunct->getSetupapp('tema');
        $this->load->model('master_model','master');
        $this->load->model('admin_model','modelku');
        $this->nama_group = $this->authlib->getGroup($this->encrypt->decode($this->session->userdata('id_group')));
        $this->menuact    = "tools";
        $this->menuactsub = "shu";
    }

    function index()
    {
        $data['idpeg']   = $this->session->userdata('username');
        $data['menunya'] = $this->authlib->loadMenu('0', $this->nama_group, $this->menuact, $this->menuactsub);
        $data['tema']    = $this->tema;
        $this->load->view('tool/shu',$data);
    }

    function getdata()
    {
        // $id         = $this->input->post('id');
        $id         = '5,6,7';
        $start_date = $this->allfunct->revDate($this->input->post('start_date'));
        $end_date   = $this->allfunct->revDate($this->input->post('end_date'));
        $hasil      = $this->db->query("SELECT listakun_id,listakun_code,listakun_name,listakun_pattern FROM coa_listakun WHERE listakun_parent = '0' AND listakun_pattern IN(".$id.") ORDER BY `coa_listakun`.`listakun_code` ASC")->result();

            $isi      = "";
            $totalLabaAll = 0;
            foreach ($hasil as $row)
            {
                $totalLaba = 0;
                $hasill    = $this->db->query("SELECT listakun_id,listakun_code,listakun_name FROM coa_listakun WHERE listakun_alias='GL' AND listakun_parent = '".$row->listakun_id."' ORDER BY `coa_listakun`.`listakun_code` ASC")->result();
                foreach ($hasill as $val) 
                {
                    $totaln  = 0;
                    $totaln1 = 0;
                    $hasilll = $this->db->query("SELECT listakun_id,listakun_code,listakun_name FROM coa_listakun WHERE listakun_parent = '".$val->listakun_id."'")->result();
                    foreach ($hasilll as $val1) 
                    {
                        $hasillll = $this->db->query("SELECT listakun_id,listakun_code,listakun_name FROM coa_listakun WHERE listakun_parent = '".$val1->listakun_id."'")->result();
                        foreach ($hasillll as $val2) 
                        {
                            $nilai2 = $this->nilaivalue($val2->listakun_id,$start_date,$end_date);
                            $totaln += $nilai2;
                        }
                    }
                    $totalLaba += $totaln;
                }
                $item = substr($row->listakun_pattern,0,2);
                if(($item == "5")||($item == "6")){
                    $totalLabaAll += $totalLaba;
                }else{
                    $totalLabaAll -= $totalLaba;
                }
            }
            $total = 500000;
            echo json_encode($totalLabaAll);

        }


        function nilaivalue($id,$start_date,$end_date){
        //$query = $this->db->query("SELECT SUM(CASE WHEN accounttrans_type like '01' THEN accounttrans_value END) AS jlh FROM tb_accounttrans WHERE accounttrans_listid=$id AND accounttrans_date BETWEEN '$start_date' AND '$end_date'");
        //$data = $query->result_array();
        //return $data[0]["jlh"] * 1;
            if(($id =="349")||($id =="348")||($id =="350")||($id =="352")||($id =="353") ||($id =="342")||($id =="343") ||($id == "325")||($id == "326")||($id == "327")||($id == "328")||($id == "329")||($id == "330") || ($id == "334")||($id == "335")||($id == "336")||($id == "337")||($id == "338")||($id == "339")||($id == "448")||($id == "449")||($id == "450")||($id == "451")){
                $query1 = $this->db->query("SELECT SUM(CASE WHEN accounttrans_type like '02' THEN accounttrans_value END) AS jlh1 FROM tb_accounttrans WHERE accounttrans_listid=$id AND accounttrans_date BETWEEN '$start_date' AND '$end_date'");
            }else{
                $query1 = $this->db->query("SELECT SUM(CASE WHEN accounttrans_type like '01' THEN accounttrans_value END) AS jlh1 FROM tb_accounttrans WHERE accounttrans_listid=$id AND accounttrans_date BETWEEN '$start_date' AND '$end_date'");
            }
            $query2 = $this->db->query("SELECT SUM(CASE WHEN accounttrans_type like '02' THEN accounttrans_value END) AS jlh2 FROM tb_accounttrans WHERE accounttrans_listid=$id AND accounttrans_date BETWEEN '$start_date' AND '$end_date'");
            $query3 = $this->db->query("SELECT listakun_pattern FROM coa_listakun WHERE listakun_id=$id");
            $data1  = $query1->result_array();

            $data2  = $query2->result_array();
            $data3  = $query3->result_array();
            $item   = substr($data3[0]["listakun_pattern"],0,2);
            if($item == "5*"){
            ///525.02
            ///525.32
            ///525.52
                if(($id =="349")||($id =="348")||($id =="350")||($id =="352")||($id =="353") ||($id =="342")||($id =="343") ||($id == "325")||($id == "326")||($id == "327")||($id == "328")||($id == "329")||($id == "330") || ($id == "334")||($id == "335")||($id == "336")||($id == "337")||($id == "338")||($id == "339")){
                    $trans  = $data1[0]["jlh1"] * -1;
                }else{
                    $trans  = $data1[0]["jlh1"] * 1;
                }
            }elseif($item == "6*"){
                $trans  = $data1[0]["jlh1"] * -1;
            }elseif($item == "7*"){
                $trans  = $data2[0]["jlh2"] * 1;
            }else{
                $trans  = ($data2[0]["jlh2"] - $data1[0]["jlh1"]) * 1;
            }
            return $trans;
        }

        function single_pegawai()
        {
            $data  = $this->allfunct->securePost();
            $peg   = $data['peg'];
            $query = $this->db->query("SELECT nama_pegawai FROM pegawai WHERE nip='".$peg."'");
            $data  = $query->result_array();
            if($query->num_rows() > 0) {
                $ppeg = $data[0]["nama_pegawai"];
                echo $ppeg;
            }else{
                echo "";
            }
        }
        function login()
        {
            $data  = $this->allfunct->securePost();
            $login = array($data['username'], $data['password']);
            $resp  = $this->authlib->login1($login);
            echo $resp;
        }
    }
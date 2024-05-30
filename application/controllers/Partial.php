<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Partial extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_partial');
    }
    public function index()
    {
        $data['title'] = 'Partial Stok';
    	$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('partial/index');
		$this->load->view('v_template_admin/admin_footer');
    }
    function get_data(){

        $where = array('pembelian_po' => 0,'pembelian_hapus' => 0);

        $data = $this->m_partial->get_datatables($where);
        $total = $this->m_partial->count_all($where);
        $filter = $this->m_partial->count_filtered($where);
 
        $output = array(
            "draw" => $_GET["draw"],
            "recordsTotal" => $total,
            "recordsFiltered" => $filter,
            "data" => $data,
        );

        echo json_encode($output);
    } 
    function proses($id){

       //data
        $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");

        //rekening
        $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

        //kontak
        $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

        //barang
        $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_id > 0");

        //gudang
        $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0"); 

        //ekspedisi
        $data['ekspedisi_data'] = $this->query_builder->view("SELECT * FROM t_ekspedisi WHERE ekspedisi_hapus = 0");

        $data["title"] = 'Partial Stok';

        $this->load->view('v_template_admin/admin_header',$data);
        $this->load->view('partial/form');
        $this->load->view('partial/form_edit');
        $this->load->view('v_template_admin/admin_footer');
    }
    function get_pembelian($nomor){
        //pembelian barang
        $db = $this->query_builder->view("SELECT *, IF(ISNULL(c.pembelian_partial_berat), a.pembelian_barang_berat, a.pembelian_barang_berat - SUM(c.pembelian_partial_berat)) AS berat, IF(ISNULL(c.pembelian_partial_panjang), a.pembelian_barang_panjang, a.pembelian_barang_panjang - SUM(c.pembelian_partial_panjang)) AS panjang FROM t_pembelian_barang as a JOIN t_bahan as b ON a.pembelian_barang_barang = b.bahan_id LEFT JOIN t_pembelian_partial AS c ON a.pembelian_barang_id = c.pembelian_partial_join WHERE a.pembelian_barang_nomor = '$nomor' GROUP BY a.pembelian_barang_id");
        echo json_encode($db);
    }
    function save(){

        $nomor = strip_tags(@$_POST['nomor']);
        $berat = $_POST['berat'];
        $panjang = $_POST['panjang'];
        $id = @$_POST['id'];
        
        for ($i = 0; $i < count($berat); ++$i) {

            $set = array(
                    'pembelian_partial_nomor' => $nomor,
                    'pembelian_partial_join' => strip_tags($id[$i]),
                    'pembelian_partial_barang' => strip_tags(@$_POST['barang'][$i]),
                    'pembelian_partial_berat' => strip_tags(@$berat[$i]),
                    'pembelian_partial_panjang' => strip_tags(@$panjang[$i]), 
                );

            $db = $this->query_builder->add('t_pembelian_partial',$set);
        }

        if ($db == 1) {

            //update stok bahan & kartu stok
            $this->partial_stok->pembelian();
            $this->stok->transaksi();
            $this->kartu->add($nomor, 'pembelian');

            $this->session->set_flashdata('success', 'Data berhasil di simpan');
        }else{
            $this->session->set_flashdata('gagal', 'Data gagal di simpan');
        }

        redirect(base_url('partial'));
    }
}
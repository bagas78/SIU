<?php
class Produk extends CI_Controller{

	function __construct(){  
		parent::__construct();
		$this->load->model('m_produk');
		$this->load->model('m_warna');
		$this->load->model('m_jenis');
		$this->load->model('m_produk_barang');
	}  
	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Master Produk';

		    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");
		    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('produk/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login')); 
		}
	} 
	function get_data(){

		$where = array('produk_hapus' => 0);

	    $data = $this->m_produk->get_datatables($where);
		$total = $this->m_produk->count_all($where);
		$filter = $this->m_produk->count_filtered($where);

		$output = array( 
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}

	function add()
	{ 
		$data['title'] = 'Master Produk';

		//satuan
		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

		//generate kode
	    $get = $this->query_builder->count("SELECT * FROM t_produk");
	    $data['kode'] = 'MP00'.($get+1);

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produk/form');
	    $this->load->view('v_template_admin/admin_footer');
	}

	function save()
	{
		$kode = strip_tags($_POST['kode']);

		$cek = $this->query_builder->view_row("SELECT * FROM t_produk WHERE produk_kode = '$kode' AND produk_hapus = 0");

		if (@!$cek) {
				
			$set = array(
							'produk_kode' => $kode,
							'produk_nama' => strip_tags($_POST['nama']),
							'produk_merk' => strip_tags($_POST['merk']),
							'produk_konversi' => strip_tags($_POST['koversi']),
							'produk_ketebalan' => strip_tags($_POST['ketebalan']),
							'produk_keterangan' => strip_tags($_POST['keterangan']),
							'produk_colly' => strip_tags($_POST['colly']),
						);

			$db = $this->query_builder->add('t_produk',$set);

			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di tambah');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di tambah');
			}

		} else {

			$this->session->set_flashdata('gagal','Kode barang sudah ada');
		}
		
		redirect(base_url('produk'));
	}

	function edit($id){
		$data['title'] = 'Master Produk';

		//satuan
		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_produk WHERE produk_id = '$id'");

		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('produk/form');
	    $this->load->view('produk/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){

		$kode = strip_tags($_POST['kode']);

		$cek = $this->query_builder->view_row("SELECT * FROM t_produk WHERE produk_kode = '$kode' AND produk_hapus = 0 AND produk_id != '$id'");

		if (@!$cek) {
			
			$set = array(
							'produk_kode' => strip_tags($_POST['kode']),
							'produk_nama' => strip_tags($_POST['nama']),
							'produk_merk' => strip_tags($_POST['merk']),
							'produk_konversi' => strip_tags($_POST['konversi']),
							'produk_ketebalan' => strip_tags($_POST['ketebalan']),
							'produk_keterangan' => strip_tags($_POST['keterangan']),
							'produk_colly' => strip_tags($_POST['colly']),
						);

			$where = ['produk_id' => $id];
			$db = $this->query_builder->update('t_produk',$set,$where);
			
			if ($db == 1) {
				$this->session->set_flashdata('success','Data berhasil di rubah');
			} else {
				$this->session->set_flashdata('gagal','Data gagal di rubah');
			}

		}else{

			$this->session->set_flashdata('gagal','Kode produk sudah ada');
		}
		
		redirect(base_url('produk'));
	}
	function delete($id){

		$set = ['produk_hapus' => 1];
		$where = ['produk_id' => $id];
		$db = $this->query_builder->update('t_produk',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}
		
		redirect(base_url('produk'));
	}
	function harga(){

		//value
		$harga = strip_tags($_POST['harga']);
		$gudang = strip_tags($_POST['gudang']);
		$produk = strip_tags($_POST['produk']);

		//update
		$set = ['produk_gudang_harga' => $harga];
		$where = ['produk_gudang_gudang' => $gudang, 'produk_gudang_produk' => $produk];
		$db = $this->query_builder->update('t_produk_gudang',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}
		
		redirect(base_url('produk'));
	}
}
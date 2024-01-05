<?php
class Bahan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_bahan');
	}  

	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data["title"] = 'bahan';

		    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('bahan/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function serverside($where,$model){
	    $data = $this->$model->get_datatables($where);
		$total = $this->$model->count_all($where);
		$filter = $this->$model->count_filtered($where);
 
		$output = array(
			"draw" => $_GET["draw"],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);

		return $output;
	} 
	function get_data($filter = 'all'){
		
		$model = 'm_bahan';

		if ($filter == 'all') {
			$where = array('bahan_hapus' => 0);
		}else{
			$where = array('bahan_hapus' => 0, );
		}
		
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	} 
	function add(){

		$data["title"] = 'bahan';
		$data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");
	    
	    //generate kde
	    $bh = $this->query_builder->count("SELECT * FROM t_bahan WHERE bahan_kode != 'BH000'");
	    $data['kode'] = 'BH00'.($bh+1);


	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('bahan/add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function save(){
		
		$set = array(
						'bahan_kode' => strip_tags($_POST['kode']),
						'bahan_nama' => strip_tags($_POST['nama']),
						'bahan_satuan' => strip_tags($_POST['satuan']),
						'bahan_kategori' => strip_tags($_POST['kategori']),
						'bahan_harga' => strip_tags($_POST['harga']),
					);

		$db = $this->query_builder->add('t_bahan',$set);

		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('bahan'));
	}
	function edit($id){
		
		$data["title"] = 'bahan';

	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_bahan as a LEFT JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id WHERE a.bahan_id = '$id'");
	    $data['satuan_data'] = $this->query_builder->view("SELECT * FROM t_satuan WHERE satuan_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('bahan/add');
	    $this->load->view('bahan/edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function update($id){
		
		$set = array(
						'bahan_nama' => strip_tags($_POST['nama']),
						'bahan_satuan' => strip_tags($_POST['satuan']),
						'bahan_kategori' => strip_tags($_POST['kategori']),
						'bahan_harga' => strip_tags($_POST['harga']),
					);

		$where = ['bahan_id' => $id];
		$db = $this->query_builder->update('t_bahan',$set,$where);
		
		if ($db == 1) {
			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('bahan'));
	}
	function delete($id){

		$set = ["bahan_hapus" => 1];
		$where = ["bahan_id" => $id];
		$db = $this->query_builder->update("t_bahan",$set,$where);

		if ($db == 1) {
			
			//update stok bahan
			$this->stok->update_bahan();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('bahan'));
	}
}
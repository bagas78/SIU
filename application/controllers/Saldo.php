<?php
class Saldo extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_saldo');
	}  

	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data["title"] = 'Saldo';
		    $data["rekening_data"] = $this->query_builder->view('SELECT * FROM t_rekening WHERE rekening_hapus = 0');
		    $data["total_plus"] = $this->query_builder->view_row("SELECT SUM(saldo_nominal) as saldo FROM t_saldo WHERE saldo_hapus = 0 AND saldo_jenis = 'setor'");
		    $data["total_min"] = $this->query_builder->view_row("SELECT SUM(saldo_nominal) as saldo FROM t_saldo WHERE saldo_hapus = 0 AND saldo_jenis = 'tarik'");

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('saldo/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function get_data(){
        $where = array('saldo_hapus' => 0);

        $data   = $this->m_saldo->get_datatables($where);
        $total  = $this->m_saldo->count_all($where);
        $filter = $this->m_saldo->count_filtered($where);

        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $total,
            "recordsFiltered" => $filter,
            "data" => $data,
        );
        echo json_encode($output);
    }
	function save(){
		
		$set = array(
						'saldo_nominal' => strip_tags(str_replace(',', '', $_POST['nominal'])),
						'saldo_rekening' => strip_tags($_POST['rekening']),
						'saldo_jenis' => strip_tags($_POST['jenis']),
						'saldo_keterangan' => strip_tags($_POST['keterangan']),
						'saldo_sumber' => 'langsung',
					);

		$db = $this->query_builder->add('t_saldo',$set);

		if ($db == 1) {
			$this->session->set_userdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_userdata('gagal','Data gagal di tambah');
		}
		
		redirect(base_url('saldo'));
	}
	function update($id){
		
		$set = array(
						'saldo_nominal' => strip_tags(str_replace(',', '', $_POST['nominal'])),
						'saldo_rekening' => strip_tags($_POST['rekening']),
						'saldo_jenis' => strip_tags($_POST['jenis']),
						'saldo_keterangan' => strip_tags($_POST['keterangan']),
					);

		$where = ['bahan_id' => $id];
		$db = $this->query_builder->update('t_saldo',$set,$where);
		
		if ($db == 1) {
			$this->session->set_userdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_userdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('saldo'));
	}
	function delete($id){

		$set = ["saldo_hapus" => 1];
		$where = ["saldo_id" => $id];
		$db = $this->query_builder->update("t_saldo",$set,$where);

		if ($db == 1) {
			
			//update stok bahan
			//$this->stok->transaksi();

			$this->session->set_userdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_userdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('saldo'));
	}
}
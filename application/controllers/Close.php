<?php
class Close extends CI_Controller{ 

	function __construct(){  
		parent::__construct();
		$this->load->model('m_pembelian_close');
		$this->load->model('m_pembelian_umum_close');
		$this->load->model('m_penjualan_close');
		$this->load->model('m_produksi_produk_close');
		$this->load->model('m_produksi_bahan_close');
	}  
	function kasir(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'Laporan Kasir';
		    
		    //post
		    $user = @$_POST['user'];
		    $tanggal = @$_POST['tanggal'];

		    $data['user_data'] = $this->query_builder->view("SELECT * FROM t_user WHERE user_hapus = 0");

		    if (@$user && $tanggal) {
		    	
		    	$data['pembelian_total'] = $this->query_builder->view_row("SELECT SUM(b.pembelian_barang_total) AS total FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_hapus = 0 AND a.pembelian_proses = 1 AND a.pembelian_user = '$user' AND a.pembelian_tanggal = '$tanggal'");

		    	$data['pembelian_umum_total'] = $this->query_builder->view_row("SELECT SUM(b.pembelian_umum_barang_subtotal) AS total FROM t_pembelian_umum AS a JOIN t_pembelian_umum_barang AS b ON a.pembelian_umum_nomor = b.pembelian_umum_barang_nomor WHERE a.pembelian_umum_hapus = 0 AND a.pembelian_umum_user = '$user' AND a.pembelian_umum_tanggal = '$tanggal'");

		    	$data['penjualan_total'] = $this->query_builder->view_row("SELECT SUM(b.penjualan_barang_total) AS total FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor WHERE a.penjualan_hapus = 0 AND a.penjualan_proses = 1 AND a.penjualan_user = '$user' AND a.penjualan_tanggal = '$tanggal'");

		    	$data['produksi_produk_total'] = $this->query_builder->view_row("SELECT SUM(b.produksi_produksi_panjang_total) AS total FROM t_produksi AS a JOIN t_produksi_produksi AS b ON a.produksi_nomor = b.produksi_produksi_nomor WHERE a.produksi_hapus = 0 AND b.produksi_produksi_status = 1 AND a.produksi_user = '$user' AND a.produksi_tanggal = '$tanggal'");

		    	$data['produksi_bahan_total'] = $this->query_builder->view_row("SELECT SUM(b.produksi_barang_total) AS total FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor WHERE a.produksi_hapus = 0 AND b.produksi_barang_status = 1 AND a.produksi_user = '$user' AND a.produksi_tanggal = '$tanggal'");

			    $data['user_x'] = @$user;
			    $data['tanggal_x'] = @$tanggal;	
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('close/index');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login')); 
		}
	} 
	function get_pembelian($user, $tanggal){

		$where = array('pembelian_hapus' => 0, 'pembelian_user' => $user, 'pembelian_tanggal' => $tanggal, 'pembelian_proses' => 1);

	    $data = $this->m_pembelian_close->get_datatables($where);
		$total = $this->m_pembelian_close->count_all($where);
		$filter = $this->m_pembelian_close->count_filtered($where);

		$output = array( 
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function get_pembelian_umum($user, $tanggal){

		$where = array('pembelian_umum_hapus' => 0, 'pembelian_umum_user' => $user, 'pembelian_umum_tanggal' => $tanggal);

	    $data = $this->m_pembelian_umum_close->get_datatables($where);
		$total = $this->m_pembelian_umum_close->count_all($where);
		$filter = $this->m_pembelian_umum_close->count_filtered($where);

		$output = array( 
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function get_penjualan($user, $tanggal){

		$where = array('penjualan_hapus' => 0, 'penjualan_user' => $user, 'penjualan_tanggal' => $tanggal, 'penjualan_proses' => 1);

	    $data = $this->m_penjualan_close->get_datatables($where);
		$total = $this->m_penjualan_close->count_all($where);
		$filter = $this->m_penjualan_close->count_filtered($where);

		$output = array( 
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function get_produksi_produk($user, $tanggal){

		$where = array('produksi_hapus' => 0, 'produksi_user' => $user, 'produksi_tanggal' => $tanggal, 'produksi_produksi_status' => 1);

	    $data = $this->m_produksi_produk_close->get_datatables($where);
		$total = $this->m_produksi_produk_close->count_all($where);
		$filter = $this->m_produksi_produk_close->count_filtered($where);

		$output = array( 
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
	function get_produksi_bahan($user, $tanggal){

		$where = array('produksi_hapus' => 0, 'produksi_user' => $user, 'produksi_tanggal' => $tanggal, 'produksi_barang_status' => 1);

	    $data = $this->m_produksi_bahan_close->get_datatables($where);
		$total = $this->m_produksi_bahan_close->count_all($where);
		$filter = $this->m_produksi_bahan_close->count_filtered($where);

		$output = array( 
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
		//output dalam format JSON
		echo json_encode($output);
	}
}
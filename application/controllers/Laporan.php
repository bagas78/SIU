<?php
class Laporan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_bahan');
		$this->load->model('m_produk');
		$this->load->model('m_produk_stok');
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
	/////////////////////////////////////////////////////////////

	function stok_bahan()
	{
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/stok_bahan');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}
	function get_bahan_data()
	{
		if(isset($_GET['reminder'])) {
		    $where = array('bahan_hapus' => 0, 'bahan_id <>' => 0, 'bahan_stok <' => 5);
		} else {
		    $where = array('bahan_hapus' => 0, 'gudang_nama !=' => null);
		}

		$model = 'm_bahan';
		// $where = array('bahan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function stok_produk(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/stok_produk');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function get_produk_data(){
 
		$model = 'm_produk_stok';
		$where = array('produk_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}

	function produksi()
	{
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];

		    	$data['data'] = $this->query_builder->view("SELECT e.gudang_nama AS gudang ,a.produksi_produksi_nomor AS nomor, d.user_name AS shift, c.produk_nama AS produk, a.produksi_produksi_panjang AS jumlah, a.produksi_produksi_tanggal AS tanggal FROM t_produksi_produksi AS a JOIN t_produksi AS b ON a.produksi_produksi_nomor = b.produksi_nomor JOIN t_produk AS c ON a.produksi_produksi_produk = c.produk_id JOIN t_user AS d ON b.produksi_user = d.user_id JOIN t_gudang AS e ON b.produksi_gudang = e.gudang_id WHERE b.produksi_hapus = 0 AND b.produksi_proses = 1 AND a.produksi_produksi_tanggal = '$filter'");

		    } else {

		    	$data['data'] = $this->query_builder->view("SELECT e.gudang_nama AS gudang ,a.produksi_produksi_nomor AS nomor, d.user_name AS shift, c.produk_nama AS produk, a.produksi_produksi_panjang AS jumlah, a.produksi_produksi_tanggal AS tanggal FROM t_produksi_produksi AS a JOIN t_produksi AS b ON a.produksi_produksi_nomor = b.produksi_nomor JOIN t_produk AS c ON a.produksi_produksi_produk = c.produk_id JOIN t_user AS d ON b.produksi_user = d.user_id JOIN t_gudang AS e ON b.produksi_gudang = e.gudang_id WHERE b.produksi_hapus = 0 AND b.produksi_proses = 1");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/produksi');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}

	function pembelian_bahan()
	{
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];

		    	$data['data'] = $this->query_builder->view("SELECT d.gudang_nama AS gudang, b.pembelian_barang_harga AS harga ,b.pembelian_barang_total AS total ,a.pembelian_nomor AS nomor, c.bahan_nama AS bahan, b.pembelian_barang_berat AS berat, b.pembelian_barang_panjang AS panjang, a.pembelian_tanggal AS tanggal FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_bahan AS c ON b.pembelian_barang_barang = c.bahan_id JOIN t_gudang AS d ON a.pembelian_gudang = d.gudang_id WHERE a.pembelian_po = 0 AND a.pembelian_hapus = 0 AND pembelian_tanggal = '$filter'");

		    } else {

		    	$data['data'] = $this->query_builder->view("SELECT d.gudang_nama AS gudang, b.pembelian_barang_harga AS harga ,b.pembelian_barang_total AS total ,a.pembelian_nomor AS nomor, c.bahan_nama AS bahan, b.pembelian_barang_berat AS berat, b.pembelian_barang_panjang AS panjang, a.pembelian_tanggal AS tanggal FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_bahan AS c ON b.pembelian_barang_barang = c.bahan_id JOIN t_gudang AS d ON a.pembelian_gudang = d.gudang_id WHERE a.pembelian_po = 0 AND a.pembelian_hapus = 0");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pembelian_bahan');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}

	function pembelian_umum()
	{
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    	
		    	$data['data'] = $this->query_builder->view("SELECT c.gudang_nama AS gudang, b.pembelian_umum_barang_barang AS barang, b.pembelian_umum_barang_qty AS jumlah, b.pembelian_umum_barang_harga AS harga, b.pembelian_umum_barang_subtotal AS total FROM t_pembelian_umum AS a JOIN t_pembelian_umum_barang AS b ON a.pembelian_umum_nomor = b.pembelian_umum_barang_nomor JOIN t_gudang AS c ON a.pembelian_umum_gudang = c.gudang_id WHERE a.pembelian_umum_hapus = 0 AND a.pembelian_umum_tanggal = '$filter'");

		    } else {

		    	$data['data'] = $this->query_builder->view("SELECT c.gudang_nama AS gudang, b.pembelian_umum_barang_barang AS barang, b.pembelian_umum_barang_qty AS jumlah, b.pembelian_umum_barang_harga AS harga, b.pembelian_umum_barang_subtotal AS total FROM t_pembelian_umum AS a JOIN t_pembelian_umum_barang AS b ON a.pembelian_umum_nomor = b.pembelian_umum_barang_nomor JOIN t_gudang AS c ON a.pembelian_umum_gudang = c.gudang_id WHERE a.pembelian_umum_hapus = 0");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pembelian_umum');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}

	function pelunasan_bahan()
	{
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    	
		    	$data['data'] = $this->query_builder->view("SELECT b.gudang_nama AS gudang, a.pembelian_nomor AS nomor, a.pembelian_grandtotal AS total, a.pembelian_pelunasan AS pelunasan FROM t_pembelian AS a JOIN t_gudang AS b ON a.pembelian_gudang = b.gudang_id WHERE a.pembelian_hapus = 0 AND a.pembelian_pelunasan != '' AND pembelian_pelunasan = '$filter'");

		    } else {

		    	$data['data'] = $this->query_builder->view("SELECT b.gudang_nama AS gudang, a.pembelian_nomor AS nomor, a.pembelian_grandtotal AS total, a.pembelian_pelunasan AS pelunasan FROM t_pembelian AS a JOIN t_gudang AS b ON a.pembelian_gudang = b.gudang_id WHERE a.pembelian_hapus = 0 AND a.pembelian_pelunasan != ''");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pelunasan_bahan');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}

	function pelunasan_umum()
	{
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];

		    	$data['data'] = $this->query_builder->view("SELECT b.gudang_nama AS gudang, a.pembelian_umum_nomor AS nomor, a.pembelian_umum_total AS total, a.pembelian_umum_pelunasan AS pelunasan FROM t_pembelian_umum AS a JOIN t_gudang AS b ON a.pembelian_umum_gudang = b.gudang_id WHERE a.pembelian_umum_hapus = 0 AND a.pembelian_umum_pelunasan != '' AND pembelian_umum_pelunasan = '$filter'");

		    } else {

		    	$data['data'] = $this->query_builder->view("SELECT b.gudang_nama AS gudang, a.pembelian_umum_nomor AS nomor, a.pembelian_umum_total AS total, a.pembelian_umum_pelunasan AS pelunasan FROM t_pembelian_umum AS a JOIN t_gudang AS b ON a.pembelian_umum_gudang = b.gudang_id WHERE a.pembelian_umum_hapus = 0 AND a.pembelian_umum_pelunasan != ''");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pelunasan_umum');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}

	function penjualan()
	{
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];

		    	$data['data'] = $this->query_builder->view("SELECT c.gudang_nama AS gudang, a.penjualan_nomor AS nomor, d.produk_nama AS produk, b.penjualan_barang_panjang AS panjang, b.penjualan_barang_total AS total, a.penjualan_tanggal AS tanggal FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_gudang AS c ON a.penjualan_gudang = c.gudang_id JOIN t_produk AS d ON b.penjualan_barang_barang = d.produk_id WHERE a.penjualan_hapus = 0 AND a.penjualan_tanggal = '$filter'");

		    } else {

		    	$data['data'] = $this->query_builder->view("SELECT c.gudang_nama AS gudang, a.penjualan_nomor AS nomor, d.produk_nama AS produk, b.penjualan_barang_panjang AS panjang, b.penjualan_barang_total AS total, a.penjualan_tanggal AS tanggal FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_gudang AS c ON a.penjualan_gudang = c.gudang_id JOIN t_produk AS d ON b.penjualan_barang_barang = d.produk_id WHERE a.penjualan_hapus = 0");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/penjualan');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}
	function pelunasan_piutang(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];

		    	$data['data'] = $this->query_builder->view("SELECT b.gudang_nama AS gudang, a.penjualan_nomor AS nomor, a.penjualan_grandtotal AS total, a.penjualan_pelunasan AS pelunasan FROM t_penjualan AS a JOIN t_gudang AS b ON a.penjualan_gudang = b.gudang_id WHERE a.penjualan_hapus = 0 AND a.penjualan_pelunasan != '' AND a.penjualan_pelunasan = '$filter'");
		    }else{

		    	$data['data'] = $this->query_builder->view("SELECT b.gudang_nama AS gudang, a.penjualan_nomor AS nomor, a.penjualan_grandtotal AS total, a.penjualan_pelunasan AS pelunasan FROM t_penjualan AS a JOIN t_gudang AS b ON a.penjualan_gudang = b.gudang_id WHERE a.penjualan_hapus = 0 AND a.penjualan_pelunasan != ''");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/pelunasan_piutang');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}

	function hutang_bahan()
	{
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];
		    	
		    	$data['data'] = $this->query_builder->view("SELECT a.pembelian_status AS status, b.gudang_nama AS gudang, a.pembelian_nomor AS nomor, a.pembelian_grandtotal AS total, a.pembelian_pelunasan AS pelunasan FROM t_pembelian AS a JOIN t_gudang AS b ON a.pembelian_gudang = b.gudang_id WHERE a.pembelian_hapus = 0 AND a.pembelian_status = 'belum' OR a.pembelian_pelunasan != '' AND pembelian_pelunasan = '$filter'");

		    } else {

		    	$data['data'] = $this->query_builder->view("SELECT a.pembelian_status AS status, b.gudang_nama AS gudang, a.pembelian_nomor AS nomor, a.pembelian_grandtotal AS total, a.pembelian_pelunasan AS pelunasan FROM t_pembelian AS a JOIN t_gudang AS b ON a.pembelian_gudang = b.gudang_id WHERE a.pembelian_hapus = 0 AND a.pembelian_status = 'belum' OR a.pembelian_pelunasan != ''");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/hutang_bahan');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}

	function hutang_umum()
	{
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];

		    	$data['data'] = $this->query_builder->view("SELECT a.pembelian_umum_status AS status, b.gudang_nama AS gudang, a.pembelian_umum_nomor AS nomor, a.pembelian_umum_total AS total, a.pembelian_umum_pelunasan AS pelunasan FROM t_pembelian_umum AS a JOIN t_gudang AS b ON a.pembelian_umum_gudang = b.gudang_id WHERE a.pembelian_umum_hapus = 0 AND a.pembelian_umum_status = 'belum' OR a.pembelian_umum_pelunasan != '' AND pembelian_umum_pelunasan = '$filter'");

		    } else {

		    	$data['data'] = $this->query_builder->view("SELECT a.pembelian_umum_status AS status, b.gudang_nama AS gudang, a.pembelian_umum_nomor AS nomor, a.pembelian_umum_total AS total, a.pembelian_umum_pelunasan AS pelunasan FROM t_pembelian_umum AS a JOIN t_gudang AS b ON a.pembelian_umum_gudang = b.gudang_id WHERE a.pembelian_umum_hapus = 0 AND a.pembelian_umum_status = 'belum' OR a.pembelian_umum_pelunasan != ''");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/hutang_umum');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}
	function piutang(){
		if ( $this->session->userdata('login') == 1) {
		    $data['title'] = 'laporan';

		    if (@$_POST['filter']) {
		    	
		    	$filter = @$_POST['filter'];

		    	$data['data'] = $this->query_builder->view("SELECT a.penjualan_status AS status, b.gudang_nama AS gudang, a.penjualan_nomor AS nomor, a.penjualan_grandtotal AS total, a.penjualan_pelunasan AS pelunasan FROM t_penjualan AS a JOIN t_gudang AS b ON a.penjualan_gudang = b.gudang_id WHERE a.penjualan_hapus = 0 AND a.penjualan_pelunasan = 1 AND a.penjualan_pelunasan = '$filter'");
		    }else{

		    	$data['data'] = $this->query_builder->view("SELECT a.penjualan_status AS status, b.gudang_nama AS gudang, a.penjualan_nomor AS nomor, a.penjualan_grandtotal AS total, a.penjualan_pelunasan AS pelunasan FROM t_penjualan AS a JOIN t_gudang AS b ON a.penjualan_gudang = b.gudang_id WHERE a.penjualan_hapus = 0 AND a.penjualan_piutang = 1");
		    }

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('laporan/piutang');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
}
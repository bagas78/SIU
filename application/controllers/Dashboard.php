<?php
class Dashboard extends CI_Controller{

	function __construct(){
		parent::__construct(); 
		$this->load->model('m_dashboard_bahan');
		$this->load->model('m_dashboard_produk');
	} 
	function index(){
		
		$tahun = date('Y');

		if (@$_POST['filter'] == 2) { 
			//filter
			$data['filter'] = 2;

			//bulanan
			$data['pembelian_data'] = $this->query_builder->view("SELECT SUM(REPLACE(pembelian_grandtotal, ',', '')) AS total, DATE_FORMAT(pembelian_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(pembelian_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(pembelian_tanggal, '%m'), '0','') AS bulan FROM t_pembelian WHERE pembelian_hapus = 0 AND DATE_FORMAT(pembelian_tanggal, '%Y') = '$tahun' GROUP BY DATE_FORMAT(pembelian_tanggal, '%m')");

			//penjualan
			$data['penjualan_data'] = $this->query_builder->view("SELECT SUM(REPLACE(penjualan_grandtotal, ',', '') ) AS total, DATE_FORMAT(penjualan_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(penjualan_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(penjualan_tanggal, '%m'), '0','') AS bulan FROM t_penjualan WHERE penjualan_hapus = 0 AND DATE_FORMAT(penjualan_tanggal, '%Y') = '$tahun' GROUP BY DATE_FORMAT(penjualan_tanggal, '%m')");				

		}else{
			$data['filter'] = 1;

			//harian
			$data['pembelian_data'] = $this->query_builder->view("SELECT SUM(REPLACE(pembelian_grandtotal, ',', '')) AS total, DATE_FORMAT(pembelian_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(pembelian_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(pembelian_tanggal, '%m'), '0','') AS bulan FROM t_pembelian WHERE pembelian_hapus = 0 AND DATE_FORMAT(pembelian_tanggal, '%Y') = '$tahun' GROUP BY pembelian_tanggal");


			//penjualan
			$data['penjualan_data'] = $this->query_builder->view("SELECT SUM(REPLACE(penjualan_grandtotal, ',', '') ) AS total, DATE_FORMAT(penjualan_tanggal, '%Y') AS tahun, REPLACE(DATE_FORMAT(penjualan_tanggal, '%d'), '0','') AS tanggal, REPLACE(DATE_FORMAT(penjualan_tanggal, '%m'), '0','') AS bulan FROM t_penjualan WHERE penjualan_hapus = 0 AND DATE_FORMAT(penjualan_tanggal, '%Y') = '$tahun' GROUP BY penjualan_tanggal");
		}

		$y = date('Y');
		$m = date('m');

		$date1 = strtotime($y.'-'.$m);
		$date2 = strtotime($y.'-'.($m + 1));
		$diff = $date2 - $date1;
		$days = floor($diff / (60 * 60 * 24));

		$data['hari'] = $days; 
		
		$data['title'] = 'Dashboard';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('dashboard/dashboard');
			$this->load->view('v_template_admin/admin_footer');
	} 
	function get_bahan(){
		$where = array('bahan_hapus' => 0);

        $data   = $this->m_dashboard_bahan->get_datatables($where);
        $total  = $this->m_dashboard_bahan->count_all($where);
        $filter = $this->m_dashboard_bahan->count_filtered($where);

        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $total,
            "recordsFiltered" => $filter,
            "data" => $data,
        );
        echo json_encode($output);
	} 
	function get_produk(){
		$where = array('produk_hapus' => 0);

        $data   = $this->m_dashboard_produk->get_datatables($where);
        $total  = $this->m_dashboard_produk->count_all($where);
        $filter = $this->m_dashboard_produk->count_filtered($where);

        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $total,
            "recordsFiltered" => $filter,
            "data" => $data,
        );
        echo json_encode($output);
	} 
}
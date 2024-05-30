<?php
class Kartustok extends CI_Controller
{
	function __construct(){ 
		parent::__construct();
		$this->load->model('m_bahan');
		$this->load->model('m_kartustok');
	}  

	function index(){
		if ( $this->session->userdata('login') == 1) {
		    $data["title"] = 'kartu stok'; 
 
		    //barang 
		    $data['barang'] = $this->db->query("SELECT * FROM (SELECT a.bahan_kode AS kode, a.bahan_nama AS nama, a.bahan_hapus AS hapus FROM t_bahan AS a UNION SELECT b.produk_kode AS kode, b.produk_nama AS nama, b.produk_hapus AS hapus FROM t_produk AS b) AS ok WHERE hapus = 0")->result_array();

		    $kode = @$_POST['kode'];
		    $start = @$_POST['start'];
		    $end = @$_POST['end'];

		    if (@$kode) {

		    	//saldo
		    	$generate = $this->generate_db($kode);
		    	if ($generate == 1) {
		    		
		    		//data
		   			$data['data'] = $this->query_builder->view("SELECT * FROM t_kartu WHERE kartu_hapus = 0 AND kartu_kode = '$kode' AND DATE_FORMAT(kartu_tanggal, '%Y-%m') >= '$start' AND DATE_FORMAT(kartu_tanggal, '%Y-%m') <= '$end' ORDER BY kartu_id ASC");
		    	}

		   		$data['filter'] = 1;
		    }else{

		    	$data['filter'] = 2;
		    }
		
		   $this->load->view('v_template_admin/admin_header',$data);
		   $this->load->view('kartustok/index');
		   $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function get_data(){

		$search = @$_GET['search']['value'];

		$where = array('hapus = 0', 'pesanan = 0');
		$like = array('nomor LIKE "%'.$search.'%"', 'keterangan LIKE "%'.$search.'%"');

	    $data = $this->m_kartustok->get_datatables($where, $like);
	    $filter = $this->m_kartustok->count_filtered($where);
		$total = $this->m_kartustok->count_all($where);

		$output = array(
			"draw" => $_GET['draw'],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);

		//output dalam format JSON
		echo json_encode($output);
	}
	function type(){

		$type = strip_tags(@$_POST['type']);

		if ($type == 'pb') {
			$response = $this->db->query("SELECT bahan_nama as nama, bahan_kode as kode FROM t_bahan WHERE bahan_hapus = 0")->result_array();
		}else{
			$response = $this->db->query("SELECT produk_nama as nama, produk_kode as kode FROM t_produk WHERE produk_hapus = 0")->result_array();
		}

		echo json_encode($response); 
	}
	function generate(){

		set_time_limit(1000);

		//hapus semua data
		if ($this->db->query("DELETE FROM t_kartu")) {
			//reset autoincreament
			$this->db->query("ALTER TABLE t_kartu AUTO_INCREMENT = 1");
		}

		$db1 = $this->db->query("SELECT a.pembelian_jam as jam, d.bahan_kode AS kode, d.bahan_id AS barang, d.bahan_nama as barang_nama , c.gudang_id as gudang, 'pembelian' as jenis, a.pembelian_nomor AS nomor, b.pembelian_barang_panjang_cek AS jumlah, 'Mtr' AS satuan, 'masuk' AS transaksi, a.pembelian_tanggal AS tanggal FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor LEFT JOIN t_gudang AS c ON a.pembelian_gudang = c.gudang_id LEFT JOIN t_bahan AS d ON b.pembelian_barang_barang = d.bahan_id WHERE a.pembelian_hapus = 0 AND a.pembelian_proses = 1 ORDER BY a.pembelian_tanggal, a.pembelian_jam")->result_array();

		$db2 = $this->db->query("SELECT e.produksi_jam as jam, h.bahan_kode AS kode, h.bahan_nama as barang_nama, g.gudang_id as gudang, 'produksi' as jenis, e.produksi_nomor AS nomor, f.produksi_barang_barang AS barang, f.produksi_barang_panjang AS jumlah, 'Mtr' AS satuan, 'keluar' AS transaksi, f.produksi_barang_tanggal AS tanggal FROM t_produksi AS e JOIN t_produksi_barang AS f ON e.produksi_nomor = f.produksi_barang_nomor LEFT JOIN t_gudang AS g ON e.produksi_gudang = g.gudang_id LEFT JOIN t_bahan AS h ON f.produksi_barang_barang = h.bahan_id WHERE e.produksi_proses = 1 ORDER BY e.produksi_tanggal, e.produksi_jam")->result_array();

		$db3 = $this->db->query("SELECT h.produksi_jam as jam, k.produk_kode AS kode, k.produk_nama as barang_nama, j.gudang_id AS gudang, 'produksi' AS jenis, h.produksi_nomor AS nomor, k.produk_id AS barang, i.produksi_produksi_panjang_total AS jumlah, 'Mtr' AS satuan, 'masuk' AS transaksi, i.produksi_produksi_tanggal AS tanggal FROM t_produksi AS h JOIN t_produksi_produksi AS i ON h.produksi_nomor = i.produksi_produksi_nomor LEFT JOIN t_gudang AS j ON h.produksi_gudang = j.gudang_id LEFT JOIN t_produk AS k ON i.produksi_produksi_produk = k.produk_id WHERE h.produksi_proses = 1 ORDER BY h.produksi_tanggal, h.produksi_jam")->result_array();

		$db4 = $this->db->query("SELECT l.penjualan_jam as jam, o.produk_kode AS kode, o.produk_nama as barang_nama, n.gudang_id AS gudang, 'penjualan' as jenis, l.penjualan_nomor AS nomor, o.produk_id AS barang, m.penjualan_barang_panjang_total AS jumlah, 'Mtr' AS satuan, 'keluar' AS transaksi, l.penjualan_tanggal AS tanggal FROM t_penjualan AS l JOIN t_penjualan_barang AS m ON l.penjualan_nomor = m.penjualan_barang_nomor LEFT JOIN t_gudang AS n ON l.penjualan_gudang = n.gudang_id LEFT JOIN t_produk AS o ON m.penjualan_barang_barang = o.produk_id WHERE l.penjualan_proses = 1 ORDER BY l.penjualan_tanggal, l.penjualan_jam")->result_array();

		foreach ($db1 as $v) {
			
			$kode = $v['kode'];

			$arr = array(
							'kartu_gudang' => $v['gudang'],
							'kartu_jenis' => $v['jenis'],
							'kartu_transaksi' => $v['transaksi'],
							'kartu_nomor' => $v['nomor'],
							'kartu_barang' => $v['barang'],
							'kartu_kode' => $kode,
							'kartu_barang_nama' => $v['barang_nama'],
							'kartu_jumlah' => $v['jumlah'],
							'kartu_tanggal' => $v['tanggal'],
							'kartu_jam' => $v['jam'],
							'kartu_satuan' => $v['satuan'], 
						);

			//save kartu stok
			$this->db->set($arr);
			$this->db->insert('t_kartu');

			//saldo
			$this->generate_db($kode);
		}

		foreach ($db2 as $v) {
			
			$kode = $v['kode'];

			$arr = array(
							'kartu_gudang' => $v['gudang'],
							'kartu_jenis' => $v['jenis'],
							'kartu_transaksi' => $v['transaksi'],
							'kartu_nomor' => $v['nomor'],
							'kartu_barang' => $v['barang'],
							'kartu_kode' => $kode,
							'kartu_barang_nama' => $v['barang_nama'],
							'kartu_jumlah' => $v['jumlah'],
							'kartu_tanggal' => $v['tanggal'],
							'kartu_jam' => $v['jam'],
							'kartu_satuan' => $v['satuan'], 
						);

			//save kartu stok
			$this->db->set($arr);
			$this->db->insert('t_kartu');

			//saldo
			$this->generate_db($kode);
		}

		foreach ($db3 as $v) {
			
			$kode = $v['kode'];

			$arr = array(
							'kartu_gudang' => $v['gudang'],
							'kartu_jenis' => $v['jenis'],
							'kartu_transaksi' => $v['transaksi'],
							'kartu_nomor' => $v['nomor'],
							'kartu_barang' => $v['barang'],
							'kartu_kode' => $kode,
							'kartu_barang_nama' => $v['barang_nama'],
							'kartu_jumlah' => $v['jumlah'],
							'kartu_tanggal' => $v['tanggal'],
							'kartu_jam' => $v['jam'],
							'kartu_satuan' => $v['satuan'], 
						);

			//save kartu stok
			$this->db->set($arr);
			$this->db->insert('t_kartu');

			//saldo
			$this->generate_db($kode);
		}

		foreach ($db4 as $v) {
			
			$kode = $v['kode'];

			$arr = array(
							'kartu_gudang' => $v['gudang'],
							'kartu_jenis' => $v['jenis'],
							'kartu_transaksi' => $v['transaksi'],
							'kartu_nomor' => $v['nomor'],
							'kartu_barang' => $v['barang'],
							'kartu_kode' => $kode,
							'kartu_barang_nama' => $v['barang_nama'],
							'kartu_jumlah' => $v['jumlah'],
							'kartu_tanggal' => $v['tanggal'],
							'kartu_jam' => $v['jam'],
							'kartu_satuan' => $v['satuan'], 
						);

			//save kartu stok
			$this->db->set($arr);
			$this->db->insert('t_kartu');

			//saldo
			$this->generate_db($kode);
		}
	}
	function generate_db($kode){

		$db = $this->db->query("SELECT * FROM t_kartu WHERE kartu_kode = '$kode'")->result_array();

		$saldo = 0;
		foreach ($db as $v) {
			
			if ($v['kartu_transaksi'] == 'masuk') {
				
				$saldo += $v['kartu_jumlah'];
			}else{

				$saldo -= $v['kartu_jumlah']; 
			}

			$id = $v['kartu_id'];

			$this->db->set('kartu_saldo', $saldo);
			$this->db->where('kartu_id', $id);
			$this->db->update('t_kartu');
		}

		return 1;
	}
	function generate_time(){

		set_time_limit(1000);

		$db = $this->db->query("SELECT * FROM t_penjualan ORDER BY penjualan_id ASC")->result_array();

		foreach ($db as $v) {
			
			$id = $v['penjualan_id'];
			$time = date('H:i:s');
			$this->db->set('penjualan_jam', $time);
			$this->db->where('penjualan_id', $id);
			$this->db->update('t_penjualan');

			sleep(2);
		}
	}

	function export($kategori){

		$pembelian = $this->db->query("SELECT a.pembelian_tanggal as tanggal, a.pembelian_nomor as nomor, c.bahan_kode as kode, c.bahan_nama as nama, b.pembelian_barang_berat_cek as berat, b.pembelian_barang_panjang_cek as panjang, b.pembelian_barang_harga as harga, b.pembelian_barang_total as total FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_bahan as c ON b.pembelian_barang_barang = c.bahan_id WHERE a.pembelian_hapus = 0 AND a.pembelian_proses = 1 ORDER BY a.pembelian_tanggal ASC")->result_array();

		$penjualan = $this->db->query("SELECT a.penjualan_tanggal as tanggal, a.penjualan_nomor as nomor, c.produk_kode as kode, c.produk_nama as nama, b.penjualan_barang_konversi AS konversi, b.penjualan_barang_batang AS batang, b.penjualan_barang_panjang AS panjang_text, b.penjualan_barang_qty AS qty_text, b.penjualan_barang_panjang_total AS panjang_mtr, b.penjualan_barang_harga as harga, b.penjualan_barang_total as total FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_produk as c ON b.penjualan_barang_barang = c.produk_id WHERE a.penjualan_hapus = 0 AND a.penjualan_proses = 1 ORDER BY a.penjualan_tanggal ASC")->result_array();

		$produksi_bahan = $this->db->query("SELECT a.pembelian_tanggal as tanggal, a.pembelian_nomor as nomor, c.bahan_kode as kode, c.bahan_nama as nama, b.pembelian_barang_berat_cek as berat, b.pembelian_barang_panjang_cek as panjang, b.pembelian_barang_harga as harga, b.pembelian_barang_total as total FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_bahan as c ON b.pembelian_barang_barang = c.bahan_id WHERE a.pembelian_hapus = 0 AND a.pembelian_proses = 1 ORDER BY a.pembelian_tanggal ASC")->result_array();

		$produksi_produk = $this->db->query("SELECT a.produksi_tanggal as tanggal, a.produksi_nomor as nomor, c.produk_kode as kode, c.produk_nama as nama, b.produksi_produksi_konversi AS konversi, b.produksi_produksi_batang AS batang, b.produksi_produksi_panjang AS panjang_text, b.produksi_produksi_qty AS qty_text, b.produksi_produksi_panjang_total AS panjang_mtr, b.produksi_produksi_panjang_total as total FROM t_produksi AS a JOIN t_produksi_produksi AS b ON a.produksi_nomor = b.produksi_produksi_nomor JOIN t_produk as c ON b.produksi_produksi_produk = c.produk_id WHERE a.produksi_hapus = 0 AND a.produksi_proses = 1 ORDER BY a.produksi_tanggal ASC")->result_array();

		switch ($kategori) {
			case 'pembelian':
				$data['data'] = $pembelian;
				break;
			
			case 'penjualan':
				$data['data'] = $penjualan;
				break;

			case 'produksi_bahan':
				$data['data'] = $produksi_bahan;
				break;

			case 'produksi_produk':
				$data['data'] = $produksi_produk;
				break;
		}

		$data['kategori'] = $kategori;

		$this->load->view('kartustok/export', $data);
	}
}
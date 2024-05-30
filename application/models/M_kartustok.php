<?php

class M_kartustok extends CI_Model { 

	public function __construct()
	{ 
		parent::__construct();
		$this->load->database();
	}

	function pembelian(){

		//pembelian
		$this->db->select("a.pembelian_barang_id AS id ,b.pembelian_hapus AS hapus, b.pembelian_po AS pesanan, b.pembelian_tanggal AS tanggal, a.pembelian_barang_nomor AS nomor, 'pembelian' AS keterangan, 'keluar' AS jenis, ROUND(a.pembelian_barang_total) AS saldo");
		$this->db->from("t_pembelian_barang as a");
		$this->db->join("t_pembelian AS b", "a.pembelian_barang_nomor = b.pembelian_nomor");
		$query1 = $this->db->get_compiled_select();

		return $query1;
	}

	function pembelian_umum(){

		//pembelian umum
		$this->db->select("c.pembelian_umum_barang_id AS id, d.pembelian_umum_hapus AS hapus, '0' AS pesanan, d.pembelian_umum_tanggal AS tanggal, d.pembelian_umum_nomor AS nomor, 'pembelian' AS keterangan, 'keluar' AS jenis, ROUND(c.pembelian_umum_barang_subtotal) AS saldo");
		$this->db->from("t_pembelian_umum_barang AS c");
		$this->db->join("t_pembelian_umum AS d", "c.pembelian_umum_barang_nomor = d.pembelian_umum_nomor");
		$query2 = $this->db->get_compiled_select();

		return $query2;
	}

	function penjualan(){

		//penjualan
		$this->db->select("e.penjualan_barang_id AS id, f.penjualan_hapus AS hapus, '0' as pesanan, f.penjualan_tanggal AS tanggal, e.penjualan_barang_nomor AS nomor, 'penjualan' AS keterangan, 'masuk' AS jenis, ROUND(e.penjualan_barang_total) AS saldo");
		$this->db->from("t_penjualan_barang AS e");
		$this->db->join("t_penjualan AS f", "e.penjualan_barang_nomor = f.penjualan_nomor");
		$query3 = $this->db->get_compiled_select();

		return $query3;
	}

	function get_datatables($where, $like)
	{
		//table
		$pembelian = $this->pembelian();
		$pembelian_umum = $this->pembelian_umum();
		$penjualan = $this->penjualan();

		//response table
		$start = $_GET['start'];
		$length = $_GET['length'];

		//where
		$w = implode(' AND ', $where);

		//like
		$l = implode(' OR ', $like);

		$query = $this->db->query('SELECT * FROM ('.$pembelian.' UNION '.$pembelian_umum.' UNION '.$penjualan.') AS ok WHERE '.$w.' AND '.$l.' ORDER BY tanggal DESC LIMIT '.$start.','.$length);
		
		return $query->result_array();
	}

	function count_filtered($where)
	{	
		//table
		$pembelian = $this->pembelian();
		$pembelian_umum = $this->pembelian_umum();
		$penjualan = $this->penjualan();

		//where
		$w = implode(' AND ', $where);

		$query = $this->db->query('SELECT * FROM ('.$pembelian .' UNION '.$pembelian_umum.' UNION '.$penjualan.') AS ok WHERE '.$w.' ORDER BY tanggal DESC');
		
		return $query->num_rows();
	}

	public function count_all($where)
	{
		$pembelian = $this->pembelian();
		$pembelian_umum = $this->pembelian_umum();
		$penjualan = $this->penjualan();

		//where
		$w = implode(' AND ', $where);

		$query = $this->db->query('SELECT * FROM (' . $pembelian . ' UNION ' . $pembelian_umum . ' UNION ' . $penjualan . ') AS ok WHERE ' . $w . ' ORDER BY tanggal DESC');

		return $query->num_rows();
	}

}

<?php

class M_produk extends CI_Model { 

	//nama tabel
	var $table = 't_produk'; 

	//kolom yang di tampilkan
	var $column_order = array(null, 'produk_nama','produk_kode'); 

	//kolom yang di tampilkan setelah seacrh
	var $column_search = array('produk_nama','produk_kode','gudang_nama'); 

	//urutan 
	var $order = array('produk_id' => 'desc'); 
 
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	} 

	private function _get_datatables_query()
	{
		
		$this->db->from($this->table);

		$i = 0;
	
		foreach ($this->column_search as $item) // loop column 
		{
			if($_GET['search']['value']) // if datatable send POST for search
			{
				
				if($i===0) // first loop
				{
					$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->like($item, $_GET['search']['value']);
				}
				else
				{
					$this->db->or_like($item, $_GET['search']['value']);
				}

				if(count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket
			}
			$i++;
		}
		
		if(isset($_GET['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_GET['order']['0']['column']], $_GET['order']['0']['dir']);
		} 
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables($where)
	{	
		$this->db->select('*');
		$this->db->select('IFNULL(gudang_nama, "-") AS gudang');
		$this->db->select('IFNULL(SUM(produk_gudang_panjang), 0) AS stok');
		$this->db->select('IFNULL(produk_gudang_harga, 0) AS harga');
		$this->_get_datatables_query();
		if($_GET['length'] != -1)
		$this->db->where($where);
		$this->db->join('t_produk_gudang', 't_produk_gudang.produk_gudang_produk = t_produk.produk_id', 'LEFT');
		$this->db->join('t_gudang', 't_gudang.gudang_id = t_produk_gudang.produk_gudang_gudang', 'LEFT');
		$this->db->group_by('produk_id');
		$this->db->group_by('produk_gudang_gudang');
		$this->db->limit($_GET['length'], $_GET['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($where)
	{
		$this->_get_datatables_query();
		$this->db->where($where);
		$this->db->join('t_produk_gudang', 't_produk_gudang.produk_gudang_produk = t_produk.produk_id', 'LEFT');
		$this->db->join('t_gudang', 't_gudang.gudang_id = t_produk_gudang.produk_gudang_gudang', 'LEFT');
		$this->db->group_by('t_produk.produk_id');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($where)
	{
		$this->db->from($this->table);
		$this->db->where($where);
		$this->db->join('t_produk_gudang', 't_produk_gudang.produk_gudang_produk = t_produk.produk_id', 'LEFT');
		$this->db->join('t_gudang', 't_gudang.gudang_id = t_produk_gudang.produk_gudang_gudang', 'LEFT');
		$this->db->group_by('t_produk.produk_id');
		return $this->db->count_all_results();
	}

}

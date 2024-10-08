<?php

class M_pembelian extends CI_Model {  

	//nama tabel
	var $table = 't_pembelian';  

	//kolom yang di tampilkan 
	var $column_order = array(null,'pembelian_nomor','kontak_nama','pembelian_jatuh_tempo','pembelian_status'); 

	//kolom yang di tampilkan setelah seacrh
	var $column_search = array('pembelian_nomor','kontak_nama','pembelian_jatuh_tempo','pembelian_status'); 

	//urutan 
	var $order = array('pembelian_id' => 'desc'); 

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

	function get_datatables($where, $group)
	{
		$this->db->select('*');
		$this->db->select('SUM(t_pembelian_barang.pembelian_barang_terima) AS terima');
		$this->_get_datatables_query();
		if($_GET['length'] != -1)
		$this->db->where($where);
		$this->db->join('t_kontak', 't_pembelian.pembelian_supplier = t_kontak.kontak_id');
		$this->db->join('t_pembelian_barang', 't_pembelian_barang.pembelian_barang_nomor = t_pembelian.pembelian_nomor');
		$this->db->join('t_pembelian_terima', 't_pembelian_terima.pembelian_terima_nomor = t_pembelian.pembelian_nomor', 'LEFT');
		$this->db->group_by($group);
		$this->db->limit($_GET['length'], $_GET['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($where, $group)
	{
		$this->_get_datatables_query();
		$this->db->join('t_kontak', 't_pembelian.pembelian_supplier = t_kontak.kontak_id');
		$this->db->join('t_pembelian_barang', 't_pembelian_barang.pembelian_barang_nomor = t_pembelian.pembelian_nomor');
		$this->db->join('t_pembelian_terima', 't_pembelian_terima.pembelian_terima_nomor = t_pembelian.pembelian_nomor', 'LEFT');
		$this->db->where($where);
		$this->db->group_by($group);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all($where, $group)
	{
		$this->db->from($this->table);
		$this->db->join('t_kontak', 't_pembelian.pembelian_supplier = t_kontak.kontak_id');
		$this->db->join('t_pembelian_barang', 't_pembelian_barang.pembelian_barang_nomor = t_pembelian.pembelian_nomor');
		$this->db->join('t_pembelian_terima', 't_pembelian_terima.pembelian_terima_nomor = t_pembelian.pembelian_nomor', 'LEFT');
		$this->db->where($where);
		$this->db->group_by($group);
		return $this->db->count_all_results();
	}

}

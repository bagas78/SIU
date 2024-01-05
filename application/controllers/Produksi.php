<?php
class Produksi extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_produksi'); 
		$this->load->model('m_produk');
		$this->load->model('m_bahan');
	}    

///////////////// atribut //////////////////////////////////////////

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
	function add(){

		//user
	    $data['user_data'] = $this->query_builder->view("SELECT * FROM t_user WHERE user_level != 0 AND user_hapus = 0");

	    //karyawan
	    $data['pekerja_data'] = $this->query_builder->view("SELECT * FROM t_karyawan WHERE karyawan_hapus = 0");

	    //bahan
	    $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");

	    //mesin
	    $data['mesin_data'] = $this->query_builder->view("SELECT * FROM t_mesin WHERE mesin_hapus = 0");

	    //gudang
	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

	    //data produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    return $data;
	}

	function save($redirect, $so = 0)
	{
		$nomor = strip_tags(@$_POST['nomor']);
		$grandtotal = strip_tags(str_replace(',', '', @$_POST['grandtotal']));
		$set1 = array(
					'produksi_so' => $so,
					'produksi_pekerja' => json_encode(@$_POST['pekerja']),
					'produksi_nomor' => $nomor,
					'produksi_tanggal' => strip_tags(@$_POST['tanggal']),
					'produksi_shift' => strip_tags(@$_POST['shift']),
					'produksi_gudang' => strip_tags(@$_POST['gudang']),
					'produksi_keterangan' => strip_tags(@$_POST['keterangan']),
					'produksi_mesin' => strip_tags(@$_POST['mesin']), 
					'produksi_subtotal' => strip_tags(str_replace(',', '', @$_POST['subtotal'])),
					'produksi_grandtotal' => $grandtotal, 
					'produksi_jasa' => strip_tags(@$_POST['jasa']),
				);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];

		$arr = [];
		if (@$lampiran['name']) {
			//jumlah loop
			$file = $lampiran;
			$path = './assets/gambar/produksi';
			$name = 'produksi_lampiran';
			$upload = $this->upload_builder->multiple($file,$path,$name);	

      		if ($upload != 0) {
      			$arr = array_merge($arr,$upload);
     		}			
		}
		
		$merge = array_merge($set1,$arr);
		$db = $this->query_builder->add('t_produksi',$merge);

		//produk
		$produk = @$_POST['produk'];
		$jum_produk = count($produk);

		for ($i = 0; $i < $jum_produk; ++$i) {

			$set2 = array(
						'produksi_produksi_nomor' => $nomor,
						'produksi_produksi_produk' => strip_tags(@$produk[$i]),
						'produksi_produksi_panjang' => strip_tags(str_replace(',', '', @$_POST['produk_panjang'][$i])),			
					);	

			$this->query_builder->add('t_produksi_produksi',$set2);
		}

		//bahan baku
		$barang = @$_POST['bahan'];
		$jum_barang = count($barang);
		
		for ($i = 0; $i < $jum_barang; ++$i) {

			$set3 = array(
						'produksi_barang_nomor' => $nomor,
						'produksi_barang_barang' => strip_tags(@$barang[$i]),
						'produksi_barang_panjang' => strip_tags(str_replace(',', '', @$_POST['panjang'][$i])),
						'produksi_barang_stok' => strip_tags(str_replace(',', '', @$_POST['stok'][$i])),
						'produksi_barang_harga' => strip_tags(str_replace(',', '', @$_POST['harga'][$i])),	
						'produksi_barang_total' => strip_tags(str_replace(',', '', @$_POST['total'][$i])),	
						'produksi_barang_berat' => strip_tags(str_replace(',', '', @$_POST['berat'][$i])),	
					);	

			$this->query_builder->add('t_produksi_barang',$set3);
		}

		if ($db == 1) {
			
			//update
			$this->stok->transaksi();

			// jurnal
			// $this->stok->jurnal($nomor, 9, 'debit', 'biaya produksi', $total);
			// $this->stok->jurnal($nomor, 4, 'kredit', 'stok bahan baku', $total);	

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('produksi/'.$redirect));
	}

	function update($redirect, $so = 0){

		$nomor = strip_tags(@$_POST['nomor']);
		$grandtotal = strip_tags(str_replace(',', '', @$_POST['grandtotal']));
		$set1 = array(
					'produksi_so' => $so,
					'produksi_pekerja' => json_encode(@$_POST['pekerja']),
					'produksi_nomor' => $nomor,
					'produksi_tanggal' => strip_tags(@$_POST['tanggal']),
					'produksi_shift' => strip_tags(@$_POST['shift']),
					'produksi_gudang' => strip_tags(@$_POST['gudang']),
					'produksi_keterangan' => strip_tags(@$_POST['keterangan']),
					'produksi_mesin' => strip_tags(@$_POST['mesin']), 
					'produksi_subtotal' => strip_tags(str_replace(',', '', @$_POST['subtotal'])),
					'produksi_grandtotal' => $grandtotal, 
					'produksi_jasa' => strip_tags(@$_POST['jasa']),
				);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];

		$arr = [];
		if (@$lampiran['name']) {
			//jumlah loop
			$file = $lampiran;
			$path = './assets/gambar/produksi';
			$name = 'produksi_lampiran';
			$upload = $this->upload_builder->multiple($file,$path,$name);	

      		if ($upload != 0) {
      			$arr = array_merge($arr,$upload);
     		}			
		}
		
		$merge = array_merge($set1,$arr);
		$db = $this->query_builder->update('t_produksi',$merge,['produksi_nomor' => $nomor]);

		//delete
		$this->query_builder->delete('t_produksi_produksi', ['produksi_produksi_nomor' => $nomor]);
		$this->query_builder->delete('t_produksi_barang', ['produksi_barang_nomor' => $nomor]);

		//produk
		$produk = @$_POST['produk'];
		$jum_produk = count($produk);

		for ($i = 0; $i < $jum_produk; ++$i) {

			$set2 = array(
						'produksi_produksi_nomor' => $nomor,
						'produksi_produksi_produk' => strip_tags(@$produk[$i]),
						'produksi_produksi_panjang' => strip_tags(str_replace(',', '', @$_POST['produk_panjang'][$i])),			
					);	

			$this->query_builder->add('t_produksi_produksi',$set2);
		}

		//bahan baku
		$barang = @$_POST['bahan'];
		$jum_barang = count($barang);
		
		for ($i = 0; $i < $jum_barang; ++$i) {

			$set3 = array(
						'produksi_barang_nomor' => $nomor,
						'produksi_barang_barang' => strip_tags(@$barang[$i]),
						'produksi_barang_panjang' => strip_tags(str_replace(',', '', @$_POST['panjang'][$i])),
						'produksi_barang_berat' => strip_tags(str_replace(',', '', @$_POST['berat'][$i])),
						'produksi_barang_stok' => strip_tags(str_replace(',', '', @$_POST['stok'][$i])),	
						'produksi_barang_harga' => strip_tags(str_replace(',', '', @$_POST['harga'][$i])),
						'produksi_barang_total' => strip_tags(str_replace(',', '', @$_POST['total'][$i])),		
					);	

			$this->query_builder->add('t_produksi_barang',$set3);
		}

		if ($db == 1) {
			
			//update
			$this->stok->transaksi();

			// jurnal
			// $this->stok->jurnal($nomor, 9, 'debit', 'biaya produksi', $total);
			// $this->stok->jurnal($nomor, 4, 'kredit', 'stok bahan baku', $total);	

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('produksi/'.$redirect));
	}
	function delete($table, $id, $redirect){
		$set = ["{$table}_hapus" => 1];
		$where = ["{$table}_id" => $id];
		$db = $this->query_builder->update("t_{$table}",$set,$where);

		if ($db == 1) {

			//update
			$this->stok->transaksi();

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('produksi/'.$redirect));
	}
	function search(){
		$output = $this->query_builder->view("SELECT produksi_nomor as nomor FROM t_produksi WHERE produksi_hapus = 0");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor WHERE a.produksi_nomor = '$nomor'");
		echo json_encode($output);
	}
	function lasoran($id){

		$data['title'] = 'lasoran';

		$data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produksi AS a LEFT JOIN t_produksi_produksi AS b ON a.produksi_nomor = b.produksi_produksi_nomor LEFT JOIN t_produk AS c ON b.produksi_produksi_produk = c.produk_id WHERE a.produksi_id = '$id'");

		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor JOIN t_produksi AS c ON a.produksi_nomor = c.produksi_nomor  LEFT JOIN t_bahan AS d ON b.produksi_barang_barang = d.bahan_id LEFT JOIN t_gudang AS e ON a.produksi_gudang = e.gudang_id LEFT JOIN t_mesin AS f ON a.produksi_mesin = f.mesin_id LEFT JOIN t_produksi_produksi AS g ON a.produksi_nomor = g.produksi_produksi_nomor WHERE a.produksi_id = '$id'");

		$this->load->view('produksi/lasoran', $data); 
	}
	function get_bahan($id, $gudang){

		$data = $this->query_builder->view_row("SELECT *, IFNULL(SUM(c.bahan_gudang_panjang),0) AS stok, IFNULL(SUM(c.bahan_gudang_berat_permeter),0) AS berat FROM t_bahan AS a LEFT JOIN t_bahan_gudang AS c ON a.bahan_id = c.bahan_gudang_bahan WHERE a.bahan_hapus = 0 AND a.bahan_id = '$id' AND c.bahan_gudang_gudang = '$gudang' GROUP BY a.bahan_id, c.bahan_gudang_gudang");

		echo json_encode($data);
	}
	function get_produk($id){

		$data = $this->query_builder->view_row("SELECT * FROM t_produk AS a LEFT JOIN t_satuan AS b ON a.produk_satuan = b.satuan_id WHERE a.produk_id = '$id'");

		echo json_encode($data);
	}
	function get_produksi($nomor){

		$data = $this->query_builder->view("SELECT * FROM t_produksi_produksi AS a LEFT JOIN t_produk AS b ON a.produksi_produksi_produk = b.produk_id WHERE a.produksi_produksi_nomor = '$nomor'");

		echo json_encode($data);
	}
	function get_bahan_baku($nomor){

		$data = $this->query_builder->view("SELECT * FROM t_produksi_barang as a JOIN t_produksi as b ON a.produksi_barang_nomor = b.produksi_nomor JOIN t_bahan as c ON a.produksi_barang_barang = c.bahan_id JOIN t_satuan as d ON c.bahan_satuan = d.satuan_id WHERE a.produksi_barang_nomor = '$nomor'");

		echo json_encode($data);
	}

////////////////////////////////////////////////

//////////////// so /////////////////////////////

	function so_get_data(){
		$model = 'm_produksi';
		$where = array('produksi_hapus' => '0', 'produksi_so' => 1);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function proses_so($id){
		$data = $this->add();
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");

		$data['url'] = 'rotate';

		$data["title"] = 'antrian (so)';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function rotate_save(){
		
		$redirect = 'proses';
		$this->update($redirect, $so = 0);
	}
///////////////////////////////////////////////////

//////////////// proses /////////////////////////////

	function proses()
	{
		$title = 'proses';
		$data["title"] = $title;	
		$data['url'] = $title;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/proses');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function proses_get_data()
	{
		$model = 'm_produksi';
		$where = array('produksi_hapus' => '0', 'produksi_so' => '0');
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function proses_add()
	{
		$redirect = 'proses';
		$data = $this->add($redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_produksi");
	    $data['nomor'] = 'PR-'.date('dmY').'-'.($pb+1);

	    //bahan
	    $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0");

	    //produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

		$data["title"] = $redirect;
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form'); 
	    $this->load->view('produksi/search');
	    $this->load->view('v_template_admin/admin_footer');
	}

	
	function proses_save()
	{
		$redirect = 'proses';
		$nomor = strip_tags(@$_POST['nomor']);
		
		$cek = $this->query_builder->count("SELECT * FROM t_produksi WHERE produksi_nomor = '$nomor'");
		if ($cek > 0) {
			//update
			$this->update($nomor, $redirect);

		} else {

			//save
			$this->save($redirect);
		}
	}

	function proses_delete($id){
		
		$table = 'produksi';
		$redirect = 'proses';
		$this->delete($table, $id, $redirect);
	}
	function proses_edit($id){

		$data = $this->edit($id);

		$data['url'] = 'proses';

		$data["title"] = 'proses';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function proses_view($id){

		$data = $this->add();
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");

		$data['url'] = 'proses';
		$data['view'] = 1;

		$data["title"] = 'proses';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function proses_update($nomor){
		$redirect = 'proses';
		$this->update($nomor, $redirect);
	}

}
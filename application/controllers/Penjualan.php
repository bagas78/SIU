<?php
class Penjualan extends CI_Controller{

	function __construct(){
		parent::__construct();
		$this->load->model('m_penjualan');
		$this->load->model('m_produksi');
		$this->load->model('m_produksi_so');  
	} 

///////////////////////// penjualan //////////////////////////////////////////////////

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
	function add($active){ 

		//kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 'p' AND kontak_hapus = 0");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    //gudang
	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

	    //ekspedisi
	    $data['ekspedisi_data'] = $this->query_builder->view("SELECT * FROM t_ekspedisi WHERE ekspedisi_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'penjualan'");

	    return $data;
	}
	function delete($table, $id, $redirect){
		$set = ["{$table}_hapus" => 1];
		$where = ["{$table}_id" => $id];
		$db = $this->query_builder->update("t_{$table}",$set,$where);

		if ($db == 1) {
			
			//update produk
			$this->stok->transaksi();

			//jurnal
			if ($table == 'penjualan') {

				// $pen = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");
				// $nomor = $pen['penjualan_nomor'];
				// $this->stok->jurnal_delete($nomor, 1);	
			}

			$this->session->set_flashdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('penjualan/'.$redirect));
	}
	function get_produk($id = '', $gudang = ''){
		$db = $this->query_builder->view_row("SELECT * FROM t_produk AS a JOIN t_produk_gudang AS b ON a.produk_id = b.produk_gudang_produk WHERE b.produk_gudang_produk = '$id' AND b.produk_gudang_gudang = '$gudang'");
		echo json_encode($db);
	}
	function save($so, $redirect)
	{
		//penjualan
		$nomor = strip_tags($_POST['nomor']);
		$status = strip_tags($_POST['status']);
		$grandtotal = strip_tags(str_replace('.', '', $_POST['grandtotal']));

		//piutang status
		if ($status == 'belum') { $piutang = '1'; }else{ $piutang = '0'; }

		$set1 = array(
						'penjualan_piutang' => $piutang,
						'penjualan_so' => $so,
						'penjualan_nomor' => $nomor,
						'penjualan_ambil' => strip_tags($_POST['ambil']),
						'penjualan_tanggal' => strip_tags($_POST['tanggal']),
						'penjualan_pelanggan' => strip_tags($_POST['pelanggan']),
						'penjualan_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'penjualan_pembayaran' => strip_tags($_POST['pembayaran']),
						'penjualan_status' => $status,
						'penjualan_gudang' => strip_tags($_POST['gudang']),
						'penjualan_keterangan' => strip_tags($_POST['keterangan']),
						'penjualan_subtotal' => strip_tags(str_replace('.', '', $_POST['subtotal'])),
						'penjualan_ppn' => strip_tags(str_replace('.', '', $_POST['ppn'])),
						'penjualan_grandtotal' => $grandtotal, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/penjualan';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('penjualan_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		} else {
			$result = $set1; 
		}

		$db = $this->query_builder->add('t_penjualan',$result);

		//barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {

			$set2 = array(
						'penjualan_barang_nomor' => $nomor,
						'penjualan_barang_barang' => strip_tags($_POST['barang'][$i]),
						'penjualan_barang_panjang' => strip_tags(str_replace('.', '', $_POST['panjang'][$i])),
						'penjualan_barang_stok' => strip_tags(str_replace('.', '', $_POST['stok'][$i])),
						'penjualan_barang_harga' => strip_tags(str_replace('.', '', $_POST['harga'][$i])),
						'penjualan_barang_hps' => strip_tags(str_replace('.', '', $_POST['hps'][$i])),
						'penjualan_barang_total' => strip_tags(str_replace('.', '', $_POST['total'][$i])),
					);	

			$this->query_builder->add('t_penjualan_barang',$set2);
		}

		if ($db == 1) {

			//update produk
			$this->stok->transaksi();

			// jurnal
			// if ($so != 1) {

			//  	if ($status == 'lunas') {

			//  		// $this->stok->jurnal($nomor, 7, 'debit', 'saldo (penjualan produk)', $total);
			//  		$this->stok->jurnal($nomor, 8, 'debit', 'pendapatan (penjualan produk)', $total);
			//  		$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total);
				
			//  	} else {
					
			//  		$this->stok->jurnal($nomor, 2, 'debit', 'piutang (penjualan produk)', $total);
			//  		$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total);
					
			//  	}
				
			// }

			$this->session->set_flashdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('penjualan/'.$redirect));
	}
	function edit($id, $active = ''){

	    //data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 'p' AND kontak_hapus = 0");

	    //produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    //gudang
	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

	    //ekspedisi
	    $data['ekspedisi_data'] = $this->query_builder->view("SELECT * FROM t_ekspedisi WHERE ekspedisi_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'penjualan'");

	    $data['url'] = $active;

	    return $data;
	}
	function get_penjualan($nomor){ 

		//penjualan barang
		$db = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_produk_gudang AS c ON b.penjualan_barang_barang = c.produk_gudang_produk WHERE b.penjualan_barang_nomor = '$nomor'");
		echo json_encode($db);
	}
	function update($so, $redirect, $where){
		$nomor = strip_tags($_POST['nomor']);
		$total = strip_tags(str_replace('.', '', $_POST['total']));
		$set1 = array(
						'penjualan_nomor' => $nomor,
						'penjualan_so' => $so,
						'penjualan_ekspedisi' => strip_tags($_POST['ekspedisi']),
						'penjualan_tanggal' => strip_tags($_POST['tanggal']),
						'penjualan_pelanggan' => strip_tags($_POST['pelanggan']),
						'penjualan_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'penjualan_pembayaran' => strip_tags($_POST['pembayaran']),
						'penjualan_status' => strip_tags($_POST['status']),
						'penjualan_keterangan' => strip_tags($_POST['keterangan']),
						'penjualan_qty_akhir' => strip_tags(str_replace('.', '', $_POST['qty_akhir'])),
						'penjualan_ppn' => strip_tags(str_replace('.', '', $_POST['ppn'])),
						'penjualan_total' => $total, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/penjualan';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('penjualan_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$where1 = ['penjualan_nomor' => $where];
		$db = $this->query_builder->update('t_penjualan',$result,$where1);

		//delete barang
		$where2 = ['penjualan_barang_nomor' => $where];
		$this->query_builder->delete('t_penjualan_barang',$where2);

		//save barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'penjualan_barang_nomor' => $nomor,
						'penjualan_barang_barang' => strip_tags($_POST['barang'][$i]),
						'penjualan_barang_qty' => strip_tags(str_replace('.', '', $_POST['qty'][$i])),
						'penjualan_barang_stok' => strip_tags(str_replace('.', '', $_POST['stok'][$i])),
						'penjualan_barang_harga' => strip_tags(str_replace('.', '', $_POST['harga'][$i])),
						'penjualan_barang_hps' => strip_tags(str_replace('.', '', $_POST['hps'][$i])),
						'penjualan_barang_subtotal' => strip_tags(str_replace('.', '', $_POST['subtotal'][$i])),
					);	

			$this->query_builder->add('t_penjualan_barang',$set2);
		}

		if ($db == 1) {
			
			//update stok
			$this->stok->transaksi();

			//jurnal
			// if ($so != 1) {

			// 	$pen = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");
			// 	$tanggal = $pen['penjualan_tanggal'];

			// 	$this->stok->jurnal_delete($nomor);

			// 	if ($status == 'l') {

			// 		$this->stok->jurnal($nomor, 7, 'debit', 'saldo (penjualan produk)', $total, $tanggal);
			// 		$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total, $tanggal);
				
			// 	} else {
					
			// 		$this->stok->jurnal($nomor, 2, 'debit', 'piutang (penjualan produk)', $total, $tanggal);
			// 		$this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total, $tanggal);
					
			// 	}
				
			// }

			$this->session->set_flashdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_flashdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('penjualan/'.$redirect));

	}
	function search($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_penjualan WHERE penjualan_so = 1 AND penjualan_hapus = 0 AND penjualan_nomor LIKE '%$nomor%'");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_produk AS c ON b.penjualan_barang_barang = c.produk_id LEFT JOIN t_satuan AS d ON c.produk_satuan = d.satuan_id WHERE a.penjualan_so = 1 AND a.penjualan_hapus = 0 AND a.penjualan_nomor = '$nomor'");
		echo json_encode($output);
	}
	function faktur($id){
		$data["title"] = 'faktur';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor JOIN t_produk AS c ON b.penjualan_barang_barang = c.produk_id LEFT JOIN t_kontak as d ON a.penjualan_pelanggan = d.kontak_id WHERE a.penjualan_id = '$id'");

		
		$this->load->view('penjualan/faktur',$data);
	}
	function surat($id){

		$data["title"] = 'surat jalan';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_produk AS c ON b.penjualan_barang_barang = c.produk_id LEFT JOIN t_kontak as d ON a.penjualan_pelanggan = d.kontak_id LEFT JOIN t_ekspedisi as f ON a.penjualan_ekspedisi = f.ekspedisi_id WHERE a.penjualan_id = '$id'");

		
		$this->load->view('penjualan/surat_jalan',$data);
	}

////////////////////////////////////////////////////////////////////////////////////////////

	
////////////////// Purchase Order///////////////////////////////

	function so()	// pesanan penjualan
	{
		if ( $this->session->userdata('login') == 1) {

			$active = 'so';
			$data["title"] = $active;
			$data['url'] = $active;

		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/so');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}

	function so_get_data()
	{		
		$model = 'm_produksi';
		$where = array('produksi_so' => 1,'produksi_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}

	function so_get_produksi()
	{		
		$model = 'm_produksi_so';
		$where = array('produksi_so' => 0,'produksi_hapus' => 0, 'produksi_pelanggan !=' => '');
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}

	function so_delete($id){

		$table = 'produksi';
		$redirect = 'so';
		$this->delete('produksi', $id, $redirect);
	}
	function so_add()
	{
		$redirect = 'so';
		$data = $this->add($redirect);
		$data['url'] = $redirect;
		$data["title"] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_produksi");
	    $data['nomor'] = 'SO-'.date('dmY').'-'.($pb+1);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/so_form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function so_save(){
		
		$nomor = strip_tags(@$_POST['nomor']);

		//produksi
		$set1 = array(
						'produksi_so' => 1,
						'produksi_nomor' => $nomor,
						'produksi_tanggal' => strip_tags(@$_POST['tanggal']), 
						'produksi_gudang' => strip_tags(@$_POST['gudang']),
						'produksi_pelanggan' => strip_tags(@$_POST['pelanggan']),
						'produksi_keterangan' => strip_tags(@$_POST['keterangan']),   
					);

		$this->db->set($set1);
		if ($this->db->insert('t_produksi')) {
			
			//produksi produksi
			$num = count(@$_POST['produk']);
			for ($i=0; $i < $num; $i++) { 
				
				$set2 = array(
								'produksi_produksi_nomor' => $nomor,
								'produksi_produksi_produk' => strip_tags(@$_POST['produk'][$i]),
								'produksi_produksi_panjang' => strip_tags(@$_POST['produk_panjang'][$i]),
							);

				$this->db->set($set2);
				if ($this->db->insert('t_produksi_produksi')) {
					$this->session->set_flashdata('success', 'Data berhasil di simpan');
				}else{
					$this->session->set_flashdata('gagal', 'Data gagal di simpan');
				}
			}
		}

		redirect(base_url('penjualan/so'));
	}
	function so_view($id){
		
		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");

		//kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 'p' AND kontak_hapus = 0");

	    //produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    //gudang
	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

		$data['view'] = 1;

		$data["title"] = 'proses';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/so_form');
	    $this->load->view('penjualan/so_form_edit'); 
	    $this->load->view('v_template_admin/admin_footer');
	}
	function get_produksi($nomor){

		$data = $this->query_builder->view("SELECT * FROM t_produksi_produksi WHERE produksi_produksi_nomor = '$nomor'");
		echo json_encode($data);
	}


	//proses penjualan
	function so_proses($id){

		//data
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");

		//produk
	    $data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 'p' AND kontak_hapus = 0");

	    //gudang
	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'penjualan'");

		$data['url'] = 'produk';
		$data["title"] = 'proses';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit_so'); 
	    $this->load->view('v_template_admin/admin_footer');
	}

////////////////// Produk ///////////////////////////////

	function produk()
	{
		if ( $this->session->userdata('login') == 1) {

			$active = 'produk';
			$data["title"] = 'penjualan';
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('penjualan/produk');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
	}

	function produk_get_data(){
		
		$model = 'm_penjualan';
		$where = array('penjualan_so' => 0,'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function produk_delete($id){

		$table = 'penjualan';
		$redirect = 'produk';
		$this->delete('penjualan', $id, $redirect);
	}

	function produk_add()
	{
		$redirect = 'produk';
		$data = $this->add($redirect);
		$data['url'] = $redirect;
		$data['search'] = 1;
		$data["title"] = 'penjualan';

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_penjualan");
	    $data['nomor'] = 'PJ-'.date('dmY').'-'.($pb+1);

	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function produk_save()
	{
		//penjualan
		$so = 0;
		$redirect = 'produk';
		$where = str_replace('PJ', 'PO', strip_tags($_POST['nomor']));
		
		$cek = $this->query_builder->count("SELECT * FROM t_penjualan WHERE penjualan_nomor = '$where'");
		if ($cek > 0) {
			//update
			$this->update($so, $redirect, $where);

		} else {
			//new
			$this->save($so, $redirect);
		}
	}
	function produk_edit($id){
		
		$active = 'produk';
		$data = $this->edit($id, $active);

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function produk_view($id){
		
		$active = 'produk';
		$data = $this->edit($id, $active);

		$data['view'] = 1;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function produk_update(){

		$so = 0;
		$redirect = 'produk';
		$where = strip_tags($_POST['nomor']);
		$this->update($so, $redirect, $where);
	}

	//////// bayar piutang /////////////////////////////////////////////////

	function bayar(){
		$data["title"] = 'bayar';

		$this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/bayar');
	    $this->load->view('penjualan/bayar_modal');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function bayar_get_data(){
		$model = 'm_penjualan';
		$where = array('penjualan_piutang' => '1','penjualan_so' => '!= 0','penjualan_status' => 'belum','penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function bayar_rotate($id){
		$tanggal = strip_tags($_POST['tanggal']);
		$keterangan = strip_tags($_POST['keterangan']);
		$jumlah = strip_tags($_POST['jumlah']);
		$kurang = strip_tags($_POST['kurang']);

		//status
		if ($kurang == 0) {
			
			$status = 'lunas';
		}else{

			$status = 'belum';
		}

		$set = array(
						'penjualan_status' => $status,
						'penjualan_pelunasan' => $tanggal,
						'penjualan_pelunasan_jumlah' => $jumlah,
						'penjualan_pelunasan_keterangan' => $keterangan
					); 
		
		$where = ['penjualan_id' => $id];
		$db = $this->query_builder->update('t_penjualan',$set,$where);

		if ($db == 1) {
			
			//update produk
			$this->stok->transaksi();

			//jurnal
			// $pen = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_id = '$id'");
			// $nomor = $pen['penjualan_nomor'];
			// $total = $pen['penjualan_total']; 

			// $this->stok->jurnal_delete($nomor);
			// $this->stok->jurnal($nomor, 2, 'debit', 'piutang (penjualan produk)', $total);
			// $this->stok->jurnal($nomor, 3, 'kredit', 'stok produk', $total);
			//

			$this->session->set_flashdata('success','Berhasil di bayar');
		} else {
			$this->session->set_flashdata('gagal','Gagal di bayar');
		}

		redirect(base_url('penjualan/bayar'));
	}
	function get_nominal($id){

		$db = $this->query_builder->view_row("SELECT penjualan_total - penjualan_pelunasan_jumlah AS total FROM t_penjualan WHERE penjualan_id = '$id'");

		echo json_encode($db);

	}

    function cek()
    {	
    	echo "cek";
    	$this->stok->penjualan();
    }
}
<?php
class Pembelian extends CI_Controller{
 
	function __construct(){  
		parent::__construct();
		$this->load->model('m_pembelian'); 
		$this->load->model('m_pembelian_umum');
		$this->load->model('m_bahan');
		$this->load->model('m_partial');  
	}    

///////////////////////// pembelian //////////////////////////////////////////////////

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
	function serverside_pembelian($where,$model,$group){
	    $data = $this->$model->get_datatables($where, $group);
		$total = $this->$model->count_all($where, $group);
		$filter = $this->$model->count_filtered($where, $group);
 
		$output = array(
			"draw" => $_GET["draw"],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);

		return $output; 
	} 
	function add(){

		//kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //barang
	    $data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_kode != 'BH000' AND bahan_hapus = 0");

	    //gudang
	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

	    //ekspedisi
	    $data['ekspedisi_data'] = $this->query_builder->view("SELECT * FROM t_ekspedisi WHERE ekspedisi_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");

	    return $data;
	}
	function delete($table, $id, $redirect){
		$set = ["{$table}_hapus" => 1];
		$where = ["{$table}_id" => $id];
		$db = $this->query_builder->update("t_{$table}",$set,$where);

		//get nomor
		$get = $this->db->query("SELECT * FROM t_{$table} WHERE {$table}_id = '$id'")->row_array();
		$nomor = $get[$table.'_nomor'];

		if ($db == 1) {
			
			//update library
			$this->stok->transaksi();
			$this->kartu->delete($nomor);
			$this->saldo_stok->delete($nomor);

			//jurnal
			// if ($table == 'pembelian') {
			// 	$pem = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");
			// 	$nomor = $pem['pembelian_nomor'];
			// 	$this->stok->jurnal_delete($nomor, 1);	
			// }

			$this->session->set_userdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_userdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pembelian/'.$redirect));
	}
	function get_barang($id){
		//barang
		$db = $this->query_builder->view_row("SELECT *, IFNULL(SUM(c.bahan_gudang_berat), 0) AS stok FROM t_bahan as a LEFT JOIN t_bahan_gudang AS c ON a.bahan_id = c.bahan_gudang_bahan WHERE a.bahan_id = '$id' GROUP BY a.bahan_id");
		echo json_encode($db);
	}

	// hydev added
	function get_barang_kode($kode) {
		$db = $this->query_builder->view_row("SELECT * 
			FROM t_bahan as a 
			JOIN t_satuan as b ON a.bahan_satuan = b.satuan_id 
			WHERE a.bahan_kode = '$kode'");
		echo json_encode($db);
	}

	function save($po, $proses, $redirect, $po_tanggal = '')
	{
		//pembelian
		$user = $this->session->userdata('id');
		$nomor = strip_tags($_POST['nomor']);
		$status = strip_tags($_POST['status']);
		$grandtotal = strip_tags(str_replace(',', '', $_POST['grandtotal']));
		$ekspedisi = strip_tags(str_replace(',', '', $_POST['ekspedisi_total']));
		$subtotal = strip_tags(str_replace(',', '', $_POST['subtotal']));
		$pembayaran = strip_tags($_POST['pembayaran']);
		$koof = $ekspedisi / $subtotal;

		$set1 = array( 
						'pembelian_jumlah' => COUNT($_POST['barang']),
						'pembelian_user' => $user,
						'pembelian_proses' => $proses,
						'pembelian_po' => $po,
						'pembelian_po_tanggal' => $po_tanggal,
						'pembelian_nomor' => $nomor,
						'pembelian_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_pembayaran' => $pembayaran,
						'pembelian_supplier' => strip_tags($_POST['supplier']),
						'pembelian_ekspedisi' => strip_tags(str_replace(',', '', $_POST['ekspedisi'])),
						'pembelian_gudang' => strip_tags($_POST['gudang']),
						'pembelian_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_status' => $status,
						'pembelian_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_subtotal' => $subtotal,
						'pembelian_ekspedisi_total' => $ekspedisi,
						'pembelian_ppn' => strip_tags($_POST['ppn']),
						'pembelian_grandtotal' => $grandtotal, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/pembelian';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('pembelian_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		} else {
			$result = $set1;
		}

		$db = $this->query_builder->add('t_pembelian',$result);

		//barang
		$barang = $_POST['barang'];
		
		for ($i = 0; $i < count($barang); ++$i) {

			//atribute
			$berat = strip_tags($_POST['berat'][$i]);
			$panjang = strip_tags($_POST['panjang'][$i]);
			$ekspedisi_total = $koof * $berat;

			$set2 = array(
						'pembelian_barang_id' => strip_tags($_POST['id'][$i]),
						'pembelian_barang_nomor' => $nomor,
						'pembelian_barang_terima' => strip_tags($_POST['terima'][$i]),
						'pembelian_barang_barang' => strip_tags($_POST['barang'][$i]),
						'pembelian_barang_kode' => strip_tags($_POST['kode'][$i]),
						'pembelian_barang_berat_qty' => $berat / $panjang,
						'pembelian_barang_panjang_qty' => $panjang / $berat,
						'pembelian_barang_berat' => $berat,
						'pembelian_barang_panjang' => $panjang,
						'pembelian_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'pembelian_barang_total' => strip_tags(str_replace(',', '', $_POST['total'][$i])),
						'pembelian_barang_ekspedisi' => $ekspedisi_total,
					);	

			$this->query_builder->add('t_pembelian_barang',$set2);
		}

		//terima
		if ($po != 1) {
			
			$bukti = 'BD-'.date('dmY').'-'.($this->query_builder->count("SELECT * FROM t_pembelian_terima")+1);

			$set3 = array(
							'pembelian_terima_nomor' => $nomor,
							'pembelian_terima_bukti' => $bukti,
							'pembelian_terima_barang' => implode(',', $_POST['id']), 
						);

			$this->query_builder->add('t_pembelian_terima',$set3);
		}

		if ($db == 1) {
			
			//update library
			$this->partial_stok->pembelian();
			$this->stok->transaksi();
			$this->kartu->add($nomor, 'pembelian');

			if ($status == 'lunas') {
				
				$this->saldo_stok->add($nomor, 'pembelian_bahan');
			}

			// jurnal
			// if ($po == 0) {				
			// 	if ($status == 'lunas') {
			// 	 	//lunas
			// 	 	$this->stok->jurnal($nomor, 4, 'debit', 'stok bahan baku'.$kategori, $total);
			// 	 	$this->stok->jurnal($nomor, 1, 'kredit', 'kas ( pembelian bahan '.$kategori.' )', $total);	
			// 	} else {
			// 	 	//belum
			// 	 	$this->stok->jurnal($nomor, 4, 'debit', 'stok bahan baku'.$kategori, $total);
			// 	 	$this->stok->jurnal($nomor, 6, 'kredit', 'utang ( pembelian bahan '.$kategori.' )', $total);
			// 	 }	
			// }

			$this->session->set_userdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_userdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pembelian/'.$redirect));
	}

	function edit($id, $active){

	    //data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //barang
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_id > 0");

		//gudang
		$data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");	

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");

	    //ekspedisi
	    $data['ekspedisi_data'] = $this->query_builder->view("SELECT * FROM t_ekspedisi WHERE ekspedisi_hapus = 0");

	    $data['url'] = $active;

	    return $data;
	}
	function get_pembelian($nomor, $id = ''){
		//pembelian barang

		if ($id != '') {
			
			//terima barang
			$get = $this->query_builder->view_row("SELECT * FROM t_pembelian_terima WHERE pembelian_terima_id = '$id'");
			$barang = $get['pembelian_terima_barang'];
			$db = $this->query_builder->view("SELECT * FROM t_pembelian_barang WHERE pembelian_barang_id IN($barang)");
		}else{

			$db = $this->query_builder->view("SELECT * FROM t_pembelian_barang WHERE pembelian_barang_nomor = '$nomor'");
		}

		echo json_encode($db);
	}
	function update($po, $proses, $redirect){
		$nomor = strip_tags($_POST['nomor']);
		$status = strip_tags($_POST['status']);
		$grandtotal = strip_tags(str_replace(',', '', $_POST['grandtotal']));
		$ekspedisi = strip_tags(str_replace(',', '', $_POST['ekspedisi_total']));
		$subtotal = strip_tags(str_replace(',', '', $_POST['subtotal']));
		$pembayaran = strip_tags($_POST['pembayaran']);
		$koof = $ekspedisi / $subtotal;

		$set1 = array(	
						'pembelian_proses' => $proses,
						'pembelian_po' => $po,
						'pembelian_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_pembayaran' => $pembayaran,
						'pembelian_supplier' => strip_tags($_POST['supplier']),
						'pembelian_ekspedisi' => strip_tags($_POST['ekspedisi']),
						'pembelian_gudang' => strip_tags($_POST['gudang']),
						'pembelian_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_status' => $status,
						'pembelian_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_subtotal' => $subtotal,
						'pembelian_ekspedisi_total' => $ekspedisi,
						'pembelian_ppn' => strip_tags($_POST['ppn']),
						'pembelian_grandtotal' => $grandtotal, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/pembelian';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('pembelian_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$where = ['pembelian_nomor' => $nomor];
		$db = $this->query_builder->update('t_pembelian',$result,$where);

		//save barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {

			//atribute
			$berat = strip_tags($_POST['berat'][$i]);
			$panjang = strip_tags($_POST['panjang'][$i]);
			$ekspedisi_total = $koof * $berat;
			$id = strip_tags($_POST['id'][$i]);

			$set2 = array(
						'pembelian_barang_nomor' => $nomor,
						'pembelian_barang_terima' => strip_tags($_POST['terima'][$i]),
						'pembelian_barang_barang' => strip_tags($_POST['barang'][$i]),
						'pembelian_barang_kode' => strip_tags($_POST['kode'][$i]),
						'pembelian_barang_berat_qty' => $berat / $panjang,
						'pembelian_barang_panjang_qty' => $panjang / $berat,
						'pembelian_barang_berat' => $berat,
						'pembelian_barang_panjang' => $panjang,
						'pembelian_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
						'pembelian_barang_total' => strip_tags(str_replace(',', '', $_POST['total'][$i])),
						'pembelian_barang_ekspedisi' => $ekspedisi_total,
					);	

			$this->query_builder->update('t_pembelian_barang',$set2,['pembelian_barang_id' => $id]);
		}

		if ($db == 1) {
			
			//update library
			$this->partial_stok->pembelian();
			$this->stok->transaksi();
			$this->kartu->add($nomor,'pembelian');

			if ($status == 'lunas') {
				
				$this->saldo_stok->add($nomor, 'pembelian_bahan');
			}

			//jurnal
			// if ($po == 0) {

			// 	//get kategori
			// 	$pem = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_nomor = '$nomor'");
			// 	$kategori = $pem['pembelian_kategori'];
			// 	$tanggal = $pem['pembelian_tanggal'];

			// 	//delete jurnal
			// 	$this->stok->jurnal_delete($nomor);
				
			// 	if ($status == 'l') {
			// 		//lunas
			// 		$this->stok->jurnal($nomor, 4, 'debit', 'stok bahan baku'.$kategori, $total, $tanggal);
			// 		$this->stok->jurnal($nomor, 1, 'kredit', 'kas ( pembelian bahan '.$kategori.' )', $total, $tanggal);	
			// 	} else {
			// 		//belum
			// 		$this->stok->jurnal($nomor, 4, 'debit', 'stok bahan baku'.$kategori, $total, $tanggal);
			// 		$this->stok->jurnal($nomor, 6, 'kredit', 'utang ( pembelian bahan '.$kategori.' )', $total, $tanggal);
			// 	}	
			// }

			$this->session->set_userdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_userdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/'.$redirect));
	}
	function search(){
		$output = $this->query_builder->view("SELECT pembelian_nomor as nomor FROM t_pembelian WHERE pembelian_hapus = 0 AND pembelian_po = 1");
		echo json_encode($output);
	}
	function search_data($nomor){
		$output = $this->query_builder->view("SELECT * FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_nomor = '$nomor'");
		echo json_encode($output);
	}
	function laporan($id){

		$data['title'] = 'laporan';

		$get = $this->query_builder->view_row("SELECT * FROM t_pembelian_terima WHERE pembelian_terima_id = '$id'");
		$barang = $get['pembelian_terima_barang'];
		$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian AS a LEFT JOIN t_pembelian_barang as b ON a.pembelian_nomor = b.pembelian_barang_nomor LEFT JOIN t_kontak as c ON a.pembelian_supplier = c.kontak_id LEFT JOIN t_bahan as d ON b.pembelian_barang_barang = d.bahan_id LEFT JOIN t_user as e ON a.pembelian_user = e.user_id LEFT JOIN t_satuan as f ON d.bahan_satuan = f.satuan_id WHERE a.pembelian_hapus = 0 AND b.pembelian_barang_id IN($barang)");

		$this->load->view('pembelian/laporan', $data);
	}

////////////////////////////////////////////////////////////////////////////////////////////


////////////////// Purchase Order///////////////////////////////

	function po(){
		if ( $this->session->userdata('login') == 1) {

			$active = 'po';
			$data["title"] = $active;
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/po');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}

	function po_get_data(){
		
		$model = 'm_pembelian';
		$where = array('pembelian_po' => 1,'pembelian_hapus' => 0);
		$group = 'pembelian_nomor';
		$output = $this->serverside_pembelian($where, $model, $group);
		echo json_encode($output);
	}
	function po_delete($id){

		$table = 'pembelian';
		$redirect = 'po';
		$this->delete('pembelian', $id, $redirect);
	}
	function po_add(){

		$data = $this->add();

		$redirect = 'po';
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian");
	    $data['nomor'] = 'PB-'.date('dmY').'-'.($pb+1);

	    $data['id'] = $this->query_builder->count("SELECT * FROM t_pembelian_barang")+1;

	    $data["title"] = $redirect;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function po_save(){
		
		$po = 1;
		$proses = 0;
		$redirect = 'po';
		$po_tanggal = date('Y-m-d');
		$this->save($po, $proses, $redirect, $po_tanggal);
	}
	function po_edit($id){
		
		$active = 'po';
		$data = $this->edit($id, $active);

		$data["title"] = $active;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function po_view($id){
		
		$active = 'po';
		$data = $this->edit($id, $active);

		$data["title"] = $active;
		$data["view"] = 1;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function po_update(){

		$po = 1;
		$proses = 1;
		$redirect = 'po';
		$this->update($po, $proses, $redirect);
	}
	function po_proses($id){

		$active = 'po';
		$data = $this->edit($id, $active);

		$data["title"] = $active;
		$data["url"] = 'rotate';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/terima');
	    $this->load->view('pembelian/terima_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}


	///////////// terima pembelian PO ////////////////////

	function terima_get_data($nomor){
		//pembelian barang po
		$db = $this->query_builder->view("SELECT * FROM t_pembelian_barang WHERE pembelian_barang_nomor = '$nomor' AND pembelian_barang_terima = 0");

		echo json_encode($db);
	}
	function terima_save(){

		//simpan terima
	    $bukti = 'BD-'.date('dmY').'-'.($this->query_builder->count("SELECT * FROM t_pembelian_terima")+1);

	    $arr = array();
		for ($i=0; $i < count($_POST['barang']); $i++) { 
			
			$terima = strip_tags(@$_POST['terima'][$i]);
			$id = strip_tags(@$_POST['id'][$i]);

			if ($terima == 1) {
				
				$arr[] = $id;
			}
		}

		$set = array(
						'pembelian_terima_nomor' => strip_tags(@$_POST['nomor']),
						'pembelian_terima_bukti' => $bukti,
						'pembelian_terima_barang' => implode(',', $arr), 
					);

		$this->query_builder->add('t_pembelian_terima',$set);
		
		//ubah status pembelian
		$redirect = 'utama';
		$proses = 1;
		$this->update($po = 1, $proses, $redirect);
	}


////////// pembelian bahan ///////////////////////////////////

	function utama($x = '')
	{
		if ( $this->session->userdata('login') == 1) {

		    $active = 'utama';
			$data["title"] = $active; 
			$data['url'] = $active;
		    
		    if ($x == '') {
		    	
		    	$this->load->view('v_template_admin/admin_header',$data);
		    	$this->load->view('pembelian/utama');
		    	$this->load->view('v_template_admin/admin_footer');

		    }else{

		    	//partial stok

		    	$kode = strip_tags(@$_POST['kode']);
		    	$x1 = str_replace(', ', ',', $kode);
		    	$x2 = '"'.str_replace(',', '","', $x1).'"';
			
				$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian as a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor JOIN t_bahan AS c ON b.pembelian_barang_barang = c.bahan_id WHERE b.pembelian_barang_kode IN($x2) AND a.pembelian_hapus = 0 AND a.pembelian_proses = 1 AND b.pembelian_barang_berat_cek <= b.pembelian_barang_berat AND b.pembelian_barang_panjang_cek <= b.pembelian_barang_panjang");
			    
			    $this->load->view('v_template_admin/admin_header',$data);
			    $this->load->view('pembelian/partial');
			    $this->load->view('v_template_admin/admin_footer');
		    }

		} else {
			redirect(base_url('login'));
		}
	}

	function utama_get_data(){
		
		$model = 'm_pembelian';
		$where = array('pembelian_proses' => 1,'pembelian_terima_hapus' => 0);
		$group = 'pembelian_terima_bukti';
		$output = $this->serverside_pembelian($where, $model, $group);
		echo json_encode($output);
	}
	function utama_add()
	{		
		$kategori = 'utama';
		$redirect = 'utama';
		$data = $this->add($kategori, $redirect);
		$data['url'] = $redirect;

		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian");
	    $data['nomor'] = 'PB-'.date('dmY').'-'.($pb+1);
	    
	    $data['id'] = $this->query_builder->count("SELECT * FROM t_pembelian_barang")+1;

	    $data["title"] = $redirect;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('v_template_admin/admin_footer');
	}

	function utama_save()
	{
		$po = 0;
		$proses = 1;
		$redirect = 'utama';
		$where = strip_tags($_POST['nomor']);

		$cek = $this->query_builder->count("SELECT * FROM t_pembelian WHERE pembelian_nomor = '$where'");
		if ($cek > 0) {
			// update
			$this->update($po, $proses, $redirect);

		} else {
			// new
			$this->save($po, $proses, $redirect);
		}

	}
	function utama_edit($id){ 
		
		$active = 'utama';
		
		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian as a LEFT JOIN t_pembelian_terima as b ON a.pembelian_nomor = b.pembelian_terima_nomor WHERE b.pembelian_terima_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //barang
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_id > 0");

		//gudang
		$data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");	

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");

	    //ekspedisi
	    $data['ekspedisi_data'] = $this->query_builder->view("SELECT * FROM t_ekspedisi WHERE ekspedisi_hapus = 0");

	    $data['url'] = $active;

		$data["title"] = $active;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function utama_view($id){
		
		$active = 'utama';
		
		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian as a LEFT JOIN t_pembelian_terima as b ON a.pembelian_nomor = b.pembelian_terima_nomor WHERE b.pembelian_terima_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //kontak
	    $data['kontak_data'] = $this->query_builder->view("SELECT * FROM t_kontak WHERE kontak_jenis = 's' AND kontak_hapus = 0");

	    //barang
		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_bahan WHERE bahan_hapus = 0 AND bahan_id > 0");

		//gudang
		$data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");	

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");

	    //ekspedisi
	    $data['ekspedisi_data'] = $this->query_builder->view("SELECT * FROM t_ekspedisi WHERE ekspedisi_hapus = 0");

	    $data['url'] = $active;

		$data["title"] = $active;

		$data["view"] = 1;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/form');
	    $this->load->view('pembelian/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function utama_update(){

		$po = 0;
		$proses = 1;
		$redirect = 'utama';
		$this->update($po, $proses, $redirect);
	}
	function utama_delete($id){
		
		//delete & ubah status pembelian
		$db = $this->query_builder->view_row("SELECT * FROM t_pembelian_terima WHERE pembelian_terima_id = '$id'");
		$nomor = $db['pembelian_terima_nomor'];

		$this->query_builder->update("t_pembelian",['pembelian_proses' => 0], ['pembelian_nomor' => $nomor]);
		$this->query_builder->update("t_pembelian_barang",['pembelian_barang_terima' => 0], ['pembelian_barang_nomor' => $nomor]);
		//

		if ($this->query_builder->delete("t_pembelian_terima",['pembelian_terima_id' => $id])) {	
			
			//stok
			$this->stok->transaksi();

			$this->session->set_userdata('success','Data berhasil di tambah');
		} else {
			
			$this->session->set_userdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pembelian/utama'));
	}

//////// umum /////////////////////////////////////////////////

	function umum(){
		if ( $this->session->userdata('login') == 1) {

		    $data["title"] = 'pembelian umum';
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/umum');
		    $this->load->view('v_template_admin/admin_footer');

		}
		else{
			redirect(base_url('login'));
		}
	}
	function umum_get_data(){
		
		$model = 'm_pembelian_umum';
		$where = array('pembelian_umum_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function umum_add(){

		//rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //gudang
	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");
		
		//generate nomor transaksi
	    $pb = $this->query_builder->count("SELECT * FROM t_pembelian_umum");
	    $data['nomor'] = 'PU-'.date('dmY').'-'.($pb+1);

	    $data["title"] = 'pembelian umum';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('pembelian/umum_add');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function umum_save(){
		
		//pembelian umum
		$user = $this->session->userdata('id');
		$nomor = strip_tags($_POST['nomor']);
		$total = strip_tags(str_replace(',', '', $_POST['total']));
		$pembayaran = strip_tags($_POST['pembayaran']);
		$status = strip_tags($_POST['status']);

		$set1 = array(
						'pembelian_umum_user' => $user,
						'pembelian_umum_nomor' => $nomor,
						'pembelian_umum_gudang' => strip_tags($_POST['gudang']),
						'pembelian_umum_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_umum_pembayaran' => $pembayaran,
						'pembelian_umum_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_umum_status' => $status,
						'pembelian_umum_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_umum_qty_akhir' => strip_tags($_POST['qty_akhir']),
						'pembelian_umum_ppn' => strip_tags($_POST['ppn']),
						'pembelian_umum_total' => $total, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/pembelian_umum';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('pembelian_umum_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$db = $this->query_builder->add('t_pembelian_umum',$result);

		//barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'pembelian_umum_barang_nomor' => $nomor,
						'pembelian_umum_barang_barang' => strip_tags($_POST['barang'][$i]),
						'pembelian_umum_barang_qty' => strip_tags($_POST['qty'][$i]),
						'pembelian_umum_barang_potongan' => strip_tags($_POST['potongan'][$i]),
						'pembelian_umum_barang_harga' => strip_tags($_POST['harga'][$i]),
						'pembelian_umum_barang_subtotal' => strip_tags($_POST['subtotal'][$i]),
					);	

			$this->query_builder->add('t_pembelian_umum_barang',$set2);
		}

		if ($db == 1) {

			if ($status == 'lunas') {
				
				//update library
				$this->saldo_stok->add($nomor, 'pembelian_umum');
			}
			
			$this->session->set_userdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_userdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('pembelian/umum'));
	}
	function umum_edit($id){

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian_umum WHERE pembelian_umum_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //gudang
	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang WHERE gudang_hapus = 0");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");
		
		$data["title"] = 'pembelian umum';
		    
		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('pembelian/umum_add');
		$this->load->view('pembelian/umum_edit');
		$this->load->view('v_template_admin/admin_footer');
	}
	function umum_view($id){

		//data
	    $data['data'] = $this->query_builder->view_row("SELECT * FROM t_pembelian_umum WHERE pembelian_umum_id = '$id'");

	    //rekening
	    $data['rekening_data'] = $this->query_builder->view("SELECT * FROM t_rekening WHERE rekening_hapus = 0");

	    //gudang
	    $data['gudang_data'] = $this->query_builder->view("SELECT * FROM t_gudang");

	    //ppn
	    $data['ppn'] = $this->query_builder->view_row("SELECT * FROM t_pajak WHERE pajak_jenis = 'pembelian'");
		
		$data["title"] = 'pembelian umum';
		$data["view"] = 1;
		    
		$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('pembelian/umum_add');
		$this->load->view('pembelian/umum_edit');
		$this->load->view('v_template_admin/admin_footer');
	}
	function get_pembelian_umum($nomor){
		//pembelian barang
		$db = $this->query_builder->view("SELECT * FROM t_pembelian_umum_barang WHERE pembelian_umum_barang_nomor = '$nomor'");
		echo json_encode($db);
	}	
	function umum_update($nomor){

		$total = strip_tags(str_replace(',', '', $_POST['total']));
		$pembayaran = strip_tags($_POST['pembayaran']);
		$status = strip_tags($_POST['status']);

		$set1 = array(
						'pembelian_umum_tanggal' => strip_tags($_POST['tanggal']),
						'pembelian_umum_pembayaran' => $pembayaran,
						'pembelian_umum_jatuh_tempo' => strip_tags($_POST['jatuh_tempo']),
						'pembelian_umum_status' => $status,
						'pembelian_umum_keterangan' => strip_tags($_POST['keterangan']),
						'pembelian_umum_qty_akhir' => strip_tags($_POST['qty_akhir']),
						'pembelian_umum_ppn' => strip_tags($_POST['ppn']),
						'pembelian_umum_total' => $total, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if ($lampiran['name']) {

			$file = $lampiran;
			$path = './assets/gambar/pembelian_umum';
			$name = 'lampiran';
			$upload = $this->upload_builder->single($file,$path,$name);	

      		if ($upload != 0) {
      			$push = array('pembelian_umum_lampiran' => $upload);
	          	$result = array_merge($set1,$push);
     		}	

		}else{
			$result = $set1;
		}

		$where1 = ['pembelian_umum_nomor' => $nomor];
		$db = $this->query_builder->update('t_pembelian_umum',$result,$where1);

		//delete barang
		$where2 = ['pembelian_umum_barang_nomor' => $nomor];
		$this->query_builder->delete('t_pembelian_umum_barang',$where2);

		//save barang
		$barang = $_POST['barang'];
		$jum = count($barang);
		
		for ($i = 0; $i < $jum; ++$i) {
			$set2 = array(
						'pembelian_umum_barang_nomor' => $nomor,
						'pembelian_umum_barang_barang' => strip_tags($_POST['barang'][$i]),
						'pembelian_umum_barang_qty' => strip_tags($_POST['qty'][$i]),
						'pembelian_umum_barang_potongan' => strip_tags($_POST['potongan'][$i]),
						'pembelian_umum_barang_harga' => strip_tags($_POST['harga'][$i]),
						'pembelian_umum_barang_subtotal' => strip_tags($_POST['subtotal'][$i]),
					);	

			$this->query_builder->add('t_pembelian_umum_barang',$set2);
		}

		if ($db == 1) {

			if ($status == 'lunas') {
				
				//update library
				$this->saldo_stok->add($nomor, 'pembelian_umum');
			}

			$this->session->set_userdata('success','Data berhasil di rubah');
		} else {
			$this->session->set_userdata('gagal','Data gagal di rubah');
		}

		redirect(base_url('pembelian/umum'));
	}
	function umum_delete($id){
		
		$db = $this->query_builder->update("t_pembelian_umum",['pembelian_umum_hapus' => 1],['pembelian_umum_id' => $id]);

		//get nomor
		$get = $this->db->query("SELECT * FROM t_pembelian_umum WHERE pembelian_umum_id = '$id'")->row_array();
		$nomor = $get['pembelian_umum_nomor'];

		if ($db == 1) {

			//update library
			$this->saldo_stok->delete($nomor);

			$this->session->set_userdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_userdata('gagal','Data gagal di hapus');
		}

		redirect(base_url('pembelian/umum'));
	}
	function laporan_umum($id){
		$data['title'] = 'laporan';

		$data['data'] = $this->query_builder->view("SELECT * FROM t_pembelian_umum as a JOIN t_pembelian_umum_barang as b ON a.pembelian_umum_nomor = b.pembelian_umum_barang_nomor JOIN t_user as c ON a.pembelian_umum_user = c.user_id WHERE a.pembelian_umum_hapus = 0 AND a.pembelian_umum_id = '$id'");

		$this->load->view('pembelian/umum_laporan', $data);
	}

//////// bayar hutang /////////////////////////////////////////////////

	function bayar($jenis = ''){
		$data["title"] = 'bayar';

		if ($jenis == 'umum') {
			$data['bayar_active'] = 'umum';
			$this->load->view('v_template_admin/admin_header',$data);
	    	$this->load->view('pembelian/bayar_umum');
	    	$this->load->view('pembelian/bayar_modal');
	    	$this->load->view('v_template_admin/admin_footer');
		}else{
			$data['bayar_active'] = 'bahan';
			$this->load->view('v_template_admin/admin_header',$data);
	    	$this->load->view('pembelian/bayar');
	    	$this->load->view('pembelian/bayar_modal');
	    	$this->load->view('v_template_admin/admin_footer');
		}
	}
	function bayar_get_data($jenis = ''){
		
		if ($jenis == 'umum') {
			$model = 'm_pembelian_umum';
			$where = array('pembelian_umum_status' => 'belum','pembelian_umum_hapus' => 0);
		}else{
			$model = 'm_pembelian';
			$where = array('pembelian_status' => 'belum','pembelian_po' => 0,'pembelian_hapus' => 0);
		}
	
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function bayar_rotate($jenis, $id){
		$tanggal = strip_tags($_POST['tanggal']);
		$keterangan = strip_tags($_POST['keterangan']);

		if ($jenis == 'bahan') {

			//pembelian bahan

			$get = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");
			$nomor = $get['pembelian_nomor'];

			$set = ['pembelian_status' => 'lunas', 'pembelian_pelunasan' => $tanggal, 'pembelian_pelunasan_keterangan' => $keterangan];
			$where = ['pembelian_id' => $id];

			$db = $this->query_builder->update('t_pembelian',$set,$where);

			if ($db == 1) {
				
				//update stok bahan
				$this->stok->transaksi();
				$this->saldo_stok->add($nomor, 'pembelian_bahan');

				$this->session->set_userdata('success','Berhasil di bayar');
			} else {
				$this->session->set_userdata('gagal','Gagal di bayar');
			}	
		}else{

			//pembelian umum

			$get = $this->query_builder->view_row("SELECT * FROM t_pembelian_umum WHERE pembelian_umum_id = '$id'");
			$nomor = $get['pembelian_umum_nomor'];

			$set = ['pembelian_umum_status' => 'l', 'pembelian_umum_pelunasan' => $tanggal, 'pembelian_umum_pelunasan_keterangan' => $keterangan];
			$where = ['pembelian_umum_id' => $id];

			$db = $this->query_builder->update('t_pembelian_umum',$set,$where);

			if ($db == 1) {
				
				//update stok bahan
				$this->stok->transaksi();
				$this->saldo_stok->add($nomor, 'pembelian_umum');

				$this->session->set_userdata('success','Berhasil di bayar');
			} else {
				$this->session->set_userdata('gagal','Gagal di bayar');
			}	
		}

		redirect(base_url('pembelian/bayar/'.$jenis));
	}
	function bayar_edit($id, $jenis = ''){

		if ($jenis == 'umum') {

			$this->umum_edit($id);

		}else{

			//ambil kategori
			$db = $this->query_builder->view_row("SELECT * FROM t_pembelian WHERE pembelian_id = '$id'");

			$active = 'bayar';
			$data = $this->edit($id, $active);
			$data["title"] = $active;

			$this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/form');
		    $this->load->view('pembelian/form_edit');
		    $this->load->view('v_template_admin/admin_footer');
		}
	}
	function bayar_update(){

		$po = 0;
		$proses = 1;
		$redirect = 'bayar';
		$this->update($po, $proses, $redirect);
	}

	///////////////////////// partial stok //////////////////////

	function partial_save(){
        
        $berat = @$_POST['berat'];

        for ($i = 0; $i < count($berat); ++$i) {

            $nomor = strip_tags(@$_POST['nomor'][$i]);
            $panjang = strip_tags(@$_POST['panjang'][$i]);            
            $barang = strip_tags(@$_POST['barang'][$i]);
            $kode = strip_tags(@$_POST['kode'][$i]);

            $set = array(
                    'pembelian_partial_nomor' => $nomor,
                    'pembelian_partial_barang' => $barang,
                    'pembelian_partial_berat' => $berat[$i],
                    'pembelian_partial_panjang' => $panjang,
                    'pembelian_partial_kode' => $kode, 
                );

            $db = $this->query_builder->add('t_pembelian_partial',$set);

            //update stok bahan & kartu stok
            $this->partial_stok->pembelian();
        }

        if ($db == 1) {
        	
        	//update stok	
        	$this->stok->transaksi();
            $this->kartu->add($nomor, 'pembelian');

            $this->session->set_userdata('success', 'Data berhasil di simpan');
        }else{
            $this->session->set_userdata('gagal', 'Data gagal di simpan');
        }

        redirect(base_url('pembelian/utama'));
    }

    function partial_list(){

    	if ( $this->session->userdata('login') == 1) {

		    $active = 'utama';
			$data["title"] = $active; 
			$data['url'] = $active;
		    
		    $this->load->view('v_template_admin/admin_header',$data);
		    $this->load->view('pembelian/partial_list');
		    $this->load->view('v_template_admin/admin_footer');

		} else {
			redirect(base_url('login'));
		}
    }

    function partial_get_data(){
		
		$model = 'm_partial';
		$where = array('pembelian_partial_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
}
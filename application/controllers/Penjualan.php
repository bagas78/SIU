<?php
class Penjualan extends CI_Controller{

	function __construct(){ 
		parent::__construct(); 
		$this->load->model('m_penjualan');
		$this->load->model('m_penjualan_so'); 
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

		//get nomor
		$get = $this->db->query("SELECT * FROM t_{$table} WHERE {$table}_id = '$id'")->row_array();
		$nomor = $get[$table.'_nomor'];

		if ($db == 1) {
			
			//update produk & kartu stok
			$this->stok->transaksi();
			$this->kartu->delete($nomor);
			$this->saldo_stok->delete($nomor);

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

		$db = $this->query_builder->view_row("SELECT * FROM t_produk AS a LEFT JOIN t_produk_gudang AS b ON a.produk_id = b.produk_gudang_produk WHERE a.produk_id = '$id' AND b.produk_gudang_gudang = '$gudang'");

		if (@$db) {	

			//penjualan
			$data = $db;

		}else{

			//SO
			$data = $this->query_builder->view_row("SELECT * FROM t_produk WHERE produk_id = '$id'");
			
		}	

		echo json_encode($data);
	}
	function get_batang($id = ''){
		$db = $this->query_builder->view_row("SELECT * FROM t_produk WHERE produk_id = '$id'");
		echo json_encode($db);
	}
	function save($so, $proses, $redirect, $so_tanggal = '')
	{
		//penjualan
		$nomor = strip_tags(@$_POST['nomor']);
		$status = strip_tags(@$_POST['status']);
		$grandtotal = strip_tags(str_replace(',', '', @$_POST['grandtotal']));
		$gudang = strip_tags(@$_POST['gudang']);
		$pelanggan = strip_tags(@$_POST['pelanggan']);
		$pembayaran = strip_tags(@$_POST['pembayaran']);

		$set1 = array(
						'penjualan_proses' => $proses,
						'penjualan_so' => $so,
						'penjualan_so_tanggal' => $so_tanggal,
						'penjualan_nomor' => $nomor,
						'penjualan_ambil' => strip_tags(@$_POST['ambil']),
						'penjualan_tanggal' => strip_tags(@$_POST['tanggal']),
						'penjualan_pelanggan' => $pelanggan,
						'penjualan_jatuh_tempo' => strip_tags(@$_POST['jatuh_tempo']),
						'penjualan_pembayaran' => $pembayaran,
						'penjualan_status' => $status,
						'penjualan_gudang' => $gudang,
						'penjualan_keterangan' => strip_tags(@$_POST['keterangan']),
						'penjualan_subtotal' => strip_tags(str_replace(',', '', @$_POST['subtotal'])),
						'penjualan_ppn' => strip_tags(str_replace(',', '', @$_POST['ppn'])),
						'penjualan_grandtotal' => $grandtotal, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if (@$lampiran['name']) {

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

		$db1 = $this->query_builder->add('t_penjualan',$result);

		if ($db1 == 1) {

			//barang
			$barang = $_POST['barang'];
			$jum = count($barang);
			
			for ($i = 0; $i < $jum; ++$i) {

				$stok = strip_tags(@$_POST['stok'][$i]);
				$produk = strip_tags(@$_POST['barang'][$i]);
				$konversi = strip_tags(@$_POST['konversi'][$i]);
				$batang = strip_tags(@$_POST['batang'][$i]);
				$qty = strip_tags(@$_POST['qty'][$i]);
				$panjang_total = strip_tags(@$_POST['panjang_total'][$i]);
				$panjang = strip_tags(@$_POST['panjang'][$i]);

				$set2 = array(
							'penjualan_barang_nomor' => $nomor,
							'penjualan_barang_barang' => $produk,
							'penjualan_barang_konversi' => $konversi,
							'penjualan_barang_batang' => $batang,
							'penjualan_barang_panjang' => $panjang,
							'penjualan_barang_stok' => $stok,
							'penjualan_barang_qty' => $qty,
							'penjualan_barang_panjang_total' => $panjang_total,
							'penjualan_barang_harga' => strip_tags(str_replace(',', '', @$_POST['harga'][$i])),
							'penjualan_barang_hps' => strip_tags(str_replace(',', '', @$_POST['hps'][$i])),
							'penjualan_barang_total' => strip_tags(str_replace(',', '', @$_POST['total'][$i])),
						);	

				$this->query_builder->add('t_penjualan_barang',$set2);

				//masuk SO produksi
				if ($so == 1) {

					//save produksi produksi 
					$set3 = array(
									'produksi_produksi_nomor' => $nomor,
									'produksi_produksi_produk' => $produk,
									'produksi_produksi_konversi' => $konversi,
									'produksi_produksi_batang' => $batang,
									'produksi_produksi_panjang' => $panjang,
									'produksi_produksi_qty' => $qty,
									'produksi_produksi_panjang_total' => $panjang_total,
								);

					$this->query_builder->add('t_produksi_produksi',$set3);

				}
			}

			//masuk SO produksi
			if ($so == 1) {
				
				//save produksi
				$set4 = array(
								'produksi_so' => 1,
								'produksi_nomor' => $nomor,
								'produksi_gudang' => $gudang,
								'produksi_pelanggan' => $pelanggan,
							);

				$db2 = $this->query_builder->add('t_produksi',$set4);
			}

			//update library
			$this->stok->transaksi();
			$this->kartu->add($nomor, 'penjualan');

			if ($status == 'lunas') {
				
				$this->saldo_stok->add($nomor, 'penjualan');
			}

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
	function edit($id, $active = '', $s = 0){

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
		$db = $this->query_builder->view("SELECT * FROM t_penjualan AS a LEFT JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_produk_gudang AS c ON b.penjualan_barang_barang = c.produk_gudang_produk WHERE b.penjualan_barang_nomor = '$nomor' GROUP BY b.penjualan_barang_id");
		echo json_encode($db);
	}
	function update($so, $proses, $redirect, $so_tanggal = ''){

		//get id
		$xnomor = strip_tags(@$_POST['nomor']);
		$xdb = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_nomor = '$xnomor'");
		$id = $xdb['penjualan_id'];

		if ($so == 1 && $proses == 1) {
			//SO jadi PR
			$nomor = str_replace('SO', 'PJ', $xnomor);
		}else{
			//tetap
			$nomor = $xnomor;
		}

		$status = strip_tags(@$_POST['status']);
		$grandtotal = strip_tags(str_replace(',', '', @$_POST['grandtotal']));
		$pembayaran = strip_tags(@$_POST['pembayaran']);

		//piutang status
		if ($status == 'belum') { $piutang = '1'; }else{ $piutang = '0'; }

		$set1 = array(
						'penjualan_proses' => $proses,
						'penjualan_so' => $so,
						'penjualan_so_tanggal' => $so_tanggal,
						'penjualan_piutang' => $piutang,
						'penjualan_nomor' => $nomor,
						'penjualan_ambil' => strip_tags(@$_POST['ambil']),
						'penjualan_tanggal' => strip_tags(@$_POST['tanggal']),
						'penjualan_pelanggan' => strip_tags(@$_POST['pelanggan']),
						'penjualan_jatuh_tempo' => strip_tags(@$_POST['jatuh_tempo']),
						'penjualan_pembayaran' => $pembayaran,
						'penjualan_status' => $status,
						'penjualan_gudang' => strip_tags(@$_POST['gudang']),
						'penjualan_keterangan' => strip_tags(@$_POST['keterangan']),
						'penjualan_subtotal' => strip_tags(str_replace(',', '', @$_POST['subtotal'])),
						'penjualan_ppn' => strip_tags(str_replace(',', '', @$_POST['ppn'])),
						'penjualan_grandtotal' => $grandtotal, 
					);

		//upload lampiran
		$lampiran = @$_FILES['lampiran'];
		if (@$lampiran['name']) {

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

		$db = $this->query_builder->update('t_penjualan',$result,['penjualan_id' => $id]);

		if ($db == 1) {

			//barang
			$barang = $_POST['barang'];
			$jum = count($barang);

			//delete all data
			$this->query_builder->delete('t_penjualan_barang',['penjualan_barang_nomor' => $xnomor]);
			
			for ($i = 0; $i < $jum; ++$i) {

				$set2 = array(
							'penjualan_barang_nomor' => $nomor,
							'penjualan_barang_barang' => strip_tags($_POST['barang'][$i]),
							'penjualan_barang_konversi' => strip_tags(str_replace(',', '', @$_POST['konversi'][$i])),
							'penjualan_barang_batang' => strip_tags(str_replace(',', '', $_POST['batang'][$i])),
							'penjualan_barang_panjang' => strip_tags( $_POST['panjang'][$i]),
							'penjualan_barang_qty' => strip_tags(str_replace(',', '', $_POST['qty'][$i])),
							'penjualan_barang_panjang_total' => strip_tags($_POST['panjang_total'][$i]),
							'penjualan_barang_stok' => strip_tags(str_replace(',', '', $_POST['stok'][$i])),
							'penjualan_barang_harga' => strip_tags(str_replace(',', '', $_POST['harga'][$i])),
							'penjualan_barang_hps' => strip_tags(str_replace(',', '', $_POST['hps'][$i])),
							'penjualan_barang_total' => strip_tags(str_replace(',', '', $_POST['total'][$i])),
						);	

				$this->query_builder->add('t_penjualan_barang',$set2);
			}

			//update library
			$this->stok->transaksi();
			$this->kartu->add($nomor, 'penjualan');

			if ($status == 'lunas') {
				
				$this->saldo_stok->add($nomor, 'penjualan');
			}

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
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a LEFT JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_produk AS c ON b.penjualan_barang_barang = c.produk_id LEFT JOIN t_kontak as d ON a.penjualan_pelanggan = d.kontak_id WHERE a.penjualan_id = '$id'");

		
		$this->load->view('penjualan/faktur',$data);
	}
	function faktur_produksi($no){
		$data["title"] = 'faktur';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a LEFT JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_produk AS c ON b.penjualan_barang_barang = c.produk_id LEFT JOIN t_kontak as d ON a.penjualan_pelanggan = d.kontak_id WHERE a.penjualan_nomor = '$no'");

		
		$this->load->view('penjualan/faktur_antrian_so',$data);
	}
	function faktur_so($id){
		$data["title"] = 'faktur';
		$data['data'] = $this->query_builder->view("SELECT * FROM t_penjualan AS a LEFT JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor LEFT JOIN t_produk AS c ON b.penjualan_barang_barang = c.produk_id LEFT JOIN t_kontak as d ON a.penjualan_pelanggan = d.kontak_id WHERE a.penjualan_id = '$id'");

		
		$this->load->view('penjualan/faktur_so',$data);
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
		$model = 'm_penjualan_so';
		$where = array('penjualan_so' => 1, 'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}

	function so_get_proses()
	{		
		$model = 'm_penjualan';
		$where = array('penjualan_so' => 1, 'penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}

	function so_delete($id){

		$table = 'penjualan';
		$redirect = 'so';
		$this->delete('penjualan', $id, $redirect);
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
		//penjualan
		$so = 1;
		$where = strip_tags($_POST['nomor']);
		$redirect = 'so';
		$cek = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_nomor = '$where'");
		if (@$cek) { 
			//update
			$proses = $cek['penjualan_proses'];
			$this->update($so, $proses, $redirect);

		} else {
			//new
			$proses = 0;
			$this->save($so, $proses, $redirect);
		}
	}
	function so_view($id){
		
		$active = 'produk';
		$data = $this->edit($id, $active, 1);

		$data['view'] = 1;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function so_proses($id){

		$active = 'so_proses';
		$data = $this->edit($id, $active);
		$data["title"] = $active;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function so_proses_save(){
		//penjualan
		$redirect = 'produk';
		$proses = 1;
		$so = 1;
		$this->update($so, $proses, $redirect);
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
		$where = array('penjualan_proses' => 1,'penjualan_hapus' => 0);
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
		$proses = 1;
		$redirect = 'produk';
		$where = strip_tags($_POST['nomor']);
		$cek = $this->query_builder->view_row("SELECT * FROM t_penjualan WHERE penjualan_nomor = '$where'");
		if (@$cek) {
			//update
			$so = $cek['penjualan_so'];
			$this->update($so, $proses, $redirect);

		} else {
			//new
			$so = 0;
			$this->save($so, $proses, $redirect);
		}
	}
	function so_edit($id){
		
		$active = 'so';
		$data = $this->edit($id, $active, 1);

		$data["title"] = 'edit';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function produk_view($id){
		
		$active = 'produk';
		$data = $this->edit($id, $active);

		$data["title"] = 'view';
		$data['view'] = 1;

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function produk_edit($id){
		
		$active = 'produk';
		$data = $this->edit($id, $active);

		$data["title"] = 'edit';

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('penjualan/form');
	    $this->load->view('penjualan/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}	
	function produk_update(){

		$so = 0;
		$redirect = 'produk';
		$proses = 1;

		$this->update($so, $proses, $redirect);
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
		$where = array('penjualan_piutang' => '1','penjualan_proses' => '1','penjualan_status' => 'belum','penjualan_hapus' => 0);
		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function bayar_rotate($id){
		$tanggal = strip_tags(@$_POST['tanggal']);
		$keterangan = strip_tags(@$_POST['keterangan']);
		$jumlah = strip_tags(str_replace(',', '', @$_POST['jumlah']));
		$kurang = strip_tags(str_replace(',', '', @$_POST['kurang']));

		//get nomor
		$get = $this->query_builder->view_row("SELECT * FROm t_penjualan WHERE penjualan_id = '$id'");
		$nomor = $get['penjualan_nomor'];

		//status
		if ($kurang == 0) {

			//update library
			$this->saldo_stok->add($nomor, 'penjualan');
			
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
			// $total = $pen['penjualan_grandtotal']; 

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

		$db = $this->query_builder->view_row("SELECT penjualan_grandtotal - penjualan_pelunasan_jumlah AS total FROM t_penjualan WHERE penjualan_id = '$id'");

		echo json_encode($db);

	}

    function cek()
    {	
    	echo "cek";
    	$this->stok->penjualan();
    }
}
<?php
class Produksi extends CI_Controller{

	function __construct(){
		parent::__construct();  
		$this->load->model('m_produksi'); 
		$this->load->model('m_produksi_so'); 
		$this->load->model('m_produksi_log'); 
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

	function save($redirect, $proses, $so = 0, $so_tanggal = '')
	{
		$log_id = @$_POST['log_id'];
		$nomor = strip_tags(@$_POST['nomor']);
		$grandtotal = strip_tags(str_replace(',', '', @$_POST['grandtotal']));
		$set1 = array(
					'produksi_proses' => $proses,
					'produksi_so' => $so,
					'produksi_so_tanggal' => $so_tanggal,
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

		if ($db == 1) {

			//produk
			$produk = @$_POST['produk'];
			$jum_produk = count($produk);

			for ($i = 0; $i < $jum_produk; ++$i) {

				$set2 = array(
							'produksi_produksi_log' => $log_id,
							'produksi_produksi_nomor' => $nomor,
							'produksi_produksi_produk' => strip_tags(@$produk[$i]),
							'produksi_produksi_konversi' => strip_tags(str_replace(',', '', @$_POST['produk_konversi'][$i])),
							'produksi_produksi_batang' => strip_tags(str_replace(',', '', @$_POST['produk_batang'][$i])),
							'produksi_produksi_panjang' => strip_tags(str_replace(',', '', @$_POST['produk_panjang'][$i])),
							'produksi_produksi_qty' => strip_tags(str_replace(',', '', @$_POST['produk_qty'][$i])),	
							'produksi_produksi_panjang_total' => strip_tags(str_replace(',', '', @$_POST['produk_panjang_total'][$i])),	
							'produksi_produksi_status' => @$_POST['produk_status'][$i],		
						);	

				$this->query_builder->add('t_produksi_produksi',$set2);
			}

			//bahan baku
			$barang = @$_POST['bahan'];
			$jum_barang = count($barang);
			
			for ($i = 0; $i < $jum_barang; ++$i) {

				$set3 = array(
							'produksi_barang_status' => 1,
							'produksi_barang_log' => $log_id,
							'produksi_barang_nomor' => $nomor,
							'produksi_barang_barang' => strip_tags(@$barang[$i]),
							'produksi_barang_kode' => @$_POST['kode'][$i],
							'produksi_barang_panjang' => strip_tags(str_replace(',', '', @$_POST['panjang'][$i])),
							'produksi_barang_stok' => strip_tags(str_replace(',', '', @$_POST['stok'][$i])),
							'produksi_barang_harga' => strip_tags(str_replace(',', '', @$_POST['harga'][$i])),	
							'produksi_barang_total' => strip_tags(str_replace(',', '', @$_POST['total'][$i])),	
							'produksi_barang_berat' => strip_tags(str_replace(',', '', @$_POST['berat'][$i])),	
						);	

				$this->query_builder->add('t_produksi_barang',$set3);
			}

			//log produksi
			$set4 = array(
							'produksi_log_id' => $log_id,
							'produksi_log_nomor' => $nomor,
							'produksi_log_tanggal' => strip_tags(@$_POST['tanggal']),
							'produksi_log_shift' => strip_tags(@$_POST['shift']),
							'produksi_log_gudang' => strip_tags(@$_POST['gudang']),
							'produksi_log_pekerja' => json_encode(@$_POST['pekerja']),
							'produksi_log_mesin' => strip_tags(@$_POST['mesin']),
							'produksi_log_keterangan' => strip_tags(@$_POST['keterangan']),
						);

			//delete & save
    		$this->db->query("DELETE FROM t_produksi_log WHERE produksi_log_id = '$log_id'");
			$this->query_builder->add('t_produksi_log',$set4);
			//
			
			//update dan kartu stok
			$this->stok->transaksi();
			$this->kartu->add($nomor, 'produksi_keluar');
			$this->kartu->add($nomor, 'produksi_masuk');

			// jurnal
			// $this->stok->jurnal($nomor, 9, 'debit', 'biaya produksi', $total);
			// $this->stok->jurnal($nomor, 4, 'kredit', 'stok bahan baku', $total);	

			$this->session->set_userdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_userdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('produksi/'.$redirect));
	}

	function update($redirect, $so = 0){

		//get id
		$log_id = @$_POST['log_id'];
		$nomor = strip_tags(@$_POST['nomor']);
		$xdb = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_nomor = '$nomor'");
		$id = $xdb['produksi_id'];
		$so_proses = strip_tags(@$_POST['proses']);

		// if ($so == 1 && $so_proses == 2) {

		// 	//SO jadi PR
		// 	$nomor = str_replace('SO', 'PR', $xnomor);

		// 	//update produksi & barang
		// 	$this->query_builder->update('t_produksi_produksi', ['produksi_produksi_nomor' => $nomor], ['produksi_produksi_nomor' => $xnomor]);

		// 	$this->query_builder->update('t_produksi_barang', ['produksi_barang_nomor' => $nomor], ['produksi_barang_nomor' => $xnomor]);
		// }else{
		// 	//tetap
		// 	$nomor = $xnomor;
		// }

		$grandtotal = strip_tags(str_replace(',', '', @$_POST['grandtotal']));
		$set1 = array(
					'produksi_proses' => $so_proses,
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
		$db = $this->query_builder->update('t_produksi',$merge,['produksi_id' => $id]);

		if ($db == 1) {

			//produk
			$produk = @$_POST['produk'];
			$jum_produk = count($produk);

			for ($i = 0; $i < $jum_produk; ++$i) {

				$produk_id = @$_POST['produk_id'][$i];
				$produk_status = @$_POST['produk_status'][$i];

				//filter log
				if ($produk_status == 1) {
					$log = $log_id;
				}else{
					$log = '';
				}

				$set2 = array(
							'produksi_produksi_log' => $log,
							'produksi_produksi_nomor' => $nomor,
							'produksi_produksi_produk' => strip_tags(@$produk[$i]),
							'produksi_produksi_konversi' => strip_tags(str_replace(',', '', @$_POST['produk_konversi'][$i])),
							'produksi_produksi_batang' => strip_tags(str_replace(',', '', @$_POST['produk_batang'][$i])),
							'produksi_produksi_panjang' => strip_tags(str_replace(',', '', @$_POST['produk_panjang'][$i])),
							'produksi_produksi_qty' => strip_tags(str_replace(',', '', @$_POST['produk_qty'][$i])),	
							'produksi_produksi_panjang_total' => strip_tags(str_replace(',', '', @$_POST['produk_panjang_total'][$i])),
							'produksi_produksi_status' => $produk_status,			
						);

				$this->query_builder->update('t_produksi_produksi', $set2, ['produksi_produksi_id' => $produk_id]);

				if ($produk_status == 0) {

					//ubah status ke 1
					$this->query_builder->update('t_produksi',['produksi_proses' => 1], ['produksi_id' => $id]);
				}
			}

			//bahan baku
			$barang = @$_POST['bahan'];
			$jum_barang = count($barang);
			
			for ($i = 0; $i < $jum_barang; ++$i) {
				$barang_id = @$_POST['id'][$i];

				$set3 = array(
							'produksi_barang_log' => $log_id,
							'produksi_barang_nomor' => $nomor,
							'produksi_barang_barang' => strip_tags(@$barang[$i]),
							'produksi_barang_kode' => @$_POST['kode'][$i],
							'produksi_barang_panjang' => strip_tags(str_replace(',', '', @$_POST['panjang'][$i])),
							'produksi_barang_berat' => strip_tags(str_replace(',', '', @$_POST['berat'][$i])),
							'produksi_barang_stok' => strip_tags(str_replace(',', '', @$_POST['stok'][$i])),	
							'produksi_barang_harga' => strip_tags(str_replace(',', '', @$_POST['harga'][$i])),
							'produksi_barang_total' => strip_tags(str_replace(',', '', @$_POST['total'][$i])),
							'produksi_barang_status' => strip_tags(str_replace(',', '', @$_POST['status'][$i])),		
						);	

				if ($barang_id == 0) {

					$this->query_builder->add('t_produksi_barang',$set3);	
				}else{

					$this->query_builder->update('t_produksi_barang',$set3, ['produksi_barang_id' => $barang_id]);
				}
			}

			//log produksi
			$set4 = array(
							'produksi_log_id' => $log_id,
							'produksi_log_nomor' => $nomor,
							'produksi_log_tanggal' => strip_tags(@$_POST['tanggal']),
							'produksi_log_shift' => strip_tags(@$_POST['shift']),
							'produksi_log_gudang' => strip_tags(@$_POST['gudang']),
							'produksi_log_pekerja' => json_encode(@$_POST['pekerja']),
							'produksi_log_mesin' => strip_tags(@$_POST['mesin']),
							'produksi_log_keterangan' => strip_tags(@$_POST['keterangan']),
						);

			//delete & save
    		$this->db->query("DELETE FROM t_produksi_log WHERE produksi_log_id = '$log_id'");
			$this->query_builder->add('t_produksi_log',$set4);
			//

			//update kartu stok
			$this->stok->transaksi();
			$this->kartu->add($nomor, 'produksi_keluar');
			$this->kartu->add($nomor, 'produksi_masuk');

			// jurnal
			// $this->stok->jurnal($nomor, 9, 'debit', 'biaya produksi', $total);
			// $this->stok->jurnal($nomor, 4, 'kredit', 'stok bahan baku', $total);	

			$this->session->set_userdata('success','Data berhasil di tambah');
		} else {
			$this->session->set_userdata('gagal','Data gagal di tambah');
		}

		redirect(base_url('produksi/'.$redirect));
	}
	function delete($table, $id, $redirect){
		$set = ["{$table}_hapus" => 1];
		$where = ["{$table}_id" => $id];
		$db = $this->query_builder->update("t_{$table}",$set,$where);

		//get nomor
		$get = $this->db->query("SELECT * FROM t_{$table} WHERE {$table}_id = '$id'")->row_array();

		if ($db == 1) {

			//update
			$this->stok->transaksi();
			$this->kartu->delete($get[$table.'_nomor']);

			$this->session->set_userdata('success','Data berhasil di hapus');
		} else {
			$this->session->set_userdata('gagal','Data gagal di hapus');
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
	function laporan($id){

		$data['title'] = 'laporan';

		$data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produksi AS a LEFT JOIN t_produksi_produksi AS b ON a.produksi_nomor = b.produksi_produksi_nomor LEFT JOIN t_produk AS c ON b.produksi_produksi_produk = c.produk_id WHERE a.produksi_id = '$id'");

		$data['bahan_data'] = $this->query_builder->view("SELECT * FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor JOIN t_produksi AS c ON a.produksi_nomor = c.produksi_nomor  LEFT JOIN t_bahan AS d ON b.produksi_barang_barang = d.bahan_id LEFT JOIN t_gudang AS e ON a.produksi_gudang = e.gudang_id LEFT JOIN t_mesin AS f ON a.produksi_mesin = f.mesin_id LEFT JOIN t_produksi_produksi AS g ON a.produksi_nomor = g.produksi_produksi_nomor WHERE a.produksi_id = '$id'");

		$this->load->view('produksi/laporan', $data); 
	}
	function get_bahan($id, $gudang){

		$data = $this->query_builder->view_row("SELECT *, IFNULL(SUM(c.bahan_gudang_panjang),0) AS stok, IFNULL(SUM(c.bahan_gudang_berat_permeter),0) AS berat FROM t_bahan AS a LEFT JOIN t_bahan_gudang AS c ON a.bahan_id = c.bahan_gudang_bahan WHERE a.bahan_hapus = 0 AND a.bahan_id = '$id' AND c.bahan_gudang_gudang = '$gudang' GROUP BY a.bahan_id, c.bahan_gudang_gudang");

		echo json_encode($data);
	}
	function get_produk($id){

		$data = $this->query_builder->view_row("SELECT * FROM t_produk AS a LEFT JOIN t_satuan AS b ON a.produk_satuan = b.satuan_id WHERE a.produk_id = '$id'");

		echo json_encode($data);
	}
	function get_produksi($nomor, $status = 1, $log = ''){

		if ($log != '') {
			
			$data = $this->query_builder->view("SELECT * FROM t_produksi_produksi AS a LEFT JOIN t_produk AS b ON a.produksi_produksi_produk = b.produk_id WHERE a.produksi_produksi_nomor = '$nomor' AND a.produksi_produksi_status = '$status' AND a.produksi_produksi_log = '$log'");

		}else{

			$data = $this->query_builder->view("SELECT * FROM t_produksi_produksi AS a LEFT JOIN t_produk AS b ON a.produksi_produksi_produk = b.produk_id WHERE a.produksi_produksi_nomor = '$nomor' AND a.produksi_produksi_status = '$status'");
		}

		echo json_encode($data);
	}
	function get_bahan_baku($nomor, $status = 1, $log = ''){  

		if ($log != '') {
			
			$data = $this->query_builder->view("SELECT * FROM t_produksi_barang as a LEFT JOIN t_produksi as b ON a.produksi_barang_nomor = b.produksi_nomor LEFT JOIN t_bahan as c ON a.produksi_barang_barang = c.bahan_id LEFT JOIN t_satuan as d ON c.bahan_satuan = d.satuan_id WHERE a.produksi_barang_nomor = '$nomor' AND a.produksi_barang_status = '$status' AND produksi_barang_log = '$log'");
		}else{

			$data = $this->query_builder->view("SELECT * FROM t_produksi_barang as a LEFT JOIN t_produksi as b ON a.produksi_barang_nomor = b.produksi_nomor LEFT JOIN t_bahan as c ON a.produksi_barang_barang = c.bahan_id LEFT JOIN t_satuan as d ON c.bahan_satuan = d.satuan_id WHERE a.produksi_barang_nomor = '$nomor' AND a.produksi_barang_status = '$status'");
		}

		echo json_encode($data); 
	}

////////////////////////////////////////////////

//////////////// so /////////////////////////////

	function filter_json($array,$val){

       $temp_array = array();
       foreach ($array as &$v) {

           if (!isset($temp_array[$v[$val]])){

           		$temp_array[$v[$val]] =& $v;
           }

       }
       $array = array_values($temp_array);
       return $array;
    }

    function sort(){

    	//filter produk request terbanyak
		$db = $this->db->query("SELECT *, count(b.produksi_produksi_produk) as jum FROM t_produksi as a JOIN t_produksi_produksi as b ON b.produksi_produksi_nomor = a.produksi_nomor WHERE a.produksi_hapus = 0 AND a.produksi_so = 1 AND a.produksi_proses != 2 GROUP BY b.produksi_produksi_produk ORDER BY b.produksi_produksi_status")->result_array();
    	
    	//delete
    	$this->db->query("DELETE FROM t_filter");

    	foreach ($db as $v) {
    		
    		$nomor = $v['produksi_produksi_nomor'];
    		$barang = $v['produksi_produksi_produk'];
    		$produksi = $v['produksi_produksi_id'];

    		//insert
    		$this->db->query("INSERT INTO t_filter SET filter_nomor='$nomor', filter_produksi='$produksi', filter_barang='$barang' ON DUPLICATE KEY UPDATE filter_nomor='$nomor', filter_produksi='$produksi', filter_barang='$barang'");
    	}
	}

	function so_get_data($filter = ''){

		if ($filter != '') {

			$db = $this->db->query("SELECT * FROM t_filter")->result_array();

			$nomor = array();
			foreach ($db as $v) {
				$nomor[] = $v['filter_nomor'];
			}

			$order = '"'.implode('","', $nomor).'"';
		}else{
			
			$order = '';
		}

		$model = 'm_produksi_so';
		$where = array('produksi_hapus' => '0', 'produksi_so' => 1, 'produksi_proses !=' => 2);

		$data = $this->$model->get_datatables($where, $order);
		$total = $this->$model->count_all($where);
		$filter = $this->$model->count_filtered($where);

		$output = array(  
			"draw" => $_GET["draw"],
			"recordsTotal" => $total,
			"recordsFiltered" => $filter,
			"data" => $data,
		);
    
	    echo json_encode($output);		
	}
	function proses_so($id){ 
		$data = $this->add();
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");

		$data['url'] = 'rotate';

		//id log
		$data['log_id'] = $this->query_builder->count("SELECT * FROM t_produksi_log") + 1;

		$data["title"] = 'antrian (so)';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function rotate_save(){
		
		$redirect = 'proses';
		$so = 1;

		$this->update($redirect, $so);
	}
///////////////////////////////////////////////////

//////////////// proses /////////////////////////////

	function proses()
	{
		$title = 'proses';
		$data["title"] = $title;	
		$data['url'] = $title;

		//filter run
		$this->sort();

		//produk
		$data['produk_data'] = $this->query_builder->view("SELECT * FROM t_produk WHERE produk_hapus = 0");

	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/proses');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function proses_get_data()
	{
		$model = 'm_produksi_log';
		$where = array('produksi_log_hapus' => '0', 'produksi_log_selesai' => '0');

		$output = $this->serverside($where, $model);
		echo json_encode($output);
	}
	function selesai_get_data()
	{
		$model = 'm_produksi_log';
		$where = array('produksi_log_hapus' => '0', 'produksi_log_selesai' => '1');

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

	    //id log
		$data['log_id'] = $this->query_builder->count("SELECT * FROM t_produksi_log") + 1;

		$data["title"] = $redirect;
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form'); 
	    $this->load->view('produksi/search');
	    $this->load->view('v_template_admin/admin_footer');
	}

	
	function proses_save()
	{
		$proses = 2;
		$redirect = 'proses';
		$so = 0;
		$nomor = strip_tags(@$_POST['nomor']);
		
		$cek = $this->query_builder->count("SELECT * FROM t_produksi WHERE produksi_nomor = '$nomor'");
		if ($cek > 0) {
			//update
			$this->update($redirect, $so, $proses);

		} else {

			//save
			$this->save($redirect, $proses);
		}
	}

	function proses_delete($id){
		
		$table = 'produksi_log';
		$redirect = 'proses';
		$this->delete($table, $id, $redirect);
	}
	function proses_edit($id){

		$data = $this->add();
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");

		$data['url'] = 'proses';

		$data["title"] = 'proses';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit');
	    $this->load->view('v_template_admin/admin_footer');
	}
	function proses_view($id){

		$data = $this->add();
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi as a JOIN t_produksi_log as b ON a.produksi_nomor = b.produksi_log_nomor WHERE produksi_log_id = '$id'");

		$data['url'] = 'proses';
		$data['view'] = 1;

		$data["title"] = 'proses';
	    $this->load->view('v_template_admin/admin_header',$data);
	    $this->load->view('produksi/form');
	    $this->load->view('produksi/form_edit_log'); 
	    $this->load->view('v_template_admin/admin_footer');
	}

	function proses_update(){
		$redirect = 'proses';
		$this->update($redirect);
	}

	// cetak produksi
	function cetak($id){

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
	function cetak2($id){

		$data = $this->add();
		$data['data'] = $this->query_builder->view_row("SELECT * FROM t_produksi WHERE produksi_id = '$id'");

		$data['url'] = 'proses';
		$data['view'] = 1;

		$data["title"] = 'proses';
	    $this->load->view('produksi/produksi-cetak',$data);
	}	

	function cetak3($log){ 

		$data['data_produksi'] = $this->query_builder->view("SELECT * FROM t_produksi_produksi AS a JOIN t_produk AS b ON a.produksi_produksi_produk = b.produk_id WHERE a.produksi_produksi_log = '$log'");

		$data['data'] = $this->query_builder->view("
			SELECT * FROM t_produksi_barang as a 
			LEFT JOIN t_produksi as b ON a.produksi_barang_nomor = b.produksi_nomor 
			LEFT JOIN t_bahan as c ON a.produksi_barang_barang = c.bahan_id 
			LEFT JOIN t_satuan as d ON c.bahan_satuan = d.satuan_id
			LEFT JOIN t_bahan_item as e ON e.bahan_item_id = a.produksi_barang_kode 
			WHERE a.produksi_barang_log = '$log'");

		$this->load->view('produksi/produksi-cetak3',$data);
	}

	//get kode item

	function get_item($id, $gudang){

		$data = $this->query_builder->view("SELECT * FROM t_bahan_item WHERE bahan_item_bahan = '$id' AND bahan_item_gudang = '$gudang'");

		echo json_encode($data);

	}
	function get_kode($id, $gudang){

		$data = $this->query_builder->view_row("SELECT * FROM t_bahan_item WHERE bahan_item_id = '$id' AND bahan_item_gudang = '$gudang'");

		echo json_encode($data);

	}
	function selesai($id){

		$set = ["produksi_log_selesai" => 1];
		$where = ["produksi_log_id" => $id];
		$db = $this->query_builder->update("t_produksi_log",$set,$where);

		if ($db == 1) {
			$this->session->set_userdata('success', "Data berhasil di simpan");
		} else {
			$this->session->set_userdata('gagal','Data gagal di simpan');
		}

		redirect(base_url('produksi/proses'));
		
	}
	function surat($id){

		$user = $this->session->userdata('id');
		$level = $this->session->userdata('level');
		$tanggal = date('Y-m-d');

		//nomor 
		$x = $this->query_builder->view_row("SELECT * FROM t_produksi_log as a JOIN t_produksi as b ON a.produksi_log_nomor = b.produksi_nomor WHERE a.produksi_log_id = '$id'");
		$nomor = $x['produksi_nomor'];

		//cek
		$cek = $this->query_builder->view_row("SELECT * FROM t_cetak WHERE cetak_nomor = '$nomor' AND cetak_user = '$user' AND cetak_level = '$level'");

		if ($level == 0) {
			
			// admin
			$cetak = 1;

		}else{

			//user
			if (@$cek) {

				if (@$cek['cetak_setujui'] == 1) {
					
					$cetak = 1;

					//update setujui
					$berhasil = @$cek['cetak_berhasil'] + 1; 
					$this->query_builder->update('t_cetak',['cetak_setujui' => 0, 'cetak_berhasil' => $berhasil],['cetak_user' => $user, 'cetak_nomor' => $nomor]);
				}else{

					//update jumlah
					$jumlah = @$cek['cetak_jumlah'] + 1;
					$this->query_builder->update('t_cetak',['cetak_jumlah' => $jumlah],['cetak_user' => $user, 'cetak_nomor' => $nomor]);

					// menunggu
					$this->session->set_userdata('gagal', 'menunggu persetujuan terlebih dahulu');
					redirect(base_url('produksi/proses'));	
				}

			}else{

				//insert 
				$this->query_builder->add('t_cetak',['cetak_user' => $user, 'cetak_jumlah' => 1, 'cetak_level' => $level, 'cetak_nomor' => $nomor, 'cetak_tanggal' => $tanggal, 'cetak_berhasil' => 1]);

				$cetak = 1;
			}
		}

		if (@$cetak == 1) {
			
			$data['data'] = $this->query_builder->view("SELECT * FROM t_produksi_log AS a JOIN t_produksi AS b ON a.produksi_log_nomor = b.produksi_nomor LEFT JOIN t_produksi_produksi AS c ON a.produksi_log_id = c.produksi_produksi_log LEFT JOIN t_produk AS d ON c.produksi_produksi_produk = d.produk_id LEFT JOIN t_user AS e ON a.produksi_log_shift = e.user_id WHERE a.produksi_log_id = '$id'");
		}

		$data["title"] = 'surat jalan';
	    $this->load->view('produksi/surat',$data); 
	}
	function group_produk(){

		$id = @$_POST['id'];

		$data = $this->query_builder->view("SELECT b.produksi_produksi_log AS log, a.produksi_nomor AS nomor, c.produk_nama AS nama, SUM(b.produksi_produksi_panjang_total) as panjang FROM t_produksi AS a JOIN t_produksi_produksi AS b ON a.produksi_nomor = b.produksi_produksi_nomor JOIN t_produk AS c ON b.produksi_produksi_produk = c.produk_id WHERE a.produksi_proses = 2 AND a.produksi_hapus = 0 AND b.produksi_produksi_status = 1 AND b.produksi_produksi_produk = '$id' GROUP BY a.produksi_nomor");

		echo json_encode($data);		
	}
	function group_bahan($log){
		$data = $this->query_builder->view("SELECT b.bahan_nama AS nama, a.produksi_barang_nomor AS nomor, c.produksi_log_keterangan AS keterangan, REPLACE((a.produksi_barang_panjang),'.00','') AS panjang FROM t_produksi_barang AS a JOIN t_bahan AS b ON a.produksi_barang_barang = b.bahan_id JOIN t_produksi_log AS c ON a.produksi_barang_log = c.produksi_log_id WHERE a.produksi_barang_log = '$log'");

		echo json_encode($data);
	}
}
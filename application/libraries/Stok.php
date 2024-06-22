 <?php
class Stok{ 
  protected $sql; 
  function __construct(){
        $this->sql = &get_instance(); 
  }  
  function cek($table, $where){
    $this->sql->db->where($where);  
    return $this->sql->db->get($table)->num_rows();  
  } 

  /////////////////////////////////////////// atribut /////////////////////////////////////////////////
  
  function pembelian(){      
    //sum stok bahan update 
      $pembelian = $this->sql->db->query("SELECT SUM(b.pembelian_barang_berat) AS berat, SUM(b.pembelian_barang_panjang) AS panjang, b.pembelian_barang_barang AS bahan, a.pembelian_gudang AS gudang, SUM(b.pembelian_barang_total) AS total, SUM(b.pembelian_barang_ekspedisi) AS ekspedisi, a.pembelian_hapus AS hapus FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor WHERE a.pembelian_proses = 1 AND a.pembelian_hapus = 0 GROUP BY a.pembelian_gudang, b.pembelian_barang_barang")->result_array();

      $bahan_baku = $this->sql->db->query("SELECT a.produksi_hapus AS hapus, produksi_gudang AS gudang ,b.produksi_barang_kode AS kode, b.produksi_barang_barang AS bahan, SUM(b.produksi_barang_panjang) AS panjang, ROUND(SUM(b.produksi_barang_berat * b.produksi_barang_panjang), 2) AS berat FROM t_produksi AS a JOIN t_produksi_barang AS b ON a.produksi_nomor = b.produksi_barang_nomor WHERE a.produksi_proses = 1 AND a.produksi_hapus = 0 GROUP BY b.produksi_barang_barang, a.produksi_gudang")->result_array();

      $item = $this->sql->db->query("SELECT a.pembelian_barang_barang AS bahan, SUM(a.pembelian_barang_berat) AS berat, SUM(a.pembelian_barang_panjang) AS panjang, b.pembelian_gudang AS gudang, b.pembelian_hapus AS hapus, a.pembelian_barang_kode AS kode FROM t_pembelian_barang AS a LEFT JOIN t_pembelian AS b ON a.pembelian_barang_nomor = b.pembelian_nomor WHERE b.pembelian_hapus = 0 AND a.pembelian_barang_terima > 0 GROUP BY b.pembelian_gudang, a.pembelian_barang_barang, a.pembelian_barang_kode")->result_array();

      //pembelian update stok produk
      
      //stok 0
      $this->sql->db->query("UPDATE t_bahan_gudang SET bahan_gudang_berat = 0, bahan_gudang_panjang = 0, bahan_gudang_hpp = 0, bahan_gudang_berat_permeter = 0");
      $this->sql->db->query("UPDATE t_bahan_item SET bahan_item_berat = 0, bahan_item_panjang = 0");
      
      foreach (@$pembelian as $pb) {

        $bahan = $pb['bahan'];
        $berat = $pb['berat'];
        $panjang = $pb['panjang'];
        $gudang = $pb['gudang'];
        $hapus = $pb['hapus'];
        $ekspedisi = $pb['ekspedisi'];
        $total = $pb['total'];

        $cek = $this->sql->db->query("SELECT * FROM t_bahan_gudang WHERE bahan_gudang_bahan = '$bahan' AND bahan_gudang_gudang = '$gudang'")->num_rows();

        if ($hapus != null && $hapus == 0) {

          //atribute
          if ($berat > 0) {
            $hpp = ($total + $ekspedisi) / $berat;
          }else{
            $hpp = 0;
          }

          //cek panjang 0
          if ($panjang != 0) {
            $permeter = $berat / $panjang;
          }else{
            $permeter = 0;
          } 

          $set = array(
                  'bahan_gudang_bahan' => $bahan,
                  'bahan_gudang_gudang' => $gudang,
                  'bahan_gudang_berat' => $berat,
                  'bahan_gudang_panjang' => $panjang,
                  'bahan_gudang_hpp' => $hpp,
                  'bahan_gudang_berat_permeter' => $permeter,
            );

          $this->sql->db->set($set);  

          if ($cek == 0) {

            // insert
            $this->sql->db->insert('t_bahan_gudang');

          }else{

            //update
            $this->sql->db->where(['bahan_gudang_gudang' => $gudang, 'bahan_gudang_bahan' => $bahan]);
            $this->sql->db->update('t_bahan_gudang');

          }

        }

      }

      //bahan item
      foreach (@$item as $it) {

        $bahan = $it['bahan'];
        $berat = $it['berat'];
        $panjang = $it['panjang'];
        $gudang = $it['gudang'];
        $hapus = $it['hapus'];
        $kode = $it['kode'];

        $cek = $this->sql->db->query("SELECT * FROM t_bahan_item WHERE bahan_item_bahan = '$bahan' AND bahan_item_gudang = '$gudang' AND bahan_item_kode = '$kode'")->num_rows();

        if ($hapus != null && $hapus == 0) {

          $set = array(
                  'bahan_item_bahan' => $bahan,
                  'bahan_item_gudang' => $gudang,
                  'bahan_item_berat' => $berat,
                  'bahan_item_panjang' => $panjang,
                  'bahan_item_kode' => $kode,
            );

          $this->sql->db->set($set);  

          if ($cek == 0) {

            // insert
            $this->sql->db->insert('t_bahan_item');

          }else{

            //update
            $this->sql->db->where(['bahan_item_kode' => $kode,'bahan_item_gudang' => $gudang, 'bahan_item_bahan' => $bahan]);
            $this->sql->db->update('t_bahan_item');

          }

        }

      } 

      //produksi bahan baku
      foreach (@$bahan_baku as $bh) {

        $hapus = @$bh['hapus'];
        $gudang = @$bh['gudang'];
        $bahan = @$bh['bahan'];
        $panjang = @$bh['panjang'];
        $berat = @$bh['berat'];
        $kode = @$bh['kode'];

        if ($hapus != null && $hapus == 0) {

          //gudang
          $this->sql->db->query("UPDATE t_bahan_gudang SET bahan_gudang_panjang = bahan_gudang_panjang - {$panjang}, bahan_gudang_berat = bahan_gudang_berat - {$berat} WHERE bahan_gudang_bahan = {$bahan} AND bahan_gudang_gudang = {$gudang}");

          //kode item
          $this->sql->db->query("UPDATE t_bahan_item SET bahan_item_panjang = bahan_item_panjang - {$panjang}, bahan_item_berat = bahan_item_berat - $berat WHERE bahan_item_bahan = {$bahan} AND bahan_item_gudang = '$gudang' AND bahan_item_id = '$kode'"); 

        }

      }

      return;
  }

  function produksi(){

    $produksi = $this->sql->db->query("SELECT SUM(b.produksi_produksi_panjang_total) AS panjang, b.produksi_produksi_produk AS produk, a.produksi_hapus AS hapus, a.produksi_gudang AS gudang, SUM(a.produksi_grandtotal) AS total FROM t_produksi AS a JOIN t_produksi_produksi AS b ON a.produksi_nomor = b.produksi_produksi_nomor WHERE a.produksi_hapus = 0 AND a.produksi_proses = 1 GROUP BY a.produksi_gudang, b.produksi_produksi_produk")->result_array();

    //kurangi penjualan

    //stok 0
    $this->sql->db->query("UPDATE t_produk_gudang SET produk_gudang_panjang = 0, produk_gudang_hps = 0");

    //produksi produk
    foreach ($produksi as $pr) {
      $panjang = @$pr['panjang'];
      $produk = @$pr['produk'];
      $hapus = @$pr['hapus'];
      $gudang = @$pr['gudang'];
      $total = @$pr['total'];

      //cek produk
      $cek = $this->sql->db->query("SELECT * FROM t_produk_gudang WHERE produk_gudang_gudang = '$gudang' AND produk_gudang_produk = '$produk'")->num_rows();

      if ($hapus != null && $hapus == 0) {
        
        $hps = round($total / $panjang, 2);

        $set = array(
                    'produk_gudang_gudang' => $gudang,
                    'produk_gudang_produk' => $produk,
                    'produk_gudang_panjang' => $panjang,
                    'produk_gudang_hps' => $hps,
                );

        $this->sql->db->set($set);

        if ($cek == 0) {
          //insert
          $this->sql->db->insert('t_produk_gudang');

        }else{
          //update
          $this->sql->db->where(['produk_gudang_gudang' => $gudang, 'produk_gudang_produk' => $produk]);
          $this->sql->db->update('t_produk_gudang');
        }

      }

    }

    return;
  }

  function penjualan()
  {
    $db = $this->sql->db->query("SELECT a.penjualan_hapus AS hapus, a.penjualan_gudang AS gudang ,b.penjualan_barang_barang AS produk, b.penjualan_barang_panjang_total AS panjang FROM t_penjualan AS a JOIN t_penjualan_barang AS b ON a.penjualan_nomor = b.penjualan_barang_nomor AND a.penjualan_proses = 1 AND a.penjualan_hapus = 0 GROUP BY b.penjualan_barang_barang, a.penjualan_gudang, a.penjualan_nomor")->result_array();

      foreach ($db as $value) {
       
        $gudang = $value['gudang'];
        $produk = $value['produk'];
        $panjang = $value['panjang'];
        $hapus = $value['hapus'];

        if ($hapus != null && $hapus == 0) {

            //kurangi stok produk
          /*
          $this->sql->db->query("UPDATE t_produk_gudang SET produk_gudang_panjang = produk_gudang_panjang - {$panjang} WHERE produk_gudang_produk = {$produk} AND produk_gudang_gudang = {$gudang}"); 
          */
          $this->sql->db->query("UPDATE t_produk_gudang SET produk_gudang_panjang = produk_gudang_panjang - {$panjang} WHERE produk_gudang_produk = {$produk} AND produk_gudang_gudang = 0"); 
        }
      }

     return;
  }

  ///////////////////////////////////// end tribut ////////////////////////////////////////////////////

  function transaksi(){
    $this->pembelian();
    $this->produksi(); 
    $this->penjualan();
  }

  // hydev
  function jurnal($nomor, $akun, $type, $keterangan, $nominal, $tanggal = '') {

    if (@$tanggal) {
      $tgl = $tanggal;
    } else {
      $tgl = date('Y-m-d');
    }

    $set = array(
                  'jurnal_nomor' => $nomor,
                  'jurnal_akun' => $akun,
                  'jurnal_keterangan' => $keterangan,
                  'jurnal_type' => $type,
                  'jurnal_nominal' => $nominal,
                  'jurnal_tanggal' => $tgl,
                );

    $this->sql->db->set($set);
    $this->sql->db->insert('t_jurnal');

    return;
  }

}
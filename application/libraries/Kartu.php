 <?php
class Kartu{ 
  protected $sql;
  function __construct(){
        $this->sql = &get_instance();
  } 

  /////////////////////////////////////////// atribut /////////////////////////////////////////////////
 
  function add($nomor, $type){  

    if ($type == 'pembelian') {

      //delete
      $this->sql->db->query("DELETE FROM t_kartu WHERE kartu_nomor = '$nomor' AND kartu_transaksi = 'masuk'");
      
      $db = $this->sql->db->query("SELECT a.pembelian_jam as jam, d.bahan_kode AS kode, d.bahan_id AS barang, d.bahan_nama as barang_nama , c.gudang_id as gudang, 'pembelian' as jenis, a.pembelian_nomor AS nomor, b.pembelian_barang_panjang_cek AS jumlah, 'Mtr' AS satuan, 'masuk' AS transaksi, a.pembelian_tanggal AS tanggal FROM t_pembelian AS a JOIN t_pembelian_barang AS b ON a.pembelian_nomor = b.pembelian_barang_nomor LEFT JOIN t_gudang AS c ON a.pembelian_gudang = c.gudang_id LEFT JOIN t_bahan AS d ON b.pembelian_barang_barang = d.bahan_id WHERE a.pembelian_hapus = 0 AND a.pembelian_proses = 1 AND a.pembelian_nomor = '$nomor'")->result_array();

    }

    if ($type == 'produksi_keluar') {

      //delete
      $this->sql->db->query("DELETE FROM t_kartu WHERE kartu_nomor = '$nomor' AND kartu_transaksi = 'keluar'");
      
      $db = $this->sql->db->query("SELECT e.produksi_jam as jam, h.bahan_kode AS kode, h.bahan_nama as barang_nama, g.gudang_id as gudang, 'produksi' as jenis, e.produksi_nomor AS nomor, f.produksi_barang_barang AS barang, f.produksi_barang_panjang AS jumlah, 'Mtr' AS satuan, 'keluar' AS transaksi, f.produksi_barang_tanggal AS tanggal FROM t_produksi AS e JOIN t_produksi_barang AS f ON e.produksi_nomor = f.produksi_barang_nomor LEFT JOIN t_gudang AS g ON e.produksi_gudang = g.gudang_id LEFT JOIN t_bahan AS h ON f.produksi_barang_barang = h.bahan_id WHERE e.produksi_proses = 1 AND e.produksi_nomor = '$nomor'")->result_array();

    }

    if ($type == 'produksi_masuk') {

      //delete
      $this->sql->db->query("DELETE FROM t_kartu WHERE kartu_nomor = '$nomor' AND kartu_transaksi = 'masuk'");
      
      $db = $this->sql->db->query("SELECT h.produksi_jam as jam, k.produk_kode AS kode, k.produk_nama as barang_nama, j.gudang_id AS gudang, 'produksi' AS jenis, h.produksi_nomor AS nomor, k.produk_id AS barang, i.produksi_produksi_panjang_total AS jumlah, 'Mtr' AS satuan, 'masuk' AS transaksi, i.produksi_produksi_tanggal AS tanggal FROM t_produksi AS h JOIN t_produksi_produksi AS i ON h.produksi_nomor = i.produksi_produksi_nomor LEFT JOIN t_gudang AS j ON h.produksi_gudang = j.gudang_id LEFT JOIN t_produk AS k ON i.produksi_produksi_produk = k.produk_id WHERE h.produksi_proses = 1 AND h.produksi_nomor = '$nomor'")->result_array();

    }

    if ($type == 'penjualan') {

      //delete
      $this->sql->db->query("DELETE FROM t_kartu WHERE kartu_nomor = '$nomor' AND kartu_transaksi = 'keluar'");
      
      $db = $this->sql->db->query("SELECT l.penjualan_jam as jam, o.produk_kode AS kode, o.produk_nama as barang_nama, n.gudang_id AS gudang, 'penjualan' as jenis, l.penjualan_nomor AS nomor, o.produk_id AS barang, m.penjualan_barang_panjang_total AS jumlah, 'Mtr' AS satuan, 'keluar' AS transaksi, l.penjualan_tanggal AS tanggal FROM t_penjualan AS l JOIN t_penjualan_barang AS m ON l.penjualan_nomor = m.penjualan_barang_nomor LEFT JOIN t_gudang AS n ON l.penjualan_gudang = n.gudang_id LEFT JOIN t_produk AS o ON m.penjualan_barang_barang = o.produk_id WHERE l.penjualan_proses = 1 AND l.penjualan_nomor = '$nomor'")->result_array();

    }

    foreach ($db as $v) {
      // save database kartu stok
      $arr = array(
                'kartu_gudang' => $v['gudang'],
                'kartu_jenis' => $v['jenis'],
                'kartu_transaksi' => $v['transaksi'],
                'kartu_nomor' => $v['nomor'],
                'kartu_barang' => $v['barang'],
                'kartu_kode' => $v['kode'],
                'kartu_barang_nama' => $v['barang_nama'],
                'kartu_jumlah' => $v['jumlah'],
                'kartu_tanggal' => $v['tanggal'],
                'kartu_jam' => $v['jam'],
                'kartu_satuan' => $v['satuan'], 
              );

      $this->sql->db->set($arr);
      $this->sql->db->insert('t_kartu');

    }

    return;
  }

  function delete($nomor){

    $this->sql->db->query("DELETE FROM t_kartu WHERE kartu_nomor = '$nomor'"); 

    return;

  }

}
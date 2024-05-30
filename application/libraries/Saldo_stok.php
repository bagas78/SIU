 <?php
class Saldo_stok{ 
  protected $sql;
  function __construct(){
        $this->sql = &get_instance();
  } 

  /////////////////////////////////////////// atribut /////////////////////////////////////////////////
 
  function add($nomor, $jenis){  

    //delete
    $this->sql->db->query("DELETE FROM t_saldo WHERE saldo_nomor = '$nomor'");

    if ($jenis == 'pembelian_bahan') {
      
      $db = $this->sql->db->query("SELECT * FROM t_pembelian WHERE pembelian_nomor = '$nomor'")->row_array();  
      $sumber = 'pembelian';
      $nominal = $db['pembelian_grandtotal'];
      $rekening = $db['pembelian_pembayaran'];
      $jenis = 'tarik';
      $keterangan = 'transaksi pembelian bahan';

    }

    if ($jenis == 'pembelian_umum') {
      
      $db = $this->sql->db->query("SELECT * FROM t_pembelian_umum WHERE pembelian_umum_nomor = '$nomor'")->row_array();  
      $sumber = 'pembelian';
      $nominal = $db['pembelian_umum_total'];
      $rekening = $db['pembelian_umum_pembayaran'];
      $jenis = 'tarik';
      $keterangan = 'transaksi pembelian umum';

    }

    if ($jenis == 'penjualan') {
      
      $db = $this->sql->db->query("SELECT * FROM t_penjualan WHERE penjualan_nomor = '$nomor'")->row_array();  
      $sumber = 'penjualan';
      $nominal = $db['penjualan_grandtotal'];
      $rekening = $db['penjualan_pembayaran'];
      $jenis = 'setor';
      $keterangan = 'transaksi penjualan';

    }

    // save database
    $set = array(
              'saldo_nomor' => $nomor,
              'saldo_sumber' => $sumber, 
              'saldo_nominal' => $nominal,
              'saldo_rekening' => $rekening,
              'saldo_jenis' => $jenis,
              'saldo_keterangan' => $keterangan,
            );

    $this->sql->db->set($set);
    $this->sql->db->insert('t_saldo');

    return;
  }

  function delete($nomor){

    $this->sql->db->query("UPDATE t_saldo SET saldo_hapus = 1 WHERE saldo_nomor = '$nomor'"); 

    return;

  }

}
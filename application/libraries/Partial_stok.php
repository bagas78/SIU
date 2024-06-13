 <?php
class Partial_stok{ 
  protected $sql;
  function __construct(){ 
        $this->sql = &get_instance();
  }  

  /////////////////////////////////////////// atribut /////////////////////////////////////////////////
 
  function pembelian(){  

    //0 cek
    $this->sql->db->query("UPDATE t_pembelian_barang SET pembelian_barang_berat_cek = 0, pembelian_barang_panjang_cek = 0");

    $db = $this->sql->db->query("SELECT a.pembelian_partial_nomor AS nomor, a.pembelian_partial_barang AS barang, a.pembelian_partial_kode AS kode, SUM(a.pembelian_partial_berat) AS berat, SUM(a.pembelian_partial_panjang) AS panjang FROM t_pembelian_partial AS a GROUP BY a.pembelian_partial_nomor, a.pembelian_partial_barang, a.pembelian_partial_kode")->result_array();

    foreach ($db as $v) {

      $berat = $v['berat'];
      $panjang = $v['panjang'];
      $nomor = $v['nomor'];
      $barang = $v['barang'];
      $kode = $v['kode'];
      
      $set = array(
                      'pembelian_barang_berat_cek' => $berat,
                      'pembelian_barang_panjang_cek' => $panjang,
                  );

      $this->sql->db->where(['pembelian_barang_nomor' => $nomor, 'pembelian_barang_barang' => $barang, 'pembelian_barang_kode' => $kode]);
      $this->sql->db->set($set);
      $this->sql->db->update('t_pembelian_barang');

      /////////////////////////////////////////////////////////////////////////////////////////
      
      //ubah status pembelian partial

      $db1 = $this->sql->db->query("SELECT a.pembelian_barang_nomor AS nomor, SUM(a.pembelian_barang_berat) AS berat, SUM(a.pembelian_barang_berat_cek) AS berat_cek, SUM(a.pembelian_barang_panjang) AS panjang, SUM(a.pembelian_barang_panjang_cek) AS panjang_cek FROM t_pembelian_barang AS a GROUP BY a.pembelian_barang_nomor")->result_array();

      foreach ($db1 as $v1) {
        
        $berat_cek = $v1['berat_cek'];
        $berat = $v1['berat'];
        $panjang_cek = $v1['panjang_cek'];
        $panjang = $v1['panjang'];
        $nomor = $v1['nomor'];

        if ($panjang_cek >= $panjang) {
          
          $this->sql->db->where('pembelian_nomor', $nomor);
          $this->sql->db->set('pembelian_partial', 1);
          $this->sql->db->update('t_pembelian');

        }

      }

    }

    return;
  }

}
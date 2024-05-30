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

    $db = $this->sql->db->query("SELECT a.pembelian_partial_join AS id, SUM(a.pembelian_partial_berat) AS berat, SUM(a.pembelian_partial_panjang) AS panjang FROM t_pembelian_partial AS a GROUP BY a.pembelian_partial_join")->result_array();

    foreach ($db as $v) {

      $berat = $v['berat'];
      $panjang = $v['panjang'];
      $id = $v['id'];
      
      $set = array(
                      'pembelian_barang_berat_cek' => $berat,
                      'pembelian_barang_panjang_cek' => $panjang,
                  );

      $this->sql->db->where(['pembelian_barang_id' => $id]);
      $this->sql->db->set($set);
      $this->sql->db->update('t_pembelian_barang');

    }

    return;
  }

}
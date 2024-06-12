<style type="text/css">
  .tit{
    background: black;
    padding: 0.5%;
    color: white;
  }
</style>
 
    <!-- Main content -->   
    <section class="content">
 
      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border"> 

          <div class="back" align="left">
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button class="btn btn-danger"><i class="fa fa-arrow-left"></i> Kembali</button></a>
          </div>
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

        <?php if (@$data): ?>
            
            <form method="POST" action="<?=base_url('pembelian/partial_save')?>">

                <table id="example" class="table table-bordered table-hover" style="width: 100%;">
                    <thead>
                    <tr>
                      <th>Nomor</th>
                      <th>Bahan</th> 
                      <th>Kode Item</th>
                      <th>Total Panjang</th>
                      <th>Total Berat</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php foreach (@$data as $v): ?>
                            
                            <tr>
                                <td><?=$v['pembelian_barang_nomor']?></td>
                                <td>
                                    <span><?=$v['bahan_nama']?></span><br/>
                                    <span class="badge">Panjang : <?=$v['pembelian_barang_panjang'] - $v['pembelian_barang_panjang_cek'].' m' ?></span>
                                    <span class="badge">Berat : <?=$v['pembelian_barang_berat'] - $v['pembelian_barang_berat_cek'].' kg' ?></span> 

                                    <!-- hidden -->
                                    <input type="hidden" name="nomor[]" class="form-control" value="<?=$v['pembelian_barang_nomor']?>">
                                    <input type="hidden" name="id[]" class="form-control" value="<?=$v['pembelian_barang_id']?>">
                                    <input type="hidden" name="barang[]" class="form-control" value="<?=$v['pembelian_barang_barang']?>">
                                    <input type="hidden" name="kode[]" class="form-control" value="<?=$v['pembelian_barang_kode']?>">

                                </td>
                                <td><?=$v['pembelian_barang_kode']?></td>
                                <td>
                                  <input type="number" name="panjang[]" class="form-control panjang">
                                  <input type="hidden" class="form-control panjang_qty" value="<?=$v['pembelian_barang_panjang_qty'];?>">
                                </td>
                                <td>
                                  <input type="number" name="berat[]" class="form-control berat">
                                  <input type="hidden" class="form-control berat_qty" value="<?=$v['pembelian_barang_berat_qty'];?>">
                                </td>
                            </tr>

                        <?php endforeach ?>
                        
                    </tbody>
                  </table>

                  <div style="float: right;">
                      
                    <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                    <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

                  </div>

            </form>

        <?php else: ?>

            <center><span>Transaksi tidak di temukan</span></center>

        <?php endif ?>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
  
  $(document).on('keyup', '.berat', function() {
    
    var berat = $(this).val();
    var panjang_qty = $(this).closest('tr').find('.panjang_qty').val();

    $(this).closest('tr').find('.panjang').val(berat * panjang_qty);

  });

  $(document).on('keyup', '.panjang', function() {
    
    var panjang = $(this).val();
    var berat_qty = $(this).closest('tr').find('.berat_qty').val();

    $(this).closest('tr').find('.berat').val(panjang * berat_qty);

  });

</script>
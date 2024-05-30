<style type="text/css">
  #title{
    background: darkgray;
    padding: 1%;
    margin-bottom: 2%;
    text-align: center;
    color: white; 
  } 
  .p03{
    padding: 0.3%;
  }
</style>

    <!-- Main content -->   
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            
          <form method="POST" action="">

            <div class="form-group row">
              <div class="col-md-3">
                <label>Barang</label>
                <select name="kode" class="select2 barang form-control" required>
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($barang as $v): ?>
                    <option value="<?=$v['kode']?>"><?=$v['kode'].' - '.$v['nama']?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-2">
                <label>Start Date</label>
                <input name="start" type="text" class="datepicker form-control" value="" required>  
              </div>
              <div class="col-md-2">
                <label>End Date</label>
                <input name="end" type="text" class="datepicker form-control" value="" required>  
              </div>
              <div class="col-md-2">
                <label>&#160;</label>
                <button type="submit" class="btn btn-primary filter form-control">Filter <i class="fa fa-search"></i></button>
              </div>
            </div>
            
          </form>

          <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>No Transaksi</th>
                  <th>Kode</th>
                  <th>Barang</th>
                  <th>Keterangan</th>
                  <th>Satuan</th>
                  <th>Masuk</th>
                  <th>Keluar</th>
                  <th>Saldo</th>
                </tr>
                </thead>
                <tbody>

                  <?php if ($filter == 1): ?>
                    
                  <?php foreach (@$data as $v): ?>

                    <tr>
                      <td><?=date_format(date_create(@$v['kartu_tanggal']), 'd/m/Y')?></td>
                      <td><?=@$v['kartu_nomor']?></td>
                      <td><?=@$v['kartu_kode']?></td>
                      <td><?=@$v['kartu_barang_nama']?></td>
                      <td><?=@$v['kartu_jenis']?></td>
                      <td><?=@$v['kartu_satuan']?></td>
                      <td class="bg-success"><?= (@$v['kartu_transaksi'] == 'masuk') ? @$v['kartu_jumlah'] : '0'; ?></td>
                      <td class="bg-danger"><?= (@$v['kartu_transaksi'] == 'keluar') ? @$v['kartu_jumlah'] : '0'; ?></td>
                      <td class="kartu_saldo"><?=@$v['kartu_saldo']?></td>
                    </tr>

                  <?php endforeach ?>

                  <?php endif ?>

                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">

$(function() {
  
  $('.datepicker').datepicker({
    format: "yyyy-mm",
    autoclose: true,
    minViewMode: "months"});

});

function auto(){

    //replace .00
     $.each($('.kartu_saldo'), function(index, val) {
        
        var val = $(this).text();
        $(this).text(val.replaceAll('.00', ''));

     });

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
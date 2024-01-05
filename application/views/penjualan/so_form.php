<style type="text/css">
  .small{
    background: grey;
    color: white;
    padding: 5px 10px;
    text-align: center;
  }
  .tit{
    padding: 0.5%;
    font-size: large;
    background: black;
    color: white;
    margin-bottom: 15px;
  }
</style> 

<!-- Main content --> 
<section class="content">
   
  <!-- Default box -->  
  <div class="box"> 
    <div class="box-header with-border">  

      <div class="back" align="left" hidden>
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
      <form method="post" enctype="multipart/form-data" class="bg-alice">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Nomor Sales Order</label>
              <input type="text" name="nomor" class="form-control" required id="nomor">
            </div>
            <div class="form-group">
              <label>Tanggal Sales Order</label>
              <input type="datetime-local" name="tanggal" class="form-control" required id="tanggal">
            </div>
            <div class="form-group">
              <label>Gudang</label>
              <select name="gudang" class="form-control select2" required id="gudang">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($gudang_data as $g): ?>
                  <option value="<?= $g['gudang_id']?>"><?= $g['gudang_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-5"> 
            <div class="form-group">
              <label>Pelanggan</label>
              <select name="pelanggan" class="form-control select2" required id="pelanggan">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($kontak_data as $k): ?>
                  <option value="<?= $k['kontak_id']?>"><?= $k['kontak_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control textarea" style="height: 105px;" id="keterangan"></textarea>
            </div>
          </div>

        </div>

        <div class="clearfix"></div><br/>

        <center class="tit"><span>Produk</span></center>

        <table class="table table-responsive table-borderless">
          <thead>
            <tr>
              <th>Produk</th>           
              <th>Panjang <span class="stn">Mtr</span></th>
              <th width="1"><button type="button" onclick="clone()" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <select required id="produk" class="produk form-control" name="produk[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($produk_data as $p): ?>
                    <option value="<?=@$p['produk_id']?>"><?=@$p['produk_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>

              <td>
                <input type="number" name="produk_panjang[]" class="produk_panjang form-control" required value="0" min="0">
              </td>
              
              <td><button type="button" class="remove btn btn-danger btn-sm"><i class="fa fa-minus"></i></button></td>
            </tr>

            <tr class="save">
              <td colspan="7" align="right">
                <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
              </td>
            </tr>

          </tbody>
        </table>

      </form>

    </div>
  </div>
  <!-- /.box -->

<script type="text/javascript">

//view UI
<?php if(@$view == 1):?>
  $('.back').removeAttr('hidden');
  $('.add').remove();
  $('.remove').remove();
  $('.save').remove();
  $('.form-group, td').css('pointer-events', 'none');
<?php endif?>

//atribut
$('form').attr('action', '<?=base_url('penjualan/so_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');


  $(document).on('change', '.produk', function() {

    var id = $(this).val();
    var index = $(this).closest('tr').index();
    var arr = new Array(); 
    var stok = $(this).closest('tr').find('.stok_produk');
    var produk = $(this);

   /////// cek exist barang ///////////
    $.each($('.produk'), function(idx, val) {
        
        if (index != idx)
        arr.push($(this).val());

    });

    if (id != '') {

      if ($.inArray(id, arr) != -1) {
        var i = index + 1;

        alert_sweet('Produk sudah ada');

        //empty
        produk.val('').change();
        
      }
      ////// end exist barang ///////////
    }

  });

  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());
    
    //blank new input
    $('#copy').find('select').val('');
    $('#copy').find('.panjang').val(0);
  }

  //remove
  $(document).on('click', '.remove', 'tr a.remove', function(e) {
    e.preventDefault();
    $(this).closest('tr').remove();
  });

  function auto() { 

    //border none
    $('td').css('border-top', 'none');

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();  

</script>
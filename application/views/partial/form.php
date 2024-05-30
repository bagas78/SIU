<style type="text/css">
  .mb-7{
    margin-bottom: 7%;
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

      <form method="post" enctype="multipart/form-data">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group view">
              <label>Nomor Transaksi</label>
              <input type="text" name="nomor" class="form-control" id="nomor">
            </div>
            <div class="form-group view">
              <label>Tanggal Transaksi</label>
              <input type="date" name="tanggal" class="form-control" id="tanggal">
            </div> 
            <div class="form-group view">
              <label>Supplier</label>
              <select name="supplier" class="form-control select2" id="supplier">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($kontak_data as $s): ?>
                  <option value="<?= $s['kontak_id']?>"><?= $s['kontak_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group view">
              <label>Gudang</label>
              <select name="gudang" class="form-control select2" id="gudang">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($gudang_data as $g): ?>
                  <option value="<?= $g['gudang_id']?>"><?= $g['gudang_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group view">
              <label>Status Pembayaran</label>
              <select name="status" class="form-control" id="status">
                <option value="" hidden>-- Pilih --</option>
                <option value="lunas">Lunas</option>
                <option value="belum">Belum Lunas</option>
              </select>
            </div>
            <div class="form-group view">
              <label>Jatuh Tempo</label>
              <input type="date" name="jatuh_tempo" class="form-control" id="jatuh_tempo">
            </div>
            <div class="form-group view">
              <label>Pembayaran</label>
              <select name="pembayaran" class="form-control select2" id="pembayaran">
                <option value="" hidden>-- Pilih --</option>
                <option value="tunai" hidden>Tunai</option>
                <?php foreach ($rekening_data as $r): ?>
                  <option value="<?= $r['rekening_id']?>"><?= $r['rekening_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group view">
              <label>Ekspedisi</label>
              <select name="ekspedisi" class="form-control select2" id="ekspedisi">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($ekspedisi_data as $e): ?>
                  <option value="<?= $e['ekspedisi_id']?>"><?= $e['ekspedisi_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group view">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control textarea" style="height: 110px;" id="keterangan"></textarea>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group view">

              <label>Lampiran Photo</label>
              <img id="previewImg" onclick="clickFile()" style="width: 100%;">
              <input style="visibility: hidden;" id="file" type="file" name="lampiran" onchange="previewFile(this)">
          
            </div>
          </div>
        </div>

        <div class="clearfix"></div>

        <table class="table table-responsive table-borderless">
          <thead>
            <tr>
              <th width="300">Bahan</th>
              <th width="200">Berat <span class="stn">Kg</span></th>
              <th width="200">Panjang <span class="stn">Mtr</span></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <span class="text-barang"></span><br/>
                <span class="badge text-berat"></span> 
                <span class="badge text-panjang"></span>

                <!-- hidden -->
                <input type="hidden" name="id[]" class="id form-control">
                <input type="hidden" name="barang[]" class="barang form-control">

              </td>
              <td>
                <input required type="number" name="berat[]" class="berat form-control" step="any">
              </td>
              <td>
                <input required type="number" name="panjang[]" class="panjang form-control" step="any">
              </td>
            </tr>

            <tr class="save">
              <td colspan="5" align="right">
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

//atribut
$('form').attr('action', '<?=base_url('partial/save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');
$('#previewImg').attr('src', '<?=base_url('assets/gambar/camera.png')?>');

  //status
$(document).on('change', '#status', function() {

  var val = $(this).val();

  if (val == 'lunas') {

    //status lunas jatuh tempo tidak perlu
    $('#jatuh_tempo').removeAttr('required');
    $('#jatuh_tempo').val('').attr('readonly', true);

  }else{

    //kembalikan
    $('#jatuh_tempo').removeAttr('readonly');
    $('#jatuh_tempo').attr('required', true);

  }

});


  //copy paste
  function clone(){
    //paste
    $('#paste').prepend($('#copy').clone());
  }

  //foto preview
  function clickFile(){
    $('#file').click();
  }
  function previewFile(input){
      var file = $("#file").get(0).files[0];

      if(file){
          var reader = new FileReader();

          reader.onload = function(){
              $("#previewImg").attr("src", reader.result);
          }

          reader.readAsDataURL(file);
      }
  }

  function auto(){

    //view UI
    $('.view').css('pointer-events', 'none').find('.select2-selection--single, .form-control').css('background', '#EEEEEE');

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
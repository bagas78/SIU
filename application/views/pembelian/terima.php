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
 
      <div hidden id="search" align="left">
        <div class="col-md-3 col-xs-11 row" style="margin-bottom: 0;">
          <input id="po" type="text" class="form-control" placeholder="PB-xxxx">
        </div>
        <div class="col-md-1 col-xs-1">
          <button id="po_get" type="button" class="btn btn-primary"><i class="fa fa-search"></i></button>
        </div>
      </div>

    </div>
    <div class="box-body"> 

      <form method="post" enctype="multipart/form-data" class="bg-alice">
        <div class="row">
          <div class="col-md-3">
            <div class="form-group">
              <label>Nomor Transaksi</label>
              <input type="text" name="nomor" class="form-control" required id="nomor">
            </div>
            <div class="form-group">
              <label>Tanggal Transaksi</label>
              <input type="date" name="tanggal" class="form-control" required id="tanggal">
            </div> 
            <div class="form-group">
              <label>Supplier</label>
              <select name="supplier" class="form-control select2" required id="supplier">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($kontak_data as $s): ?>
                  <option value="<?= $s['kontak_id']?>"><?= $s['kontak_nama']?></option>
                <?php endforeach ?>
              </select>
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
          <div class="col-md-3">
            <div class="form-group">
              <label>Status Pembayaran</label>
              <select name="status" class="form-control" required id="status">
                <option value="" hidden>-- Pilih --</option>
                <option value="lunas">Lunas</option>
                <option value="belum">Belum Lunas</option>
              </select>
            </div>
            <div class="form-group">
              <label>Jatuh Tempo</label>
              <input type="date" name="jatuh_tempo" class="form-control" required id="jatuh_tempo">
            </div>
            <div class="form-group">
              <label>Pembayaran</label>
              <select name="pembayaran" class="form-control select2" required id="pembayaran">
                <option value="" hidden>-- Pilih --</option>
                <option value="tunai" hidden>Tunai</option>
                <?php foreach ($rekening_data as $r): ?>
                  <option value="<?= $r['rekening_id']?>"><?= $r['rekening_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Ekspedisi</label>
              <select name="ekspedisi" class="form-control select2" required id="ekspedisi">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($ekspedisi_data as $e): ?>
                  <option value="<?= $e['ekspedisi_id']?>"><?= $e['ekspedisi_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
          </div>
          <div class="col-md-4">
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control textarea" style="height: 110px;" id="keterangan"></textarea>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">

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
              <th class="th-bahan" width="300">Bahan</th>
              <th class="th-kode" width="300">Kode Item</th>
              <th class="th-berat" width="200">Berat <span class="stn">Kg</span></th>
              <th class="th-panjang" width="200">Panjang <span class="stn">Mtr</span></th>
              <th class="th-harga" width="200">Harga <span class="stn">Rp</span></th>
              <th class="th-total" width="200">Total <span class="stn">Rp</span></th>
              <th hidden class="th-terima" width="200">Terima</th>
              <th hidden class="th-id" width="300">id</th>
              <th><button type="button" onclick="clone()" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
            </tr>
          </thead>
          <tbody id="paste">

             <tr id="copy">
              <td>
                <select required id="barang" class="form-control" name="barang[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($bahan_data as $b): ?>
                    <option value="<?=@$b['bahan_id']?>"><?=@$b['bahan_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td>
                <input required type="text" name="kode[]" class="kode form-control">
              </td>
              <td>
                <input type="text" name="berat[]" class="berat form-control" value="0" min="1" step="any">
              </td>
              <td>
                <input type="text" name="panjang[]" class="panjang form-control" value="0" step="any">
              </td>
              <td>
                <input type="text" name="harga[]" class="harga form-control" required value="0" min="1" step="any">
              </td>
              <td>
                <input readonly="" type="text" name="total[]" class="total form-control" required value="0" min="0">
              </td>

              <td hidden>
                <input type="text" name="terima[]" class="terima form-control" value="1" step="any">
              </td>

              <td hidden>
                <input required type="text" name="id[]" class="id form-control" value="<?=@$id?>">
              </td>

              <td>
                <button type="button" onclick="hide($(this))" class="remove btn btn-danger btn-sm"><i class="fa fa-minus"></i></button>
              </td>
            </tr>

            <tr>
              <td colspan="4"></td>
              <td align="right"><b>Subtotal</b> <span class="stn">Kg</span></td>
              <td><input id="subtotal" readonly="" type="text" name="subtotal" class="form-control"></td>
            </tr>

            <tr>
              <td colspan="4"></td>
              <td align="right"><b>Ekspedisi</b> <span class="stn">Rp</span></td>
              <td>
                <input min="0" type="text" name="ekspedisi_total" class="ekspedisi form-control" value="0" required step="any" id="ekspedisi_total">
              </td>
            </tr>

            <tr>
              <td colspan="4"></td>
              <td align="right"><b>PPN</b> <span class="stn">&#160;%&#160;</span></td>
              <td>
                <input readonly="" id="ppn" type="text" name="ppn" class="form-control text-number" value="<?=$ppn['pajak_persen']?>">
              </td>
              <td><input class="check" type="checkbox" checked="" style="-webkit-transform: scale(1.5);margin-top: 10px;"></td>
            </tr>

            <tr>
              <td colspan="4"></td>
              <td align="right"><b>Grand Total</b> <span class="stn">Rp</span></td>
              <td><input id="grandtotal" readonly="" type="text" name="grandtotal" class="form-control" value="0" min="0"></td>
            </tr>

            <tr class="save">
              <td colspan="6" align="right">
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
$('form').attr('action', '<?=base_url('pembelian/terima_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');
$('#previewImg').attr('src', '<?=base_url('assets/gambar/camera.png')?>');

  $(document).on('change', '#barang', function() {
      var id = $(this).val();
      var index = $(this).closest('tr').index();
      var target = $(this);
      $.get('<?=base_url('pembelian/get_barang/')?>'+id, function(data) {
        var val = JSON.parse(data);
        var i = (index + 1);
        
        //get
        target.closest('tr').find('.harga').val(val['bahan_harga']);

      });
  });

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

    //blank new input
    $('#copy').find('select').val('');
    $('#copy').find('.qty').val(1);
    $('#copy').find('.berat').val(0);
    $('#copy').find('.panjang').val(0);
    $('#copy').find('.stok').val(0);
    $('#copy').find('.harga').val(0);
    $('#copy').find('.total').val(0);
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

    //border none
    $('td').css('border-top', 'none');
    
    var sum_berat = 0;
    $.each($('.berat'), function(index, val) {
       var i = index+1;
       var target = $(this).closest('tr');

       var berat = target.find('.berat').val();
       var harga = target.find('.harga').val().replaceAll(',', '');

       //perhitungan
       var total = Number(berat) * Number(harga);
       sum_berat += Number($(this).val());

       //total number format
       target.find('.total').val(number_format(total.toFixed(3).replaceAll('.000', '')));

    });

    //subtotal
    $('#subtotal').val(sum_berat);

    //total akhir
    var sum_total = 0;
    $.each($('.total'), function(index, val) {
        
      sum_total += Number($(this).val().replaceAll(',', ''));
    });

    //total akhir
    var ekspedisi = Number($('#ekspedisi_total').val().replaceAll(',', ''));

    var grandtotal =sum_total + ekspedisi;
    $('#grandtotal').val(number_format(grandtotal.toFixed(3).replaceAll('.000', '')));


    <?php if ($this->uri->segment(2) == 'po_proses'): ?>

      //hide proses
      $('#status').closest('.form-group').hide();
      $('#pembayaran').closest('.form-group').hide();
      $('.harga').closest('td').hide();
      $('.total').closest('td').hide();
      $('.th-harga').hide();
      $('.th-total').hide();
      $('#subtotal').closest('tr').hide();
      $('#ekspedisi_total').closest('tr').hide();
      $('#ppn').closest('tr').hide();
      $('#grandtotal').closest('tr').hide();
      $('.add').closest('th').hide();
      // $('.remove').closest('td').hide();

      //lock
      $('#nomor').attr('readonly', '');
      $('#supplier').closest('.form-group').css('pointer-events', 'none');
      $('#supplier').closest('.form-group').find('.select2-selection--single').css('background', '#EEEEEE');
      $('#barang').attr('readonly', '').css('pointer-events', 'none');
      $('.kode').attr('readonly', '');

    <?php endif ?>

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

  //ppn
  $(document).on('change', '.check', function() {
      
      if(this.checked) {
        //on    
        $('#ppn').val('<?=$ppn['pajak_persen']?>');
      }else{
        //off
        $('#ppn').val(0);
      }

  });

//hide
function hide(target){

  target.closest('tr').find('.terima').val(0);
  target.closest('tr').hide();
}

</script>
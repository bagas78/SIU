
<style type="text/css">
  .mb-7{
    margin-bottom: 7%;
  }
  .readonly{
    /*pointer-events: none;*/
    background: #EEEEEE; 
  } 
  .readonly::-webkit-outer-spin-button, 
  .readonly::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
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

        <!-- hidden-->
        <input type="hidden" name="so_proses" class="form-control" id="so_proses">
        
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
              <label>Pelanggan</label>
              <select name="pelanggan" class="form-control select2" required id="pelanggan">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($kontak_data as $s): ?>
                  <option value="<?= $s['kontak_id']?>"><?= $s['kontak_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Ambil Sendiri</label>
              <select name="ambil" class="form-control select2" required id="ambil">
                <option value="" hidden>-- Pilih --</option>
                <option value="iya">Iya</option>
                <option value="tidak">Tidak</option>
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
              <label>Gudang</label>
              <select name="gudang" class="form-control select2" id="gudang">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($gudang_data as $gd): ?>
                  <option value="<?= $gd['gudang_id']?>"><?= $gd['gudang_nama']?></option>
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

        <div id="form-produk">

          <table class="table table-responsive table-borderless">
            <thead>
              <tr>
                <th width="300">Produk</th>
                <th width="120">Stok <span class="stn">Mtr</span></th>
                <th width="120">Konversi <span class="stn">Mtr</span></th>
                <th width="120">Batang <span class="stn">Btg</span></th>
                <th width="120">Panjang <span class="stn">text</span></th>
                <th width="120">Qty <span class="stn">text</span></th>
                <th width="120">Panjang <span class="stn">Mtr</span></th>
                <th width="120">Harga <span class="stn">Rp</span></th>
                <th width="120">Total <span class="stn">Rp</span></th>
                <th><button type="button" onclick="clone()" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
              </tr>
            </thead>
            <tbody id="paste">

               <tr id="copy">
                <td>
                  <select required id="produk" class="produk form-control" name="barang[]">
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($produk_data as $b): ?>
                      <option value="<?=@$b['produk_id']?>"><?=@$b['produk_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </td>
                <td>
                  <input type="text" name="stok[]" class="stok form-control" min="0" readonly="" value="0" step="any">
                </td>
                <td>
                  <input readonly type="text" name="konversi[]" class="konversi form-control" value="0" min="1" >
                </td>
                <td>
                  <input readonly type="text" name="batang[]" class="batang form-control" value="0" min="1" >
                </td>


                <!--panjang total -->
                <td>
                  <input type="text" name="panjang[]" class="panjang form-control" value="0" min="1" step="any">
                </td>
                
                <td>
                  <input type="text" name="qty[]" class="qty form-control"  value="0" min="1" step="any">
                </td>

                <!--panjang X qty -->
                <td>
                  <input type="text" name="panjang_total[]" class="panjang_total form-control" value="0" min="1" step="any">
                </td>

                <td>
                  <input type="text" name="harga[]" class="harga form-control" value="0" min="1" step="any">
                </td>
                <td><input type="text" name="total[]" class="total form-control readonly" value="0" min="1" step="any"></td>

                <!--hidden-->
                <td hidden>
                  <input type="text" name="hps[]" class="hps form-control readonly">
                </td>

                <td><button type="button" onclick="$(this).closest('tr').remove()" class="remove btn btn-danger btn-sm"><i class="fa fa-minus"></i></button></td>
              </tr>

              <tr>
                <td colspan="6"></td>
                <td align="right"><b>Subtotal</b> <span class="stn">Mtr</span></td>
                <td colspan="2"><input id="subtotal" readonly="" type="text" name="subtotal" class="form-control"></td>
              </tr>

              <tr>
                <td colspan="6"></td>
                <td align="right"><b>PPN</b> <span class="stn">&#160;%&#160;</span></td>
                <td colspan="2">
                  <input readonly="" id="ppn" type="text" name="ppn" class="form-control" value="<?=$ppn['pajak_persen']?>">
                </td>
                <td><input class="check" type="checkbox" checked="" style="-webkit-transform: scale(1.5);margin-top: 10px;"></td>
              </tr>

              <tr>
                <td colspan="6"></td>
                <td align="right"><b>Grand Total</b> <span class="stn">Rp</span></td>
                <td colspan="2"><input id="grandtotal" readonly="" type="text" name="grandtotal" class="form-control" value="0" min="0"></td>
              </tr>

              <tr class="save">
                <td colspan="9" align="right">
                  <button type="submit" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                  <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
                </td>
              </tr>

            </tbody>
          </table>

        </div>

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
$('form').attr('action', '<?=base_url('penjualan/'.@$url.'_save')?>');
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

$(document).on('keyup', '.batang , .panjang, .qty', function() {

  //konversi * batang
  var batang = Number($(this).closest('tr').find('.batang').val().replaceAll(',',''));
  var konversi = Number($(this).closest('tr').find('.konversi').val());

  if (konversi != 0) {

    $(this).closest('tr').find('.panjang').val(batang * konversi);
  }
  
  //panjang * qty
  var panjang = Number($(this).closest('tr').find('.panjang').val().replaceAll(',',''));
  var qty = Number($(this).closest('tr').find('.qty').val().replaceAll(',',''));
  $(this).closest('tr').find('.panjang_total').val(round(panjang * qty, 3));

});

//gudang
$(document).on('blur focus change', '#gudang', function() {

  $("#form-produk").load(location.href + " #form-produk");

});

//get barang
$(document).on('change', '#produk', function() {
    var id = $(this).val();
    var text = $(this).text();
    var index = $(this).closest('tr').index();
    var target = $(this).closest('tr');
    var gudang = $('#gudang').val();

    /////// cek exist barang ///////////
    // var arr = new Array(); 
    // $.each($('.produk'), function(idx, val) {
        
    //     if (index != idx)
    //     arr.push($(this).val());

    // });

    // if (id != '') {

    //   if ($.inArray(id, arr) != -1) {
    //     var i = index + 1;

    //     alert_sweet('Produk sudah ada');
        
    //     target.find('select').val('').change();
    //     target.find('.stok').val(0);
    //     target.find('.panjang').val(0);
    //     target.find('.harga').val(0);
    //     target.find('.hps').val(0);
        
    //   } else {

        if (gudang != '') {

          $.get('<?=base_url('penjualan/get_produk/')?>'+id+'/'+gudang, function(data) {
          
            var val = $.parseJSON(data);

            //0
            target.find('.konversi').val(0);
            target.find('.batang').val(0);
            target.find('.panjang').val(0);
            target.find('.qty').val(0);
            target.find('.panjang_total').val(0);
            target.find('.stok').val(0);
            target.find('.hps').val(0);
            target.find('.harga').val(val['produk_harga']);
              
            if (val != null) {

              target.find('.stok').val(val['produk_gudang_panjang'].replaceAll('.00',''));
              target.find('.hps').val(val['produk_gudang_hps']);
              

              //cek konversi
              var konversi = val['produk_konversi'];
              if (konversi == '') {

                //spandex
                target.find('.batang').attr('readonly', true);
                target.find('.panjang').removeAttr('readonly');

              }else{

                //hollow
                target.find('.batang').removeAttr('readonly');
                target.find('.panjang').attr('readonly', true);
                target.find('.konversi').val(konversi);

              }

            }else{

              target.find('select').val('').change();
              target.find('.stok').val(0);
              target.find('.panjang').val(0);
              target.find('.harga').val(0);
              target.find('.hps').val(0);
              target.find('.konversi').val(0);

              alert_sweet('Produk tidak tersedia di gudang yang di pilih');
            }

          });
        }else{

          $.get('<?=base_url('penjualan/get_produk/')?>'+id, function(data) {
          
            var val = $.parseJSON(data);

            target.find('.harga').val(val['produk_harga']);

          });

          // alert_sweet('Gudang belum di pilih');

          // target.find('select').val('').change();
          // target.find('.stok').val(0);
          // target.find('.panjang').val(0);
          // target.find('.harga').val(0);
          // target.find('.hps').val(0);
          // target.find('.konversi').val(0);
        
        }
    
      ////// end exist barang ///////////
    //}

});


//copy paste
function clone(){
  //paste
  var produk = $('.produk').val();
  
  $('#paste').prepend($('#copy').clone());

  //blank new input
  $('#copy').find('select').val(produk).change();
  $('#copy').find('.stok').val(0);
  $('#copy').find('.panjang').val(0);
  $('#copy').find('.harga').val(0);
  $('#copy').find('.total').val(0);
  $('#copy').find('.hps').val(0);
  $('#copy').find('.konversi').val(0);
  $('#copy').find('.batang').val(0);
  $('#copy').find('.qty').val(0);
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

//submit validation
$('form').on('submit', function() {
    
    var err = 0;
    $.each($('.produk'), function(index, val) {
       
       var stok = $(this).closest('tr').find('.stok').val();
       var panjang = $(this).closest('tr').find('.panjang_total').val();

       if (Number(stok) < Number(panjang)) {

        // err += 1;
        // disable cek stok
        err = 0;

       }

    });

    if (err != 0) {

      alert_sweet('Terdapat panjang yang lebih dari stok');
      return false;
    }else{

      return true;
    }

});

function auto(){

  //border none
  $('td').css('border-top', 'none');
  
  //total
  var sum_total = 0;
  $.each($('.panjang'), function(index, val) {

    var target = $(this).closest('tr');

    // var panjang = Number(target.find('.panjang_total').val().replaceAll('.', ''));
    var panjang = Number(target.find('.panjang_total').val());
    var harga = Number(target.find('.harga').val().replaceAll(',', ''));

    // hydev: jika batang != 0 total rumunsnya berikut
    var hyBatang = Number(target.find('.batang').val());

    if (hyBatang != 0) {
      var total = hyBatang * harga; 
    } else {
      var total = panjang * harga; 
    }  
    
    totalRp = total;

    total = total.toFixed(3).replaceAll('.000', '');
    
    sum_total += totalRp;

    //total
    target.find('.total').val(number_format(total));

  });

  //subtotal
  $('#subtotal').val(number_format(sum_total.toFixed(3).replaceAll('.000', '')));
  // $('#subtotal').val(number_format(sum_total));

  //grand total
  var sum_subtotal = 0;
  $.each($('.total'), function(index, val) {
      
    sum_subtotal += Number($(this).val().replaceAll(',', ''));
  });

  //total akhir
  // var ppn = (Number($('#ppn').val()) * Number(sum_subtotal) / 100);
  // var grandtotal = ppn + sum_subtotal;

  var grandtotal = sum_subtotal;
  $('#grandtotal').val(number_format(grandtotal.toFixed(3).replaceAll('.000', '')));

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

</script>
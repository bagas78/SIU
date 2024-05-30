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
              <label>Nomor Produksi</label>
              <input type="text" name="nomor" class="form-control" required id="nomor">
            </div>
            <div class="form-group">
              <label>Tanggal Produksi</label>
              <input step="any" type="datetime-local" name="tanggal" class="form-control" required id="tanggal">
            </div>
            <div class="form-group">
              <label>Shift</label>
              <select name="shift" class="form-control select2" required id="shift">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($user_data as $u): ?>
                  <option value="<?= $u['user_id']?>"><?= $u['user_name']?></option>
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
          <div class="col-md-5">
            <div class="pekerja form-group">
              <label>Pekerja</label>
                <select required name="pekerja[]" id="pekerja" class="form-control select2" multiple="multiple" data-placeholder="-- Pilih --"style="width: 100%;">
                  <?php foreach ($pekerja_data as $p): ?>
                    <option value="<?= @$p['karyawan_id']?>"><?= @$p['karyawan_nama']?></option>
                  <?php endforeach ?>
                </select>
            </div>
            <div class="form-group">
              <label>Mesin</label>
              <select name="mesin" class="form-control select2" required id="mesin">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($mesin_data as $m): ?>
                  <option value="<?= $m['mesin_id']?>"><?= $m['mesin_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea name="keterangan" class="form-control textarea" style="height: 105px;" id="keterangan"></textarea>
            </div>
          </div>

          <!-- img atachment -->
          <div class="col-md-2">
            <div class="form-group">

              <label>Sebelum Produksi</label>
              <img id="previewImg1" onclick="clickFile(1)" style="width: 100%;">
              <input style="visibility: hidden;" id="file1" type="file" name="lampiran[]" onchange="previewFile(this,1)">
          
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">

              <label>Sesudah Produksi</label>
              <img id="previewImg2" onclick="clickFile(2)" style="width: 100%;">
              <input style="visibility: hidden;" id="file2" type="file" name="lampiran[]" onchange="previewFile(this,2)">
          
            </div>
          </div>

        </div>

        <div class="clearfix"></div><br/>

        <center class="tit"><span>Produksi</span></center>

        <table class="table table-responsive table-borderless">
          <thead>
            <tr>
              <th>Produk</th> 
             
              <th width="150">Konversi <span class="stn">Mtr</span></th>
              <th width="150">Batang <span class="stn">Btg</span></th>
              <th width="150">Panjang <span class="stn">text</span></th>
              <th width="150">Qty <span class="stn">text</span></th>  

              <th>Panjang <span class="stn">Mtr</span></th>
              <th width="1"><button type="button" onclick="clone('1')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
            </tr>
          </thead>
          <tbody id="paste1"> 

             <tr id="copy1">
              <td>
                <select required id="produk" class="produk form-control" name="produk[]">
                  <option value="" hidden>-- Pilih --</option>
                  <?php foreach ($produk_data as $p): ?>
                    <option value="<?=@$p['produk_id']?>"><?=@$p['produk_nama']?></option>
                  <?php endforeach ?>
                </select>
              </td>

              <td>
                <input readonly type="text" name="produk_konversi[]" class="produk_konversi form-control" value="0" min="1" required>
              </td>
              <td>
                <input readonly type="text" name="produk_batang[]" class="produk_batang form-control" value="0" min="1" required>
              </td>


              <!--panjang total -->
              <td>
                <input type="text" name="produk_panjang[]" class="produk_panjang form-control" value="0" min="1" step="any" required>
              </td>

              <td>
                <input type="text" name="produk_qty[]" class="produk_qty form-control" value="0" min="1" step="any" required>
              </td>

              <!--panjang X qty -->
              <td>
                <input readonly type="text" name="produk_panjang_total[]" class="produk_panjang_total form-control" value="0" min="1" step="any">
              </td>
              
              <td><button type="button" class="remove btn btn-danger btn-sm"><i class="fa fa-minus"></i></button></td>
            </tr>

            <!-- TOTAL -->
            <tr>
              <td colspan="3" style="text-align: right; vertical-align: middle;"><b>TOTAL</b></td>
              <td>
                <input type="text" id="produk_panjang" name="" class="form-control" readonly>
              </td>
              <td>
                <input type="text" id="produk_qty" name="" class="form-control" readonly>
              </td>
              <td>
                <input type="text" id="produk_panjang_total" name="" class="form-control" readonly>
              </td>
            </tr>

          </tbody>
        </table>

        <div class="clearfix"></div><br/>

        <center class="tit"><span>Bahan Baku</span></center>

        <div id="form-bahan">

          <table class="table table-responsive table-borderless">
            <thead>
              <tr>
                <th width="300">Bahan</th>
                <th width="300">Kategori</th>
                <th width="300" hidden>Hpp <span class="stn">Rp</span></th>
                <th width="300">Stok <span class="stn">Mtr</span></th>   
                <th width="300">Berat / Meter <span class="stn">Kg</span></th>           
                <th width="300">Panjang <span class="stn">Mtr</span></th>
                <th width="300" hidden>Total <span class="stn">Rp</span></th>
                <th><button type="button" onclick="clone('2')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
              </tr>
            </thead>
            <tbody id="paste2">

               <tr id="copy2">
                <td>
                  <select required id="bahan" class="bahan form-control" name="bahan[]">
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($bahan_data as $b): ?>
                      <option value="<?=@$b['bahan_id']?>"><?=@$b['bahan_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </td>

                <td>
                  <input type="text" name="kategori[]" class="kategori form-control" required readonly>
                </td>
                <td hidden>
                  <input min="0" type="text" name="harga[]" class="harga form-control text-number" value="0" required readonly step="any">
                </td>

                <td>
                  <input min="0" type="text" name="stok[]" class="stok form-control text-number" value="0" required readonly step="any">                
                </td>

                <td>
                  <input type="text" name="berat[]" class="berat form-control text-number" required value="0" min="0" readonly step="any">
                </td>

                <td>
                  <input type="text" name="panjang[]" class="panjang form-control" required value="0" min="0" step="any">
                </td>

                <td hidden>
                  <input readonly min="0" type="text" name="total[]" class="total form-control text-number" value="0" required step="any">
                </td>
                
                <td><button type="button" class="remove btn btn-danger btn-sm"><i class="fa fa-minus"></i></button></td>
              </tr>

              <tr hidden>
                <td colspan="5"></td>
                <td align="right"><b>Subtotal</b> <span class="stn">Rp</span></td>
                <td>
                  <input readonly required id="subtotal" type="text" name="subtotal" class="form-control text-number" value="0" min="0" step="any">
                </td>
              </tr>

              <tr hidden>
                <td colspan="5"></td>
                <td align="right"><b>Biaya Jasa</b> <span class="stn">Rp</span></td>
                <td>
                  <input id="jasa" type="text" name="jasa" class="form-control text-number" value="0" min="0" step="any">
                </td>
              </tr>

              <tr hidden>
                <td colspan="5"></td>
                <td align="right"><b>Grand Total</b> <span class="stn">Rp</span></td>
                <td>
                  <input id="grandtotal" readonly="" type="text" name="grandtotal" class="form-control text-number" value="0" min="0" step="any">
                </td>
              </tr>
              <tr class="save">
                <td colspan="7" align="right">
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
$('form').attr('action', '<?=base_url('produksi/'.@$url.'_save')?>');
$('#nomor').val('<?=@$nomor?>');
$('#tanggal').val('<?=date('Y-m-d')?>');
$('#previewImg1').attr('src', '<?=base_url('assets/gambar/1.png')?>');
$('#previewImg2').attr('src', '<?=base_url('assets/gambar/2.png')?>');

$(document).on('change', '.produk', function() {

    var id = $(this).val();
    var index = $(this).closest('tr').index();
    var arr = new Array(); 
    var stok = $(this).closest('tr').find('.stok_produk');
    var target = $(this).closest('tr');

   /////// cek exist barang ///////////
    $.each($('.produk'), function(idx, val) {
        
        console.log(idx);

        if (index != idx)
        arr.push($(this).val());

    });

    if (id != '') {

      if ($.inArray(id, arr) != -1) {
        var i = index + 1;

        alert_sweet('Produk sudah ada');

        //empty
        target.find('.produk').val('').change();
        target.find('.produk_batang').val(0);
        target.find('.produk_panjang').val(0);
        target.find('.produk_qty').val(0);
        target.find('.produk_panjang_total').val(0);
        
      }else{

        $.get('<?=base_url('penjualan/get_produk/')?>'+id, function(data) {
            
            //0
            target.find('.produk_konversi').val(0);
            target.find('.produk_batang').val(0);
            target.find('.produk_panjang').val(0);
            target.find('.produk_qty').val(0);
            target.find('.produk_panjang_total').val(0);

            var val = $.parseJSON(data);

            //cek konversi
            var konversi = val['produk_konversi'];
            if (konversi == '') {

              //spandex
              target.find('.produk_batang').attr('readonly', true);
              target.find('.produk_panjang').removeAttr('readonly');
             
            }else{

              //hollow
              target.find('.produk_batang').removeAttr('readonly');
              target.find('.produk_panjang').attr('readonly', true);
              target.find('.produk_konversi').val(konversi);
            }


          });
      }
      ////// end exist barang ///////////
    }

  });
  
  //gudang
  $(document).on('blur focus change', '#gudang', function() {

    $("#form-bahan").load(location.href + " #form-bahan");

  })

  //bahan
  $(document).on('change', '.bahan', function() {

    var id = $(this).val();
    var index = $(this).closest('tr').index();
    var arr = new Array(); 
    var kategori = $(this).closest('tr').find('.kategori');
    var stok = $(this).closest('tr').find('.stok');
    var berat = $(this).closest('tr').find('.berat');
    var harga = $(this).closest('tr').find('.harga');
    var bahan = $(this);
    var panjang = $(this).closest('tr').find('.panjang');
    var total = $(this).closest('tr').find('.total');

   /////// cek exist barang ///////////
    $.each($('.bahan'), function(idx, val) {
        
        if (index != idx)
        arr.push($(this).val());

    });

    if (id != '') {

      if ($.inArray(id, arr) != -1) {
        var i = index + 1;

        alert_sweet('Bahan sudah ada');

        //empty
        bahan.val('').change();
        kategori.val('');
        stok.val(0);
        berat.val(0);
        harga.val(0);
        panjang.val(0);
        total.val(0);
        
      }else{

        var gudang = $('#gudang').val();

        if (gudang == '') {

          //empty
          bahan.val('').change();
          kategori.val('');
          stok.val(0);
          berat.val(0);
          harga.val(0);
          panjang.val(0);
          total.val(0);

          alert_sweet('Gudang belum di pilih');

        }else{

          $.get('<?= base_url('produksi/get_bahan/') ?>'+id+'/'+gudang, function(data) {
      
            var val = JSON.parse(data);

            if (val == null) {

              //empty
              bahan.val('').change();
              kategori.val('');
              stok.val(0);
              berat.val(0);
              harga.val(0);
              panjang.val(0);
              total.val(0);

              alert_sweet('Bahan tidak tersedia di gudang yang di pilih');

            }else{

              kategori.val(val.bahan_kategori);
              stok.val(number_format(val.stok.replaceAll('.00','')));
              berat.val(val.berat);
              harga.val(val.bahan_gudang_hpp);
            }

          });

        }
        
      }
      ////// end exist barang ///////////
    }

  });

  //copy paste
  function clone(target){
    //paste
    $('#paste'+target).prepend($('#copy'+target).clone());
    
    //blank new input
    $('#copy'+target).find('select').val('');
    $('#copy'+target).find('.kategori').val('');
    $('#copy'+target).find('.harga').val(0);
    $('#copy'+target).find('.stok').val(0);
    $('#copy'+target).find('.total').val(0);
    $('#copy'+target).find('.panjang').val(0);
    $('#copy'+target).find('.produk_panjang').val(0);
    $('#copy'+target).find('.produk_batang').val(0);
    $('#copy'+target).find('.id').val(0);

    //produk
    $('#copy'+target).find('.qty_produk').val(0);
  }

  //remove
  $(document).on('click', '.remove', 'tr a.remove', function(e) {
    e.preventDefault();
    $(this).closest('tr').remove();
  });

  //foto preview
  function clickFile(target){

    if (target == 1) {
      $('#file1').click();
    }else{
      $('#file2').click();
    }
  }
  function previewFile(input,target){

      if (target == 1) {

        var file = $("#file1").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewImg1").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
      }else{

        var file = $("#file2").get(0).files[0];

        if(file){
            var reader = new FileReader();

            reader.onload = function(){
                $("#previewImg2").attr("src", reader.result);
            }

            reader.readAsDataURL(file);
        }
      }
  }

  //subtotal
  $(document).on('keyup blur focus', '.panjang', function() {
      
     var panjang = $(this).val().replaceAll('.', '');
     var harga = $(this).closest('tr').find('.harga').val().replaceAll('.', '');
     var total = Number(harga) * Number(panjang);

     $(this).closest('tr').find('.total').val(number_format(total));

  });

  //submit validation
  $('form').on('submit', function() {
      
      var err = 0;
      $.each($('.bahan'), function(index, val) {
         
         var stok = $(this).closest('tr').find('.stok').val().replaceAll(',', '');
         var panjang = $(this).closest('tr').find('.panjang').val().replaceAll(',', '');

         if (Number(stok) < Number(panjang)) {

          err += 1;

         }

      });

      if (err != 0) {

        alert_sweet('Terdapat panjang yang lebih dari stok');
        return false;
      }else{

        return true;
      }

  });

  function auto() { 

    $.each($('.produk_qty'), function(index, val) {

      //konversi * batang
      var batang = Number($(this).closest('tr').find('.produk_batang').val());
      var konversi = Number($(this).closest('tr').find('.produk_konversi').val());

      if (konversi != 0) {
      
        $(this).closest('tr').find('.produk_panjang').val(batang * konversi);
        $(this).closest('tr').find('.produk_qty').attr('readonly', true);
        $(this).closest('tr').find('.produk_panjang_total').val((batang * konversi).toFixed(2));
      
      } else {
        
        $(this).closest('tr').find('.produk_qty').removeAttr('readonly');
          
        //panjang * qty
        var panjang = Number($(this).closest('tr').find('.produk_panjang').val());
        var qty = Number($(this).closest('tr').find('.produk_qty').val());
        $(this).closest('tr').find('.produk_panjang_total').val((panjang * qty).toFixed(2));
          
      }

    });

    //total produksi
    var jasa = Number($('#jasa').val());
    var total = 0;
    $.each($('.total'), function(index, val) {
        
        total += Number($(this).val().replaceAll('.', ''));

    });   

    $('#subtotal').val(number_format(total));
    $('#grandtotal').val(Number(total) + jasa);

    // Produk Panjang Total
    var produk_panjang_total = 0;
    $.each($('.produk_panjang_total'), function(index, val) {
      produk_panjang_total += round($(this).val().replaceAll(',',''), 2);
    });
    $('#produk_panjang_total').val(produk_panjang_total);

    // Produk qty
    var produk_qty = 0;
    $.each($('.produk_qty'), function(index, val) {
      produk_qty += round($(this).val().replaceAll(',',''), 2);
    });
    $('#produk_qty').val(produk_qty);

    // Produk panjang
    var produk_panjang = 0;
    $.each($('.produk_panjang'), function(index, val) {
      produk_panjang += round($(this).val().replaceAll(',',''), 2);
    });
    $('#produk_panjang').val(produk_panjang);

    //border none
    $('td').css('border-top', 'none');

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();  

</script>
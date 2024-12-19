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
              <input type="hidden" name="proses" class="form-control" required id="proses" value="0">
              <input type="hidden" name="log_id" class="form-control" required id="log_id" value="<?=@$log_id?>">
            </div>
            <div class="form-group">
              <label>Tanggal Produksi</label>
              <input step="any" type="datetime-local" name="tanggal" class="form-control" required id="tanggal">
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
            <div class="form-group">
              <label>Pelanggan</label>
              <select name="pelanggan" class="form-control select2" required id="pelanggan">
                <option value="" hidden>-- Pilih --</option>
                <?php foreach ($kontak_data as $s): ?>
                  <option value="<?= $s['kontak_id']?>"><?= $s['kontak_nama']?></option>
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
              <th hidden width="150">id</th>
              <th width="250">Produk</th>
              <th width="150">Konversi <span class="stn">Mtr</span></th>
              <th width="150">Batang <span class="stn">Btg</span></th>
              <th width="150">Panjang <span class="stn">text</span></th>
              <th width="150">Qty <span class="stn">text</span></th>  

              <th>Panjang <span class="stn">Mtr</span></th>
              <th hidden>Status </th>

              <th width="1"><button type="button" onclick="clone('1')" class="add_produk btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
            </tr>
          </thead>
          <tbody id="paste1"> 

             <tr id="copy1">

              <td hidden>
                <input readonly type="text" name="produk_id[]" class="produk_id form-control" value="0" required>
              </td>

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
                <input type="number" name="produk_panjang[]" class="produk_panjang form-control" value="0" min="1" step="any" required>
              </td>

              <td>
                <input type="number" name="produk_qty[]" class="produk_qty form-control" value="0" min="1" step="any" required>
              </td>

              <!--panjang X qty -->
              <td>
                <input readonly type="text" name="produk_panjang_total[]" class="produk_panjang_total form-control" value="0" min="1" step="any">
              </td>

              <td hidden>
                <input type="text" name="produk_status[]" value="1" class="produk_status">
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
                <th hidden width="300">id</th>
                <th width="300">Bahan</th>
                <th width="300">Kode Item</th>
                <th width="300">Kategori</th>
                <th width="200" hidden>Hpp <span class="stn">Rp</span></th>
                <th width="200">Stok <span class="stn">Mtr</span></th>   
                <th hidden width="200">Berat / Meter <span class="stn">Kg</span></th>           
                <th width="200">Panjang <span class="stn">Mtr</span></th>
                <th hidden width="200" >Status</th>
                <th width="200" hidden>Total <span class="stn">Rp</span></th>
                <th><button type="button" onclick="clone('2')" class="add btn btn-success btn-sm"><i class="fa fa-plus"></i></button></th>
              </tr>
            </thead>
            <tbody id="paste2">

               <tr id="copy2">

                <td hidden>
                  <input type="text" name="id[]" class="id form-control" value="0" readonly>                
                </td>

                <td>
                  <select required id="bahan" class="bahan form-control" name="bahan[]">
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($bahan_data as $b): ?>
                      <option value="<?=@$b['bahan_id']?>"><?=@$b['bahan_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </td>

                <td>
                  <select required id="kode" class="kode form-control" name="kode[]">
                    
                  </select>
                </td>

                <td>
                  <input type="text" name="kategori[]" class="kategori form-control" required readonly>
                </td>
                <td hidden>
                  <input min="0" type="text" name="harga[]" class="harga form-control" value="0" required readonly step="any">
                </td>

                <td>
                  <input min="0" type="text" name="stok[]" class="stok form-control" value="0" required readonly step="any">                
                </td>

                <td hidden>
                  <input type="text" name="berat[]" class="berat form-control" required value="0" min="0" readonly step="any">
                </td>

                <td>
                  <input type="number" name="panjang[]" class="panjang form-control" required value="0" min="1" step="any">
                </td>

                <td hidden>
                  <input type="number" name="status[]" class="status form-control" required value="1" min="1" step="any">
                </td>

                <td hidden>
                  <input readonly min="0" type="text" name="total[]" class="total form-control text-number" value="0" required step="any">
                </td>
                
                <td><button type="button" class="remove btn btn-danger btn-sm"><i class="fa fa-minus"></i></button></td>
              </tr>

              <tr hidden>
                <td colspan="6"></td>
                <td align="right"><b>Subtotal</b> <span class="stn">Rp</span></td>
                <td>
                  <input readonly required id="subtotal" type="text" name="subtotal" class="form-control text-number" value="0" min="0" step="any">
                </td>
              </tr>

              <tr hidden>
                <td colspan="6"></td>
                <td align="right"><b>Biaya Jasa</b> <span class="stn">Rp</span></td>
                <td>
                  <input id="jasa" type="text" name="jasa" class="form-control text-number" value="0" min="0" step="any">
                </td>
              </tr>

              <tr hidden>
                <td colspan="6"></td>
                <td align="right"><b>Grand Total</b> <span class="stn">Rp</span></td>
                <td>
                  <input id="grandtotal" readonly="" type="text" name="grandtotal" class="form-control text-number" value="0" min="0" step="any">
                </td>
              </tr>
              <tr class="save">
                <td colspan="8" align="right">
                  <button onclick="send()" type="button" class="btn btn-primary">Simpan <i class="fa fa-check"></i></button>
                  <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

                  <!-- submit -->
                  <button type="submit" hidden></button>
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

//partial stok
if ('<?=$this->uri->segment(2)?>' == 'proses_so') {
  $('.add_produk').hide();
}

//view UI
<?php if(@$view == 1):?>
  $('.back').removeAttr('hidden');
  $('.add').remove();
  $('.add_produk').remove();
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

        if (index != idx)
        arr.push($(this).val());

    });

    if (id != '') {

      if ($.inArray(id, arr) != -1) {
        var i = index + 1;

        // alert_sweet('Produk sudah ada');

        // //empty
        // target.find('.produk').val('').change();
        // target.find('.produk_batang').val(0);
        // target.find('.produk_panjang').val(0);
        // target.find('.produk_qty').val(0);
        // target.find('.produk_panjang_total').val(0);
        
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

        // alert_sweet('Bahan sudah ada');

        // //empty
        // bahan.val('').change();
        // kategori.val('');
        // stok.val(0);
        // berat.val(0);
        // harga.val(0);
        // panjang.val(0);
        // total.val(0);
        
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

    if (target == 1) {
      //produk
      var x = $('.produk').val();

    }else{
      //bahan
      var x = $('.bahan').val();

    }

    $('#paste'+target).prepend($('#copy'+target).clone().removeAttr('hidden'));
    
    //blank new input
    $('#copy'+target).find('select').val(x).change();
    //$('#copy'+target).find('.kategori').val('');
    $('#copy'+target).find('.harga').val(0);
    $('#copy'+target).find('.stok').val(0);
    $('#copy'+target).find('.total').val(0);
    $('#copy'+target).find('.panjang').val(0);
    $('#copy'+target).find('.produk_panjang').val(0);
    $('#copy'+target).find('.produk_batang').val(0); 
    $('#copy'+target).find('.id').val(0);
    $('#copy'+target).find('.produk_status').val(1);
    $('#copy'+target).find('.status').val(1);

    //produk
    $('#copy'+target).find('.qty_produk').val(0);
  }

  //remove
  $(document).on('click', '.remove', 'tr a.remove', function(e) {
    e.preventDefault();

    //hide row
    $(this).closest('tr').hide();

    //produk status
    $(this).closest('tr').find('.produk_status').val(0);

    //bahan status
    $(this).closest('tr').find('.status').val(0);

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

  //bahan
  $(document).on('change', '.bahan', function() {

    //empty
    $(this).closest('tr').find('.kode').empty();
      
    var id = $(this).val();
    var gudang = $('#gudang').val();

    $.get('<?=base_url('produksi/get_item/')?>'+id+'/'+gudang, function(data) {

      var arr = $.parseJSON(data);

      var html = '<option value="" hidden>-- Pilih --</option>';
      $.each(arr, function(index, val) {
         
         html += '<option value="'+val['bahan_item_id']+'">'+val['bahan_item_kode']+'</option>';

      });

      $('.kode').append(html);

    });

  });

  //kode
  $(document).on('change', '.kode', function() {
      
    var id = $(this).val();
    var gudang = $('#gudang').val();
    var target = $(this).closest('tr');

    $.get('<?=base_url('produksi/get_kode/')?>'+id+'/'+gudang, function(data) {

      var val = $.parseJSON(data);
      var stok = val['bahan_item_panjang'];

      if (stok > 0) {

        target.find('.stok').val(stok);
      }else{

        target.find('#kode').val('').change();
        target.find('.stok').val('');
        alert_sweet('Stok Kosong');
      }

    });

  });

  //subtotal
  $(document).on('keyup blur focus', '.panjang', function() {
      
     var panjang = $(this).val().replaceAll('.', '');
     var harga = $(this).closest('tr').find('.harga').val().replaceAll('.', '');
     var total = Number(harga) * Number(panjang);

     $(this).closest('tr').find('.total').val(number_format(total));

  });

  function send(){

    var panjang_produksi = Number($('#produk_panjang_total').val());
    var panjang_bahan = 0;
    $.each($('.panjang'), function() {
        
        panjang_bahan += Number($(this).val());
    });

    if (panjang_bahan > panjang_produksi) {

      swal({
        title: "Panjang bahan lebih besar dari produksi",
        text: "Apakah tetap mau lanjut save ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          
          $('form').find('[type="submit"]').trigger('click');
          
        }

      });

    }

    if (panjang_bahan < panjang_produksi) {

      alert_sweet('Bahan tidak lebih kecil dari total produksi');
    }

    if (panjang_bahan == panjang_produksi) {
      
      $('form').find('[type="submit"]').trigger('click');
    }

  }

  //submit validation
  $('form').on('submit', function() {

      // var err = 0;
      // $.each($('.bahan'), function(index, val) {
         
      //    var stok = $(this).closest('tr').find('.stok').val().replaceAll(',', '');
      //    var panjang = $(this).closest('tr').find('.panjang').val().replaceAll(',', '');

      //    if (Number(stok) < panjang) {

      //     err += 1;

      //    }

      // });

      // if (err != 0) {

      //   alert_sweet('Terdapat panjang yang lebih dari stok');
        //return false;
      // }else{

      //   return true;
      // }

  });

  function auto() { 

    var s = 1;
    $.each($('.produk_qty'), function(index, val) {

      //konversi * batang
      var batang = Number($(this).closest('tr').find('.produk_batang').val());
      var konversi = Number($(this).closest('tr').find('.produk_konversi').val());
      var status = $(this).closest('tr').find('.produk_status').val();

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

      if (status == 0) {
        s = status;
      }

    });

    if (s == 0) {

      $('#proses').val(1);
    }else{

      $('#proses').val(2);
    }

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

      var status = $(this).closest('tr').find('.produk_status').val();

      if (status == 1) {

        produk_panjang_total += round($(this).val().replaceAll(',',''), 2);
      }
    
    });
    $('#produk_panjang_total').val(produk_panjang_total);

    // Produk qty
    var produk_qty = 0;
    $.each($('.produk_qty'), function(index, val) {

      var status = $(this).closest('tr').find('.produk_status').val();

      if (status == 1) {

        produk_qty += round($(this).val().replaceAll(',',''), 2);
      }

    });
    $('#produk_qty').val(produk_qty);

    // Produk panjang
    var produk_panjang = 0;
    $.each($('.produk_panjang'), function(index, val) {

      var status = $(this).closest('tr').find('.produk_status').val();

      if (status == 1) {

        produk_panjang += round($(this).val().replaceAll(',',''), 2);
      }

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
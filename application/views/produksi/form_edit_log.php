<script>

  //atribut form
  $('#nomor').val('<?=@$data['produksi_nomor']?>');
  $('#tanggal').val('<?=@$data['produksi_log_tanggal']?>');
  $('#keterangan').val('<?=@$data['produksi_log_keterangan']?>'); 
  $('#mesin').val('<?=@$data['produksi_log_mesin']?>').change();   
  $('#gudang').val('<?=@$data['produksi_log_gudang']?>');
  $('#proses').val('<?=@$data['produksi_proses']?>');
  $('#pelanggan').val('<?=@$data['produksi_pelanggan']?>').change();
 
  if ('<?=@$data['produksi_log_pekerja']?>' != '') { 
    $('#pekerja').val(<?=@$data['produksi_log_pekerja']?>).change();  
  } 
  
  if ('<?=@$data['produksi_lampiran_1']?>' != '') {
    $('#previewImg1').attr('src', '<?=base_url('assets/gambar/produksi/'.@$data['produksi_lampiran_1'])?>');
  }

  if ('<?=@$data['produksi_lampiran_2']?>' != '') { 
    $('#previewImg2').attr('src', '<?=base_url('assets/gambar/produksi/'.@$data['produksi_lampiran_2'])?>');
  }
 
  //cek SO
  if ('<?=$this->uri->segment(2)?>' == 'proses_so') {

    var url = "<?=base_url('produksi/get_produksi/'.@$data['produksi_nomor'].'/0')?>";
  }else{

    var url = "<?=base_url('produksi/get_produksi/'.@$data['produksi_nomor'].'/1/'.@$data['produksi_log_id'])?>";
  }

  $.ajax({
      url: url,
      type: 'GET',
      dataType: 'json', 
      success: function(json) {

        //clone
        for (var num = 1; num <= json.length - 1; num++) {
         
          //paste
          clone(1);
          
          //blank new input
          $('#copy1').find('select').val('');
          $('#copy1').find('.panjang').val(0);

        }

        $.each(json, function(index, val) {
          
          var i = index+1;
          var konversi = val.produksi_produksi_konversi;

          //spandex or hollow
          if (konversi != 0) {
            $('#copy1:nth-child('+i+') > td:nth-child(4) > input').removeAttr('readonly');
            $('#copy1:nth-child('+i+') > td:nth-child(5) > input').attr('readonly', true);
          }

          //insert value
          $('#copy1:nth-child('+i+') > td:nth-child(1) > input').val(val.produksi_produksi_id);
          $('#copy1:nth-child('+i+') > td:nth-child(2) > select').val(val.produksi_produksi_produk); 
          $('#copy1:nth-child('+i+') > td:nth-child(3) > input').val(konversi);
          $('#copy1:nth-child('+i+') > td:nth-child(4) > input').val(val.produksi_produksi_batang);
          $('#copy1:nth-child('+i+') > td:nth-child(5) > input').val(val.produksi_produksi_panjang);
          $('#copy1:nth-child('+i+') > td:nth-child(6) > input').val(val.produksi_produksi_qty);
          $('#copy1:nth-child('+i+') > td:nth-child(7) > input').val(val.produksi_produksi_panjang_total);

        });

      }

    });

    //get bahan baku

    //cek SO
    if ('<?=$this->uri->segment(2)?>' == 'proses_so') {

      var url_1 = "<?=base_url('produksi/get_bahan_baku/'.@$data['produksi_nomor'].'/0')?>";
    }else{

      var url_1 = "<?=base_url('produksi/get_bahan_baku/'.@$data['produksi_nomor'].'/1/'.@$data['produksi_log_id'])?>";
    }

    $.ajax({
      url: url_1,
      type: 'GET',
      dataType: 'json', 
      success: function(json) {

        //clone
        for (var num = 1; num <= json.length - 1; num++) {
         
          //paste
          clone(2);
          
          //blank new input
          $('#copy2').find('select').val('');
          $('#copy2').find('.qty').val(0);

        }

        $.each(json, function(index, val) {
          
          var i = index+1;

          //insert value
          $('#copy2:nth-child('+i+') > td:nth-child(1) > input').val(val.produksi_barang_id); 
          $('#copy2:nth-child('+i+') > td:nth-child(2) > select').val(val.produksi_barang_barang).change(); 
          $('#copy2:nth-child('+i+') > td:nth-child(4) > input').val(val.bahan_kategori); 
          $('#copy2:nth-child('+i+') > td:nth-child(5) > input').val(val.produksi_barang_harga); 
          $('#copy2:nth-child('+i+') > td:nth-child(6) > input').val(val.produksi_barang_stok); 
          $('#copy2:nth-child('+i+') > td:nth-child(7) > input').val(val.produksi_barang_berat);  
          $('#copy2:nth-child('+i+') > td:nth-child(8) > input').val(val.produksi_barang_panjang);
          $('#copy2:nth-child('+i+') > td:nth-child(9) > input').val(val.produksi_barang_status);
          $('#copy2:nth-child('+i+') > td:nth-child(10) > input').val(val.produksi_barang_total);

          //jasa
          $('#jasa').val('<?=@$data['produksi_jasa']?>');


          //select kode
          function auto() { 

            $('#copy2:nth-child('+i+') > td:nth-child(3) > select').val(val.produksi_barang_kode); 

            setTimeout(function() {
                auto();
            }, 100);
          }

          auto(); 

        });

      }

    });

</script>
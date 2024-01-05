<script>

  //atribut form
  $('#nomor').val('<?=@$data['penjualan_nomor']?>');
  $('#tanggal').val('<?=@$data['penjualan_tanggal']?>');
  $('#pelanggan').val('<?=@$data['penjualan_pelanggan']?>').change();
  $('#jatuh_tempo').val('<?=@$data['penjualan_jatuh_tempo']?>');
  $('#pembayaran').val('<?=@$data['penjualan_pembayaran']?>').change();
  $('#status').val('<?=@$data['penjualan_status']?>').change();
  $('#keterangan').val('<?=@$data['penjualan_keterangan']?>');
  $('#gudang').val('<?=@$data['penjualan_gudang']?>');
  $('#ambil').val('<?=@$data['penjualan_ambil']?>').change();

  if ('<?=@$data['penjualan_lampiran']?>' != '') { 
    $('#previewImg').attr('src', '<?=base_url('assets/gambar/penjualan/'.@$data['penjualan_lampiran'])?>');
  }

  //get penjualan
  $.get('<?=base_url('penjualan/get_penjualan/'.$data['penjualan_nomor'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
      
      //paste 
      clone();

      //blank new input
      $('#copy').find('select').val('');
      $('#copy').find('.panjang').val(0);
      $('#copy').find('.stok').val(0);
      $('#copy').find('.harga').val(0);
      $('#copy').find('.total').val(0);
    
    }

    $.each(json, function(index, val) {
      
      var i = index+1; 

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.penjualan_barang_barang);
      $('#copy:nth-child('+i+') > td:nth-child(2) > input').val(val.penjualan_barang_stok); 
      $('#copy:nth-child('+i+') > td:nth-child(3) > input').val(val.penjualan_barang_panjang); 
      $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(val.penjualan_barang_harga); 

      //ppn 0
      if (<?=@$data['penjualan_ppn']?> == 0) {
        $('.check').removeAttr('checked').change();
      }

      function edit(){

          $('#copy:nth-child('+i+') > td:nth-child(4) > div > input').val(val.penjualan_barang_harga);

          setTimeout(function() {
              edit();
          }, 100);
      }

      edit();

    });

  });

</script>
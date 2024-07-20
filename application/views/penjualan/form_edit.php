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
  $.ajax({
      url: "<?=base_url('penjualan/get_penjualan/'.$data['penjualan_nomor'])?>",
      type: 'GET',
      dataType: 'json', 
      success: function(json) {

          //clone
        for (var num = 1; num <= json.length - 1; num++) {
          
          //paste 
          clone();

          //blank new input
          $('#copy').find('select').val('');
          $('#copy').find('.panjang').val(0);
          $('#copy').find('.batang').val(0);
          $('#copy').find('.stok').val(0);
          $('#copy').find('.harga').val(0);
          $('#copy').find('.total').val(0);
        
        }

        $.each(json, function(index, val) {
          
          var i = index+1; 
          var gudang = $('#gudang').val();
          var konversi = val.penjualan_barang_konversi;
          var barang = val.penjualan_barang_barang;

          //spandex or hollow
          if (konversi != 0) {
            $('#copy:nth-child('+i+') > td:nth-child(4) > input').removeAttr('readonly');
            $('#copy:nth-child('+i+') > td:nth-child(5) > input').attr('readonly', true);
          }

          //cek so atau tidak
          if ('<?=$this->uri->segment(2)?>' == 'so_proses') {

            $('#so_proses').val(1);
            
            $.get('<?=base_url('penjualan/get_produk/')?>'+barang+'/'+gudang, function(response) {

              var data = $.parseJSON(response);
              $('#copy:nth-child('+i+') > td:nth-child(2) > input').val(data['produk_gudang_panjang'].replaceAll('.00', ''));

            });
          
          }else{
            $('#so_proses').val(0);

            $('#copy:nth-child('+i+') > td:nth-child(2) > input').val(val.penjualan_barang_stok.replaceAll('.00', ''));
          }
          
          $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(barang);
          $('#copy:nth-child('+i+') > td:nth-child(3) > input').val(konversi);
          $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(val.penjualan_barang_batang);  
          $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(val.penjualan_barang_panjang); 
          
          $('#copy:nth-child('+i+') > td:nth-child(6) > input').val(val.penjualan_barang_qty); 
          $('#copy:nth-child('+i+') > td:nth-child(7) > input').val(val.penjualan_barang_panjang_total);
          $('#copy:nth-child('+i+') > td:nth-child(8) > input').val(val.penjualan_barang_harga);          

          //ppn 0
          if (<?=@$data['penjualan_ppn']?> == 0) {
            $('.check').removeAttr('checked').change();
          }

        });

      }
  });

</script>
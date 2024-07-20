<script>

  //atribut form
  $('#nomor').val('<?=@$data['pembelian_nomor']?>'); 
  $('#tanggal').val('<?=@$data['pembelian_tanggal']?>');
  $('#pembayaran').val('<?=@$data['pembelian_pembayaran']?>').change();
  $('#supplier').val('<?=@$data['pembelian_supplier']?>').change(); 
  $('#gudang').val('<?=@$data['pembelian_gudang']?>').change();
  $('#jatuh_tempo').val('<?=@$data['pembelian_jatuh_tempo']?>'); 
  $('#status').val('<?=@$data['pembelian_status']?>').change();
  $('#keterangan').val('<?=@$data['pembelian_keterangan']?>');
  $('#ekspedisi').val('<?=@$data['pembelian_ekspedisi']?>').change(); 
  $('#ekspedisi_total').val(number_format('<?=@$data['pembelian_ekspedisi_total']?>'));

  if ('<?=@$data['pembelian_lampiran']?>' != '') {
    $('#previewImg').attr('src', '<?=base_url('assets/gambar/pembelian/'.@$data['pembelian_lampiran'])?>');
  } 
 
  //get pembelian
  $.ajax({

      <?php if ($this->uri->segment(2) == 'po_view'): ?>

        //menu po
         url: "<?=base_url('pembelian/get_pembelian/'.$data['pembelian_nomor'])?>",

      <?php else:?>

         url: "<?=base_url('pembelian/get_pembelian/'.$data['pembelian_nomor'].'/'.$data['pembelian_terima_id'])?>",

      <?php endif ?>
    
      type: 'GET',
      dataType: 'json', 
      success: function(json) {
 
        //clone
        for (var num = 1; num <= json.length - 1; num++) {
          
          //paste 
          clone();

          //blank new input
          $('#copy').find('select').val('');
          $('#copy').find('.berat').val(0);
          $('#copy').find('.panjang').val(1);
          $('#copy').find('.harga').val(0);
          $('#copy').find('.total').val(0);
          $('#copy').find('.satuan').html('');
        
        }

        $.each(json, function(index, val) {
          
          var i = index+1;

          //insert value
          $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.pembelian_barang_barang);
          $('#copy:nth-child('+i+') > td:nth-child(2) > input').val(val.pembelian_barang_kode);
          $('#copy:nth-child('+i+') > td:nth-child(3) > input').val(val.pembelian_barang_berat);
          $('#copy:nth-child('+i+') > td:nth-child(4) > input').val(val.pembelian_barang_panjang);
          $('#copy:nth-child('+i+') > td:nth-child(5) > input').val(number_format(val.pembelian_barang_harga));
          $('#copy:nth-child('+i+') > td:nth-child(8) > input').val(val.pembelian_barang_id);

          //ppn 0
          if (<?=@$data['pembelian_ppn']?> == 0) {
            $('.check').removeAttr('checked').change();
          }

        });

      }

    });

</script>
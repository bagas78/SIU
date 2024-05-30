<script>

  //atribut form
  $('#id').val('<?=@$data['pembelian_id']?>');
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
      url: "<?=base_url('partial/get_pembelian/'.$data['pembelian_nomor'])?>",
      type: 'GET',
      dataType: 'json', 
      success: function(json) {
 
        //clone
        for (var num = 1; num <= json.length - 1; num++) {
          
          //paste 
          clone();
        
        }

        $.each(json, function(index, val) {
          
          var i = index+1;

          //insert value
          $('#copy:nth-child('+i+') > td:nth-child(1) > .id').val(val.pembelian_barang_id);
          $('#copy:nth-child('+i+') > td:nth-child(1) > .barang').val(val.pembelian_barang_barang);
          $('#copy:nth-child('+i+') > td:nth-child(1) > .text-barang').text(val.bahan_nama);
          $('#copy:nth-child('+i+') > td:nth-child(1) > .text-berat').text('Berat : '+val.berat+' kg');
          $('#copy:nth-child('+i+') > td:nth-child(1) > .text-panjang').text('Panjang : '+val.panjang+' m');


        });

      }

    });

</script>
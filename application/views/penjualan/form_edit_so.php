<script>

  //atribut form
  $('#nomor').val('<?=@$data['produksi_nomor']?>');
  $('#pelanggan').val('<?=@$data['produksi_pelanggan']?>').change();
  $('#gudang').val('<?=@$data['produksi_gudang']?>');
  
  //get penjualan
  $.get('<?=base_url('penjualan/get_produksi/'.$data['produksi_nomor'])?>', function(data) {
    var json = JSON.parse(data);

    //clone
    for (var num = 1; num <= json.length - 1; num++) {
      
      //paste 
      clone();

      //blank new input
      $('#copy').find('select').val('');
      $('#copy').find('.panjang').val(0);
    
    }

    $.each(json, function(index, val) {
      
      var i = index+1; 

      //insert value
      $('#copy:nth-child('+i+') > td:nth-child(1) > select').val(val.produksi_produksi_produk).change();
      $('#copy:nth-child('+i+') > td:nth-child(3) > input').val(val.produksi_produksi_panjang);

    });

  });

</script>
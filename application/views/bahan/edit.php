<script type="text/javascript">
  $('form').attr('action', '<?=base_url('bahan/update/'.@$data['bahan_id'])?>');
  $('#kode').val('<?=@$data['bahan_kode']?>');
  $('#nama').val('<?=@$data['bahan_nama']?>');
  $('#satuan').val('<?=@$data['satuan_id']?>');
  $('#kategori').val('<?=@$data['bahan_kategori']?>').change();
  $('#harga').val('<?=@$data['bahan_harga']?>');
</script>
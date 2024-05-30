<script type="text/javascript">
	$('form').attr('action', '<?=base_url('produk/update/'.@$data['produk_id'])?>');;
	$('#kode').val('<?=@$data['produk_kode']?>');
	$('#nama').val('<?=@$data['produk_nama']?>');
	$('#merk').val('<?=@$data['produk_merk']?>');
	$('#konversi').val('<?=@$data['produk_konversi']?>');
	$('#ketebalan').val('<?=@$data['produk_ketebalan']?>');
	$('#keterangan').val('<?=@$data['produk_keterangan']?>');
	$('#colly').val('<?=@$data['produk_colly']?>');
</script>
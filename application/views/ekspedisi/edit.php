<script type="text/javascript">
	$('form').attr('action', '<?=base_url('ekspedisi/update/'.@$data['ekspedisi_id'])?>');
	$('#kode').val('<?=@$data['ekspedisi_kode']?>').attr('readonly', true);
	$('#nama').val('<?=@$data['ekspedisi_nama']?>');
	$('#keterangan').val('<?=@$data['ekspedisi_keterangan']?>');
</script>
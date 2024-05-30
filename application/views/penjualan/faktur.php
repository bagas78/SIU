<?php $set = $this->query_builder->view_row("SELECT * FROM t_logo"); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?= strtoupper(@$title) ?> | <?=@$set['logo_nama'] ?></title> 

	<!-- Bootstrap 3.3.7 -->   
  	<link rel="stylesheet" href="<?php echo base_url() ?>adminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css"> 

  	<!-- jQuery 3 -->
  	<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery/dist/jquery.min.js"></script>

  	<!--number format-->
  	<script src="<?php echo base_url() ?>assets/js/number_format.js"></script>

  	<style type="text/css">
  		.box{
  			padding: 0.5%; 
  		}
  		.tit{  
  			border-width: 2px;
		    border-style: solid;
		    padding: 0.5%;
		    font-weight: bold;
		    font-size: large;
  		}
  		table {
			max-width: 100%;
			max-height: 100%;
		}
		table .r {
		  text-align: right;
		}
		p {
			margin: 0;
		}
		.table > tfoot {
			vertical-align: bottom;
			border-top: 2px solid #ddd;
		}
  	</style>

</head>
<body>

	<div class="box">

		<div class="col-md-4 col-xs-4">
			<h5><?=strtoupper($set['logo_nama'])?></h5>
			<p><?=strtoupper($set['logo_alamat'])?></p>
			<p>Telp : <?=$set['logo_telp']?></p>
			<p>Tanggal : <?=date_format(date_create(@$data[0]['penjualan_tanggal']), 'd M Y')?></p>
			<p><?=@$data[0]['user_name']?></p>
			<p>Jatuh Tempo : <?php if ($data[0]['penjualan_jatuh_tempo'] != '0000-00-00') { @$d = date_create($data[0]['penjualan_jatuh_tempo']); echo date_format($d, 'd M Y'); } else { echo '-'; } ?></p>
		</div>

		<div class="col-md-4 col-xs-4 text-center">
			<h5><u>NOTA PENJUALAN</u></h5>
			<p>Nomor : <?=@$data[0]['penjualan_nomor']?></p>
		</div>

		<div class="col-md-4 col-xs-4">
			<h5>Kepada:</h5>
			<p><?=@$data[0]['kontak_nama']?></p>
			<p><?=@$data[0]['kontak_alamat']?>, Telp : <?=@$data[0]['kontak_tlp']?></p>
		</div>	

		
		<table class="table table-responsive table-borderless">
			<thead>
				<tr>
					<th width="70">No</th>
					<th>Produk</th>
					<th class="r">Panjang</th>
					<th class="r">Qty</th>
					<th class="r">Harga</th>
					<th class="r">Total</th>
				</tr>
			</thead>
			<tbody>	
				<?php $i = 1; ?>
				<?php foreach (@$data as $val): ?>

					<?php
						$qty2 = @$val['penjualan_barang_batang'] + @$val['penjualan_barang_qty'];
					?>

					<tr>
						<td><?=$i?></td>
						<td><?=@$val['produk_nama']?></td>

						<td class="r">
						<?php echo (@$val['penjualan_barang_batang'] == 0) ? $val['penjualan_barang_panjang'] . " Mtr" : '0'; ?>
						</td>
	
						<td class="r"><?=@$qty2 ?></td>
						<td class="r">Rp. <span class="harga"><?=number_format(str_replace(',', '', @$val['penjualan_barang_harga']))?></span></td>
						<td class="r">Rp. <span class="subtotal"><?=number_format(str_replace(',', '', @$val['penjualan_barang_total']))?></span></td>
					</tr>
				
				<?php $i++ ?>
				<?php endforeach ?>				

			</tbody>
			<tfoot>
				<tr>
					<td colspan="4" style="border-top: 0;">Keterangan : <?=@$data[0]['penjualan_keterangan']?></td>
					<td class="r" style="border-top: 0;">Grand Total</td>
					<td class="r" style="border-top: 0;">Rp. <span id="total_akhir"></span></td>
				</tr>
				<tr>
					<td colspan="2" style="border-top: 0;"><center>Penerima</center></td>
					<td colspan="2" style="border-top: 0;"><center><?=strtoupper($set['logo_nama'])?></center></td>
					<td class="r" style="border-top: 0;">Produk Total</td>
					<td class="r" style="border-top: 0;">Rp. <span id="produk_total">0</span></td>
				</tr>
				<tr>
					<td colspan="2" style="border-top: 0;"><center>_____________</center></td>
					<td colspan="2" style="border-top: 0;"><center>_____________</center></td>
					<td class="r" style="border-top: 0;">PPN <?=@$data[0]['penjualan_ppn']?>%</td>
					<td class="r" style="border-top: 0;">Rp. <span id="ppn"></span></td>
				</tr>
				
			</tfoot>
		</table>
	</div>

</body>
</html>

<script type="text/javascript">
	
	var total = 0;
	var sum = 0;
	$.each($('.subtotal'), function() {
		 
		 total += Number($(this).text().replace(/,/g, ''));
		 sum += Number($(this).closest('tr').find('.qty').text().replace(/,/g, '')) * Number($(this).closest('tr').find('.harga').text().replace(/,/g, ''));
		 
	});


	//ppn
	var ppn = (<?=@$data[0]['penjualan_ppn']?>) * total / 100;
	
	//total akhir
	var akhir = number_format(total);
	
	//hasil
	$('#produk_total').text(number_format(total - ppn));
	$('#ppn').text(number_format(ppn));
	$('#total_akhir').text(akhir);

	
	// print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>
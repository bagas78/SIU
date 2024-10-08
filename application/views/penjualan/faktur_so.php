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
  			padding: 3%; 
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
  	</style>

</head>
<body>

	<div class="box">

		<div class="col-md-6 col-xs-6">
			<h5><?=strtoupper($set['logo_nama'])?></h5>
			<p><?=strtoupper($set['logo_alamat'])?></p>
			<p>Telp : <?=$set['logo_telp']?></p>
		</div>

		<div class="col-md-6 col-xs-6" style="text-align: right;">
			<p><?=@$data[0]['penjualan_nomor']?></p>
			<p><?=date_format(date_create(@$data[0]['penjualan_tanggal']), 'd M Y')?></p>
			<p><?=@$data[0]['user_name']?></p>
		</div>	

		<div class="col-md-12 col-xs-12" align="center">
			<span class="tit">SALES ORDER</span>
			<br/><br/>
		</div>	

		<table class="table table-borderless">
			<tr>
				<td style="border-top: 0;">Nama Customer : <?=@$data[0]['kontak_nama']?></td>
			</tr>
			<tr>
				<td style="border-top: 0;"><?=@$data[0]['kontak_alamat']?>, Telp : <?=@$data[0]['kontak_tlp']?></td>
			</tr>
		</table>	
		
		<table class="table table-responsive table-borderless">
			<thead>
				<tr>
					<th width="70">No</th>
					<th>Produk</th>
					<th>Batang</th>
					<th class="r">Panjang</th>
					<th class="r">Qty</th>
					<th class="r">Harga</th>
					<th class="r">Total</th>
				</tr>
			</thead>
			<tbody>	
				<?php $i = 1; ?>
				<?php foreach (@$data as $val): ?>

					<tr>
						<td><?=$i?></td>
						<td><?=@$val['produk_nama']?></td>
						<td class="r"><?=number_format(@$val['penjualan_barang_batang'])?></td>
						<td class="r"><?=number_format(@$val['penjualan_barang_panjang_total'])?></td>
						<td class="r"><?=@$val['penjualan_barang_qty']?></td>
						<td class="r">Rp. <span class="harga"><?=number_format(str_replace(',', '', @$val['penjualan_barang_harga']))?></span></td>
						<td class="r">Rp. <span class="subtotal"><?=number_format(str_replace(',', '', @$val['penjualan_barang_total']))?></span></td>
					</tr>
				
				<?php $i++ ?>
				<?php endforeach ?>

				<tr>
					<td colspan="5" style="border-top: 0;"></td>
					<td class="r" style="border-top: 0;">Produk Total</td>
					<td class="r" style="border-top: 0;">Rp. <span id="produk_total">0</span></td>
				</tr>
				<tr>
					<td colspan="5" style="border-top: 0;">Jatuh Tempo : <?php if ($data[0]['penjualan_jatuh_tempo'] != '0000-00-00') { @$d = date_create($data[0]['penjualan_jatuh_tempo']); echo date_format($d, 'd M Y'); } else { echo '-'; } ?></td>
					<td class="r" style="border-top: 0;">PPN <?=@$data[0]['penjualan_ppn']?>%</td>
					<td class="r" style="border-top: 0;">Rp. <span id="ppn"></span></td>
				</tr>
				<tr>
					<td colspan="5" style="border-top: 0;">Keterangan : <?=@$data[0]['penjualan_keterangan']?></td>
					<td class="r" style="border-top: 0;">Grand Total</td>
					<td class="r" style="border-top: 0;">Rp. <span id="total_akhir"></span></td>
				</tr>

			</tbody>
		</table>

		<div class="clearfix"></div>

		<div class="col-md-4 col-xs-4">
			<center style="float: left;">
			<p>Penerima</p>
			<br/><br/><br/>
			<p>( ___________________  )</p>
			</center>
		</div>

		<div class="col-md-4 col-xs-4">
			<center>
			<p><?=strtoupper($set['logo_nama'])?></p>
			<br/><br/><br/>
			<p>( ___________________  )</p>
			</center>
		</div>

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
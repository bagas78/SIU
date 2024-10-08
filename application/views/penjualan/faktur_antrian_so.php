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
			<span class="tit">ANTREAN PRODUKSI (SO)</span>
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
					<th class="r">Panjang</th>
					<th class="r">Qty</th>
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
						<td class="r"><?=@$val['penjualan_barang_panjang']?></td>
						<td class="r"><?=@$qty2 ?></td>
						
					</tr>
				
				<?php $i++ ?>
				<?php endforeach ?>

			

			</tbody>
		</table>

		<div class="clearfix"></div>

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
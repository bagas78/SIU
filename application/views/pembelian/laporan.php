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

		<div class="row">

			<div class="col-md-6 col-xs-6">
				<h5><?=strtoupper($set['logo_nama'])?></h5>
				<p><?=strtoupper($set['logo_alamat'])?></p>
				<p>Telp : <?=$set['logo_telp']?></p>
			</div>

			<div class="col-md-6 col-xs-6" align="right">
				<p><?=@$data[0]['pembelian_nomor']?></p>
				<p><?= date_format(date_create(@$data[0]['pembelian_tanggal']), 'd-M-Y') ?></p>
				<p><?=@$data[0]['user_name']?></p>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-12" align="center">
				<span class="tit">NOTA PEMBELIAN</span>
			</div>

			<div class="clearfix"></div>
		
			<div class="col-md-12" style="margin-bottom: 3%;">
				
				<table> 
					<tr>
						<td style="padding-bottom: 4%;">Nama &nbsp;&nbsp;&nbsp;</td>
						<td style="padding-bottom: 4%;" colspan="4">: <?=@$data[0]['kontak_nama'].' ( '.@$data[0]['kontak_tlp'].' )'?></td>
					<tr>
						<td style="padding-bottom: 4%;">Alamat &nbsp;&nbsp;&nbsp;</td>
						<td style="padding-bottom: 4%;" colspan="4">: <?=@$data[0]['kontak_alamat']?></td>
					</tr>
				</table>

			</div>

			<div class="col-md-12">
			
				<table class="table table-responsive table-borderless">
					<thead>
						<tr>
							<th width="70">No</th>
							<th>Produk</th>
							<th class="r">Berat</th>
							<th class="r">Panjang</th>
							<th class="r">Berat / Meter</th>
							<th class="r">Harga</th>
							<th class="r">Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($data as $val): ?>

							<tr>
								<td><?=$i?></td>
								<td><?=@$val['bahan_nama']?></td>
								<td class="r"><span class="number berat"><?=@$val['pembelian_barang_berat']?></span> Kg</td>
								<td class="r"><span class="number"><?=@$val['pembelian_barang_panjang']?></span> Mtr</td>
								<td class="r"><span class="number"><?=round(@$val['pembelian_barang_berat'] / @$val['pembelian_barang_panjang'], 3)?></span> Kg</td>
								<td class="r">
									Rp. <span class="number"><?=@$val['pembelian_barang_harga']?><span class="number">
								</td>
								<td class="r">
									Rp. <span class="total number"><?=@$val['pembelian_barang_total']?><span class="number">
								</td>
							</tr>
						
						<?php $i++ ?>
						<?php endforeach ?>

						<!-- <tr>
							<td colspan="5"></td>
							<td class="r">Berat Total</td>
							<td class="r" ><span class="number" id="berat_total"></span> Kg</td>
						</tr> -->
						<tr>
							<td colspan="5"></td>
							<td class="r">Produk Total</td>
							<td class="r" >Rp. <span class="number" id="produk_total"></span></td>
						</tr>
						<tr>
							<td style="border-top: 0;" colspan="5"></td>
							<td style="border-top: 0;" class="r">PPN <?=@$data[0]['pembelian_ppn']. '%'?></td>
							<td style="border-top: 0;" class="r">Rp. <span class="number" id="ppn"></span></td>
						</tr>
						<tr>
							<td style="border-top: 0;" colspan="5">Jatuh Tempo : <?php @$d = date_create($data[0]['pembelian_jatuh_tempo']); echo date_format($d, 'd M Y') ?></td>
							<td style="border-top: 0;" class="r">Ekspedisi</td>
							<td style="border-top: 0;" class="r">Rp. <span class="number" id="ekspedisi"><?=@$data[0]['pembelian_ekspedisi_total']?></span></td>
						</tr>
						<tr>
							<td style="border-top: 0;" colspan="5">Keterangan : <?=@$data[0]['pembelian_keterangan']?></td>
							<td class="r" style="border-top: 0;"><b>Grand Total</b></td>
							<td class="r" style="border-top: 0;"><b>Rp. <span class="number" id="total_akhir"></span></b></td>
						</tr>
						

					</tbody>
				</table>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-4 col-xs-4">
				<center style="float: left;">
				<p>Penerima</p>
				<br/><br/>
				<p>( ___________________  )</p>
				</center>
			</div>

			<div class="col-md-4 col-xs-4">
				<center>
				<p>PT. Alumunium</p>
				<br/><br/>
				<p>( ___________________  )</p>
				</center>
			</div>

		</div>

	</div>

</body>
</html>

<script type="text/javascript">
	
	var total = $('.total');
	var num = 0;
	$.each(total, function(index, val) {
		 
		 num += Number($(this).text().replaceAll(',', ''));
		 
	});

	var ekspedisi = Number($('#ekspedisi').text().replaceAll(',', ''));
	var ppn = ('<?=@$data[0]['pembelian_ppn']?>') * num / 100;
	var grandtotal = num + ekspedisi;

	//hasil
	$('#produk_total').text(number_format((grandtotal - ppn).toFixed(3).replaceAll('.000', '')));
	$('#ppn').text(ppn);
	$('#total_akhir').text(number_format(grandtotal.toFixed(3).replaceAll('.000', '')));

	//berat total
	var sum_berat = 0;
	$.each($('.berat'), function() {
		 sum_berat += Number($(this).text().replaceAll(',', ''));
	});

	$('#berat_total').text(sum_berat);

	//number format
	$.each($('.number'), function() {
		 
		 var val = Number($(this).text().replaceAll(',', ''));
		 $(this).text(number_format(val));
	});
	
	//print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>
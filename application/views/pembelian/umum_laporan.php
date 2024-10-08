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
				<p><?=@$data[0]['pembelian_umum_nomor']?></p>
				<p><?= date_format(date_create(@$data[0]['pembelian_umum_tanggal']), 'd-M-Y') ?></p>
				<p><?=@$data[0]['user_name']?></p>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-12" align="center">
				<span class="tit">PEMBELIAN UMUM</span>
			</div>

			<div class="clearfix"></div><br/><br/>

			<div class="col-md-12">
			
				<table class="table table-responsive table-borderless">
					<thead>
						<tr>
							<th width="70">No</th>
							<th>Produk</th>
							<th class="r">Qty</th>
							<th class="r">Potongan</th>
							<th class="r">Harga</th>
							<th class="r">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($data as $val): ?>

							<tr>
								<td><?=$i?></td>
								<td><?=@$val['pembelian_umum_barang_barang']?></td>
								<td class="r"><?=@$val['pembelian_umum_barang_qty'].' '.@$val['satuan_singkatan']?></td>
								<td class="r"><?=@$val['pembelian_umum_barang_potongan'].' '.@$val['satuan_singkatan']?></td>
								<td class="r"><?=number_format(@$val['pembelian_umum_barang_harga'])?></td>
								<td class="subtotal r"><?=number_format(@$val['pembelian_umum_total'])?></td>
							</tr>
						
						<?php $i++ ?>
						<?php endforeach ?>

						<tr>
							<td colspan="4"></td>
							<td class="r">PPN</td>
							<td class="r" id="ppn"><?=@$data[0]['pembelian_umum_ppn']. '%'?></td>
						</tr>
						<tr>
							<td style="border-top: 0;" colspan="4">Jatuh Tempo : <?php @$d = date_create($data[0]['pembelian_umum_jatuh_tempo']); echo date_format($d, 'd M Y') ?></td>
							<td class="r" style="border-top: 0;"><b>Total</b></td>
							<td class="r" style="border-top: 0;"><b id="total_akhir"></b></td>
						</tr>
						<tr>
							<td style="border-top: 0;" colspan="6">Keterangan : <?=@$data[0]['pembelian_umum_keterangan']?></td>
						</tr>

					</tbody>
				</table>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-4 col-xs-4">
				<center style="float: left;">
				<p>Penerima</p>
				<br/><br/><br/>
				<p>( ___________________  )</p>
				</center>
			</div>

			<div class="col-md-4 col-xs-4">
				<center>
				<p>PT. Alumunium</p>
				<br/><br/><br/>
				<p>( ___________________  )</p>
				</center>
			</div>

		</div>

	</div>

</body>
</html>

<script type="text/javascript">
	
	var subtotal = $('.subtotal');
	var num = 0;
	$.each(subtotal, function(index, val) {
		 
		 num += parseInt($(this).text().replace(/,/g, ''));
		 
	});

	var ppn = (<?=@$data[0]['pembelian_umum_ppn']?>) * num / 100;
	var total = ppn + num;

	$('#total_akhir').text(number_format(total));

	
	//print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>
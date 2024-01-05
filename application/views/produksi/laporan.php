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
		    font-size: x-large;
  		}
  		table .r {
		  text-align: right;
		} 
  	</style>

</head>
<body>

	<div class="box">

		<div class="row">

			<div class="col-md-12" align="center">
				<span class="tit">LAPORAN PRODUKSI <?=strtoupper(@$bahan_data[0]['gudang_nama'])?></span>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-12" align="center">
				<span style="font-size: x-large;">Tanggal : <?php $d = date_create($produk_data[0]['produksi_tanggal']); echo date_format($d, 'd/m/Y'); ?></span>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-12">
			
				<table class="table table-responsive table-bordered">
					<thead>
						<tr>
							<th width="70">No</th>
							<th>Nama Produk</th>
							<th class="r">Panjang</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 1; ?>
						<?php foreach ($produk_data as $val): ?>

							<tr>
								<td><?=$i?></td>
								<td><?=@$val['produk_nama']?></td>
								<td class="r"><span class="number produksi_panjang"><?=@$val['produksi_produksi_panjang']?></span> Mtr</td>
							</tr>
						
						<?php $i++ ?>
						<?php endforeach ?>

					</tbody>
				</table>
			</div>

			<div class="col-md-12 col-xs-12">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>Nama Bahan</th>
							<th class="r">Panjang</th>
							<th class="r">Berat</th>
							<th class="r">Hpp</th>
							<th class="r">Subtotal</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($bahan_data as $v): ?>
							
							<tr>
								<td><?=@$v['bahan_nama']?></td>
								<td class="r"><span class="number panjang"><?=@$v['produksi_barang_panjang']?></span> Mtr</td>
								<td class="r"><span class="number"><?=@$v['produksi_barang_berat'] *  @$v['produksi_barang_panjang']?></span> Kg</td>
								<td class="r">Rp. <span class="number harga"><?=@$v['produksi_barang_harga']?></span></td>
								<td class="r">Rp. <span class="number subtotal"><?=@$v['produksi_barang_subtotal']?></span></td>
							</tr>

						<?php endforeach ?>
						<tr>
							<th colspan="4" class="r">Total Produksi</th>
							<td class="r">Rp. <span class="number total_produksi"></span></td>
						</tr>
						<tr>
							<th colspan="4" class="r">Biaya Jasa</th>
							<td class="r">Rp. <span class="number jasa"><?=@$bahan_data[0]['produksi_jasa']?></span></td>
						</tr>
						<tr>
							<th colspan="4" class="r">Total Akhir</th>
							<td class="r">Rp. <span class="number total_akhir"></span></td>
						</tr>
					</tbody>
				</table>
			</div>

			<div class="clearfix"></div><br/>

			<div class="col-md-6 col-xs-6">
				<?php if ($produk_data[0]['produksi_pekerja'] != 'null'): ?>
					<h4>Pekerja</h4>
					<?php $s = 1; ?>
					<?php foreach (json_decode($produk_data[0]['produksi_pekerja']) as $key => $value): ?>
						<?php $kar = $this->query_builder->view_row("SELECT * FROM t_karyawan WHERE karyawan_id = '$value'"); ?>
						<p><?=$s.'. '.$kar['karyawan_nama']?></p>
					<?php $s++; ?>
					<?php endforeach ?>
				<?php endif ?>
			</div>

			<div class="col-md-6 col-xs-6">
				<center style="float: right;">
				<p>Di Buat oleh</p>
				<br/><br/>
				<p>( ___________________  )</p>
				</center>
			</div>

		</div>

	</div>

</body>
</html>

<script type="text/javascript">

	var sum_sub = 0;
	$.each($('.subtotal'), function() {
		 
		 sum_sub += Number($(this).text());
		 
	});

	var jasa = Number($('.jasa').text());
	var total = Number(sum_sub) + jasa;

	$('.total_produksi').text(sum_sub);
	$('.total_akhir').text(total);

	//format number
	$.each($('.number'), function() {
		 
		 var val = Number($(this).text());
		 $(this).text(number_format(val));
	});
	
	//print
	window.print();
   window.onafterprint = back;

   function back() {
       window.history.back();
   }

</script>
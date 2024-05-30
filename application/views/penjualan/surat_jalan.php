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
  		body {
  			font-size: 12px;
  		}
  		.box{
  			/* padding: 3%; */
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
  	</style>

</head>
<body>

	<div class="box">

		<div class="col-md-6 col-xs-6">
			<h5>Nama Customer : <?=@$data[0]['kontak_nama']?></h5>
			<p><?=@$data[0]['kontak_alamat']?>, Telp : <?=@$data[0]['kontak_tlp']?></p>
			<p>Telp : <?=$set['logo_telp']?></p>
		</div>

		<div class="col-md-6 col-xs-6" style="text-align: right;">
			<h3><b>SURAT JALAN</b></h3>
			<p>Nomor : <?=@$data[0]['penjualan_nomor']?></p>
			<p>Tanggal : <?=date_format(date_create(@$data[0]['penjualan_tanggal']), 'd M Y')?></p>
			<p><?=@$data[0]['user_name']?></p>
			<p>Ekspedisi : <?=@$data[0]['ekspedisi_nama']?> ( <?=@$data[0]['ekspedisi_kode']?> )</p>
		</div>	
		
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

						<td class="r">
						<?php echo (@$val['penjualan_barang_batang'] == 0) ? $val['penjualan_barang_panjang'] . " Mtr" : '0'; ?>
						</td>

						<td class="r"><?=@$qty2 ?></td>
					</tr>
				
				<?php $i++ ?>
				<?php endforeach ?>
			</tbody>
		</table>

		<table class="table">
			<tr>
				<td colspan="2" style="border-top: 0;"></td>
				<td colspan="2" style="border-top: 0;"><b>Barang sudah diterima dengan baik dan dengan jumlah yang benar, Terima kasih.</b></td>

			</tr>

			<tr>
				<td width="50%" colspan="2" style="border-top: 0;">Nama Security :</td>
				<td style="border-top: 0;">Penerima:</td>
				<td style="border-top: 0;">Yang menyerahkan:</td>
			</tr>
			<tr>
				<td colspan="2" style="border-top: 0;">Nama Sopir :</td>
				<td style="border-top: 0;">Nama</td>
				<td style="border-top: 0;">Nama</td>
			</tr>
		</table>

	</div>

</body>
</html>
<script type="text/javascript">
	// print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }
</script>
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
			<p><?=@$data[0]['produksi_nomor']?></p>
			<p><?=date_format(date_create(@$data[0]['produksi_tanggal']), 'd M Y')?></p>
			<p><?=@$data[0]['user_name']?></p>
		</div>	

		<div class="col-md-12 col-xs-12" align="center">
			<span class="tit">SURAT JALAN</span>
			<br/><br/>
		</div>	

		<div class="clearfix"></div><br/>
		
		<table class="table table-responsive table-borderless">
			<thead>
				<tr>
					<th style="width: 1px;">No</th>
					<th>Nama Barang</th>
					<th class="r">QTY</th>
					<th class="r">Panjang</th>
				</tr>
			</thead>
			<tbody>
				<?php $i = 1; ?>
				<?php foreach ($data as $val): ?>

					<tr>
						<td><?=$i?></td>
						<td><?=@$val['produk_nama']?></td>
						<td class="qty r"><?=@$val['produksi_produksi_qty']?> Btg</td>
						<td class="panjang r"><?=str_replace('.00', '', @$val['produksi_produksi_panjang_total'])?> Mtr</td>
					</tr>
				
				<?php $i++ ?>
				<?php endforeach ?>

				<tr>
					<td colspan="2">Barang sudah di terima dengan baik dan jumlah yang benar</td>
					<td class="r">Total Batang</td>
					<td class="sum_qty r"></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td class="r">Total Panjang</td>
					<td class="sum_panjang r"></td>
				</tr>

			</tbody>
		</table>

		<div class="clearfix"></div>

		<div class="col-md-12 col-xs-12 row">
			<table>
				<tr>
					<td>Nama Security</td>
					<td>&#160;&#160;: </td>
				</tr>
				<tr>
					<td>Nama Sopir</td>
					<td>&#160;&#160;: </td>
				</tr>
			</table>
		</div>

		<div class="clearfix"></div><br/><br/>

		<div class="col-md-4 col-xs-4">
			<center style="float: left;">
			<p>Penerima</p>
			<br/><br/><br/>
			<p>( ___________________  )</p>
			</center>
		</div>

		<div class="col-md-4 col-xs-4">
			<center>
			<p>Yang Menyerahkan</p>
			<br/><br/><br/>
			<p>( ___________________  )</p>
			</center>
		</div>

	</div>

</body>
</html>

<script type="text/javascript">
	
	var num = 0;
	$.each($('.qty'), function() {
		 
		 num += parseInt($(this).text().replace(/,/g, ''));
		 
	});	

	$('.sum_qty').text(number_format(num)+' Btg');

	var num = 0;
	$.each($('.panjang'), function() {
		 
		 num += parseInt($(this).text().replace(/,/g, ''));
		 
	});	

	$('.sum_panjang').text(number_format(num)+' Mtr');

	
	//print
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    }

</script>
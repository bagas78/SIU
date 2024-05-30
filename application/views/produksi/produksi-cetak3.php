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
			<span class="tit">PRODUKSI</span>
			<br/><br/>
		</div>	

		<table class="table table-borderless">
			<tr>
				<td style="border-top: 0;">Mesin : <?=@$data_produksi['mesin_nama']?></td>
			</tr>
			<tr>
				<td style="border-top: 0;"></td>
			</tr>
		</table>	

    <table class="table table-responsive table-borderless">
      <thead>
        <tr>
          <th width="70">No</th>
          <th>Nama Bahan</th>
          <th class="r">Stok (Mtr)</th>
          <th class="r">Berat (Kg)</th>
          <th class="r">Panjang (Mtr)</th>
        </tr>
      </thead>
      <tbody> 
        <?php $i = 1; ?>
        <?php foreach (@$data as $val): ?>

          <tr>
            <td><?=$i?></td>
            <td><?=@$val['bahan_nama']?></td>
            <td class="r"><?=@$val['produksi_barang_stok'] ?></td>
            <td class="r"><?=@$val['produksi_barang_berat'] ?></td>
            <td class="r"><?=number_format(@$val['produksi_barang_panjang'])?></td>
          </tr>
        
        <?php $i++ ?>
        <?php endforeach ?>

      </tbody>
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
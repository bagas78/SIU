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
				<td style="border-top: 0;">Mesin : <?=@$data[0]['kontak_nama']?></td>
			</tr>
			<tr>
				<td style="border-top: 0;"></td>
			</tr>
		</table>	
		

		        <div id="form-bahan">

          <table class="">
            <thead>
              <tr>
                <th width="300">Bahan</th>
                <th width="300">Kategori</th>
                <th width="300" hidden>Hpp <span class="stn">Rp</span></th>
                <th width="300">Stok <span class="stn">Mtr</span></th>   
                <th width="300">Berat / Meter <span class="stn">Kg</span></th>           
                <th width="300">Panjang <span class="stn">Mtr</span></th>
                <th width="300" hidden>Total <span class="stn">Rp</span></th>

              </tr>
            </thead>
            <tbody id="paste2">

               <tr id="copy2">
                <td>
                  <select required id="bahan" class="bahan form-control" name="bahan[]">
                    <option value="" hidden>-- Pilih --</option>
                    <?php foreach ($bahan_data as $b): ?>
                      <option value="<?=@$b['bahan_id']?>"><?=@$b['bahan_nama']?></option>
                    <?php endforeach ?>
                  </select>
                </td>

                <td>
                  <input type="text" name="kategori[]" class="kategori form-control" required readonly>
                </td>
                <td hidden>
                  <input min="0" type="text" name="harga[]" class="harga form-control text-number" value="0" required readonly step="any">
                </td>

                <td>
                  <input min="0" type="text" name="stok[]" class="stok form-control text-number" value="0" required readonly step="any">                
                </td>

                <td>
                  <input type="text" name="berat[]" class="berat form-control text-number" required value="0" min="0" readonly step="any">
                </td>

                <td>
                  <input type="text" name="panjang[]" class="panjang form-control text-number" required value="0" min="0" step="any">
                </td>

                <td hidden>
                  <input readonly min="0" type="text" name="total[]" class="total form-control text-number" value="0" required step="any">
                </td>

              </tr>

            

            </tbody>
          </table>

          </div>


	</div>

</body>
</html>

<script type="text/javascript">
	
  //copy paste
  function clone(target){
    //paste
    $('#paste'+target).prepend($('#copy'+target).clone());
    
    //blank new input
    $('#copy'+target).find('select').val('');
    $('#copy'+target).find('.kategori').val('');
    $('#copy'+target).find('.harga').val(0);
    $('#copy'+target).find('.stok').val(0);
    $('#copy'+target).find('.total').val(0);
    $('#copy'+target).find('.panjang').val(0);
    $('#copy'+target).find('.produk_panjang').val(0);
    $('#copy'+target).find('.produk_batang').val(0);
    $('#copy'+target).find('.id').val(0);

    //produk
    $('#copy'+target).find('.qty_produk').val(0);
  }

    // added
    //get bahan baku
    $.ajax({
      url: "<?=base_url('produksi/get_bahan_baku/'.$data['produksi_nomor'])?>",
      type: 'GET',
      dataType: 'json', 
      success: function(json) {

        //clone
        for (var num = 1; num <= json.length - 1; num++) {
         
          //paste
          clone(2);
          
          //blank new input
          $('#copy2').find('select').val('');
          $('#copy2').find('.qty').val(0);

        }

        $.each(json, function(index, val) {
          
          var i = index+1;

          //insert value
          $('#copy2:nth-child('+i+') > td:nth-child(1) > select').val(val.produksi_barang_barang); 
          $('#copy2:nth-child('+i+') > td:nth-child(2) > input').val(val.bahan_kategori); 
          $('#copy2:nth-child('+i+') > td:nth-child(3) > input').val(val.produksi_barang_harga); 
          $('#copy2:nth-child('+i+') > td:nth-child(4) > input').val(val.produksi_barang_stok); 
          $('#copy2:nth-child('+i+') > td:nth-child(5) > input').val(val.produksi_barang_berat);  
          $('#copy2:nth-child('+i+') > td:nth-child(6) > input').val(val.produksi_barang_panjang);
          $('#copy2:nth-child('+i+') > td:nth-child(7) > input').val(val.produksi_barang_total);

          //jasa
          $('#jasa').val('<?=@$data['produksi_jasa']?>');

        });

      }

    });

    // print
    /*
	window.print();
    window.onafterprint = back;

    function back() {
        window.history.back();
    } */

    document.onload = function() {
	    window.focus();
	    window.print();
	    // window.close();
	};

</script>
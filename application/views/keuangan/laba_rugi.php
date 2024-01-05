<style type="text/css">
  #title{
    background: darkgray;
    padding: 1%;
    margin-bottom: 2%;
    text-align: center;
    color: white;
  }
  .p03{
    padding: 0.3%;
  }
</style>


    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <div class="form-group">
            <input id="date" type="month" class="p03" name="tggl" min="2023-01" placeholder="<?=date('Y-m')?>">
            <button class="p03 filter">Filter <i class="fa fa-search"></i></button>
          </div>

          <h4 align="center">Laba Rugi <br> ( <?=$tgl?> )</h4>

          <table class="table table-bordered table-hover" style="width: 100%;">
                <tbody>
                  <tr>
                    <td><strong>Pendapatan</strong></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <?php foreach ($data_pendapatan as $val): ?>
                    <tr>
                      <td><?=@$val['jurnal_keterangan']?></td>
                      <td class="nominalpendapatan"><?=@$val['jurnal_nominal']?></td>
                      <td></td>
                    </tr>
                  <?php endforeach ?>
                  <tr>
                    <td colspan="2" style="background: lightgrey;">Total Pendapatan</td>
                    <td class="totpendapatan" style="background: lightgrey;"></td>
                  </tr>

                  <tr>
                    <td><strong>Beban</strong></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <?php foreach ($data_beban as $val): ?>
                    <tr>
                      <td><?=@$val['jurnal_keterangan']?></td>
                      <td class="nominalbeban"><?=@$val['jurnal_nominal']?></td>
                      <td></td>
                    </tr>
                  <?php endforeach ?>
                  <tr>
                    <td colspan="2" style="background: lightgrey;">Total Beban</td>
                    <td class="totbeban" style="background: lightgrey;"></td>
                  </tr>

                  <tr>
                    <td colspan="2" style="background: moccasin;">Laba Rugi</td>
                    <td class="total" style="background: antiquewhite;"></td>
                  </tr>

                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->

  <script type="text/javascript">
    $(document).on('click', '.filter', function() {

      var date = $('#date').val();
      <?php $segmen = $this->uri->segment(3); ?>
      
      if (date == '') {
        var url = '<?=@base_url('keuangan/laba_rugi/');?><?=($segmen)? '' : $segmen?>';
      }else{
        var url = '<?=@base_url('keuangan/laba_rugi/');?><?=($segmen)? '': $segmen?>'+date;
      }
      
      window.location.replace(url);

    });

    //total
    var tot = 0;
    $.each($('.nominal'), function(index, val) {
      //format
      var t = parseInt($(this).text());
      $(this).text(number_format(t));

      //sum
      tot += t;
    });

    // hitung pendapatan
    var totP = 0;
    $.each($('.nominalpendapatan'), function(index, val) {
      //format
      var tP = parseInt($(this).text());
      $(this).text(number_format(tP));

      //sum
      totP += tP;
    });
    $('.totpendapatan').text(number_format(totP));

    // hitung beban
    var totB = 0;
    $.each($('.nominalbeban'), function(index, val) {
      //format
      var tB = parseInt($(this).text());
      $(this).text(number_format(tB));

      //sum
      totB += tB;
    });
    $('.totbeban').text(number_format(totB));

    // Laba rugi
    tot = totP - totB;
    $('.total').text(number_format(tot));


  </script>
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
            <input id="date" type="month" class="p03">
            <button class="p03 filter">Filter <i class="fa fa-search"></i></button>
          </div>

          <table class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Ref</th>
                  <th>Debit</th>
                  <th>Kredit</th>
                </tr>
                </thead>
                <tbody>
                  <?php foreach ($data as $val): ?>
                    <tr>
                      <td class="<?=@$val['jurnal_nomor']?>"><?=date_format(date_create(@$val['jurnal_tanggal']), 'd/m/Y')?></td>
                      <td><?=@$val['jurnal_keterangan']?></td>
                      <td><?=@$val['coa_nomor']?></td>
                      <td class="debit"><?=(@$val['jurnal_type'] == 'debit')? @$val['jurnal_nominal']:'-'?></td>
                      <td class="kredit"><?=(@$val['jurnal_type'] == 'kredit')? @$val['jurnal_nominal']:'-'?></td>
                    </tr>

                    <tr>
                      <td class="<?=@$val['jurnal_nomor']?>" colspan="5" style="background: silver;"></td>
                    </tr>

                  <?php endforeach ?>

                  <tr>
                    <td colspan="3" style="background: moccasin;">TOTAL</td>
                    <td class="total_debit" style="background: antiquewhite;"></td>
                    <td class="total_kredit" style="background: antiquewhite;"></td>
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
        var url = '<?=@base_url('keuangan/jurnal/');?><?=($segmen)? '' : $segmen?>';
      }else{
        var url = '<?=@base_url('keuangan/jurnal/');?><?=($segmen)? '': $segmen?>'+date;
      }
      
      window.location.replace(url);

    });

    //format number
    var format = ['.kredit','.debit'];
    var total = ['.total_kredit','.total_debit'];

    $.each(format, function(index, val) {
       
       var tot = 0;
       $.each($(val), function(index, val) {
         var t = $(this).text();
         if (t != '-') {
          //sum
          tot += parseInt(t);

          $(this).text(number_format(t));
         }
      });

      $(total[index]).text(number_format(tot));
    
    });

    //hapus tanggal
    <?php foreach ($data as $val): ?>

      $.each($('.<?=$val['jurnal_nomor']?>'), function(index, val) {
         
         if (index == 2) {
            $(this).text('');
         }

         if (index == 1) {
            $(this).attr('hidden', true);;
         }

      });
    
    <?php endforeach ?>

  </script>
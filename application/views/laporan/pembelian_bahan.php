
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

          <div class="row py-4">
            <div class="col-md-4">
              <table class="table table-bordered table-hover">
                <tr>
                  <td style="background: pink;">Total Pembelian</td>
                  <td id="tot_pembelian"></td>
                </tr>
              </table>
            </div>
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
              <div class="sx-right" align="right">
                <form action="" method="POST" class="">
                  <input name="filter" type="date" class="p03">
                  <button class="p03 filter">Filter <i class="fa fa-search"></i></button>
                </form>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>          
          
          <table id="table" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Gudang</th>
              <th>Bahan</th>
              <th>Berat ( KG )</th>
              <th>Panjang ( M )</th>
              <th>Harga ( RP )</th>
              <th>Total ( RP )</th>
              <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach (@$data as $val): ?>
                <tr>
                  <td><?=@$val['gudang'] ?></td>
                  <td><?=@$val['bahan'] ?></td>
                  <td><?=number_format(@$val['berat']) ?></td>
                  <td><?=number_format(@$val['panjang']) ?></td>
                  <td><?=number_format(@$val['harga']) ?></td>
                  <td class="total"><?=@$val['total'] ?></td>
                  <td><?php @$dt = date_create(@$val['tanggal']); echo date_format(@$dt, 'd/m/Y'); ?></td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">
//data table
var table;
$(document).ready(function() {

    //datatables
    table = $('#table').DataTable({ 

        "bPaginate": true,
        "bFilter": false,
        "scrollX": true, 
        "dom": "Bfrtip",
        "buttons": [
            "excel", "pdf", "print",
        ]
    });

});

 //pmebelian
 var p = 0;
 $.each($('.total'), function(index, val) {
    var parse = parseInt($(this).text());
    p += parse;

    $(this).text(number_format(parse));
 });

 $('#tot_pembelian').text(number_format(p));

</script>
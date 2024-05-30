
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
          <div class="row">
            <div class="col-md-4">
              <table class="table table-bordered table-hover">
                <tr>
                  <td style="background: lightgreen;">Total Produksi</td>
                  <td id="tot_produksi"></td>
                </tr>
              </table>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <div class="sx-right" align="right">
                <form action="" method="POST" class="">
                  <input name="filter" type="date" class="p03">
                  <button class="p03 filter">Filter <i class="fa fa-search"></i></button>
                </form>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="clearfix my-4"></div>
          </div>
          
          <table id="table" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Gudang</th>
              <th>Shift</th>
              <th>Produksi</th>
              <th>Panjang ( M )</th>
              <th>Tanggal</th>
            </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $val): ?>
                <tr>
                  <td><?=$val['gudang'] ?></td>
                  <td><?=$val['shift'] ?></td>
                  <td><?=$val['produk'] ?></td>
                  <td class="produksi_qty"><?=$val['jumlah'] ?></td>
                  <td><?php $dt = date_create($val['tanggal']); echo date_format($dt, 'd/m/Y'); ?></td>
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

        "searching" : false,
        "bPaginate": false,
        "bFilter": false,
        "scrollX": true, 
        "dom": "Bfrtip",
        "buttons": [
            "excel", "pdf", "print",
        ]
    });

});

 //produksi
 var p = 0;
 $.each($('.produksi_qty'), function(index, val) {
    var parse = Number($(this).text());
    p += parse;
 });

 $('#tot_produksi').text(number_format(p));

</script>
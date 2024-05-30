<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style type="text/css">
  .tit{
    font-size: 20px;
    background: #107687;
    width: fit-content;
    color: white;
    padding: 0.5%;
    font-weight: 800;
  }
</style>
 
<!-- Main content -->  
<section class="content"> 

  <div class="box"> 
    <div class="box-header with-border">

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">
  
      <span class="tit">Stok Bahan Baku</span>
      
      <table id="example1" class="table table-responsive table-borderless">
        <thead>
          <tr>
            <th>Gudang</th>
            <th>Bahan</th>
            <th>Berat ( KG )</th>
            <th>Panjang ( M )</th>
          </tr>
        </thead>
      </table>

      <br/><hr>

      <span class="tit">Stok Produk</span>
      
      <table id="example2" class="table table-responsive table-borderless">
        <thead>
          <tr>
            <th>Gudang</th>
            <th>Bahan</th>
            <th>Panjang ( M )</th>
          </tr>
        </thead>
      </table> 

    </div>
  </div>

  <div class="box">
    <div class="box-header with-border">

      <div class="col-md-1 col-xs-1">
        <form method="POST" action="">
          <input type="hidden" name="filter" value="1">
          <button type="submit" class="btn btn-default <?=(@$filter == 1)?'active':'' ?>">Harian <i class="fa fa-filter"></i></button>
        </form>
      </div>
      <div class="col-md-1 col-xs-1">
        <form method="POST" action="">
          <input type="hidden" name="filter" value="2">
          <button type="submit" class="btn btn-default <?=(@$filter == 2)?'active':'' ?>">Bulanan <i class="fa fa-filter"></i></button>
        </form>
      </div>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
        </button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
      </div>
    </div>
    <div class="box-body">

      <!-- <div id="chartContainer" style="height: 300px; width: 100%;"></div> -->
      <h3 align="center">Grafik Pembelian | Penjualan <b><?=($filter == 1)? date('M Y'):'Tahun '.date('Y')?></b></h3>
      <canvas id="myChart"></canvas>

    </div>
  </div>

<script type="text/javascript">
  var table1;
    $(document).ready(function() {

        //datatables
        table1 = $('#example1').DataTable({ 

            "searching"     : false,
            "bLengthChange" : false,
            "info"          : false,
            "pageLength"    : 5,
            "processing"    : true, 
            "serverSide"    : true,
            "order"         :[],
            
            "ajax": {
                "url": "<?=site_url('dashboard/get_bahan'); ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "gudang"},
                        { "data": "nama"},
                        { "data": "berat",
                        "render":
                        function(data) {
                          return "<span class='berat'>"+number_format(data)+"</span>";
                        }},
                        { "data": "panjang",
                        "render":
                        function(data) {
                          return "<span class='panjang'>"+number_format(data)+"</span>";
                        }}
                    ],
        });

    });

  var table2;
    $(document).ready(function() {

        //datatables
        table1 = $('#example2').DataTable({ 
            
            "searching"     : false,
            "bLengthChange" : false,
            "info"          : false,
            "pageLength"    : 5,
            "processing"    : true, 
            "serverSide"    : true,
            "order"         :[],
            
            "ajax": {
                "url": "<?=site_url('dashboard/get_produk') ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "gudang"},
                        { "data": "nama"},
                        { "data": "panjang",
                        "render":
                        function(data) {
                          return "<span class='panjang'>"+number_format(data)+"</span>";
                        }}
                        
                    ],
        });

    });

function auto() { 

    //replace .00
     $.each($('.berat, .panjang'), function(index, val) {
        
        var val = $(this).text();
        $(this).text(val.replaceAll('.00', ''));

     });

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto(); 

</script>

<script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
    type: 'line',
    data: {
      labels: [

      <?php if ($filter == 2): ?>
        
        //bulanan
        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'

      <?php else: ?>

        //harian
        <?php for ($i=1; $i < $hari + 1; $i++):?>

          <?php echo $i.','; ?>

        <?php endfor ?>
        
      <?php endif ?>

      ],
      datasets: [{
        label: 'Pembelian',
        data: [
                
                <?php if ($filter == 2): ?>

                  //bulanan
                  <?php for ($i=1; $i < 13; $i++):?>

                    <?php foreach ($pembelian_data as $v): ?>
                      
                      <?php if ($v['bulan'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endforeach ?>

                  <?php endfor ?>

                <?php else: ?>

                  //harian
                  <?php for ($i=1; $i < $hari + 1; $i++):?>

                    <?php foreach ($pembelian_data as $v): ?>

                      <?php if ($v['tanggal'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endforeach ?>

                  <?php endfor ?>

                <?php endif ?>

              ],
        borderWidth: 1
      },
      {
        label: 'Penjualan',
        data: [
                
                <?php if ($filter == 2): ?>

                  //bulanan
                  <?php for ($i=1; $i < 13; $i++):?>

                    <?php foreach ($penjualan_data as $v): ?>
                      
                      <?php if ($v['bulan'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endforeach ?>

                  <?php endfor ?>

                <?php else: ?>

                  //harian
                  <?php for ($i=1; $i < $hari + 1; $i++):?>

                    <?php foreach ($penjualan_data as $v): ?>

                      <?php if ($v['tanggal'] == $i): ?>
                      
                        <?=$v['total'].','; ?>

                      <?php else: ?>
                        
                        <?='0'.','; ?>

                      <?php endif ?>

                    <?php endforeach ?>

                  <?php endfor ?>

                <?php endif ?>

              ],
        borderWidth: 1
      }]
    },
    options: {
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>


<script src="https://cdn.canvasjs.com/jquery.canvasjs.min.js"></script>
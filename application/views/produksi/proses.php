<style type="text/css">
  .tit{
    background: black;
    padding: 0.5%;
    color: white;
  }
</style>

    <!-- Main content --> 
    <section class="content">
  
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
          <h4 align="center" class="tit">Antrean Pesanan (SO)</h4>
          <table id="example1" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Pelanggan</th>
              <th>Tanggal</th>
              <th>Print</th>
              <th width="60">Proses</th>
              <th width="60">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>
      </div>
      
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
          
          <div align="left" class="produksi_add">
            <a href="<?= base_url('produksi/proses_add/') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
          </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <h4 align="center" class="tit">Proses Produksi</h4>
          <table id="example2" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Shift</th>
              <th>Tanggal</th>
              <th>Print</th>
              <th width="30">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>        
      </div>
      <!-- /.box -->

<script type="text/javascript">
    var table1;
    $(document).ready(function() {
        //datatables
        table1 = $('#example1').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "order":[], 
            "scrollX": true, 
            
            "ajax": { 
                "url": "<?=site_url('produksi/so_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "produksi_nomor"},
                        { "data": "kontak_nama",
                        "render": 
                        function( data ) {
                            return "<span>"+data+"</span>";
                          }
                        },
                        { "data": "produksi_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY LT")+"</span>";
                          }
                        },
                        { "data": "produksi_nomor",
                        "render":  
                        function( data ) {
                            return "<a href='<?php echo base_url('penjualan/faktur_produksi/')?>"+data+"'><button class='btn btn-xs btn-warning'><i class='fa fa-file-text' title='cetak'></i> Antrian SO</button></a> ";
                          }
                        },
                        { "data": "produksi_proses",
                      "render": 
                      function( data ) {
                          return "<span hidden class='so_proses'>"+data+"</span><span class='so_icon'></span>";
                        }
                      },
                        { "data": "produksi_id",
                        "render": 
                        function( data ) {
                            return "<a class='so_action_proses' href='<?php echo base_url('produksi/proses_so/')?>"+data+"'><button class='btn btn-xs btn-primary'>Proses <i class='fa fa-angle-double-right'></i></button></a>"+
                            "<a class='so_action_view' href='<?php echo base_url('produksi/proses_view/')?>"+data+"'><button class='btn btn-xs btn-success'>View <i class='fa fa-angle-double-right'></i></button></a>";
                          }
                        },
                        
                    ],
        });

    });

/////////////////////////////////// PROSES ///////////////////

  var table2;
    $(document).ready(function() {
        //datatables
        table2 = $('#example2').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "order":[], 
            "scrollX": true, 
            
            "ajax": {
                "url": "<?=site_url('produksi/proses_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "produksi_nomor"},
                        { "data": "user_name",
                        "render": 
                        function( data ) {
                            return "<span>"+data+"</span>";
                          }
                        },
                        { "data": "produksi_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY  LT")+"</span>";
                          }
                        },
                        { "data": "produksi_nomor",
                        "render":  
                        function( data ) {
                            return "<a href='<?php echo base_url('produksi/cetak3/')?>"+data+"'><button class='btn btn-xs btn-warning'><i class='fa fa-file-text' title='cetak'></i> Produksi detail</button></a> ";
                          }
                        },
                        { "data": "produksi_id",
                        "render": 
                        function( data ) {
                            return "<a class='view' href='<?php echo base_url('produksi/proses_view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                              "<button onclick=del('<?php echo base_url('produksi/proses_delete/')?>"+data+"') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button> ";
                          }
                        },
                        
                    ],
        });

    });

function filter($val){
  var table1 = $('#example1').DataTable();
  table1.search($val).draw();

  var table2 = $('#example2').DataTable();
  table2.search($val).draw();
}

function auto() { 

    //ubah button so proses
    $.each($('.so_proses'), function() {
      
       var proses = $(this);
       var icon = $(this).closest('tr').find('.so_icon');
       var i = $(this).text();
       if (i == '1') {
          proses.closest('tr').find('.so_action_proses').attr('hidden', true);
          icon.html('<center><i class="fa fa-check"></i></center>');
       }else{
          proses.closest('tr').find('.so_action_view').attr('hidden', true);
          icon.html('<center><i class="fa fa-refresh"></i></center>');
       }

    });

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();  

</script>
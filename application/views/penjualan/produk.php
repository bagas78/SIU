<style type="text/css">
  .tit{
    background: black;
    padding: 0.5%;
    color: white;
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
          <h4 align="center" class="tit">Sales Order (SO) - Sudah Di Produksi</h4>
          <table id="example1" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Pelanggan</th>
                  <th>Tanggal Produksi</th>
                  <th width="20">Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left" class="penjualan_produk_add">
              <a href="<?= base_url('penjualan/'.@$url.'_add') ?>"><button class="btn-tambah btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
               <button onclick="filter('lunas')" class="btn-lunas btn btn-default"><i class="fa fa-filter"></i> Lunas</button>
              <button onclick="filter('belum')" class="btn-belum btn btn-default"><i class="fa fa-filter"></i> Belum Lunas</button>
            </div> 

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div> 
        </div>
        <div class="box-body">
          <h4 align="center" class="tit">Penjualan Produk</h4>
          <table id="example2" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Pelanggan</th>
                  <th>Jatuh Tempo</th>
                  <th>Status</th>
                  <th width="20">Print</th>
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
                "url": "<?=site_url('penjualan/so_get_produksi')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "produksi_nomor"},
                        { "data": "kontak_nama"},
                        { "data": "produksi_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY LT")+"</span>";
                          }
                        },
                        { "data": "produksi_id",
                        "render":  
                        function( data ) {
                            return "<a class='view' href='<?php echo base_url('penjualan/so_proses/')?>"+data+"'><button class='btn btn-xs btn-primary'>Proses <i class='fa fa-angle-double-right'></i></button></a>";
                          }
                        },
                        
                    ],
            });

        });

    var table2;
    $(document).ready(function() {
        //datatables
        table2 = $('#example2').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "order":[], 
            // "scrollX": true,  
            
            "ajax": {
                "url": "<?=site_url('penjualan/'.@$url.'_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "penjualan_nomor"},
                        { "data": "kontak_nama"},
                        { "data": "penjualan_jatuh_tempo",
                        "render": 
                        function( data ) {
                            if (data == '0000-00-00') {var j = '-';}else{var j = moment(data).format("DD/MM/YYYY");}
                            return "<span>"+j+"</span>";
                          }
                        },
                        { "data": "penjualan_status",
                        "render": 
                        function( data ) {
                            if (data == 'lunas') {var s = 'Lunas';} else {var s = 'Belum Lunas';}
                            return "<span>"+s+"</span>";
                          }
                        },
                        { "data": "penjualan_id",
                        "render":  
                        function( data ) {
                            return "<a <?=(@$url == 'produk')? '':'hidden'?> href='<?php echo base_url('penjualan/faktur/')?>"+data+"'><button class='btn btn-xs btn-warning'><i class='fa fa-file-text' title='cetak faktur penjualan'></i> Faktur</button></a> ";
                          }
                        },
                        { "data": "penjualan_id",
                        "render":  
                        function( data ) {
                            return "<a href='<?php echo base_url('penjualan/'.@$url.'_view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<a hidden href='<?php echo base_url('penjualan/'.@$url.'_edit/')?>"+data+"'><button class='btn btn-xs btn-primary penjualan_produk_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('penjualan/'.@$url.'_delete/')?>"+data+"') class='btn btn-xs btn-danger penjualan_produk_del'><i class='fa fa-trash'></i></button> "+
                            "<a <?=(@$url == 'packing')? '':'hidden'?> href='<?php echo base_url('penjualan/surat/')?>"+data+"'><button class='btn btn-xs btn-info'><i class='fa fa-truck'></i></button></a>";
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
</script>
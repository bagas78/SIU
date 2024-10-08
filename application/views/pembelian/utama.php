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
          <h4 align="center" class="tit">Antrean Penerimaan Bahan</h4>
          <table id="example1" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nomor</th> 
                  <th>Tanggal</th>
                  <th class="th-jumlah">Jumlah</th>
                  <th class="th-terima">Terima</th>
                  <th>Status</th>
                  <th width="1">Action</th>
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
 
            <div align="left" class="pembelian_bahan_add">

              <div class="row">
                
                <div class="col-md-4">
                
                   <a href="<?= base_url('pembelian/'.@$url.'_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
                   <button onclick="filter('lunas')" class="btn btn-default"><i class="fa fa-filter"></i> Lunas</button>
                  <button onclick="filter('belum')" class="btn btn-default"><i class="fa fa-filter"></i> Belum Lunas</button>
                
                </div>
                <!-- <div class="col-md-4 row">
                  <form method="POST" action="<?=base_url('pembelian/utama/partial')?>">
                    <div class="col-md-10 col-xs-10">
                      <input type="text" name="kode" class="form-control" placeholder="kode item">
                    </div>
                    <div class="col-md-1 row">
                      <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                    </div>
                  </form>
                </div> -->

              </div>

            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <h4 align="center" class="tit">Barang Diterima</h4>
          <table id="example2" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Bukti Penarikan</th> 
                  <th>Tanggal</th>
                  <th>Jatuh Tempo</th>
                  <th width="90">Action</th>
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
                "url": "<?=site_url('pembelian/po_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "pembelian_nomor"},
                        { "data": "pembelian_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "pembelian_jumlah",
                        "render": 
                        function( data ) {
                            return "<span class='jumlah'>"+data+"</span>";
                          }
                        },
                        { "data": "terima",
                        "render": 
                        function( data ) {
                            return "<span class='terima'>"+data+"</span>";
                          }
                        },
                        { "data": "pembelian_id",
                        "render": 
                        function( data ) {
                            return "<span class='status'></span>";
                          }
                        },
                        { "data": "pembelian_id",
                        "render": 
                        function( data ) {
                            return "<a class='proses' href='<?php echo base_url('pembelian/po_proses/')?>"+data+"'><button class='proses-btn btn btn-xs btn-primary'>Proses <i class='fa fa-angle-double-right'></i></button></a>";
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
            "scrollX": true, 
            
            "ajax": {
                "url": "<?=site_url('pembelian/utama_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "pembelian_nomor"},
                        { "data": "pembelian_terima_bukti"},
                        { "data": "pembelian_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "pembelian_jatuh_tempo",
                        "render": 
                        function( data ) {
                            if (data == '0000-00-00') {var j = '-';}else{var j = moment(data).format("DD/MM/YYYY");}
                            return "<span>"+j+"</span>";
                          }
                        },
                        { "data": "pembelian_terima_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('pembelian/'.@$url.'_view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<a href='<?php echo base_url('pembelian/'.@$url.'_edit/')?>"+data+"'><button class='btn btn-xs btn-primary pembelian_bahan_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('pembelian/'.@$url.'_delete/')?>"+data+"') class='btn btn-xs btn-danger pembelian_bahan_del'><i class='fa fa-trash'></i></button> "+
                            "<a href='<?php echo base_url('pembelian/laporan/')?>"+data+"'><button class='btn btn-xs btn-warning'><i class='fa fa-file-text'></i></button></a> ";
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

function auto(){

    //hidden
    $('.jumlah').closest('td').hide();
    $('.terima').closest('td').hide();
    $('.th-jumlah').hide();
    $('.th-terima').hide();

    $.each($('.jumlah'), function() {
       
      var jumlah = Number($(this).closest('tr').find('.jumlah').text());
      var terima = Number($(this).closest('tr').find('.terima').text());
      var proses = $(this).closest('tr').find('.proses');
      var proses_btn = $(this).closest('tr').find('.proses-btn');

      var status = $(this).closest('tr').find('.status');

      if (terima == 0) {

        status.text('Belum');
      }

      if (terima != 0 && jumlah > terima) {

        status.text('Sebagian');
      }

      if (terima != 0 && terima >= jumlah) {

        status.text('Selesai');
        proses.css('pointer-events', 'none');
        proses_btn.css('background', 'grey');
      }

    });

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();
 
</script>
<style type="text/css">
  .tit{
    background: black;
    padding: 0.5%;
    color: white;
  }
  @media only screen and (min-width:1281px) {
    .w-modal {
      width: 70%;
    }
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

          <div class="row">
              <div class="col-md-2">
                  <button onclick="fil()" class="btn btn-info">Urutkan Produksi <i class="fa fa-filter"></i></button>
              </div>
          </div>
          <br/>

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

            <div class="row">
                <div class="col-md-1" style="margin-right: 10px;">
                    <a href="<?= base_url('produksi/proses_add/') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
                </div>
                <div class="col-md-4">
                    <select class="group-produk form-control select2">
                        <option value=""></option>
                        <?php foreach ($produk_data as $v): ?>
                            <option value="<?=$v['produk_id']?>"><?=$v['produk_nama']?></option>
                        <?php endforeach ?>
                    </select>
                </div>
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
          <h4 align="center" class="tit">Proses Produksi</h4>
          <table id="example2" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Shift</th>
              <th>Tanggal</th>
              <th>Print</th>
              <th>Selesai</th>
              <th width="30">Action</th>
              <th hidden>status</th>
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
          
          <div align="left"></div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <h4 align="center" class="tit">Selesai Produksi</h4>
          <table id="example3" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Nomor</th>
              <th>Shift</th>
              <th>Tanggal</th>
              <th width="1">Surat Jalan</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>       
      </div>
      <!-- /.box -->

    <div class="modal fade" id="modal-default">
      <div class="modal-dialog w-modal">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"></h4>
          </div>
          <div class="modal-body">

            <table class="table table-bordered">
                <tr>
                    <th>Nama Produk</th>
                    <td id="produk-nama"></td>
                </tr>
                <tr>
                    <th>Total Panjang</th>
                    <td id="produk-total"></td>
                </tr>
            </table>
            
            <table class="table table-bordered">
                <tbody id="produk-bahan"></tbody>
            </table>

          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

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

    function fil(){

        var table = $('#example1').DataTable();

        table.ajax.url('<?=site_url('produksi/so_get_data/1')?>');
        table.draw();
    }

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
                        { "data": "produksi_log_id",
                        "render":  
                        function( data ) {
                            return "<a href='<?php echo base_url('produksi/cetak3/')?>"+data+"'><button class='btn btn-xs btn-warning'><i class='fa fa-file-text' title='cetak'></i> Produksi detail</button></a> ";
                          }
                        },
                        { "data": "produksi_log_id",
                        "render":  
                        function( data ) {
                            return "<a class='action-selesai' href='<?php echo base_url('produksi/selesai/')?>"+data+"'><button class='btn-selesai btn btn-xs btn-success'><i class='fa fa-check' title='selesai produksi'></i> Selesai Produksi</button></a> ";
                          }
                        },
                        { "data": "produksi_log_id",
                        "render": 
                        function( data ) {
                            return "<a class='view' href='<?php echo base_url('produksi/proses_view/')?>"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                              "<button onclick=del('<?php echo base_url('produksi/proses_delete/')?>"+data+"') class='btn btn-xs btn-danger'><i class='fa fa-trash'></i></button> ";
                          }
                        },
                        { "data": "produksi_selesai",
                        "render":  
                        function( data ) {
                            return "<span class='selesai'>"+data+"</span>";
                          }
                        },
                        
                    ],
        });

    });

/////////////////////////////////// SELESAI ///////////////////

  var table3;
    $(document).ready(function() {
        //datatables
        table3 = $('#example3').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "order":[], 
            "scrollX": true, 
            
            "ajax": {
                "url": "<?=site_url('produksi/selesai_get_data')?>",
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
                        { "data": "produksi_log_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY  LT")+"</span>";
                          }
                        },
                        { "data": "produksi_log_id",
                        "render":  
                        function( data ) {
                            return "<a href='<?php echo base_url('produksi/surat/')?>"+data+"'><button class='btn btn-xs btn-primary'><i class='fa fa-file-text' title='cetak surat jalan'></i> Cetak Surat Jalan</button></a> ";
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

  var table3 = $('#example3').DataTable();
  table3.search($val).draw();
}

function auto() { 

    //ubah button so proses
    $.each($('.so_proses'), function() {
      
       var proses = $(this);
       var icon = $(this).closest('tr').find('.so_icon');
       var i = $(this).text();

       switch(i) {

          case '0':

            proses.closest('tr').find('.so_action_view').attr('hidden', true);
            icon.html('<center><i class="fa fa-refresh"></i></center>');

            break;
          case '1':
            
            proses.closest('tr').find('.so_action_view').attr('hidden', true);
            icon.html('<center><i class="fa fa-refresh"></i></center>');
            proses.closest('tr').find('.btn-primary').html('Partial <i class="fa fa-angle-double-right"></i>');

            break;
          case '2':
            
            proses.closest('tr').find('.so_action_proses').attr('hidden', true);
            icon.html('<center><i class="fa fa-check"></i></center>');

            break;
        }

    });

    //selesai
    $.each($('.selesai'), function() {
       
       var i = $(this).text();
       if (i == '1') {
          $(this).closest('tr').find('.action-selesai').css('pointer-events', 'none');
          $(this).closest('tr').find('.btn-selesai').css('background', '#999');
          $(this).closest('td').attr('hidden', '');
       }else{
          $(this).closest('td').attr('hidden', '');
       }

    });

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

  //search group produk 
  $(document).ready(function() {

      $('.group-produk').on('change', function() {
        
        let id = $(this).val();

        $.ajax({
                url: '<?=base_url('produksi/group_produk')?>',
                type: 'POST',
                dataType: 'json',
                data: {id: id},
            })
            .done(function(response) {

                //empty
                $('#produk-bahan').empty();
                $('#produk-nama').empty();
                $('#produk-total').empty();
                
                if (response != '') {

                    let total = 0;
                    let nama = '';
                    let html = '';
                    $.each(response, function(index1, val1) {
                         
                        total += Number(val1['panjang']);
                        nama = val1['nama'];

                        html += `<tr class="bg-alice">
                                <th>Order</th>
                                <th>Nama Bahan</th>
                                <th>Nomor Transaksi</th>
                                <th>Panjang</th>
                                <th>Katerangan</th>
                                </tr>`;
                         
                        //get bahan
                        $.get('<?=base_url('produksi/group_bahan/')?>'+val1['log'], function(data) {
                            
                            let arr = $.parseJSON(data); 
                            $.each(arr, function(index2, val2) {
                                
                                 html += `<tr>
                                        <td>${val2['pelanggan']}</td>
                                        <td>${val2['nama']}</td>
                                        <td>${val2['nomor']}</td>
                                        <td>${val2['panjang']} Meter</td>
                                        <td>${val2['keterangan']}</td>
                                        </tr>`;
                            });

                            $('#produk-bahan').append(html);
               
                        });
                    });

                    $('#produk-nama').text(nama);
                    $('#produk-total').text(total+' Meter');

                    $('#modal-default').modal('toggle');
                }else{

                    alert_sweet('Produk tidak di temukan');
                }

            });
      
    }); 

  });

</script>
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
          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nomor</th> 
                  <th>Supplier</th>
                  <th>Tanggal</th>
                  <th>Total Panjang</th>
                  <th>Total Berat</th>
                  <th>Status</th>
                  <th width="10">Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
              </table>

        </div>

        
      </div>
      <!-- /.box -->

<script type="text/javascript">

    var table;
    $(document).ready(function() {
        //datatables
        table = $('#example').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "order":[], 
            "scrollX": true, 
            
            "ajax": {
                "url": "<?=site_url('partial/get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "pembelian_nomor"},
                        { "data": "kontak_nama"},
                        { "data": "pembelian_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        { "data": "panjang_cek",
                        "render": 
                        function( data ) {
                            return "<span class='pj'>"+data+"</span>";
                          }
                        },
                        { "data": "berat_cek",
                        "render": 
                        function( data ) {
                            return "<span class='br'>"+data+"</span>";
                          }
                        },
                        { "data": "pembelian_nomor",
                        "render": 
                        function( data ) {
                            return "<span class='st'>0</span>";
                          }
                        },
                        { "data": "pembelian_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('partial/proses/')?>"+data+"'><button class='btn btn-xs btn-primary'>Proses <i class='fa fa-arrow-right'></i></button></a> ";
                          }
                        },
                        
                    ],
        });

    });

function filter($val){
  var table1 = $('#example').DataTable();
  table1.search($val).draw();
}

function auto() { 

    $.each($('.pj'), function() {
        
        var target = $(this).closest('tr');
        var p_i = Number($(this).text());

        $.each($('br'), function() {
                 
            var b_j = Number($(this).text());

            if (p_i <= 0 && b_j <= 0) {

                target.find('.st').html('<span class="text-success fa fa-check"></span>');
                target.find('a').css('pointer-events', 'none').find('.btn').css('background', 'darkgrey');
            }else{

                target.find('.st').html('<span class="text-danger fa fa-refresh"></span>');
            }

        });   
    });

    setTimeout(function() {
        auto();
    }, 100);
}

auto(); 
 
</script>
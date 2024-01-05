
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
          
          <table id="table" class="table table-bordered table-hover table-responsive" style="width: 100%;">
                <thead>
                <tr>
                  <th>Gudang</th>
                  <th>Nama</th>
                  <th>Stok ( M )</th>
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
        table = $('#table').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('laporan/get_produk_data') ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "gudang_nama"},
                        { "data": "produk_nama"},
                        { "data": "stok",
                        "render": 
                        function( data ) {
                            return number_format(data);
                          }
                        },
                    ],
            "dom": "Bfrtip",
            "buttons": [
                "excel", "pdf", "print",
            ]
        });

    });
</script>
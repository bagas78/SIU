    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border">

        </div>
        <div class="box-body tes-hydev">
          <table id="table" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Gudang</th>
              <th>Nama</th>
              <th>Stok</th>
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
            
            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[1, 'desc'],  
            // "scrollX"     : true,

            "searching": false,
            
            "ajax": {
                "url": "<?=site_url('reminder/get_bahan') ?>",
                "type": "GET"
            },
            "columns": [  
                        { "data": "gudang_nama"},
                        { "data": "bahan_nama"},
                        { "data": "bahan_gudang_panjang",
                          "render":
                            function(data) {
                              return "<span class='text-red'>"+number_format(data)+"</span>";
                            }
                        }                        
                        
                    ],
            "dom": "Bfrtip",
            "buttons": []
        });

    });

function filter($val){
  var table = $('#table').DataTable();
  table.search($val).draw();
}

</script>

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
                  <th>Bahan</th>
                  <th>Kode Itam</th>
                  <th>Panjang</th>
                  <th>Berat</th>
                  <th>Tanggal</th>
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
                "url": "<?=site_url('pembelian/partial_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "pembelian_partial_nomor"},
                        { "data": "bahan_nama"},
                        { "data": "pembelian_partial_kode"},
                        { "data": "pembelian_partial_panjang",
                        "render": 
                        function( data ) {
                            return "<span>"+data.replaceAll('.00','')+" M</span>";
                          }
                        },
                        { "data": "pembelian_partial_berat",
                        "render": 
                        function( data ) {
                            return "<span>"+data.replaceAll('.00','')+" Kg</span>";
                          }
                        },
                        { "data": "pembelian_partial_tanggal",
                        "render": 
                        function( data ) {
                            return "<span>"+moment(data).format("DD/MM/YYYY")+"</span>";
                          }
                        },
                        
                    ],
        });

    });
 
</script>
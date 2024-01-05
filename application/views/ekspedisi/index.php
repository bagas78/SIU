
    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left" class="mesin_add">
              <a href="<?= base_url('ekspedisi/add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body tes-hydev">
          
          <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Kode ekspedisi</th>
                  <th>Nama ekspedisi</th>
                  <th>Keterangan</th>
                  <th width="50">Action</th>
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
            
            "ajax": {
                "url": "<?=site_url('ekspedisi/get_data') ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "ekspedisi_kode"},
                        { "data": "ekspedisi_nama"},
                        { "data": "ekspedisi_keterangan"},
                        { "data": "ekspedisi_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?php echo base_url('ekspedisi/edit/')?>"+data+"'><button class='btn btn-xs btn-primary mesin_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('ekspedisi/delete/')?>"+data+"') class='btn btn-xs btn-danger mesin_del'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>
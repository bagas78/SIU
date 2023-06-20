
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">

          <div align="left" class="hutang_add">
            <a href="<?=base_url('produk')?>"><button class="b-bahan btn btn-default">Produk <i class="fa fa-chevron-circle-right"></i></button></a>
            <a href="<?=base_url('produk/jenis')?>"><button class="b-umum btn btn-default active">Jenis <i class="fa fa-chevron-circle-right"></i></button></a>
            <a href="<?=base_url('produk/warna')?>"><button class="b-umum btn btn-default">Warna <i class="fa fa-chevron-circle-right"></i></button></a>
          </div>
 
            <!-- <div align="left">
              <a href="<?= base_url('produk/jenis_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
            </div> -->

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
                  <th>Kode</th>
                  <th>Type</th>
                  <th>Keterangan</th>
                  <th width="1">Action</th>
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
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('produk/jenis_get_data') ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "warna_jenis_kode"},
                        { "data": "warna_jenis_type"},
                        { "data": "warna_jenis_keterangan"},
                        { "data": "warna_jenis_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('produk/jenis_edit/')?>"+data+"'><button class='btn btn-xs btn-primary jenis_pewarnaan_add'><i class='fa fa-edit'></i></button></a> ";
                          }
                        },
                        
                    ],
        });

    });
</script>
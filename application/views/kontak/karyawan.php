
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border"> 
            
            <div align="left" class="hutang_add">
              <a href="<?=base_url('kontak')?>"><button class="b-bahan btn btn-default active">Karyawan <i class="fa fa-chevron-circle-right"></i></button></a>
              <a href="<?=base_url('kontak/supplier')?>"><button class="b-umum btn btn-default">Supplier <i class="fa fa-chevron-circle-right"></i></button></a>
              <a href="<?=base_url('kontak/pelanggan')?>"><button class="b-umum btn btn-default">Pelanggan <i class="fa fa-chevron-circle-right"></i></button></a>
              <a href="<?=base_url('kontak/rekening')?>"><button class="b-umum btn btn-default">Rekening Bank <i class="fa fa-chevron-circle-right"></i></button></a>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <div align="left" class="karyawan_add">
            <a href="<?= base_url('kontak/karyawan_add') ?>"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
          </div>

          <div class="clearfix"></div><br/>
          
          <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>No. Tlp</th>
                  <th>Alamat</th>
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
                "url": "<?=site_url('kontak/karyawan_get_data')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "karyawan_nama"},
                        { "data": "karyawan_telp"},
                        { "data": "karyawan_alamat"},
                        { "data": "karyawan_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?php echo base_url('kontak')?>/karyawan_edit/"+data+"'><button class='btn btn-xs btn-primary karyawan_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('kontak')?>/karyawan_delete/"+data+"') class='btn btn-xs btn-danger karyawan_del'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>
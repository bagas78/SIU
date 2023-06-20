
    <!-- Main content --> 
    <section class="content">

      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
            
            <div align="left" class="hutang_add">
              <a href="<?=base_url('kontak')?>"><button class="b-bahan btn btn-default">Karyawan <i class="fa fa-chevron-circle-right"></i></button></a>
              <a href="<?=base_url('kontak/supplier')?>"><button class="b-umum btn btn-default">Supplier <i class="fa fa-chevron-circle-right"></i></button></a>
              <a href="<?=base_url('kontak/pelanggan')?>"><button class="b-umum btn btn-default active">Pelanggan <i class="fa fa-chevron-circle-right"></i></button></a>
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
          
          <div align="left" class="pelanggan_add">
            <a href="<?= base_url('kontak/') ?><?=(@$jenis == 's')?'supplier':'pelanggan' ?>/add"><button class="btn btn-primary"><i class="fa fa-plus"></i> Tambah</button></a>
          </div>

          <div class="clearfix"></div><br/>

          <table id="example" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>Kode <?= (@$jenis == 's')?'Supplier':'Pelanggan' ?></th>
                  <th>Nama</th>
                  <th width="70">Action</th>
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
                "url": "<?=(@$jenis == 's')? site_url('kontak/get_data/s'):site_url('kontak/get_data/p')?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "kontak_kode"},
                        { "data": "kontak_nama"},
                        { "data": "kontak_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<a href='<?php echo base_url('kontak/')?><?=(@$jenis == 's')?'supplier':'pelanggan' ?>/view/"+data+"'><button class='btn btn-xs btn-success'><i class='fa fa-eye'></i></button></a> "+
                            "<a href='<?php echo base_url('kontak/')?><?=(@$jenis == 's')?'supplier':'pelanggan' ?>/edit/"+data+"'><button class='btn btn-xs btn-primary pelanggan_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('kontak/delete/')?>"+data+"/<?= @$jenis ?>') class='btn btn-xs btn-danger pelanggan_del'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });
</script>
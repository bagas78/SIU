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
 
            <div align="left" class="bahan_add row">  

              <div class="col-md-2 col-xs-4">
                <a href="<?= base_url('produk/add') ?>"><button class="btn btn-primary form-control"><i class="fa fa-plus"></i> Tambah</button></a>    
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

            <h4 align="center" class="tit">Nama Produk</h4>
         
            <table id="example1" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Kode</th>
              <th>Nama</th>
              <th>isi / colly <span class="stn">Pcs</span></th>
              <th>Harga <span class="stn">Rp</span></th>
              <th width="10">Action</th>
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
 
            <div align="left" class="bahan_add row">  

              <div class="col-md-2 col-xs-4">
                <select class="form-control" onchange="filter($(this).val())">
                <option value="">Semua Produk</option>
                <?php foreach ($gudang_data as $g): ?>
                  <option value="<?=$g['gudang_nama']?>"><?=$g['gudang_nama']?></option>
                <?php endforeach ?>
                </select>
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

            <h4 align="center" class="tit">Stok Produk</h4>
         
            <table id="example2" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Kode</th>
              <th>Gudang</th>
              <th>Nama</th>
              <th>Stok <span class="stn">Mtr</span></th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>
      </div>
      <!-- /.box -->

<br><br>

<script type="text/javascript">
    var table1;
    $(document).ready(function() {

        //datatables
        table1 = $('#example1').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('produk/get_data') ?>",
                "type": "GET"
            },
            "columns": [     
                        { "data": "produk_kode"},
                        { "data": "produk_nama"},
                        { "data": "produk_colly",
                        "render": 
                        function( data ) {
                            return number_format(data);
                          }
                        },
                        { "data": "produk_harga",
                        "render": 
                        function( data ) {
                            return number_format(data);
                          }
                        },
                        { "data": "produk_id",
                        "render": 
                        function( data, type, row ) {
                            return "<a href='<?php echo base_url('produk/edit/')?>"+data+"'><button class='btn btn-xs btn-primary master_produk_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produk/delete/')?>"+data+"') class='btn btn-xs btn-danger master_produk_del'><i class='fa fa-trash'></i></button>";
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
            "scrollX": true, 
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('produk/get_stok') ?>",
                "type": "GET"
            },
            "columns": [     
                        { "data": "produk_kode"},
                        { "data": "gudang_nama",
                        "render": 
                        function( data ) {
                            return '<span class="gudang">'+data+'</span>';
                          }
                        },
                        { "data": "produk_nama"},
                        { "data": "produk_gudang_panjang",
                        "render": 
                        function( data ) {
                            return '<span class="stok">'+number_format(data)+'</span>';
                          }
                        }
                        
                    ],
        });

    });

function filter($val){
  var table2 = $('#example2').DataTable();
  table2.search($val).draw();
}

</script>
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

      <!-- Default box -->  
      <div class="box"> 
        <div class="box-header with-border">
  
            <div align="left" class="bahan_add row"> 

              <form action="" method="POST">
                <div class="col-md-3"> 
                  <select id="user" required name="user" class="form-control select2">
                    <option value="" hidden></option>
                    <?php foreach ($user_data as $v): ?>
                      <option value="<?=@$v['user_id']?>"><?=@$v['user_name']?></option>
                    <?php endforeach ?>
                  </select>
                </div>
                <div class="col-md-3 row"> 
                  <input id="tanggal" type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="col-md-1">
                  <button type="submit" class="btn btn-primary form-control"><i class="fa fa-search"></i></button>
                </div>  
              </form>
              
            </div> 

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div> 
        <div class="box-body">

          <?php if (@$user_x): ?>

          <div class="row py-4">

            <div class="col-md-6">
              <table class="table table-bordered table-hover">
                <tr>
                  <td>TOTAL PEMBELIAN</td>
                  <td><?='Rp. '.number_format(@$pembelian_total['total'])?></td>
                </tr>
                <tr>
                  <td>TOTAL PEMBELIAN UMUM</td>
                  <td><?='Rp. '.number_format(@$pembelian_umum_total['total'])?></td>
                </tr>
                <tr>
                  <td>TOTAL PENJUALAN</td>
                  <td><?='Rp. '.number_format(@$penjualan_total['total'])?></td>
                </tr>
              </table>
            </div>
            <div class="col-md-6">
              <table class="table table-bordered table-hover">
                <tr>
                  <td>TOTAL PRODUKSI PRODUK</td>
                  <td><?='Rp. '.number_format(@$produksi_produk_total['total'])?></td>
                </tr>
                <tr>
                  <td>TOTAL PRODUKSI BAHAN BAKU</td>
                  <td><?='Rp. '.number_format(@$produksi_bahan_total['total'])?></td>
                </tr>
              </table>
            </div>
          
          </div>

          <div class="clearfix"></div>

          <h4 align="center" class="tit">Pembelian</h4>
         
            <table id="example1" class="table table-bordered table-hover" style="width: 100%;">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Barang</th>
                  <th>Panjang <span class="stn">Mtr</span></th>
                  <th>Berat <span class="stn">Kg</span></th>
                  <th>Harga <span class="stn">Rp</span></th>
                  <th>Total <span class="stn">Rp</span></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          <h4 align="center" class="tit">Pembelian Umum</h4>
         
          <table id="example2" class="table table-bordered table-hover" style="width: 100%;">
                <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Barang</th>
                  <th>Jumlah <span class="stn">Pcs</span></th>
                  <th>Potongan <span class="stn">Rp</span></th>
                  <th>Harga <span class="stn">Rp</span></th>
                  <th>Total <span class="stn">Rp</span></th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>

          <h4 align="center" class="tit">Penjualan</h4>
         
            <table id="example3" class="table table-bordered table-hover" style="width: 100%;">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Barang</th>
                  <th>Panjang <span class="stn">Mtr</span></th>
                  <th>Harga <span class="stn">Rp</span></th>
                  <th>Total <span class="stn">Rp</span></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          <h4 align="center" class="tit">Produksi Produk</h4>

            <table id="example4" class="table table-bordered table-hover" style="width: 100%;">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Barang</th>
                  <th>Jumlah <span class="stn">Pcs</span></th>
                  <th>Panjang <span class="stn">Mtr</span></th>
                  <th>Total <span class="stn">Rp</span></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          <h4 align="center" class="tit">Produksi Bahan Baku</h4>

            <table id="example5" class="table table-bordered table-hover" style="width: 100%;">
              <thead>
                <tr>
                  <th>Nomor</th>
                  <th>Barang</th>
                  <th>Panjang <span class="stn">Mtr</span></th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>

          <?php endif ?>

        </div>
      </div>
      <!-- /.box -->

<script type="text/javascript">
    var table1;
    var table2;
    var table3;
    var table4;
    $(document).ready(function() {

        //datatables
        table1 = $('#example1').DataTable({ 

            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            "scrollX"     : true,
            "searching"   : false,
            "ordering"    : false,
            "lengthChange": false,
            
            "ajax": {
                "url": "<?=site_url('close/get_pembelian/'.@$user_x.'/'.@$tanggal_x) ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "pembelian_nomor"},
                        { "data": "bahan_nama"},
                        { "data": "pembelian_barang_panjang",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "pembelian_barang_berat",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "pembelian_barang_harga",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "pembelian_barang_total",
                        "render":
                          function(data) {
                            return "<span class='harga'>"+number_format(data)+"</span>"
                          }
                        },
                        
                    ],
          });


        //datatables
        table2 = $('#example2').DataTable({ 

            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            "scrollX"     : true,
            "searching"   : false,
            "ordering"    : false,
            "lengthChange": false,
            
            "ajax": {
                "url": "<?=site_url('close/get_pembelian_umum/'.@$user_x.'/'.@$tanggal_x) ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "pembelian_umum_nomor"},
                        { "data": "bahan_nama"},
                        { "data": "pembelian_umum_barang_qty",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "pembelian_umum_barang_potongan",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "pembelian_umum_barang_harga",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "pembelian_umum_barang_subtotal",
                        "render":
                          function(data) {
                            return "<span class='harga'>"+number_format(data)+"</span>"
                          }
                        },
                        
                    ],
        });

        //datatables
        table3 = $('#example3').DataTable({ 

            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            "scrollX"     : true,
            "searching"   : false,
            "ordering"    : false,
            "lengthChange": false,
            
            "ajax": {
                "url": "<?=site_url('close/get_penjualan/'.@$user_x.'/'.@$tanggal_x) ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "penjualan_barang_nomor"},
                        { "data": "produk_nama"},
                        { "data": "penjualan_barang_panjang_total",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "penjualan_barang_harga",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "penjualan_barang_total",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        
                    ],
          });

        //datatables
        table4 = $('#example4').DataTable({ 

            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            "scrollX"     : true,
            "searching"   : false,
            "ordering"    : false,
            "lengthChange": false,
            
            "ajax": {
                "url": "<?=site_url('close/get_produksi_produk/'.@$user_x.'/'.@$tanggal_x) ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "produksi_produksi_nomor"},
                        { "data": "produk_nama"},
                        { "data": "produksi_produksi_qty",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "produksi_produksi_panjang",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "produksi_produksi_panjang_total",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        
                    ],
          });

        //datatables
        table4 = $('#example5').DataTable({ 

            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            "scrollX"     : true,
            "searching"   : false,
            "ordering"    : false,
            "lengthChange": false,
            
            "ajax": {
                "url": "<?=site_url('close/get_produksi_bahan/'.@$user_x.'/'.@$tanggal_x) ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "produksi_barang_nomor"},
                        { "data": "bahan_nama"},
                        { "data": "produksi_barang_panjang",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        
                    ],
          });

    });

  //search
  $('#user').val('<?=@$user_x?>').change();
  $('#tanggal').val('<?=@$tanggal_x?>');

</script>
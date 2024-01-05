
    <!-- Main content --> 
    <section class="content"> 

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left" class="bahan_add row"> 

              <div class="col-md-2 col-xs-4">
                <a href="<?= base_url('produk/add') ?>"><button class="btn btn-primary form-control"><i class="fa fa-plus"></i> Tambah</button></a>    
              </div>
              <div class="col-md-2 col-xs-4 row">
                <select class="form-control" onchange="filter($(this).val())">
                <option value="">Semua Gudang</option>
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
         
            <table id="example" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Kode</th>
              <th>Gudang</th>
              <th>Nama</th>
              <th>Stok <span class="stn">Mtr</span></th>
              <th>isi / colly <span class="stn">Pcs</span></th>
              <th>Harga <span class="stn">Rp</span></th>
              <th width="100">Action</th>
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
                "url": "<?=site_url('produk/get_data') ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "produk_kode"},
                        { "data": "gudang_nama"},
                        { "data": "produk_nama"},
                        { "data": "stok",
                        "render": 
                        function( data ) {
                            return number_format(data);
                          }
                        },
                        { "data": "produk_colly",
                        "render": 
                        function( data ) {
                            return number_format(data);
                          }
                        },
                        { "data": "harga",
                        "render": 
                        function( data ) {
                            return number_format(data);
                          }
                        },
                        { "data": "produk_id",
                        "render": 
                        function( data ) {
                            return "<a href='<?php echo base_url('produk/edit/')?>"+data+"'><button class='btn btn-xs btn-success master_produk_add'>Set Harga</button></a> "+
                            "<a href='<?php echo base_url('produk/edit/')?>"+data+"'><button class='btn btn-xs btn-primary master_produk_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?php echo base_url('produk/delete/')?>"+data+"') class='btn btn-xs btn-danger master_produk_del'><i class='fa fa-trash'></i></button>";
                          }
                        },
                        
                    ],
        });

    });

function filter($val){
  var table = $('#example').DataTable();
  table.search($val).draw();
}

function auto(){

    $.each($('.kode'), function(index, val) {
       
       var kode = $(this).text();

       if (kode == 'BH000') {

          $(this).closest('tr').css('background', '#eee');
          $(this).closest('tr').find('.action').remove();

       }else{ 

          $(this).removeClass('kode');
       }

    });

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>
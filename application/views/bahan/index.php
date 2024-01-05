
    <!-- Main content --> 
    <section class="content">

      <!-- Default box --> 
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left" class="bahan_add row"> 

              <div class="col-md-2">
                <a href="<?= base_url('bahan/add') ?>"><button class="btn btn-primary form-control"><i class="fa fa-plus"></i> Tambah</button></a>    
              </div>
              <div class="col-md-2 row">
                <select class="form-control" onchange="filter($(this).val())">
                <option value="">Semua Gudang</option>
                <?php foreach ($gudang_data as $g): ?>
                  <option value="<?=$g['gudang_nama']?>"><?=$g['gudang_nama']?></option>
                <?php endforeach ?>
                </select>
              </div>
              <div class="col-md-2">
                <select class="form-control" onchange="filter($(this).val())">
                <option value="">Semua Kategori</option>
                <option value="utama">Bahan Baku Utama</option>
                <option value="pembantu">Bahan Pembantu</option>
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
                  <th>Berat <span class="stn">Kg</span></th>
                  <th>Panjang <span class="stn">Mtr</span></th>
                  <th>Harga <span class="stn">Rp</span></th>
                  <th>Hpp <span class="stn">Rp</span></th>
                  <th>Kategori</th>
                  <th width="40">Action</th>
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

            "processing"  : true, 
            "serverSide"  : true,
            "order"       :[],  
            "scrollX"     : true,
            
            "ajax": {
                "url": "<?=site_url('bahan/get_data') ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "bahan_kode",
                        "render":
                        function(data) {
                          return "<span class='kode'>"+data+"</span>";
                        }},
                        { "data": "gudang_nama"}, 
                        { "data": "bahan_nama"},
                        { "data": "berat",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "panjang",
                        "render":
                        function(data) {
                          return "<span>"+number_format(data)+"</span>";
                        }},
                        { "data": "bahan_harga",
                        "render":
                          function(data) {
                            return "<span class='harga'>"+number_format(data)+"</span>"
                          }
                        },
                        { "data": "hpp",
                        "render":
                          function(data) {
                            return "<span class='harga'>"+number_format(data)+"</span>"
                          }
                        },
                        { "data": "bahan_kategori"},
                        { "data": "bahan_id",
                        "render": 
                        function(data) {
                            return "<div class='action'><a href='<?= base_url('bahan/edit/')?>"+data+"'><button class='btn btn-xs btn-primary bahan_add'><i class='fa fa-edit'></i></button></a> "+
                            "<button onclick=del('<?= base_url('bahan/delete/')?>"+data+"') class='btn btn-xs btn-danger bahan_del'><i class='fa fa-trash'></i></button></div>";
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
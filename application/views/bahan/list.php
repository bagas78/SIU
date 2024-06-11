
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

          <table class="table table-bordered">
            <tr>
              <td>gudang</td>
              <td><?=@$data['gudang_nama']?></td>
            </tr>
            <tr>
              <td>Nama Bahan</td>
              <td><?=@$data['bahan_nama']?></td>
            </tr>
          </table>
          
          <br/>

          <table id="example" class="table table-bordered table-hover" style="width: 100%;">
            <thead>
            <tr>
              <th>Kode Item</th>
              <th>Berat <span class="stn">Kg</span></th>
              <th>Panjang <span class="stn">Mtr</span></th>
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
                "url": "<?=site_url('bahan/get_item/'.@$data["bahan_gudang_gudang"].'/'.@$data["bahan_gudang_bahan"]) ?>",
                "type": "GET"
            },
            "columns": [ 
                        { "data": "bahan_item_kode",
                        "render":
                        function(data) {
                          return "<span class='kode'>"+data+"</span>";
                        }},
                        { "data": "bahan_item_berat",
                        "render":
                        function(data) {
                          return "<span class='berat'>"+number_format(data)+"</span>";
                        }},
                        { "data": "bahan_item_panjang",
                        "render":
                        function(data) {
                          return "<span class='panjang'>"+number_format(data)+"</span>";
                        }},
                        
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

       //replace .00
       $.each($('.berat, .panjang'), function(index, val) {
          
          var val = $(this).text();
          $(this).text(val.replaceAll('.00', ''));

       });

    });

    setTimeout(function() {
        auto();
    }, 100);
  }

  auto();

</script>


    <!-- Main content --> 
    <section class="content">
 
      <!-- Default box -->
      <div class="box"> 
        <div class="box-header with-border">
 
            <div align="left">
                <button onclick="modal('setor')" class="btn btn-primary"><i class="fa fa-plus"></i> Setor Saldo</button>
                <button onclick="modal('tarik')" class="btn btn-danger"><i class="fa fa-minus"></i> Tarik Saldo</button>
            </div>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">

          <div class="row py-4">
            <div class="col-md-4"> 
              <table class="table table-bordered">
                <tr>
                  <td style="background: #f4f4f4;">Total Saldo</td>
                  <td><?='Rp. '.number_format(@$total_plus['saldo'] - @$total_min['saldo'])?></td>
                </tr>
              </table>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
              <div class="sx-right" align="right">
                <input name="filter" type="date" class="p03 filter">
                <button onclick="filter()" class="p03">Filter <i class="fa fa-search"></i></button>
              </div>
            </div>
          </div>
          
          <table id="example" class="table table-bordered table-hover">
            <thead>
            <tr>
              <th>Nominal</th>
              <th>Jenis</th>
              <th>Rekening</th>
              <th>Keterangan</th>
              <th>Tanggal</th>
              <th width="1">Action</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
          </table>

        </div>

        
      </div>
      <!-- /.box -->

<!-- tambah saldo -->
<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form role="form" method="post" action="<?php echo base_url('saldo/save') ?>" enctype="multipart/form-data">
          <div class="box-body">

            <div class="form-group">
              <label>Nominal</label>
              <input required="" type="number" name="nominal" class="form-control">
              <input type="hidden" name="jenis" class="jenis form-control" value="">
            </div>
            <div class="form-group">
              <label>Rekening</label>
              <select class="form-control" name="rekening" required>
                <option value="" hidden>-- Pilih --</option>
                <option value="tunai">Tunai</option>
                <?php foreach ($rekening_data as $v): ?>
                  <option value="<?=$v['rekening_id']?>"><?=$v['rekening_nama']?></option>
                <?php endforeach ?>
              </select>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <textarea class="form-control" required name="keterangan"></textarea>
            </div>
          </div>

          <div class="box-footer" style="background: lavender;">
            <button type="submit" class="btn btn-primary">Submit</button>
             <button type="reset" class="btn btn-danger">Reset</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
    var table;
    $(document).ready(function() {

        //datatables
        table = $('#example').DataTable({ 

            "processing": true, 
            "serverSide": true,
            "order":[],  
            
            "ajax": {
                "url": "<?=site_url('saldo/get_data') ?>",
                "type": "GET"
            },
            "columns": [                               
                        { "data": "saldo_nominal",
                        "render": 
                        function( data ) {
                            return 'Rp. '+number_format(data);
                          }
                        },
                        { "data": "saldo_jenis"},
                        { "data": "rekening",
                        "render": 
                        function( data ) {
                            return data;
                          }
                        },
                        { "data": "saldo_keterangan"},
                        { "data": "saldo_tanggal",
                        "render": 
                        function( data ) {
                            return moment(data).format("DD/MM/YYYY h:mm:ss");;
                          }
                        },
                        { "data": "saldo_id",
                        "render": 
                        function( data, type, row, meta ) {
                            return "<button onclick=del('<?php echo base_url('saldo/delete/')?>"+data+"') class='btn btn-xs btn-danger mesin_del'><i class='fa fa-trash'></i></button></div>";
                          }
                        },
                        
                    ],
        });

    });


  function modal(jenis){

    if (jenis == 'setor') {

      $('.modal-title').text('SETOR SALDO');
      $('.jenis').val('setor');

    }else{

      $('.modal-title').text('TARIK SALDO');
      $('.jenis').val('tarik');
    }

    //show modal
    $('#modal').modal('toggle');

  }

  function filter(){
    var val = $('.filter').val();
    var table1 = $('#example').DataTable();
    table1.search(val).draw();
  }
</script>
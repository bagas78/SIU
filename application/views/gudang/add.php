
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
         
          <form action="<?=base_url('gudang/save')?>" method="POST" accept-charset="utf-8">
            
            <div class="row bg-alice">
              <div class="col-lg-6">
                <div class="form-group">
                  <label>Kode Gudang</label>
                  <input type="text" name="kode" class="form-control" required>
                </div>
                <div class="form-group">
                  <label>Nama Gudang</label>
                  <input type="text" name="nama" class="form-control" required>
                </div>
                <!-- <div class="form-group">
                  <label>Keterangan</label>
                  <input type="text" name="keterangan" class="form-control">
                </div> -->
              </div>
              <div class="col-md-12">
                <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
                <a href="<?= $_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>
              </div>

            </div>

          </form>

        </div>

        
      </div>
      <!-- /.box -->
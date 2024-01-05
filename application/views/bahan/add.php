
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
         
          <form class="bg-alice" action="<?=base_url('bahan/save')?>" method="POST" accept-charset="utf-8">
            
            <div class="form-group">
              <label>Kode Bahan</label>
              <input id="kode" readonly="" required="" type="text" name="kode" class="form-control" value="<?=@$kode?>">
            </div>
            <div class="form-group">
              <label>Nama Bahan</label>
              <input id="nama" required="" type="text" name="nama" class="form-control">
            </div>
            
            <div class="form-group">
              <label>Kategori</label>
              <select id="kategori" name="kategori" class="form-control" required>
                <option value="" hidden>-- Pilih --</option>
                <option value="utama">Bahan Baku Utama</option>
                <option value="pembantu">Bahan Pembantu</option>
              </select>
            </div>            
            <div class="form-group">
              <label>Harga <span class="stn">Rp</span></label>
              <input id="harga" required="" type="number" name="harga" class="form-control">
            </div>            

            <button type="submit" class="btn btn-success">Simpan <i class="fa fa-check"></i></button>
            <a href="<?= @$_SERVER['HTTP_REFERER'] ?>"><button type="button" class="btn btn-danger">Batal <i class="fa fa-times"></i></button></a>

          </form>

        </div>
      </div>
      <!-- /.box -->
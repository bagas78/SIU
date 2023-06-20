
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?=@$data['logo_nama'] ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="robots" content="all,follow"> 
    <!-- Bootstrap CSS-->

    <!-- <link rel="shortcut icon" href="<?php echo base_url() ?>assets/gambar/icon.png" /> -->
    <link rel="stylesheet" href="<?php echo base_url('assets/themes') ?>/vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="<?php echo base_url('assets/themes') ?>/vendor/font-awesome/css/all.min.css">
    <!-- Fontastic Custom icon font-->
    <link rel="stylesheet" href="<?php echo base_url('assets/themes') ?>/css/fontastic.css">
    <!-- Google fonts - Poppins -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,700">
    <!-- themes stylesheet-->
    <link rel="stylesheet" href="<?php echo base_url('assets/themes') ?>/css/style.default.css" id="themes-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="<?php echo base_url('assets/themes') ?>/css/custom.css">

    <script src="<?php echo base_url('assets/') ?>sweetalert/sweet-alert.js"></script>

    
  </head>
  <body>
    <div class="page login-page" style="background: url(<?php echo base_url() ?>assets/logo/tile.jpg); background-repeat: repeat;">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow" style="box-shadow: 0 1px 5px 0 rgba(0, 0, 0, 0.2), 0 3px 17px 0 rgba(0, 0, 0, 0.19);">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info align-items-center">
                <div class="content" align="center">
                  <div class="logo">
                    <h1 style="font-size: 150%;"><?=@$data['logo_nama'] ?></h1>

                    <img class="img-thumbnail" style="width: 60%; margin-top: 20px; box-shadow: 0 1px 18px 8px rgba(0, 0, 0, 0.2), 0 3px 13px 0px rgba(0, 0, 0, 0.19" src="<?=base_url('assets/logo/'.$data['logo_foto'])?>">

                  </div>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">

                  <form action="<?php echo base_url() ?>login/auth" method="POST">
                    <div class="form-group">
                      <input autocomplete="off" type="text" name="email" required="" class="input-material">
                      <label for="login-username" class="label-material">Email</label>
                    </div>
                    <div class="form-group">
                      <input autocomplete="off" type="password" name="password" required="" class="input-material">
                      <label for="login-password" class="label-material">Password</label>
                    </div>
                    <button type="submit" class="btn btn-dark">Login</button>
                  </form>

                </div>
              </div>
            </div>
            <div class="col-lg-6" style="background: #17a2b8;"></div>
            <div align="center" class="col-lg-6" style="background: lavender; padding: 0.5%;">
              <span>Copyright JTM Group 2023</span>
            </div>
          </div>
        </div>
      </div>
    </div>

        <!-- JavaScript files-->
    <script src="<?php echo base_url('assets/themes') ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url('assets/themes') ?>/vendor/popper.js/umd/popper.min.js"> </script>
    <script src="<?php echo base_url('assets/themes') ?>/vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url('assets/themes') ?>/vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="<?php echo base_url('assets/themes') ?>/vendor/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url('assets/themes') ?>/vendor/jquery-validation/jquery.validate.min.js"></script>
    <!-- Main File-->
    <script src="<?php echo base_url('assets/themes') ?>/js/front.js"></script>
  </body>
</html>

<script type="text/javascript">
  <?php if($this->session->flashdata('gagal')): ?>
    swal("Gagal", "<?php echo $this->session->flashdata('gagal'); ?>", "warning");
    $('.swal-footer').remove();
  <?php endif ?>
</script>
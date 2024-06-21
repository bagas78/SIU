</section>
<footer class="main-footer">
  <span>Copyright &nbsp; JTM &nbsp; Group &nbsp; 2023</span>
</footer>
  
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Sparkline -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>

<!-- jvectormap -->
<script src="<?php echo base_url() ?>adminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
 
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

<!-- daterangepicker -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/moment/min/moment.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

<!-- datepicker -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url() ?>adminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url() ?>adminLTE/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?php // echo base_url() ?>adminLTE/dist/js/pages/dashboard.js"></script> -->
<!-- AdminLTE for demo purposes -->
<!-- <script src="<?php // echo base_url() ?>adminLTE/dist/js/demo.js"></script> -->

<!-- ChartJS -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/chart/Chart.js"></script>

<!-- Morris.js charts -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/morris.js/morris.min.js"></script>

<!-- FLOT CHARTS -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.pie.js"></script>
<script src="<?php echo base_url() ?>adminLTE/bower_components/Flot/jquery.flot.categories.js"></script>

<!-- Select2 -->
<script src="<?php echo base_url() ?>adminLTE/bower_components/select2/dist/js/select2.full.min.js"></script>

<!-- DataTables -->
<script src="<?php echo base_url() ?>assets/datatable/js/jszip.js"></script>
<script src="<?php echo base_url() ?>assets/datatable/js/pdfmake.js"></script>
<script src="<?php echo base_url() ?>assets/datatable/js/vfs_fonts.js"></script>

<script src="<?php echo base_url() ?>assets/datatable/js/jquery.dataTables.js"></script>
<script src="<?php echo base_url() ?>assets/datatable/js/dataTables.bootstrap.js"></script>

<script src="<?php echo base_url() ?>assets/datatable/js/dataTables.buttons.js"></script>
<script src="<?php echo base_url() ?>assets/datatable/js/buttons.flash.js"></script>
<script src="<?php echo base_url() ?>assets/datatable/js/buttons.html5.js"></script>
<script src="<?php echo base_url() ?>assets/datatable/js/buttons.print.js"></script>


<script>

//footer
var content = $('.content').height();
if (Number(content) < 500) {
    $('.main-footer').css({
        'position': 'fixed',
        'bottom' : '0',
    });;
}

$(function () {
    /* hydev disabled
    CKEDITOR.replace('editor1', {
        height: '500px'
    }); */

    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })


  $(function () {
     //Select2
    $('.select2').select2({
        placeholder: "-- Pilih --"
    })
  });
  
  
//data table
    /* hydev disabled, error datatable reinitialize
  $(function () {

    //data table
    
    $('#example').DataTable({
      // 'scrollX'     : true,
      'autoWidth'   : true,
      'paging'      : false,
      'responsive'  : true,
      'scrollX'     : true,
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      'scrollX'     : true
    })
  }) */

  $.fn.dataTableExt.sErrMode = 'throw';
</script>


<script type="text/javascript">
    function showTime() {
        var a_p = "";
        var today = new Date();
        var curr_hour = today.getHours();
        var curr_minute = today.getMinutes();
        var curr_second = today.getSeconds();
        
        if (curr_hour == 0) {
            curr_hour = 24;
        }
        if (curr_hour > 24) {
            curr_hour = curr_hour - 24;
        }
        curr_hour = checkTime(curr_hour);
        curr_minute = checkTime(curr_minute);
        curr_second = checkTime(curr_second);
     document.getElementById('clock').innerHTML=curr_hour + ":" + curr_minute;
        }
 
    function checkTime(i) {
        if (i < 10) {
            i = "0" + i;
        }
        return i;
    }
    setInterval(showTime, 500);


//alert
   <?php if($this->session->flashdata('success')): ?>
    swal("Sukses", "<?php echo $this->session->flashdata('success');?>", "success");
    $('.swal-footer').remove();
   <?php endif ?>
 
   <?php if($this->session->flashdata('gagal')): ?>
    swal("Gagal", "<?php echo $this->session->flashdata('gagal'); ?>", "warning");
    $('.swal-footer').remove();
  <?php endif ?>

  //delete
  function del(url){
      swal({
        title: "Apa kamu yakin?",
        text: "Hapus data ini ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
    
          $(location).attr('href',url);
          
        }
      });
    }

  //logout
  function logout(url){
      swal({
        title: "Yakin akan keluar",
        text: "dari aplikasi ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
    
          $(location).attr('href',url);
          
        }
      });
    }

  //alert
  function alert_sweet(val){
    swal({
        title: "Oops ...",
        text: val,
        icon: "error",
        buttons: false,
        dangerMode: true,
    });
  }

//active menu
$(document).ready(function() {
    var url = window.location; 
    var element = $('ul.sidebar-menu a').filter(function() {
    return this.href == url || url.href.indexOf(this.href) == 0; }).parent().addClass('active');
    if (element.is('li')) { 
         element.addClass('active').parent().parent('li').addClass('active')
     }
});


//level hak akses
<?php $lv = $this->session->userdata('level'); ?>

<?php if ($lv != 0): ?>

    <?php $lv_data = $this->query_builder->view_row("SELECT * FROM t_level WHERE level_id = '$lv'"); ?>

    <?php $lv_json = json_decode($lv_data['level_akses'], true); ?>

    function auto(){

        <?php foreach($lv_json as $key => $val): ?>

            <?php if ($val == 0): ?>  

                $('.<?=$key?>').css('display', 'none');

            <?php endif ?>

        <?php endforeach ?>

        setTimeout(function() {
            auto();
        }, 100);
    }

    auto();

<?php endif ?>

//show menu
setTimeout(function(){ $('.sidebar-menu').removeAttr('hidden'); }, 1000);


//notifikasi
function notif(){

    //cek sesi login
    if ('<?=$this->session->userdata('login');?>' != 1) {

        window.location.replace('<?=base_url('login/index/1')?>');
    }

    //reminder bahan
    // $.get('<?=base_url('reminder/bahan_notif')?>', function(data) {
        
    //     if (parseInt(data) > 0) {
    //         $('.reminder_notif').text('New');
    //         $('.bahan_notif').text(data);
    //     }

    // });

    //reminder produk
    // $.get('<?=base_url('reminder/produk_notif')?>', function(data) {
        
    //     if (parseInt(data) > 0) {
    //         $('.reminder_notif').text('New');
    //         $('.produk_notif').text(data);
    //     }

    // });

    setTimeout(function() {
        notif();
    }, 100);
}

notif();


//ubah text to number
// $(document).ready(function () {
//     $(".text-number").keypress(function (e) {
//        var length = jQuery(this).val().length;
//      if(length > 100) {
//           return false;
//      } else if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
//           return false;
//      } else if((length == 0) && (e.which == 48)) {
//           return false;
//      }
//     });
// });

function text_number(){

    //number format
    $.each($('.text-number'), function() {
       
       var val = $(this).val();
       $(this).val(number_format(val));

    });

setTimeout(function() {
        text_number();
    }, 100);
}

text_number();

</script>

</body>
</html>



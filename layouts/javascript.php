
<script src="<?=templates()?>bower_components/jquery/dist/jquery.min.js"></script>

<script src="<?=templates()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?=templates()?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?=templates()?>bower_components/fastclick/lib/fastclick.js"></script>

<script src="<?=templates()?>dist/js/adminlte.min.js"></script>

<script src="<?=templates()?>dist/js/demo.js"></script>

<?php

$url='infowindow';
?>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();  
    $('#infoo').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      console.log(id)
      //menggunakan fungsi ajax untuk pengambilan data
      $.ajax({
        type: 'post',
        url: '<?=url('infowindow')?>',
        data: 'id=' + id,
        success: function(data) {
          $('.fetched-data').html(data); //menampilkan data ke dalam modal
        }
      });
    });
  });
</script>

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
  // $('#infoo').on('show.bs.modal', function (event) {
  // var dataVal = $(event.relatedTarget).data('val');
  // /* var test */;
  // var $this = $(this);
	// $.ajax({
  // type: 'get',
  // url: 'https://jsonplaceholder.typicode.com/users/' + dataVal,
  // success: function (data) {
  // 	console.log(data);
  //   $this.find(".modal-body").html(`<h1>  ${data.nama_rumah} </h1>`);
  //   $('.modal-body').append(`<p>id: ${data.id_rumah}</p>
  //   <p>username: ${data.username}</p>
  //   <p>email: ${data.email}</p>
  //   <p>address: ${data.address.street}, ${data.address.suite}, ${data.address.city}</p>`);
  // }
  // })

 /*  if (!test) {
    $(this).find(".modal-body").text('loading...');
  }
  setTimeout(() => {
    return $(this).find(".modal-body").text(test.id);
  }, 100) */
  


</script>

<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
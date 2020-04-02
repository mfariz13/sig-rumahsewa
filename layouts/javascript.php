
<script src="<?=templates()?>bower_components/jquery/dist/jquery.min.js"></script>

<script src="<?=templates()?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?=templates()?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script src="<?=templates()?>bower_components/fastclick/lib/fastclick.js"></script>

<script src="<?=templates()?>dist/js/adminlte.min.js"></script>

<script src="<?=templates()?>dist/js/demo.js"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree();
  })  

  function search() {
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("search-bar");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
}



</script>
<script type="text/javascript"> 
function klik(clicked_id)
  {
      alert(clicked_id);
  }
</script>


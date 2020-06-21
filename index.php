<?php 
 include 'loader.php';
 $setTemplate=true;
 if(isset($_GET['halaman'])){
    $halaman=$_GET['halaman'];
  }
  else{
    $halaman='tanahsewa';
  }
  ob_start();
  $file='halaman/'.$halaman.'.php';
  if(!file_exists($file)){
    include 'halaman/error.php';
  }
  else{
    include $file;
  }
  $content = ob_get_contents();
  ob_end_clean();
  if($setTemplate==true){
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php'?>
<body class="hold-transition skin-blue sidebar-mini">
<?php
  include 'layouts/header.php';
?>
    </section>
  <?php
  echo $content;
  ?>
<?php
  include 'layouts/footer.php';
  include 'layouts/javascript.php';
?>
</body>
</html>
<?php
  } else {
    echo $content;
}

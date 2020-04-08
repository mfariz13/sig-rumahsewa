<header class="main-header">
    <a href="" class="logo">
      
      <span class="logo-lg"><b>WEB</b>GIS</span>
    </a>
    <nav class="navbar navbar-inverse">
    <?php
        if($session->get("logged")!==true){
    ?> 
  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?=url('login')?>"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
    </ul>
  </div>
<?php
} else {
  ?>

  <div class="container-fluid">
    <ul class="nav navbar-nav navbar-right">
      <li><a href="<?=url('logout')?>"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
  <?php
  }
  ?>
</nav>
  </header>
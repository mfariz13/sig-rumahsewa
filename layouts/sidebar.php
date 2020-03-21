<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="text-center";>
          <img src="<?=templates()?>dist/img/logo.png" class="img-circle" alt="User Image">
        </div>
      </div>
      <!-- search -->

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <?php
        if($session->get("logged")!==true){
        ?> 
        <li>
          </li>
        <li>
          <a href="<?=url('beranda')?>">
            <i class="fa fa-dashboard"></i> <span>Beranda</span>
          </a>
        </li>
        <?php
        } else {
        ?>
        <li>
          <a href="<?=url('admin')?>">
            <i class="fa fa-user"></i> <span>Data Rumah Sewa</span>
          </a>
        </li>
        <li>
          <a href="<?=url('inputlayer')?>">
            <i class="fa fa-plus"></i> <span>Input Layer</span>
          </a>
        </li>
        <li>
          <a href="<?=url('logout')?>">
            <i class="fa fa-sign-out"></i> <span>Logout</span>
          </a>
        </li>
      
    </section>
    <?php
        } ?>
  </aside>

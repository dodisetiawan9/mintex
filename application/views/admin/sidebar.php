<section class="sidebar">
  <!-- Sidebar user panel -->
  <!-- <div class="user-panel">
    <div class="pull-left image">
      <img src="<?= base_url(); ?>assets/img/avatar5.png" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>Ujang</p>
      <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
  </div> -->

 
  <!-- search form -->
  <!-- <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="Search...">
      <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form> -->
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu" data-widget="tree">
    <li class="header">MAIN NAVIGATION</li>
    <li class="<?php if($this->uri->segment(1) == "admin"){echo "active";}else{echo "";} ?>">
      <a href="<?= base_url(); ?>admin">
        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
      </a>
    </li>
    <li class="treeview"></li>
    <li></li>
    <li>
      <a href="<?= base_url(); ?>distributor">
        <i class="fa fa-handshake-o"></i>
        <span>Data Distributor</span>
        <!-- <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span> -->
      </a>
    </li>
    <li>
      <a href="<?= base_url(); ?>admin/destination">
        <i class="fa fa-rocket"></i>
        <span>Data Destination</span>
      </a>
    </li>
    
    <li class="<?php if($this->uri->segment(1) == "kain" || $this->uri->segment(1) == "kain_out"){echo "active";}else{echo "";} ?> treeview">
      <a href="#">
        <i class="fa fa-map"></i> <span>Master Kain</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
       
        <li class=""><a href="<?= base_url(); ?>kain/jenis"><i class="fa fa-circle-o"></i> Jenis Kain</a></li>

        <li class="<?php if($this->uri->segment(1) == "kain"){echo "active";}else{echo "";} ?>"><a href="<?= base_url(); ?>kain">
          <i class="<?php if($this->uri->segment(1) == "kain"){echo "fa fa-circle-o text-yellow";}else{echo "fa fa-circle-o";} ?>"></i> Data Kain Masuk</a>
        </li>
        
        <li class="<?php if($this->uri->segment(1) == "kain_out"){echo "active";}else{echo "";} ?>"><a href="<?= base_url(); ?>kain_out"><i class="<?php if($this->uri->segment(1) == "kain_out"){echo "fa fa-circle-o text-yellow";}else{echo "fa fa-circle-o";} ?>"></i> Data Kain Keluar</a></li>
      </ul>
    </li>
    <li class="<?php if($this->uri->segment(1) == "benang" || $this->uri->segment(1) == "benang_out"){echo "active";}else{echo "";} ?> treeview">
      <a href="#">
        <i class="fa fa-cubes"></i> <span>Master Benang</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li><a href="pages/tables/simple.html">
          <i class="<?php if($this->uri->segment(2) == "jenis"){echo "fa fa-circle-o text-yellow";}else{echo "fa fa-circle-o";} ?>"></i> Jenis Benang</a></li>
        <li><a href="<?= base_url(); ?>benang">
          <i class="<?php if($this->uri->segment(1) == "benang"){echo "fa fa-circle-o text-yellow";}else{echo "fa fa-circle-o";} ?>"></i> Data Benang Masuk</a></li>
        <li><a href="<?= base_url(); ?>benang_out"><i class="<?php if($this->uri->segment(1) == "benang_out"){echo "fa fa-circle-o text-yellow";}else{echo "fa fa-circle-o";} ?>"></i> Data Benang Keluar</a></li>
      </ul>
    </li>
    <li></li>
    <li></li>
    <li>
      <a href="<?= base_url(); ?>admin/laporan">
        <i class="fa fa-bar-chart"></i> <span>Laporan</span>
      </a>
    </li>
    <li class="treeview"></li>
    <!-- <li><a href="https://adminlte.io/docs"><i class="fa fa-book"></i> <span>Documentation</span></a></li> -->

    <!-- <li class="header">LABELS</li> -->
    <!-- <li><a href="#"><i class="fa fa-circle-o text-red"></i> <span>Important</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
    <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li> -->

    
  </ul>
</section>
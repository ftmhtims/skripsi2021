<div class="container body">
  <div class="main_container">
    <div class="col-md-3 left_col menu_fixed">
      <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
          <a href="<?php echo site_url('admin') ?>"> <span class="site_title"><span>A D M I N</span></a>
        </div>
        <div class="clearfix"></div>
        <br>

        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
          <div class="menu_section">
            <ul class="nav side-menu">
              <li><a href="<?php echo site_url('admin') ?>"><i class="fa fa-home"></i> Home <span class="fa fa-chevron"></span></a></li>
              <li><a><i class="fa fa-cubes"></i> Paket <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                  <li><a href="<?php echo site_url('admin/paket') ?>">Form Paket</a></li>
                  <li><a href="<?php echo site_url('admin/daftar') ?>">Daftar Paket</a></li>
                </ul>
              </li>
              <li><a href="<?php echo site_url('admin/wilayah') ?>"><i class="fa fa-list"></i>Wilayah<span class="fa fa-chevron"></span></a></li>
              <li><a href="<?php echo site_url('admin/rute') ?>"><i class="fa fa-map-marker"></i> Rute <span class="fa fa-chevron"></span></a></li>
            </ul>
          </div>
        </div>
        <!-- /sidebar menu -->
      </div>
    </div>
    <!-- top navigation -->
    <div class="top_nav">
      <div class="nav_menu">
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
          <ul class=" navbar-right">
            <li class="nav-item dropdown open" style="padding-left: 15px;">
              <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                <img src="<?= base_url('assets/img/ini.jpg') ?>" alt="">Profil
              </a>
              <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="javascript:;"><?= $user['username'] ?></a>
                <a class="dropdown-item" href="javascript:;"> <?= $user['date_created'] ?></a>
                <a class="dropdown-item" href="<?php echo site_url('Auth/logout') ?>" onclick="return confirm('Apakah anda yakin ingin keluar ?')"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
              </div>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- /top navigation -->
    <!-- page content -->
    <div class="right_col" role="main">
      <div class="">
        <div class="page-title">

          <?php $this->load->view($content); ?>

        </div>
      </div>
    </div>
    <!-- /page content -->
  </div>
</div>
<body>
  <nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="<?= site_url('kurir') ?>">Home</a></li>
          <li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class="glyphicon glyphicon-list"></span> Data <b class='caret'></b></a>
            <ul class='dropdown-menu'>
              <li><?php echo anchor('kurir/daftar', 'Daftar Paket') ?></li>
            </ul>
          </li>
          <li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class="glyphicon glyphicon-globe"></span> Rute <b class='caret'></b></a>
            <ul class='dropdown-menu'>
              <li><?php echo anchor('kurir/tabel', 'Form Pencarian Rute') ?></li>
            </ul>
          </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">
          <li class='dropdown'><a href='#' class='dropdown-toggle' data-toggle='dropdown'><span class="glyphicon glyphicon-profile"></span>Profil<b class='caret'></b></a>
            <ul class='dropdown-menu'>
              <li><a href='#'><span class="glyphicon glyphicon-user"> <?php echo $user['username'] ?></span></a></li>
              <li><a href='#'><span class="glyphicon glyphicon-calender"> <?php echo $user['date_created'] ?></span></a></li>
              <li>
                <a href="<?php echo site_url('Auth/logout') ?>" onclick="return confirm('Apakah anda yakin ingin keluar ?')"> <span class="fa fa-sign-out pull-right">
                    Log Out</span></a>
              </li>
            </ul>
          </li>
        </ul>
      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <?php $this->load->view($content); ?>
      </div>
    </div>
  </div>
  <!-- /page content -->
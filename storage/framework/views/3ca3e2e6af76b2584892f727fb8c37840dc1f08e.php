<!doctype html>
<html lang="en">

  <head>
    <meta charset="utf-8" />
    <title>Security Head Office</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Admin Dashboard" name="description" />
    <meta content="ThemeDesign" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />

    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.png')); ?>">

    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/css/icons.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/css/style.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.css')); ?>" rel="stylesheet" type="text/css">
    <link href="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css">
    <!-- jQuery  -->
    <script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/modernizr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/detect.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/fastclick.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.slimscroll.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.blockUI.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/waves.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/wow.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.nicescroll.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/jquery.scrollTo.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/sweetalert2/sweetalert2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/moment/moment.js')); ?>"></script>
  </head>

  <body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">

      <!-- Top Bar Start -->
      <div class="topbar">
        <!-- LOGO -->
        <div class="topbar-left">
          <div class="text-center" style="margin-top: 25px;">
            <a href="<?php echo e(url('dashboard')); ?>" class="text-white" style="font-size: 1rem;">Security Head Office</a>
          </div>
        </div>
        <!-- Button mobile view to collapse sidebar menu -->

        <nav class="navbar navbar-default">
          <div class="container-fluid">
            <ul class="list-inline menu-left mb-0">
              <li class="float-left">
                <button class="button-menu-mobile open-left waves-light waves-effect">
                  <i class="mdi mdi-menu"></i>
                </button>
              </li>
            </ul>

            <ul class="nav navbar-right float-right list-inline">
              <li class="d-none d-sm-block">
                <a href="#" id="btn-fullscreen" class="waves-effect waves-light notification-icon-box"><i class="fas fa-expand"></i></a>
              </li>

              <li class="dropdown">
                <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
                  <img src="assets/images/users/avatar-1.jpg" alt="user-img" class="rounded-circle">
                  <span class="profile-username">
                    <?php echo e(auth()->user()->nama); ?> <span class="mdi mdi-chevron-down font-15"></span>
                  </span>
                </a>
                <ul class="dropdown-menu">
                  <li><a href="<?php echo e(url('logout')); ?>" class="dropdown-item"> Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </div>
      <!-- Top Bar End -->

      <!-- ========== Left Sidebar Start ========== -->

      <div class="left side-menu">
        <div class="sidebar-inner slimscrollleft">
          <div id="sidebar-menu">
            <ul>
              <li>
                <a href="<?php echo e(url('dashboard')); ?>" class="waves-effect"><i class="fas fa-home"></i><span> Dashboard </span></a>
              </li>
              <li>
                <a href="<?php echo e(url('soal')); ?>" class="waves-effect"><i class="fas fa-keyboard"></i><span> Soal </span></a>
              </li>
              <li>
                <a href="<?php echo e(url('hasil')); ?>" class="waves-effect"><i class="fas fa-file-alt"></i><span> Hasil Test </span></a>
              </li>
              <li>
                <a href="<?php echo e(url('lokasi_kerja')); ?>" class="waves-effect"><i class="fas fa-map-marked"></i><span> Lokasi Kerja</span></a>
              </li>
            </ul>
          </div>
          <div class="clearfix"></div>
        </div>
        <!-- end sidebarinner -->
      </div>
      <!-- Left Sidebar End -->

      <!-- Start right Content here -->

      <div class="content-page">
        <!-- Start content -->
        <div class="content">

          <div class="">
            <div class="page-header-title">
              <h4 class="page-title"><?php echo e($title); ?></h4>
            </div>
          </div>

          <div class="page-content-wrapper ">
            <div class="container-fluid">
              <?php echo $__env->yieldContent('content'); ?>
            </div>
            <!-- container-fluid -->
          </div>
          <!-- Page content Wrapper -->
        </div>
        <!-- content -->
        <footer class="footer">
          © <?php echo e(date('Y')); ?> Security Head Office</span>
        </footer>
      </div>
      <!-- End Right content here -->
    </div>
    <!-- END wrapper -->

    <script src="<?php echo e(asset('assets/js/app.js')); ?>"></script>
    <script src="<?php echo e(asset('scripts/secptmho.js')); ?>"></script>

  </body>

</html>
<?php /**PATH /home/u543412378/domains/secptmho.online/public_html/resources/views/template.blade.php ENDPATH**/ ?>
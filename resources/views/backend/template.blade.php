<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SI-MART - SMAN 1 BANGKO</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="icon" href="{{ asset('backend/assets/dist/img/smansabanko.png') }}">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <link href="https://fonts.googleapis.com/css2?family=Lobster+Two:ital@1&display=swap" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/assets/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('backend/assets/plugins/summernote/summernote-bs4.min.css')}}">

  <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/sweetalert/sweetalert2.min.css')}}">
  <script src="{{ asset('backend/assets/plugins/jquery/jquery.min.js')}}"></script>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="{{ asset('backend/assets/images/logo.jpg')}}" alt="AdminLTELogo" height="60" width="60">
    </div>

    <div class="wrapper">
      <!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
          </form>
          <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
          </a>
        </ul>
      </nav>

      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/home" class="brand-link">
          <img src="{{ asset('backend/assets/images/logo.jpg')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
          <span class="brand-text font-weight-light">SI-MART</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar user (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
              <img src="{{ asset(Auth::user()->foto) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
              <a href="{{ url('user/profil') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
          </div>
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <li class="nav-header">BERANDA</li>
              <li class="nav-item">
                <a href="/home" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-header">Profil Instansi</li>
              <li class="nav-item">
                <a href="{{ route('instansi.index') }}" class="nav-link">
                  <i class="nav-icon fas fa-home"></i>
                  <p>
                    Instansi
                  </p>
                </a>
              </li>
              <li class="nav-header">ARSIP</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Arsip Surat
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('suratmasuk.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Surat Masuk</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('suratkeluar.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Surat Keluar</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('klasifikasi.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Klasifikasi Surat</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    Agenda
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('suratmasuk.agenda') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Agenda Surat Masuk</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Agenda Surat Keluar</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-header">Lainnya</li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-cog"></i>
                  <p>
                    Setting
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('user.index') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Manajemen User</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('user/profil') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Profil</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ url('user/password') }}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Password</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>

      <div class="content-wrapper">

        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>@yield('sub-judul')</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">@yield('halaman-sekarang')</li>
                </ol>
              </div>
            </div>
          </div>
        </section>

        <section class="content">
          @yield('content')
        </section>
      </div>
    </div>

  </div>

  <script src="{{ asset('backend/assets/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
  <script src="{{ asset('backend/assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <script src="{{ asset('backend/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('backend/assets/dist/js/adminlte.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('backend/assets/dist/js/demo.js')}}"></script>

  <script src="{{ asset('backend/assets/plugins/datatables/jquery.dataTables.js')}}"></script>
  <script type="text/javascript" src="{{ asset('backend/assets/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
    })
  </script>

  <script type="text/javascript" src="{{ asset('backend/assets/sweetalert/sweetalert2.min.js')}}"></script>
  <script src="{{ asset('backend/assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#example2').DataTable();
    })
  </script>
</body>
</html>
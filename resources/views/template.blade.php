<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>@yield('sub-judul')</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('template/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('template/css/sb-admin-2.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="{{ asset('template/vendor/datatables/dataTables.bootstrap4.css') }}">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">{{ Auth::user()->name }}</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <li class="nav-item {{ Request::segment(1) == 'home' ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('home') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span>
        </a>
      </li>

      @if(Auth::user()->tipe == 1)
      <li class="nav-item {{ Request::segment(1) == 'instansi' ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('instansi') }}">
          <i class="fas fa-landmark"></i>
          <span>Instansi</span>
        </a>
      </li>
      @endif

      @if(Auth::user()->tipe == 1)
      <li class="nav-item {{ Request::segment(1) == 'klasifikasi' ? 'active' : '' }}">
        <a class="nav-link" href="{{ url('klasifikasi') }}">
          <i class="fas fa-landmark"></i>
          <span>Klasifikasi</span>
        </a>
      </li>
      @endif

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-envelope"></i>
          <span>Surat</span>
        </a>
        <div id="collapseTwo" class="collapse {{ request()->is('suratmasuk') || request()->is('suratkeluar') ? 'show' : '' }}" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->is('suratmasuk') ? 'active' : '' }}" href="{{ url('suratmasuk') }}">Surat Masuk</a>
            @if(Auth::user()->tipe == 1)
            <a class="collapse-item {{ request()->is('suratkeluar') ? 'active' : '' }}" href="{{ url('suratkeluar') }}">Surat Keluar</a>
          </div>
            @endif
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      @if(Auth::user()->tipe == 1)
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-copy"></i>
          <span>Agenda</span>
        </a>
        <div id="collapseUtilities" class="collapse {{ request()->is('suratmasuk/agenda') || request()->is('suratkeluar/agenda') ? 'show' : '' }}" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item {{ request()->is('suratmasuk/agenda') ? 'active' : '' }}" href="{{ url('suratmasuk/agenda') }}">Surat Masuk</a>
            <a class="collapse-item {{ request()->is('suratkeluar/agenda') ? 'active' : '' }}" href="{{ url('suratkeluar/agenda') }}">Surat Keluar</a>
          </div>
        </div>
      </li>
      @endif

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-cogs"></i>
          <span>Setting</span>
        </a>
        <div id="collapsePages" class="collapse {{ request()->is('user') || request()->is('user/profil') || request()->is('user/password') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            @if(Auth::user()->tipe == 1)
            <a class="collapse-item {{ request()->is('user') ? 'active' : '' }}" href="{{ url('user') }}">User</a>
            @endif
            <a class="collapse-item {{ request()->is('user/profil') ? 'active' : '' }}" href="{{ url('user/profil') }}">Profil</a>
            <a class="collapse-item {{ request()->is('user/password') ? 'active' : '' }}" href="{{ url('user/password') }}">Password</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ strtoupper(Auth::user()->name) }}</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
          <h1 class="h3 mb-4 text-gray-800">@yield('sub-judul')</h1>
          @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="{{ asset('template/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('template/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('template/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
  <script src="{{ asset('template/vendor/chart.js/Chart.min.js') }}"></script>
  <script src="{{ asset('template/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('template/js/demo/chart-pie-demo.js') }}"></script>
  <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
  <script>
    $(document).ready(function(){
      $('#example2').DataTable();
    })
  </script>

</body>

</html>

<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="index.html">Stisla</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">St</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li ><a class="nav-link" href="blank.html"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a></li>
              <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Setting</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('user.index') }}">Manajemen User</a></li>
                  <li><a class="nav-link" href="{{ url('user/profil') }}">Setting Profil</a></li>
                  <li><a class="nav-link" href="{{ url('user/password') }}">Password</a></li>
                </ul>
              </li>
            </ul>

        </aside>
      </div>

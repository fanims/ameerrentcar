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
    <li class="nav-item">
      <a class="nav-link btn-sm btm-danger" href="{{ route('admin.logout') }}" >
        Logout
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link btn-sm btm-primary" href="{{ route('admin.profile', Auth::user()->id) }}" >
        Profile
      </a>
    </li>
  </ul>
</nav>
<!-- /.navbar -->
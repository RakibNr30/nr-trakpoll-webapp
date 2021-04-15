  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.polls.index') }}" class="nav-link">Visit Survey</a>
      </li>
      {{-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> --}}
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" href="{{ Route('admin.profile') }}">
            <i class="fas fa-user"></i> My account
        </a>

      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="text-transform: capitalize;"> {{ Auth::guard('admin')->user()->name }}
          <i class="right fas fa-angle-down"></i>
        </a>
        @include('backend.partials.logout')
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

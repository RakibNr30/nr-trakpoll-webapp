  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('index') }}" class="nav-link">Visit Poll</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#"> My account
          <i class="fas fa-user"></i>
        </a>
        
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" style="text-transform: capitalize;"> {{ Auth::guard('web')->user()->fname }}
          <i class="right fas fa-angle-down"></i>
        </a>
        @include('frontend.pages.partials.logout')
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
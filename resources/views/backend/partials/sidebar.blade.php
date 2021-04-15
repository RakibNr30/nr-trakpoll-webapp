@php
$usr = Auth::guard('admin')->user();
@endphp
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ Route('admin.dashboard') }}" class="brand-link" style="text-align: center">
      <span class="brand-text font-weight-bold">TrakkPoll</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{URL::To('backend/img/user2-160x160.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{ Route('admin.dashboard') }}" class="d-block" style="text-transform: capitalize;">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @if ($usr->can('dashboard.view'))
          <li class="nav-item has-treeview">
            <a href="{{ Route('admin.dashboard') }} " class="nav-link {{ Route::is('admin.dashboard') ? 'active' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @endif

          @if ($usr->can('role.create') || $usr->can('role.view') ||  $usr->can('role.edit') ||  $usr->can('role.delete'))
          <li class="nav-item has-treeview {{ Route::is('admin.roles.create') || Route::is('admin.roles.index') || Route::is('admin.roles.edit') || Route::is('admin.roles.show') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-shield"></i>
              <p>  Roles & Permissions  <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if ($usr->can('role.create'))
              <li class="nav-item">
                <a href="{{ Route('admin.roles.create') }}" class="nav-link {{ Route::is('admin.roles.create')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Role</p>
                </a>
              </li>
              @endif
              @if ($usr->can('role.view'))
              <li class="nav-item">
                <a href="{{ Route('admin.roles.index') }}" class="nav-link {{ Route::is('admin.roles.index')  || Route::is('admin.roles.edit') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Roles</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if ($usr->can('admin.create') || $usr->can('admin.view') ||  $usr->can('admin.edit') ||  $usr->can('admin.delete'))
          <li class="nav-item has-treeview {{ Route::is('admin.admins.create') || Route::is('admin.admins.index') || Route::is('admin.admins.edit') || Route::is('admin.admins.show') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>  Admins  <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if ($usr->can('admin.create'))
              <li class="nav-item">
                <a href="{{ Route('admin.admins.create') }}" class="nav-link {{ Route::is('admin.admins.create')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Admin</p>
                </a>
              </li>
              @endif
              @if ($usr->can('admin.view'))
              <li class="nav-item">
                <a href="{{ Route('admin.admins.index') }}" class="nav-link {{ route::is('admin.admins.index')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Admin</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if ($usr->can('poll.create') || $usr->can('poll.view') ||  $usr->can('poll.edit') ||  $usr->can('poll.delete'))
          <li class="nav-item has-treeview {{ Route::is('admin.polls.create') || Route::is('admin.polls.index') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-poll"></i>
              <p>  Survey  <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if ($usr->can('poll.create'))
              <li class="nav-item">
                <a href="{{ route('admin.polls.create') }}" class="nav-link {{ route::is('admin.polls.create')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Create Survey</p>
                </a>
              </li>
              @endif
              @if ($usr->can('poll.view'))
              <li class="nav-item">
                <a href="{{ route('admin.polls.index') }}" class="nav-link {{ route::is('admin.polls.index')  ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Survey</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif
          <li class="nav-item has-treeview {{ Route::is('admin.users.create') || Route::is('admin.users.index') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
              <p>  User  <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @if ($usr->can('poll.view'))
              <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ route::is('admin.users.index')  ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                  <p>All User</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <li class="nav-item has-treeview {{ Route::is('admin.comment.index') ? 'menu-open' : '' }}">
            <a href="{{ route('admin.comment.index') }}" class="nav-link">
              <i class="nav-icon fas fa-poll"></i>
              <p> Comments </p>
            </a>
          </li>
          @if ($usr->can('app_setting.socialite'))
            <li class="nav-item has-treeview {{ Route::is('admin.socialite.index') ? 'menu-open' : '' }}">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-wrench"></i>
                <p>App Settings <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                @if ($usr->can('app_setting.socialite'))
                  <li class="nav-item">
                    <a href="{{ route('admin.socialite.index') }}" class="nav-link {{ route::is('admin.socialite.index')  ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Socialite</p>
                    </a>
                  </li>
                @endif
              </ul>
            </li>
        @endif
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

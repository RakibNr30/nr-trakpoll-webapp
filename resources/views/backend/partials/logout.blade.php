<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('admin.logout.submit') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('admin.logout.submit') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
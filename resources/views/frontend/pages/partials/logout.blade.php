<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
    <a class="dropdown-item" href="{{ route('logout.user') }}"
       onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>

    <form id="logout-form" action="{{ route('logout.user') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
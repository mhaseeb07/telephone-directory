<div class="d-flex justify-content-between shadow header-bg">
    <a class="nav-link p-3 toggle-sidebar"><i class="fa fa-bars"></i></a>
    <nav class="nav menu-dropdown">
        <ul class="nav align-items-center">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{asset('admin/images/user.png')}}" class="image" alt="User">
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="{{route('logout')}}">Sign out</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</div>

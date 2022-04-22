<nav class="sidebar">
    <nav class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <div class="user-info">
                    <div class="image">
                        <img src="{{asset('admin/images/user.png')}}" width="48" height="48" alt="User">
                    </div>
                    <div class="info-container">
                        <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
                        <div class="email">{{Auth::user()->email}}</div>
                    </div>
                </div>
            </li>
            <li class="main-navigation">
                Main Navigation
            </li>
            @can('dashboard')
                <li class="nav-item mt-2 waves-effect">
                    <a class="nav-link" aria-current="page" href="{{route('dashboard')}}">
                        <span>Home</span>
                    </a>
                </li>
            @endcan
            @canany(['permission-group-list','permission-group-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="permission_group" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Permission Group
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="permission_group">
                        @can('permission-group-create')
                            <li><a class="dropdown-item" href="{{route('permission_group.create')}}">Add New</a></li>
                        @endcan
                        @can('permission-group-list')
                            <li><a class="dropdown-item" href="{{route('permission_group.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['permission-list','permission-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="permission" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Permission
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="permission">
                        @can('permission-create')
                            <li><a class="dropdown-item" href="{{route('permission.create')}}">Add New</a></li>
                        @endcan
                        @can('permission-list')
                            <li><a class="dropdown-item" href="{{route('permission.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['role-list','role-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="permission" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Role
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="permission">
                        @can('role-create')
                            <li><a class="dropdown-item" href="{{route('role.create')}}">Add New</a></li>
                        @endcan
                        @can('role-list')
                            <li><a class="dropdown-item" href="{{route('role.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['user-list','user-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="user" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Users
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="user">
                        @can('user-create')
                            <li><a class="dropdown-item" href="{{route('user.create')}}">Add New</a></li>
                        @endcan
                        @can('user-list')
                            <li><a class="dropdown-item" href="{{route('user.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['department-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="department" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Department
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="department">
                        @can('department-create')
                            <li><a class="dropdown-item" href="{{route('department.create')}}">Add New / View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['contact-info-list','contact-info-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="contact-info" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Contact Information
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="contact-info">
                        @can('contact-info-create')
                            <li><a class="dropdown-item" href="{{route('contact-info.create')}}">Add New</a></li>
                        @endcan
                        @can('contact-info-list')
                            <li><a class="dropdown-item" href="{{route('contact-info.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
            @canany(['category-create'])
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle waves-effect" href="#" id="category" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span>
                    Category
                </span>
                    <i class="fa fa-plus"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="category">
                    @can('category-create')
                        <li><a class="dropdown-item" href="{{route('category.create')}}">Add New / View All</a></li>
                    @endcan
                </ul>
            </li>
        @endcanany
            @canany(['reminder-list','reminder-create'])
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect" href="#" id="reminder" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>
                        Reminder
                    </span>
                        <i class="fa fa-plus"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="reminder">
                        @can('reminder-create')
                            <li><a class="dropdown-item" href="{{route('reminder.create')}}">Add New</a></li>
                        @endcan
                        @can('reminder-list')
                            <li><a class="dropdown-item" href="{{route('reminder.index')}}">View All</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany
        </ul>
    </nav>
</nav>

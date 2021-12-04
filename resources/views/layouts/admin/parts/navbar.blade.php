<header class="app-header" style="background: #222d32">
    <a class="app-header__logo" href="{{ route("admin.dashboard.index") }}">
        <h1 class="site-logo">Wallet</h1></a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fas fa-bars"></i></a>
    <!-- Navbar Right Menu-->
    <ul class="app-nav">


        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>

            <ul class="dropdown-menu settings-menu">
                <li><a class="dropdown-item" href="#"><i class="fa fa-user fa-lg"></i> Profile</a></li>

                <li><a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();"><i class="fa fa-sign-out fa-lg"></i> Logout</a>
                </li>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </li>

    </ul>

</header>

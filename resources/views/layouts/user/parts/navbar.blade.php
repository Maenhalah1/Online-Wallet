<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Wallet</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset("assets/css/main.css")}}">


    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/lib/all.min.css')}}">

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/transaction">Transaction</a>
            </li>
            <li class="nav-item dropdown" id="CurrenciesDropdownBox">

            </li>
        </ul>
        <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            </a>
            <ul class="dropdown-menu settings-menu dropdown-menu-right">
                <li><a class="dropdown-item" href="#"><i class="fa fa-user fa-lg"></i> Profile</a></li>

                <li>
                    <form id="logoutForm" action="/api/logout" method="POST" >
                        <input type="submit" class="dropdown-item" href="#" value="Logout">
                    </form>

                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="app-sidebar__overlay" data-toggle="sidebar"></div>
<aside class="app-sidebar">
    <a class="app-sidebar__logo" href="{{ route("admin.dashboard.index") }}">
        <h1 class="site-logo text-center full">Wallet</h1>
        <h1 class="site-logo small">W</h1>
    </a>
    <div class="app-sidebar__user">
        <div>
            <p class="app-sidebar__user-name">{{auth()->user()->name}}</p>
            <p class="app-sidebar__user-name" style="font-size: 14px; color: #f2f2f2">{{__("Admin")}}</p>
        </div>
    </div>
    <ul class="app-menu">

        <li><a class="app-menu__item @if(request()->routeIs("admin.dashboard.index")) active @endif" href="{{route("admin.dashboard.index")}}"><i class="app-menu__icon fas fa-tachometer-alt"></i><span class="app-menu__label">{{__("Dashboard")}}</span></a></li>
        <li><a class="app-menu__item @if(request()->routeIs("admin.user.*")) active @endif" href="{{route("admin.user.index")}}"><i class="app-menu__icon fas fa-users"></i><span class="app-menu__label">{{__("Users")}}</span></a></li>
        <li><a class="app-menu__item @if(request()->routeIs("admin.currency.*")) active @endif" href="{{route("admin.currency.index")}}"><i class="app-menu__icon fas fa-dollar-sign"></i><span class="app-menu__label">{{__("Currencies")}}</span></a></li>
        <li><a class="app-menu__item @if(request()->routeIs("admin.payment_method.*")) active @endif" href="{{route("admin.payment_method.index")}}"><i class="app-menu__icon fas fa-money-bill"></i><span class="app-menu__label">{{__("Payment Methods")}}</span></a></li>
        <li><a class="app-menu__item @if(request()->routeIs("admin.transaction.*")) active @endif" href="{{route("admin.transaction.index")}}"><i class="app-menu__icon fas fa-bezier-curve"></i><span class="app-menu__label">{{__("Transactions")}}</span></a></li>
    </ul>
</aside>

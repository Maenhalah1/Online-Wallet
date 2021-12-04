@extends("layouts.admin.app")
@section("page-title")
    Dashboard
@endSection
@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        </ul>
    </div>
@endsection

@section("content")

    <div class="row">
        <div class="col-md-6 col-lg-3">
            <div class="widget-small primary coloured-icon"><i class="icon fa fa-users fa-3x"></i>
                <div class="info">
                    <h4>Users</h4>
                    <p><b>{{$counters->usersCount}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small info coloured-icon"><i class="icon fa fa-bezier-curve fa-3x"></i>
                <div class="info">
                    <h4>Transactions</h4>
                    <p><b>{{$counters->transactionsCount}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-money-bill fa-3x"></i>
                <div class="info">
                    <h4>Payment Methods</h4>
                    <p><b>{{$counters->paymentMethodsCount}}</b></p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-3">
            <div class="widget-small danger coloured-icon"><i class="icon fas fa-dollar-sign fa-3x"></i>
                <div class="info">
                    <h4>Total Wallets Amounts</h4>
                    <p><b>${{$counters->walletsTotalAmount}}</b></p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")

@endsection

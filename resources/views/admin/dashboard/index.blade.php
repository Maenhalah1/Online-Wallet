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
    <div class="row">
        <div class="col-lg-12">
            <canvas id="transactionChart"></canvas>
        </div>
    </div>

@endsection

@section("scripts")
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const months = Object.values(JSON.parse('{!! $months !!}'))
        const deposit = Object.values(JSON.parse('{!! $deposit !!}'))
        const withdrawal = Object.values(JSON.parse('{!! $withdrawal !!}'))

        const data = {
            labels: months,
            datasets: [{
                label: 'Deposit',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: deposit,
            },
                {
                    label: 'Withdrawal',
                    backgroundColor: 'rgb(99,161,255)',
                    borderColor: 'rgb(99,125,255)',
                    data: withdrawal,
                }]
        };
        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Transactions Chart'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true
                        }
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Value'
                        },
                    }
                }
            },
        };

        const myChart = new Chart(
            document.getElementById('transactionChart'),
            config
        );
    </script>

@endsection

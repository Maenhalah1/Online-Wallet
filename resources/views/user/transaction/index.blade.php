@extends("layouts.user.app")
@section("page-title")
    Home
@endSection
@section("header-resources")
    <style>
        .card.link{cursor: pointer}
        .card.link:hover{border: 1px solid var(--primary)}
        .card.link .image-box {width: 120px; margin: auto}
        .card.link .image-box img{max-width: 100px; text-align: center}
        #Transaction .status.waiting {color: #d79d0b}
        #Transaction .status.accepted {color: #0a7c01}
        #Transaction .status.rejected {color: #ad0005}

    </style>
    <script type="module" src="{{asset("assets/js/utils/authentication.js")}}"></script>
    <script type="module" src="{{asset("assets/js/pages/user/transaction.js")}}"></script>
@endsection
@section("content")

{{--    <div class="row">--}}
{{--        <div class="col-lg-4 m-auto">--}}
{{--            <div class="card text-center">--}}
{{--                <div class="card-header">--}}
{{--                    <h5>Total Amount In My Wallet</h5>--}}
{{--                </div>--}}
{{--                <div class="card-body">--}}
{{--                    <h2 class="card-title">500 JD</h2>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="card text-center">
                <div class="card-header">
                    <h5>Create Transaction</h5>
                </div>
                <div class="card-body">
                    <div class="row" id="CreateTransactionBox">
                        <div class="col-lg-3 mb-3 transaction-type" data-type="d">
                            <div class="card link text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Deposit</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 mb-3 transaction-type" data-type="w">
                            <div class="card link text-center">
                                <div class="card-body">
                                    <h5 class="card-title">Withdrawal</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-lg-10 m-auto">
            <div class="card text-center">
                <div class="card-header">
                    <h5>Transactions</h5>
                </div>
                <div class="card-body">
                    <div class="col-lg-12 mt-3"  id="TransactionsBox">

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section("scripts")

@endsection

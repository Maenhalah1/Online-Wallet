@extends("layouts.user.app")
@section("page-title")
    Home
@endSection
@section("header-resources")
    <script type="module" src="{{asset("assets/js/utils/authentication.js")}}"></script>
    <script type="module" src="{{asset("assets/js/pages/user/home.js")}}"></script>
@endsection
@section("content")

    <div class="row" id="WalletBox">

    </div>


@endsection

@section("scripts")

    <script>

    </script>
@endsection

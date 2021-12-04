@extends("layouts.admin.app")
@section("page-title")
    {{__("Technicians")}}
@endSection
@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i>{{__("Users")}}</h1>
            <p>{{__("All Users")}}</p>
        </div>

        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">{{__("Dashboard")}}</a></li>
            <li class="breadcrumb-item"><a href="{{route("admin.user.index")}}">{{__("Users")}}</a></li>

        </ul>
    </div>
@endsection

@section("content")
    @include("includes.dialog")

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center" id="sampleTable">
                            <thead>
                            <tr>
                                <th>{{__("ID")}}</th>
                                <th>{{__("Profile Photo")}}</th>
                                <th>{{__("Name")}}</th>
                                <th>{{__("Username")}}</th>
                                <th>{{__("Total Amount In Wallet")}}</th>
                                <th>{{__("Email")}}</th>
                                <th>{{__("Activation")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{$user->id}}</td>
                                    <td>@if($user->getFirstMedia('profile_photo')) <img src="{{ $user->getFirstMedia('profile_photo')->url}}" alt="" width="50px">@endif</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>{{$user->wallet->total_amount}}</td>
                                    <td>{{$user->email}}</td>
                                    <td class="text-center">
                                        <div class="toggle-flip">
                                            <label>
                                                <input type="checkbox" class="checked-action change-activation" data-id="{{$user->id}}" @if($user->activation) checked @endif><span class="flip-indecator" data-toggle-on="ON" data-toggle-off="OFF"></span>
                                            </label>
                                        </div>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")

    <!-- Data table plugin-->
    <script type="text/javascript" src="{{asset("assets/js/plugins/jquery.dataTables.min.js")}}"></script>
    <script type="text/javascript" src="{{asset("assets/js/plugins/dataTables.bootstrap.min.js")}}"></script>
    <script type="text/javascript">$('#sampleTable').DataTable();</script>
    <script type="module" src="{{asset("assets/js/pages/admin/user.js")}}"></script>

@endsection

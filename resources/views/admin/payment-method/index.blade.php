@extends("layouts.admin.app")
@section("page-title")
    {{__("Dashboard")}}
@endSection
@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Payment Methods</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Payment Methods</a></li>
        </ul>
    </div>
@endsection
@section("header-resources")
    <style>
        .currency-code{
            border: 1px solid #ddd;
            background: #ededed;
            padding: 4px;
            font-weight: bold;
            margin-right: 1px;
            color: #333
        }
    </style>
@endsection

@section("content")
    @include("includes.dialog")

    <div class="row">
        <div class="col-md-12">
            <div class="buttons-group">
                <a href="{{route("admin.payment_method.create")}}" class="btn btn-primary"><i class="fas fa-plus"></i> Create Payment Method</a>
            </div>
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center" id="sampleTable">
                            <thead>
                            <tr>
                                <th>{{__("ID")}}</th>
                                <th>{{__("Icon")}}</th>
                                <th>{{__("Name")}}</th>
                                <th>{{__("Min Deposit")}}</th>
                                <th>{{__("Max Deposit")}}</th>
                                <th>{{__("Min Withdrawal")}}</th>
                                <th>{{__("Max Withdrawal")}}</th>
                                <th>{{__("Currency Supported")}}</th>
                                <th>{{__("Control")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($paymentMethods as $paymentMethod)
                                <tr>
                                    <td>{{$paymentMethod->id}}</td>
                                    <td>@if($paymentMethod->getFirstMedia('icon')) <img src="{{ $paymentMethod->getFirstMedia('icon')->url}}" alt="" width="50px">@endif</td>
                                    <td>{{$paymentMethod->name}}</td>
                                    <td>{{$paymentMethod->min_deposit}}</td>
                                    <td>{{$paymentMethod->max_deposit}}</td>
                                    <td>{{$paymentMethod->min_withdrawal}}</td>
                                    <td>{{$paymentMethod->max_withdrawal}}</td>
                                    <td style="width: 120px">@foreach($paymentMethod->currencies as $currency) <span class="currency-code">{{$currency->code}}</span> @endforeach</td>

                                    <td>
                                        <a href="{{route("admin.payment_method.edit", $paymentMethod->id)}}" class="control-link edit"><i class="fas fa-edit"></i></a>
                                        <form action="{{route("admin.payment_method.destroy", $paymentMethod->id)}}" method="post" id="delete{{$paymentMethod->id}}" style="display: none" data-swal-title="{{__("Delete Payment Method")}}" data-swal-text="{{__("Are You Sure To Delete This Payment Method?")}}" data-yes="{{__("Yes")}}" data-no="{{__("No")}}" data-success-msg="{{__("the payment method has been deleted succssfully")}}">@csrf @method("delete")</form>
                                        <span href="#" class="control-link remove form-confirm" data-form-id="#delete{{$paymentMethod->id}}"><i class="far fa-trash-alt"></i></span>
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

@endsection

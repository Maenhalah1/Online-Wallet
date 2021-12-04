@extends("layouts.admin.app")
@section("page-title")
    {{__("Dashboard")}}
@endSection
@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Transactions</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Transactions</a></li>
        </ul>
    </div>
@endsection
@section("header-resources")
    <style>
        .transaction-status{
            padding: 4px 10px;
            border-radius: 5px;
            font-weight: 600;
            font-size: 13px;
        }
        .transaction-status.waiting{background: #999;color: #fff}
        .transaction-status.approved{background: #217e00;color: #fff}
        .transaction-status.rejected{background: #7e0000;color: #fff}

    </style>
@endsection
@section("content")
    @include("includes.dialog")

    <div class="row">
        <div class="col-md-12">
            <form action="{{route("admin.transaction.filter")}}" method="get">
                <div class="tile">
                    <div class="tile-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Status</label>
                                    <select class="form-control" name="status">
                                        <option value="all">All</option>
                                        <option value="-1"  @if(request()->get("status") === '-1') selected @endif>Waiting</option>
                                        <option value="1"   @if(request()->get("status") === '1') selected @endif>Approved</option>
                                        <option value="0"   @if(request()->get("status") === '0') selected @endif>Rejected</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label class="control-label">Type</label>
                                    <select class="form-control" name="type">
                                        <option value="all">All</option>
                                        <option value="d" @if(request()->get("type") === 'd') selected @endif>Deposit</option>
                                        <option value="w" @if(request()->get("type") === 'w') selected @endif>Withdrawal</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Filter</button>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered text-center" id="sampleTable">
                            <thead>
                            <tr>
                                <th>{{__("ID")}}</th>
                                <th>{{__("User")}}</th>
                                <th>{{__("Type")}}</th>
                                <th>{{__("Amount")}}</th>
                                <th>{{__("Status")}}</th>
                                <th>{{__("At")}}</th>
                                <th>{{__("Control")}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{$transaction->id}}</td>
                                    <td>{{$transaction->user->username}}</td>
                                    <td>{{$transaction->type == 'd'? 'Deposit' : "Withdrawal"}}</td>
                                    <td>${{$transaction->amount}}</td>
                                    <td class="status">
                                        @switch($transaction->status)
                                            @case(-1)
                                                <span class="transaction-status waiting">Waiting</span>
                                            @break
                                            @case(1)
                                                <span class="transaction-status approved">Approved</span>
                                            @break
                                            @case(0)
                                                <span class="transaction-status rejected">Rejected</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>{{date("Y-M-j | g:i A",strtotime($transaction->created_at))}}</td>

                                    <td>
                                        @if($transaction->status == -1)
                                            <span href="#" class="btn btn-success status-button accept-transaction" data-id="{{$transaction->id}}" ><i class="far fa-check-circle"></i> Accept</span>
                                            <span href="#" class="btn btn-danger status-button reject-transaction" data-id="{{$transaction->id}}" ><i class="far fa-times-circle"></i> Reject</span>
                                        @endif
                                        <form action="{{route("admin.transaction.destroy", $transaction->id)}}" method="post" id="delete{{$transaction->id}}" style="display: none" data-swal-title="{{__("Delete Transaction")}}" data-swal-text="{{__("Are You Sure To Delete This Transaction?")}}" data-yes="{{__("Yes")}}" data-no="{{__("No")}}" data-success-msg="{{__("the transaction has been deleted successfully")}}">@csrf @method("delete")</form>
                                        <span href="#" class=" remove form-confirm btn btn-danger" data-form-id="#delete{{$transaction->id}}"><i class="far fa-trash-alt"></i> Delete</span>
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
    <script type="module" src="{{asset("assets/js/pages/admin/transaction.js")}}"></script>

@endsection

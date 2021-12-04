@extends("layouts.admin.app")
@section("page-title")
    {{__("Dashboard")}}
@endSection
@section("page-nav-title")
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Currencies</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{{route("admin.payment_method.index")}}">Payment Methods</a></li>
            <li class="breadcrumb-item"><a href="#">{{$paymentMethod->name}}</a></li>
            <li class="breadcrumb-item"><a href="#">Edit</a></li>

        </ul>
    </div>
@endsection

@section("content")

    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="tile">
                <h3 class="tile-title">Edit Payment Method</h3>
                <div class="tile-body">
                    <form method="post" action="{{route("admin.payment_method.update", $paymentMethod->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method("put")
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Payment Method Name</label>
                                    <input class="form-control @if($errors->has('name')) is-invalid @endif" type="text" name="name" value="{{inputValue("name", $paymentMethod)}}">
                                </div>
                                @error("name")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Support Currencies</label>
                                    <select class="form-control" name="currencies[]" id="CurrenciesSelect" multiple="" >
                                        <optgroup label="Select Currencies">
                                            @foreach($currencies as $currency)
                                                <option value="{{$currency->id}}" {{isset($currenciesSelected[$currency->id]) ? "selected" : ""}}>{{$currency->code}}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                                @error("currencies")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Min Deposit</label>
                                    <input class="form-control @if($errors->has('min_deposit')) is-invalid @endif" type="text" name="min_deposit" value="{{inputValue("min_deposit", $paymentMethod)}}">
                                </div>
                                @error("min_deposit")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Max Deposit</label>
                                    <input class="form-control @if($errors->has('max_deposit')) is-invalid @endif" type="text" name="max_deposit" value="{{inputValue("max_deposit", $paymentMethod)}}">
                                </div>
                                @error("max_deposit")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Min Withdrawal</label>
                                    <input class="form-control @if($errors->has('min_withdrawal')) is-invalid @endif" type="text" name="min_withdrawal" value="{{inputValue("min_withdrawal", $paymentMethod)}}">
                                </div>
                                @error("min_withdrawal")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Max Withdrawal</label>
                                    <input class="form-control @if($errors->has('max_withdrawal')) is-invalid @endif" type="text" name="max_withdrawal" value="{{inputValue("max_withdrawal", $paymentMethod)}}">
                                </div>
                                @error("max_withdrawal")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Icon</label>
                                    <div>
                                        <button class="btn btn-primary form-control button-upload-file" >
                                            <input class="input-file show-uploaded" data-upload-type="single" data-imgs-container-class="uploaded-images" type="file" name="icon">
                                            <span class="upload-file-content">
                                                <i class="fas fa-upload fa-lg upload-file-content-icon left"></i>
                                                <span class="upload-file-content-text">{{__("Upload Photo")}}</span>
                                            </span>
                                        </button>
                                    </div>
                                </div>
                                @error("icon")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-3 col-md-5 col-sm-6">
                                <div class="uploaded-images" style="margin-bottom: 20px;">
                                    <div class="img-container">
                                        <img src="{{ $paymentMethod->getFirstMedia('icon')->url }}" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tile-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i> Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section("scripts")
    <script type="text/javascript" src="{{asset("assets/js/plugins/select2.min.js")}}"></script>
    <script>
        $('#CurrenciesSelect').select2();
    </script>
@endsection

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
            <li class="breadcrumb-item"><a href="{{route("admin.currency.index")}}">Currencies</a></li>
            <li class="breadcrumb-item"><a href="#">Create</a></li>

        </ul>
    </div>
@endsection

@section("content")

    <div class="row">
        <div class="col-lg-10 m-auto">
            <div class="tile">
                <h3 class="tile-title">Create Currency</h3>
                <div class="tile-body">
                    <form method="post" action="{{route("admin.currency.store")}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Currency Name</label>
                                    <input class="form-control @if($errors->has('name')) is-invalid @endif" type="text" name="name" value="{{inputValue("name")}}">
                                </div>
                                @error("name")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Currency Code</label>
                                    <input class="form-control @if($errors->has('code')) is-invalid @endif" type="text" name="code" value="{{inputValue("code")}}">
                                </div>
                                @error("code")
                                <div class="input-error">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label class="control-label">Difference In Dollar</label>
                                    <input class="form-control @if($errors->has('difference_in_dollar')) is-invalid @endif" type="text" name="difference_in_dollar" value="{{inputValue("difference_in_dollar")}}">
                                </div>
                                @error("difference_in_dollar")
                                    <div class="input-error">{{$message}}</div>
                                @enderror
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


@endsection

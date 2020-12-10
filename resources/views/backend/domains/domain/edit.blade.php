@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Edit Domain </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('domain.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Domain</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Edit Domain</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('domain.update',$domains->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Client Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Client Name" name="client_name" value="{{$domains->client_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Domain Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder=" Domain Name" name="domain_name" value="{{$domains->domain_name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Contact Info <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Contact Info" name="contact_info" value="{{$domains->contact_info}}">
                            </div>
                        </div>
{{--                        <div class="form-group row">--}}
{{--                            <label class="control-label col-md-3 text-right"> Code No <span style="color: red">*</span></label>--}}
{{--                            <div class="col-md-8">--}}
{{--                                <input class="form-control" type="text" placeholder="Code No" name="code_no" value="{{$domains->code_no}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Amount <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Amount" name="amount" value="{{$domains->amount}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Date <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="datepicker form-control" type="text" value="{{$domains->expire_date}}" name="expire_date">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Customers</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tile-footer">
                </div>
            </div>
        </div>
    </main>
@endsection



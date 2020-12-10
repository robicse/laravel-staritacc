@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Edit Domain-Renew </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('domain.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Domain-Renew </a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Edit Domain-Renew</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('domain-renew.update',$domain_renews->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Code No<span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <select name="domain_id" id="domain_id" class="form-control select2" required>
                                    <option value="">Select One</option>
                                    @foreach($domains as $domain )
                                        <option value="{{$domain->id}}" {{ $domain->id == $domain_renews->domain_id ? 'selected' : '' }}>{{$domain->code_no}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Date <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="datepicker form-control" type="text" value="{{$domain_renews->domain->expire_date}}" name="expire_date">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Domain Renew Date <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="datepicker form-control" type="text" name="renew_date" value="{{$domain_renews->renew_date}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Domain Expired Date <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="datepicker form-control" type="text" name="expired_date" value="{{$domain_renews->expired_date}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Remarks <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <textarea class="form-control" type="text" name="remarks" rows="3"> {{$domain_renews->remarks}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Domain-Renew </button>
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



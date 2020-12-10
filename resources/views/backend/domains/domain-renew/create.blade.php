@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Add Domain </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('domain-renew.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Domain-Renews</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Domain-Renews</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                        <form method="post" action="{{ route('domain-renew.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label class="control-label col-md-3 text-right">Code No<span style="color: red">*</span></label>
                                <div class="col-md-8">
                                    <select name="domain_id" id="domain_id" class="form-control select2" required>
                                        <option value="">Select One</option>
                                        @foreach($domains as $domain )
                                            <option value="{{$domain->id}}">{{$domain->code_no}} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 text-right">Domain Renew Date <span style="color: red">*</span></label>
                                <div class="col-md-8">
                                    <input class="datepicker form-control" type="text" name="renew_date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 text-right">Domain Expired Date <span style="color: red">*</span></label>
                                <div class="col-md-8">
                                    <input class="datepicker form-control" type="text" name="expired_date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label col-md-3 text-right">Remarks <span style="color: red">*</span></label>
                                <div class="col-md-8">
                                    <textarea class="form-control" type="text"  name="remarks" rows="3"></textarea>
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



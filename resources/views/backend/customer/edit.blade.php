@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Edit Customers </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('customer.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Customers</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Edit Customers</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('customer.update',$custmers->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">  Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Name" name="name" value="{{$custmers-> name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Email <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Email" name="email" value="{{$custmers-> email }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Phone <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Phone" name="phone" value="{{$custmers-> phone }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Address <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Address" name="address" value="{{$custmers-> address }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Status <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="0" {{$custmers->status == 0 ? 'selected' : ' ' }} >Active</option>
                                    <option value="1" {{$custmers->status == 1 ? 'selected' : ' '   }}>Inactive</option>
                                </select>
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




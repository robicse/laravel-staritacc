@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Add Service Provider </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('serviceProvider.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Service Provider</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Service Provider</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('serviceProvider.update',$serviceProviders->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Service Provider Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" placeholder="Name" name="name" value="{{$serviceProviders->name}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Service Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <select name="service_id" id="service_id" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach($services as $service)
                                        <option value="{{$service->id}}" {{$serviceProviders->service_id == $service->id ? 'selected' : ''}} {{$serviceProviders}}>{{$service->name}}</option>
                                    @endforeach()
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Cost <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control{{ $errors->has('cost') ? ' is-invalid' : '' }}" type="text" placeholder="Cost" name="cost" value="{{$serviceProviders->cost}}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Status <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <select name="status" id="status" class="form-control">
                                    <option value="">Select One</option>
                                    <option value="0" {{$serviceProviders->status == 0 ? 'selected' : ''}}>Active</option>
                                    <option value="1" {{$serviceProviders->status == 1 ? 'selected' : ''}}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Address <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" placeholder="Address" name="address" value="{{$serviceProviders->address}}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Service Provider</button>
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



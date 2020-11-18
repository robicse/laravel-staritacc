@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Add Service </h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('service.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Service</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Service</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('service.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Service Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" placeholder="Name" name="name">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Category Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <select name="service_category_id" id="service_category_id" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Unit <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <select name="service_unit_id" id="service_unit_id" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach($units as $unit)
                                        <option value="{{$unit->id}}">{{$unit->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Sub Category Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <select name="service_sub_category_id" id="service_sub_category_id" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach($subCategories as $subCategory)
                                        <option value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach()
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Image <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input type="file" id="image" name="image" class="form-control-file">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Description</label>
                            <div class="col-md-8">
                                <textarea rows="4" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" type="text" placeholder="description" name="description"> </textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Service</button>
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



@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Add Service Sub Category</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('serviceSubCategory.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Service Sub Category</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Service Sub Category</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('serviceSubCategory.update',$subCategories->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Service sub Category Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" placeholder="Name" name="name" value="{{$subCategories->name}}">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Service Category Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <select name="service_category_id" id="service_category_id" class="form-control">
                                    <option value="">Select One</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{$category->id == $subCategories->service_category_id ? 'selected' : ''}}>{{$category->name}}</option>
                                    @endforeach()
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Service Sub Category</button>
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



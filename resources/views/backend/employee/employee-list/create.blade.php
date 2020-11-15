@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i>Create Employee</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('employee.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Employee</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Employee</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('employee.store') }}">
                        @csrf
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Name <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Name" name="name">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Address <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Address" name="address">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Mobile No <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Mobile No" name="phone">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Designation <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Designation " name="designation">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right"> Gross Salary <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Gross Salary " name="gross_salary">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Basic Salary <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Basic Salary " name="basic_salary">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3 text-right">Per Day Salary <span style="color: red">*</span></label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" placeholder="Per Day Salary " name="per_day_salary">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-md-3"></label>
                            <div class="col-md-8">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Employee</button>
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



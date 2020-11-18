@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Employee</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('employee.create') !!}" class="btn btn-sm btn-primary" type="button">Add Employee</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th width="10%">Name</th>
                        <th width="10%">Phone</th>
                        <th width="10%">Address</th>
                        <th width="15%">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employees as $key => $employee)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $employee->name}}</td>
                        <td>{{ $employee->phone}}</td>
                        <td>{{ $employee->address}}</td>
                        <td>
                            <a href="{{ route('employee.edit',$employee->id) }}" class="btn btn-sm btn-primary float-left"><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{ route('employee.destroy',$employee->id) }}" >
                               @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('You Are Sure This Delete !')"><i class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="tile-footer">
                </div>
            </div>

        </div>
    </main>
@endsection



@extends('backend._partial.dashboard')

@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> All Employee Salary</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item"> <a href="{!! route('employee-salary.create') !!}" class="btn btn-sm btn-primary" type="button">Add Employee Salary</a></li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">

                <h3 class="tile-title">Employee Salary Table</h3>
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped">

                    <thead>
                    <tr>
                        <th width="5%">#Id</th>
                        <th>Employee name</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Net Payable Salary</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($employeeSalaries as $key => $employeeSalary)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $employeeSalary->employee->name}}</td>
                        <td>{{ $employeeSalary->month}}</td>
                        <td>{{ $employeeSalary->year}}</td>
                        <td>{{ $employeeSalary->net_payable_salary}}</td>
                        <td>
{{--                            <a href="{{ route('expenses.show',$expense->id) }}" class="btn btn-sm btn-info float-left">Show</a>--}}
                            <a href="{{ route('employee-salary.edit',$employeeSalary->id) }}" class="btn btn-sm btn-primary float-left"><i class="fa fa-edit"></i></a>
                            <form method="post" action="{{ route('employee-salary.destroy',$employeeSalary->id) }}" >
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

        </div>
    </main>
@endsection



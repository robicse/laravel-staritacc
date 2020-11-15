@extends('backend._partial.dashboard')
<style>
    .requiredCustom{
        font-size: 20px;
        color: red;
        margin-top: 20px;
    }
</style>
@section('content')
    <main class="app-content">
        <div class="app-title">
            <div>
                <h1><i class=""></i> Edit Employee Salary</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('employee-salary.index') }}" class="btn btn-sm btn-primary col-sm" type="button">All Employee Salary</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Edit Employee Salary</h3>
                <div class="tile-body tile-footer">
                    @if(session('response'))
                        <div class="alert alert-success">
                            {{ session('response') }}
                        </div>
                    @endif
                        <form class="row" method="post" action="{{ route('employee-salary.update',$employeeSalaries->id) }}">
                            @method('PUT')
                            @csrf
                            <div class="form-group col-md-3">
                                <label class="control-label">Employee Name </label>
                                <select name="employee_id" id="employee_id" class="form-control select2" onchange="getval(1,this);" required>
                                    <option value="">Select One</option>
                                    @foreach($employees as $employee)
                                        <option value="{{$employee->id}}" {{$employee->id==$employeeSalaries->employee_id ? 'selected' : ''}} >{{$employee->name}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Designation</label>
                                <input class="form-control" type="text" name="designation" placeholder="Designation" value="{{$employeeSalaries->designation}}"  id="designation" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Gross Salary</label>
                                <input type="text" name="gross_salary" id="gross_salary" value="{{$employeeSalaries->gross_salary}}" class="form-control" placeholder="Gross Salary" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Basic Salary</label>
                                <input type="text" name="basic_salary" id="basic_salary"  value="{{$employeeSalaries->basic_salary}}" class="form-control" placeholder="Basic Salary" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Per Day Salary</label>
                                <input type="text" name="per_day_salary" id="per_day_salary" value="{{$employeeSalaries->per_day_salary}}" class="form-control" placeholder="Per Day Salary" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Month</label>
                                <select name="month" id="month" class="form-control select2" required>
                                    <option value="">Select One</option>
                                    <option value="January" {{$employeeSalaries->month == "January" ? 'selected' : ''}}> January</option>
                                    <option value="February" {{$employeeSalaries->month == "February" ? 'selected' : ''}}> February</option>
                                    <option value="March" {{$employeeSalaries->month == "March" ? 'selected' : ''}}> March</option>
                                    <option value="April" {{$employeeSalaries->month == "April" ? 'selected' : ''}}> April</option>
                                    <option value="May" {{$employeeSalaries->month == "May" ? 'selected' : ''}}> May</option>
                                    <option value="June" {{$employeeSalaries->month == "June" ? 'selected' : ''}}> June</option>
                                    <option value="July" {{$employeeSalaries->month == "July" ? 'selected' : ''}}> July</option>
                                    <option value="August" {{$employeeSalaries->month == "August" ? 'selected' : ''}}> August</option>
                                    <option value="September" {{$employeeSalaries->month == "September" ? 'selected' : ''}}> September</option>
                                    <option value="October" {{$employeeSalaries->month == "October" ? 'selected' : ''}}> October</option>
                                    <option value="November" {{$employeeSalaries->month == "November" ? 'selected' : ''}}> November</option>
                                    <option value="December" {{$employeeSalaries->month == "December" ? 'selected' : ''}}> December</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Year</label>
                                <select name="year" id="year" class="form-control select2" required>
                                    <option value="">Select One</option>
                                    <option value="2010" {{$employeeSalaries->year == "2010" ? 'selected' : ''}}> 2010</option>
                                    <option value="2011" {{$employeeSalaries->year == "2011" ? 'selected' : ''}}> 2011</option>
                                    <option value="2012" {{$employeeSalaries->year == "2012" ? 'selected' : ''}}> 2012</option>
                                    <option value="2013" {{$employeeSalaries->year == "2013" ? 'selected' : ''}}> 2013</option>
                                    <option value="2014" {{$employeeSalaries->year == "2014" ? 'selected' : ''}}> 2014</option>
                                    <option value="2015" {{$employeeSalaries->year == "2015" ? 'selected' : ''}}> 2015</option>
                                    <option value="2016" {{$employeeSalaries->year == "2016" ? 'selected' : ''}}> 2016</option>
                                    <option value="2017" {{$employeeSalaries->year == "2017" ? 'selected' : ''}}> 2017</option>
                                    <option value="2018" {{$employeeSalaries->year == "2018" ? 'selected' : ''}}> 2018</option>
                                    <option value="2019" {{$employeeSalaries->year == "2019" ? 'selected' : ''}}> 2019</option>
                                    <option value="2020" {{$employeeSalaries->year == "2020" ? 'selected' : ''}}> 2020</option>
                                    <option value="2021" {{$employeeSalaries->year == "2021" ? 'selected' : ''}}> 2021</option>
                                    <option value="2022" {{$employeeSalaries->year == "2022" ? 'selected' : ''}}> 2022</option>
                                    <option value="2023" {{$employeeSalaries->year == "2023" ? 'selected' : ''}}> 2023</option>
                                    <option value="2024" {{$employeeSalaries->year == "2024" ? 'selected' : ''}}> 2024</option>
                                    <option value="2025" {{$employeeSalaries->year == "2025" ? 'selected' : ''}}> 2025</option>
                                    <option value="2026" {{$employeeSalaries->year == "2026" ? 'selected' : ''}}> 2026</option>
                                </select>
                            </div>

                            <div class="form-group col-md-3">
                                <label class="control-label">Attendance</label>
                                <input type="text" name="attendance" id="attendance" class="form-control" value="{{$employeeSalaries->attendance}}" placeholder="Attendance">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Present</label>
                                <input type="text" name="present" id="present" class="form-control" value="{{$employeeSalaries->present}}" placeholder="Present">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">OT Hour</label>
                                <input type="text" class=" form-control" name="OT_hour" placeholder="OT Hour" value="{{$employeeSalaries->OT_hour}}" required >
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">OT Rate</label>
                                <input type="text"  class=" form-control" name="OT_rate" value="{{$employeeSalaries->OT_rate}}" required  placeholder="OT Rate">
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Total Over Time</label>
                                <input type="text"  class=" form-control" name="total_over_time" value="{{$employeeSalaries->total_over_time}}"  placeholder="Total Over Time" required >
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Attendence Bonus</label>
                                <input type="text"  class=" form-control" name="attendance_bonus" value="{{$employeeSalaries->attendance_bonus}}" placeholder="Attendence Bonus" required >
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Tips</label>
                                <input type="text" class="form-control" id="tips" name="tips" value="{{$employeeSalaries->tips}}" placeholder="Tips" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Total Salary</label>
                                <input type="text" class=" form-control" name="total_salary" value="{{$employeeSalaries->total_salary}}" placeholder="Total Salary" required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Advance Salary</label>
                                <input type="text" class=" form-control" name="advance_salary" value="{{$employeeSalaries->advance_salary}}" placeholder="Advance Salary" required >
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Uniform Value</label>
                                <input type="text"  class=" form-control" name="uniform_value" value="{{$employeeSalaries->uniform_value}}" placeholder="Uniform Value"  required >
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Uniform Advance</label>
                                <input type="text" class=" form-control" name="uniform_advance" value="{{$employeeSalaries->uniform_advance}}" placeholder="Uniform Advance"  required >
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Uniform Deduction</label>
                                <input type="text"  class=" form-control" name="uniform_deduction" value="{{$employeeSalaries->uniform_deduction}}" placeholder="Uniform Deduction"  required >
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Due Salary</label>
                                <input type="text" class="form-control" id="service_unit_id_1" value="{{$employeeSalaries->due_salary}}" name="due_salary" placeholder="Due Salary"  required>
                            </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Net Payable Salary</label>
                                <input type="text" class="amount form-control" name="net_payable_salary" value="{{$employeeSalaries->net_payable_salary}}" placeholder="Net Payable Salary"  required>
                            </div>
                            <div class="form-group col-md-4 align-self-end">
                                <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Employee Salary</button>
                            </div>
                    </form>
                </div>
                <div class="tile-footer">
                </div>
            </div>
        </div>


    </main>

@endsection

@push('js')
    <script>
        // ajax
        function getval(row,sel)
        {
            //alert(row);
            //alert(sel.value);
            var current_row = row;
            var current_employee_id= sel.value;

            $.ajax({
                url : "{{URL('employeeSalary-relation-data')}}",
                method : "get",
                data : {
                    current_employee_id : current_employee_id,
                    current_row : current_row,
                },
                success : function (res){
                    //console.log(res)
                    console.log(res.data)
                    //console.log(res.data.designation)

                    //$("#service_unit_id_1").val("Dolly Duck");
                    //$("#service_unit_id_1").val(res.data.service_unit_name);
                    $("#designation").val(res.data.designation);
                    $("#gross_salary").val(res.data.gross_salary);
                    $("#basic_salary").val(res.data.basic_salary);
                    $("#per_day_salary").val(res.data.per_day_salary);
                },
                error : function (err){
                    console.log(err)
                }
            })
        }

    </script>
@endpush



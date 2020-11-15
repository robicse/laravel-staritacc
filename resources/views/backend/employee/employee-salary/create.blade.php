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
                <h1><i class=""></i> Add Employee Salary</h1>
            </div>
            <ul class="app-breadcrumb breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('employee-salary.index') }}" class="btn btn-sm btn-primary col-sm" type="button">Employee Salary</a>
                </li>
            </ul>
        </div>
        <div class="col-md-12">
            <div class="tile">
                <h3 class="tile-title">Add Employee Salary</h3>
                <div class="tile-body">
                        <form  class="row" method="post" action="{{ route('employee-salary.store') }}">
                            @csrf
                        <div class="form-group col-md-3">
                            <label class="control-label">Employee Name </label>
                            <select name="employee_id" id="employee_id" class="form-control select2" onchange="getval(1,this);" required>
                                <option value="">Select One</option>
                                @foreach($employees as $employee)
                                    <option value="{{$employee->id}}">{{$employee->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Designation</label>
                            <input class="form-control" name="designation" type="text" placeholder="Designation " id="designation" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Gross Salary</label>
                            <input type="text" name="gross_salary" id="gross_salary" class="form-control" placeholder="Gross Salary" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Basic Salary</label>
                            <input type="text" name="basic_salary" id="basic_salary" class="form-control" placeholder="Basic Salary" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Per Day Salary</label>
                            <input type="text" name="per_day_salary" id="per_day_salary" class="form-control" placeholder="Per Day Salary" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Month</label>
                            <select name="month" id="month" class="form-control select2" required>
                                <option value="">Select One</option>
                                <option value="January"> January</option>
                                <option value="February"> February</option>
                                <option value="March"> March</option>
                                <option value="April"> April</option>
                                <option value="May"> May</option>
                                <option value="June"> June</option>
                                <option value="July"> July</option>
                                <option value="August"> August</option>
                                <option value="September"> September</option>
                                <option value="October"> October</option>
                                <option value="November"> November</option>
                                <option value="December"> December</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Year</label>
                            <select name="year" id="year" class="form-control select2" required>
                                <option value="">Select One</option>
                                <option value="2010"> 2010</option>
                                <option value="2011"> 2011</option>
                                <option value="2012"> 2012</option>
                                <option value="2013"> 2013</option>
                                <option value="2014"> 2014</option>
                                <option value="2015"> 2015</option>
                                <option value="2016"> 2016</option>
                                <option value="2017"> 2017</option>
                                <option value="2018"> 2018</option>
                                <option value="2019"> 2019</option>
                                <option value="2020"> 2020</option>
                                <option value="2021"> 2021</option>
                                <option value="2022"> 2022</option>
                                <option value="2023"> 2023</option>
                                <option value="2024"> 2024</option>
                                <option value="2025"> 2025</option>
                                <option value="2026"> 2026</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="control-label">Attendance</label>
                            <input type="text" name="attendance" id="attendance" class="form-control" placeholder="Attendance">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Present</label>
                            <input type="text" name="present" id="present" class="form-control" placeholder="Present">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">OT Hour</label>
                            <input type="text" class=" form-control" name="OT_hour" placeholder="OT Hour" value="" required >
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">OT Rate</label>
                            <input type="text"  class=" form-control" name="OT_rate" value="" required  placeholder="OT Rate">
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Total Over Time</label>
                            <input type="text"  class=" form-control" name="total_over_time" value=""  placeholder="Total Over Time" required >
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Attendence Bonus</label>
                            <input type="text"  class=" form-control" name="attendance_bonus" value="" placeholder="Attendence Bonus" required >
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Tips</label>
                            <input type="text" class="form-control" id="tips" name="tips" placeholder="Tips" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Total Salary</label>
                            <input type="text" class=" form-control" name="total_salary"  placeholder="Total Salary" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Advance Salary</label>
                            <input type="text" class=" form-control" name="advance_salary" value="" placeholder="Advance Salary" required >
                        </div>
                            <div class="form-group col-md-3">
                                <label class="control-label">Uniform Value</label>
                                <input type="text"  class=" form-control" name="uniform_value" value="" placeholder="Uniform Value"  required >
                            </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Uniform Advance</label>
                            <input type="text" class=" form-control" name="uniform_advance" value="" placeholder="Uniform Advance"  required >
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Uniform Deduction</label>
                            <input type="text"  class=" form-control" name="uniform_deduction" value="" placeholder="Uniform Deduction"  required >
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Due Salary</label>
                            <input type="text" class="form-control" id="service_unit_id_1" name="due_salary" placeholder="Due Salary"  required>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label">Net Payable Salary</label>
                            <input type="text" class="amount form-control" name="net_payable_salary" placeholder="Net Payable Salary"  required>
                        </div>
                        <div class="form-group col-md-4 align-self-end">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Employee Salary</button>
                        </div>
                    </form>
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



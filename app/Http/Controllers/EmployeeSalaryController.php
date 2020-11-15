<?php

namespace App\Http\Controllers;

use App\Employee;
use App\EmployeeSalay;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeSalaryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee-salary-list|employee-salary-create|employee-salary-edit|employee-delete', ['only' => ['index','show']]);
        $this->middleware('permission:employee-salary-create', ['only' => ['create','store']]);
        $this->middleware('permission:employee-salary-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:employee-salary-delete', ['only' => ['destroy']]);
    }
    public function index()
    {

        $employeeSalaries = EmployeeSalay::latest()->get();
        return view('backend.employee.employee-salary.index', compact('employeeSalaries'));
    }

    public function create()
    {
        $employees = Employee::all();
        return view('backend.employee.employee-salary.create', compact('employees'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'month' => 'required',
        ]);

        $employeeSalaries = new EmployeeSalay();
        $employeeSalaries->employee_id = $request->employee_id;
        $employeeSalaries->month = $request->month;
        $employeeSalaries->year = $request->year;
        $employeeSalaries->designation = $request->designation;
        $employeeSalaries->attendance = $request->attendance;
        $employeeSalaries->present = $request->present;
        $employeeSalaries->gross_salary = $request->gross_salary;
        $employeeSalaries->basic_salary = $request->basic_salary;
        $employeeSalaries->per_day_salary = $request->per_day_salary;
        $employeeSalaries->OT_hour = $request->OT_hour;
        $employeeSalaries->OT_rate = $request->OT_rate;
        $employeeSalaries->total_over_time = $request->total_over_time;
        $employeeSalaries->attendance_bonus = $request->attendance_bonus;
        $employeeSalaries->tips = $request->tips;
        $employeeSalaries->total_salary = $request->total_salary;
        $employeeSalaries->advance_salary = $request->advance_salary;
        $employeeSalaries->uniform_value = $request->uniform_value;
        $employeeSalaries->uniform_advance = $request->uniform_advance;
        $employeeSalaries->uniform_deduction = $request->uniform_deduction;
        $employeeSalaries->due_salary = $request->due_salary;
        $employeeSalaries->net_payable_salary = $request->net_payable_salary;
        //dd($employeeSalaries);
        $employeeSalaries->save();

        Toastr::success('Employee salary Created Successfully', 'Success');
        return redirect()->route('employee-salary.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $employees = Employee::all();
        $employeeSalaries = EmployeeSalay::find($id);
        return view('backend.employee.employee-salary.edit', compact('employees', 'employeeSalaries'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'month' => 'required',
        ]);

        $employeeSalaries = EmployeeSalay::find($id);
        $employeeSalaries->employee_id = $request->employee_id;
        $employeeSalaries->designation = $request->designation;
        $employeeSalaries->month = $request->month;
        $employeeSalaries->year = $request->year;
        $employeeSalaries->attendance = $request->attendance;
        $employeeSalaries->present = $request->present;
        $employeeSalaries->gross_salary = $request->gross_salary;
        $employeeSalaries->basic_salary = $request->basic_salary;
        $employeeSalaries->per_day_salary = $request->per_day_salary;
        $employeeSalaries->OT_hour = $request->OT_hour;
        $employeeSalaries->OT_rate = $request->OT_rate;
        $employeeSalaries->total_over_time = $request->total_over_time;
        $employeeSalaries->attendance_bonus = $request->attendance_bonus;
        $employeeSalaries->tips = $request->tips;
        $employeeSalaries->total_salary = $request->total_salary;
        $employeeSalaries->advance_salary = $request->advance_salary;
        $employeeSalaries->uniform_value = $request->uniform_value;
        $employeeSalaries->uniform_advance = $request->uniform_advance;
        $employeeSalaries->uniform_deduction = $request->uniform_deduction;
        $employeeSalaries->due_salary = $request->due_salary;
        $employeeSalaries->net_payable_salary = $request->net_payable_salary;
        $employeeSalaries->save();

        Toastr::success('Employee salary Edited Successfully', 'Success');
        return redirect()->route('employee-salary.index');
    }


    public function destroy($id)
    {
        $employeeSalaries = EmployeeSalay::find($id);
        $employeeSalaries->delete();
        Toastr::success('Employee salary Deleted Successfully', 'Success');
        return redirect()->route('employee-salary.index');
    }


    public function employeeSalaryRelationData(Request $request)
    {
       // echo 'hello';
//$options = 'hello';
        $current_row = $request->current_row;
        $employee_id = $request->current_employee_id;
        $designation = DB::table('employees')
            ->where('id',$employee_id)
            ->pluck('employees.designation')
            ->first();
        $grossSalary = DB::table('employees')
            ->where('id',$employee_id)
            ->pluck('employees.gross_salary')
            ->first();
        $grossSalary = DB::table('employees')
            ->where('id',$employee_id)
            ->pluck('employees.basic_salary')
            ->first();
        $grossSalary = DB::table('employees')
            ->where('id',$employee_id)
            ->pluck('employees.per_day_salary')
            ->first();

        $option = [
            'current_row' => $current_row,
            'designation' => $designation,
            'gross_salary' => $grossSalary,
            'basic_salary' => $grossSalary,
            'per_day_salary' => $grossSalary,
        ];

        return response()->json(['success'=>true,'data'=>$option]);
    }
}

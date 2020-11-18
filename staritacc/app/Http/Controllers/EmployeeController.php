<?php

namespace App\Http\Controllers;

use App\Account;
use App\Employee;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:employee-list|employee-create|employee-edit|employee-delete', ['only' => ['index','show']]);
        $this->middleware('permission:employee-create', ['only' => ['create','store']]);
        $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $employees = Employee::where('delete_status',0)->latest()->get();
        return view('backend.employee.employee-list.index',compact('employees'));
    }

    public function create()
    {
        return view('backend.employee.employee-list.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $employees = new Employee();
        $employees->name = $request->name;
        $employees->address = $request->address;
        $employees->phone = $request->phone;
        $employees->designation = $request->designation;
        $employees->gross_salary = $request->gross_salary;
        $employees->basic_salary = $request->basic_salary;
        $employees->per_day_salary = $request->per_day_salary;
        $employees->save();
        $insert_id = $employees->id;

        $account = DB::table('accounts')->where('HeadLevel',2)->where('HeadCode', 'like', '501%')->Orderby('created_at', 'desc')->limit(1)->first();
        //dd($account);
        if(!empty($account)){
            $headcode=$account->HeadCode+1;
            //$p_acc = $headcode ."-".$request->name;

        }
        else{
            $headcode="50101";
            //$p_acc = $headcode ."-".$request->name;
        }
        $p_acc = $request->name;

        $PHeadName = 'Account Payable';
        $HeadLevel = 2;
        $HeadType = 'L';
        $account = new Account;
        $account->ref_id        = $insert_id;
        $account->HeadCode      = $headcode;
        $account->HeadName      = $p_acc;
        $account->PHeadName     = $PHeadName;
        $account->HeadLevel     = $HeadLevel;
        $account->IsActive      = '1';
        $account->IsTransaction = '1';
        $account->IsGL          = '1';
        $account->HeadType      = $HeadType;
        $account->CreateBy      = Auth::User()->id;
        $account->UpdateBy      = Auth::User()->id;
        $account->save();
        Toastr::success('EmployeeCreated Successfully');
        return redirect()->route('employee.index');
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $employees = Employee::find($id);
        return view('backend.employee.employee-list.edit',compact('employees'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $employees = Employee::find($id);
        $employees->name = $request->name;
        $employees->address = $request->address;
        $employees->phone = $request->phone;
        $employees->designation = $request->designation;
        $employees->gross_salary = $request->gross_salary;
        $employees->basic_salary = $request->basic_salary;
        $employees->per_day_salary = $request->per_day_salary;
        $employees->save();

        Toastr::success('Employee Updated Successfully');
        return redirect()->route('employee.index');
    }


    public function destroy($id)
    {
        $employees = Employee::find($id);
        $employees->delete_status = 1;
        $employees->save();

        $accounts = Account::where('ref_id',$id)->where('HeadType','L')->first();
        $accounts->IsGL = 0;
        $accounts->save();

        Toastr::success('Employee Deleted Successfully');
        return redirect()->route('employee.index');
    }
}

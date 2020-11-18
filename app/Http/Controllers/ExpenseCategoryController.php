<?php

namespace App\Http\Controllers;

use App\Account;
use App\Employee;
use App\ExpenseCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ExpenseCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:expense-category-list|expense-create|expense-category-edit|expense-category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:expense-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:expense-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:expense-category-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $expenses = ExpenseCategory::where('delete_status',0)->orderBy('id','desc')->paginate(5);
        return view('backend.expenseCategory.index', compact('expenses'));
    }

    public function create()
    {
        return view('backend.expenseCategory.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $expenses = new ExpenseCategory();
        $expenses->name = $request->name;
        $expenses->slug = Str::slug($request->name);
        //$expenses->status = $request->status;
        $expenses->save();
        $insert_id = $expenses->id;

        $account = DB::table('accounts')->where('HeadLevel',1)->where('HeadCode', 'like', '4%')->where('PHeadName','Expense')->Orderby('created_at', 'desc')->limit(1)->first();
        if(!empty($account)){
            $headcode=$account->HeadCode+1;
        }else{
            $headcode="401";
        }
        $p_acc = $request->name;
        $HeadLevel = 1;
        $HeadType = 'E';

        $account = new Account();
        $account->ref_id        = $insert_id;
        $account->HeadCode      = $headcode;
        $account->HeadName      = $p_acc;
        $account->PHeadName     = 'Expense';
        $account->HeadLevel     = $HeadLevel;
        $account->IsActive      = '1';
        $account->IsTransaction = '1';
        $account->IsGL          = '1';
        $account->HeadType      = $HeadType;
        $account->CreateBy      = Auth::User()->id;
        $account->UpdateBy      = Auth::User()->id;
        //dd($account);
        $account->save();

        Toastr::success('Expense Category Created Successfully');
        return redirect()->route('expenseCategory.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $expenses = ExpenseCategory::find($id);
        //dd($expenses);
        return view('backend.expenseCategory.edit', compact('expenses'));
    }
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required'
        ]);

        $expenses = ExpenseCategory::find($id);
        $expenses->name = $request->name;
        $expenses->slug = Str::slug($request->name);
        //$expenses->status = $request->status;
        $expenses->save();

        Toastr::success('Office Costing Category Updated Successfully');
        return redirect()->route('expenseCategory.index');
    }

    public function destroy($id)
    {
        $expenseCategory = ExpenseCategory::find($id);
        $expenseCategory->delete_status = 1;
        $expenseCategory->save();

        $accounts = Account::where('ref_id',$id)->where('HeadType','E')->first();
        $accounts->IsGL = 0;
        $accounts->save();


        Toastr::success('Office Costing Category Deleted Successfully');
        return redirect()->route('expenseCategory.index');
    }
}

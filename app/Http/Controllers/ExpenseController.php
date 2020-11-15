<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use App\OfficeCostingCategory;
use App\Store;
use App\Transaction;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ExpenseController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:expense-list|expense-create|expense-edit|expense-delete', ['only' => ['index','show']]);
        $this->middleware('permission:expense-create', ['only' => ['create','store']]);
        $this->middleware('permission:expense-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:expense-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)

    {

        $expenses = Expense::latest()->get();
        //dd($expenses);
        return view('backend.expense.index',compact('expenses'));
    }

    public function create()
    {

        $officeCostingCategories = ExpenseCategory::all() ;
        return view('backend.expense.create',compact('officeCostingCategories'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'payment_type'=> 'required',
            'amount'=> 'required',
        ]);

        $expense = new Expense();
        $expense->expense_category_id = $request->expense_category_id;
        $expense->payment_type = $request->payment_type;
        $expense->check_number = $request->check_number ? $request->check_number : NULL;
        $expense->amount = $request->amount;
        $expense->date = $request->date;
        $expense->save();
//dd($expense);
        Toastr::success('Expense Created Successfully', 'Success');
        return redirect()->route('expenses.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {

        $officeCostingCategories = ExpenseCategory::all() ;

        $expense = Expense::find($id);

        return view('backend.expense.edit',compact('expense','officeCostingCategories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'payment_type'=> 'required',
            'amount'=> 'required',
        ]);

        $expense = Expense::find($id);
        $expense->expense_category_id = $request->expense_category_id;
        $expense->payment_type = $request->payment_type;
        $expense->check_number = $request->check_number ? $request->check_number : NULL;
        $expense->amount = $request->amount;
        $expense->date = date('d-m-Y');
        $expense->save();


        Toastr::success('Expense Updated Successfully', 'Success');
        return redirect()->route('expenses.index');
    }

    public function destroy($id)
    {
        Expense::destroy($id);
        Toastr::success('Expense Updated Successfully', 'Success');
        return redirect()->route('expenses.index');
    }

//    public function newOfficeCostingCategory(Request $request){
//        //dd($request->all());
//        $this->validate($request, [
//            'name' => 'required',
//        ]);
//        $officeCostingCategory = new ExpenseCategory();
//        $officeCostingCategory->name = $request->name;
//        $officeCostingCategory->slug = Str::slug($request->name);
//        $officeCostingCategory->save();
//        $insert_id = $officeCostingCategory->id;
//
//        if ($insert_id){
//            $sdata['id'] = $insert_id;
//            $sdata['name'] = $officeCostingCategory->name;
//            echo json_encode($sdata);
//
//        }
//        else {
//            $data['exception'] = 'Some thing mistake !';
//            echo json_encode($data);
//
//        }
//    }
}

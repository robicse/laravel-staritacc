<?php

namespace App\Http\Controllers;

use App\Account;
use App\Customer;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CustomerController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:customer-list|customer-create|customer-edit|customer-delete', ['only' => ['index','show']]);
        $this->middleware('permission:customer-create', ['only' => ['create','store']]);
        $this->middleware('permission:customer-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:customer-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $custmers = Customer::where('status',0)->where('delete_status',0)->latest()->get();
        return view('backend.customer.index',compact('custmers'));
    }


    public function create()
    {
        return view('backend.customer.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);
        //dd($request);
        $custmers = new Customer();
        $custmers->name = $request->name;
        $custmers->slug = Str::slug($request->name);
        $custmers->phone = $request->phone;
        $custmers->email = $request->email;
        $custmers->address = $request->address;
        $custmers->status = $request->status;

        $custmers->save();
        $account = DB::table('accounts')->where('HeadLevel',3)->where('HeadCode', 'like', '1010301%')->Orderby('created_at', 'desc')->limit(1)->first();
        //dd($account);
        if(!empty($account)){
            $headcode=$account->HeadCode+1;
            //$p_acc = $headcode ."-".$request->name;
        }else{
            $headcode="1010301";
            //$p_acc = $headcode ."-".$request->name;
        }
        $p_acc = $request->name;

        $PHeadName = 'Account Receivable';
        $HeadLevel = 3;
        $HeadType = 'A';


        $account = new Account();
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


        Toastr::success('Customer Created Successfully','Success');
        return  redirect()->route("customer.index");
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $custmers = Customer::find($id);
        return view('backend.customer.edit',compact('custmers'));

    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);
        //dd($request);
        $custmers = Customer::find($id);
        $custmers->name = $request->name;
        $custmers->slug = Str::slug($request->name);
        $custmers->phone = $request->phone;
        $custmers->email = $request->email;
        $custmers->address = $request->address;
        $custmers->status = $request->status;

        $custmers->save();
        Toastr::success('Customer Edited Successfully','Success');
        return  redirect()->route("customer.index");
    }


    public function destroy($id)
    {
        $custmers = Customer::find($id);
        $custmers->delete_status = 1;
        $custmers->save();

        $accounts = Account::where('ref_id',$id)->where('HeadType','A')->first();
        $accounts->IsGL = 0;
        $accounts->save();

        Toastr::success('Customer Deleted Successfully','Success');
        return  redirect()->route("customer.index");
    }
}

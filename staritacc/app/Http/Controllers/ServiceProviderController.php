<?php

namespace App\Http\Controllers;

use App\Account;
use App\Service;
use App\ServiceProvider;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ServiceProviderController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:service-provider-list|service-provider-create|service-provider-edit|service-provider-delete', ['only' => ['index','show']]);
        $this->middleware('permission:service-provider-create', ['only' => ['create','store']]);
        $this->middleware('permission:service-provider-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:service-provider-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $serviceProviders = ServiceProvider::where('delete_status',0)->latest()->get();
        //dd($serviceProviders);
        return view('backend.service-provider.index',compact('serviceProviders'));
    }


    public function create()
    {
        $services =Service::all();
        return view('backend.service-provider.create',compact('services'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);
        //dd($request);
        $serviceProviders = new ServiceProvider();
        $serviceProviders->name = $request->name;
        $serviceProviders->slug = Str::slug($request->name);
        $serviceProviders->service_id = $request->service_id;
        $serviceProviders->cost = $request->cost;
        $serviceProviders->address = $request->address;
        $serviceProviders->status = $request->status;
        $serviceProviders->delete_status = 0;
        $serviceProviders->save();
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
        $account->HeadCode      = $headcode;
        $account->HeadName      = $p_acc;
        $account->PHeadName     = $PHeadName;
        $account->HeadLevel     = $HeadLevel;
        $account->IsActive      = '1';
        $account->IsTransaction = '1';
        $account->IsGL          = '0';
        $account->HeadType      = $HeadType;
        $account->CreateBy      = Auth::User()->id;
        $account->UpdateBy      = Auth::User()->id;
        $account->save();

        Toastr::success('Service Provider Created Successfully','Success');
        return  redirect()->route("serviceProvider.index");


}


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $services =Service::all();
        $serviceProviders = ServiceProvider::find($id);
        return view('backend.service-provider.edit',compact('services','serviceProviders'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);
        //dd($request);
        $serviceProviders = ServiceProvider::find($id);
        $serviceProviders->name = $request->name;
        $serviceProviders->slug = Str::slug($request->name);
        $serviceProviders->service_id = $request->service_id;
        $serviceProviders->cost = $request->cost;
        $serviceProviders->address = $request->address;
        $serviceProviders->status = $request->status;
        $serviceProviders->delete_status = 0;
        $serviceProviders->save();
        Toastr::success('Service Provider Updated Successfully','Success');
        return  redirect()->route("serviceProvider.index");
    }


    public function destroy($id)
    {
        $serviceProviders = ServiceProvider::find($id);
        $serviceProviders->delete_status = 1;
        $serviceProviders->save();

        Toastr::success('Service Provider Deleted Successfully','Success');
        return  redirect()->route("serviceProvider.index");
    }
}

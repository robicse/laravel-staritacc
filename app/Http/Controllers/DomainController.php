<?php

namespace App\Http\Controllers;

use App\Domain;
use Illuminate\Http\Request;

class DomainController extends Controller
{

    public function index()
    {
        $domains = Domain::latest()->get();
        return view('backend.domains.domain.index',compact('domains'));
    }


    public function create()
    {
        return view('backend.domains.domain.create');
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'client_name' => 'required',
//            'code_no' => 'required|unique:domains|max:255',
        ]);
        $get_invoice_no = Domain::latest()->pluck('code_no')->first();
//dd($get_invoice_no);
        if(!empty($get_invoice_no)){
            $get_invoice = ($get_invoice_no);
//$invoice_no = $get_invoice_no+1;
            $code_no = $get_invoice+1;
        }else{
            $code_no = 1000;
        }

        //dd($request);
        $domains = new Domain();
        $domains->client_name = $request->client_name;
        $domains->domain_name = $request->domain_name;
        $domains->contact_info = $request->contact_info;
        $domains->code_no = $code_no;
        $domains->amount = $request->amount;
        $domains->expire_date = $request->expire_date;
       // dd($domains);
        $domains->save();
        return  redirect()->route("domain.index");
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $domains = Domain::find($id);
        return view('backend.domains.domain.edit',compact('domains'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'client_name' => 'required',

        ]);
        //dd($request);
        $domains = Domain::find($id);
        $domains->client_name = $request->client_name;
        $domains->domain_name = $request->domain_name;
        $domains->contact_info = $request->contact_info;
//        $domains->code_no = $request->code_no;
        $domains->amount = $request->amount;
        $domains->expire_date = $request->expire_date;
        $domains->save();
        return  redirect()->route("domain.index");
    }


    public function destroy($id)
    {
        Domain::destroy($id);
        return  redirect()->route("domain.index");
    }
}

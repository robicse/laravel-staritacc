<?php

namespace App\Http\Controllers;

use App\Domain;
use App\DomainRenew;
use Illuminate\Http\Request;

class DomainRenewController extends Controller
{

    public function index()
    {
        $domain_renews = DomainRenew::latest()->get();
        //dd($domain_renews);
        return view('backend.domains.domain-renew.index',compact('domain_renews'));
    }

    public function create()
    {
        $domains = Domain::all();
        return view('backend.domains.domain-renew.create',compact('domain_renews','domains'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'renew_date' => 'required',
        ]);
        //dd($request);
        $domain_renews = new DomainRenew();
        $domain_renews->domain_id = $request->domain_id;
        $domain_renews->renew_date = $request->renew_date;
        $domain_renews->expired_date = $request->expired_date;
        $domain_renews->remarks = $request->remarks;
        //dd($domain_renews);
        $domain_renews->save();
        return  redirect()->route("domain-renew.index");
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $domains = Domain::all();
        $domain_renews = DomainRenew::find($id);
        return view('backend.domains.domain-renew.edit',compact('domains','domain_renews'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'renew_date' => 'required',
        ]);
        //dd($request);
        $domain_renews = DomainRenew::find($id);
        $domain_renews->renew_date = $request->renew_date;
        $domain_renews->expired_date = $request->expired_date;
        $domain_renews->remarks = $request->remarks;
        $domain_renews->save();
        return  redirect()->route("domain-renew.index");
    }


    public function destroy($id)
    {
        //
    }
}

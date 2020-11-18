<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceSaleDetail;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class ServiceSaleDetailController extends Controller
{

    public function index()
    {
        $serviceSaleDetails = ServiceSaleDetail::latest()->get();
        //dd($serviceSaleDetails);
        return view('backend.serviceSaleDetails.index',compact('serviceSaleDetails'));
    }


    public function create()
    {
        $services = Service::all();
        return view('backend.serviceSaleDetails.create',compact('services'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'service_id'=> 'required',
        ]);
        $serviceSaleDetails = new ServiceSaleDetail();
        $serviceSaleDetails->service_id = $request->service_id;
        $serviceSaleDetails->qty = $request->qty;
        $serviceSaleDetails->unit = $request->unit;
        $serviceSaleDetails->price = $request->price;
        $serviceSaleDetails->sub_total = $request->sub_total;
        $serviceSaleDetails->save();
        Toastr::success('Service sale Details Created Successfully','Success');
        return  redirect()->route("service.index");
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}

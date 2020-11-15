<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Due;
use App\Service;
use App\ServiceSale;
use App\ServiceSaleDetail;
use App\ServiceUnit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ServiceSaleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:service-sale-list|service-sale-create|service-sale-edit|service-sale-delete', ['only' => ['index','show']]);
        $this->middleware('permission:service-sale-create', ['only' => ['create','store']]);
        $this->middleware('permission:service-sale-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:service-sale-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $serviceSales = ServiceSale::all();
        //dd($serviceSales);
        return view('backend.serviceSale.index',compact('serviceSales'));
    }


    public function create()
    {
        $customers = Customer::all();
        $services = Service::all();
        $units = ServiceUnit::all();
        $serviceSales = ServiceSale::all();
        return view('backend.serviceSale.create',compact('customers','services','serviceSales','units'));
    }


    public function store(Request $request)
    {
        //dd($request->all());
        $this->validate($request, [
            'customer_id'=> 'required',
        ]);
        $row_count = count($request->service_id);
        $total_amount = 0;
        for($i=0; $i<$row_count;$i++)
        {
            $total_amount += $request->sub_total[$i];
        }
        $serviceSales = new ServiceSale();
        $serviceSales->customer_id =$request->customer_id;
        $serviceSales->payment_type =$request->payment_type;
        $serviceSales->check_number =$request->check_number;
        $serviceSales->date =$request->date;
        $serviceSales->total_amount =$request->total_amount;
        $serviceSales->paid_amount =$request->paid_amount;
        $serviceSales->due_amount =$request->due_amount;
        $serviceSales->save();
        $insert_id = $serviceSales->id;
        if($insert_id) {
            for ($i = 0; $i < $row_count; $i++) {
                $service_id = $request->service_id[$i];
                $service_unit_id = Service::where('id', $service_id)->pluck('service_unit_id')->first();

                $serviceSaleDetails = new ServiceSaleDetail();
                $serviceSaleDetails->service_sale_id = $insert_id;
                $serviceSaleDetails->service_unit_id = $service_unit_id;
                $serviceSaleDetails->service_id = $request->service_id[$i];
                $serviceSaleDetails->qty = $request->qty[$i];
                $serviceSaleDetails->price = $request->price[$i];
                $serviceSaleDetails->sub_total =$request->qty[$i]*$request->price[$i];
                //dd($serviceSaleDetails);
                $serviceSaleDetails->save();


            }

            // due
            $due = new Due();
            $due->total_amount = $total_amount;
            $due->service_sale_id = $insert_id;
            $due->customer_id = $request->customer_id;
            $due->paid_amount = $request->paid_amount;
            $due->current_due = $request->current_due;
            $due->save();

        }
        Toastr::success('Service Sale Created Successfully', 'Success');
        return redirect()->route('serviceSale.index');
    }


    public function show($id)
    {
        $customers = Customer::all();
        $services = Service::all();
        $serviceSales = ServiceSale::find($id);
        $serviceSalesDetails = ServiceSaleDetail::where('service_sale_id',$id)->get();

        return view('backend.serviceSale.show',compact('customers','services','serviceSales','serviceSalesDetails'));
    }


    public function edit($id)
    {
        $customers = Customer::all();
        $services = Service::all();
        $units = ServiceUnit::all();
        $serviceSales = ServiceSale::find($id);
        $serviceSalesDetails = ServiceSaleDetail::where('service_sale_id',$id)->get();

        return view('backend.serviceSale.edit',compact('customers','services','serviceSales','serviceSalesDetails','units'));
    }


    public function update(Request $request, $id)
    {
        //dd($request->all());
        $this->validate($request, [
            'customer_id'=> 'required',
        ]);
        $row_count = count($request->service_id);
        $total_amount = 0;
        for($i=0; $i<$row_count;$i++)
        {
            $total_amount += $request->sub_total[$i];
        }
        $serviceSales =  ServiceSale::find($id);
        $serviceSales->customer_id =$request->customer_id;
        $serviceSales->payment_type =$request->payment_type;
        $serviceSales->check_number =$request->check_number;
        $serviceSales->date =$request->date;
        $serviceSales->total_amount =$request->total_amount;
        $serviceSales->paid_amount =$request->paid_amount;
        $serviceSales->due_amount =$request->due_amount;
        $serviceSales->update();
        $insert_id = $serviceSales->id;
        if($insert_id) {
            for ($i = 0; $i < $row_count; $i++) {
                // service sales details
                $serviceSaleDetails_id = $request->service_sale_detail_id[$i];
                //dd($serviceSaleDetails_id);
                $serviceSaleDetails = ServiceSaleDetail::find($serviceSaleDetails_id);
                //dd($serviceSaleDetails);
                $serviceSaleDetails->service_sale_id = $insert_id;
                $serviceSaleDetails->service_id = $request->service_id[$i];
                $serviceSaleDetails->service_unit_id = $request->service_unit_id[$i];
                $serviceSaleDetails->qty = $request->qty[$i];
                $serviceSaleDetails->unit = $request->unit[$i];
                $serviceSaleDetails->price = $request->price[$i];
                $serviceSaleDetails->sub_total =$request->qty[$i]*$request->price[$i];
                $serviceSaleDetails->update();


            }

            // due
            $due = Due::where('service_sale_id',$id);
            $due->total_amount = $total_amount;
            $due->service_sale_id = $insert_id;
            $due->customer_id = $request->customer_id;
            $due->paid_amount = $request->paid_amount;
            $due->current_due = $request->current_due;
            $due->update();

        }
        return redirect()->route('serviceSale.index');
    }


    public function destroy($id)
    {
        $serviceSales =  ServiceSale::where('id',$id);
        //dd($serviceSales);
        $serviceSales->delete();

        DB::table('service_sale_details')->where('service_sale_id',$id)->delete();


        Toastr::success('Service Sale Deleted Successfully', 'Success');
        return redirect()->route('serviceSale.index');
    }
    public function serviceRelationData(Request $request){

        //$options = 'hello';
        $current_row = $request->current_row;
        $service_id = $request->current_service_id;
        $service_unit_name = DB::table('service_units')
            ->join('services','service_units.id','=','services.service_unit_id')
            ->where('services.id',$service_id)
            ->pluck('service_units.name')
            ->first();


        $option = [
            'current_row' => $current_row,
            'service_unit_name' => $service_unit_name,
        ];

        return response()->json(['success'=>true,'data'=>$option]);
    }

}

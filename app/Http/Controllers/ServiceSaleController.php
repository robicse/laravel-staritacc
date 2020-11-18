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
        $serviceSales = ServiceSale::latest()->get();
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
                $serviceSaleDetails->vat = $request->vat[$i];
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
            $due->due_amount = $request->due_amount;
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
        //dd($serviceSales);
        $serviceSales->update();

        //echo $request->service_sale_id;
        //exit;


        for ($i = 0; $i < $row_count; $i++) {
            //dd($request->service_id[$i]);
            // service sales details

            $service_unit_id = Service::where('id', $request->service_id[$i])->pluck('service_unit_id')->first();

            $serviceSaleDetails_id = $request->service_sale_detail_id[$i];
            $serviceSaleDetails = ServiceSaleDetail::find($serviceSaleDetails_id);
            $serviceSaleDetails->service_id = $request->service_id[$i];
            $serviceSaleDetails->service_unit_id = $request->service_unit_id[$i];
            $serviceSaleDetails->qty = $request->qty[$i];
            $serviceSaleDetails->unit = $service_unit_id;
            $serviceSaleDetails->vat = $request->vat[$i];
            $serviceSaleDetails->price = $request->price[$i];
            $serviceSaleDetails->sub_total =$request->qty[$i]*$request->price[$i];
            //dd($serviceSaleDetails);
            $serviceSaleDetails->update();
        }

        // due
        $due = Due::where('service_sale_id',$id)->latest()->first();
        //dd($due);
        $due->total_amount = $total_amount;
        //$due->service_sale_id = $insert_id;
        $due->customer_id = $request->customer_id;
        $due->paid_amount = $request->paid_amount;
        $due->due_amount = $request->due_amount;
        $due->update();


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
    public function payDue(Request $request)
    {
        //dd($request->all());

        $serviceSale_id = $request->service_sale_id;
        $serviceSale = ServiceSale::find($serviceSale_id);
        $total_amount=$serviceSale->total_amount;
        //dd($total_amount);
        $paid_amount=$serviceSale->paid_amount;

        $serviceSale->paid_amount=$paid_amount+$request->new_paid;
        $serviceSale->due_amount=$total_amount-($paid_amount+$request->new_paid);
        $serviceSale->update();

        $due = new Due();
        $due->customer_id = $serviceSale->customer_id;
        $due->service_sale_id = $request->service_sale_id;
        $due->total_amount=$serviceSale->total_amount;
        $due->paid_amount=$request->new_paid;
        $due->due_amount=$total_amount-($paid_amount+$request->new_paid);
        //dd($due);
        $due->save();

        Toastr::success('Due Pay Successfully', 'Success');
        return redirect()->back();

    }

    public function dueList()
    {
        //dd('ss');
        $auth_user_id = Auth::user()->id;
        $auth_user = Auth::user()->roles[0]->name;
        if($auth_user == "Admin"){
            $serviceSales = ServiceSale::where('due_amount','>',0)->latest()->get();
        }else{
            $serviceSales = ServiceSale::where('user_id',$auth_user_id)->where('due_amount','>',0)->get();
        }
        return view('backend.serviceSale.dueList',compact('serviceSales'));
    }

}

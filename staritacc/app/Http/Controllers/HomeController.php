<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Due;
use App\Employee;
use App\Expense;
use App\Service;
use App\ServiceSale;
use App\Store;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{

    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /*function __construct()
    {
        $this->middleware('permission:home-list', ['only' => ['index']]);
    }*/


    public function index()
    {
        //return view('home');
        //return view('backend._partial.home',['customers'=>$customer,'totalDue'=>$totalDue,'todaySell'=>$todaySell,'todayDue'=>$todayDue,'todaPaid'=>$todayPaid,'todayInvoice'=>$todayInvoice]);



//        $stores = Store::all();
        $customer = Customer::all()->count();
        $due = ServiceSale::where('due_amount','>',0)->get()->count();
        $expense = Expense::all()->count();
        $employeeList = Employee::all()->count();
        $service = Service::all()->count();
        return view('backend._partial.home',compact('customer','due','employeeList','expense','service'));
    }
}

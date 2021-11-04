<?php

namespace App\Http\Controllers\Frontend;

use App\DoctorSpeciality;
use App\HealthTips;
use App\Http\Controllers\Controller;
use App\Product;
use App\ServiceCategory;
use App\ServiceProvider;
use App\Services;
use App\Test;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function index(){
        //dd(Auth::user());

        /* check cart with raw data */
//        Cart::add([
//            'id' => '293ad',
//            'name' => 'Product 1',
//            'qty' => 1,
//            'price' => 9.99,
//            'options' => [
//                'size' => 'large'
//            ]
//        ]);

//        Cart::add([
//            [
//                'id' => '293ad',
//                'name' => 'Product 1',
//                'qty' => 1,
//                'price' => 10.00
//            ],
//            [
//                'id' => '4832k',
//                'name' => 'Product 2',
//                'qty' => 1,
//                'price' => 10.00,
//                'options' => [
//                    'size' => 'large'
//                ]
//            ]
//        ]);


//        Cart::add([$product1, $product2]);
//        Cart::content();
//        Cart::total();
//        Cart::count();
//        Cart::destroy();
//        dd(Cart::count());
        /* check cart with raw data */

        $all_services = Services::all();
        $hot_services = Services::where('service_type','Hot Service')->get();
        $all_service_categories = ServiceCategory::all();
        $all_health_tips = HealthTips::all();
        $all_health_tips = HealthTips::latest()->limit(4)->get();
//        $health_tips_doctor = HealthTips::where('doctor_id',2)->get();

       // dd($all_health_tips);

        return view('frontend.pages.index', compact('all_services','hot_services','all_service_categories','all_health_tips'));
    }

    public function cart()
    {
        $check_cart_type=0;
        foreach (Cart::content() as $productCart) {
            if($productCart->options->cart_type == "service"){
                $check_cart_type="ser";
                break;
            }elseif($productCart->options->cart_type == "lab"){
                $check_cart_type="lab";
                break;
            }
            else{
                $check_cart_type="prod";
                break;
            }
        }

        if($check_cart_type=="ser"){
            return view('frontend.pages.cart');
        }elseif($check_cart_type=="lab"){
            return redirect()->route('test.cart.list');
        }
        else{
            //dd($check_cart_type);
            return redirect()->route('shop.cart.list');
        }

    }

    public function service_provider(Request $request)
    {
        $lat=$request->lat;
        $lng=$request->lng;
        $serId=Cart::content()->first()->id;
        $service=\App\Services::find($serId);

        $serviceProviders = DB::table('service_providers')
            ->select('service_providers.id','users.name','users.slug','service_provider_contacts.address','service_provider_contacts.lat','service_provider_contacts.lng')
            ->join('users','service_providers.user_id','=','users.id')
            ->join('service_provider_contacts','service_providers.id','=','service_provider_contacts.service_provider_id')
            ->where('service_providers.service_category_id',$service->service_category_id)
            ->whereBetween('service_provider_contacts.lat',[$lat-0.1,$lat+0.1])
            ->whereBetween('service_provider_contacts.lng',[$lng-0.1,$lng+0.1])
            ->get();
        return response()->json(['success'=> true, 'response'=>$serviceProviders]);
    }

    public function questionForm(){
        $doctorSpecialities = DoctorSpeciality::all();
        return view('frontend.pages.question', compact('doctorSpecialities'));
    }
    public function search_doctor(Request $request){
        $name = $request->get('q');
        $doctor = User::where('name', 'LIKE', '%'. $name. '%')->limit(5)->get();
        return $doctor;
    }
    public function search_product(Request $request){
        $name = $request->get('q');
        $product = Product::where('name', 'LIKE', '%'. $name. '%')->limit(5)->get();
        //dd($product);
        return $product;
    }
    public function search_test(Request $request){
        $name = $request->get('q');
        $product = Test::where('name', 'LIKE', '%'. $name. '%')->limit(5)->get();
        //dd($product);
        return $product;
    }
}

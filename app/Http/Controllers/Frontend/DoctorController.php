<?php

namespace App\Http\Controllers\Frontend;

use App\Clinic;
use App\ClinicDoctor;
use App\ClinicReview;
use App\Doctor;
use App\DoctorAward;
use App\DoctorClinicSchedule;
use App\DoctorClinicScheduleTimeSlot;
use App\DoctorContact;
use App\DoctorEducation;
use App\DoctorExperience;
use App\DoctorReview;
use App\DoctorSpeciality;
use App\DoctorSpecialityDoctor;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    public function doctorList(){
        $doctorUserLists = DB::table('users')
            ->join('doctors','doctors.user_id','=','users.id')
            ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name')
            ->where('role_id',2)->get();
        //dd($doctorUserLists);
        $doctorSpecialities = DoctorSpeciality::all();
        $gen=[];
        $spe=[];
        return view('frontend.pages.doctor.doctor_list', compact('doctorUserLists','doctorSpecialities','gen','spe'));
    }
    public function doctorfilter(Request $request){
        //$doctorUserLists = User::where('role_id',2)->where('gender',$request->gender_type)->get();
        $gen=$request->gender_type;
        $spe=$request->doctor_speciality_id;
        $doctorSpecialities = DoctorSpeciality::all();

        if($gen==null && $spe==null){
            $doctorUserLists = DB::table('users')
                ->join('doctors','doctors.user_id','=','users.id')
                ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
                ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name','doctor_specialities.id as spe_id')
                ->where('role_id',2)->get();
            $gen=[];
            $spe=[];
            return view('frontend.pages.doctor.doctor_list', compact('doctorUserLists','doctorSpecialities','gen','spe'));
        }elseif($gen==null){
            $doctorUserLists = DB::table('users')
                ->join('doctors','doctors.user_id','=','users.id')
                ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
                ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name','doctor_specialities.id as spe_id')
                ->where('role_id',2)->whereIn('doctor_specialities.id',$spe)->get();
            $gen=[];
            return view('frontend.pages.doctor.doctor_list', compact('doctorUserLists','doctorSpecialities','gen','spe'));
        }elseif($spe==null){
            $doctorUserLists = DB::table('users')
                ->join('doctors','doctors.user_id','=','users.id')
                ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
                ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name','doctor_specialities.id as spe_id')
                ->where('role_id',2)->whereIn('users.gender',$gen)->get();
            $spe=[];
            return view('frontend.pages.doctor.doctor_list', compact('doctorUserLists','doctorSpecialities','gen','spe'));
        }else{
            $doctorUserLists = DB::table('users')
                ->join('doctors','doctors.user_id','=','users.id')
                ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
                ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name','doctor_specialities.id as spe_id')
                ->where('role_id',2)->whereIn('users.gender',$gen)->whereIn('doctor_specialities.id',$spe)->get();
            return view('frontend.pages.doctor.doctor_list', compact('doctorUserLists','doctorSpecialities','gen','spe'));
        }

//        $doctorUserLists = DB::table('users')
//            ->join('doctors','doctors.user_id','=','users.id')
//            ->join('doctor_specialities','doctors.doctor_speciality_id','=','doctor_specialities.id')
//            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.home_cost','doctor_specialities.name as spe_name')
//            ->where('role_id',2)->whereIn('gender',$request->gender_type)->get();
//        return view('frontend.pages.doctor.doctor_list', compact('doctorUserLists','doctorSpecialities'));
    }

    public function doctorDetails($slug){
        $doctorUserDetails = DB::table('users')
            ->select('users.*','doctors.id as doctor_id','doctors.title','doctors.personal_statement','doctors.doctor_speciality_id','doctors.home_cost')
            ->join('doctors','doctors.user_id','=','users.id')
            ->LeftJoin('doctor_reviews','doctor_reviews.doctor_user_id','=','users.id')
            ->where('users.slug',$slug)
            ->first();

        //$doctorReviews = DoctorReview::where('doctor_user_id', $doctorUserDetails->id)->get();
        //dd($doctorUserDetails);

        $doctor_speciality_name = DoctorSpeciality::where('id',$doctorUserDetails->doctor_speciality_id)->pluck('name')->first();
        $doctor_contacts = DoctorContact::where('doctor_id',$doctorUserDetails->doctor_id)->first();
        $doctorEducations = DoctorEducation::where('doctor_id',$doctorUserDetails->doctor_id)->get();
        $doctorExperiences = DoctorExperience::where('doctor_id',$doctorUserDetails->doctor_id)->get();
        $doctorAwards = DoctorAward::where('doctor_id',$doctorUserDetails->doctor_id)->get();
        $doctorSpecialityDoctors = DoctorSpecialityDoctor::where('doctor_id',$doctorUserDetails->doctor_id)->get();
        $clinicDoctors = ClinicDoctor::where('doctor_id',$doctorUserDetails->doctor_id)->get();
        $doctorReviews=DoctorReview::where('doctor_user_id',$doctorUserDetails->id)->get();

        return view('frontend.pages.doctor.doctor_details', compact('doctorUserDetails','doctor_speciality_name','doctor_contacts','doctorEducations','doctorExperiences','doctorAwards','doctorSpecialityDoctors','clinicDoctors','doctorReviews'));
    }

    public function thirtyDays(){
        $today= date("d-m-Y");
        $today_day=date("D");
//        dd(date("d-m-Y",strtotime('+'.$i.' day'.$today)));
        $dates=[];
        $dates[0]['day']=$today_day;
        $dates[0]['date']=$today;

        for($q=1;$q<31;$q++){
            $next_date=date("d-m-Y",strtotime('+'.$q.' day'.$today));
            $next_day=date("D",strtotime($next_date));
            $dates[$q]['day']=$next_day;
            $dates[$q]['date']=$next_date;
        }
        return $dates;
    }

    public function doctorBooking($slug){

        $doctorDetails = DB::table('doctors')
            ->select('users.slug','users.name','doctors.*')
            ->join('users','doctors.user_id','=','users.id')
            ->where('users.slug',$slug)
            ->first();

        if(empty(ClinicDoctor::where('doctor_id',$doctorDetails->id)->first())){
            Toastr::error('No Clinic Found','Sorry');
            return redirect()->back();
        }

        $doctorClinics = ClinicDoctor::where('doctor_id',$doctorDetails->id)->get();
        $dates=$this->thirtyDays();

        $cl_user=Clinic::find($doctorClinics[0]->clinic_id);
        //$cl_user_id=User::find($cl_user->user_id);
        $doctorSchedule=DoctorClinicSchedule::where('doctor_user_id',$doctorDetails->user_id)->where('clinic_user_id',$cl_user->user_id)->where('date',date("d-m-Y"))->get();
        //dd($doctorSchedule);
        return view('frontend.pages.doctor.doctor_booking', compact('slug','doctorDetails','doctorClinics','dates','doctorSchedule'));
    }

    public function doctorBookingFindSlot(Request $request){

        dd($request->all());

        $doctorSchedule=DoctorClinicSchedule::where('doctor_user_id',$request->doctor_user_id)->where('clinic_user_id',$request->clinic_id)->where('date',$request->date)->get();
        //dd($doctorSchedule);
        $slot=[];
        foreach($doctorSchedule as $ds){
            $ds_slot=\App\DoctorClinicScheduleTimeSlot::where('d_c_schedule_id',$ds->id)->get();
            array_push($slot,$ds_slot);
        }
        //dd($slot);
        return response()->json(['response'=>$slot]);

    }

    public function doctorBookingCheckout($slug,$schedule_id){

        $ds_slot=\App\DoctorClinicScheduleTimeSlot::find($schedule_id);

        if($ds_slot->user_id != null){
            return redirect()->back();
        }



        //$ds_slot = DoctorClinicSchedule::find($schedule_id);
        //dd($ds_slot);

        $doctorDetails = DB::table('doctors')
            ->select('users.slug','users.name','doctors.*')
            ->join('users','doctors.user_id','=','users.id')
            ->where('users.slug',$slug)
            ->first();

        $clinic_user=User::find($ds_slot->clinic_user_id);
        $clinic=Clinic::where('user_id',$ds_slot->clinic_user_id)->first();
        $visit_cost=ClinicDoctor::where('clinic_id',$clinic->id)->where('doctor_id',$doctorDetails->id)->first();
        //dd($visit_cost);

        return view('frontend.pages.doctor.checkout', compact('slug','doctorDetails','ds_slot','clinic_user','visit_cost'));
    }

    public function doctorBookingStore(Request  $request,$slot_id){

        $this->validate($request,[
            'name' => 'required',
            'phone' => 'required',
            'payment_type' => 'required',
        ]);
        if($request->payment_type == 'cod'){
            $payment_status = 'Due';
        }
        if($request->payment_type == 'ssl'){
            $payment_status = 'Paid';
        }
        $ds_slot=\App\DoctorClinicScheduleTimeSlot::find($slot_id);
        $clinic_user=User::find($ds_slot->clinic_user_id);
        $clinic=Clinic::where('user_id',$clinic_user->id)->first();
        $dc_user=User::find($ds_slot->doctor_user_id);
        $dc=Doctor::where('user_id',$dc_user->id)->first();

        $visit_cost=ClinicDoctor::where('clinic_id',$clinic->id)->where('doctor_id',$dc->id)->first();

        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $shipping_info = json_encode($data);

        $order = new Order();
        $order->invoice_code = date('Ymd-his');
        $order->order_type = "clinic_schedule";
        $order->user_id = Auth::user()->id;
        $order->shipping_address = $shipping_info;
        $order->payment_type = $request->payment_type;
        $order->payment_status = $payment_status;
        //$order->discount = $discount;
        //$order->grand_total = Cart::total();
        $order->grand_total = $visit_cost->visit_cost;
        $order->delivery_cost = 0;
        $order->delivery_status = "Pending";
        $order->view = 0;
        //dd($order->grand_total = Cart::total()-$discount);
        $order->save();

        $cl_sch=DoctorClinicScheduleTimeSlot::find($slot_id);
        $cl_sch->user_id=Auth::id();
        $cl_sch->order_id=$order->id;
        $cl_sch->update();

        //dd($slot_id);



        //return redirect()->route('doctor.booking.success.message',$slot_id);
        if ($request->payment_type == 'cod') {
            Toastr::success('Order Successfully done! ');
            Cart::destroy();
            //return redirect()->route('index');
            return redirect()->route('doctor.booking.success.message',$slot_id);
        }else {
            Session::put('order_id',$order->id);
            return redirect()->route('pay');
        }
    }

    public function doctorBookingSuccessMessage($slot_id){
        $ds_slot=\App\DoctorClinicScheduleTimeSlot::find($slot_id);
        $clinic_user=User::find($ds_slot->clinic_user_id);
        $dc_user=User::find($ds_slot->doctor_user_id);
        return view('frontend.pages.doctor.booking_success',compact('ds_slot','clinic_user','dc_user'));
    }

    public function doctorBookingInvoiceView(){
        //dd('okk');
        return view('frontend.pages.doctor.invoice_view');
    }
}

<?php

namespace App\Http\Controllers;

use App\Service;
use App\ServiceCategory;
use App\ServiceSubCategory;
use App\ServiceUnit;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ServiceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:service-list|service-create|service-edit|service-delete', ['only' => ['index','show']]);
        $this->middleware('permission:service-create', ['only' => ['create','store']]);
        $this->middleware('permission:service-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:service-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $services = Service::orderBy('id','desc')->latest()->get();
        return view('backend.services.service.index',compact('services'));
    }


    public function create()
    {
        $categories = ServiceCategory::all();
        $subCategories = ServiceSubCategory::all();
        $units = ServiceUnit::all();
        return view('backend.services.service.create',compact('categories','subCategories','units'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);
        //dd($request);
        $services = new Service();
        $services->name = $request->name;
        $services->slug = Str::slug($request->name);
        $services->service_category_id = $request->service_category_id;
        $services->service_unit_id = $request->service_unit_id;
        $services->service_sub_category_id = $request->service_sub_category_id;
        $services->description = $request->description;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
//            resize image for hospital and upload
            $proImage =Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/'.$imagename, $proImage);

        }
        else {
            $imagename = "default.png";
        }
        $services->image = $imagename;
        $services->save();
        Toastr::success('Service Created Successfully','Success');
        return  redirect()->route("service.index");
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $categories = ServiceCategory::all();
        $subCategories = ServiceSubCategory::all();
        $units = ServiceUnit::all();
        $services =  Service::find($id);
        return view('backend.services.service.edit',compact('categories','subCategories','services','units'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);
        //dd($request);
        $services =  Service::find($id);
        $services->name = $request->name;
        $services->slug = Str::slug($request->name);
        $services->service_category_id = $request->service_category_id;
        $services->service_unit_id = $request->service_unit_id;
        $services->service_sub_category_id = $request->service_sub_category_id;
        $services->description = $request->description;
        $image = $request->file('image');
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //delete old image.....
            if(Storage::disk('public')->exists('uploads/service/'.$services->image))
            {
                Storage::disk('public')->delete('uploads/service/'.$services->image);
            }

//            resize image for hospital and upload
            $proImage = Image::make($image)->resize(300, 300)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('uploads/service/'.$imagename, $proImage);

        }else {
            $imagename = $services->image;
        }

        $services->image = $imagename;
        $services->save();
        Toastr::success('Service Created Successfully','Success');
        return  redirect()->route("service.index");
    }


    public function destroy($id)
    {
        $services = Service::find($id);
        if (Storage::disk('public')->exists('uploads/service/'.$services->image)) {
            Storage::disk('public')->delete('uploads/service/'.$services->image);;
        }
        $services->delete();
        Toastr::success('Service Deleted Successfully Done!');
        return redirect()->route('service.index');
    }
}

<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use App\ServiceSubCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceSubCategoryController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:service-sub-category-list|service-sub-category-create|service-sub-category-edit|service-sub-category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:service-sub-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:service-sub-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:service-sub-category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $subCategories = ServiceSubCategory::orderBy('id','desc')->latest()->get();
        return view('backend.services.subcategory.index', compact('subCategories'));
    }


    public function create()
    {
        $categories = ServiceCategory::all();
        return view('backend.services.subcategory.create',compact('categories'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);
        $subCategories = new ServiceSubCategory();
        $subCategories->name = $request->name;
        $subCategories->slug = Str::slug($request->name);
        $subCategories->service_category_id = $request->service_category_id;
        $subCategories->save();
        Toastr::success('Service SubCategory Created Successfully','Success');
        return  redirect()->route("serviceSubCategory.index");
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $subCategories = ServiceSubCategory::find($id);
        $categories = ServiceCategory::all();
        return view('backend.services.subcategory.edit',compact('categories','subCategories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',

        ]);
        $subCategories = ServiceSubCategory::find($id);
        $subCategories->name = $request->name;
        $subCategories->slug = Str::slug($request->name);
        $subCategories->service_category_id = $request->service_category_id;
        $subCategories->save();
        Toastr::success('Service SubCategory Updated Successfully','Success');
        return  redirect()->route("serviceSubCategory.index");
    }

    public function destroy($id)
    {
        ServiceSubCategory::destroy($id);
        Toastr::success('Service SubCategory Updated Successfully', 'Success');
        return redirect()->route('serviceSubCategory.index');
    }
}

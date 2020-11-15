<?php

namespace App\Http\Controllers;

use App\ServiceCategory;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:service-category-list|service-category-create|service-category-edit|service-category-delete', ['only' => ['index','show']]);
        $this->middleware('permission:service-category-create', ['only' => ['create','store']]);
        $this->middleware('permission:service-category-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:service-category-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $categories = ServiceCategory::orderBy('id','desc')->paginate(5);
        return view('backend.services.category.index', compact('categories'));
    }


    public function create()
    {
        return view('backend.services.category.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $categories = new ServiceCategory();
        $categories->name = $request->name;
        $categories->slug = Str::slug($request->name);
        $categories->save();
        Toastr::success('Service Category Created Successfully', 'Success');
        return redirect()->route('serviceCategory.index');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $categories = ServiceCategory::find($id);
        return view('backend.services.category.edit', compact('categories'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $categories =  ServiceCategory::find($id);
        $categories->name = $request->name;
        $categories->slug = Str::slug($request->name);
        $categories->save();
        Toastr::success('Service Category Updated Successfully', 'Success');
        return redirect()->route('serviceCategory.index');
    }

    public function destroy($id)
    {
        ServiceCategory::destroy($id);
        Toastr::success('Service Category Updated Successfully', 'Success');
        return redirect()->route('serviceCategory.index');
    }
}

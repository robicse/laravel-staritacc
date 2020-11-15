<?php

namespace App\Http\Controllers;

use App\ServiceUnit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceUnitController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:service-unit-list|service-unit-create|service-unit-edit|service-unit-delete', ['only' => ['index','show']]);
        $this->middleware('permission:service-unit-create', ['only' => ['create','store']]);
        $this->middleware('permission:service-unit-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:service-unit-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $units = ServiceUnit::orderBy('id','desc')->paginate(5);
        return view('backend.services.unit.index', compact('units'));
    }


    public function create()
    {
        return view('backend.services.unit.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $units = new ServiceUnit();
        $units->name = $request->name;
        $units->slug = Str::slug($request->name);
        $units->save();
        Toastr::success('Service Unit Created Successfully', 'Success');
        return redirect()->route('serviceUnit.index');
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $units = ServiceUnit::find($id);
        return view('backend.services.unit.edit', compact('units'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        $units =ServiceUnit::find($id);
        $units->name = $request->name;
        $units->slug = Str::slug($request->name);
        $units->save();
        Toastr::success('Service Unit Edited Successfully', 'Success');
        return redirect()->route('serviceUnit.index');
    }


    public function destroy($id)
    {
        $units =ServiceUnit::find($id);
        $units->delete();
        Toastr::success('Service Unit Deleted Successfully', 'Success');
        return redirect()->route('serviceUnit.index');
    }
}

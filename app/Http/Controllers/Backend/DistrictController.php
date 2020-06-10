<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\District;
use App\Models\Backend\Division;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $districts = District::orderBy('name', 'asc')->get();
       return view('backend.pages.district.manage',compact('districts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $divisions = Division::all();
        return view('backend.pages.district.create', compact('divisions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'division'=>'required',
        ]);
        $district = new District();
        $district->name = $request->name;
        $district->division_id = $request->division;
        $district->save();
        Toastr::success('New District Successfully Created', 'Success');

        return redirect()->route('backend.admin.manageDistrict');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $district = District::find($id);
        $divisions = Division::all();
        return view('backend.pages.district.edit', compact('district', 'divisions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'division'=>'required',
        ]);
        $district = District::find($id);
        $district->name = $request->name;
        $district->division_id = $request->division;
        $district->save();
        Toastr::success('New District Updated Successfully', 'Success');

        return redirect()->route('backend.admin.manageDistrict');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $district = District::find($id);
        $district->delete();

        Toastr::success('New District Deleted Successfully', 'Success');

        return redirect()->route('backend.admin.manageDistrict');
    }
}

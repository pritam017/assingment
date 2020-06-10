<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\District;
use App\Models\Backend\Division;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $divisions = Division::orderBy('priority', 'asc')->get();
       return view('backend.pages.division.manage',compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.division.create');
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
            'priority'=>'required',
        ]);
        $division = new Division();
        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();
        Toastr::success('New Division Added Successfully', 'Success');
        return redirect()->route('backend.admin.manageDivision');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $division = Division::find($id);
        if(!is_null($division)){
            return view('backend.pages.division.edit', compact('division'));
        }else{
            return view('backend.pages.division.manage');
        }
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
            'priority'=>'required',
        ]);
        $division =  Division::find($id);
        $division->name = $request->name;
        $division->priority = $request->priority;
        $division->save();

        Toastr::success('New Division Updated Successfully', 'Success');

        return redirect()->route('backend.admin.manageDivision');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $division =  Division::find($id);
        if(!is_null($division)){
            $districts = District::where('division_id', $division->id)->get();
            foreach($districts as $district){
                $district->delete();
            }
            $division->delete();
        }
        Toastr::success('New Division Deleted Successfully', 'Success');

        return redirect()->route('backend.admin.manageDivision');
    }
}

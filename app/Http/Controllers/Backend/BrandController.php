<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use App\Models\Backend\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use File;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $brands = Brand::orderBy('id', 'asc')->get();
        return view('backend.pages.brand.manage', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backend.pages.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(['brand_name' => 'required|max:50'],['brand_name.required' => 'This Field Should Not Be Empty']);

        $brand = new Brand;
        $brand->name = $request->brand_name;
        $brand->slug = Str::slug($request->brand_name);
        $brand->description = $request->brand_description;

        if($request->image){
            $image = $request->file('image');
            $img = time(). '.' . $image->getClientOriginalExtension();
            $location = public_path('images/brand/' . $img);
            Image::make($image)->save($location);
            $brand->image =  $img;
        }
        $brand->save();
        Toastr::success('Brand Created Successfully', 'Success');
       return redirect()->route('backend.admin.manageBrand');

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
        //
        $brand = Brand::find($id);
        return view('backend.pages.brand.edit', compact('brand'));

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
        //
        $request->validate(['brand_name' => 'required|max:50'],['brand_name.required' => 'This Field Should Not Be Empty']);
        $brand = Brand::find($id);
        $brand->name = $request->brand_name;
        $brand->slug = Str::slug($request->brand_name);
        $brand->description = $request->brand_description;

        if($request->image){
            if(File::exists('images/brand/'. $brand->image)){
                File::delete('images/brand/' . $brand->image);
            }
        $image = $request->file('image');
        $img   = time().'.'. $image->getClientOriginalExtension();
        $location = public_path('images/brand/' . $img);
        Image::make($image)->save($location);
        $brand->image = $img;
        }
        $brand->save();
        Toastr::success('Brand  Successfully Updated', 'Success');
        return redirect()->route('backend.admin.manageBrand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $brand =Brand::find($id);


            if(File::exists('images/brand/'. $brand->image)){
                File::delete('images/brand/' . $brand->image);
            }
            $brand->delete();
            Toastr::success('Brand  Successfully Deleted', 'Success');
            return redirect()->route('backend.admin.manageBrand');
    }
}


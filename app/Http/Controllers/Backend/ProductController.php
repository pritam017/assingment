<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Brand;
use App\Models\Backend\Category;
use App\Models\Backend\Product;
use App\Models\Backend\ProductImage;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('backend.pages.product.manage', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::all();
        $categories = Category::where('parent_id', 0)->get();

       return view('backend.pages.product.create', compact('brands', 'categories'));
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
        'title' => 'required|max:255',
        'description' => 'required|max:1000',
        'r_price' => 'required|numeric',
        'quantity' => 'required',
        'status' => 'required|numeric',
        'brand' => 'required|numeric',
        'category' => 'required|numeric',
        'p_image' => 'required',
       ]);
       $product = new Product();
       $product->title = $request->title;
       $product->slug = Str::slug($request->title);
       $product->description = $request->description;
       $product->regular_price = $request->r_price;
       $product->offer_price	 = $request->o_price;
       $product->quantity = $request->quantity;
       $product->is_featured = $request->feature;
       $product->status = $request->status;
       $product->category_id = $request->category;
       $product->brand_id = $request->brand;
       $product->save();

       if(count($request->p_image) > 0){
        foreach($request->p_image as $image){
            $img = rand(0,1000).'.'.$image->getClientOriginalName();
            $location = public_path('images/products/'. $img);
            Image::make($image)->save($location);
            $p_image = new ProductImage();
            $p_image->product_id = $product->id;
            $p_image->image = $img;
            $p_image->save();
        }
       }
       Toastr::success('New Product Added Successfully', 'Success');
       return redirect()->route('backend.admin.manageProduct');
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
        $product = Product::find($id);
        $brands = Brand::all();
        $categories = Category::where('parent_id', 0)->get();
        return view('backend.pages.product.edit', compact('product','brands','categories'));
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
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'r_price' => 'required|numeric',
            'quantity' => 'required',
            'status' => 'required|numeric',
            'brand' => 'required|numeric',
            'category' => 'required|numeric',
           ]);
           $product = Product::find($id);
           $product->title = $request->title;
           $product->slug = Str::slug($request->title);
           $product->description = $request->description;
           $product->regular_price = $request->r_price;
           $product->offer_price	 = $request->o_price;
           $product->quantity = $request->quantity;
           $product->is_featured = $request->feature;
           $product->status = $request->status;
           $product->category_id = $request->category;
           $product->brand_id = $request->brand;
           $product->save();

           if(count($request->p_image) > 0){
            foreach($request->p_image as $image){
                $img = rand(0,1000).'.'.$image->getClientOriginalName();
                $location = public_path('images/products/'. $img);
                Image::make($image)->save($location);
                $p_image = new ProductImage();
                $p_image->product_id = $product->id;
                $p_image->image = $img;
                $p_image->save();
            }
           }
           Toastr::success('New Product Update Successfully', 'Success');
           return redirect()->route('backend.admin.manageProduct');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        Toastr::success('New Product Delete Successfully', 'Success');
        return redirect()->route('backend.admin.manageProduct');
    }
}

<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\Backend\Category;
use App\Models\Backend\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
use File;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::orderBy('id', 'desc')->get();
        return view('backend.pages.category.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $parent_category = Category::orderBy('name', 'asc')->where('parent_id', 0)->get();
        return view('backend.pages.category.create', compact('parent_category'));
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
        $request->validate([
            'cat_name' => 'required|max:255'
        ]);


        $category = new Category();
        $category->name = $request->cat_name;
        $category->slug = Str::slug($request->cat_name);
        $category->description = $request->cat_description;
        $category->parent_id = $request->parent;

        if($request->image){
            $image = $request->file('image');
            $img  = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('images/category/' . $img);
            Image::make($image)->save($location);
            $category->image = $img;

        }

        $category->save();
        Toastr::success('New Category Successfully Created', 'Success');

        return redirect()->route('backend.admin.manageCat');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        //
        $parent_categories = Category::orderBy('name', 'asc')->where('parent_id', 0)->get();
        $category = Category::find($id);

        if(!is_null($category)){
        return view('backend.pages.category.edit', compact('parent_categories', 'category'));
        }else{
            return redirect('backend.admin.manageCat');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category, $id)
    {
        //
               //
               $request->validate([
                'cat_name' => 'required|max:255'
            ]);


            $category = Category::find($id);
            $category->name = $request->cat_name;
            $category->slug = Str::slug($request->cat_name);
            $category->description = $request->cat_description;
            $category->parent_id = $request->parent;

            if($request->image){
                //Delete Existing Image
     if(File::exists('images/category/'. $category->image)){
        File::delete('images/category/'. $category->image);
    }
                $image = $request->file('image');
                $img  = time().'.'.$image->getClientOriginalExtension();
                $location = public_path('images/category/' . $img);
                Image::make($image)->save($location);
                $category->image = $img;

            }

            $category->save();
            Toastr::success('New Category Successfully Update', 'Success');

            return redirect()->route('backend.admin.manageCat');



        }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {

            $category = Category::find($id);

        if(!is_null($category)){
            $sub_cat = Category::orderBy('name', 'asc')->where('parent_id',  $category->id)->get();

            foreach($sub_cat as $sub){
                if(File::exists('images/category/' . $sub->image)){
                    File::delete('images/category/' . $sub->image);
                }
                $sub->delete();
            }
        }
        if(File::exists('images/category/'. $category->image)){
            File::delete('images/category/'. $category->image);
        }
        $category->delete();
        Toastr::success('New Category Successfully Delete', 'Success');
        return redirect()->route('backend.admin.manageCat');
        }
    }


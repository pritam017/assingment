@extends('backend.template.layout')
@section('dashboard-content')
<div class="br-mainpanel">
    <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
        <h4>Manage Categories</h4>
        <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
      </div>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Update Category</h6>
          <div class="row mg-b-20">
            <div class="col-md">
              <div class="card card-body">
              <form action="{{route('backend.admin.updateCat', $category->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="my-input">Category Name</label>
                <input id="my-input" class="form-control" type="text" name="cat_name" value="{{$category->name}}">
                </div>
                <div class="form-group">
                    <label for="my-input">Category Description</label>
                   <textarea class="form-control" name="cat_description"id="" cols="30" rows="10">{{$category->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="my-input">Category Image</label> <br>
                    @if($category->image == NULL)
                    No Image Uploaded
                    @else
                <img src="{{asset('images/category/' . $category->image)}}" width="70" alt=""><br><br>
                @endif
                    <input id="my-input" type="file" name="image">
                </div>
                <div class="form-group">
                    <label for="my-input">Parent Name</label>
                   <select class="form-control" name="parent" id="" >
                    <option value="0">Select Parent Name (Optional)</option>
                    @foreach ( $parent_categories as $parent)
                   <option value="{{$parent->id}}" {{$parent->id == $category->parent_id ? 'selected' : ''}}>{{$parent->name}}</option>
                    @endforeach
                   </select>
                </div>
                <input type="submit" name="updateCat" class="btn btn-info" value="Update Category">
            </form>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div>
    </div>
@endsection

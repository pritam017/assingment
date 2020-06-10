@extends('backend.template.layout')
@section('dashboard-content')
<div class="br-mainpanel">
    <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
        <h4>Manage Brand</h4>
        <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
      </div>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Update Brand</h6>
          <div class="row mg-b-20">
            <div class="col-md">
              <div class="card card-body">
              <form action="{{route('backend.admin.updateBrand', $brand->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="my-input">Brand Name</label>
                <input id="my-input" class="form-control" type="text" name="brand_name" value="{{$brand->name}}">
                </div>
                <div class="form-group">
                    <label for="my-input">Brand Description</label>
                   <textarea class="form-control" name="brand_description"id="" cols="30" rows="10">{{$brand->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="my-input">Brand Image</label> <br>
                    @if($brand->image == Null)
                    No Image Uploaded <br>
                    @else
                <img src="{{asset('images/brand/'. $brand->image)}}" width="70" alt=""><br><br>
                @endif
                    <input id="my-input" type="file" name="image">
                </div>
                <input type="submit" name="updateBrand" class="btn btn-info" value="Update Brand">
            </form>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div>
    </div>
@endsection

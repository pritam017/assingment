@extends('backend.template.layout')
@section('dashboard-content')
<div class="br-mainpanel">
    <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
        <h4>Manage Product</h4>
        <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
      </div>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Create Product</h6>
          <div class="row mg-b-20">
            <div class="col-md">
              <div class="card card-body">
              <form action="{{route('backend.admin.storeProduct')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="my-input">Product Title</label>
                    <input id="my-input" class="form-control" type="text" name="title">
                </div>
                <div class="form-group">
                    <label for="my-input">Product Description</label>
                    <textarea class="form-control" name="description" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="my-input">Regular Price</label>
                    <input id="my-input" class="form-control" type="text" name="r_price">
                </div>
                <div class="form-group">
                    <label for="my-input">Offer Price</label>
                    <input id="my-input" class="form-control" type="text" name="o_price">
                </div>
                <div class="form-group">
                    <label for="my-input">Quantity</label>
                    <input id="my-input" class="form-control" type="text" name="quantity">
                </div>
                <div class="form-group">
                    <label for="my-input">Product Status</label>
                    <select name="status" class="form-control" id="">
                        <option value="">Select Product Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="my-input">Is Featured?</label>
                    <select name="feature" class="form-control" id="">
                        <option value="">Please Select Your Feacherd (Yes/No)</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="my-input">Select Brand</label>
                    <select name="brand" class="form-control" id="">
                        <option value="">Please Select Brand</option>
                        @foreach ($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="my-input">Select Category</label>
                    <select name="category" class="form-control" id="">
                        <option value="">Please Select Category</option>
                        @foreach ($categories as $parent)
                    <option value="{{$parent->id}}">{{$parent->name}}</option>
                        @foreach (App\Models\Backend\Category::where('parent_id', $parent->id)->get(); as $child)
                        <option value="{{$child->id}}">-{{$child->name}}</option>
                        @endforeach
                    @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="my-input">Product Main Thumbnail</label> <br>
                    <input type="file" name="p_image[]" class="form-control-file">
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="my-input">Thumnail 1</label>
                            <input type="file" name="p_image[]" class="form-control-file">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="my-input">Thumnail 2</label>
                            <input type="file" name="p_image[]" class="form-control-file">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="my-input">Thumnail 3</label>
                            <input type="file" name="p_image[]" class="form-control-file">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="my-input">Thumnail 4</label>
                            <input type="file" name="p_image[]" class="form-control-file">
                        </div>
                    </div>
                </div>

                <input type="submit" name="productSubmit" class="btn btn-info" value="Add New Product">
              </form>
              </div>
            </div>
        </div>
     </div>
 </div>


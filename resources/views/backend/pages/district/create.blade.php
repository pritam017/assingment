@extends('backend.template.layout')
@section('dashboard-content')
<div class="br-mainpanel">
    <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
        <h4>District</h4>
        <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
      </div>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Add New District</h6>
          <div class="row mg-b-20">
            <div class="col-md">
              <div class="card card-body">
              <form action="{{route('backend.admin.storeDistrict')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="my-input">District Name</label>
                    <input id="my-input" class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="my-input">Division Name</label>
                   <select name="division" class="form-control" id="">
                    <option value="">Select Division</option>
                    @foreach ($divisions as $division)
                   <option value="{{$division->id}}">{{$division->name}}</option>
                    @endforeach
                   </select>
                </div>
                <input type="submit" name="district" class="btn btn-info" value="Create New District">
            </form>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div>
    </div>
@endsection

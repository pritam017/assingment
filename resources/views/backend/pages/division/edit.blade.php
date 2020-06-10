@extends('backend.template.layout')
@section('dashboard-content')
<div class="br-mainpanel">
    <div class="br-pagetitle">
      <i class="icon ion-ios-home-outline"></i>
      <div>
        <h4>Division</h4>
        <p class="mg-b-0">Do bigger things with Bracket plus, the responsive bootstrap 4 admin template.</p>
      </div>
    </div>
    <div class="br-pagebody">
        <div class="br-section-wrapper">
          <h6 class="br-section-label">Update Division</h6>
          <div class="row mg-b-20">
            <div class="col-md">
              <div class="card card-body">
              <form action="{{route('backend.admin.updateDivision', $division->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="my-input">Division Name</label>
                <input id="my-input" class="form-control" value="{{$division->name}}" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="my-input">Priority</label>
                    <input id="my-input" class="form-control" value="{{$division->priority}}" type="text" name="priority">
                </div>
                <input type="submit" name="division" class="btn btn-info" value="Update Division">
            </form>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div>
    </div>
@endsection

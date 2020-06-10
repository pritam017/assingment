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
          <h6 class="br-section-label">All Category</h6>
          <div class="row mg-b-20">
            <div class="col-md">
              <div class="card card-body">
                <table class="table" id="myTable">
                    <thead class="thead-info">
                      <tr>
                        <th scope="col">#SL</th>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Image</th>
                        <th scope="col">Parent</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                         $i = 1
                        @endphp
                        @foreach ($categories as $category)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$category->name}}</td>
                            <td>{{$category->slug}}</td>
                            <td>
                              @if($category->image == NULL)
                                  No Image Attach
                              @else
                            <img src="{{asset('images/category/' . $category->image)}}" width="70" alt="">
                              @endif
                            </td>
                            <td>
                                @if($category->parent_id == 0)
                                Primary Category
                                @else
                                {{$category->parent->name}}

                                @endif

                            </td>
                            <td>
                              <a class="btn btn-info btn-sm" href="{{route('backend.admin.editCat', $category->id)}}">Update</a>
                              <button  data-toggle="modal" data-target="#deleteCat{{$category->id}}" type="button" class="btn btn-danger btn-sm" href="">Delete</button>
                            </td>
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="deleteCat{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are You Sure You Want To Delete The Category??</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('backend.admin.deleteCat', $category->id)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Yes</button>
                                    </form>
                                        <button type="button" class="btn btn-info" data-dismiss="modal">No</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                          </tr>
                          @php
                           $i++
                          @endphp
                        @endforeach

                    </tbody>
                  </table>
              </div><!-- card -->
            </div><!-- col -->
          </div><!-- row -->
        </div>
    </div>
@endsection

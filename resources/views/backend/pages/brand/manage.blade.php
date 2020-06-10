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
          <h6 class="br-section-label">Manage All Brand</h6>
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
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                         $i = 1
                        @endphp
                        @foreach ($brands as $brand)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>{{$brand->name}}</td>
                            <td>{{$brand->slug}}</td>
                            <td>
                              @if($brand->image == NULL)
                                  No Image Attach
                              @else
                            <img src="{{asset('images/brand/' . $brand->image)}}" width="70" alt="">
                              @endif
                            </td>
                            <td>
                            <a class="btn btn-info btn-sm" href="{{route('backend.admin.editBrand', $brand->id)}}">Update</a>
                              <button  data-toggle="modal" data-target="#deleteBrand{{$brand->id}}" type="button" class="btn btn-danger btn-sm" href="">Delete</button>
                            </td>
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="deleteBrand{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are You Sure You Want To Delete The Brand??</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('backend.admin.deleteBrand', $brand->id)}}" method="POST">
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
            </div>
        </div>
        </div>
        </div>
      </div>


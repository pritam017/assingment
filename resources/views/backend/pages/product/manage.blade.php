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
          <h6 class="br-section-label">Manage All Product</h6>
          <div class="row mg-b-20">
            <div class="col-md">
              <div class="card card-body">
                <table class="table" id="myTable">
                    <thead class="thead-info">
                      <tr>
                        <th scope="col">#SL</th>
                        <th scope="col">Image</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Category</th>
                        <th scope="col">Title</th>
                        <th scope="col">Slug</th>
                        <th scope="col">Description</th>
                        <th scope="col">Regular Price</th>
                        <th scope="col">Offer Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Featured</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php
                         $i = 1
                        @endphp
                        @foreach ($products as $product)
                        <tr>
                            <th scope="row">{{$i}}</th>
                            <td>
                              @php $j = 1 @endphp
                            @foreach ($product->images as $image)
                            @if($j>0)
                            <img src="{{asset('images/products/'. $image->image)}}" width="25" alt="">
                            @endif
                            @php $j-- @endphp
                            @endforeach
                        </td>
                            <td>{{$product->brand->name}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->title}}</td>
                            <td>{{$product->slug}}</td>
                            <td>{{$product->description}}</td>
                            <td>{{$product->regular_price}} BDT</td>
                            <td>
                                @if ($product->offer_price == NULL)
                                No Offer
                                @elseif($product->offer_price != NULL)
                                {{$product->offer_price}} BDT
                                @endif
                            </td>
                            <td>{{$product->quantity}} Pcs</td>
                            <td>
                                @if ($product->is_featured == 1)
                                <span class="badge badge-primary">Yes</span>
                                @elseif($product->is_featured == 0)
                                <span class="badge badge-warning">No</span>
                                @endif
                            </td>
                            <td>
                                @if ($product->status == 1)
                                <span class="badge badge-success">Active</span>
                                @elseif($product->status == 0)
                                <span class="badge badge-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                            <a class="btn btn-info btn-sm" href="{{route('backend.admin.editProduct', $product->id)}}">Update</a>
                              <button  data-toggle="modal" data-target="#deleteProduct{{$product->id}}" type="button" class="btn btn-danger btn-sm" href="">Delete</button>
                            </td>
                            <!-- Button trigger modal -->
                            <!-- Modal -->
                            <div class="modal fade" id="deleteProduct{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Are You Sure You Want To Delete The Product??</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <form action="{{route('backend.admin.deleteProduct', $product->id)}}" method="POST">
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


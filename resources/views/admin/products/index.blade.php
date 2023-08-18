@extends('layouts.admin')
@section('content')
 <div class="row">
        <div class="col-md-12">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    {{session('message')}}

                </div>            
            @endif
           <div class="card">
            <div class="card-header">
                <h3>
                    Products
                    <a name="" id="" class="btn btn-primary text-white float-end" href="{{url('admin/products/create')}}" role="button">Add Product</a>
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-primary">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Category</th>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                            <tr class="">
                                <td>{{$product->id}}</td>
                                <td>{{$product->category->name}}</td>
                                <td>{{$product->name}}</td>
                                <td>{{$product->qty}}</td>
                                <td>{{$product->selling_price}}</td>
                                <td>  @if ($product->status=='0')
                                    <span class="badge rounded-pill bg-primary">Active</span>
                                @else
                                 <span class="badge rounded-pill bg-danger">Inactive</span>
                            @endif</td>
                                <td>
                                    <a name="" id="" class="btn btn-primary" href="{{url('admin/products/edit/'.$product->id)}}"role="button">edit</a>
                                    <a name="" id="" class="btn btn-danger" href="{{url('admin/products/delete/'.$product->id)}}" role="button" onclick="return confirm('are you sure to delete??')">delete</a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No products Available</td>
                                </tr>
                            @endforelse
                          
                        </tbody>
                    </table>
                </div>
  
           </div>
        </div>
    </div>  
     @endsection
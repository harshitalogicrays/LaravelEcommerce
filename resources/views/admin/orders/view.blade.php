@extends('layouts.admin')

@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{session('message')}}

    </div>            
@endif
   <h1>My Orders Details 
    <a name="" id="" class="btn btn-danger float-end mx-1" href="{{url('admin/orders')}}" role="button">Back</a>
                    <a name="" id="" class="btn btn-primary float-end mx-1" href="{{url('admin/invoice/generate/'.$order->id)}}" role="button">Download Invoice</a>
                    <a name="" id="" class="btn btn-warning float-end mx-1" target="_blank" href="{{url('admin/invoice/'.$order->id)}}" role="button">View Invoice</a>
                    <a name="" id="" class="btn btn-info float-end mx-1" href="{{url('admin/invoice/mail/'.$order->id)}}" role="button">Send Invoice Via Mail</a>
   </h1>
   
   <hr/>
   <div class="card shadow">
     <div class="row p-2">
        <div class="col-6"><h2>Order Details</h2>  <hr/> 
            <p>Order Id: {{$order->id}}</p>
            <p>Tracking Id/No: {{$order->tracking_no}}</p>
            <p>Ordered Date: {{$order->created_at}}</p>
            <p>Payment Mode: {{$order->payment_mode}}</p>
            <p class="text-white p-3 border bg-secondary fw-bold">Order Status Message: {{$order->status_message}}</p>
                
       </div>
        <div class="col-6"><h2>User Details</h2> <hr/>
            <p>Fullname: {{$order->fullname}}</p>
            <p>Phone: {{$order->phone}}</p>
            <p>Email: {{$order->email}}</p>
            <p>Address: {{$order->address}}</p>
            <p>Pincode : {{$order->pincode}}</p>
        </div>
     </div>
     <div class="row p-2">
        <h2>Order Items</h2> <hr/>
      
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col">Item ID</th>
                        <th scope="col">Image</th>
                        <th scope="col">Product</th>
                        <th scope="col">Price</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItem as $orderItem)
                    @php
                        $totalPrice=0;
                    @endphp
                    <tr>
                        <td>{{$orderItem->id}}</td>
                        <td>
                            @if($orderItem->product->productImages)
                            <img src="{{asset($orderItem->product->productImages[0]->image)}}" style="width: 50px; height: 50px">
                            @else
                            <img src="" style="width: 50px; height: 50px" >
                            @endif                              
                        </td>
                        <td> {{$orderItem->product->name}}</td>
                        <td>{{$orderItem->price}}</td>
                        <td>{{$orderItem->quantity}}</td>
                        <td>{{$orderItem->price * $orderItem->quantity}}
                        @php
                            $totalPrice += $orderItem->price * $orderItem->quantity;
                        @endphp
                        </td>
                    </tr>
                    @endforeach
                    <tr class="fw-bold">
                        <td colspan="5">Total Price: </td>
                        <td>${{$totalPrice}}</td>
                    </tr>
                </tbody>
            </table>
         </div>
      {{-- change order status --}}
    
    
     </div>
   </div>
   <div class="row shadow mt-4 p-2">
    <div class="card">
        <div class="card-body">
            <h4>Order Process (Order Status Update)</h4>
            <hr/>
            <div class="row">
                <div class="col-5">
                    <form action="{{url('admin/orders/'.$order->id)}}" method="post">
                    @csrf
                    @method('PUT')

                    <label>Update your Order Status </label>
                    <div class="input-group">
                        <select name="order_status" class="form-select">
                            <option>Select All Status</option>
                            <option>in progress</option>
                            <option>completed</option>
                            <option>pending</option>
                            <option>cancelled</option>
                            <option>out for delivery</option>
                            <option>delivered</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                    </form>
                </div>
                <div class="col-7">
                    <h4 class="mt-3">Current Order Status: <span class="text-uppercase">
                        {{$order->status_message}}    
                    </span></h4>   
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
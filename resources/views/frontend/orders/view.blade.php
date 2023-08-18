@extends('layouts.app')

@section('content')
<div class="container">
   <h1>My Orders Details</h1>
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
      
     </div>
   </div>
</div>
@endsection
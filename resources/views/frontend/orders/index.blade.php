@extends('layouts.app')

@section('content')
<div class="container">
   <h1>My Orders</h1>
   <hr/>
   <div class="card shadow">
     <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Tracking No</th>
                    <th scope="col">Username</th>
                    <th scope="col">Payment mode</th>
                    <th scope="col">Ordered Date</th>
                    <th scope="col">Status Message</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($orders as $item)
                <tr class="">
                    <td>{{$item->id}}</td>
                    <td>{{$item->tracking_no}}</td>
                    <td>{{$item->fullname}}</td>
                    <td>{{$item->payment_mode}}</td>
                    <td>{{$item->created_at->format('d-m-Y')}}</td>
                    <td>{{$item->status_message}}</td>
                    <td>
                        <a name="" id="" class="btn btn-primary" href="{{url('orders/'.$item->id)}}" role="button">View</a>
                    </td>
                @empty
                    <tr><td colspan="7">No Orders found</td></tr>
                @endforelse
            </tbody>
        </table>
     </div>
     <div>{{$orders->links()}}</div>
   </div>
</div>
@endsection
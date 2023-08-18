@extends('layouts.admin')
@section('content')
<div class="container">
    @if (session('message'))
    <div class="alert alert-success alert-dismissible fade show">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{session('message')}}

    </div>            
@endif
    <h1>My Orders</h1>
    <hr/>
    <div class="card shadow p-4">
        <form methos="get" action="">
            <div class='row mb-3'>
                <div class="col-3">
                    <label>Filter by Date</label>
                    <input type="date" name="date" value="{{Request::get('date')}}" class="form-control">
                </div>
                <div class="col-3">
                    <label>Filter by status</label>
                    <select name="status" class="form-select">
                        <option value=''>Select All Status</option>
                        <option {{Request::get('status')=='in progress'?'selected':''}}>in progress</option>
                        <option {{Request::get('status')=='completed'?'selected':''}}>completed</option>
                        <option {{Request::get('status')=='pending'?'selected':''}}>pending</option>
                        <option {{Request::get('status')=='cancelled'?'selected':''}}>cancelled</option>
                        <option {{Request::get('status')=='out for delivery'?'selected':''}}>out for delivery</option>
                        <option {{Request::get('status')=='delivered'?'selected':''}}>delivered</option>
                   
                    </select>
                </div>
                <div class="col-6"><br/>
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </div>
                </form>

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
                         <a name="" id="" class="btn btn-primary" 
                         href="{{url('/admin/orders/'.$item->id)}}" role="button">View</a>
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
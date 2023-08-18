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
                    Slider List
                    <a name="" id="" class="btn btn-primary text-white float-end" href="{{url('admin/sliders/create')}}" role="button">Add Slider</a>
                </h3>
            </div>
            <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-primary">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($slider as $s)
                                <tr class="">
                                    <td>{{$s->id}}</td>
                                    <td>{{$s->title}}</td>
                                    
                                    <td><img src="{{asset($s->image)}}" class="img-fluid rounded" alt="">
                                        </td>
                                        <td>{{$s->description}}</td>
                                                                       <td>{{$s->status=='1'?"Inactive":'Active'}}</td>
                                    <td>
                                        <a name="" id="" class="btn btn-primary btn-sm" href="{{url('admin/sliders/edit/'.$s->id)}}" role="button">edit</a>
                                        <a name="" id="" class="btn btn-danger btn-sm" href="{{url('admin/sliders/delete/'.$s->id)}}" role="button" onclick="return confirm('are you sure to delete??')">delete</a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">No Slider Available</td>
                                    </tr>
                                @endforelse
                              
                            </tbody>
                        </table>
                    </div>
                    
            </div>
        </div>
        </div>
    </div>
    
@endsection

@extends('layouts.admin')
@section('content')

<livewire:admin.category.index/>

 {{-- <div class="row">
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
                    Category
                    <a name="" id="" class="btn btn-primary text-white float-end" href="{{url('admin/category/create')}}" role="button">Add Category</a>
                </h3>
            </div>
            <div class="card-body">
                <h4 class="card-title">Title</h4>
                <p class="card-text">Text</p>
            </div>
           </div>
        </div>
    </div>  --}}
 @endsection
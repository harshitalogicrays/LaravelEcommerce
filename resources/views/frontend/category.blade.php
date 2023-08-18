@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Categories</h1>
    <div class="row">
        @forelse ($categories as $category )
        <div class="card col-4 m-3">
            <div class="card-header">
                <img src="{{asset($category->image)}}" class="card-img-top"  height="200px"/>
            </div>
            <div class="card-body">
                <h4 class="card-title">
                    <a href="{{url('/collections/'.$category->name)}}" class="text-decoration-none">
                    {{$category->name}}</a>
                </h4>
            </div>
        </div>
        @empty
            <h1>No Category Found</h1>
        @endforelse
    
    </div>
</div>
@endsection
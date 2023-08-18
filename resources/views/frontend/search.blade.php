@extends('layouts.app')

@section('content')
<div class="row m-2">
    <div class="col-9">
        <div class="row">
            @forelse ($products as $product)
            <div class="col-md-4">
                <div class="product-card">
                    <div class="product-card-img">
                        @if ($product->qty>0)
                             <label class="stock bg-success">In Stock</label>
                        @else
                             <label class="stock bg-danger">Out of Stock</label>
                        @endif
        
                        <img src="{{asset($product->productImages[0]->image)}}" alt="Laptop" height="200px">

                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{$product->brand}}</p>
                        <h5 class="product-name">
                                    {{$product->name}}
                       
                        </h5>
                        <div>
                            <span class="selling-price">${{$product->selling_price}}</span>
                            <span class="original-price">${{$product->originial_price}}</span>
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="p-3">
                    <p>No product found</p>
                </div>
            @endforelse
        </div>
        {{$products->links()}}
    </div>
</div>
@endsection

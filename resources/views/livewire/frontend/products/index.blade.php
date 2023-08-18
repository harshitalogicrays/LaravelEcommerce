<div class="row">
    <div class="col-3">
        <div class="card">
            <div class="card-header">
                Price
            </div>
            {{-- <div class="card-body">
               <div class="form-check">
                 <input class="form-check-input" type="radio" wire:model="priceInput" name="priceSort" value="high-to-low">
                 <label class="form-check-label" for="" >
                   High to Low
                 </label>
               </div>
               <div class="form-check">
                 <input class="form-check-input" type="radio"  wire:model="priceInput" name="priceSort" value="low-to-high">
                 <label class="form-check-label" for="">
                   Low to High
                 </label>
               </div>
            </div> --}}
            <div class="card-body">
                <div class="form-check">
                  <input class="form-check-input" type="radio" wire:model="priceInput" name="priceSort" value="in1000">
                  <label class="form-check-label" for="" >
                    Below 1000
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input" type="radio"  wire:model="priceInput" name="priceSort" value="in2000">
                  <label class="form-check-label" for="">
                    below 2000
                  </label>
                </div>
             </div>
        </div>
    </div>
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
                        <a href="{{url('/collections/'.$category->name.'/'.$product->name)}}">
                        <img src="{{asset($product->productImages[0]->image)}}" alt="Laptop" height="200px">
                        </a>
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{$product->brand}}</p>
                        <h5 class="product-name">
                           <a href="{{url('/collections/'.$category->name.'/'.$product->name)}}">
                                {{$product->name}}
                           </a>
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
                    <p>No product found for {{$category->name}}</p>
                </div>
            @endforelse
        </div>
    </div>
</div>


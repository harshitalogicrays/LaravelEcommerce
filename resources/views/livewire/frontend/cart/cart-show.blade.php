<div class="py-3 py-md-5 bg-light">
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <div class="shopping-cart">

                    <div class="cart-header d-none d-sm-none d-mb-block d-lg-block">
                        <div class="row">
                            <div class="col-md-4">
                                <h4>Products</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Price</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Quantity</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Total Price</h4>
                            </div>
                            <div class="col-md-2">
                                <h4>Remove</h4>
                            </div>
                        </div>
                    </div>
                    @forelse ($cart as $c )
                    <div class="cart-item">
                        <div class="row bg-white mb-4">
                            <div class="col-md-4 my-auto ">
                                <a href="">
                                    <label class="product-name">
                                       @if($c->product->productImages)
                                        <img src="{{asset($c->product->productImages[0]->image)}}" style="width: 50px; height: 50px">
                                        @else
                                        <img src="" style="width: 50px; height: 50px" >
                                        @endif      
                                        {{$c->product->name}}
                                    </label>
                                </a>
                            </div>
                            <div class="col-md-2 my-auto">
                                <label class="price">${{$c->product->selling_price}} </label>
                            </div>
                            <div class="col-md-2 col-7 my-auto">
                                <div class="quantity">
                                    <div class="input-group">
                                        <span class="btn btn1" wire:loading:attr="disabled" wire:click="decreaseQty({{$c->id}})">-</span>
                                        <input type="text"   value="{{$c->quantity}}" readonly class="input-quantity" style="width: 40px" />
                                        <span class="btn btn1"  wire:loading:attr="disabled"  wire:click="increaseQty({{$c->id}})">+</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2 my-auto">
                                <label class="price">${{$c->product->selling_price * $c->quantity }} 
                                @php
                                    $totalPrice += $c->product->selling_price * $c->quantity  
                                @endphp
                                </label>
                            </div>
                            <div class="col-md-2 col-5 my-auto">
                                <div class="remove">
                                    <button type="button" class="btn btn-danger btn-sm" wire:loading:attr="disabled" wire:click="removeCartItem({{$c->id}})">
                                        <span wire:loading.remove wire:target="removeCartItem({{$c->id}})"> <i class="bi bi-trash"></i> Remove </span>
                                        <span wire:loading wire:target="removeCartItem({{$c->id}})" > <i class="bi bi-trash"></i> Removing </span>
      
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <h1>No item in cart</h1>
                    @endforelse
                  
                            
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-8">Get the best deals and offers</div>
            <div class="col-4">
                    <div class="p-3 bg-white">
                        <h4>Total : <span class="float-end">${{$totalPrice}}</span></h4>
                        <hr/>
                        <div class="d-grid gap-2">
                          <a href="{{url('checkout')}}" type="button" name="" id="" class="btn btn-warning">Checkout</a>
                        </div>
            </div>
        </div>
    </div>
</div>

 c
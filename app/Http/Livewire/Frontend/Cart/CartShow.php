<?php

namespace App\Http\Livewire\Frontend\Cart;

use App\Models\Cart;
use Livewire\Component;

class CartShow extends Component
{   public $cart,$totalPrice=0;
    public function render()
    {   $this->cart=Cart::where('user_id',auth()->user()->id)->get();
        return view('livewire.frontend.cart.cart-show',['cart'=>$this->cart]);
    }

    public function decreaseQty($cartId){
        $cartData=Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->quantity>1){
            $cartData->decrement('quantity');
            $this->dispatchBrowserEvent('message',[
                'text'=>'Qty decrease by 1',
                'type'=>'success',
                'status'=>200
            ]);
        }
        }
        else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'something went wrong',
                'type'=>'error',
                'status'=>404
            ]);
        }
    }
    public function increaseQty($cartId){
        $cartData=Cart::where('id',$cartId)->where('user_id',auth()->user()->id)->first();
        if($cartData){
            if($cartData->product->qty > $cartData->quantity){
            $cartData->increment('quantity');
            $this->dispatchBrowserEvent('message',[
                'text'=>'Qty increase by 1',
                'type'=>'success',
                'status'=>200
            ]);
        }
    }
        else{
            $this->dispatchBrowserEvent('message',[
                'text'=>'something went wrong',
                'type'=>'error',
                'status'=>404
            ]);
        }
    }

    public function removeCartItem($cartId){
        Cart::where('user_id',auth()->user()->id)->where('id',$cartId)->delete();
        $this->emit('cartAddedorUpdated');
        $this->dispatchBrowserEvent('message',[
            'text'=>'product deleted from cart',
            'type'=>'success',
            'status'=>200
        ]);
    }
}

<?php

namespace App\Http\Livewire\Frontend\Products;

use App\Models\Cart;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Viewproducts extends Component
{
    public $product;
    public $category;
    public $qtycount=1;
    public function mount($product,$category){
        $this->product=$product;
        $this->category=$category;
        $this->qtycount=1;
    }
    public function decrementQty(){
        if($this->qtycount>1)
            $this->qtycount--;
    }
    public function incrementQty(){
        if($this->qtycount < $this->product->qty)
         $this->qtycount++;
    }
    public function render()
    {
        return view('livewire.frontend.products.viewproducts',['product'=>$this->product,'category'=>$this->category]);
    }
    // public function wishlist(){
    //     if(Auth::check()){
    //        return view('livewire.frontend.products.viewproducts'); 
    //     }
    //     else{
    //         return redirect('/login');
    //     }
    // }


    public function addtocart($productId){
        if(Auth::check()){
          if($this->product->where('id',$productId)->where('status','0')->exists()){
            if(Cart::where('user_id',auth()->user()->id)->where('id',$productId)->exists()){
                $this->dispatchBrowserEvent('message',[
                    'text'=>'Product already added',
                'type'=>'info', 'status'=>201
                ]); }
            else{
            Cart::create([
                'user_id'=>auth()->user()->id,
                'product_id'=>$productId,
                'quantity'=>$this->qtycount
            ]);
            $this->emit('cartAddedorUpdated');
            $this->dispatchBrowserEvent('message',[
                'text'=>'Product added',
                'type'=>'success',
                'status'=>200
            ]);
          }
        }
          else{
            $this->dispatchBrowserEvent('message',[
                        'text'=>'Product does not found',
                        'type'=>'info',
                        'status'=>404
                    ]);
        }
        }
        else{
            $this->dispatchBrowserEvent('message',[
                        'text'=>'Please login first',
                        'type'=>'info',
                        'status'=>404
                    ]);
        }
    }
  
}

<?php

namespace App\Http\Livewire\Frontend\Checkout;

use App\Models\Cart;
use App\Models\Order;
use Livewire\Component;
use App\Models\OrderITem;
use Illuminate\Support\Str;

class CheckoutShow extends Component
{
    public $carts,$totalAmount=0;
    public $fullname,$email,$phone,$pincode,$address;
    public $payment_mode=null,$payment_id=null;
    protected $listeners=['validationForAll','transactionEmit'=>'paidOnlineOrder'];
    public function rules(){
        return [
            'fullname'=>'required|string|max:120',
            'email'=>'required|email',
            'phone'=>'required|string|max:10|min:10',
            'pincode'=>'required|string|max:6|min:6',
            'address'=>'required|string|max:500'
        ];
    }

    public function validationForAll(){
        $this->validate();
    }

    public function placeOrder(){
        $this->validate();
        $order=Order::create([
            'user_id'=>auth()->user()->id,
            'tracking_no'=>Str::random(10),
            'fullname'=>$this->fullname,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'pincode'=>$this->pincode,
            'address'=>$this->address,
            'status_message'=>'in progress',
            'payment_mode'=>$this->payment_mode,
            'payment_id'=>$this->payment_id
        ]);
        foreach($this->carts as $cartITem){
            OrderITem::create([
                'order_id'=>$order->id,
                'product_id'=>$cartITem->product_id,
                'quantity'=>$cartITem->quantity,
                'price'=>$cartITem->product->selling_price
                ]);
                $cartITem->product()->where('id',$cartITem->product_id)->decrement('qty',$cartITem->quantity);
           }
           return $order;
    }
    public function CodOrder(){
        $this->payment_mode='cash on delivery';
       $codOrder=$this->placeOrder();
       if($codOrder){
        Cart::where('user_id',auth()->user()->id)->delete();
        $this->dispatchBrowserEvent('message',[
            'text'=>'Order placed successfully',
            'type'=>'success',
            'status'=>200
        ]);
        return redirect()->to('thank-you');
       }
       else{
        $this->dispatchBrowserEvent('message',[
            'text'=>'something went wrong',
            'type'=>'error',
            'status'=>404
        ]);
       }
    }

    public function paidOnlineOrder($val){
        $this->payment_id=$val;
        $this->payment_mode="Paid Online";
        $paypalorder=$this->placeOrder();
    if($paypalorder){
        Cart::where('user_id',auth()->user()->id)->delete();
        $this->dispatchBrowserEvent('message',[
            'text'=>'Order placed successfully',
            'type'=>'success',
            'status'=>200
        ]);
        return redirect()->to('thank-you');
    }
    else{
        $this->dispatchBrowserEvent('message',[
            'text'=>'something went wrong',
            'type'=>'error',
            'status'=>404
        ]);
    }
}	


    public function totalProductAmount(){
        $this->totalAmount=0;
		$this->carts=Cart::where('user_id',auth()->user()->id)->get();
        foreach($this->carts as $cartITem){
         $this->totalAmount += $cartITem->product->selling_price*$cartITem->quantity;
        }
        return $this->totalAmount;
    }

    public function render()
    {   $this->totalAmount=$this->totalProductAmount();
        $this->fullname=auth()->user()->name;
        $this->email=auth()->user()->email; 
        return view('livewire.frontend.checkout.checkout-show',[
            'totalAmount'=>$this->totalAmount
        ]);
    }
}

<?php

namespace App\Http\Livewire\Frontend\Products;

use App\Models\Product;
use Livewire\Component;

class Index extends Component
{  
    public $products,$category;
    public $priceInput;
    protected $queryString=[
        'priceInput'=>['except'=>'','as'=>'price']
    ];
    public function mount($products,$category){
        $this->products=$products;
        $this->categroy=$category;
        $this->priceInput='';
    }
 

    public function render()
    {      
        //  $this->products=Product::where('category_id',$this->category->id)
        //      ->when($this->priceInput,function($q){
        //         $q->when($this->priceInput=='high-to-low',function($q2){
        //         $q2->orderBy('selling_price','DESC');
        //         })->when($this->priceInput=='low-to-high',function($q2){
        //         $q2->orderBy('selling_price','ASC');
        //         });
        //         })
        //       ->where('status','0')->get();

        $this->products=Product::where('category_id',$this->category->id)
        ->when($this->priceInput,function($q){
           $q->when($this->priceInput=='in1000',function($q2){
           $q2->where('selling_price','<=',1000);
           })->when($this->priceInput=='in2000',function($q2){
           $q2->where('selling_price','<=',2000);
           });
           })
         ->where('status','0')->get();
            return view('livewire.frontend.products.index',['products'=>$this->products,'category'=>$this->category]);
    }
}

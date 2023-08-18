<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendController extends Controller
{
    public function index(){
        $slider=Slider::where('status','0')->get();
        return view('frontend.index',compact('slider'));
    }

    public function categories(){
        $categories=Category::where('status','0')->get();
        return view('frontend.category',compact('categories'));
    }

    public function cproducts($category){
        $category=Category::where('name',$category)->first();
        if($category){
            $products=$category->products()->get();
            return view('frontend.cproducts',compact('category','products'));
        }
        else{
            return redirect('/collections');
        }
       
    }

    public function viewproduct(string $category,string $product){
        $category=Category::where('name',$category)->first();
        if($category){
            $product=$category->products()->where('name',$product)->first();
            if($product)
                 return view('frontend.viewproducts',compact('product','category'));
        }
        else{
            return redirect('/collections');
        }     
    }

    public function thankYou(){
        return view('frontend.thank-you');
    }

    public function searchproduct(Request $request){
        if($request->search!=null){
           $products=Product::where('name','Like','%'.$request->search.'%')->latest()->paginate(2);
           return view('frontend.search',compact('products'));
        }
        else{
            return redirect()->to('/collections');
        }
    }
}

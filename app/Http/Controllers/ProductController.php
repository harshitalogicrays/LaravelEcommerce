<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProductFormRequest;

class ProductController extends Controller
{
    public function index(){
           $products= Product::all();
        return view('admin.products.index',compact('products'));
    }
    public function create(){
        $categories=Category::all();
        return view('admin.products.create',compact('categories'));
    }

    public function add(ProductFormRequest $request ){
        $validatedData=$request->validated();
        $categry=Category::FindOrFail($validatedData['category_id']); // electronics
        $product=$categry->products()->create([
            'category_id'=>$validatedData['category_id'],
            'name'=>$validatedData['name'],
            'brand'=>$request['brand'],
            'selling_price'=>$validatedData['selling_price'],
            'originial_price'=>$validatedData['originial_price'],
            'qty'=>$validatedData['qty'],
            'status'=>$request->status==true?'0':'1',
            'descritpion'=>$request['descritpion']        
        ]);
        if($request->hasFile('image')){
            $uploadPath='uploads/products/';
            // print_r($request->file('image'));
            $i=1;
            foreach($request->file('image') as $imagefile){
                $extension=$imagefile->getClientOriginalExtension();
                $filename=time().$i++. '.'.$extension;
                $imagefile->move($uploadPath,$filename);
                $finalImagePathName=$uploadPath.$filename;

                $product->productImages()->create([
                    'product_id'=>$product->id,
                    'image'=>$finalImagePathName
                ]);
            }  
        }
        return redirect('/admin/products')->with('message','Product Added');
    }
    
    public function edit($id){
        $categories= Category::all();
        $product=Product::find($id);
     return view('admin.products.edit',compact('categories','product'));
 }

 public function update(ProductFormRequest $request,$product ){
    $validatedData=$request->validated();
    $product=Category::FindOrFail($validatedData['category_id'])->products()->where('id',$product)->first();
    if($product){
        $product->update([
            'category_id'=>$validatedData['category_id'],
            'name'=>$validatedData['name'],
            'brand'=>$request['brand'],
            'selling_price'=>$validatedData['selling_price'],
            'originial_price'=>$validatedData['originial_price'],
            'qty'=>$validatedData['qty'],
            'status'=>$request->status==true?'0':'1',
            'descritpion'=>$request['descritpion']                       
        ]);
        if($request->hasFile('image')){
            $uploadPath='uploads/products/';
            $i=1;
            foreach($request->file('image') as $imagefile){
                $extension=$imagefile->getClientOriginalExtension();
                $filename=time().$i++. '.'.$extension;
                $imagefile->move($uploadPath,$filename);
                $finalImagePathName=$uploadPath.$filename;
                $product->productImages()->create([
                    'product_id'=>$product->id,
                    'image'=>$finalImagePathName
                ]);
            }
        }
         return redirect('/admin/products')->with('message','Product updated');
    
 }  
 else{
    return redirect('admin/products')->with('message','No such product ID found');
 }            
 }

 public function destroy($image){
    $productimage=ProductImage::FindOrFail($image);
    if(File::exists($productimage->image)){
        File::delete($productimage->image);
    }
   $productimage->delete();
     return redirect()->back()->with('message','image deleted');
}

public function delete($id){
    $product=Product::find($id);
    if($product->productImages()){
        foreach($product->productImages() as $image)
            {
                if(File::exists($image->image)){
                    File::delete($image->image);
                }
            }
    }
    $product->delete();
    return redirect()->back()->with('message','product deleted');
}

}

<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index(){
        return view('admin.category.index');
    }
    public function create(){
        return view('admin.category.create');
    }
    
    public function add(Request $request){
        $request->validate([
            'name'=>'required']);
        $category=new Category;
        $category->name=$request->name;
        $category->status=$request->status==true?'0':'1';
        $category->description=$request->description;
        if($request->hasFile('image')){
            $uploadPath='uploads/category/';
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move($uploadPath,$filename);
            $category->image=$uploadPath.$filename;
            }
        if($category->save()){
            return redirect('admin/category')->with('message','category added');
        }
    }

    public function edit(Category $category){
        return view('admin.category.edit',compact('category'));
    }
    public function update(Request $request,$category){
        $category=Category::Find($category);
        $category->name=$request->name;
        $category->status=$request->status==true?'0':'1';
        $category->description=$request->description;
        if($request->hasFile('image')){
            if(File::Exists($category->image))
                File::delete($category->image);
            $uploadPath='uploads/category/';
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move($uploadPath,$filename);
            $category->image=$uploadPath.$filename;
        }
        if($category->update()){
            return redirect('admin/category')->with('message','category updated');
        }

    }
}

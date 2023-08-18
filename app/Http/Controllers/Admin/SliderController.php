<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function index(){
        $slider=Slider::all();
        return view('admin.slider.index',compact('slider'));
    }

    public function create(){
        return view('admin.slider.create');
    }
    public function add(Request $request ){
        $path='';
        if($request->hasFile('image')){
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
           $path="uploads/slider/$filename";
        }
        Slider::create([
            'title'=>$request['title'],
            'description'=>$request['description'],
            'image'=>$path,
            'status'=>$request['status']==true?'0':'1'
        ]);
        return redirect('admin/sliders')->with('message','Slider added successfully');
    }

    public function edit(Slider $slider){
        // return $slider;
        // die;
        return view('admin.slider.edit',compact('slider'));
    }

    public function update(Request $request,Slider $slider){
        $path='';
        if($request->hasFile('image')){
            $dest=$slider->image;
            if(File::exists($dest)){
                File::delete($dest);
            }
            $file=$request->file('image');
            $ext=$file->getClientOriginalExtension();
            $filename=time().'.'.$ext;
            $file->move('uploads/slider/',$filename);
           $path="uploads/slider/$filename";
        }
        else{
            $path=$slider->image;
        }
        Slider::where('id',$slider->id)->update([
            'title'=>$request['title'],
            'description'=>$request['description'],
            'image'=>$path,
            'status'=>$request['status']==true?'0':'1'
        ]);
        return redirect('admin/sliders')->with('message','Slider updated successfully');
    }

    public function delete($id){
        $s=Slider::find($id);
        if($s->image){
                    if(File::exists($s->image)){
                        File::delete($s->image);
                    }
                }
           $s->delete();
        return redirect()->back()->with('message','slider deleted');
    }
}

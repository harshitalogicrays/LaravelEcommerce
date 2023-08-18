<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use withPagination;
class Index extends Component
{   
    public function render()
    {      
        // $categories=Category::all();
            $categories=Category::orderby("created_at","desc")->paginate(2);       
            return view('livewire.admin.category.index',compact('categories'));
    }

    public function deleteCategory($id){
        Category::find($id)->delete();
        session()->flash('message','category deleted');
    }

}


<?php

namespace App\Models;

use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    protected $table="products";
    protected $fillable=[
        'name','brand','description','category_id','selling_price','originial_price','status','qty'
    ];
	
    public function productImages(){
        return $this->hasMany(ProductImage::class,'product_id','id');
   }

   public function category(){
    return $this->belongsTo(Category::class,'category_id','id'); 
   }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['id','customer_id','blog_id','comment', 'created_at', 'updated_at'];

    public function prod() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
    public function custm() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }
    public function blog() {
        return $this->hasOne(Blog::class, 'id', 'blog_id');
    }
    
    public function scopeMyfillter($query){
        $key = request('keyword');
        $cat_id = request('cat_id');
        $order = request('order');
        if($key){
            $query = $query->where('name', 'LIKE', '%'.$key.'%');
        }
        if($cat_id){
            $query = $query->where('category_id', $cat_id);  
        }
        if($order){
            $arr = explode('-', $order);
            $query = $query->orderBy($arr[0], $arr[1]);  
        }
        return $query;
    }
}

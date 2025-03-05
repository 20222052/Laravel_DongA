<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'link', 'image', 'position', 'description', 'prioty', 'status'];

    public function scopeGetBanner($q, $pos = 'top-banner') {
        $q = $q->where('position', $pos)
        ->where('status', 1)->orderBy('prioty', 'ASC');

        return $q;
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

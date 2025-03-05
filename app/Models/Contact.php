<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'subject', 'message', 'status'];

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

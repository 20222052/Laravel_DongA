<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status'];


    protected $hidden = ['created_at','updated_at'];

    // 1 - n
    public function products() {
        return $this->hasMany(Product::class, 'category_id','id')->orderBy('created_at','DESC');
    }
}

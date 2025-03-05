<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'customer_id'];

    public function prod() {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}

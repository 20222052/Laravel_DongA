<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $appends = ['totalPrice'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'token',
        'customer_id',
        'status',
        'payment_method', 
        'transactionId'
    ];

    public function customer() {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    public function details() {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function getTotalPriceAttribute() {
        $t = 0;

        foreach($this->details as $item) {
            $t += $item->price * $item->quantity;
        }

        return $t;
    }


    public function scopeMyfillter($query){
        $order = request('order');
        $status = request('status');
        if($status){
            $query = $query->where('status', $status);  
        }
        if($order){
            $arr = explode('-', $order);
            $query = $query->orderBy($arr[0], $arr[1]);  
        }
        return $query;
    }
}

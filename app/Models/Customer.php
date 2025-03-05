<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'gender'
    ];

    public function carts() {
        return $this->hasMany(Cart::class, 'customer_id', 'id');
    }
    public function orders() {
        return $this->hasMany(Order::class, 'customer_id', 'id')->orderBy('id','DESC');
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function favorites() {
        return $this->hasMany(Favorite::class, 'customer_id', 'id');
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

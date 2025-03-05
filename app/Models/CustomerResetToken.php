<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerResetToken extends Model
{
    use HasFactory;
    protected $fillable = ['email', 'token'];

    public function customer() {
        return $this->hasOne(Customer::class, 'email','email');
    }

    public function scopeCheckToken($q, $token) {
        return $q->where('token', $token)->firstOrFail();
    }
}

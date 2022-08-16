<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $fillable=['user_id','price','isActive'];

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function transactions(){
        return $this->belongsToMany(Transaction::class);
    }

    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}

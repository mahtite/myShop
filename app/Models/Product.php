<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'user_id','title','text','price','amount','view','metaTitle','metaDescription'
    ];

    public function comments()
    {
        return $this->morphMany(Comment::class,'commentable');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function attributes()
    {
        return $this->belongsToMany(Attribute::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function userFavorites()
    {
        return $this->belongsToMany(User::class);
    }


    function attributesP() {
        return $this->hasMany(AttributeProduct::class); // assuming that product_attributes table has product_id column in it.
    }
}

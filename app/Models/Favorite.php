<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id' , 'product_id'];

    public static function countFavoriteList($product_id)
    {
        if (auth()->check())
        {
            $countFavortie = Favorite::where(['user_id' => auth()->user()->id,
                'product_id' => $product_id
            ])->count();
            return $countFavortie;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

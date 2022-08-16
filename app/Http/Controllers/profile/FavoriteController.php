<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function favoritesList()
    {
        if (auth()->check()) {
            $user = auth()->user()->id;
            $favorites = Favorite::where('user_id', $user)->get();
            return view('profile.favorites.favoriteList', compact('favorites'));
        }
        return back();
    }

  /*  public function addFavoriteProduct(Product $product,Request $request)
    {


        $product=Product::findOrFail($request->product_id);
        // $products=Product::all();
        $countF=Favorite::countFavoriteList($request->product_id);

        if (auth()->check())
        {
            if($countF ==0 )
            {
               $favorites= Favorite::create([
                    'product_id' => $product->id,
                    'user_id' => auth()->user()->id
                ]);
                return response()->json(['success' => 's']);

              //  return view('product-single',compact('favorites'))->render();
            }
            else
            {
                return response()->json(['err'=>'err']);
            }
        }
        else {
            return back();
        }
    }*/

    public function destroyFavorite($id)
    {
        $favorite=Favorite::Where('user_id',auth()->user()->id)->where('product_id',$id)->delete();
        toast()->info('حذف انجام شد');
        return back();
    }
}

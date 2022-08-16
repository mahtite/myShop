<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','HomeController@home');

//Admin
Route::prefix('dashboard')->group(function (){
    Route::get('/','Admin\AdminController@index');
    Route::resource('/users','Admin\UserController');
    Route::resource('/categories','Admin\CategoryController');
    Route::resource('/products','Admin\ProductController');
    Route::resource('/comments','Admin\CommentController');
    Route::get('/comments-unapproved','Admin\CommentController@getUnapproved')->name('unapproved.get');
    Route::patch('/comments-unapproved/{comment}','Admin\CommentController@postUnapproved')->name('unapproved.post');
    //Attribute
    Route::resource('/attributes','Admin\AttributeController');
    Route::get('/attributes/values/{attribute}','Admin\AttributeController@getValues')->name('get.values');
    Route::post('/attributes/values','Admin\AttributeController@postValues')->name('post.values');
    Route::get('/attributes/values/edit/{attributeValue}','Admin\AttributeController@editValue')->name('edit.values');
    Route::patch('/attributes/values/update/{attributeValue}','Admin\AttributeController@updateValue')->name('update.values');
    Route::delete('/attributes/values/{attributeValue}','Admin\AttributeController@deleteValue')->name('delete.values');
    //Permission
    Route::resource('/permissions','Admin\PermissionController');
    Route::resource('/roles','Admin\RoleController');

    Route::get('/user-roles/{user}','Admin\UserController@addRole')->name('users.roles');
    Route::patch('/user-roles/{user}','Admin\UserController@updateRole')->name('update.roles');

    //Orders
    Route::resource('/orders','Admin\OrderController');
    Route::get('/orders/invoice/{id}','Admin\OrderController@invoiceShow')->name('invoiceShow');
    Route::patch('/orders/invoice/{id}','Admin\OrderController@invoiceStatus')->name('invoice.Status');

    //Chart
    Route::get('/charts','Admin\ChartController@index')->name('charts');
    Route::get('chart_export', 'Admin\ChartController@getChartData')->name('chart.export');

    //Gallery
    Route::resource('/gallery','Admin\GalleryController');
    //Copy
    Route::get('/orders/copy/{id}','Admin\OrderController@copy')->name('infoCopy');
});


//Auth Google
Route::get('/auth/google', 'Auth\GoogleAuthController@redirect')->name('auth.google');
Route::get('/auth/google/callback','Auth\GoogleAuthController@callback');

//Auth Token
Route::get('/auth/token', 'Auth\AuthTokenController@getToken')->name('auth.token');
Route::post('/auth/token','Auth\AuthTokenController@postToken');

//Profile
Route::prefix('profile')->group(function (){
    Route::get('/', 'profile\ProfileController@home')->name('profile');
    Route::get('/twofactor', 'profile\ProfileController@twofactorauth')->name('twofactor');
    Route::post('/twofactor', 'profile\ProfileController@sendtwofactorauth')->name('send.twoFactor');

    //TWOFACTORTYE PHONEVERIFY
    Route::get('/twofactor/phoneverify', 'profile\ProfileController@getPhoneVerify')->name('phoneVerify');
    Route::post('/twofactor/phoneverify', 'profile\ProfileController@postPhoneVerify');
    //Orders
    Route::get('/orders', 'profile\ProfileController@orders')->name('orders');

    //Favorites
    Route::get('/favoritesList', 'profile\FavoriteController@favoritesList')->name('favoritesList');
    Route::delete('/favoritesDelete/{id}', 'profile\FavoriteController@destroyFavorite')->name('deleteFavorite');

});

//Product Client
Route::get('/products', 'ProductController@index');
Route::get('/products/{product}', 'ProductController@singleProduct');
//Favorite
Route::post('/productsF', 'ProductController@addFavoriteProduct')->name('favorites');


//Search
Route::get('/productsSearch', 'SearchController@search')->name('search');
//Route::get('/productsSearchAjax', 'SearchController@searchAjax');
//Route::get('/productsCategory','SearchController@show')->name('show');
Route::get('/status/show', 'SearchController@showStatus')->name('show.status');
#Product Price-Fiter-Example
Route::any('/productsPrice','PriceFilterController@productshop')->name('product.shop');

//Cart
Route::resource('/carts', 'CartController');

//Compare
Route::get('/products/compare/{product}', 'compareController@compareProduct')->name('compare.Product');
Route::get('/getProduct/{id}','compareController@getProduct');

Route::delete('/products/compare/{product}', 'compareController@compareProductDelete')->name('compare.delete');


//Comment
Route::post('/products/comments', 'CommentController@sendcomment')->name('sendComment');

Route::get('/product/{id}/purchase', 'PurchaseController@purchase')->name('payment.product');
Route::get('/product/{id}/purchase/result', 'PurchaseController@result')->name('payment.product.result');


Auth::routes(['verify'=>true]);



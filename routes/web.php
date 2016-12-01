<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');


/** Get the view for Cart Page **/
Route::get('/cart', array(
    'before' => 'auth.basic',
    'as'     => 'cart',
    'uses'   => 'CartController@showCart'
));


/** Add items in the cart **/
Route::post('/cart/add', array(
    'before' => 'auth.basic',
    'uses'   => 'CartController@postAddToCart'
));

/** Delete items in the cart **/
Route::get('/cart/delete/{id}', array(
    'before' => 'auth.basic',
    'as'     => 'delete_product_from_cart',
    'uses'   => 'CartController@getDelete'
));
/** Update items in the cart **/
Route::post('/cart/update', [
    'uses' => 'CartController@update'
]);

Route::post('/order', array('before'=>'auth.basic','uses'=>'OrderController@postOrder'));
Route::get('/user/orders', array('before'=>'auth.basic','uses'=>'OrderController@getIndex'));





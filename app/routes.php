<?php

Route::any('/', function(){
    return View::make('home');
});

Route::any('home', function(){
    return View::make('home');
});

Route::any('info', function(){
    if (Session::has('message')) {
        return View::make('info');
    }
    return Redirect::to('home');
});

Route::any('products/{categoria}/{subcategoria}', function($categoria, $subcategoria){
    $subcat = Category::where('name', $subcategoria)->get();
    $productos = $subcat->first()->products;
    return View::make('testProducts', ['productos' => $productos]);
});

Route::controller('user', 'UserController');
Route::controller('account', 'RegistrationController');



Route::group(array('before' => array('auth|admin')), function()
{
    Route::any('admin', function(){
        return View::make('admin/menu');
    });
    
    Route::any('ajax/{categoria}', function($categoria){
        $productos = Product::where('category_id', '=', $categoria)->paginate(10);
        return View::make('admin/productos')->with('productos', $productos);
    });
    
    Route::resource('admin/category', 'CategoriesController');
    Route::resource('admin/product', 'ProductsController');
    
    Route::any('admin/xml', 'XMLController@xml');
});

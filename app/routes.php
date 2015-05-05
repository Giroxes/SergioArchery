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

Route::any('admin', function(){
    return View::make('admin/menu');
});

Route::any('products', function(){
    $categorias = Category::where('parent_id','=',null)->get();
    return View::make('test', ['categorias' => $categorias]);
});

Route::any('products/{categoria}', function($categoria){
    $parent = Category::where('name', $categoria)->get();
    $categorias = $parent->first()->subcategories;
    return View::make('test', ['categorias' => $categorias]);
});

Route::any('products/{categoria}/{subcategoria}', function($categoria, $subcategoria){
    $subcat = Category::where('name', $subcategoria)->get();
    $productos = $subcat->first()->products;
    return View::make('testProducts', ['productos' => $productos]);
});

Route::controller('user', 'UserController');
Route::controller('account', 'RegistrationController');
Route::resource('admin/category', 'CategoriesController');
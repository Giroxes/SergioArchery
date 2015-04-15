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
    return View::make('home');
});

Route::controller('user', 'UserController');
Route::controller('account', 'RegistrationController');
<?php

Route::any('/', function(){
    return View::make('home');
});

Route::controller('user', 'UserController');
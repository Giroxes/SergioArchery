<?php

Route::group(["before" => "guest"], function()
{
    Route::any("/", [
        "as" => "user/login",
        "uses" => "UserController@loginAction"
    ]);

    Route::get("/request", [
        "as" => "user/request",
        "uses" => "RemindersController@getRemind"
    ]);
    
    Route::post("/request", [
        "as" => "user/request",
        "uses" => "RemindersController@postRemind"
    ]);

    Route::get("/reset", [
        "as" => "user/reset",
        "uses" => "RemindersController@getReset"
    ]);
    
    Route::post("/reset", [
        "as" => "user/reset",
        "uses" => "RemindersController@postReset"
    ]);
});

Route::group(["before" => "auth"], function()
{
    Route::any("/profile", [
        "as" => "user/profile",
        "uses" => "UserController@profileAction"
    ]);

    Route::any("/logout", [
        "as" => "user/logout",
        "uses" => "UserController@logoutAction"
    ]);
});
<?php

Route::group(["before" => "guest"], function()
{
    Route::any("/", [
        "as" => "user/login",
        "uses" => "UserController@loginAction"
    ]);

    Route::any("/request", [
        "as" => "user/request",
        "uses" => "RemindersController@getRemind"
    ]);
    
    Route::any("/request2", [
        "as" => "user/request2",
        "uses" => "RemindersController@postRemind"
    ]);

    Route::any("/reset", [
        "as" => "user/reset",
        "uses" => "RemindersController@getReset"
    ]);
    
    Route::any("/reset2", [
        "as" => "user/reset2",
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
<?php

use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Response as Response2;


const CLIENT_ID = '770774477781-ij9l2nd57cp58130698fippismo36ao4.apps.googleusercontent.com';
const CLIENT_SECRET = 'xcF3X6QigmE81HwSpzEoQuwf';

$client = new Google_Client();
$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri('postmessage');
$GLOBALS['cliente'] = $client;

$plus = new Google_Service_Plus($client);
$GLOBALS['plus'] = $plus;


/*
 * Rutas para Google Plus
 */

Route::group(['prefix' => 'user/profile'], function () {

    Route::post('/connect', function () {
        
       $client = $GLOBALS['cliente'];
        $token = Session::get('token');

        if (empty($token)) {
            
            if (Input::get('state') != (Session::get('state'))) {
                return new Response('Invalid state parameter', 401);
            }

            $data = Input::all();
            $client->authenticate($data['code']);
            $token = json_decode($client->getAccessToken());
            
            $attributes = $client->verifyIdToken($token->id_token, CLIENT_ID)
                ->getAttributes();
            $gplus_id = $attributes["payload"]["sub"];

            Session::put('token', json_encode($token));
            $response = 'Successfully connected with token: ' . print_r($token, true);
        } else {
            $response = 'Already connected';
        }

        return new Response($response, 200);
    });
    
    Route::get('/people', function () {
        $token = Session::get('token');
        $client = $GLOBALS['cliente'];
        $plus = $GLOBALS['plus'];

        if (empty($token)) {
            return new Response('Unauthorized request', 401);
        }

        $client->setAccessToken($token);
        $people = $plus->people->get('me');

        return Response2::json($people->toSimpleObject());
    });

    Route::get('/mails', function () {
        $token = Session::get('token');
        $client = $GLOBALS['cliente'];
        $plus = $GLOBALS['plus'];

        if (empty($token)) {
            return new Response('Unauthorized request', 401);
        }

        $client->setAccessToken($token);
        $emails = $plus->getEmails();

        return Response2::json($emails->toSimpleObject());
    });


    Route::post('/disconnect', function () {
        $token = json_decode(Session::get('token'))->access_token;
        $client = $GLOBALS['cliente'];
        $client->revokeToken($token);
        Session::put('token', '');
        return new Response('Successfully disconnected', 200);
    });
    
});


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

Route::any('search', function(){
    $search = Input::get('search');
    $productos = Product::where('name', 'LIKE', "%$search%")->orWhere('trademark', 'LIKE', "%$search%")->get();
    return View::make('products/search')->with('productos', $productos);
});

Route::resource('category', 'CategoriesController',
                array('only' => array('show')));

Route::resource('product', 'ProductsController',
                array('only' => array('show')));

Route::resource('user', 'UserController',
                array('only' => array('update')));

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
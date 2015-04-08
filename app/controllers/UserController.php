<?php

use Illuminate\Support\MessageBag;

class UserController
extends Controller
{
    public function getLogin() 
    {
        return View::make("user/login");
    }
    
    public function postLogin()
    {
        $errors = new MessageBag();

        if ($old = Input::old("errors"))
        {
            $errors = $old;
        }

        $data = [
            "errors" => $errors
        ];

        $validator = Validator::make(Input::all(), [
            "username" => "required",
            "password" => "required"
        ]);

        if ($validator->passes())
        {
            $credentials = [
                "username" => Input::get("username"),
                "password" => Input::get("password")
            ];

            if (Auth::attempt($credentials))
            {
                return Redirect::to("user/profile");
            }
        }

        $data["errors"] = new MessageBag([
                "password" => [
                "Username and/or password invalid."
            ]
        ]);

        $data["username"] = Input::get("username");

        return Redirect::to("user/login")
            ->withInput($data);
    }
            
    public function getProfile()
    {
        return View::make("user/profile");
    }

    public function getLogout()
    {
        Auth::logout();
        return View::make("home");
    }
    
    public function getRemind()
    {
        return View::make("user/request");
    }

    public function postRemind()
    {
        $response = Password::remind(array('email' => Input::get('email')), function($message) {
            $message->subject('Click on the link below to reset your password.');
        });

        switch ($response)
        {
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::REMINDER_SENT:
                return Redirect::back()->with('status', Lang::get($response));
        }
    }

    public function getReset($token = null)
    {
        if (is_null(Input::get('token'))) {
            echo Input::server("REQUEST_METHOD");
            var_dump($token);
            var_dump(Input::all());
            ?><script>alert('asddd')</script><?php 
            App::abort(404);

        }

        return View::make('user/reset')->with('token', Input::get('token'));
    }

    public function postReset()
    {
        $credentials = Input::only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();
        });

        switch ($response)
        {
            case Password::INVALID_PASSWORD:
            case Password::INVALID_TOKEN:
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::PASSWORD_RESET:
                return Redirect::to('/');
        }
    }

}

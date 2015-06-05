<?php

use Illuminate\Support\MessageBag;

class UserController
extends Controller
{
    public function getLogin() 
    {
        if (Auth::check())
        {
            return Redirect::to('home');
        } else 
        {
            return View::make("user/login");
        }
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
                if (Auth::user()->confirmed) {
                    return Redirect::to("home");
                } else {
                    Auth::logout();
                    return Redirect::to("info")->with('message', 'Para iniciar sesión primero deberá confirmar su correo electrónico.');
                }
            }
        }

        $data["errors"] = new MessageBag([
                "password" => [
                "Username and/or password invalid."
            ]
        ]);

        $data["username"] = Input::get("username");

        return Redirect::to("user/login")
            ->with($data);
    }
            
    public function getProfile()
    {
        if (Auth::check())
        {
            return View::make("user/profile");
        } else 
        {
            return Redirect::to('home');
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return Redirect::to("home");
    }
    
    public function getRemind()
    {
        if (Auth::check())
        {
            return Redirect::to('home');
        }
        else 
        {
            return View::make("user/request");
        }
    }

    public function postRemind()
    {
        $response = Password::remind(array('email' => Input::get('email')), function($message) {
            $message->subject('Password reset.');
        });

        switch ($response)
        {
            case Password::INVALID_USER:
                return Redirect::back()->with('error', Lang::get($response));

            case Password::REMINDER_SENT:
                return Redirect::to('info')->with('message', 'Se le ha enviado un correo con las instrucciones para cambiar su contraseña.');
        }
    }

    public function getReset($token = null)
    {
        if (is_null(Input::get('token'))) {
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
                $user->remember_token = null;
                $user->save();
                return Redirect::to('info')->with('message', 'Su contraseña ha sido restablecida con éxito.');
        }
    }

    public function update($id) {
        
        $user = Auth::user();
        $user->name = Input::get('name');
        $user->lastName = Input::get('lastName');
        $user->save();

        return Redirect::to('user/profile');
    }


    public function missingMethod($parameters = array())
    {
        return Redirect::to('home');
    }
}

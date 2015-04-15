<?php

class RegistrationController extends \BaseController {
    
    public function getRegister() {
        if (Auth::check())
        {
            return Redirect::to('home');
        } else 
        {
            return View::make("account/register");
        }
    }
    
    public function postRegister() {
        
        $rules = [
            "username" => "required|unique:user",
            "email" => "required|unique:user",
            "password" => "required|confirmed"            
        ];
        
        $input = Input::only(
            "username",
            "email",
            "password",
            "password_confirmation"
        );
        
        $validator = Validator::make($input, $rules);
        
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        
        $confirmation_code = str_random(30);
        
        User::create([
            "username" => Input::get("username"),
            "email" => Input::get("email"),
            "password" => Hash::make(Input::get("password")),
            "confirmation_code" => $confirmation_code
        ]);
        
        Mail::send('email.verify', ["confirmation_code" => $confirmation_code], function($message) {
            $message->to(Input::get('email'), Input::get('username'))
                ->subject('Verify your email address');
        });
        
        return Redirect::to('info')->with('message', 'Cuenta creada correctamente. Se le ha enviado un mensaje de confirmación a su correo electrónico');        
    }
    
    public function getVerify($confirmation_code = null) {
        if (is_null(Input::get('confirmation_code'))) {
            App::abort(404);
        }
        
        $user = User::where('confirmation_code', Input::get('confirmation_code'))->first();
        
        if (!$user) {
            App::abort(404);
        }
        
        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();
        
        return Redirect::to('info')->with('message', 'Su correo electrónico ha sido confirmado correctamente. Ya puede iniciar sesión en nuestra web.');
    }
    
}

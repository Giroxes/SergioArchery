<?php

class UserController
extends Controller
{
    public function loginAction()
    {
        echo Input::server("REQUEST_METHOD");
        if (Input::server("REQUEST_METHOD") == "POST")
        {
            $validator = Validator::make(Input::all(), [
                "username" => "required",
                "password" => "required"
            ]);
            
            if ($validator->passes())
            {
                echo "Validation passed!";
            }
            else
            {
                echo "Validation failed!";
            }
        }

        return View::make("user/login");
    }
}
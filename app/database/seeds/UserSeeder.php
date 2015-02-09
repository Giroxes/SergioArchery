<?php

class UserSeeder
extends DatabaseSeeder
{
    public function run()
    {
        $users = [
            [
                "username" => "sergio",
                "password" => Hash::make("1234"),
                "email" => "sergiocampos1992@gmail.com"
             ]
         ];

         foreach ($users as $user)
         {
            User::create($user);
         }
     }
 }

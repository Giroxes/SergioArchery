<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = "user";
        protected $hidden = ["password"];
        protected $fillable = ['username', 'email', 'password', 'confirmed', 'confirmation_code'];
        
        public function getAuthIdentifier()
        {
            return $this->getKey();
        }

        public function getAuthPassword()
        {
            return $this->password;
        }

        public function getReminderEmail()
        {
            return $this->email;
        }
        
        public function isAdmin() 
        {
            return $this->admin;
        }
 }


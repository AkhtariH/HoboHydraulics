<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Passwords\PasswordBroker;

class MyPasswordBroker extends PasswordBroker 
{
    public function setEmailView($view) 
    {
        $this->emailView = $view;
    }
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    public function __construct()
    {

    }
    function login(){
        return view('authentication.login');
    }
    function loginadmin(){
        return view('authentication.loginadmin');
    }
    function registration(){
        return view('authentication.registration');

    }
    function recoverPassword(){
        return view('authentication.recover-password');

    }
    function confirmEmail(){
        return view('authentication.confirm-email');

    }
    function lockScreen(){
        return view('authentication.lock-screen');

    }
}

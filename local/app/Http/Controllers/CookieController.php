<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;
use Cookie;
use Auth;
use Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CookieController extends Controller
{
    public function __construct()
    {

    }
    function setCookie(Request $request){
        $data = DB::table('permission')
        ->first();
        Session::put('Authuser', $data);
        Session::put('Token','c67e344d-f9e2-41ac-81d2-aba5bee2ae7a');
        return redirect('evaluation');
    }
    function logoutCookie(){
        Session::forget('user');
        Session::forget('idpuser');
        Session::forget('Token');
        Session::forget('menu');
        return redirect('/');
    }
    public function getCookie(Request $request){
        dd(Session::get('Authuser'));
     }
}

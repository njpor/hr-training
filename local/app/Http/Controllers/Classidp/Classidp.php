<?php

namespace App\Http\Controllers\Classidp;
use Closure;
use Illuminate\Support\Facades\Session;
use DB;
class Classidp
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public static function check_login($name)
    {
        $chk = false;
        $token = Session::get('Token');
        $userapi = Session::get('pmpuser');
        // $userpermissions = Session::get('Userspermissions');
        if(!empty($userapi) && !empty($token) && !empty($userpermissions))
        {
            if($userpermissions->$name == true)
            {
                $chk = true;
            }
            else
            {
                $chk = false;
            }
        }
        else
        {
            $chk = false;
        }
        return $chk;
    }


}

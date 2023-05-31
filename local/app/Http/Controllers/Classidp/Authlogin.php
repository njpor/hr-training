<?php

namespace App\Http\Controllers\Classpms;

use Closure;
use Illuminate\Http\Request;
use Cookie;
class Authlogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public static function cookielogin()
    {
      $empid = Session::get('empid');
      $empname = Session::get('empname');
      $empstatus = Session::get('empstatus');
      if(empty($empid) || empty($empname) || empty($empstatus))
      {

        Cookie::queue(Cookie::forget('empid'));
        Cookie::queue(Cookie::forget('empname'));
        Cookie::queue(Cookie::forget('empstatus'));
        return false;
      }
      else
      {
        return true;
      }
    }
}

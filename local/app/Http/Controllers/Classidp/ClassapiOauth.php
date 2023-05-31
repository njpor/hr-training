<?php

namespace App\Http\Controllers\Classidp;

use Closure;
use Illuminate\Support\Facades\Session;
use DB;
class ClassapiOauth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public static  $OAUTH_USER_PROFILE_URL	   = 'https://api.jasmine.com/authen1/me';
    public static  $REDIRECT_URL               = 'https://hrjasgroup.triplet.co.th/callback/training';
    public static  $OAUTH_URL				   = "https://api.jasmine.com/authen1/oauth/token";
    public static  $OAUTH_CLIENT_ID            = 'hYjxbHmFUK_Train';
    public static  $OAUTH_CLIENT_SECRET		   = 'WLRkJskzMmpsYxBcJbbc';
    public static  $OAUTH_GRANT_TYPE           = 'authorization_code';


   //-------------------------------  login Oauth JAS -------------------------//
    public static function get_accesstoken($isCode,$code)
    {

        if ($isCode) {
            $request = array(
                'grant_type'	=> static::$OAUTH_GRANT_TYPE,
                'client_id'		=> static::$OAUTH_CLIENT_ID,
                'redirect_uri'	=> static::$REDIRECT_URL,
                'code'			=> $code,
            );
        } else {
            $request = array(
                'grant_type'	=> 'refresh_token',
                'client_id'		=> static::$OAUTH_CLIENT_ID,
                'client_secret'	=> static::$OAUTH_CLIENT_SECRET,
                'refresh_token'	=> $code
            );
        }
        $OAUTH_STR = ClassapiOauth::doString($request);
        //open connection
        $ch = curl_init();
        $header = array("Content-type: application/x-www-form-urlencoded; charset=UTF-8");
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_URL, static::$OAUTH_URL);
        curl_setopt($ch, CURLOPT_USERPWD, '' . static::$OAUTH_CLIENT_ID . ':' . static::$OAUTH_CLIENT_SECRET . '');
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $OAUTH_STR);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        //execute post
        $response = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($response, true);
        if (empty($data)) {
            return;
        }
        $access_token = $data['access_token'];
        return $access_token;

    }
    public static function get_UserProfile($isCode,$access_token)
    {
        if (empty($access_token)) {
            return;
        }
        $tokenType = "bearer";
        $headers = array(
            'Authorization: ' . $tokenType . ' ' . $access_token . '',
            'Content-Type: application/json; charset=UTF-8'
        );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, static::$OAUTH_USER_PROFILE_URL);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        $userInfo = json_decode($response, true);
        if(!empty($userInfo[0]['employee_id']))
        {
            $data = DB::table('employee')->where('EmployeeID',$userInfo[0]['employee_id'])->first();
        }
        else
        {
            $data=[];
        }
        return $data;

    }
    public static function doString($request)
    {
           $str = "";
           end($request);
           $last_key = key($request);
           foreach ($request as $key => $value) {
               if ($key == $last_key) {
                   $str .= $key . '=' . $value . '';
               } else {
                   $str .= $key . '=' . $value . '&';
               }
           }
           rtrim($str, '&');
           return $str;
    }

    public static function get_UserProfiletest($id)
    {

        $data = DB::table('employee')
        ->leftjoin('permission','permission.EmpID','=','employee.EmployeeID')
        ->where('EmployeeID',$id)->first();

        return $data;
    }

}

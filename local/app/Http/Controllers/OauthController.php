<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Datatables;
use DB;
use Cookie;
use Auth;
use Session;
use App\Models\User;
use App\Http\Controllers\Classidp\Classidp;
use App\Http\Controllers\Classidp\Classapi;
use App\Http\Controllers\Classidp\ClassapiOauth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Alert;
use Hash;


class OauthController extends Controller
{
    public function __construct()
    {

    }
    public function getOAuthcode(Request $request){

        $chk_login =  DB::table('employee')
        ->leftjoin('permission','permission.EmpID','=','employee.EmployeeID')
        ->where('permission.email',$request->email)
       // ->where('permission.EmpID',$request->password)
        ->first();
       // dd()
       // dd(Hash::check($request->password,$chk_login->password));
        //dd($chk_login);
        if($chk_login && Hash::check($request->password,$chk_login->password))
        {
            $UserProfile =  ClassapiOauth::get_UserProfiletest($chk_login->EmployeeID);
            //dd($UserProfile);
            if(!empty($UserProfile)){
                Session::forget('idpuser');
                Session::put('idpuser', $UserProfile);
                return redirect('dashboard');
            }
            else{
                Session::put('chkuserpermissions',true);
                return redirect('idplogin');
            }
        }
        else
        {
           Session::put('chkuserpermissions',true);
           return redirect('idplogin');
        }
    }

    public function resetPassword(Request $request){

        //dd($request->all());
        if($request->newpassword != $request->confirm || $request->newpassword == null ){
            return redirect('dashboard');
        }else{
            $id = $request->empid;
            $reset_pass = [
                'password' => Hash::make($request->newpassword),
                'update' => date("Y-m-d H:i:s")
            ];
            //dd($reset_pass);
            DB::table('permission')->where('EmpID','=',$id)->update($reset_pass);
            Session::put('chkuserpermissions',true);
            return redirect('idplogin');
        }

    }


    public function getOAuthcodejas($code){

        dd($request->all());
        //-------------  login Oauth JAS ----------------//
        $access_token = ClassapiOauth::get_accesstoken(true,$code);
        $UserProfile =  ClassapiOauth::get_UserProfile(true,$access_token);
        //dd($UserProfile);
        if(!empty($UserProfile))
        {
            Session::forget('idpuser');
            Session::put('idpuser', $UserProfile);
            return redirect('dashboard');
        }
        else
        {
           Session::put('chkuserpermissions',true);
           return redirect('idplogin');
        }


    }
}

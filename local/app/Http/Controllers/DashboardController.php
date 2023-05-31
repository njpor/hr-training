<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\ClassHR\ClassapiOauth;
use Session;
use Hash;

class DashboardController extends Controller
{

    public function index()
    {

        // $id = DB::table('employee')->get();
        // foreach($id as $item){
        //     $p = explode( '@', $item->Email );
        //     //dd($p[0]);
        //     $id_pass = [
        //         'password' => Hash::make($p[0])
        //     ];
        //     DB::table('permission')->where('EmpID','=',$item->EmployeeID)->update($id_pass);
        // }
        // dd("k");
        // $a = Hash::make('sakol.c');
        // dd($a);

        $user = Session::get('idpuser');
        $count_account = DB::table('employee')->where('email','=',$user->email)->count();
        $list_emp_uuid = DB::table('employee')->where('email','=',$user->email)->get();
        $header_emp_data = DB::table('employee')->where('EmployeeID','=',$user->EmployeeID)->first();

        $date_update = DB::table('idp')->where('EmployeeID','=',$user->EmployeeID)->orderBy('LastDateUpdate', 'desc')->first();
        //dd($date_update);

        $check_result = DB::table('employee')->leftjoin('idp','employee.EmployeeID','=','idp.EmployeeID')
        ->where('employee.EmployeeID','=',$user->EmployeeID)->first();
        //dd($check_result);

        $chk_cate_1emp = DB::table('idp')
        ->join('employee','employee.EmployeeID','=','idp.EmployeeID')
        ->join('course','course.CourseID','=','idp.CourseID')
        ->join('method','method.MethodID','=','idp.MethodID')
        ->join('category','category.CategoryID','=','course.CategoryID')
        ->where('idp.EmployeeID','=',$user->EmployeeID)
        ->orderby('category.CategoryName')
        ->select('category.CategoryID','category.CategoryName')->distinct()
        ->get();
        //dd($chk_cate_1emp);

        $list_result = DB::table('idp')
        ->join('employee','employee.EmployeeID','=','idp.EmployeeID')
        ->join('course','course.CourseID','=','idp.CourseID')
        ->join('method','method.MethodID','=','idp.MethodID')
        ->join('category','category.CategoryID','=','course.CategoryID')
        ->join('course_details','course_details.CourseName','=','course.CourseName')
        ->where('idp.EmployeeID','=',$user->EmployeeID)
        ->orderby('idp.Result')
        ->get();
        //dd($list_result);

        return view('dashboard.index',['count_account'=>$count_account,'check_result'=>$check_result,'header_emp_data'=>$header_emp_data,'list_emp_uuid'=>$list_emp_uuid,'list_result'=>$list_result,'chk_cate_1emp'=>$chk_cate_1emp,'date_update'=>$date_update]);
    }

    function dashview(Request $request){
        //dd($request->all());
        $user = Session::get('idpuser');
        $emp_id = $request->account;

        $count_account = DB::table('employee')->where('email','=',$user->email)->count();
        $list_emp_uuid = DB::table('employee')->where('email','=',$user->email)->get();
        $header_emp_data = DB::table('employee')->where('EmployeeID','=',$emp_id)->first();
        $date_update = DB::table('idp')->where('EmployeeID','=',$emp_id)->orderBy('LastDateUpdate', 'desc')->first();
        //dd($date_update);

        $check_result = DB::table('employee')
        ->leftjoin('idp','employee.EmployeeID','=','idp.EmployeeID')
        ->where('employee.EmployeeID','=',$emp_id)
        ->first();

        $chk_cate_1emp = DB::table('idp')
        ->join('employee','employee.EmployeeID','=','idp.EmployeeID')
        ->join('course','course.CourseID','=','idp.CourseID')
        ->join('method','method.MethodID','=','idp.MethodID')
        ->join('category','category.CategoryID','=','course.CategoryID')
        ->where('idp.EmployeeID','=',$emp_id)
        ->orderby('category.CategoryName')
        ->select('category.CategoryID','category.CategoryName')->distinct()
        ->get();

        $list_result = DB::table('idp')
        ->join('employee','employee.EmployeeID','=','idp.EmployeeID')
        ->join('course','course.CourseID','=','idp.CourseID')
        ->join('method','method.MethodID','=','idp.MethodID')
        ->join('category','category.CategoryID','=','course.CategoryID')
        ->join('course_details','course_details.CourseName','=','course.CourseName')
        ->where('idp.EmployeeID','=',$emp_id)
        ->orderby('idp.Result')
        ->get();

        return view('dashboard.index',['count_account'=>$count_account,'check_result'=>$check_result,'header_emp_data'=>$header_emp_data,'list_emp_uuid'=>$list_emp_uuid,'list_result'=>$list_result,'chk_cate_1emp'=>$chk_cate_1emp,'date_update'=>$date_update]);
    }

}

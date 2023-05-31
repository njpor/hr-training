<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\ClassHR\ClassapiOauth;
use Session;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use File;
use Illuminate\Support\Facades\Log;
use Response;


class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next){
            if(Session::get('idpuser')->Type != 'ADMIN')
            {
                return redirect('logoutCookie');
            }
            else{
                return $next($request);
            }
        });
    }

    public function index()
    {
        $list_course = DB::table('idp')
        ->join('course','course.CourseID','=','idp.CourseID')
        ->join('category','course.CategoryID','=','category.CategoryID')
        ->join('method','method.MethodID','=','idp.MethodID')
        ->Select('category.CategoryID','category.CategoryName','course.CourseID','course.CourseName','course.Date','method.MethodID','method.MethodName')
        ->distinct()
        ->orderby('category.CategoryName')
        ->get();

        return view('course.index',['list_course'=>$list_course]);
    }

    public function details($category_id,$course_id,$method_id)
    {
        $id_category = base64_decode($category_id);
        $id_course = base64_decode($course_id);
        $id_method = base64_decode($method_id);

        $course_select = DB::table('idp')
        ->join('course','course.CourseID','=','idp.CourseID')
        ->join('category','course.CategoryID','=','category.CategoryID')
        ->join('method','method.MethodID','=','idp.MethodID')
        ->where('idp.CourseID','=',$id_course)
        ->where('idp.MethodID','=',$id_method)
        ->first();

        $list_emp_select = DB::table('idp')
        ->leftjoin('employee','employee.EmployeeID','=','idp.EmployeeID')
        ->join('course','course.CourseID','=','idp.CourseID')
        ->join('category','course.CategoryID','=','category.CategoryID')
        ->join('method','method.MethodID','=','idp.MethodID')
        ->where('idp.CourseID','=',$id_course)
        ->where('idp.MethodID','=',$id_method)
        ->get();
        //dd($list_emp_select);

        return view('course.details',['list_emp_select'=>$list_emp_select,'course_select'=>$course_select]);
    }

    public function edit(Request $request){
        //dd($request->all());

        $idp_select = DB::table('idp')->where('CourseID','=',$request->course_id)->where('MethodID','=',$request->method_id)->get();
        //dd($idp_select);
        foreach($idp_select as $log_delete){
            $log_idp_delete = [
                'uuid' => $log_delete->uuid,
                'EmployeeID' => $log_delete->EmployeeID,
                'CourseID' => $log_delete->CourseID,
                'MethodID' => $log_delete->MethodID,
                'Result' => $log_delete->Result,
                'Date_delete' => date("Y-m-d H:i:s")
            ];
            DB::table('log_delete_idp')->insert($log_idp_delete);
        }

        DB::table('idp')->where('CourseID','=',$request->course_id)->where('MethodID','=',$request->method_id)->delete();

        return Response::json( [
            'code' => '200',
        ] );


    }


}

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


class CourseDetailsController extends Controller
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

        $course_details = DB::table('course_details')->get();

        return view('coursedetails.index',['course_details'=>$course_details]);
    }

    public function view($id)
    {
        $id_details = base64_decode($id);

        $course_details = DB::table('course_details')
        ->where('id','=',$id_details)->first();

        return view('coursedetails.edit',['course_details'=>$course_details]);
    }




    public function edit(Request $request){
        //dd($request->all());

        $update_course_details = [
            'Details' => $request->Details,
            'Target' => $request->Target,
            'last_update' =>date("Y-m-d H:i:s")
        ];
        DB::table('course_details')->where('CourseName','=',$request->CourseName)->update($update_course_details);



        return Response::json( [
            'code' => '200',
        ] );


    }


}

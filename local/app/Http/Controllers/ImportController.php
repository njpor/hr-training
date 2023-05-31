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


class ImportController extends Controller
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
        return view('import.index',['alert'=>true,'textalert'=>'']);
    }

    public function importExcel(Request $request)
    {
        ini_set('max_execution_time', 200000); //300 seconds = 5 minutes
        ini_set('memory_limit', '500M');
        //dd($request->all());

        if(request()->file('file')== null){
            Session::flash('Error', 'Choose File Excel before Click!');
            return redirect()->back();
        }
        $data = Excel::toCollection(new UsersImport, request()->file('file'));
        //dd($data);
        if($data[0][0][0] != 'EmployeeID' || $data[0][0][1] != 'Category' || $data[0][0][2] != 'Course'|| $data[0][0][3] != 'Result' || $data[0][0][4] != 'Date' || $data[0][0][5] != 'Method/Place'){
            Session::flash('Error', 'Invalid Header!');
            return redirect()->back();
        }
        $i = 0;
        foreach($data[0] as $item){
            if($item[0] == null|| $item[1] == null || $item[2] == null || $item[3] == null || $item[4] == null || $item[5] == null){
                Session::flash('Error2', 'พบค่าว่างในไฟล์ excel กรุณาเช็คข้อมูลอีกครั้ง');
                return redirect()->back();
            }
            if($i > 0){
                //category
                $chk_cate = DB::table('category')->where('CategoryName',$item[1])->first();
                if($chk_cate){
                    $cate_id = $chk_cate->CategoryID;
                }else{
                    $cate_update = [
                        'CategoryName' => $item[1]
                    ];
                    $cate_id = DB::table('category')->insertGetId($cate_update);
                }
                //course
                $chk_course = DB::table('course')->where('CourseName',$item[2])->where('Date',$item[4])->first();
                if($chk_course){
                    $course_id = $chk_course->CourseID;
                }
                else{
                    $course_update = [
                        'CategoryID' => $cate_id,
                        'CourseName' => $item[2],
                        'Date' => $item[4],
                        'Year' => date("Y"),
                        'CourseStatus' => true
                    ];
                    $course_id = DB::table('course')->insertGetId($course_update);
                    //เพิ่ม ชื่อ course ใส่ course detail
                    $add_cose_detail  = [
                        'CourseName' => $item[2],
                        'last_update' => date("Y-m-d H:i:s")
                    ];
                    DB::table('course_details')->insert($add_cose_detail);
                }
                //method
                $chk_method = DB::table('method')->where('MethodName',$item[5])->first();
                if($chk_method){
                    $method_id = $chk_method->MethodID;
                }else{
                    $method_update = [
                        'MethodName' => $item[5]
                    ];
                    $method_id = DB::table('method')->insertGetId($method_update);
                }

                //idp all
                $chk_idp = DB::table('idp')->where('EmployeeID',$item[0])->where('CourseID',$course_id)->where('MethodID',$method_id)->first();
                $emp_uuid = DB::table('employee')->where('EmployeeID',$item[0])->first();
                //dd($emp_uuid);
                if($chk_idp){
                    $por = "ok";
                }else{
                    if($emp_uuid){
                        $a = $emp_uuid->Email;
                    }else{
                        $a = "emp_null";
                    }
                    $idp_update = [
                        'uuid'=> $a,
                        'EmployeeID' => $item[0],
                        'CourseID' => $course_id,
                        'MethodID' => $method_id,
                        'Result' => $item[3],
                        'LastDateUpdate' => date("Y-m-d H:i:s")
                    ];
                    DB::table('idp')->insert($idp_update);
                }
            }
            $i++;
        }

        Session::flash('Success', 'Import Success!');
        return redirect()->back();
    }
}

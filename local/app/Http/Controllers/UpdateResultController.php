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


class UpdateResultController extends Controller
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
        return view('updateResult.index',['alert'=>true,'textalert'=>'']);
    }

    public function importemp(Request $request)
    {
        if(request()->file('file')== null){
            Session::flash('Error2', 'Choose File Excel before Click!');
            return redirect()->back();
        }
        $data = Excel::toCollection(new UsersImport, request()->file('file'));
        dd($data);
        // $i = 0;
        // $num = 0;
        // foreach($data[0] as $item){

        //     if($i > 0){
        //         //emp
        //         $emp = DB::table('employee')->where('EmployeeID',$item[0])->first();
        //         if($emp){
        //             $emp_id = $emp->EmployeeID;
        //         }else{
        //             $num++;
        //             $emp_update = [
        //             //idp
        //                 'uuid' => 'UID0'.$num,
        //                 'EmployeeID' => $item[0],
        //                 'Tinitial' => $item[1],
        //                 'TFName' => $item[2],
        //                 'TLName' => $item[3],
        //                 'Email' => $item[4],
        //                 'Position' => $item[5],
        //                 'Section' => $item[6],
        //                 'Division' => $item[7],
        //                 'Department' => $item[8],
        //                 'StaffGrade' => '',
        //                 'JobFamily' => '',
        //                 'CompanyShortName' => $item[9]
        //                 //emp
        //                 // 'uuid' => $item[0],
        //                 // 'EmployeeID' => $item[1],
        //                 // 'Tinitial' => $item[2],
        //                 // 'TFName' => $item[3],
        //                 // 'TLName' => $item[4],
        //                 // 'Email' => $item[14],
        //                 // 'Position' => $item[16],
        //                 // 'Section' => $item[17],
        //                 // 'Division' => $item[18],
        //                 // 'Department' => $item[19],
        //                 // 'StaffGrade' => $item[22],
        //                 // 'JobFamily' => $item[23],
        //                 // 'CompanyShortName' => $item[24]
        //             ];
        //             $emp_id = DB::table('employee')->insertGetId($emp_update);
        //         }
        //     }
        //     $i++;
        // }
        // Session::flash('Success2', 'Import Success!');
        return redirect()->back();
    }

    public function importResult(Request $request)
    {
        //dd($request->all());
        if(request()->file('file')== null){
            Session::flash('Error', 'Choose File Excel before Click!');
            return redirect()->back();
        }
        $data = Excel::toCollection(new UsersImport, request()->file('file'));
        //dd($data);
        if($data[0][0][0] != 'EmployeeID' || $data[0][0][1] != 'Category' || $data[0][0][2] != 'Course' || $data[0][0][3] != 'Result' || $data[0][0][4] != 'Date' || $data[0][0][5] != 'Method/Place'){
            Session::flash('Error', 'Invalid Header!');
            return redirect()->back();
        }
        $i = 0;
        foreach($data[0] as $item){
            if($item[0] == null|| $item[1] == null || $item[2] == null || $item[3] == null || $item[4] == null || $item[5] == null){
                Session::flash('Error', 'Check NULL value again!');
                return redirect()->back();
            }
            if($i > 0){
                $idpchk = DB::table('idp')
                ->join('course','course.CourseID','=','idp.CourseID')
                ->join('method','method.MethodID','=','idp.MethodID')
                ->where('idp.EmployeeID',$item[0])
                ->where('course.CourseName',$item[2])
                ->where('course.Date',$item[4])
                ->where('method.MethodName',$item[5])
                ->first();
                //dd($idpchk);
                if($idpchk){
                    $chk_uuid = $idpchk->uuid;
                    $course_id = $idpchk->CourseID;
                    $method_id = $idpchk->MethodID;
                    $update_result = [
                        'Result' => $item[3],
                        'LastDateUpdate' => date("Y-m-d H:i:s")
                    ];
                    DB::table('idp')
                    ->where('uuid',$chk_uuid)
                    ->where('EmployeeID',$item[0])
                    ->where('CourseID',$course_id)
                    ->where('MethodID',$method_id)
                    ->update($update_result);
                }else{
                    $por = "ok";
                }
            }
            $i++;
        }

        Session::flash('Success', 'Import Success!');
        return redirect()->back();
    }



}

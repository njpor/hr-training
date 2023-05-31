<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\ClassHR\ClassapiOauth;
use Session;
use Response;

class ListIDPController extends Controller
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
        $list = DB::table('employee')->orderby('employee.CompanyShortName')->get();
        $list_cate =DB::table('category')->get();
        $list_course = DB::table('course')->orderby('CourseName')->get();
        $list_method = DB::table('method')->get();

        return view('listidp.index',['list'=>$list,'list_cate'=>$list_cate,'list_course'=>$list_course,'list_method'=>$list_method]);
    }

    public function view($id)
    {
        $iid = base64_decode($id);
        $user = Session::get('idpuser');

        $header_emp_data = DB::table('employee')->where('EmployeeID','=',$iid)->first();
        $check_result = DB::table('employee')
        ->leftjoin('idp','employee.EmployeeID','=','idp.EmployeeID')
        ->where('employee.EmployeeID','=',$iid)
        ->first();

        $date_update = DB::table('idp')->where('EmployeeID','=',$iid)->orderBy('LastDateUpdate', 'desc')->first();
        //dd($date_update);

        $list_result = DB::table('idp')
        ->join('employee','employee.EmployeeID','=','idp.EmployeeID')
        ->join('course','course.CourseID','=','idp.CourseID')
        ->join('method','method.MethodID','=','idp.MethodID')
        ->join('category','category.CategoryID','=','course.CategoryID')
        ->where('idp.EmployeeID','=',$iid)
        ->orderby('idp.Result')
        ->get();

        return view('listidp.view',['check_result'=>$check_result,'header_emp_data'=>$header_emp_data,'list_result'=>$list_result,'date_update'=>$date_update]);
    }


    public function edit(Request $request){
        //dd($request->all());

        //delete
        DB::table('idp')
        ->where('EmployeeID','=',$request->EmployeeID)
        ->delete();

        $count_idp = count($request->CourseID)-1;
        for($x = 0; $x <= $count_idp; $x++){
            $idp_new = [
                'uuid' => $request->email,
                'EmployeeID' => $request->EmployeeID,
                'CourseID' => $request->CourseID[$x],
                'MethodID' => $request->MethodID[$x],
                'Result' =>$request->Result[$x],
                'LastDateUpdate' => date("Y-m-d H:i:s")
            ];
            //dd($idp_new);
            DB::table('idp')->insert($idp_new);
        }


        return Response::json( [
            'code' => '200',
        ] );
    }
}

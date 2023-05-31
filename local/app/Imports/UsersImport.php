<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {
        return new User([
        ]);
    }

    // public function model(array $row)
    // {
    //     return new User([
    //         'CompanyShortName' => $row['CompanyShortName'],
    //         'EmployeeID' => $row['EmployeeID'],
    //         'Tinitial' => $row['Tinitial'],
    //         'TFName' => $row['TFName'],
    //         'TLName' => $row['TLName'],
    //         'Email' => $row['Email'],
    //         'Position' => $row['TitleName'],
    //         'Section' => $row['แผนก'],
    //         'Division' => $row['ส่วน'],
    //         'Department' => $row['ฝ่าย'],
    //         'StaffGrade' => $row['StaffGrade'],
    //         'JobGrade' => $row['JobGrade'],
    //         'Expr1048' => $row['Expr1048'],
    //         'DateAppointed' => $row['DateAppointed'],
    //         'JobFamily' => $row['JobFamily'],
    //         'CategoryName' => $row['Category'],
    //         'CourseName' => $row['Course'],
    //         'Result' => $row['Result'],
    //         'Date' => $row['Date'],
    //         'MethodName' => $row['Method'],
    //     ]);
    // }
}

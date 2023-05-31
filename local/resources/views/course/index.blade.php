@extends('layouts.master')

@section('content')

    <div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col">
                <div class="big-icon">
                    <i class="icofont icofont-contacts"></i>
                </div>
                <div class="d-inline-block">
                    <h5>List Course All</h5>
                    <span>
                        <p>รายการข้อมูล Course ภายในระบบ</p>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-block">
            <br>
            <span style="text-align: center">
                <h5>Coures การอบรมทั้งหมดภายในระบบ</h5>
            </span><br><br>
            <div class="table-responsive">
                <table id="simpletable" class="table table-borderless">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center">No</th>
                            <th width="20%" style="text-align: center">CategoryName</th>
                            <th width="40%" style="text-align: center">CourseName</th>
                            <th width="15%" style="text-align: center">Date</th>
                            <th width="30%" style="text-align: center">Method / Place</th>
                            <th width="5%" style="text-align: center">Details</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($list_course as $item)
                            @php
                                $category_id = base64_encode($item->CategoryID);
                                $course_id = base64_encode($item->CourseID);
                                $method_id = base64_encode($item->MethodID);
                            @endphp
                            <tr>
                                <td style="text-align: center; font-size:13px;">{{ $i++ }}</td>
                                <td style="font-size:13px;">{{ $item->CategoryName }}</td>
                                <td style="font-size:13px;">{{ $item->CourseName }}</td>
                                <td style="font-size:13px;">{{ $item->Date }}</td>
                                <td style="font-size:13px;">{{ $item->MethodName }}</td>
                                <td valign="middle">
                                    <a href="{{ asset('/details') }}/{{ $category_id }}/{{ $course_id }}/{{ $method_id }}"
                                        style="font-size:13px;  color:rgba(128, 21, 152, 0.644);">
                                        <b>more details</b>
                                        <i class="icofont icofont-rounded-double-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    <script></script>
@endsection

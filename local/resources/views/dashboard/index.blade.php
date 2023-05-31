@extends('layouts.master')

@section('content')
    @if ($count_account > 1)
        You have {{ $count_account }} account <b>Please select the account from which you would like to view training
            information</b>
        <form action="{{ url('/dashview') }}" method="post" class="was-validated">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-9">
                    <select style="width: 100%;" class="form-select form-control" name="account" aria-label="Default select example" required>
                        @foreach ($list_emp_uuid as $item)
                            <option value="{{ $item->EmployeeID }}"
                                {{ $item->EmployeeID == $header_emp_data->EmployeeID ? 'selected' : '' }}>
                                {{ $item->EmployeeID }} : {{ $item->TFName }} {{ $item->TLName }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit"
                        class="btn btn-secondary  btn-block waves-effect text-center m-b-20">ค้นหา</button>
                </div>
            </div>
        </form>
    @endif

    <div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row">
            <div class="big-icon">
                <i class="icofont icofont-contacts"></i>
            </div>
            <div class="d-inline-block col-5">
                <h5>Individual Development Plan</h5>
                <span class="col-md-12 label label-primary">
                    <b>{{ $header_emp_data->EmployeeID }} </b> &nbsp;
                    {{ $header_emp_data->Tinitial }}{{ $header_emp_data->TFName }} {{ $header_emp_data->TLName }}
                </span>
                <b>Position :</b> {{ $header_emp_data->Position }} , <b> Section :</b> {{ $header_emp_data->Section }}
                ,<b> Division :</b>
                {{ $header_emp_data->Division }} ,
                <br> <b>Department :</b> {{ $header_emp_data->Department }}, <b>Company :</b>
                {{ $header_emp_data->CompanyShortName }}
            </div>

        </div>
    </div>

    <div style="font-size: 13px; text-align: right; color:red;">
        @if ($date_update == null)
        @else
            <b>วันที่อัพเดต : {{ date('F j, Y H:i:s A', strtotime($date_update->LastDateUpdate)) }}</b>
        @endif
    </div>
    <br>

    {{-- <ul class="nav nav-tabs md-tabs" role="tablist"> --}}
    <ul class="nav nav-tabs sm-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#year2023" role="tab">2023</a>
            {{-- <div class="slide"></div> --}}
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#year2024" role="tab">2024</a>
        </li> --}}


    </ul>

    <!-- Tab panes -->
    <div class="tab-content card-block">
        <div class="tab-pane active" id="year2023" role="tabpanel">
            <div class="page-body">
                <div class="card">
                    <div class="card-block">
                        <h6><b>รายการอบรมประจำปี 2023</b></h6>
                    </div>
                </div>
                @if ($check_result->Result != null)
                    @foreach ($chk_cate_1emp as $cate)
                        <div class="card">
                            <div class="card-block">
                                <h5>{{ $cate->CategoryName }}</h5>
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-borderless table-hover display">
                                        <thead>
                                            <tr>
                                                <th width=10% style="text-align: center;">No</th>
                                                <th width=30% style="text-align: center;">Course</th>
                                                <th width=20% style="text-align: center;">Result</th>
                                                <th width=15% style="text-align: center;">Date</th>
                                                <th width=15% style="text-align: center;">Method / Place</th>
                                                <th>Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 1;
                                            @endphp
                                            @foreach ($list_result as $item)
                                                @php
                                                    if ($item->Result == 'Pass') {
                                                        $x = "<span style='font-size: 13px;' class='label label-success'>" . $item->Result . '</span>';
                                                    } elseif ($item->Result == 'Not Pass') {
                                                        $x = "<span style='font-size: 13px;' class='label label-danger'>" . $item->Result . '</span>';
                                                    } elseif ($item->Result == 'Waiting') {
                                                        $x = "<span style='font-size: 13px;' class='label label-warning'>" . $item->Result . '</span>';
                                                    } else {
                                                        $x = "<span style='font-size: 13px;' class=''>" . $item->Result . '</span>';
                                                    }
                                                @endphp
                                                @if ($cate->CategoryID == $item->CategoryID)
                                                    <tr>
                                                        <input type="hidden" id="detail{{ $item->CourseID }}" value="{{ $item->Details }}">
                                                        <input type="hidden" id="target{{ $item->CourseID }}" value="{{ $item->Target }}">
                                                        <td style="font-size: 13px; text-align: center;">
                                                            {{$i++}}
                                                        </td>
                                                        <td style="font-size: 13px">
                                                            <span title="หลักสูตรนี้เหมาะสำหรับ : {{ $item->Target }}">
                                                                <i style="color: rgba(126, 191, 251, 0.96); cursor: pointer;"
                                                                    class="icofont icofont-star"></i>
                                                            </span> &nbsp;
                                                            <span style="cursor: pointer;" title="{{ $item->Details }}">
                                                                {{ $item->CourseName }}
                                                            </span>
                                                        </td>
                                                        <td style="font-size: 13px; text-align: center;">
                                                            @php echo $x; @endphp
                                                        </td>
                                                        <td style="font-size: 13px; text-align: center;">
                                                            {{ $item->Date }}</td>
                                                        @if ($item->MethodName == 'JAS Online Learning')
                                                            <td style="text-align: center;">
                                                                <a href="https://jasonlinelearning.com/" target="_blank">
                                                                    {{ $item->MethodName }}</a>
                                                            </td>
                                                        @else
                                                            <td style="font-size: 13px; text-align: center;">
                                                                {{ $item->MethodName }}</td>
                                                        @endif
                                                        <td style="text-align: center;">
                                                            <button type="button" data-id="id_{{ $item->id }}"
                                                                style="font-size: 7px;" class="btn btn-outline-inverse"
                                                                onclick="get_details({{ $item->CourseID }})"
                                                                data-toggle="modal" data-target="#detail"><i
                                                                    style="color: rgba(70, 70, 248, 0.79); font-size: 15px;"
                                                                    class="icofont icofont-ui-file"></i></button>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card">
                        <div class="card-block">
                            <div class="table-responsive">
                                <table id="datatable" class="table table-borderless table-hover">
                                    <thead>
                                        <tr>
                                            <th width=10%>No</th>
                                            <th width=30%>Course</th>
                                            <th width=20%>Result</th>
                                            <th width=20%>Date</th>
                                            <th width=20%>Method / Place</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr></tr>
                                        <tr></tr>
                                        <tr>
                                            <td colspan="5" style="text-align: center; font-size:12px; color:brown">
                                                -------------- <b>ไม่พบข้อมูลการอบรม</b>---------------</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="tab-pane" id="year2024" role="tabpanel">
            <div class="page-body">
                <div class="card">
                    <div class="card-block">
                        <h6><b>รายการอบรมประจำปี 2024</b></h6>
                    </div>
                </div>
                <div class="card">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="datatable" class="table table-borderless table-hover">
                                <thead>
                                    <tr>
                                        <th width=10%>No</th>
                                        <th width=30%>Course</th>
                                        <th width=20%>Result</th>
                                        <th width=20%>Date</th>
                                        <th width=20%>Method / Place</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr></tr>
                                    <tr></tr>
                                    <tr>
                                        <td colspan="5" style="text-align: center; font-size:12px; color:brown">
                                            -------------- <b>ไม่พบข้อมูลการอบรม</b>---------------</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="detail" tabindex="-1" role="dialog" style="z-index: 1050; display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">รายละเอียดหลักสูตร</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div id="modal_detail" class="modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>





@endsection

@section('body_bottom')
    <script type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            $('table.display').DataTable({
                "searching": true,
                "ordering": true
            });
            $('.dataTables_filter').css("display", "none");
            // $('.dataTables_length').css("display", "none");
            // $('.dataTables_info').css("display", "none");
            $('.dataTables_paginate').css("display", "none");
        });

        function gg() {
            alert("kk");
        }


        function get_details(value) {
            //alert(value);
            var x = $('#detail' + value).val();
            var y = $('#target' + value).val();
            $("#detail").modal({
                keyboard: true,
                backdrop: "static",
                show: false,
            }).on("show.bs.modal", function(event) {
                console.log(event);
                var button = $(event.relatedTarget); // button the triggered modal
                var personId = button.data("id"); //data-id of button which is equal to id (primary key) of person

                var a = $(event.relatedTarget).closest("tr").find("td:eq(1)").text();
                var b = $(event.relatedTarget).closest("tr").find("td:eq(2)").text();
                var c = $(event.relatedTarget).closest("tr").find("td:eq(3)").text();
                var d = $(event.relatedTarget).closest("tr").find("td:eq(4)").text();
                var e = $(event.relatedTarget).closest("tr").find("td:eq(5)").text();

                //เพิ่ม if ที่ target+detail = null ให้ -
                var chktarget = (y == "") ? "-" : y;
                var chkdetail = (x == "") ? "-" : x;

                var text = '';
                text += '<span style="font-size:13px;"><i class="icofont icofont-rounded-double-right"></i></span>';
                text += '<span style="font-size:17px;"><b>' + a + '</b></span><br>';
                text += '<span style="padding-left: 25px; font-size:12px;"><i style="color: rgba(126, 191, 251, 0.96); cursor: pointer;" class="icofont icofont-star"></i><b> หลักสูตรนี้เหมาะสำหรับ : </b>'+chktarget+'</span><br>'
                text += '<span style="font-size:13px;"><b> รายละเอียด</b></span><br>';
                text += '<textarea style="max-width: 100%;" class="form-control" rows="10" cols="100" readonly>'+ chkdetail +'</textarea>';
                text += '</tr>';

                //displays values to modal
                $(this).find("#modal_detail").html(text)
            }).on("hide.bs.modal", function(event) {
                $(this).find("#modal_detail").html("");
            });
            //console.log(x);
        }
    </script>
@endsection

@extends('layouts.master')

@section('content')
    <a href="{{ asset('/listidp') }}">
        <button class="btn btn-secondary" style="font-size: 12px;">
            < ย้อนกลับ</button>
    </a><br><br>

    <div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row">
            <div class="breadcrumb-header col-12">
                <div class="big-icon">
                    <i class="icofont icofont-ui-user"></i>
                </div>
                <div class="d-inline-block">
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
    </div>

    <div style="font-size: 13px; text-align: right; color:red;">
        @if ($date_update == null)
        @else
            <b>วันที่อัพเดต : {{ date('F j, Y H:i:s A', strtotime($date_update->LastDateUpdate)) }}</b>
        @endif
    </div>
    <br>
    <div class="page-body">
        <div class="card">
            <div class="card-block">
                <h5>รายการอบรม</h5><br>
                <form id="del_one" method="post" autocomplete="off" class="was-validated">
                    {{ csrf_field() }}
                    <div class="table-responsive">
                        <table id="datatable" class="table table-borderless">
                            <thead>
                                <tr>
                                    <th width=10% style="font-size: 13px; text-align: center;">No</th>
                                    <th width=30% style="font-size: 13px; text-align: center;">Course</th>
                                    <th width=20% style="font-size: 13px; text-align: center;">Result</th>
                                    <th width=20% style="font-size: 13px; text-align: center;">Date</th>
                                    <th width=20% style="font-size: 13px; text-align: center;">Method / Place</th>
                                    <th width=20% style="font-size: 13px; text-align: center;">#</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $i = 1;
                                @endphp
                                @if ($check_result->Result != null)
                                    <input type="hidden" class="form-control" name="email" placeholder=""
                                        value="{{ $header_emp_data->Email }}">
                                    <input type="hidden" class="form-control" name="EmployeeID" placeholder=""
                                        value="{{ $header_emp_data->EmployeeID }}">
                                    @foreach ($list_result as $item)
                                        <tr id="rowsub{{ $i }}">
                                            <td class="numberRow" style="font-size: 13px; text-align: center;">
                                                <strong>{{ $i }}</strong>
                                            </td>
                                            <td style="font-size: 13px;">
                                                <input type="hidden" class="form-control" name="CourseID[]" placeholder=""
                                                    value="{{ $item->CourseID }}">
                                                <input type="hidden" class="form-control" name="Coursename[]"
                                                    placeholder="" value="{{ $item->CourseName }}">
                                                {{ $item->CourseName }}
                                            </td>
                                            <input type="hidden" class="form-control" name="Result[]" placeholder=""
                                                value="{{ $item->Result }}">
                                            @if ($item->Result == 'Pass')
                                                <td style="font-size: 13px; text-align: center;"><span
                                                        class="label label-success">{{ $item->Result }}</span></td>
                                            @elseif ($item->Result == 'Waiting')
                                                <td style="font-size: 13px; text-align: center;"><span
                                                        class="label label-warning">{{ $item->Result }}</span></td>
                                            @elseif ($item->Result == 'Not Pass')
                                                <td style="font-size: 13px; text-align: center;"><span
                                                        class="label label-danger">{{ $item->Result }}</span></td>
                                            @else
                                                <td style="font-size: 13px; text-align: center;">{{ $item->Result }}</td>
                                            @endif

                                            <td style="font-size: 13px; text-align: center;">
                                                <input type="hidden" class="form-control" name="Date[]" placeholder=""
                                                    value="{{ $item->Date }}">
                                                {{ $item->Date }}
                                            </td>
                                            <input type="hidden" class="form-control" name="MethodID[]" placeholder=""
                                                value="{{ $item->MethodID }}">
                                            <input type="hidden" class="form-control" name="MethodName[]" placeholder=""
                                                value="{{ $item->MethodName }}">
                                            @if ($item->MethodName == 'JAS Online Learning')
                                                <td style="font-size: 13px; text-align: center;">
                                                    <a href="https://jasonlinelearning.com/" target="_blank">
                                                        {{ $item->MethodName }}</a>
                                                </td>
                                            @else
                                                <td style="font-size: 13px; text-align: center;">{{ $item->MethodName }}
                                                </td>
                                            @endif
                                            <td>
                                                <button type="button" class="btn btn-danger" style="float: none; font-size: 8px;"
                                                    onclick="delete_row({{ $i }});">
                                                    <span class="icofont icofont-ui-delete"></span></button>
                                            </td>
                                        </tr>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5" style="text-align: center; font-size:12px; color:brown">
                                            -------------- <b>ไม่พบข้อมูลการอบรม</b>---------------</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>

                    @if ($check_result->Result != null)
                        <br><br>
                        <div class="row">
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-block">Save</button>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="form-group">
                                </div>
                            </div>
                        </div><br>
                    @else
                    @endif


                </form>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    <script type="text/javascript"></script>
    <script>
        var table;
        $(document).ready(function() {
            // table = $('#datatable').DataTable({
            //     "searching": true,
            //     "columnDefs": [{
            //         "orderable": false
            //     }]
            // });
            $('.select2').select2({});
            $('.dataTables_filter').css("display", "none");
            $('.dataTables_length').css("display", "none");
            $('.dataTables_info').css("display", "none");
            $('.dataTables_paginate').css("display", "none");
        });

        function delete_row(id) {
            $("#rowsub" + id).remove();
            run_number();
        }
        //count number for skill_no
        function run_number() {
            var i = 1;
            $(".numberRow").each(function() {
                $(this).find("strong").text(i++);
            });
        }

        $("#del_one").submit(function(e) {
            e.preventDefault();
            var forms = $('#del_one')[0];
            var data = new FormData(forms);
            var textalert = '';
            textalert = {
                title: 'ลบรายการ',
                text: "คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "ตกลง",
                cancelButtonText: 'ยกเลิก'
            };
            Swal.fire(
                textalert
            ).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "{{ url('/listidp/delete') }}",
                        type: 'post',
                        processData: false,
                        contentType: false,
                        cache: false,
                        data: data,
                        icon: 'success',
                        success: function(data) {
                            if (data.code == 400) {
                                error();
                            } else {
                                success_del();
                            }
                            setTimeout(function() {
                                location.reload();
                            }, 1500);
                        }
                    })
                }
            });
        })
    </script>
@endsection

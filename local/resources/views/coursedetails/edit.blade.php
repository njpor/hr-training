@extends('layouts.master')

@section('content')
    <a href="{{ asset('/courseDetails') }}">
        <button class="btn btn-secondary" style="font-size: 12px;">
            < ย้อนกลับ</button>
    </a><br><br>
    <div class="card">
        <div class="card-block">

            <br>
            <h5 style="text-align: center">รายละเอียดหลักสูตร</h5><br><br>

            <form id="edit_course_details" method="post" autocomplete="off" class="was-validated">
                {{ csrf_field() }}

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><b>ชื่อหลักสูตร</b></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="CourseName"  value="{{ $course_details->CourseName }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><b>เป้าหมาย (Target)</b></label>
                    <div class="col-sm-10">
                        <input class="form-control" name="Target" value="{{ $course_details->Target == null ? '-' : $course_details->Target }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><b>รายละเอียด (Details)</b></label>
                    <div class="col-sm-10">

                        <textarea style="max-width: 100%;" class="form-control" rows="10" cols="70" name="Details">{{$course_details->Details == null || $course_details->Details == "" ? '-' : $course_details->Details }}</textarea>

                    </div>
                </div>
                <br>
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
                </div>
            </form>

        </div>
    </div>
@endsection

@section('body_bottom')
    <script>
        $("#edit_course_details").submit(function(e) {
            e.preventDefault();
            var forms = $('#edit_course_details')[0];
            var data = new FormData(forms);
            var textalert = '';
            textalert = {
                title: 'แก้ไขข้อมูล',
                text: "คุณต้องการแก้ไขข้อมูลใช่หรือไม่",
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
                        url: "{{ url('/update') }}",
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
                                success_save();
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

@extends('layouts.master')

@section('content')
    <div class="card">
        <div class="card-block">

            <br><h5 style="text-align: center">รายละเอียดหลักสูตรภายในระบบ</h5><br><br>

            <div class="table-responsive">
                <table id="simpletable" class="table ">
                    <thead>
                        <tr>
                            <th width="5%" style="text-align: center;">No</th>
                            <th width="30%" style="text-align: center;">CourseName</th>
                            <th width="40%" style="text-align: center;">Detail</th>
                            <th width="20%" style="text-align: center;">Target</th>
                            <th width="5%" style="text-align: center;">#</th>
                        </tr>
                    </thead>
                    <tbody id="">
                        @php
                            $i=1;
                        @endphp
                        @foreach ($course_details as $item)
                        @php
                            $id = base64_encode($item->id);
                        @endphp
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td style="font-size:13px;" >{{$item->CourseName }}</td>
                                <td style="font-size:12px">
                                    @if ($item->Details == null)
                                        <textarea style="max-width: 90%;" class="form-control" rows="1" cols="50" readonly>-</textarea>
                                    @else
                                        <textarea style="max-width: 90%;" class="form-control" rows="5" cols="50" readonly>{{$item->Details}}</textarea>
                                    @endif
                                </td>
                                <td><input style="max-width: 90%;" class="form-control" value="{{$item->Target == null ? '-' : $item->Target}}" readonly></td>
                                <td>
                                    <a href="{{ asset('/edit') }}/{{ $id }}" style="font-size:13px;  color:rgba(217, 122, 33, 0.799);">
                                        <b>Edit</b>
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
    <script>

    </script>
@endsection

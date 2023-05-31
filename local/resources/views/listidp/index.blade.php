@extends('layouts.master')

@section('content')
    <div class="card page-header p-0">
        <div class="card-block front-icon-breadcrumb row align-items-end">
            <div class="breadcrumb-header col">
                <div class="big-icon">
                    <i class="icofont icofont-contacts"></i>
                </div>
                <div class="d-inline-block">
                    <h5>List Employee All</h5>
                    <span>
                        <p>รายการข้อมูล Employee ภายในระบบ</p>
                    </span>
                </div>
            </div>
        </div>
    </div>


    <ul class="nav nav-tabs sm-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#listemp" role="tab">พนักงานในระบบ</a>
        </li>

    </ul>
    <!-- Tab panes -->
    <div class="tab-content card-block">
        <div class="tab-pane active" id="listemp" role="tabpanel">
            <div class="page-body">
                <div class="card">
                    <div class="card-block">
                        <h6><b>รายการพนักงานทั้งหมดในระบบ</b></h6>
                    </div>
                </div>

                <div class="card">
                    <div class="card-block">
                        <div class="table-responsive">
                            <table id="dom-jqry" class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th width=10%>Company</th>
                                        <th width=10%>EmployeeID</th>
                                        <th width=10%>Name</th>
                                        <th width=15%>Position</th>
                                        <th width=15%>Section</th>
                                        <th width=15%>Division</th>
                                        <th width=15%>Department</th>
                                        <th width=10%>#</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)
                                        @php
                                            $id = base64_encode($item->EmployeeID);
                                            // $id = $item->EmployeeID;
                                        @endphp
                                        <tr>
                                            <td style="font-size: 13px">{{ $item->CompanyShortName }}</td>
                                            <td style="font-size: 13px">{{ $item->EmployeeID }}</td>
                                            <td style="font-size: 13px">{{ $item->TFName }} {{ $item->TLName }}</td>
                                            <td style="font-size: 13px">
                                                {{ $item->Position == null ? '-' : $item->Position }}</td>
                                            <td style="font-size: 13px">{{ $item->Section == null ? '-' : $item->Section }}
                                            </td>
                                            <td style="font-size: 13px">
                                                {{ $item->Division == null ? '-' : $item->Division }}</td>
                                            <td style="font-size: 13px">
                                                {{ $item->Department == null ? '-' : $item->Department }}
                                            </td>
                                            <td>
                                                <a href="{{ asset('/view') }}/{{ $id }}" style="font-size:13px;  color:rgba(217, 122, 33, 0.799);">
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
            </div>
        </div>


    </div>
@endsection

@section('body_bottom')
    <script type="text/javascript"></script>
    <script></script>
@endsection

@extends('layouts.admin')
@section('content')
    <style>
        .table th {
            padding: 1.2em !important;
            vertical-align: top;
            border-top: 1px solid #f4f5f8;
        }

        .table td {
            padding: 1.5em !important;
            vertical-align: top;
            border-top: 1px solid #f4f5f8;
        }

        .table th {
            background-color: rgba(232, 234, 244, 0.6);
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background: none;
        }

        .table-striped tbody tr:nth-of-type(2n) {
            background-color: rgba(232, 234, 244, 0.3)
        }

        table.dataTable.no-footer {
            border-bottom: unset !important;
        }

        .dataTables_filter {
            display: none;
        }

        body {
            margin: 0;
            padding: 0;
        }

        .title {
            /* บีคอนส์ */
            font-style: normal;
            font-weight: 500;
            line-height: normal;
            font-size: 20px;
            color: #3D438D;
        }

        .marker {
            top: -0.9em !important;
        }

        .m-checkbox.m-checkbox--brand.m-checkbox--solid > input:checked ~ span {
            background: #0D8890 !important;
        }

        .dataTables_wrapper .pagination .page-item:hover > .page-link {
            background: #0D8890 !important;
        }

        #removeChechBox {
            cursor: pointer;
        }

        .check_beacon {
            pointer-events: none
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            border: 1px solid transparent !important;
            border-radius: 18px !important;
            background: #0D8890 !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background-color: #0D8890 !important;
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: white !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            border: 1px solid transparent !important;
            border-radius: 18px !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: 0.5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            border: 1px solid transparent !important;
            border-radius: 18px !important;
            color: #fff !important;
            background-color: #0a6aa1!important;
            background: -webkit-linear-gradient(top, #0D8890 0%, #0D8890 100%) !important;
        }

        #eventTable .dataTables_wrapper .dataTables_paginate .paginate_button.current, .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: white !important;
        }

        #eventTable .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
            color: #fff !important;
        }

        #filter_bar {
            padding: 20px;
            height: auto;
        }

        @media (min-width: 426px) {
            #filter_bar {
                position: fixed;
                top: 107px;
                left: 0;
                right: 0;
                z-index: 10;
            }

            #main-content {
                padding-top: 90px;
            }
        }

        @media (min-width: 1025px) {
            #filter_bar {
                left: 255px;
                top: 70px;
            }
        }

        #search_text {
            width: 150px;
        }

        .dataTables_wrapper .dataTable td .m-checkbox, .dataTables_wrapper .dataTable th .m-checkbox {
            left: 7px;
        }

        .square {
            height: 75px;
            background-color: #673AB7;
            border-radius: 4px;
            width: 105px;
            /*overflow: hidden;*/
        }

    </style>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- DOB -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css" />

        <!-- icon -->
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>HotelCloud - Add New guest & Schedule Management</title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col-3">
                {{--<a href="/admin/"> ผู้ใช้งาน</a>--}}
            </div>
            <div class="col-4"></div>
            <div class="col-3"></div>
            <div class="col-2">
                <a  class="btn btn--custom" href="{{url('guest/create')}}"
                    {{--                    data-toggle="modal" data-target="#newStaff"--}}
                    style="background-color: #0a6aa1;color:#fff;border-radius: 3px;float: right;"
                    role="button">
                    Add Guest  <i class="fas fa-plus-circle"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head"  style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">
                            Guest
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="m-portlet__body" id="eventTable">
            <div class="tab-content">
                <div class="tab-pane active" id="m_user_profile_tab_1">

                </div>
                <div class="tab-pane " id="m_user_profile_tab_2"></div>
                <div class="tab-pane " id="m_user_profile_tab_3"></div>
            </div>
        </div>

        <div class="m-portlet__body" id="eventTable">

                    <div class="m-portlet__body" id="eventTable">
                        <div class="row">
                            <div class="col-3">
                                <div class="row">
                                    <div class="col-2"><label style="padding-top: 10px;">แสดง</label></div>
                                    <div class="col-4 form-group">    <!--		Show Numbers Of Rows 		-->
                                        <select class="form-control" name="state" id="maxRows" style="width: 75px;"
                                                onchange="maxpage(this.value);">
                                            <option value="25" selected>25</option>
                                            <option value="50">50</option>
                                            <option value="50">100</option>
                                        </select>
                                    </div>
                                    <div class="col-2"><label style="padding-top: 10px;">รายการ</label></div>
                                </div>
                            </div>
                            <div class="col-6"></div>
                            <div class="col-3">
                                <div class="m-input-icon m-input-icon--left">
                                    <input type="text" class="form-control m-input light-table-filter" id="data-search" data-table="order-table" placeholder="ค้นหา">
                                    <span class="m-input-icon__icon m-input-icon__icon--left">
                            <span>
                                <i class="la la-search"></i>
                            </span>
                        </span>
                                </div>
                            </div>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                {{--<li class="nav-item">--}}
                                    {{--<a class="nav-link active" id="guest-booking-tab" data-toggle="tab" href="#guest-booking" role="tab" aria-controls="guest-booking" aria-selected="true">Guests Booking</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item">
                                    <a class="nav-link" id="guest-list-tab" data-toggle="tab" href="#guest-list" role="tab" aria-controls="guest-list" aria-selected="true">Guests List</a>
                                </li>--}}
                            </ul>
                      {{--  <div class="tab-pane fade show active" id="guest-booking" role="tabpanel" aria-labelledby="guest-booking-tab">
                            <table class="table table-hover table-responsive" id="guest-booking-table">
                                <thead>
                                    <tr>
                                        <th>Booking ID</th>
                                        <th>Date Check In </th>
                                        <th>Date Check Out </th>
                                        <th>First Name</th>
                                        <th>Last  Name</th>
                                        <th>Card  Id</th>
                                        <th>Passport Id</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>--}}
                        <div
                                {{--class="tab-pane fade" id="guest-list" role="tabpanel" aria-labelledby="guest-list-tab"--}}
                        >
                            <table class="table table-hover table-responsive" id="staff-table">
                                <thead>
                                    <tr>
                                        <th>First Name</th>
                                        <th>Last  Name</th>
                                        <th>Card  Id</th>
                                        <th>Passport Id</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Country</th>
                                        <th>File</th>
                                        <th>Edit / Read More</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        </div>
        </div>
    </div>
@endsection
@push('scripts')
                <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
                <script>
                    var t_g_booking = $('#guest-booking-table').DataTable({
                        processing: true,
                        serverSide: true,
                        bDeferRender: true,
                        ajax: {
                            url: '{!! route('guest.booking') !!}',
                            type: 'GET',
                            data: function (d) {
                                d._token = "{{ csrf_token() }}",
                                    d.search = $('#data-search').val()
                            }
                        },
                        'language': {
                            'paginate': {
                                'first': '<<',
                                'last': '>>',
                                'next': 'ถัดไป',
                                'previous': 'ก่อนหน้า'
                            },
                            'info': 'แสดงทั้งหมด _START_ - _END_ จาก _TOTAL_ รายการ',
                        },
                        pagingType: 'full_numbers',
                        pageLength: 5,
                        columnDefs: [
                            {
                                'searchable': false,
                                'orderable': false,
                                'targets': [0]
                            },
                            {
                                'className': 'text-right',
                                // 'targets': [6]
                            },
                        ],
                        dom: 'Bfrtip',
                        columns: [
                            { data: 'id' , width: '5%'},
                            { data: 'check_in' , width: '20%'},
                            { data: 'check_out' , width: '20%'},
                            { data: 'first_name', width: '15%'},
                            { data: 'last_name', width: '15%'},
                            { data: 'card_id',width: '5%'},
                            { data: 'passport_id', width: '5%'},
                            { data: 'email', width: '10%'},
                            { data: 'phone', width: '5%'},
                            { data: 'guest_country', width: '5%'},
                        ]
                    });


                    var t = $('#staff-table').DataTable({
                        processing: true,
                        serverSide: true,
                        bDeferRender: true,
                        ajax: {
                            url: '{!! route('guest.list') !!}',
                            type: 'GET',
                            data: function (d) {
                                d._token = "{{ csrf_token() }}",
                                    d.search = $('#data-search').val()
                            }
                        },
                        'language': {
                            'paginate': {
                                'first': '<<',
                                'last': '>>',
                                'next': 'ถัดไป',
                                'previous': 'ก่อนหน้า'
                            },
                            'info': 'แสดงทั้งหมด _START_ - _END_ จาก _TOTAL_ รายการ',
                        },
                        pagingType: 'full_numbers',
                        pageLength: 5,
                        columnDefs: [
                            {
                                'searchable': false,
                                'orderable': false,
                                'targets': [7]
                            },
                            {
                                'className': 'text-right',
                                // 'targets': [6]
                            },
                        ],
                        dom: 'Bfrtip',
                        columns: [
                            { data: 'first_name' ,width: '20%'},
                            { data: 'last_name' ,width: '20%'},
                            { data: 'card_id' ,width: '5%'},
                            { data: 'passport_id',width: '5%'},
                            { data: 'email',width: '10%'},
                            { data: 'phone',width: '10%'},
                            { data: 'guest_country',width: '10%'},
                            { data: 'file', render:function (staff_file, _, row) {
                                    if (staff_file) {
                                        return `<a href="{{ url('')  }}/${row.file}" target="_blank">Download file</a>`;
                                    } else {
                                        return `No file`;
                                    }
                                },width: '10%'},
                            { data: 'id', render: function (id) {
                                    return `<a href="/guest/${id}?detail=0">
                                <ion-icon name="create" data-toggle="modal" data-target="#editStaff"></ion-icon>
                            </a>
                            <a href="/guest/${id}?detail=1">
                                <ion-icon name="document" data-toggle="modal" data-target="#staffDetail"></ion-icon>
                            </a>
                            <a href="/guest/${id}/destroy">
                                <ion-icon name="trash" data-toggle="modal" data-target="#staffDetail"></ion-icon>
                            </a>
                                `;
                                },width: '20%'}
                        ]
                    });

                    function maxpage(maxpage) {
                        t_g_booking.page.len(maxpage).draw();
                        t.page.len(maxpage).draw();
                    }

                    $('#data-search').on( 'keyup', function () {
                        t_g_booking.search( this.value ).draw();
                        t.search( this.value ).draw();
                    });

                    $('#data-search').change(function () {
                        t_g_booking.ajax.reload()
                        t.ajax.reload()
                    });
                </script>



@endpush

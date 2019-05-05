<?php $permission = Auth::user() ?>
@if($permission->staff_role === 'admin')
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

        <title>HotelCloud - Add New Room & Schedule Management</title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col justify-content-end">
                @if($permission->staff_role === 'admin')
                    <a  class="btn btn--custom" href="{{url('room/create')}}"
                        style="background-color: #0a6aa1;color:#fff;border-radius: 3px;float: right;"
                        role="button">
                        Add Room  <i class="fas fa-plus-circle"></i>
                    </a>
                @endif

            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head"  style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">
                            Room
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
            <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">

            </div>
            <div class="tab-content" id="myTabContent">
                @if($permission->staff_role === 'admin')
                    <div class="tab-pane fade show active" id="room-list" role="tabpanel" aria-labelledby="room-list-tab">
                        <table class="table table-hover table-responsive" id="room-table" width="100%">
                            <thead>
                            <tr>
                                <th>Room Name</th>
                                <th>Room Type</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Special Price</th>
                                <th>Edit / Read More</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        var room = $('#room-table').DataTable({
            processing: true,
            serverSide: true,
            bDeferRender: true,
            ajax: {
                url: '{!! route('getRoom') !!}',
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
                    'targets': [5]
                },
                {
                    'className': 'text-right',
                    // 'targets': [5]
                },
            ],
            dom: 'Bfrtip',
            columns: [
                { data: 'name', width: '20%'},
                { data: 'room_type_name', width: '20%'},
                { data: 'price', width: '10%'},
                {  data: 'status', render: function (status, b, row) {
                    if(status ==='available'){
                       return  '<span style="color:green;">Available</span>' ;

                    }else {
                        return  '<span style="color:#ffcc2d;">Maintenance</span>';

                    }

                    }, width: '15%'},
                { data: 'room_special_price', width: '20%'},
                { data: 'id', render: function (id) {
                        @if($permission->staff_role === 'admin')
                            return `<a href="/room/${id}?detail=0">
                                <ion-icon name="create" data-toggle="modal" data-target="#editRomm"></ion-icon>
                            </a>
                            <a href="/room/${id}?detail=1">
                                <ion-icon name="document" data-toggle="modal" data-target="#staffRomm"></ion-icon>
                            </a>
                            <a href="/room/${id}/destroy">
                                <ion-icon name="trash" data-toggle="modal" data-target="#staffRomm"></ion-icon>
                            </a>
                                `;
                        @else
                            return '-'
                        @endif


                    }, width: '15%'}
            ]
        });

        $('#data-search').on( 'keyup', function () {
            room.search( this.value ).draw();
        });

        $('#data-search').change(function () {
            room.ajax.reload()
        });


        function maxpage(maxpage) {
            room.page.len(maxpage).draw();
        }
    </script>

@endpush
@else
@endif

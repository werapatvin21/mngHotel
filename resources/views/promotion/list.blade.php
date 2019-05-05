<?php $permission = Auth::user() ?>
@if($permission->staff_role === 'admin' || $permission->staff_role === 'owner' )
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

        <title>HotelCloud - Add New promotion & Schedule Management</title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col justify-content-end">
            @if($permission->staff_role === 'admin' || $permission->staff_role === 'owner' )
{{--                    <a  class="btn btn--custom" href="{{url('promotion/create')}}"--}}
{{--                        style="background-color: #0a6aa1;color:#fff;border-radius: 3px;float: right;"--}}
{{--                        role="button">--}}
{{--                        Add Promotion  <i class="fas fa-plus-circle"></i>--}}
{{--                    </a>--}}
                    <button type="button"     style="float: right; margin-left: 2px"  class="btn btn-outline-success" data-toggle="modal" data-target="#newPromo"><ion-icon name="add-circle-outline"></ion-icon>New Promotion</button>

                @endif

            </div>
        </div>
    </div>

    <!--================ Modal New Promo =================-->
    <div class="modal fade" id="newPromo" tabindex="-1" role="dialog" aria-labelledby="addNewPromo" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNewPromo">Add New Promotion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="m-form m-form--fit " enctype="multipart/form-data"
                      action="{{ $data->id ? route('promotion.update', ['id' => $data->id]) : route('promotion.store') }}"
                      method="POST">
                    @csrf
                    @if($data && $data->id)
                        @method('PUT')
                    @endif
                    <div class="m-portlet__body" id="eventTable">
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="promo__name" class="col-sm-4 col-form-label">Name
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                                        <div class="col-sm-8"><input type="text" name="name" class="form-control" id="promo_name"
                                                                     @if($detail != 0)
                                                                     disabled
                                                                     @endif
                                                                     required value="{{$data->name}}"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="promo__code" class="col-sm-4 col-form-label">Code</label>
                                        <div class="col-sm-8"><input type="text" name="code"
                                                                     value="{{$data->code}}"
                                                                     @if($detail != 0)
                                                                     disabled
                                                                     @endif
                                                                     class="form-control" id="promo_code"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="promo_discount" class="col-sm-4 col-form-label">Discount
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                                        <div class="col-sm-8 my-1">
                                            <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control"
                                                       @if($detail != 0)
                                                       disabled
                                                       @endif
                                                       required
                                                       {{--max="100"--}}
                                                       value="{{$data->discount?:1}}"
                                                       name="discount" id="promo_discount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="promo_unit" class="col-sm-4 col-form-label">Unit
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="unit" id="promo_unit"
                                                    @if($detail != 0)
                                                    disabled
                                                    @endif
                                                    required>
                                                <option value="">-- Select --</option>
                                                <option value="{{'Baht'}}" @if($data->unit === 'Baht') selected @endif>Baht</option>
                                                <option value="{{'Percentage'}}" @if($data->unit === 'Percentage') selected @endif>Percentage</option>


                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="promo_dateStart" class="col-sm-4 col-form-label">Start
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                                        <div class="col-sm-8 my-1">
                                            <input id="promo_datepickerStart"
                                                   @if($detail != 0)
                                                   disabled
                                                   @endif
                                                   required class="form-control"  value="{{$data->start_at}}" name="start_at" width="135" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="promo_dateEnd" class="col-sm-4 col-form-label">End
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                                        <div class="col-sm-8 my-1">
                                            <input id="promo_datepickerEnd"
                                                   @if($detail != 0)
                                                   disabled
                                                   @endif
                                                   required class="form-control" value="{{$data->end_at}}" name="end_at" width="135" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="promo_dateStart" class="col-sm-4 col-form-label">Exception Date
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span></label>
                                        <div class="col-sm-8 my-1">
                                            <input id="promo_datepickerStart"
                                                   @if($detail != 0)
                                                   disabled
                                                   @endif
                                                   required class="form-control"  value="" name="start_at" width="135" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="promo_note">Note:</label>
                                        <textarea  name="note" class="form-control" rows="3" id="promo_note"
                                                   @if($detail != 0)
                                                   disabled
                                    @endif
                            >
                                {{$data->note}}
                            </textarea>
                                    </div>
                                </div>
                            </div>

                            @if($detail != 1)
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn--custom"><i class="fas fa-save"></i>
                                        Save
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>

    <!--================ End Modal New Promo =================-->

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head"  style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">
                            Promotion
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
                                <th>Promotion Name</th>
                                <th>Promotion Code</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Discount</th>
                                <th>Unit</th>
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
        $("#promo_unit").change(function () {
            let  promo_discount = $('#promo_discount').val();
            let promo_unit  = $('#promo_unit').val()
            if (parseInt(promo_discount) > 100 &&  promo_unit === 'Percentage'){
                $('#promo_discount').val(0);
               alert('The number of per cent is incorrect.')
                return false;
             }else {
                return true;
            }

        });

        $("#promo_discount").keyup(function () {
            let  promo_discount = $('#promo_discount').val();
            let promo_unit  = $('#promo_unit').val()
            if (parseInt(promo_discount) > 100 &&  promo_unit === 'Percentage'){
                $('#promo_discount').val(0);
                alert('The number of per cent is incorrect.'+promo_discount)
                return false;
            }else {
                return true;
            }

        });


        var date = new Date();
        date.setDate(date.getDate());


        $('#promo_datepickerStart').datepicker({
            format: 'yyyy-mm-dd',
            startDate: date,
            // uiLibrary: 'bootstrap4'
        });
        $('#promo_datepickerEnd').datepicker({
            format: 'yyyy-mm-dd',
            startDate: date,
            // uiLibrary: 'bootstrap4'
        });

        var room = $('#room-table').DataTable({
            processing: true,
            serverSide: true,
            bDeferRender: true,
            ajax: {
                url: '{!! route('promotion.list') !!}',
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
                    'targets': [6]
                },
                {
                    'className': 'text-right',
                    // 'targets': [5]
                },
            ],
            dom: 'Bfrtip',
            columns: [
                { data: 'name', width: '20%'},
                { data: 'code', width: '10%'},
                { data: 'start_at', width: '10%'},
                { data: 'end_at', width: '10%'},
                { data: 'discount', width: '10%'},
                { data: 'unit', width: '10%'},
                { data: 'id', render: function (id,_,row) {
                        @if($permission->staff_role === 'admin' || $permission->staff_role === 'owner')
                            return `<a href="/promotion/${id}?detail=0">
                                <ion-icon name="create" data-toggle="modal" data-target=""></ion-icon>
                            </a>
                            <a href="#">
                                <ion-icon name="document" data-toggle="modal" data-target="#detailPromo${id}"></ion-icon>
                            </a>

                              <div class="modal fade" id="detailPromo${id}" tabindex="-1" role="dialog" aria-labelledby="addNewPromo" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="addNewPromo">Detail Promotion</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                            </div>

                            <div class="m-portlet__body" id="eventTable">
                            <div class="container">
                            <div class="row">
                            <div class="col">
                            <div class="form-group row">
                            <label for="promo__name" class="col-sm-4 col-form-label">Name</label>
                            <div class="col-sm-8"><input type="text" name="name" class="form-control" id="promo_name"
                            disabled
                            value="${row.name}"></div>
                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group row">
                            <label for="promo__code" class="col-sm-4 col-form-label">Code</label>
                            <div class="col-sm-8"><input type="text" name="code"
                            value="${row.code}"
                            disabled
                            class="form-control" id="promo_code"></div>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">
                            <div class="form-group row">
                            <label for="promo_discount" class="col-sm-4 col-form-label">Discount</label>
                            <div class="col-sm-8 my-1">
                            <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                            <div class="input-group">
                            <input type="number" class="form-control"
                            disabled
                            value="${row.discount}"
                            name="discount" id="promo_discount">
                            </div>
                            </div>
                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group row">
                            <label for="promo_unit" class="col-sm-4 col-form-label">Unit</label>
                            <div class="col-sm-8">
                             <input type="text" class="form-control"
                            disabled
                            value="${row.unit}">
                            </div>
                            </div>
                            </div>
                            </div>

                            <div class="row">
                            <div class="col">
                            <div class="form-group row">
                            <label for="promo_dateStart" class="col-sm-4 col-form-label">Start</label>
                            <div class="col-sm-8 my-1">
                            <input id="promo_datepickerStart"
                            disabled
                            class="form-control"  value="${row.start_at}" name="start_at" width="135" />
                            </div>
                            </div>
                            </div>
                            <div class="col">
                            <div class="form-group row">
                            <label for="promo_dateEnd" class="col-sm-4 col-form-label">End</label>
                            <div class="col-sm-8 my-1">
                            <input id="promo_datepickerEnd"
                            disabled
                            class="form-control" value="${row.end_at}" name="end_at" width="135" />
                            </div>
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col">
                            <div class="form-group">
                            <label for="promo_note">Note:</label>
                            <textarea  name="note" class="form-control" rows="3" id="promo_note"
                            disabled  >
                            ${row.note}
                            </textarea>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            <a href="/promotion/${id}/destroy">
                                <ion-icon name="trash" data-toggle="modal" data-target="#staffRomm"></ion-icon>
                            </a>
                                `;
                        @else
                            return '-'
                        @endif


                    }, width: '20%'}
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

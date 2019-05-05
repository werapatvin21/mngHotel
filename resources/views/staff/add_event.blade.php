@extends('layouts.admin')
@section('content')
    <style>
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

    </style>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- DOB -->
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://cdn.jsdelivr.net/npm/gijgo@1.9.10/css/gijgo.min.css" rel="stylesheet" type="text/css"/>

        <!-- icon -->
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
        <title>HotelCloud - Add New  Event Staff & Schedule Management</title>
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
                <a  class="btn btn--custom" href="{{route('staff.index')}}"
                    style="background-color: #0a6aa1;color:#fff;border-radius: 5px;float: right;"
                    role="button">
                    <i class="fas fa-back"></i> Back
                </a>
            </div>
        </div>
    </div>
    <?php $permission = Auth::user() ?>
    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head" style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">

                            @if(!$data->id &&  $permission->staff_role === 'admin')
                                Create
                            @endif
                                @if($data->id && $permission->staff_role === 'admin')
                                    Edit
                            @endif
                            Staff Event
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

        <form class="m-form m-form--fit " enctype="multipart/form-data"
              action="{{ $data->id ? route('staff_event.update', ['type_id' => $data->id]) : route('staff_event.store') }}"
              method="POST">
            @csrf
            @if($data && $data->id)
                @method('PUT')
            @endif
            <div class="m-portlet__body" id="eventTable">
                <div class="container">

                    <div  id="newStaff">
                        <!-- Modal body -->
                        <div class="modal-body">

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_name" class="col-sm-4 col-form-label">Event Name</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control"
                                                 value="{{old('event_name',$data->event_name)}}"
                                                 @if($detail != 0 || $permission->staff_role === 'user')
                                                 readonly="{{$detail}}"
                                                 @endif
                                                 name="event_name"
                                                 required
                                                 id="event_name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_id" class="col-sm-4 col-form-label">Staff Name</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="staff_id"
                                                    id="js-example-basic-hide-search-multi"
                                                    @if($detail != 0 || $permission->staff_role === 'user')
                                                    readonly="{{$detail}}"
                                                    @endif
                                                    required>
                                                <option value="">-- Staff Name --</option>
                                                @if(isset($staffs)&& count($staffs) != 0)
                                                    @php $id_staff = old('staff_id',$data->staff_id); @endphp
                                                    @foreach($staffs as $key => $staff)
                                                        <option {{$staff->id == $id_staff ?'selected':''}} value="{{$staff->id}}">{{$staff->name}}</option>
                                                    @endforeach
                                                @else
                                                    <option value="">No Staff</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="inputAddress" class="col-sm-4 col-form-label">Start At</label>
                                        <div class="col-sm-8">
                                            <input class="form-control"
                                                 @if($detail != 0 || $permission->staff_role === 'user')
                                                 readonly="{{$detail}}"
                                                 @endif
                                                 name="start_at" id="start_at"
                                                 value="{{old('start_at',$data->start_at)}}"
                                                 required
                                                 placeholder="yyyy-mm-dd">
                                                <span class="help-block">
                                                    <strong id="message_start"></strong>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="inputAddress2" class="col-sm-4 col-form-label">End At</label>
                                        <div class="col-sm-8">
                                            <input class="form-control"
                                                 @if($detail != 0 || $permission->staff_role === 'user')
                                                 readonly="{{$detail}}"
                                                 @endif
                                                 value="{{old('end_at', $data->end_at)}}"
                                                 name="end_at" id="end_at"
                                                  required
                                                 placeholder="yyyy-mm-dd">
                                                <span class="help-block">
                                                    <strong id="message_end"></strong>
                                                </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <!-- Modal footer -->

                        <div class="modal-footer">
                            @if($detail != 1 && $permission->staff_role === 'admin')
                                <button type="submit" class="btn btn--custom"><i class="fas fa-save"></i>
                                    Save Staff Event
                                </button>
                            @endif


                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </form> <!-- end action here -->
    </div>
@endsection
@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script>
        var date = new Date();
        date.setDate(date.getDate());
        $('#start_at, #end_at').datepicker({
            uiLibrary: 'bootstrap4',
            format: 'yyyy-mm-dd',
            startDate: date,
        });

        $('#js-example-basic-hide-search-multi').select2(
            {
                theme: "bootstrap4",
                placeholder: "-- Staff Name --",
            }
        );

    </script>
    <script>
        $(document).ready(function () {
            $('#start_at').change(function () {
                if($('#end_at').val()) {
                    if ($('#end_at').val() < $('#start_at').val()) {
                        $('#start_at').val('')
                        $('#message_start').html('ไม่สามารถใส่วันที่มากกว่าวันที่สุดท้ายได้').css('color', '#ff4d4d');
                    } else {
                        $('#message_start').empty();
                    }
                }
            })

            $('#end_at').change(function () {
                if ($('#start_at').val() > $('#end_at').val()) {
                    $('#end_at').val('')
                    $('#message_end').html('ไม่สามารถใส่วันที่น้อยกว่าวันที่เริ่มต้นได้').css('color', '#ff4d4d');
                } else {
                    $('#message_end').empty();
                }
            })

        })
    </script>
@endpush


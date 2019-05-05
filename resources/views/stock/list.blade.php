<?php $permission = Auth::user() ?>
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
        .dataTables_wrapper .dataTable td .m-checkbox, .dataTables_wrapper .dataTable th .m-checkbox {
            left: 7px;
        }

        span.select2-container {
            z-index:10050;
        }
        .modal-open .select2-dropdown {
            z-index: 10060;
        }

        .modal-open .select2-close-mask {
            z-index: 10055;
        }

    </style>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <title></title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <!-- icon -->
    <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col justify-content-end">

                    {{--<a  class="btn btn--custom" href="{{url('stock/create')}}"--}}
                        {{--style="background-color: #0a6aa1;color:#fff;border-radius: 3px;float: right;"--}}
                        {{--role="button">--}}
                        {{--Add Stock  <i class="fas fa-plus-circle"></i>--}}
                    {{--</a>--}}
                    <div style="float: right;">
                        @if($permission->staff_role === 'admin' || $permission->staff_role === 'owner' )
                        <button style="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#manageGoods">
                            {{--จัดการประเภทสินค้า--}}
                            Manage product categories
                        </button>
                        &nbsp;
                        @endif
                        <button style="" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newProduct"><ion-icon name="add-circle-outline"></ion-icon>
                            {{--รายงานสินค้าใหม่--}}
                            New product report
                        </button>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#newType"><ion-icon name="add-circle-outline"></ion-icon>New Stock Type</button>

                    </div>


            </div>
        </div>
    </div>

    <form class="m-form m-form--fit " enctype="multipart/form-data"
          action="{{ $data->id ? route('stock.update', ['id' => $data->id]) : route('stock.store') }}"
          method="POST">
    @csrf
    @if($data && $data->id)
        @method('PUT')
    @endif
    <!--================ Modal New Goods =================-->
    <div class="modal fade" id="newProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        {{--รายงานสินค้า--}}
                        Product report
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row-mt-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                    {{--วันที่: --}}
                                    Date:
                                </span>
                            </div>
                            <input type="text" name="created_at" value="{{date('d/m/Y')}}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled placeholder="ต้องขึ้นวันที่ ณ ปัจจุบัน อัตโนมัติ">
                        </div>
                    </div>
                    <div class="row-mt-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                    {{--รายการ:--}}
                                    START
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                    :
                                </span>
                            </div>
                            <select id="list_name"  class="form-control form-control-sm" name="list_name" required>
                                <option value=""> -- Select --</option>
                                {{--@if($permission->staff_role === 'admin' || $permission->staff_role === 'owner' )--}}
                                    {{--<option value="ยอดยกมา"> ยอดยกมา</option>--}}

                                    {{--<option value="รับสินค้าเข้า"> รับสินค้าเข้า</option>--}}
                                {{--@endif--}}
                                {{--@if($permission->staff_role === 'admin' || $permission->staff_role === 'user' || $permission->staff_role === 'owner')--}}
                                    {{--<option value="เบิกสินค้า"> เบิกสินค้า</option>--}}

                                {{--@endif--}}

                                @if($permission->staff_role === 'admin' || $permission->staff_role === 'owner')
                                    {{--<option value="{{'ยอดยกมา'}}" @if($data->list_name === 'ยอดยกมา') selected @endif>ยอดยกมา</option>--}}
                                    {{--<option value="{{'รับสินค้าเข้า'}}" @if($data->list_name === 'รับสินค้าเข้า') selected @endif>รับสินค้าเข้า</option>--}}
                                    <option value="{{'In'}}" @if($data->list_name === 'In') selected @endif>In</option>
                                @endif
                                @if($permission->staff_role === 'admin' || $permission->staff_role === 'user' ||  $permission->staff_role === 'owner')
                                    {{--<option value="{{'เบิกสินค้า'}}" @if($data->list_name === 'เบิกสินค้า') selected @endif>เบิกสินค้า</option>--}}
                                    <option value="{{'Out'}}" @if($data->list_name === 'Out') selected @endif>Out</option>
                                @endif



                            </select>
                        </div>
                    </div>

                    <div class="row-mt-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Type
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                    : </span>
                            </div>

                            <select class="form-control" name="type"
                                    id="js-example-basic-hide-search-multi"
                                    required>
                                <option value="">-- Select Type --</option>
                                @if(isset($product_types)&& count($product_types) != 0)
                                    @php $type = old('staff_id',$data->type); @endphp
                                    @foreach($product_types as $key => $product_type)
                                        <option {{$product_type->id == $type ?'selected':''}} value="{{$product_type->id}}">{{$product_type->name}}</option>
                                    @endforeach
                                @else
                                    <option value="">No Type</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="row-mt-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                    {{--ชื่อสินค้า:--}}
                                    Name
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                    :
                                </span>
                            </div>
                            <select class="form-control" name="product_name"
                                    id="product-name" required>
                            @if(isset($stocks)&& count($stocks) != 0)
                                {{--@php $stock_id = old('product_name',$data->id); @endphp--}}
                                @foreach($stocks as $key => $stock)
                                        {{--{{$stocks->id === $id_guest ?'selected':''}}--}}
                                    <option  value="{{$stock->product_name}}">{{$stock->product_name}}  </option>
                                @endforeach
                            @else
                                <option value="">No Product Name</option>
                            @endif
                            </select>
                            {{--<input type="text" name="product_name" required placeholder="ชื่อสินค้า" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">--}}

                        </div>
                    </div>
                    <div class="row-mt-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                    {{--เลขที่เอกสาร:--}}
                                    Doc.no.
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                </span>
                            </div>
                            <input type="text" name="number_report"  required  placeholder="Doc.no." class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>

                    <div class="row-mt-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                    {{--เลขที่เอกสาร:--}}
                                   File:
                                </span>
                            </div>
                            <input type="file" name="file" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>
                    <div class="row-mt-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">
                                    {{--เลขที่เอกสาร:--}}
                                    Quantity:
                                </span>
                            </div>
                            <input type="number" min="1" name="amount" value="1" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        </div>
                    </div>


                    <div class="row-mt-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                {{--<input type="text" id="status" name="status" readonly value="{{$data->status}}" required class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="กรุณาเลือกรายการ">--}}
                                {{--<select class="form-control form-control-sm" name="status" required>--}}
                                    {{--<option value="">-- Select --</option>--}}
                                    {{--<option value="bring">ยกมา</option>--}}
                                    {{--<option value="receive">รับ</option>--}}
                                    {{--<option value="pay">จ่าย</option>--}}
                                {{--</select>--}}
                            </div>
                            {{--<input type="number" min="1" name="amount" required class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">--}}
                        </div>
                    </div>
                    <div class="row-mt-3">
                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">Signature: </span>
                            </div>
                            <input type="text" value="{{$permission->name}}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled placeholder="ขึ้นชื่อ account ของคนที่ใช้งานอยู่ปัจจุบัน">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Modal New Goods =================-->
    </form>



    <form class="m-form m-form--fit " enctype="multipart/form-data"
          action="{{route('product_type.store') }}"
          method="POST">
    @csrf
    <!--================ Modal Manage Goods =================-->
    <div class="modal fade" id="manageGoods" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">
                        {{--เพิ่มสินค้าประเภทใหม่--}}
                        Add new products
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">
                                {{--ชื่อสินค้าใหม่: --}}
                                New product name
                                <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                :
                            </span>
                        </div>
                        <input type="text" name="name" placeholder="New product name" required class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                        <select class="form-control form-control-sm" name="type"  required>
                            <option value="">-- Select Type
                                <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span> </option>
                            <option value="อาหารภายในห้องพัก">อาหารภายในห้องพัก</option>
                            <option value="ของใช้ภายในห้องพัก">ของใช้ภายในห้องพัก</option>
                            <option value="อุปกรณ์อื่นๆ ภายในห้องพัก">อุปกรณ์อื่นๆ ภายในห้องพัก</option>
                            <option value="อาหารส่วนกลาง">อาหารส่วนกลาง</option>
                            <option value="ของใช้ส่วนกลาง">ของใช้ส่วนกลาง</option>
                            <option value="อุปกรณ์อื่นๆ ส่วนกลาง">อุปกรณ์อื่นๆ ส่วนกลาง</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Modal Manage Goods =================-->
    </form>



    <form class="m-form m-form--fit " enctype="multipart/form-data"
          {{--action="{{ $data->id ? route('room_type.update', ['id' => $data->id]) : route('room_type.store') }}"--}}
          action="{{route('stock_type.store') }}"
          method="POST">
        @csrf
        @if($data && $data->id)
            <input type="hidden" name="stock_id" value="{{$data->id}}">
        {{--@method('PUT')--}}
    @endif

        <!--================ Modal New Room Type =================-->
        <div class="modal fade" id="newType" tabindex="-1" role="dialog" aria-labelledby="addNewRoomType" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addNewRoomType">Add New Stock Type</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- ส่วนนี้จริงๆ ต้องดึงข้อมูลมาจาก DB ส่วน "Room Type" มาแสดง -->
                        @foreach($stock_types as $stock_type)
                            <div class="row">
                                <div class="col">
                                    {{$stock_type->name}}
                                </div>
                                <div class="col">
                                    <a href="{{url('/stock_types/'.$stock_type->id.'/destroy')}}">
                                        <ion-icon name="trash"></ion-icon> <!-- อันนี้ต้องเขียนแบบว่า room ไหนมีกาารใช้ type นั้นอยู่ ก็จะกดลบไม่ได้ด้วยปะ-->
                                    </a>


                                </div>
                            </div>
                        @endforeach
                        <br>
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm">New Stock Type
                                <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                : </span>
                        </div>
                        <input type="text" required class="form-control" name="name_stock_types" aria-label="Small" aria-describedby="inputGroup-sizing-sm" id="stockType">
                        <!-- ส่วนนี้ จะรับข้อมูลแล้วเอาไปแสดงด้านบน -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>

                </div>
            </div>
        </div>
    </form>

    <!--================ End Modal New Stock Type =================-->

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head"  style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">
                            Stock
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
                {{--@if($permission->staff_role === 'admin')--}}
                    <div class="tab-pane fade show active" id="room-list" role="tabpanel" aria-labelledby="room-list-tab">
                        <table class="table table-hover table-responsive" id="stock-table" width="100%">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Transaction</th>
                                <th>Doc.no</th>
                                <th>IN</th>
                                <th>OUT</th>
                                <th>BALANCE</th>
                                <th>Signature</th>
                               {{-- <th>แก้ไข/ดู</th>--}}
                            </tr>
                            </thead>
                        </table>
                    </div>
                {{--@endif--}}
            </div>
        </div>
    </div>

@endsection
@push('scripts')
    {{--<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>--}}
    <script>

        @if($permission->staff_role === 'admin' ||  $permission->staff_role === 'owner')
        $('#product-name').select2({
            dropdownParent: $('#newProduct'),
            tags: true,
            theme: "bootstrap4",
        });

        @else
        $('#product-name').select2({
            dropdownParent: $('#newProduct'),
            tags: false,
            theme: "bootstrap4",
        });

        @endif



        $('#list_name').change(function () {
            var list_name = $("#list_name").val()

            // if(list_name === 'ยอดยกมา'){
            // $("#status").val('ยกมา')
            // }else if (list_name === 'เบิกสินค้า') {
            //     $("#status").val('จ่าย')
            // }else {
            //     $("#status").val('รับ')
            // }

            if(list_name === 'In'){
                $("#status").val('ยกมา')
            }else if (list_name === 'Out') {
                $("#status").val('จ่าย')
            }else {
                $("#status").val('รับ')
            }


            console.log( list_name+$("#status").val())
        });
        var stock
        @if($permission->staff_role === 'admin' ||  $permission->staff_role === 'owner')
            stock = $('#stock-table').DataTable({
            processing: true,
            serverSide: true,
            bDeferRender: true,
            ajax: {
                url: '{!! route('getStock') !!}',
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
                    // 'targets': [10]
                },
                {
                    'className': 'text-right',
                    // 'targets': [5]
                },
            ],
            dom: 'Bfrtip',
            columns: [
                { data: 'created_at', render: function (created_at, _, row) {
                        if(created_at){
                            let current_datetime = new Date(created_at)
                            var result = current_datetime.toLocaleDateString("en-GB", {
                                year: "numeric",
                                month: "2-digit",
                                day: "2-digit",
                            });
                            return result;
                        }else {
                            return '-';
                        }
                    },width: '15%'},
                {
                data: 'product_name', render: function (product_name, _, row) {

                    var  product = '';

                        if (row.status === 'status') {
                            product = `Out<br>`  +row.product_type + `<br>` + product_name;
                        } else {
                            product = `In<br>` +row.product_type + `<br>` + product_name;
                        }
                        return product;
                    }, width: '20%'
                },
                {
                    data: 'number_report', render: function (number_report, _, row) {

                        var  file = '';

                        if (row.file) {
                            file = number_report+` <a href="/${row.file}" target="_blank">
                                <i class="fa fa-file" aria-hidden="true"></i>
                             </a>`;
                        } else {
                            file = number_report+'';
                        }
                        return file;
                    }, width: '15%'
                },

                {data: 'bring', width: '10%'},
                {data: 'pay', width: '10%'},
                {data: 'total', width: '10%'},
                {data: 'by', width: '20%'},
                /* { data: 'stock_id', render: function (stock_id, _, row) {

                             return `<a href="/stock/${stock_id}?detail=0">
                                 <ion-icon name="create" data-target="#StockEdit"></ion-icon>
                             </a>
                             <a href="/stock/${stock_id}?detail=1">
                                 <ion-icon name="document"  data-target="#StockDetail"></ion-icon>
                             </a>

                                 `;
                    /!* <a href="/stock/${stock_id}/destroy">
                             <ion-icon name="trash"  data-target="#StockDestroy"></ion-icon>
                             </a>
 *!/


                     },width: '10%'}*/
            ]
        });
        @else
            stock = $('#stock-table').DataTable({
            processing: true,
            serverSide: true,
            bDeferRender: true,
            ajax: {
                url: '{!! route('getStock') !!}',
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
                    // 'targets': [10]
                },
                {
                    'className': 'text-right',
                    // 'targets': [5]
                },
            ],
            dom: 'Bfrtip',
            columns: [
                { data: 'created_at', render: function (created_at, _, row) {
                        if(created_at){
                            let current_datetime = new Date(created_at)
                            var result = current_datetime.toLocaleDateString("en-GB", {
                                year: "numeric",
                                month: "2-digit",
                                day: "2-digit",
                            });
                            return result;
                        }else {
                            return '-';
                        }
                    },width: '15%'},
                // { data: 'list_name', width: '15%'},
                { data: 'product_name', width: '15%'},
                { data: 'number_report', width: '10%'},
                { data: 'product_type', width: '10%'},
                // { data: 'bring', width: '5%'},
                // { data: 'receive', width: '5%'},
                // { data: 'pay', width: '5%'},
                { data: 'total', width: '5%'},
                { data: 'by', width: '15%'},
                /* { data: 'stock_id', render: function (stock_id, _, row) {

                             return `<a href="/stock/${stock_id}?detail=0">
                                 <ion-icon name="create" data-target="#StockEdit"></ion-icon>
                             </a>
                             <a href="/stock/${stock_id}?detail=1">
                                 <ion-icon name="document"  data-target="#StockDetail"></ion-icon>
                             </a>

                                 `;
                    /!* <a href="/stock/${stock_id}/destroy">
                             <ion-icon name="trash"  data-target="#StockDestroy"></ion-icon>
                             </a>
 *!/


                     },width: '10%'}*/
            ]
        });
        @endif


        $('#data-search').on( 'keyup', function () {
            stock.search( this.value ).draw();
        });

        $('#data-search').change(function () {
            stock.ajax.reload()
        });


        function maxpage(maxpage) {
            stock.page.len(maxpage).draw();
        }
    </script>

@endpush



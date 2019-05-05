<?php $permission = Auth::user() ?>
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
    </style>
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <title>HotelCloud - Room Management</title>
    </head>

    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row col-12" style="margin-top: 20px;">
            <div class="col-3">
            </div>
            <div class="col-3">
            </div>
            <div class="col-6">
                <div style="float: right;">
                    <button style="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#manageGoods">จัดการประเภทสินค้า</button>
                    &nbsp;

                    <button style="" type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#newGoods"><ion-icon name="add-circle-outline"></ion-icon>รายงานสินค้าใหม่</button>

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
        <div class="modal fade" id="newGoods" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">รายงานสินค้า</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row-mt-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">วันที่: </span>
                                </div>รายงานสินค้า

                                <input type="text" name="created_at" value="{{date('d/m/Y')}}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled placeholder="ต้องขึ้นวันที่ ณ ปัจจุบัน อัตโนมัติ">
                            </div>
                        </div>
                        <div class="row-mt-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">รายการ: </span>
                                </div>
                                <select id="list_name"  class="form-control form-control-sm" name="list_name" required>
                                    <option value=""> -- Select --</option>
                                    <option value="ยอดยกมา"> ยอดยกมา</option>
                                    <option value="เบิกสินค้า"> เบิกสินค้า</option>
                                    <option value="รับสินค้าเข้า"> รับสินค้าเข้า</option>
                                </select>
                            </div>
                        </div>
                        <div class="row-mt-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">ชื่อสินค้า: </span>
                                </div>
                                <select class="form-control" name="product_name"
                                        id="js-example-basic-hide-search-multi" required>
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
                                    <span class="input-group-text" id="inputGroup-sizing-sm">เลขที่เอกสาร: </span>
                                </div>
                                <input type="text" name="number_report"  placeholder="เลขที่เอกสาร" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="row-mt-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Type: </span>
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
                                    <input type="text" id="status1" name="status" readonly  required class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="กรุณาเลือกรายการ">
                                    {{--<select class="form-control form-control-sm" name="status" required>--}}
                                    {{--<option value="">-- Select --</option>--}}
                                    {{--<option value="bring">ยกมา</option>--}}
                                    {{--<option value="receive">รับ</option>--}}
                                    {{--<option value="pay">จ่าย</option>--}}
                                    {{--</select>--}}
                                </div>
                                <input type="number" min="1" name="amount" required class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            </div>
                        </div>
                        <div class="row-mt-3">
                            <div class="input-group input-group-sm mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">ลงนาม: </span>
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
                        <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่มสินค้าประเภทใหม่</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="input-group input-group-sm mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroup-sizing-sm">ชื่อสินค้าใหม่: </span>
                            </div>
                            <input type="text" name="name" required class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                            <select class="form-control form-control-sm" name="type"  required>
                                <option value="">-- Select Type </option>
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

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head" style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">

                                @if($data && $data->id)
                                @if($detail)
                                    Detail
                                    @else
                                    Edit
                                @endif

                                    @else
                                    Add
                                @endif
                                    Stocks
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
              action="{{ $data->id ? route('stock.update', ['id' => $data->id]) : route('stock.store') }}"
              method="POST">
        @csrf
        @if($data && $data->id)
            @method('PUT')
        @endif
        <!--================ Modal New Goods =================-->
                    <div class="">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Product Report</h5>
                        </div>
                        <div class="modal-body">
                            <div class="row-mt-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">วันที่: </span>
                                    </div>
                                    <input type="text" name="created_at" value="{{date('d/m/Y')}}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled placeholder="ต้องขึ้นวันที่ ณ ปัจจุบัน อัตโนมัติ">
                                </div>
                            </div>
                            <div class="row-mt-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">รายการ: </span>
                                    </div>
                                    <select id="list_name"  class="form-control form-control-sm"
                                            {{--@if($detail)--}}
                                            {{--disabled--}}
                                            {{--@endif--}}
                                            disabled
                                            name="list_name" required>
                                        <option value=""> -- Select --</option>
                                        {{--<option value="ยอดยกมา"> ยอดยกมา</option>--}}
                                        {{--<option value="เบิกสินค้า"> เบิกสินค้า</option>--}}
                                        {{--<option value="รับสินค้าเข้า"> รับสินค้าเข้า</option>--}}
                                        @if($permission->staff_role === 'admin' || $permission->staff_role === 'owner')
                                            {{--<option value="{{'ยอดยกมา'}}" @if($data->list_name === 'ยอดยกมา') selected @endif>ยอดยกมา</option>--}}
                                            {{--<option value="{{'รับสินค้าเข้า'}}" @if($data->list_name === 'รับสินค้าเข้า') selected @endif>รับสินค้าเข้า</option>--}}
                                            <option value="{{'int'}}" @if($data->list_name === 'int') selected @endif>Int</option>
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
                                        <span class="input-group-text" id="inputGroup-sizing-sm">ชื่อสินค้า: </span>
                                    </div>
                                            <select class="form-control" name="product_name"
                                                    {{--@if($detail)--}}
                                                    disabled
                                                    {{--@endif--}}
                                                    id="js-example-basic-hide-search-multi" required>
                                                @if(isset($stocks)&& count($stocks) != 0)
                                                    @php $product_name = old('product_name',$data->product_name); @endphp
                                                    @foreach($stocks as $key => $stock)
                                                        {{--{{$stocks->id === $id_guest ?'selected':''}}--}}
                                                        <option  {{$stock->product_name === $product_name ?'selected':''}} value="{{$stock->product_name}}">{{$stock->product_name}}  </option>
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
                                        <span class="input-group-text" id="inputGroup-sizing-sm">เลขที่เอกสาร: </span>
                                    </div>
                                    <input type="text" name="number_report"
                                           @if($detail)
                                           disabled
                                           @endif
                                           placeholder="เลขที่เอกสาร" value="{{$data->number_report}}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                                </div>
                            </div>
                            <div class="row-mt-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">Type: </span>
                                    </div>

                                    <select class="form-control" name="type"
                                            id="js-example-basic-hide-search-multi"
                                            @if($detail)
                                            disabled
                                            @endif
                                            required>
                                        <option value="">-- Select Type --</option>
                                        @if(isset($product_types)&& count($product_types) != 0)
                                            @php $type = old('type',$data->type); @endphp
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
                                        <input type="text" id="status2"
                                               {{--@if($detail)--}}
                                               {{--disabled--}}
                                               {{--@endif--}}
                                               disabled
                                               name="status" readonly  required class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="กรุณาเลือกรายการ">
                                        {{--<select class="form-control form-control-sm" name="status" required>--}}
                                        {{--<option value="">-- Select --</option>--}}
                                        {{--<option value="bring">ยกมา</option>--}}
                                        {{--<option value="receive">รับ</option>--}}
                                        {{--<option value="pay">จ่าย</option>--}}
                                        {{--</select>--}}
                                    </div>
                                    <input type="number" min="1" name="amount"
                                           @if($detail)
                                           disabled
                                           @endif
                                           required class="form-control"
                                           @if($data->list_name === 'ยอดยกมา')
                                           value="{{$data->bring}}"
                                           @elseif($data->list_name === 'เบิกสินค้า')
                                           value="{{$data->pay}}"
                                           @else
                                           value="{{$data->receive}}"
                                           @endif >
                                </div>
                            </div>
                            <div class="row-mt-3">
                                <div class="input-group input-group-sm mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="inputGroup-sizing-sm">ลงนาม: </span>
                                    </div>
                                    <input type="text" value="{{$permission->name}}" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" disabled placeholder="ขึ้นชื่อ account ของคนที่ใช้งานอยู่ปัจจุบัน">
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <a  class="btn btn-default" href="{{route('stock.index')}}"
                                role="button">
                                <i class="fas fa-back"></i> Close
                            </a>
                            @if(!$detail)
                                <button type="submit" class="btn btn-primary">Add</button>
                            @endif


                        </div>
                    </div>

            <!--================ End Modal New Goods =================-->
        </form>
    </div>
    @endsection
    @push('scripts')
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>
        <script>
            @if($data->list_name === 'ยอดยกมา')
                $("#status2").val('ยกมา');
            @elseif($data->list_name === 'เบิกสินค้า')
                $("#status2").val('จ่าย');
            @else
                $("#status2").val('รับ');
            @endif

            $('#list_name').change(function () {
                var list_name = $("#list_name").val()

                if(list_name === 'ยอดยกมา'){
                    $("#status1").val('ยกมา')
                }else if (list_name === 'เบิกสินค้า') {
                    $("#status1").val('จ่าย')
                }else {
                    $("#status1").val('รับ')
                }
                console.log( list_name+$("#status2").val())
            });
        </script>
        <script>
        </script>
   @endpush

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
        <title>HotelCloud - Add New Staff & Schedule Management</title>
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

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head" style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="title">

                            @if($detail === 0)
                                Edit
                            @endif
                            @if(!$detail && $detail === null)
                                Create New
                            @else
                            @endif
                            Staff Account
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
              action="{{ $data->id ? route('staff.update', ['type_id' => $data->id]) : route('staff.store') }}"
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
                                        <label for="staff_name" class="col-sm-4 col-form-label">
                                            Full Name
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     value="{{old('staff_name',$data->name)}}"
                                                                     @if($detail != 0)
                                                                     readonly="{{$detail}}"
                                                                     @endif
                                                                     required
                                                                     name="staff_name" id="staff_name"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_id" class="col-sm-4 col-form-label">
                                            Staff ID
                                        </label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control"
                                                   value="{{old('staff_id',$data->id)}}"
                                                   @if($detail != 0)
                                                   readonly="{{$detail}}"
                                                   @endif
                                                   readonly
                                                   name="staff_id" id="staff_name">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_username" class="col-sm-4 col-form-label">
                                            Username
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     @if($detail != 0)
                                                                     readonly="{{$detail}}"
                                                                     @endif
                                                                      required
                                                                     value="{{old('staff_username',$data->staff_username)}}"
                                                                     name="staff_username" id="staff_username"></div>
                                    </div>
                                </div>
                                <div class="col">

                                    <div class="form-group row">
                                        <label for="password" class="col-sm-4 col-form-label">
                                            Password
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>

                                        <div class="col-sm-8">
                                            @if(!$data->id)
                                                <input type="password" class="form-control"
                                                       required
                                                       name="password" id="password">

                                            @else
                                                   @if($detail != 1)
                                                    <a href="{{ route('staff.change_pwd') }}?staff_id={{ $data->id }}" target="_blank">เปลี่ยนรหัสผ่าน</a>
                                                       @else
                                                        เปลี่ยนรหัสผ่าน
                                                        @endif


                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_id" class="col-sm-4 col-form-label">Date of Birth</label>
                                        <div class="col-sm-8"><input
                                                class="form-control" name="staff_birth" id="staff_birth"
                                                @if($detail != 0)
                                                readonly="{{$detail}}"
                                                @endif
                                                value="{{old('staff_birth',$data->staff_birth)}}"

                                                width="235"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_weigth" class="col-sm-4 col-form-label">Age</label>
                                        <div class="col-sm-8">
                                            <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control"  min="0" name="staff_age"
{{--                                                       @if($detail != 0)--}}
{{--                                                       readonly="{{$detail}}"--}}
{{--                                                       @endif--}}
                                                       readonly
                                                       value="{{old('staff_age',$data->staff_age)}}"

                                                       id="staff_age">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">years</div>
                                                </div>
                                            </div><!--calculate age automatic-->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_height" class="col-sm-4 col-form-label">Height</label>
                                        <div class="col-sm-8 my-1">
                                            <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" min="50" name="staff_height"
                                                       @if($detail != 0)
                                                       readonly="{{$detail}}"

                                                       @endif
                                                       value="{{old('staff_height',$data->staff_height)}}"
                                                       id="staff_height">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">cm.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_weight" class="col-sm-4 col-form-label">Weight</label>
                                        <div class="col-sm-8 my-1">
                                            <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" min="30" name="staff_weight"
                                                       @if($detail != 0)
                                                       readonly="{{$detail}}"
                                                       @endif

                                                       value="{{old('staff_weight',$data->staff_weight)}}"
                                                       id="staff_weight">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">kg.</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_role" class="col-sm-4 col-form-label">Department</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="department" id="department"
                                                    @if($detail != 0)
                                                    disabled
                                                    @endif

                                            >
                                                <option value="">-- Select --</option>
                                                <option value="Reception" {{ old('department',$data->department) == 'Reception' ? 'selected' : ''}}>Reception</option>
                                                <option value="Housekeeping" {{ old('department',$data->department) == 'Housekeeping' ? 'selected' : ''}}>Housekeeping</option>
                                                <option value="Food and Beverage" {{ old('department',$data->department) == 'Food and Beverage' ? 'selected' : ''}}>Food and Beverage</option>
                                                <option value="Owner-Board" {{ old('department',$data->department) == 'Owner-Board' ? 'selected' : ''}}> Owner-Board</option>
                                                <option value="Housekeeping" {{ old('department',$data->department) == 'Housekeeping' ? 'selected' : ''}}> Housekeeping</option>
                                                <option value="Food and Beverage" {{ old('department',$data->department) == 'Food and Beverage' ? 'selected' : ''}}> Food and Beverage</option>
                                                <option value="Other" {{ old('department',$data->department) == 'Other' ? 'selected' : ''}}> Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_pos" class="col-sm-4 col-form-label">Position</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     @if($detail != 0)
                                                                     readonly="{{$detail}}"
                                                                     @endif

                                                                     value="{{old('staff_pos',$data->staff_pos)}}"
                                                                     name="staff_pos" id="staff_pos"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="inputAddress" class="col-sm-4 col-form-label">Address</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     @if($detail != 0)
                                                                     readonly="{{$detail}}"
                                                                     @endif

                                                                     name="staff_address" id="staff_address"
                                                                     value="{{old('staff_address',$data->staff_address)}}"
                                                                     placeholder="1234 Main St"></div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="inputAddress2" class="col-sm-4 col-form-label">Address 2</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     @if($detail != 0)
                                                                     readonly="{{$detail}}"
                                                                     @endif
                                                                     value="{{old('staff_address2'?:$data->staff_address2)}}"
                                                                     name="staff_address2" id="staff_address2"
                                                                     placeholder="Apartment, studio, or floor">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="inputAddress3" class="col-sm-4 col-form-label">Address 3</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     @if($detail != 0)
                                                                     readonly="{{$detail}}"
                                                                     @endif
                                                                     value="{{old('staff_address3'?:$data->staff_address3)}}"
                                                                     name="staff_address3" id="staff_address3"
                                                                     placeholder="City">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_province" class="col-sm-4 col-form-label">Province</label>
                                        <div class="col-sm-8">
                                            <select name="staff_province" id="staff_province" class="form-control"
                                                    @if($detail != 0)
                                                    disabled
                                                    @endif

                                            >
                                                <option value="">-- Select --</option>
                                                <option value="กรุงเทพมหานคร" {{$data->staff_province == 'กรุงเทพมหานคร' ? 'selected':''}}>กรุงเทพมหานคร</option>
                                                <option value="กระบี่" {{$data->staff_province == 'กระบี่' ? 'selected':''}}>กระบี่ </option>
                                                <option value="กาญจนบุรี" {{$data->staff_province == 'กาญจนบุรี' ? 'selected':''}}>กาญจนบุรี </option>
                                                <option value="กาฬสินธุ์" {{$data->staff_province == 'กาฬสินธุ์' ? 'selected':''}}>กาฬสินธุ์ </option>
                                                <option value="กำแพงเพชร" {{$data->staff_province == 'กำแพงเพชร' ? 'selected':''}}>กำแพงเพชร </option>
                                                <option value="ขอนแก่น" {{$data->staff_province == 'ขอนแก่น' ? 'selected':''}}>ขอนแก่น</option>
                                                <option value="จันทบุรี" {{$data->staff_province == 'จันทบุรี' ? 'selected':''}}>จันทบุรี</option>
                                                <option value="ฉะเชิงเทรา" {{$data->staff_province == 'ฉะเชิงเทรา' ? 'selected':''}}>ฉะเชิงเทรา </option>
                                                <option value="ชัยนาท" {{$data->staff_province == 'ชัยนาท' ? 'selected':''}}>ชัยนาท </option>
                                                <option value="ชัยภูมิ" {{$data->staff_province == 'ชัยภูมิ' ? 'selected':''}}>ชัยภูมิ </option>
                                                <option value="ชุมพร" {{$data->staff_province == 'ชุมพร' ? 'selected':''}}>ชุมพร </option>
                                                <option value="ชลบุรี" {{$data->staff_province == 'ชลบุรี' ? 'selected':''}}>ชลบุรี </option>
                                                <option value="เชียงใหม่" {{$data->staff_province == 'เชียงใหม่' ? 'selected':''}}>เชียงใหม่ </option>
                                                <option value="เชียงราย" {{$data->staff_province == 'เชียงราย' ? 'selected':''}}>เชียงราย </option>
                                                <option value="ตรัง" {{$data->staff_province == 'ตรัง' ? 'selected':''}}>ตรัง </option>
                                                <option value="ตราด" {{$data->staff_province == 'ตราด' ? 'selected':''}}>ตราด </option>
                                                <option value="ตาก" {{$data->staff_province == 'ตาก' ? 'selected':''}}>ตาก </option>
                                                <option value="นครนายก" {{$data->staff_province == 'นครนายก' ? 'selected':''}}>นครนายก </option>
                                                <option value="นครปฐม" {{$data->staff_province == 'นครปฐม' ? 'selected':''}}>นครปฐม </option>
                                                <option value="นครพนม" {{$data->staff_province == 'นครพนม' ? 'selected':''}}>นครพนม </option>
                                                <option value="นครราชสีมา" {{$data->staff_province == 'นครราชสีมา' ? 'selected':''}}>นครราชสีมา </option>
                                                <option value="นครศรีธรรมราช" {{$data->staff_province == 'นครศรีธรรมราช' ? 'selected':''}}>นครศรีธรรมราช </option>
                                                <option value="นครสวรรค์" {{$data->staff_province == 'นครสวรรค์' ? 'selected':''}}>นครสวรรค์ </option>
                                                <option value="นราธิวาส" {{$data->staff_province == 'นราธิวาส' ? 'selected':''}}>นราธิวาส </option>
                                                <option value="น่าน" {{$data->staff_province == 'น่าน' ? 'selected':''}}>น่าน </option>
                                                <option value="นนทบุรี" {{$data->staff_province == 'นนทบุรี' ? 'selected':''}}>นนทบุรี </option>
                                                <option value="บึงกาฬ" {{$data->staff_province == 'บึงกาฬ' ? 'selected':''}}>บึงกาฬ</option>
                                                <option value="บุรีรัมย์" {{$data->staff_province == 'บุรีรัมย์' ? 'selected':''}}>บุรีรัมย์</option>
                                                <option value="ประจวบคีรีขันธ์" {{$data->staff_province == 'ประจวบคีรีขันธ์' ? 'selected':''}}>ประจวบคีรีขันธ์ </option>
                                                <option value="ปทุมธานี" {{$data->staff_province == 'ปทุมธานี' ? 'selected':''}}>ปทุมธานี </option>
                                                <option value="ปราจีนบุรี" {{$data->staff_province == 'ปราจีนบุรี' ? 'selected':''}}>ปราจีนบุรี </option>
                                                <option value="ปัตตานี" {{$data->staff_province == 'ปัตตานี' ? 'selected':''}}>ปัตตานี </option>
                                                <option value="พะเยา" {{$data->staff_province == 'พะเยา' ? 'selected':''}}>พะเยา </option>
                                                <option value="พระนครศรีอยุธยา" {{$data->staff_province == 'พระนครศรีอยุธยา' ? 'selected':''}}>พระนครศรีอยุธยา </option>
                                                <option value="พังงา" {{$data->staff_province == 'พังงา' ? 'selected':''}}>พังงา </option>
                                                <option value="พิจิตร" {{$data->staff_province == 'พิจิตร' ? 'selected':''}}>พิจิตร </option>
                                                <option value="พิษณุโลก" {{$data->staff_province == 'พิษณุโลก' ? 'selected':''}}>พิษณุโลก </option>
                                                <option value="เพชรบุรี" {{$data->staff_province == 'เพชรบุรี' ? 'selected':''}}>เพชรบุรี </option>
                                                <option value="เพชรบูรณ์" {{$data->staff_province == 'เพชรบูรณ์' ? 'selected':''}}>เพชรบูรณ์ </option>
                                                <option value="แพร่" {{$data->staff_province == 'แพร่' ? 'selected':''}}>แพร่ </option>
                                                <option value="พัทลุง" {{$data->staff_province == 'พัทลุง' ? 'selected':''}}>พัทลุง </option>
                                                <option value="ภูเก็ต" {{$data->staff_province == 'ภูเก็ต' ? 'selected':''}}>ภูเก็ต </option>
                                                <option value="มหาสารคาม" {{$data->staff_province == 'มหาสารคาม' ? 'selected':''}}>มหาสารคาม </option>
                                                <option value="มุกดาหาร" {{$data->staff_province == 'มุกดาหาร' ? 'selected':''}}>มุกดาหาร </option>
                                                <option value="แม่ฮ่องสอน" {{$data->staff_province == 'แม่ฮ่องสอน' ? 'selected':''}}>แม่ฮ่องสอน </option>
                                                <option value="ยโสธร" {{$data->staff_province == 'ยโสธร' ? 'selected':''}}>ยโสธร </option>
                                                <option value="ยะลา" {{$data->staff_province == 'ยะลา' ? 'selected':''}}>ยะลา </option>
                                                <option value="ร้อยเอ็ด" {{$data->staff_province == 'ร้อยเอ็ด' ? 'selected':''}}>ร้อยเอ็ด </option>
                                                <option value="ระนอง" {{$data->staff_province == 'ระนอง' ? 'selected':''}}>ระนอง </option>
                                                <option value="ระยอง" {{$data->staff_province == 'ระยอง' ? 'selected':''}}>ระยอง </option>
                                                <option value="ราชบุรี" {{$data->staff_province == 'ราชบุรี' ? 'selected':''}}>ราชบุรี</option>
                                                <option value="ลพบุรี" {{$data->staff_province == 'ลพบุรี' ? 'selected':''}}>ลพบุรี </option>
                                                <option value="ลำปาง" {$data->staff_province == 'ลำปาง' ? 'selected':''}}>ลำปาง </option>
                                                <option value="ลำพูน" {{$data->staff_province == 'ลำพูน' ? 'selected':''}}>ลำพูน </option>
                                                <option value="เลย" {{$data->staff_province == 'เลย' ? 'selected':''}}>เลย </option>
                                                <option value="ศรีสะเกษ" {{$data->staff_province == 'ศรีสะเกษ' ? 'selected':''}}>ศรีสะเกษ</option>
                                                <option value="สกลนคร" {{$data->staff_province == 'สกลนคร' ? 'selected':''}}>สกลนคร</option>
                                                <option value="สงขลา" {{$data->staff_province == 'สงขลา' ? 'selected':''}}>สงขลา </option>
                                                <option value="สมุทรสาคร" {{$data->staff_province == 'สมุทรสาคร' ? 'selected':''}}>สมุทรสาคร </option>
                                                <option value="สมุทรปราการ" {{$data->staff_province == 'สมุทรปราการ' ? 'selected':''}}>สมุทรปราการ </option>
                                                <option value="สมุทรสงคราม" {{$data->staff_province == 'สมุทรสงคราม' ? 'selected':''}}>สมุทรสงคราม </option>
                                                <option value="สระแก้ว" {{$data->staff_province == 'สระแก้ว' ? 'selected':''}}>สระแก้ว </option>
                                                <option value="สระบุรี" {{$data->staff_province == 'สระบุรี' ? 'selected':''}}>สระบุรี </option>
                                                <option value="สิงห์บุรี" {{$data->staff_province == 'สิงห์บุรี' ? 'selected':''}}>สิงห์บุรี </option>
                                                <option value="สุโขทัย" {{$data->staff_province == 'สุโขทัย' ? 'selected':''}}>สุโขทัย </option>
                                                <option value="สุพรรณบุรี" {{$data->staff_province == 'สุพรรณบุรี' ? 'selected':''}}>สุพรรณบุรี </option>
                                                <option value="สุราษฎร์ธานี" {{$data->staff_province == 'สุราษฎร์ธานี' ? 'selected':''}}>สุราษฎร์ธานี </option>
                                                <option value="สุรินทร์" {{$data->staff_province == 'สุรินทร์' ? 'selected':''}}>สุรินทร์ </option>
                                                <option value="สตูล" {{$data->staff_province == 'สตูล' ? 'selected':''}}>สตูล </option>
                                                <option value="หนองคาย" {{$data->staff_province == 'หนองคาย' ? 'selected':''}}>หนองคาย </option>
                                                <option value="หนองบัวลำภู" {{$data->staff_province == 'หนองบัวลำภู' ? 'selected':''}}>หนองบัวลำภู </option>
                                                <option value="อำนาจเจริญ" {{$data->staff_province == 'อำนาจเจริญ' ? 'selected':''}}>อำนาจเจริญ </option>
                                                <option value="อุดรธานี" {{$data->staff_province == 'อุดรธานี' ? 'selected':''}}>อุดรธานี </option>
                                                <option value="อุตรดิตถ์" {{$data->staff_province == 'อุตรดิตถ์' ? 'selected':''}}>อุตรดิตถ์ </option>
                                                <option value="อุทัยธานี" {{$data->staff_province == 'อุทัยธานี' ? 'selected':''}}>อุทัยธานี </option>
                                                <option value="อุบลราชธานี" {{$data->staff_province == 'อุบลราชธานี' ? 'selected':''}}>อุบลราชธานี</option>
                                                <option value="อ่างทอง" {{$data->staff_province == 'อ่างทอง' ? 'selected':''}}>อ่างทอง </option>
                                                <option value="อื่นๆ" {{$data->staff_province == 'อื่นๆ' ? 'selected':''}}>อื่นๆ</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_email" class="col-sm-4 col-form-label">
                                            Email
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8"><input type="email" class="form-control"
                                                                     value="{{$data->email}}"
                                                                     @if($detail != 0)
                                                                     readonly="{{$detail}}"
                                                                     required
                                                                     @endif
                                                                     name="email" id="staff_email" placeholder="abc@def.com">

                                            @if ($errors->has('email'))
                                                <span class="help-block" style="color: #ff4d4d">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_phone" class="col-sm-4 col-form-label">
                                            Phone
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8"><input type="number" class="form-control"
                                                                     value="{{$data->staff_phone}}"
                                                                     @if($detail != 0)
                                                                     readonly="{{$detail}}"
                                                                     @endif
                                                                     required
                                                                     name="staff_phone" id="staff_phone" placeholder="012-345-6789">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_status" class="col-sm-4 col-form-label">
                                            Status
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                        </label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="staff_status" id="staff_status"
                                                    @if($detail != 0)
                                                    disabled
                                                    @endif
                                                    required
                                            >
                                                <option value=""></option>
                                                <option value="Working" {{$data->staff_status == 'Working' ? 'selected':''}}>Working</option>
                                                <option value="Fired" {{$data->staff_status == 'Fired' ? 'selected':''}}>Fired</option>
                                                <option value="Resigned" {{$data->staff_status == 'Resigned' ? 'selected':''}}>Resigned</option>
                                                <option value="Retired" {{$data->staff_status == 'Retired' ? 'selected':''}}>Retired</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_preJob" class="col-sm-4 col-form-label">Previous
                                            Job</label>
                                        <div class="col-sm-8"><input type="text" class="form-control"
                                                                     @if($detail != 0)
                                                                     readonly="{{$detail}}"
                                                                     @endif
                                                                     value="{{$data->staff_previous_job}}"
                                                                     name="staff_previous_job" id="staff_previous_job"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_pic" class="col-sm-4 col-form-label">Picture</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control"
                                                   @if($detail != 0)
                                                   readonly="{{$detail}}"
                                                   @endif
                                                   @if(!$data->id)

                                                   @endif
                                                   name="staff_pic" id="staff_pic">

                                            @if($data->id && $data->staff_pic)
                                                <a href="{{asset('/')}}{{$data->staff_pic}}" target="_blank">
                                                    <img src="{{asset('/')}}{{$data->staff_pic}}"   target="_blank" class="img-fluid" style="width: 50%"></a>
                                             @else
                                                <img src="{{ url('/uploads')  }}/images/no_image.png"   target="_blank" class="img-fluid" style="height: 100%;">
                                            @endif

                                            @if ($errors->has('staff_pic'))
                                                <span class="help-block" style="color: #ff4d4d">
                                                            <strong>{{ $errors->first('staff_pic') }}</strong>
                                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group row">
                                        <label for="staff_status" class="col-sm-4 col-form-label">File</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control"
                                                   @if($detail != 0)
                                                   readonly="{{$detail}}"
                                                   @endif
                                                   name="staff_file" id="staff_file">

                                            @if($data->id && $data->staff_file)
                                                <br>
                                                <a href="file/{{$data->staff_file}}" target="_blank">
                                                    View file
                                                </a>
                                                @else
                                                <br>
                                                No file
                                            @endif
                                            @if ($errors->has('staff_file'))
                                                <span class="help-block" style="color: #ff4d4d">
                                                            <strong>{{ $errors->first('staff_file') }}</strong>
                                                        </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staff_role" class="col-sm-2 col-form-label">
                                    Staff role
                                    <span class="help-block" style="color: #ff4d4d">
                                                <strong>*</strong>
                                            </span>
                                    : </label>
                                <div class="col-sm-10 mt-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox"
                                               @if($detail != 0)
                                               disabled
                                               @endif
                                               name="admin" id="checked_admin" value="admin"
                                               required
                                            {{ $data->staff_role == 'admin' || $data->staff_role == 'admin, user' ? 'checked':''}}>
                                        <label class="form-check-label" for="admin">admin</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input"
                                               @if($detail != 0)
                                               disabled
                                               @endif
                                               type="checkbox" name="user" id="checked_user" value="user"
                                               required
                                            {{ $data->staff_role == 'user' ? 'checked':''}}>
                                        <label class="form-check-label" for="user">staff</label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="staff_note">Note: </label>
                                <textarea class="form-control" name="staff_note"
                                          @if($detail != 0)
                                          readonly="{{$detail}}"
                                          @endif
                                          id="staff_note" rows="3"> {{$data->staff_note}}</textarea>
                            </div>


                        </div>

                        <!-- Modal footer -->

                        <div class="modal-footer">
                            @if($detail != 1)
                                <button type="submit" class="btn btn--custom"><i class="fas fa-save"></i>
                                    Save
                                </button>
                            @endif


                        </div>
                    </div>


                </div>
            </div>
        </form> <!-- end action here -->
    </div>
@endsection
@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    staff_birth

    <script>

        $(document).ready(function(){

            $('#checked_admin').on('change', function() {
                $('#checked_user').not(this).prop('checked', false).removeAttr('required');

            });
            $('#checked_user').on('change', function() {
                $('#checked_admin').not(this).prop('checked', false).removeAttr('required');
            });

        });

        $('#staff_birth').datepicker({
            uiLibrary: 'bootstrap4'
        });

        $('input[type="checkbox"]').on('change', function() {
            $('input[type="checkbox"]').not(this).prop('checked', false);
        });

        $('#staff_birth').on('change', function() {
            let  staff_birth = $('#staff_birth').val();

            if(staff_birth!= null){
                var today = new Date();
                var birthDate = new Date(staff_birth);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }

                $('#staff_age').val(age)

            }

        })
    </script>
@endpush

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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

        <!-- icon -->
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
              integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
              crossorigin="anonymous">
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
                <a class="btn btn--custom" href="{{route('guest.index')}}"
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
                            @if(!$detail)
                                @if($data && $data->id)
                                    Edit
                                @else
                                    Add

                                @endif

                            @else
                                Detail
                            @endif
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

        <form class="m-form m-form--fit " enctype="multipart/form-data"
              action="{{ $data->id ? route('guest.update', ['id' => $data->id]) : route('guest.store') }}"
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
                                <label for="guest_name" class="col-sm-4 col-form-label">First
                                    Name
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                </label>
                                <div class="col-sm-8">
                                    <input type="text"
                                           class="form-control"
                                           name="first_name"
                                           value="{{$data->first_name}}"

                                           @if($detail != 0)
                                           readonly="{{$detail?:1}}"
                                           @endif
                                           required

                                           id="first_name"></div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="guest_lastname" class="col-sm-4 col-form-label">Last
                                    Name
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                </label>
                                <div class="col-sm-8"><input type="text"
                                                             class="form-control"
                                                             value="{{$data->last_name}}"
                                                             @if($detail != 0)
                                                             readonly="{{$detail?:1}}"
                                                             @endif
                                                             required
                                                             name="last_name" id="last_name">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="guest_nationalID"
                                       class="col-sm-4 col-form-label">National ID</label>
                                <div class="col-sm-8"><input type="text"
                                                             class="form-control"
                                                             value="{{$data->card_id}}"
                                                             @if($detail != 0)
                                                             readonly="{{$detail?:1}}"
                                                             @endif
                                                             id="card_id" name="card_id">
                                    @if ($errors->has('card_id'))
                                        <span class="help-block" style="color: #ff4d4d">
                                        <strong>The national ID has already been taken.</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="guest_passportID"
                                       class="col-sm-4 col-form-label">Passport ID</label>
                                <div class="col-sm-8"><input type="text"
                                                             class="form-control"
                                                             id="passport_id"
                                                             value="{{$data->passport_id}}"
                                                             @if($detail != 0)
                                                             readonly="{{$detail?:1}}"
                                                             @endif
                                                             name="passport_id">
                                    @if ($errors->has('passport_id'))
                                        <span class="help-block" style="color: #ff4d4d">
                                        <strong>The passport ID has already been taken.</strong>
                                    </span>
                                    @endif</div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="guest_email" class="col-sm-4 col-form-label">
                                    Email
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                </label>
                                <div class="col-sm-8"><input type="email"
                                                             class="form-control" id="email"
                                                             placeholder="abc@def.com"
                                                             value="{{$data->email}}"
                                                             @if($detail != 0)
                                                             readonly="{{$detail?:1}}"
                                                             @endif
                                                             required
                                                             name="email">
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
                                <label for="guest_phone" class="col-sm-4 col-form-label">
                                    Phone
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                </label>
                                <div class="col-sm-8"><input type="text"
                                                             class="form-control" id="phone"
                                                             name="phone"
                                                             value="{{$data->phone}}"
                                                             @if($detail != 0)
                                                             readonly="{{$detail?:1}}"
                                                             @endif
                                                             required
                                                             placeholder="012-345-6789">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group row">
                                <label for="guest_lastname" class="col-sm-4 col-form-label">
                                    Country
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span></label>
                                <div class="col-sm-8">
                                    <select class="form-control" name="country"
                                            @if($detail != 0)
                                            disabled
                                            @endif
                                            id="js-example-basic-hide-search-multi" required>
                                        <option value="">-- Countries --</option>
                                        @foreach(config('country') as $country)
                                            <option {{$data->guest_country == $country ?'selected':''}} value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                        {{--<option {{$data->guest_country == 'Canada' ?'selected':''}} value="Canada">Canada</option>--}}
                                        {{--<option {{$data->guest_country == 'China' ?'selected':''}} value="Thailand">China</option>--}}
                                        {{--<option {{$data->guest_country == 'England' ?'selected':''}} value="England">England</option>--}}
                                        {{--<option {{$data->guest_country == 'Korea' ?'selected':''}} value="Korea">Korea</option>--}}
                                        {{--<option {{$data->guest_country == 'Sweden' ?'selected':''}} value="Sweden">Sweden</option>--}}
                                        {{--<option {{$data->guest_country == 'Thailand' ?'selected':''}} value="Thailand">Thailand</option>--}}
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="guest_address" class="col-sm-4 col-form-label">Address</label>
                                <div class="col-sm-12">
                                                                <textarea rows="2" type="text" class="form-control"
                                                                          id="address" name="address"
                                                                          @if($detail != 0)
                                                                          readonly="{{$detail?:1}}"
                                                                        @endif
                                                                >
                                                                   {{$data->address}}

                                                                </textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="guest_fileType" class="col-sm-4 col-form-label">File
                                    Type
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                </label>
                                <div class="col-sm-8">
                                    <select class="form-control" id="file_type"
                                            @if($detail != 0)
                                            disabled
                                            @endif
                                            name="file_type">
                                        <option value="{{'national_id'}}"
                                                @if($data->file_type === 'national_id') selected @endif>National ID
                                        </option>
                                        <option value="{{'passport_id'}}"
                                                @if($data->file_type === 'passport_id') selected @endif>Passport ID
                                        </option>
                                        <option value="{{'other'}}"
                                                @if($data->file_type === 'other') selected @endif>Other
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group row">
                                <label for="guest_file" class="col-sm-4 col-form-label">Add
                                    File
                                    <span class="help-block" style="color: #ff4d4d">
                                        <strong>*</strong>
                                    </span>
                                </label>
                                <div class="col-sm-8">
                                    @if($detail != 1)
                                        <input type="file" class="form-control-file" id="file"
                                               @if($detail != 0)
                                               readonly="{{$detail?:1}}"
                                               @endif
                                               @if(!$data->file)
                                               @endif
                                               required
                                               name="file">
                                    @endif
                                    @if($data->file)
                                        <a href="{{url($data->file ?: '')}}" target="_blank">View:file</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="guest_note">Note: </label>
                        <textarea class="form-control" id="note" rows="2"
                                  @if($detail != 0)
                                  readonly="{{$detail?:1}}"
                                  @endif
                                  name="note">{{$data->note}}</textarea>
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
@endsection
@push('scripts')
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script>
        $('#js-example-basic-hide-search-multi').select2(
            {
                theme: "bootstrap4",
                placeholder: "-- Countries --",
            }
        );

        $('#staff_birth').datepicker({
            uiLibrary: 'bootstrap4'
        });
    </script>
@endpush

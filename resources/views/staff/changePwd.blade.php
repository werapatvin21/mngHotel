@extends('layouts.admin')
@section('content')
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col-3">
                {{--<a href="/admin/"> ผู้ใช้งาน</a>--}}
            </div>
            <div class="col-4"></div>
            <div class="col-3"></div>
            <div class="col-2">
                <a  class="btn btn--custom" href="{{url('staff/').$data->id}}" id="back"
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
                            Change password
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
              action="{{ isset($data) && $data->id ? route('staff.update_pwd', ['type_id' => $data->id]) : ''}}"
              >
            @csrf
            @if(isset($data) && $data->id)
                @method('PUT')
            @endif
            <div class="m-portlet__body" id="eventTable">
                <div class="container">

                    <div  id="newStaff">
                        <!-- Modal body -->
                        <div class="modal-body">
                            @if(auth()->user()->staff_role != 'admin')
                                <div class="form-group row">
                                    <label for="staff_name" class="col-sm-4 col-form-label">Current Password*</label>
                                    <div class="col-sm-8"><input type="password" class="form-control"
                                                                 name="current_pwd" id="current_pwd" required>
                                        @if(!session()->has('success'))
                                            <span class="help-block" style="color: #ff4d4d">
                                                <strong>{{ session()->get('message') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            <div class="form-group row">
                                <label for="staff_id" class="col-sm-4 col-form-label">New Password*</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control"
                                           name="new_pwd" id="new_pwd" required>
                                    <span class="help-block">
                                        <strong id="diff-pwd"></strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="staff_id" class="col-sm-4 col-form-label">Confirm New Password*</label>
                                <div class="col-sm-8">
                                    <input type="password" class="form-control"
                                           name="confirm_new_pwd" id="confirm_new_pwd" required>
                                    <span class="help-block">
                                        <strong id="message"></strong>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn--custom"><i class="fas fa-save"></i>
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <script type="text/javascript">
       $("#back").on("click", function(){
            window.close();
       });

        $('#new_pwd, #confirm_new_pwd').on('keyup', function () {
                if ($('#new_pwd').val() == $('#confirm_new_pwd').val()) {
                    $('#message').html('Matching').css('color', '#2BC713');
                    $('#save').removeAttr('disabled');
                } else {
                    $('#message').html('Not Matching').css('color', '#ff4d4d');
                    $('#save').attr('disabled', true);
                }
        });

        $('#new_pwd, #confirm_new_pwd').on('keyup', function () {
            if ($('#new_pwd').val() == $('#current_pwd').val() && $('#confirm_new_pwd').val() == $('#current_pwd').val()) {
                $('#diff-pwd').html('รหัสผ่านใหม่ต้องไม่เหมือนรหัสผ่านเก่า').css('color', '#ff4d4d');
                $('#message').html('รหัสผ่านใหม่ต้องไม่เหมือนรหัสผ่านเก่า').css('color', '#ff4d4d');
                $('#save').attr('disabled', true);
            }
        });
    </script>
@endpush


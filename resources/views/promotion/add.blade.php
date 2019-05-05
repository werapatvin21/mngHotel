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

        <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
        <title>HotelCloud - Add New Staff & Schedule Management</title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col-3">
            </div>
            <div class="col-3">
            </div>
            <div class="col-3">
            </div>
            <div class="col-3">
                <a  class="btn btn--custom" href="{{route('promotion.index')}}"
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
                                    Add New

                                @endif

                                @else
                                Detail
                                @endif
                                Promotions
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
                            <label for="promo__name" class="col-sm-4 col-form-label">Name</label>
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
                            <label for="promo_discount" class="col-sm-4 col-form-label">Discount</label>
                            <div class="col-sm-8 my-1">
                                <label class="sr-only" for="inlineFormInputGroupUsername"></label>
                                <div class="input-group">
                                    <input type="number" class="form-control"
                                           @if($detail != 0)
                                           disabled
                                           @endif

                                           required
                                           {{--max="100"--}}
                                           value="{{$data->discount?:0}}"
                                           name="discount" id="promo_discount">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group row">
                            <label for="promo_unit" class="col-sm-4 col-form-label">Unit</label>
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
                            <label for="promo_dateStart" class="col-sm-4 col-form-label">Start</label>
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
                            <label for="promo_dateEnd" class="col-sm-4 col-form-label">End</label>
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
    @endsection
    @push('scripts')
        <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
        <script src="https://unpkg.com/ionicons@4.4.6/dist/ionicons.js"></script>

        <script>

            $('form').submit(function () {
                // Validate here

               let  promo_discount = $('#promo_discount').val();
                let promo_unit  = $('#promo_unit').val()
                if (parseInt(promo_discount) > 100 &&  promo_unit === 'Percentage'){
                    alert('The number of per cent is incorrect.')
                    return false;
                } else{
                    return true;
                }

            });

            var date = new Date();
            date.setDate(date.getDate());

            $('#staff_birth').datepicker({
                uiLibrary: 'bootstrap4',
                format: 'yyyy-mm-dd',
                startDate: date,
            });
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
            $('#editPromo_datepickerStart').datepicker({
                // uiLibrary: 'bootstrap4'
                format: 'yyyy-mm-dd',
                startDate: date,
            });
            $('#editPromo_datepickerEnd').datepicker({
                // uiLibrary: 'bootstrap4'
                format: 'yyyy-mm-dd',
                startDate: date,
            });
        </script>
   @endpush

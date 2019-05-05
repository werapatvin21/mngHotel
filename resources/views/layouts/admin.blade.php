<?php $permission = Auth::user();
$hotels = \App\Models\Hotel::query()->where('id',$permission->hotel_id)->first();

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{$hotels->name}}</title>

    <meta name="description" content="Form action bar examples">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <link href="{{url('theme/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('theme/base/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('assets/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendors -->
    <link href="{{ url('assets/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{url('theme/theme.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Prompt" rel="stylesheet">
    <link href="{{ url('css/fontawesome.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('lib/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('lib/select2/css/select2-bootstrap4.min.css') }}" rel="stylesheet" type="text/css"/>

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-icon-180x180.png') }}">
    {{--<link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicon-96x96.png') }}">--}}
    {{--<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">--}}
    {{--<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">--}}
    {{--<link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">--}}
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">

    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {'families': ['Poppins:300,400,500,600,700', 'Roboto:300,400,500,600,700']},
            active: function () {
                sessionStorage.fonts = true
            }
        })
    </script>
    <style>

        #logout {
            z-index: 10;
            position: absolute;
            bottom: 10px;
            width: 100%;
            display: block;
            padding: 9px 30px;
            color: rgba(255, 255, 255, 0.55);
            cursor: pointer;
            text-decoration: none;
        }

        #logout:hover {
            background: #41448B;
            color: #868aa8;
        }

        #title_box, #title_box_right {
            height: 100%;
            flex-direction: row;
            align-items: center;
            display: flex;
            box-shadow: none;
        }

        #title_box {
            padding-left: 30px;
        }

        @media (max-width: 1024px) {
            #topbar {
                padding: 10px 30px;
                background: #fff;
            }

            #main-content {
                padding-top: 70px;
            }
        }

        #title_box_right {
            justify-content: right;
            padding-right: 30px;
        }

        #back_button {
            margin-right: 10px;
            margin-left: -15px;
        }

        #page_title {
            margin-bottom: 0;
        }

        #m_header {
            z-index: 1000;
        }

        .handler_title {
            color: #0D8890;
            font-size: 24px;
            /*position: absolute;*/
            top: 15px;
            vertical-align: middle;
            margin-left: 55px;
            margin-top: 10px;
        }

        body {
            color: #000000;
            font-family: Sans-Serif;
            padding: 30px;
            background-color: #f6f6f6;
        }

        a {
            text-decoration: none;
            color: #000000;
        }

        /*a:hover {*/
        /*color: #222222*/
        /*}*/

        /* Dropdown */

        .dropdown {
            display: inline-block;
            position: relative;
        }

        .dd-button {
            display: inline-block;
            padding: 10px 30px 10px 20px;
            background-color: #ffffff;
            cursor: pointer;
            white-space: nowrap;
        }

        .dd-button:after {
            content: '';
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid black;
        }

        .dd-button:hover {
            /*background-color: #eeeeee;*/
        }


        .dd-input {
            display: none;
        }

        .dd-menu {
            position: absolute;
            top: 100%;
            border: 1px solid #ccc;
            border-radius: 4px;
            padding: 0;
            margin: 2px 0 0 0;
            box-shadow: 0 0 6px 0 rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            list-style-type: none;
            top: 65px;
        }

        .dd-input + .dd-menu {
            display: none;
        }

        .dd-input:checked + .dd-menu {
            display: block;
        }

        .dd-menu li {
            padding: 10px 20px;
            cursor: pointer;
            white-space: nowrap;
        }

        .dd-menu li:hover {
            background-color: #f6f6f6;
        }

        .dd-menu li a {
            display: block;
            margin: -10px -20px;
            padding: 10px 20px;
        }

        .dd-menu li.divider {
            padding: 0;
            border-bottom: 1px solid #cccccc;
        }

        .triangle {
            top: -16px;
            position: absolute;
            right: 4px;
        }

        .triangle:before, .triangle:after {
            content: '';
            position: absolute;
            right: 0;
            width: 0;
            border-bottom: solid 15px #aaa;
            border-right: solid 15px transparent;
            border-left: solid 15px transparent;
            top: 1px;
        }

        .triangle:after {
            top: 2px;
            border-bottom-color: white;
        }

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
            color: #2F353A;
        }

        .marker {
            top: -0.9em !important;
        }

        .m-checkbox.m-checkbox--brand.m-checkbox--solid > input:checked ~ span {
            background: #CC2A87 !important;
        }

        .dataTables_wrapper .pagination .page-item:hover > .page-link {
            background: #F484AE !important;
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
            background: #DE238E !important;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background-color: #DE238E !important;
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
            background-color: #DE238E !important;
            background: -webkit-linear-gradient(top, #DE238E 0%, #DE238E 100%) !important;
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

        ol.breadcrumb {
            margin-bottom: 0 !important;
            background-color: transparent !important;
        }

        ol.breadcrumb .breadcrumb-item.active {
            color: #269A21 !important;
        }

        li.m-menu__item {
            background-color: #0097A7;
        }

        li.m-menu__item a, li.m-menu__item span, li.m-menu__item i {
            color: #ffffff !important;
        }

        li.m-menu__item.m-menu__item--active {
            background-color: #FF9500 !important;
        }

        .clickable-row {
            cursor: pointer !important;
        }



    </style>
    <link href="{{ asset('assets/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="shortcut icon" href="/assets/demo/default/media/img/logo/favicon.ico"/>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    @stack('stylesheets')
</head>
<body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
<div class="m-grid m-grid--hor m-grid--root m-page">
    <header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-brand  m-brand--skin-dark ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__tools" style="float:  left;padding-top: 15px;">
                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>
                        </div>
                        <a href="{{url('home')}}">
                            <div class="handler_title">
                                {{$hotels->name}}
                               {{--{{env("APP_NAME")?:'HotelCloud'}}--}}
                            </div>
                        </a>
                    </div>
                </div>
                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
                    <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark "
                            id="m_aside_header_menu_mobile_close_btn">
                        <i class="fa fa-cross"></i>
                    </button>
                    <div class="row" style="height: 100%;" id="topbar">
                        <div class="col">
                            <div id="title_box">
                                {{--@if(isset($backUrl))--}}
                                    {{--<a id="back_button" href="{{$backUrl}}" class="btn btn-link"><img--}}
                                                {{--src="{{url('img/arrow-left.png')}}"/></a>--}}
                                {{--@endif--}}
                                {{--@if(isset($pageTitle))--}}
                                    {{--<h3 id="page_title">{{$pageTitle}}</h3>--}}
                                {{--@endif--}}
                            </div>
                        </div>
                        <div class="col-auto" style="   top: 26px;">
                            <div id="bell">
                            </div>
                        </div>
                        <?php $permission = Auth::user() ?>
                        <div style="margin-top: 23px">
                            <span>{{$permission->name}}</span>&nbsp;
                        </div>


                        <div class="col-auto">
                            <div class="arrow-up"></div>
                            <div id="title_box_right" class="btn-sm dropdown btn-group">
                              &nbsp;
                                <a class="dropdown-item card" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                     <center>Log out  <i class="fas fa-sign-out-alt"></i>
                                    </center>
                                </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>

    <!-- END: Header -->

    <!-- begin::Body -->
    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
            <i class="fa fa-window-close"></i>
        </button>


        <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
            {{--<a id="logout" href="{{route('admin.logout')}}" class="m-menu__link text-center">--}}
            {{--<span class="m-menu__link-title">--}}
            {{--<span class="m-menu__link-wrap">--}}
            {{--<span class="m-menu__link-text"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</span>--}}
            {{--</span>--}}
            {{--</span>--}}
            {{--</a>--}}
            @include('layouts.menu')

        </div>

        <div class="m-grid__item m-grid__item--fluid m-wrapper">
            <div class="m-content" id="main-content">
                <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
                    <div class="row">
                        <div class="col">
                            {{--{{ Breadcrumbs::render() }}--}}
                        </div>
                        <div class="col-2">
                            @yield('breadcrumbs')
                        </div>
                    </div>
                </div>

                @yield('content')
            </div>
        </div>
    </div>
</div>
@push('script')

@endpush

@include('layouts.result_alert')
</body>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{asset('theme/base/vendors.bundle.js')}}"></script>
<script src="{{asset('theme/base/scripts.bundle.js')}}"></script>
<script src="{{asset('js/TRLink.js')}}"></script>
<script src="{{asset('assets/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/demo/default/base/scripts.bundle.js')}}" type="text/javascript"></script>
<script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
{{--<script src="{{asset('assets/demo/default/custom/components/datatables/base/data-local.js')}}" type="text/javascript"></script>--}}
{{--<script src="{{ asset('assets/demo/default/custom/components/datatables/base/html-table.js') }}" type="text/javascript"></script>--}}
<script src="{{ asset('assets/vendors/custom/fullcalendar/fullcalendar.bundle.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/app/js/dashboard.js')}}" type="text/javascript"></script>
<script src="{{ asset('lib/select2/js/select2.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('lib/select2/js/i18n/th.js') }}" type="text/javascript"></script>

<script src="{{ asset('js/pusher.min.js') }}"></script>
<script type="application/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    {{--Pusher.logToConsole = true--}}

    {{--$(document).ready(function () {--}}
    {{--$('select.select2').select2({--}}
    {{--theme: 'bootstrap4'--}}
    {{--})--}}

    {{--var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {--}}
    {{--cluster: '{{ env('PUSHER_APP_CLUSTER') }}',--}}
    {{--forceTLS: true--}}
    {{--})--}}

    {{--var channel = pusher.subscribe('my-channel')--}}
    {{--channel.bind('my-event', function (data) {--}}
    {{--alert(JSON.stringify(data))--}}
    {{--})--}}
    {{--})--}}
</script>

<script>
    $(".dropdown-menu li a").click(function(){
        var selText = $(this).text();
        $(this).parents('.btn-group').find('.dropdown-toggle').html('<i class="fas fa-globe"></i> '+selText+' <span class="caret"></span>');
    });
</script>
@stack('scripts')
</html>

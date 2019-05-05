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

        #container {
            min-width: 320px;
            max-width: 600px;
            margin: 0 auto;
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
            </div>
        </div>
    </div>

    <div class="m-portlet m-portlet--full-height m-portlet--tabs">
        <div class="m-portlet__head"  style="margin-top: 20px;">
            <div class="m-portlet__head-tools">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        Report
                    </div>
                </div>
            </div>
        </div>
        {{--<div class="m-portlet__body" id="eventTable">--}}
            {{--<div class="tab-content">--}}
                {{--<div class="tab-pane active" id="m_user_profile_tab_1">--}}

                {{--</div>--}}
                {{--<div class="tab-pane " id="m_user_profile_tab_2"></div>--}}
                {{--<div class="tab-pane " id="m_user_profile_tab_3"></div>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="m-portlet__body" id="eventTable">
                    {{--<div class="m-portlet__body" id="eventTable">--}}
                        {{--<div class="row">--}}
                            {{--<div class="col-3">--}}
                                {{--<div class="row">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="col-6"></div>--}}
                            {{--<div class="col-3">--}}
                                {{--<div class="m-input-icon m-input-icon--left">--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}

                        <div class="tab-content mb-5" id="myTabContent">
                            <div class="container tab-pane fade show active" id="guest-booking" role="tabpanel" aria-labelledby="guest-booking-tab">
                                <div id="reservation"></div>
                                <button id="plain" class="btn btn-info">Plain</button>
                                <button id="inverted"  class="btn btn-warning">Inverted</button>
                                <button id="line-c"  class="btn btn-primary">Change type</button>
                            </div>
                        </div><br>
                    {{--</div>--}}

                        <div class="tab-content mb-5" id="myTabContent1">
                            <div class="container tab-pane fade show active" id="guest-booking" role="tabpanel" aria-labelledby="guest-booking-tab">
                                <div id="service"></div>
                                <button id="plain-serv" class="btn btn-info">Plain</button>
                                <button id="inverted-serv"  class="btn btn-warning">Inverted</button>
                                <button id="line-c-serv"  class="btn btn-primary">Change type</button>
                            </div>
                        </div><br>

                        <div class="tab-content mb-5" id="myTabContent2">
                            <div class="container tab-pane fade show active" id="guest-booking" role="tabpanel" aria-labelledby="guest-booking-tab">
                                <div id="roomtype"></div>
                                <button id="plain-room" class="btn btn-info">Plain</button>
                                <button id="inverted-room"  class="btn btn-warning">Inverted</button>
                                <button id="line-c-room"  class="btn btn-primary">Change type</button>
                            </div>
                        </div><br>

                        <div class="tab-content mb-5" id="myTabContent3">
                            <div class="container tab-pane fade show active" id="guest-booking" role="tabpanel" aria-labelledby="guest-booking-tab">
                                <div id="country"></div>
                                <button id="plain-country" class="btn btn-info">Plain</button>
                                <button id="inverted-country"  class="btn btn-warning">Inverted</button>
                                <button id="line-c-country"  class="btn btn-primary">Change type</button>
                            </div>
                        </div><br>

                        <div class="tab-content mb-5" id="myTabContent4">
                            <div class="container tab-pane fade show active" id="guest-booking" role="tabpanel" aria-labelledby="guest-booking-tab">
                                <div id="frequency"></div>
                                <button id="plain-fre" class="btn btn-info">Plain</button>
                                <button id="inverted-fre"  class="btn btn-warning">Inverted</button>
                                <button id="line-c-fre"  class="btn btn-primary">Change type</button>
                            </div>
                        </div><br>

                        {{--<div class="tab-content mb-5" id="myTabContent4">
                            <div class="container tab-pane fade show active" id="guest-booking" role="tabpanel" aria-labelledby="guest-booking-tab">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="row">
                                            <div class="col-2"><label style="padding-top: 10px;">แสดง</label></div>
                                            <div class="col-4 form-group">    <!--		Show Numbers Of Rows 		-->
                                                <select class="form-control" name="state" id="maxRows" style="width: 75px;"
                                                        onchange="maxpage(this.value);">
                                                    <option value="5">5</option>
                                                    <option value="10">10</option>
                                                    <option value="25">25</option>
                                                    <option value="50">50</option>
                                                </select>
                                            </div>
                                            <div class="col-2"><label style="padding-top: 10px;">รายการ</label></div>
                                        </div>
                                    </div>
                                    <div class="col-3 offset-6">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-success active" onclick='costProfit("month")'>
                                                <input type="radio" name="options" id="option2" autocomplete="off" checked> Month
                                            </label>
                                            <label class="btn btn-success" onclick='costProfit("year")'>
                                                <input type="radio" name="options" id="option3" autocomplete="off"> Year
                                            </label>
                                        </div>

                                    </div>
                                </div>
                                <div id="cost-profit"></div>
                                <button id="plain-cost-profit" class="btn btn-info">Plain</button>
                                <button id="inverted-cost-profit"  class="btn btn-warning">Inverted</button>
                                <button id="line-c-cost-profit"  class="btn btn-primary">Change type</button>
                            </div>
                        </div><br>--}}

                       {{-- <div class="tab-content mb-5" id="myTabContent4">
                            <div class="container tab-pane fade show active" id="guest-booking" role="tabpanel" aria-labelledby="guest-booking-tab">
                                <div class="row">
                                    <div class="col-3 offset-9">
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-success active" onclick='income("day")'>
                                                <input type="radio" name="options" id="option1" autocomplete="off" checked> Day
                                            </label>
                                            <label class="btn btn-success" onclick='income("month")'>
                                                <input type="radio" name="options" id="option2" autocomplete="off"> Month
                                            </label>
                                            <label class="btn btn-success" onclick='income("year")'>
                                                <input type="radio" name="options" id="option3" autocomplete="off"> Year
                                            </label>
                                        </div>

                                    </div>

                                </div>
                                <div id="daily-income"></div>
                                <button id="plain-income" class="btn btn-info">Plain</button>
                                <button id="inverted-income"  class="btn btn-warning">Inverted</button>
                                <button id="line-c-income"  class="btn btn-primary">Change type</button>
                            </div>
                        </div><br>--}}

        </div>


    </div>
        @endsection
        @push('scripts')
            <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
            <script src="https://code.highcharts.com/highcharts.js"></script>
            <script src="https://code.highcharts.com/highcharts-more.js"></script>
            <script src="https://code.highcharts.com/modules/exporting.js"></script>
            <script>
                var data = JSON.parse('{!! json_encode($data) !!}');

                var chart_data = [];
                for (var key in data) {
                    chart_data[key-1] = data[key];
                }

                // console.log(chart_data);

                var chart = Highcharts.chart('reservation', {

                    title: {
                        text: 'Reservation Chart'
                    },

                    subtitle: {
                        text: 'Plain'
                    },

                    xAxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                    },

                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Reservation amount'
                        }
                    },

                    tooltip: {
                        formatter: function() {
                            return this.x + ': ' + this.y ;
                        }
                    },

                    series: [{
                        type: 'column',
                        colorByPoint: true,
                        data: chart_data,
                        showInLegend: false,
                    }]

                });

                var services = JSON.parse('{!! json_encode($services) !!}');
                var service_catagories = [];
                var service_data = [];
                for (var i = 0; i<services.length; i++) {
                    service_catagories[i] = services[i].service_name;
                    service_data[i] = services[i].amount;
                }
                var service = Highcharts.chart('service', {

                    title: {
                        text: 'Service Chart'
                    },

                    subtitle: {
                        text: 'Plain'
                    },

                    xAxis: {
                        categories: service_catagories
                    },

                    yAxis: {
                        title: {
                            text: 'Services amount'
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return this.x + ': ' + this.y ;
                        }
                    },
                    series: [{
                        type: 'column',
                        colorByPoint: true,
                        data: service_data,
                        showInLegend: false,
                    }]

                });

                var rooms = JSON.parse('{!! json_encode($rooms) !!}');
                var room_catagories = [];
                var room_data = [];
                for (var i = 0; i<rooms.length; i++) {
                    room_catagories[i] = rooms[i].name;
                    room_data[i] = rooms[i].amount;
                }
                var room = Highcharts.chart('roomtype', {

                    title: {
                        text: 'Room Types Chart'
                    },

                    subtitle: {
                        text: 'Plain'
                    },

                    xAxis: {
                        categories: room_catagories
                    },

                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Using amount'
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return this.x + ': ' + this.y ;
                        }
                    },
                    series: [{
                        type: 'column',
                        colorByPoint: true,
                        data: room_data,
                        showInLegend: false,
                    }]

                });


                var countries= JSON.parse('{!! json_encode($countries) !!}');
                var country_catagories = [];
                var country_data = [];
                for (var i = 0; i<countries.length; i++) {
                    country_catagories[i] = countries[i].guest_country;
                    country_data[i] = countries[i].amount;
                }
                var country = Highcharts.chart('country', {

                    title: {
                        text: 'Top Countries Chart'
                    },

                    subtitle: {
                        text: 'Plain'
                    },

                    xAxis: {
                        categories: country_catagories
                    },

                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Guests amount'
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return this.x + ': ' + this.y ;
                        }
                    },
                    series: [{
                        type: 'column',
                        colorByPoint: true,
                        data: country_data,
                        showInLegend: false,
                    }]

                });


                var guests = JSON.parse('{!! json_encode($guests) !!}');
                var guest_catagories = [];
                var guest_data = [];
                for (var i = 0; i<guests.length; i++) {
                    guest_catagories[i] = guests[i].guest_name;
                    guest_data[i] = guests[i].amount;
                }
                var guest = Highcharts.chart('frequency', {

                    title: {
                        text: 'Top Guest Chart'
                    },

                    subtitle: {
                        text: 'Plain'
                    },

                    xAxis: {
                        categories: guest_catagories
                    },

                    yAxis: {
                        allowDecimals: false,
                        title: {
                            text: 'Reservation amount'
                        }
                    },
                    tooltip: {
                        formatter: function() {
                            return this.x + ': ' + this.y ;
                        }
                    },
                    series: [{
                        type: 'column',
                        colorByPoint: true,
                        data: guest_data,
                        showInLegend: false,
                    }]

                });


            {{--$(costProfit());--}}
            {{--function costProfit(type) {--}}
                {{--var cost_profits = JSON.parse('{!! json_encode($cost_profit) !!}');--}}
                {{--var cost_profit_cat = [];--}}
                {{--var cost_data = [];--}}
                {{--var profit_data = [];--}}
                {{--if (!type) {--}}
                    {{--for (var i = 0; i<cost_profits.length; i++) {--}}
                        {{--cost_profit_cat[i] = cost_profits[i].service_name;--}}
                        {{--cost_data[i] = cost_profits[i].total_cost;--}}
                        {{--profit_data[i] = cost_profits[i].total_profit;--}}
                    {{--}--}}
                    {{--var cost_profit = Highcharts.chart('cost-profit', {--}}
                        {{--chart: {--}}
                            {{--type: 'column'--}}
                        {{--},--}}
                        {{--title: {--}}
                            {{--text: 'Cost Profit Chart'--}}
                        {{--},--}}
                        {{--subtitle: {--}}
                            {{--text: 'Cost Profit In Hotel'--}}
                        {{--},--}}
                        {{--xAxis: {--}}
                            {{--categories: cost_profit_cat,--}}
                            {{--crosshair: true--}}
                        {{--},--}}
                        {{--yAxis: {--}}
                            {{--min: 0,--}}
                            {{--title: {--}}
                                {{--text: 'value'--}}
                            {{--}--}}
                        {{--},--}}
                        {{--tooltip: {--}}
                            {{--headerFormat: '<span style="font-size:10px">{point.key}</span><table>',--}}
                            {{--pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +--}}
                                {{--'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',--}}
                            {{--footerFormat: '</table>',--}}
                            {{--shared: true,--}}
                            {{--useHTML: true--}}
                        {{--},--}}
                        {{--plotOptions: {--}}
                            {{--column: {--}}
                                {{--pointPadding: 0.2,--}}
                                {{--borderWidth: 0--}}
                            {{--}--}}
                        {{--},--}}
                        {{--series: [{--}}
                            {{--name: 'Cost',--}}
                            {{--data: cost_data--}}

                        {{--}, {--}}
                            {{--name: 'Profit',--}}
                            {{--data: profit_data--}}

                        {{--}]--}}
                    {{--});--}}
                {{--} else {--}}
                    {{--$.ajax({--}}
                        {{--type: 'post',--}}
                        {{--data: {'type': type, "_token": "{{ csrf_token() }}"},--}}
                        {{--url: '{!! route('get_cost_profit_data') !!}',--}}
                        {{--dataType: 'json',--}}
                        {{--success: function (data) {--}}
                            {{--for (var i = 0; i<data.length; i++) {--}}
                                {{--cost_profit_cat[i] = data[i].service_name;--}}
                                {{--cost_data[i] = data[i].total_cost;--}}
                                {{--profit_data[i] = data[i].total_profit;--}}
                            {{--}--}}
                            {{--var cost_profit = Highcharts.chart('cost-profit', {--}}
                                {{--chart: {--}}
                                    {{--type: 'column'--}}
                                {{--},--}}
                                {{--title: {--}}
                                    {{--text: 'Cost Profit Chart'--}}
                                {{--},--}}
                                {{--subtitle: {--}}
                                    {{--text: 'Cost Profit In Hotel'--}}
                                {{--},--}}
                                {{--xAxis: {--}}
                                    {{--categories: cost_profit_cat,--}}
                                    {{--crosshair: true--}}
                                {{--},--}}
                                {{--yAxis: {--}}
                                    {{--min: 0,--}}
                                    {{--title: {--}}
                                        {{--text: 'value'--}}
                                    {{--}--}}
                                {{--},--}}
                                {{--tooltip: {--}}
                                    {{--headerFormat: '<span style="font-size:10px">{point.key}</span><table>',--}}
                                    {{--pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +--}}
                                        {{--'<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',--}}
                                    {{--footerFormat: '</table>',--}}
                                    {{--shared: true,--}}
                                    {{--useHTML: true--}}
                                {{--},--}}
                                {{--plotOptions: {--}}
                                    {{--column: {--}}
                                        {{--pointPadding: 0.2,--}}
                                        {{--borderWidth: 0--}}
                                    {{--}--}}
                                {{--},--}}
                                {{--series: [{--}}
                                    {{--name: 'Cost',--}}
                                    {{--data: cost_data--}}

                                {{--}, {--}}
                                    {{--name: 'Profit',--}}
                                    {{--data: profit_data--}}

                                {{--}]--}}
                            {{--});--}}
                        {{--},--}}
                        {{--error: function (res) {--}}
                            {{--alert('error' + res)--}}
                        {{--}--}}
                    {{--});--}}
                {{--}--}}

            {{--}--}}




                {{--$(income());--}}

                {{--function income(type) {--}}
                    {{--var incomes = JSON.parse('{!! json_encode($incomes_array) !!}');--}}
                    {{--var incomes_categories = [];--}}
                    {{--var incomes_data = [];--}}
                    {{--if (!type) {--}}
                        {{--for (var i = 0; i < incomes.length; i++) {--}}
                            {{--incomes_categories[i] = incomes[i].date;--}}
                            {{--incomes_data[i] = incomes[i].total_income;--}}

                            {{--var income_chart = Highcharts.chart('daily-income', {--}}

                                {{--title: {--}}
                                    {{--text: 'Daily Income Chart'--}}
                                {{--},--}}

                                {{--subtitle: {--}}
                                    {{--text: 'Plain'--}}
                                {{--},--}}

                                {{--xAxis: {--}}
                                    {{--categories: incomes_categories--}}
                                {{--},--}}

                                {{--yAxis: {--}}
                                    {{--title: {--}}
                                        {{--text: 'Income'--}}
                                    {{--}--}}
                                {{--},--}}

                                {{--tooltip: {--}}
                                    {{--formatter: function() {--}}
                                        {{--return this.x + ': ' + this.y ;--}}
                                    {{--}--}}
                                {{--},--}}

                                {{--series: [{--}}
                                    {{--type: 'column',--}}
                                    {{--colorByPoint: true,--}}
                                    {{--data: incomes_data,--}}
                                    {{--showInLegend: false,--}}
                                {{--}]--}}

                            {{--});--}}
                        {{--}--}}
                    {{--} else {--}}
                        {{--$.ajax({--}}
                            {{--type: 'post',--}}
                            {{--data: {'type': type, "_token": "{{ csrf_token() }}"},--}}
                            {{--url: '{!! route('get_income_data') !!}',--}}
                            {{--dataType: 'json',--}}
                            {{--success: function (data) {--}}
                                {{--console.log(data);--}}
                                {{--for (var i = 0; i < data.length; i++) {--}}
                                    {{--incomes_categories[i] = data[i].date;--}}
                                    {{--incomes_data[i] = data[i].total_income;--}}
                                {{--}--}}

                                {{--var income_chart = Highcharts.chart('daily-income', {--}}

                                    {{--title: {--}}
                                        {{--text: 'Daily Income Chart'--}}
                                    {{--},--}}
                                    {{--subtitle: {--}}
                                        {{--text: 'Plain'--}}
                                    {{--},--}}

                                    {{--xAxis: {--}}
                                        {{--categories: incomes_categories--}}
                                    {{--},--}}

                                    {{--yAxis: {--}}
                                        {{--title: {--}}
                                            {{--text: 'Income'--}}
                                        {{--}--}}
                                    {{--},--}}

                                    {{--tooltip: {--}}
                                        {{--formatter: function() {--}}
                                            {{--return this.x + ': ' + this.y ;--}}
                                        {{--}--}}
                                    {{--},--}}

                                    {{--series: [{--}}
                                        {{--type: 'column',--}}
                                        {{--colorByPoint: true,--}}
                                        {{--data: incomes_data,--}}
                                        {{--showInLegend: false,--}}
                                    {{--}]--}}

                                {{--});--}}

                            {{--},--}}
                            {{--error: function (res) {--}}
                                {{--alert('error' + res)--}}
                            {{--}--}}
                        {{--});--}}
                    {{--}--}}

                {{--}--}}


                $(function () {
                    onChangeButton(chart, 'plain', 'inverted', 'polar', 'line-c');
                    onChangeButton(room, 'plain-room', 'inverted-room', 'polar-room', 'line-c-room');
                    onChangeButton(country, 'plain-country', 'inverted-country', 'polar-country', 'line-c-country');
                    onChangeButton(guest, 'plain-fre', 'inverted-fre', 'polar-fre', 'line-c-fre');
                    onChangeButton(service, 'plain-serv', 'inverted-serv', 'polar-serv', 'line-c-serv');
                });

                function onChangeButton(chart, plain, inverted, polar, change_type) {

                    $('#'+plain).click(function () {
                        chart.update({
                            chart: {
                                inverted: false,
                                polar: false
                            },
                            subtitle: {
                                text: 'Plain'
                            }
                        });

                    });

                    $('#'+inverted).click(function () {
                        chart.update({
                            chart: {
                                inverted: true,
                                polar: false
                            },
                            subtitle: {
                                text: 'Inverted'
                            }
                        });

                    });

                    $('#'+polar).click(function () {
                        chart.update({
                            chart: {
                                inverted: false,
                                polar: true,
                            },
                            subtitle: {
                                text: 'Polar'
                            }
                        });
                    });

                    var bool = true;
                    $('#'+change_type).click(function () {
                        chart.update({
                            chart: {
                                inverted: false,
                                polar: false,
                            },
                            subtitle: {
                                text: 'Polar'
                            },
                            series: [{
                                type: bool ? 'line' : 'bar'
                            }]
                        });
                        bool = !bool;
                    });
                }

            </script>
    @endpush

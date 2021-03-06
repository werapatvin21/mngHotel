@extends('layouts.admin')
@section('content')
    <style>
        .table-scroll {
            position:relative;
            max-width:1200px;
            margin:auto;
            overflow:hidden;
            /*border:1px solid #000;*/
        }
        .table-wrap {
            width:100%;
            overflow:auto;
        }
        .table-scroll table {
            width:100%;
            margin:auto;
            border-collapse:separate;
            border-spacing:0;
        }
        .table-scroll th, .table-scroll td {
            padding:5px 10px;
            /*border:1px solid #000;*/
            white-space:nowrap;
            vertical-align:top;
        }
        .clone {
            position:absolute;
            top:0;
            left:0;
            pointer-events:none;
        }
        .clone th, .clone td {
            visibility:hidden
        }
        .clone td, .clone th {
            border-color:transparent
        }
        .clone tbody th {
            visibility:visible;
        }
        .clone .fixed-side {
            /*border:1px solid #000;*/
            visibility:visible;
            background: white;
        }
        .clone thead, .clone tfoot{background:transparent;}

        .td-event {
            cursor: pointer;
        }
    </style>

    <style>
        .table-scroll-week {
            position:relative;
            max-width:1200px;
            margin:auto;
            overflow:hidden;
            /*border:1px solid #000;*/
        }
        .table-wrap-week {
            width:100%;
            overflow:auto;
        }
        .table-scroll-week table {
            width:100%;
            margin:auto;
            border-collapse:separate;
            border-spacing:0;
        }
        .table-scroll-week th, .table-scroll-week td {
            padding:5px 10px;
            /*border:1px solid #000;*/
            white-space:nowrap;
            vertical-align:top;
        }
        .clone-week {
            position:absolute;
            top:0;
            left:0;
            pointer-events:none;
        }
        .clone-week th, .clone-week td {
            visibility:hidden
        }
        .clone-week td, .clone-week th {
            border-color:transparent
        }
        .clone-week tbody th {
            visibility:visible;
        }
        .clone-week .fixed-side {
            /*border:1px solid #000;*/
            visibility:visible;
            background: white;
        }
        .clone-week thead, .clone-week tfoot{background:transparent;}
    </style>

    <style>
        .table-scroll-month {
            position:relative;
            max-width:1200px;
            margin:auto;
            overflow:hidden;
            /*border:1px solid #000;*/
        }
        .table-wrap {
            width:100%;
            overflow:auto;
        }
        .table-scroll-month table {
            width:100%;
            margin:auto;
            border-collapse:separate;
            border-spacing:0;
        }
        .table-scroll-month th, .table-scroll-week td {
            padding:5px 10px;
            /*border:1px solid #000;*/
            white-space:nowrap;
            vertical-align:top;
        }
        .clone-month {
            position:absolute;
            top:0;
            left:0;
            pointer-events:none;
        }
        .clone-month th, .clone-month td {
            visibility:hidden
        }
        .clone-month td, .clone-month th {
            border-color:transparent
        }
        .clone-month tbody th {
            visibility:visible;
        }
        .clone-month .fixed-side {
            /*border:1px solid #000;*/
            visibility:visible;
            background: white;
        }
        .clone-month thead, .clone-month tfoot{background:transparent;}
    </style>

@section('style')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.css"/>
@endsection
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

        <title>HotelCloud - Reservation Management</title>
    </head>
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
<div id="Reservation">
    <div class="m-portlet m-portlet--full-height m-portlet--tabs" id="filter_bar">
        <div class="row" style="margin-top: 20px;">
            <div class="col-3">
                {{--<a href="/admin/"> ผู้ใช้งาน</a>--}}
            </div>
            <div class="col-4"></div>
            <div class="col-3"></div>
            <div class="col-2">
                <a  class="btn-sm btn btn--custom"  href="{{url('reservation/create')}}"
                   style="background-color: #0a6aa1;color:#fff;border-radius: 3px;float: right;"
                   role="button">
                    <i class="fas fa-plus-circle"></i>  New Booking
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
                             Reservation
                         </h3>

                     </div>
                 </div>
             </div>
             <div class="mt-4">
                 <div class="btn-group btn-group-toggle" data-toggle="buttons">
                     <label class="btn btn-warning" onclick='changeTypeShow("week")'>
                         <input type="radio" name="options" id="option1" autocomplete="off"> Previous Week
                     </label>
                     <label class="btn btn-warning active" onclick='changeTypeShow("day")'>
                         <input type="radio" name="options" id="option2" autocomplete="off" checked> Current Week
                     </label>
                     <label class="btn btn-warning" onclick='changeTypeShow("month")'>
                         <input type="radio" name="options" id="option3" autocomplete="off"> Next Week
                     </label>
                 </div>

                 {{--<div class="btn-group btn-group-toggle" data-toggle="buttons">--}}
                     {{--<label class="btn btn-warning" onclick='changeTypeShow("week")'>--}}
                         {{--<input type="radio" name="options" id="option1" autocomplete="off"> Previous Day--}}
                     {{--</label>--}}
                     {{--<label class="btn btn-warning active" onclick='changeTypeShow("day")'>--}}
                         {{--<input type="radio" name="options" id="option2" autocomplete="off" checked> Current Day--}}
                     {{--</label>--}}
                     {{--<label class="btn btn-warning" onclick='changeTypeShow("month")'>--}}
                         {{--<input type="radio" name="options" id="option3" autocomplete="off"> Next Day--}}
                     {{--</label>--}}
                 {{--</div>--}}

                 {{--<div class="btn-group btn-group-toggle" data-toggle="buttons">--}}
                     {{--<label class="btn btn-warning" onclick='changeTypeShow("week")'>--}}
                         {{--<input type="radio" name="options" id="option1" autocomplete="off"> Previous Month--}}
                     {{--</label>--}}
                     {{--<label class="btn btn-warning active" onclick='changeTypeShow("day")'>--}}
                         {{--<input type="radio" name="options" id="option2" autocomplete="off" checked> Current Month--}}
                     {{--</label>--}}
                     {{--<label class="btn btn-warning" onclick='changeTypeShow("month")'>--}}
                         {{--<input type="radio" name="options" id="option3" autocomplete="off"> Next Month--}}
                     {{--</label>--}}
                 {{--</div>--}}


                 <div class="btn-group btn-group-toggle" data-toggle="buttons">
                     <label class="btn btn-success active" onclick='changeTypeShow("week")'>
                         <input type="radio" name="options" id="option1" autocomplete="off" checked> Week
                     </label>
                     <label class="btn btn-success" onclick='changeTypeShow("day")'>
                         <input type="radio" name="options" id="option2" autocomplete="off"> Day
                     </label>
                     <label class="btn btn-success" onclick='changeTypeShow("month")'>
                         <input type="radio" name="options" id="option3" autocomplete="off"> Month
                     </label>
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

             <div class="table-responsive" id="week">
                 <div id="table-scroll-week" class="table-scroll-week">
                     <div class="table-wrap-week">
                         @if($week_max_day)
                             <table class="table table-sm table-bordered main-table-week">
                                 <thead>
                                 <tr>
                                     <th class="fixed-side align-middle" scope="col">Week All Rooms&nbsp;</th>
                                     <?php
                                     //                                    date_default_timezone_set('Asia/Bangkok');
                                     $date = date('d-m-Y');
                                     $before_current_date = date('d-m-Y');
                                     $before_current_date_array = [];
                                     $first_date = date('01-m-Y');
                                     $first_day = date('l', strtotime($first_date));
                                     $dayOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']
                                     ?>
                                     @for($i=0;$i<count($dayOfWeek);$i++)
                                         @if($dayOfWeek[$i] == date('l', strtotime(date('Y-m-d'))))
                                             @for($j=$i;$j>0;$j--)
                                                 {{--<th>{{ $dayOfWeek[$i-$j] }}</th>--}}
                                                 @if($j<=$i)
                                                     <?php
                                                        $before_current_date = date('d-m-Y', strtotime("-1 day", strtotime($before_current_date)));
                                                        $before_current_date_array[$j] = $before_current_date;
                                                     ?>
                                                 @endif
                                             @endfor

                                             @for($j=$i;$j>0;$j--)
                                                 <th><p>{{ $before_current_date_array[$i+1-$j] }}</p><p>{{ $dayOfWeek[$i-$j] }}</p></th>
                                             @endfor

                                             @for($j=$i;$j<count($dayOfWeek);$j++)
                                                 @if($j==$i)
                                                     <th><p>{{ date('d-m-Y') }}</p><p>{{$dayOfWeek[$j] }}</p></th>
                                                     <?php $date = date('d-m-Y', strtotime("+1 day", strtotime($date))); ?>
                                                 @else
                                                     <th><p>{{ $date }}</p><p>{{$dayOfWeek[$j] }}</th>
                                                     <?php $date = date('d-m-Y', strtotime("+1 day", strtotime($date))); ?>
                                                 @endif
                                             @endfor
                                         @endif


                                     @endfor
                                     {{--@while(strtotime($date) <= strtotime($week_max_day))--}}
                                         {{--<th scope="col">{{$date}}</th>--}}
<!--                                         --><?php //$date = date('d-m-Y', strtotime("+1 day", strtotime($date))); ?>
                                     {{--@endwhile--}}
                                 </tr>
                                 </thead>
                                 <tbody>
                                 <?php $room_id = []; ?>
                                 @foreach($reservations_week as $key => $data)
                                     <?php
                                     //                                    date_default_timezone_set('Asia/Bangkok');
                                     $date_tr = date('d-m-Y');
                                     $date_td = date('d-m-Y');
                                     $date_tr_current = date('d-m-Y');
                                     $date_td_current = date('d-m-Y');
                                     $before_current_date_array1 = [];
                                     $before_current_date_array2 = [];
                                     $night = 0;
                                     ?>

                                     @if(!in_array($data->room_id, $room_id))
                                         <?php array_push($room_id, $data->room_id);?>
                                         <tr id="{{ $data->room_id.'week' }}">
                                             <th class="fixed-side">{{ $data->room_name }}</th>
                                             {{--@while(strtotime($date_td) < strtotime($week_max_day))--}}
                                                 {{--@if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_td) && $night < $remain_night_week[$key])--}}
                                                     {{--<td id="{{ $date_td }}"--}}
                                                         {{--style="background: {{ isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' }}; color: #ffffff;">--}}
                                                         {{--<div class="td-event">--}}
                                                             {{--<input type="hidden" value="{{ $data->id }}"/>--}}
                                                             {{--{{ $data->guest_name }}--}}
                                                         {{--</div>--}}
                                                     {{--</td>--}}
<!--                                                     --><?php //$night++; ?>
                                                 {{--@else--}}
                                                     {{--<td id="{{ $date_td }}"></td>--}}
                                                 {{--@endif--}}
<!--                                                 --><?php //$date_td = date('Y-m-d', strtotime("+1 day", strtotime($date_td))); ?>
                                             {{--@endwhile--}}

                                             @for($i=0;$i<count($dayOfWeek);$i++)
                                                 @if($dayOfWeek[$i] == date('l', strtotime(date('Y-m-d'))))
                                                     @for($j=$i;$j>0;$j--)
                                                         {{--<th>{{ $dayOfWeek[$i-$j] }}</th>--}}
                                                         @if($j<=$i)
                                                             <?php
                                                             $date_td = date('d-m-Y', strtotime("-1 day", strtotime($date_td)));
                                                             $before_current_date_array1[$j] = $date_td;
                                                             ?>
                                                         @endif
                                                     @endfor

                                                     @for($j=$i;$j>0;$j--)
                                                             @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($before_current_date_array1[$i+1-$j]) && $night < $remain_night_week[$key])
                                                                 <td id="{{ $before_current_date_array1[$i+1-$j] }}"
                                                                     style="background: {{ isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' }}; color: #ffffff;">
                                                                     <div class="td-event">
                                                                         <input type="hidden" value="{{ $data->id }}"/>
                                                                         {{ $data->guest_name }}
                                                                     </div>
                                                                 </td>
                                                                 <?php $night++; ?>
                                                             @else
                                                                 <td id="{{ $before_current_date_array1[$i+1-$j] }}"></td>
                                                             @endif
                                                     @endfor

                                                     @for($j=$i;$j<count($dayOfWeek);$j++)
                                                         @if($j==$i)
                                                                 @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_td_current) && $night < $remain_night_week[$key])
                                                                     <td id="{{ $date_td_current }}"
                                                                         style="background: {{ isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' }}; color: #ffffff;">
                                                                         <div class="td-event">
                                                                             <input type="hidden" value="{{ $data->id }}"/>
                                                                             {{ $data->guest_name }}
                                                                         </div>
                                                                     </td>
                                                                     <?php $night++; ?>
                                                                 @else
                                                                     <td id="{{ $date_td_current }}"></td>
                                                                 @endif
                                                             <?php $date_td_current = date('d-m-Y', strtotime("+1 day", strtotime($date_td_current))); ?>
                                                         @else
                                                             @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_td_current) && $night < $remain_night_week[$key])
                                                                 <td id="{{ $date_td_current }}"
                                                                 style="background: {{ isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' }}; color: #ffffff;">
                                                                     <div class="td-event">
                                                                     <input type="hidden" value="{{ $data->id }}"/>
                                                                     {{ $data->guest_name }}
                                                                     </div>
                                                                 </td>
                                                                 <?php $night++; ?>
                                                             @else
                                                                 <td id="{{ $date_td_current }}"></td>
                                                             @endif
                                                             <?php $date_td_current = date('d-m-Y', strtotime("+1 day", strtotime($date_td_current))); ?>
                                                         @endif
                                                     @endfor
                                                 @endif


                                             @endfor
                                         </tr>
                                     @else
                                         {{--@while(strtotime($date_tr) < strtotime($week_max_day))--}}
                                             {{--@if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_tr) && $night < $remain_night_week[$key])--}}
                                                 {{--@push('scripts')--}}
                                                     {{--<script>--}}
                                                         {{--$(document).ready(function () {--}}
                                                             {{--$('#{!! $data->room_id.'week' !!} > #{!! $date_tr !!}').append(`--}}

                                                                {{--<div class="td-event">--}}
                                                                    {{--<input type="hidden" value="{{ $data->id }}"/>--}}
                                                                    {{--{{ $data->guest_name }}--}}
                                                                 {{--</div>--}}

{{--`);--}}
                                                             {{--$('#{!! $data->room_id.'week'!!} > #{!! $date_tr !!}').css({--}}
                                                                 {{--background: 'yellow',--}}
                                                                 {{--color: '#ffffff'--}}
                                                             {{--});--}}
                                                         {{--});--}}
                                                     {{--</script>--}}
                                                 {{--@endpush--}}
<!--                                                   --><?php //$night++; ?>
                                             {{--@endif--}}
<!--                                             --><?php //$date_tr = date('Y-m-d', strtotime("+1 day", strtotime($date_tr))); ?>
                                         {{--@endwhile--}}

                                         @for($i=0;$i<count($dayOfWeek);$i++)
                                             @if($dayOfWeek[$i] == date('l', strtotime(date('Y-m-d'))))
                                                 @for($j=$i;$j>0;$j--)
                                                     {{--<th>{{ $dayOfWeek[$i-$j] }}</th>--}}
                                                     @if($j<=$i)
                                                         <?php
                                                         $date_tr = date('d-m-Y', strtotime("-1 day", strtotime($date_tr)));
                                                         $before_current_date_array2[$j] = $date_tr;
                                                         ?>
                                                     @endif
                                                 @endfor

                                                 @for($j=$i;$j>0;$j--)
                                                     @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($before_current_date_array2[$i+1-$j]) && $night < $remain_night_week[$key])
                                                     @push('scripts')
                                                     <script>
                                                         $(document).ready(function () {
                                                         $('#{!! $data->room_id.'week' !!} > #{!! $before_current_date_array2[$i+1-$j] !!}').append(`

                                                                                 <div class="td-event">
                                                                                     <input type="hidden" value="{{ $data->id }}"/>
                                                                                     {{ $data->guest_name }}
                                                                                 </div>

                                                          `);
                                                         var color = '{!! isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' !!}';
                                                         $('#{!! $data->room_id.'week'!!} > #{!! $before_current_date_array2[$i+1-$j] !!}').css({
                                                                                 background: color,
                                                                                 color: '#ffffff'
                                                                                 });
                                                         });
                                                     </script>
                                                     @endpush
                                                     <?php $night++; ?>
                                                     @endif
                                                 @endfor

                                                 @for($j=$i;$j<count($dayOfWeek);$j++)
                                                     @if($j==$i)
                                                         @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_tr_current) && $night < $remain_night_week[$key])
                                                             @push('scripts')
                                                                 <script>
                                                                     $(document).ready(function () {
                                                                         $('#{!! $data->room_id.'week' !!} > #{!! $date_tr_current !!}').append(`

                                                                                 <div class="td-event">
                                                                                     <input type="hidden" value="{{ $data->id }}"/>
                                                                                     {{ $data->guest_name }}
                                                                             </div>

`);
                                                                         var color = '{!! isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' !!}';
                                                                         $('#{!! $data->room_id.'week'!!} > #{!! $date_tr_current !!}').css({
                                                                             background: color,
                                                                             color: '#ffffff'
                                                                         });
                                                                     });
                                                                 </script>
                                                             @endpush
                                                             <?php $night++; ?>
                                                         @endif
                                                         <?php $date_tr_current = date('d-m-Y', strtotime("+1 day", strtotime($date_tr_current))); ?>
                                                     @else
                                                         @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_tr_current) && $night < $remain_night_week[$key])
                                                             @push('scripts')
                                                                 <script>
                                                                     $(document).ready(function () {
                                                                         $('#{!! $data->room_id.'week' !!} > #{!! $date_tr_current !!}').append(`

                                                                                 <div class="td-event">
                                                                                     <input type="hidden" value="{{ $data->id }}"/>
                                                                                     {{ $data->guest_name }}
                                                                             </div>

`);
                                                                         var color = '{!! isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' !!}';
                                                                         $('#{!! $data->room_id.'week'!!} > #{!! $date_tr_current !!}').css({
                                                                             background: color,
                                                                             color: '#ffffff'
                                                                         });
                                                                     });
                                                                 </script>
                                                             @endpush
                                                             <?php $night++; ?>
                                                         @endif
                                                         <?php $date_tr_current = date('d-m-Y', strtotime("+1 day", strtotime($date_tr_current))); ?>
                                                     @endif
                                                 @endfor
                                             @endif
                                         @endfor
                                     @endif
                                 @endforeach
                                 </tbody>
                             </table>
                         @else
                             <center>No data available in room</center>
                         @endif

                     </div>
                 </div>
             </div>



             <div class="table-responsive" id="day">
                 <div id="table-scroll" class="table-scroll scroll-day">
                     <div class="table-wrap">
                         @if($max_check_in)
                             <table class="table table-sm table-bordered main-table day">
                                 <thead>
                                 <tr>
                                     <th class="fixed-side" scope="col" width="20%">Day All Rooms&nbsp;</th>
                                     <?php
                                     //                                    date_default_timezone_set('Asia/Bangkok');
                                     $date = date('d-m-Y');
                                     ?>
{{--                                     @while(strtotime($date) <= $max_check_in)--}}
                                         <th scope="col" class="text-center">{{$date}}</th>
<!--                                         --><?php //$date = date('d-m-Y', strtotime("+1 day", strtotime($date))); ?>
                                     {{--@endwhile--}}
                                 </tr>
                                 </thead>
                                 <tbody>
                                 <?php $room_id = []; ?>
                                 @foreach($reservations as $key => $data)
                                     <?php
                                     //                                    date_default_timezone_set('Asia/Bangkok');
                                     $date_tr = date('Y-m-d');
                                     $date_td = date('Y-m-d');
                                     $night = 0;
                                     ?>

                                     @if(!in_array($data->room_id, $room_id))
                                         <?php array_push($room_id, $data->room_id);?>
                                         <tr id="{{ $data->room_id.'day' }}">
                                             <th class="fixed-side">{{ $data->room_name }}</th>
                                             {{--@while(strtotime($date_td) < $max_check_in)--}}
                                                 @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_td) && $night < $remain_night[$key])
                                                     <td class="text-center" id="{{ $date_td }}"
                                                         style="background: {{ isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' }}; color: #ffffff;">
                                                         <div class="td-event">
                                                             <input type="hidden" value="{{ $data->id }}"/>
                                                             {{ $data->guest_name }}
                                                         </div>
                                                     </td>
                                                     <?php $night++; ?>
                                                 @else
                                                     <td class="text-center" id="{{ $date_td }}"></td>
                                                 @endif
<!--                                                 --><?php //$date_td = date('Y-m-d', strtotime("+1 day", strtotime($date_td))); ?>
                                             {{--@endwhile--}}
                                         </tr>
                                     @else
                                         {{--@while(strtotime($date_tr) < $max_check_in)--}}
                                             @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_tr) && $night < $remain_night[$key])
                                                 @push('scripts')
                                                     <script>
                                                         $(document).ready(function () {
                                                             $('#{!! $data->room_id.'day' !!} > #{!! $date_tr !!}').append(`

                                                                <div class="td-event">
                                                                    <input type="hidden" value="{{ $data->id }}"/>
                                                                    {{ $data->guest_name }}
                                                                 </div>

`);
                                                             var color = '{!! isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' !!}';
                                                             $('#{!! $data->room_id.'day' !!} > #{!! $date_tr !!}').css({
                                                                 background: color,
                                                                 color: '#ffffff'
                                                             });
                                                         });
                                                     </script>
                                                 @endpush
                                                 <?php $night++; ?>
                                             @endif
<!--                                             --><?php //$date_tr = date('Y-m-d', strtotime("+1 day", strtotime($date_tr))); ?>
                                         {{--@endwhile--}}
                                     @endif
                                 @endforeach
                                 </tbody>
                             </table>
                         @else
                             <center>No data available in room</center>
                         @endif

                     </div>
                 </div>
             </div>


             <div class="table-responsive" id="month">
                 <div id="table-scroll-month" class="table-scroll-month">
                     <div class="table-wrap">
                         @if($month_max_day)
                             <table class="table table-sm table-bordered main-table-month">
                                 <thead>
                                 <tr>
                                     <th class="fixed-side" scope="col">Month All Rooms&nbsp;</th>
                                     <?php
                                     //                                    date_default_timezone_set('Asia/Bangkok');
                                     $date = date('01-m-Y');
                                     ?>
                                     @while(strtotime($date) <= strtotime(date('t-m-Y')))
                                         <th scope="col">{{$date}}</th>
                                         <?php $date = date('d-m-Y', strtotime("+1 day", strtotime($date))); ?>
                                     @endwhile
                                 </tr>
                                 </thead>
                                 <tbody>
                                 <?php $room_id = []; ?>
                                 @foreach($reservations_month as $key => $data)
                                     <?php
                                     //                                    date_default_timezone_set('Asia/Bangkok');
                                     $date_tr = date('Y-m-01');
                                     $date_td = date('Y-m-01');
                                     $night = 0;
                                     ?>

                                     @if(!in_array($data->room_id, $room_id))
                                         <?php array_push($room_id, $data->room_id);?>
                                         <tr id="{{ $data->room_id.'month' }}">
                                             <th class="fixed-side">{{ $data->room_name }}</th>
                                             @while(strtotime($date_td) < strtotime($month_max_day))
                                                 @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_td) && $night < $remain_night_month[$key])
                                                     <td id="{{ $date_td }}"
                                                         style="background: {{ isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' }}; color: #ffffff;">
                                                         <div class="td-event">
                                                             <input type="hidden" value="{{ $data->id }}"/>
                                                             {{ $data->guest_name }}
                                                         </div>
                                                     </td>
                                                     <?php $night++; ?>
                                                 @else
                                                     <td id="{{ $date_td }}"></td>
                                                 @endif
                                                 <?php $date_td = date('Y-m-d', strtotime("+1 day", strtotime($date_td))); ?>
                                             @endwhile
                                         </tr>
                                     @else
                                         @while(strtotime($date_tr) < strtotime($month_max_day))
                                             @if(strtotime('-1 day',strtotime($data->check_in)) < strtotime($date_tr) && $night < $remain_night_month[$key])
                                                 @push('scripts')
                                                     <script>
                                                         $(document).ready(function () {
                                                             $('#{!! $data->room_id.'month' !!} > #{!! $date_tr !!}').append(`

                                                                <div class="td-event">
                                                                    <input type="hidden" value="{{ $data->id }}"/>
                                                                    {{ $data->guest_name }}
                                                                 </div>

`);
                                                             var color = '{!! isset($data->check_in) ? (isset($data->check_out) ? 'black' : 'green') : 'yellow' !!}';
                                                             $('#{!! $data->room_id.'month' !!} > #{!! $date_tr !!}').css({
                                                                 background: color,
                                                                 color: '#ffffff'
                                                             });
                                                         });
                                                     </script>
                                                 @endpush
                                                 <?php $night++; ?>
                                             @endif
                                             <?php $date_tr = date('Y-m-d', strtotime("+1 day", strtotime($date_tr))); ?>
                                         @endwhile
                                     @endif
                                 @endforeach
                                 </tbody>
                             </table>
                         @else
                             <center>No data available in room</center>
                         @endif

                     </div>
                 </div>
             </div>

         </div>
     </div>
     <div class="card-event" style="display: none;
                                padding: 7px;
                                width: 300px;
                                position:absolute;
                                z-index: 99999;">

     </div>
</div>

@endsection
@push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.7/fullcalendar.min.js"></script>
            <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

            {{--{!! $calendar->script() !!}--}}
            {{--<script>--}}
                {{--$('#check_in').datepicker({--}}
                    {{--uiLibrary: 'bootstrap4'--}}
                {{--});--}}
                {{--$('#check_in_room').datepicker({--}}
                    {{--uiLibrary: 'bootstrap4'--}}
                {{--});--}}
                {{--$('#check_out').datepicker({--}}
                    {{--uiLibrary: 'bootstrap4'--}}
                {{--});--}}
            {{--</script>--}}

            <script>
                $(document).click(function(e) {
                    $('.card-event').hide();
                });

                function changeTypeShow(type) {
                    if (type === "week") {
                        $("#day, #month").hide();
                        $("#week").show();
                    }
                    if (type === "day") {
                        $("#week, #month").hide();
                        $("#day").show();
                    }
                    if (type === "month") {
                        $("#day, #week").hide();
                        $("#month").show();
                    }
                }

                $(document).ready(function () {
                    $("#day, #month").hide();
                    $('.td-event').click(function (e) {
                        var token = '{!! csrf_token() !!}';
                        var id = e.target.children[0].defaultValue;
                        var url = '{!! route("reservation.get_reserve") !!}?id='+id+'&_token='+token;

                        if (id) {
                            setTimeout(function () {
                                $.getJSON(url, function (res) {
                                    var content = `
                                    <div class="card">
                                        <div class="card-body">

                                            <p><label style="color: #043ca1;">Room Name :</label>  <b>${res[0].room_name}</b></p>
                                            <p><label style="color: #043ca1;">Guest Name :</label>  <b>${res[0].first_name}</b></p>
                                            <p><label style="color: #043ca1;">Check In :</label>  <b>${res[0].check_in}</b></p>

                                            <p><label style="color: #043ca1;">Total Night :</label>  <b>${res[0].total_night}</b></p>
                                             <p><label style="color: #043ca1;">Total price:</label> <b>${res[0].total_price}</b></p>
                                            `;
                                    if(!res[0].check_out) {
                                        content += `<a class="btn btn-sm btn-warning" href="/reservation/${res[0].id}?detail=0">
                                                Edit<ion-icon name="create" data-toggle="modal" data-target="#editStaffEvent"></ion-icon>
                                            </a>&nbsp;`;
                                    }
                                    if(!res[0].check_in && !res[0].check_out) {
                                        content += `<a class="btn btn-sm btn-success" href="/check_out_reservation/${res[0].id}?detail=0">
                                                Check In <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            </a>`;
                                    }

                                    if(res[0].check_in && !res[0].check_out) {
                                        content += `<a class="btn btn-sm btn-danger" href="/check_out_reservation/${res[0].id}?detail=0">
                                                Check out <i class="fa fa-sign-out" aria-hidden="true"></i>
                                            </a>`
                                    }
                                    content += `</div></div>`;
                                    $('.card-event').empty().append(content);
                                    // <p><label style="color: #043ca1;">Reservation ID :</label> <b>${res[0].id}</b></p>
                                    // <p><label style="color: #043ca1;">Check Out Before :</label>  <b>${res[1]}</b></p>

                                    $('.card-event').show();
                                    $('.card-event').css({
                                        left: (e.pageX - 250) + "px",
                                        top: (e.pageY -300) + "px",

                                    });
                                });
                            }, 500);
                        }
                    });

                    $('.td-event').click(function () {
                        $('.card-event').hide();
                        $('.card-event').click(function () {
                            $('.card-event').show();
                        }).click(function () {
                            $('.card-event').hide();
                        });
                    });
                });
            </script>
            <script>
                // requires jquery library
                jQuery(document).ready(function() {
                    jQuery(".main-table").clone(true).appendTo('#table-scroll').addClass('clone');
                });

                jQuery(document).ready(function() {
                    jQuery(".main-table-week").clone(true).appendTo('#table-scroll-week').addClass('clone-week');
                });

                jQuery(document).ready(function() {
                    jQuery(".main-table-month").clone(true).appendTo('#table-scroll-month').addClass('clone-month');
                });
            </script>



@endpush

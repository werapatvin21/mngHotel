<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Guest;
use App\Models\Reservation;
use App\Models\ReservationService;
use App\Models\Room;
use App\Models\Services;
use App\User;
use Carbon\Carbon;
use Colors\RandomColor;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use phpDocumentor\Reflection\Types\Integer;

class ReservationController extends Controller
{
    public function index()
    {

        $query = Reservation::query()
            ->select('reservations.id as id',
                'reservations.check_in as check_in',
                'reservations.check_out as check_out',
                'rooms.id as room_id',
                'rooms.name as room_name',
                'reservations.id_guest as guest_id',
                'guests.first_name as guest_name',
                'guests.last_name as last_name',
                'reservations.total_night as total_night')
//            ->whereNull('reservations.check_out')
            ->leftJoin('rooms', 'rooms.id', '=', 'reservations.room_id')
            ->leftJoin('guests', 'guests.id', '=', 'reservations.id_guest')
            ->where('reservations.hotel_id',Auth::user()->hotel_id)
            ->orderBy('rooms.name')
        ;

//        dd(date('l', strtotime('2019-05-01')));
        $query1 = Reservation::query()
            ->select('reservations.id as id',
                'reservations.check_in as check_in',
                'reservations.check_out as check_out',
                'rooms.id as room_id',
                'rooms.name as room_name',
                'reservations.id_guest as guest_id',
                'guests.first_name as guest_name',
                'guests.last_name as last_name',
                'reservations.total_night as total_night')
//            ->whereNull('reservations.check_out')
            ->leftJoin('rooms', 'rooms.id', '=', 'reservations.room_id')
            ->leftJoin('guests', 'guests.id', '=', 'reservations.id_guest')
            ->where('reservations.hotel_id',Auth::user()->hotel_id)
            ->orderBy('rooms.name')
        ;

        $query2 = Reservation::query()
            ->select('reservations.id as id',
                'reservations.check_in as check_in',
                'reservations.check_out as check_out',
                'rooms.id as room_id',
                'rooms.name as room_name',
                'reservations.id_guest as guest_id',
                'guests.first_name as guest_name',
                'guests.last_name as last_name',
                'reservations.total_night as total_night')
//            ->whereNull('reservations.check_out')
            ->leftJoin('rooms', 'rooms.id', '=', 'reservations.room_id')
            ->leftJoin('guests', 'guests.id', '=', 'reservations.id_guest')
            ->where('reservations.hotel_id',Auth::user()->hotel_id)
            ->orderBy('rooms.name')
        ;

        $date = new \DateTime(date('Y-m-d'));
        $date->modify('last day of this month');

//        if( Auth::user()->staff_role === 'user'){
//            $query->whereBetween('reservations.check_in',[date('Y-m-d'.' 00:00:00'),$date->format('Y-m-d').' 23:59:59']);
//        }

        $reservations = $query->get();
        $max_check_in = $query->orderByDesc('reservations.check_in')->first();
        if($max_check_in){
            $nights = $max_check_in->total_night;
            $max_check_in = strtotime("+".$nights." day", strtotime($max_check_in->check_in));
        }
//dd($max_check_in);
//        dd($reservations);

        $month_max_day = date('Y-m-d H:i:s', strtotime('+29 day +12 hour', strtotime(date('Y-m-d'))));
        $month = date('m');
        $reservations_month = $query1->whereMonth('reservations.check_in', $month)->get();
//        dd($reservations_month);

        $week_max_day = date('Y-m-d H:i:s', strtotime('+6 day +12 hour', strtotime(date('Y-m-d'))));
        $reservations_week = $query2->whereDate('reservations.check_in', '<', $week_max_day)->get();
//        dd($reservations_week);

        $colors = [];
//        dd(RandomColor::one());
        foreach ($reservations as $key => $reserv) {
            array_push($colors, RandomColor::one());
        }


        $remain_night = [];
        foreach ($reservations as $key => $reserv) {
            if (strtotime($reserv->check_in) < strtotime(date('Y-m-d'))) {
                $earlier = new DateTime(date('Y-m-d'));
                $later = new DateTime($reserv->check_in);
                $remain = $later->diff($earlier)->format('%a');
                array_push($remain_night, $reserv->total_night - $remain);
            } else {
                array_push($remain_night, $reserv->total_night);
            }
        }

        $remain_night_week = [];
        foreach ($reservations_week as $key => $reserv) {
            if (strtotime($reserv->check_in) < strtotime(date('Y-m-d'))) {
                $earlier = new DateTime(date('Y-m-d'));
                $later = new DateTime($reserv->check_in);
                $remain = $later->diff($earlier)->format('%a');
                array_push($remain_night_week, $reserv->total_night - $remain);
            } else {
                array_push($remain_night_week, $reserv->total_night);
            }
        }

        $remain_night_month = [];
        foreach ($reservations_month as $key => $reserv) {
            if (strtotime($reserv->check_in) < strtotime(date('Y-m-d'))) {
                $earlier = new DateTime(date('Y-m-d'));
                $later = new DateTime($reserv->check_in);
                $remain = $later->diff($earlier)->format('%a');
                array_push($remain_night_month, $reserv->total_night - $remain);
            } else {
                array_push($remain_night_month, $reserv->total_night);
            }
        }


//        dd($colors);
//        $events = [];
//        if($reservations->count()) {
//            foreach ($reservations as $key => $value) {
//                $events[] = Calendar::event(
//                    $value->name,
//                    true,
//                    new \DateTime($value->check_in),
//                    new \DateTime($value->check_in.' +'.$value->total_night.'day'),
//                    null,
//                    // Add color and link on event
//                    [
//                        'color' => '#f05050',
//                        'url' => route('reservation.show',[$value->id]),
//                    ]
//                );
//            }
//        }
//        $calendar = Calendar::addEvents($events);

//        $rooms = Room::query()->orderByDesc('name')->get();
//        $guests = Guest::query()->orderByDesc('first_name')->get();
        return view('reservation/list',compact('reservations', 'max_check_in', 'colors', 'nights',
                                                            'remain_night', 'reservations_week', 'reservations_month',
                                                            'remain_night_week', 'remain_night_month',
                                                            'week_max_day', 'month_max_day'));
    }

    public function splitWeek($current_month) {
        $month=$current_month;//pass here your month
        $return_value = "";
        $first_date = date("Y-m-1");
        do{
            $last_date = date("Y-m-d",strtotime($first_date. " +6 days"));
            $month = date("m",strtotime($last_date));
            if($month!=$current_month)
//                $last_date = date("Y-m-t");
//            echo "<br>".$first_date." - ".$last_date;
            $return_value .= "<br>".$first_date." - ".$last_date."<br>";
            $first_date = date("Y-m-d",strtotime($last_date. " +1 days"));
        }while($month == $current_month);
        return $return_value;
    }

    public function getReservation(Request $request) {
//        $room_id = $request->get('room_id');
//        $guest_id = $request->get('guest_id');
        $id = $request->get('id');

        $data = [];
        $query = Reservation::query()
            ->select('reservations.id as id',
                'reservations.check_in as check_in',
                'reservations.check_out as check_out',
                'rooms.id as room_id',
                'reservations.total_price as total_price',
                'rooms.name as room_name',
                'guests.first_name as first_name',
                'guests.last_name as last_name',
                'reservations.total_night as total_night')
            ->leftJoin('rooms', 'rooms.id', '=', 'reservations.room_id')
            ->leftJoin('guests', 'guests.id', '=', 'reservations.id_guest')
//            ->whereNull('reservations.check_out')
            ->where('reservations.id', $id)
            ->where('reservations.hotel_id',Auth::user()->hotel_id)
        ;


             $date = new \DateTime(date('Y-m-d'));
        $date->modify('last day of this month');

        if( Auth::user()->staff_role === 'user'){
            $query->whereBetween('reservations.check_in',[date('Y-m-d'.' 00:00:00'),$date->format('Y-m-d').' 23:59:59']);
        }

          $reservations = $query->first();
        array_push($data, $reservations);
        $only_date = strtotime(substr($reservations->check_in, 0, 10));
        $check_out = date('Y-m-d H:i', strtotime('+'.$reservations->total_night.' day +12 hour', $only_date));

        array_push($data, $check_out);
        return $data;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $rooms = Room::query()
            ->where('rooms.hotel_id',Auth::user()->hotel_id)
            ->orderByDesc('name')

            ->get();
        $guests = Guest::query()
            ->where('guests.hotel_id',Auth::user()->hotel_id)
            ->orderByDesc('first_name')
            ->get();
        $reservations = Reservation::all()->where('check_out', '=', null)->groupBy('room_id');
        $services = Services::query()->where('hotel_id', Auth::user()->hotel_id)->get();
        $data = new  Reservation();
        $reservServ = new  ReservationService();
        $reservation_services = [];
        $total_reservServ  = 0;
        $agents = Agent::query()->orderBy('name','asc')->get();

        return view('reservation/add',compact('rooms','guests','data', 'reservations', 'services', 'reservServ','reservation_services','total_reservServ','agents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $update = $this->update($request, 0);
//        if(!$update){
//            return back()->with(['success' => false, 'message'=> 'ลูกค้ามีการจองอยู่เเล้ว']);
//        }
        return redirect()->route('reservation.index')->with(['success' => true, 'message'=> 'Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {

        $rooms = Room::query()
            ->where('rooms.hotel_id',Auth::user()->hotel_id)
            ->orderByDesc('name')
            ->get();
        $guests = Guest::query()
            ->where('guests.hotel_id',Auth::user()->hotel_id)
            ->orderByDesc('first_name')->get();
        $data = Reservation::query()
            ->select('reservations.id','reservations.price',
                'reservations.total_price',
                'reservations.id_gent as id_gent',
                'reservations.check_in','reservations.promotion_code',
                'reservations.total_night','reservations.special_request',
                'reservations.room_id','reservations.id_guest',
                'rooms.name',
                'guests.first_name','guests.last_name')
            ->leftJoin('rooms', 'rooms.id', '=', 'reservations.room_id')
            ->leftJoin('guests', 'guests.id', '=', 'reservations.id_guest')
            ->where('reservations.id',$id)
            ->where('reservations.hotel_id',Auth::user()->hotel_id)
            ->first();

        if($request->get('reservServ')){
            $id_Serv = (Integer) $request->get('reservServ');
            $ReservationService_de = ReservationService::find($id_Serv);
            $Service_de = Services::find($ReservationService_de->id_services);
            if(isset($ReservationService_de) && isset($Service_de)){
//                $reservations_update_total = Reservation::find($ReservationService_de->id_reservations);
                $data->total_price = ($data->total_price - $Service_de->price) ;
                $data->save();

            }
            ReservationService::destroy($id_Serv);
        }

        $reservations = Reservation::all()->where('check_out', '=', null)->groupBy('room_id');
        $services = Services::query()->where('hotel_id', Auth::user()->hotel_id)->get();
        $reservServ = ReservationService::query()->
                     select('reservation_services.id',
                     'reservation_services.id_services',
                     'services.name','services.price',
                    'reservation_services.created_at')
                     ->leftJoin('services', 'services.id', '=', 'reservation_services.id_services')
                     ->leftJoin('reservations', 'reservations.id', '=', 'reservations.room_id')
                     ->where('reservation_services.id_reservations', $id)
                     ->where('reservation_services.hotel_id', Auth::user()->hotel_id)
                     ->groupBy(
                         'reservation_services.id',
                         'reservation_services.id_services',
                         'services.name','services.price',
                         'reservation_services.created_at'
                     )
                     ->get();
        
        $reservation_services = $reservServ;

        $total_reservServ  = $data->total_price;
        $agents = Agent::query()->orderBy('name','asc')->get();
        return view('reservation/add',compact('rooms','guests','data', 'reservations', 'services', 'reservServ','reservation_services','total_reservServ','agents'));
    }
    public function check_out_reservation($id)
    {
        $reservations = Reservation::find($id);
        $reservations->check_out = date('Y-m-d H:i:s');
        $reservations->check_out_by  =  Auth::user()->id;
        $reservations->save();
        $rooms = Room::find($reservations->room_id);
        $rooms->status = 'available';
        $rooms->save();
        return redirect()->route('reservation.index')->with(['success' => true, 'message'=> 'Reservation was checked out']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

//        dd($request->get('service2'));
//        if(!$id && $request->get('id_guest')){
//            $reservations_count = Reservation::query()
//                ->where('id_guest',$request->get('id_guest'))
//                ->whereNull('check_out')->count();
//            if($reservations_count > 0){
//                return false ;
//            }
//
//        }

        if(!$id){
            $reservations = new Reservation;
//            $room = Room::find($request->get('room_id'));
//            $room->status = 'unavailable';
//            $room->save();
            $reservations->room_id = $request->get('room_id');
        }else{
            $reservations = Reservation::find($id);
        }

        $reservations->id_guest =  $request->get('id_guest');
        $reservations->no_guest = $request->get('no_guest');
        $time = strtotime($request->get('check_in'));;
        $check_in = date('Y-m-d',$time);

        $time_check = strtotime($reservations->check_in);
        $check_in_check = date('Y-m-d',$time_check);
        if( $check_in_check != $check_in){
            $reservations->check_in  = $check_in.' '.date("H:i:s") ;
        }
        $reservations->total_night = $request->get('total_night');
        $price = $request->get('price');
        $reservations->total_price = $request->get('total_price');
        $reservations->id_gent = $request->get('id_gent');
        $reservations->price = $price;
        $reservations->created_by = Auth::user()->id;
        $reservations->hotel_id = Auth::user()->hotel_id;
        $reservations->promotion_code = $request->get('promotion_code');
        if($request->get('special_request') === 'yes'){
            $reservations->special_request = $request->get('special_request_note');
        }
        $reservations->remark_by = Auth::user()->id;

//        if($reservations && $reservations->room_id != $request->get('room_id')){
//
//            $room = Room::find($request->get('room_id'));
//            $room->status = 'unavailable';
//
//            $roomNew = Room::find($reservations->room_id);
//            $roomNew->status = 'available';
//            $reservations->room_id = $request->get('room_id');
//            $room->save();
//            $roomNew->save();
//        }
        $reservations->save();


        if ($request->has('numServ')) {
            for ($i = 0; $i < intval($request->get('numServ')); $i++) {
                if ($request->has('service'.$i)) {
                    $reservService = new ReservationService();
                    $reservService->id_reservations = $reservations->id;
                    $reservService->id_services = intval($request->get('service'.$i));
                    $reservService->hotel_id = $reservations->hotel_id;
                    $reservService->save();
                }
            }
//            $service_price = Services::query()->select(
//                'services.price as price'
//            )->leftJoin('reservation_services', 'reservation_services.id_services', '=', 'services.id')
//                ->where('reservation_services.id_reservations', $reservations->id)
//                ->groupBy('reservation_services.id_reservations')
//                ->sum('services.price');
//            $reservations->total_price = $price+intval($service_price);
//            $reservations->save();
        }
//
//        if ($request->has('numServ') && $id) {
//            $reservUpdate = ReservationService::query()->where('id_reservations', $id)->get();
//            for ($i = 0; $i < intval($request->get('numServ')); $i++) {
//                if (isset($reservUpdate) && $i< count($reservUpdate)) {
//                    $reservUpdate[$i]->id_reservations = $reservations->id;
//                    $reservUpdate[$i]->id_services = intval($request->get('service' . $i));
//                    $reservUpdate[$i]->hotel_id = $reservations->hotel_id;
//                    $reservUpdate[$i]->save();
//                }
//                else if ($request->has('service'.$i)) {
//                    $reservService = new ReservationService();
//                    $reservService->id_reservations = $reservations->id;
//                    $reservService->id_services = $request->get('service'.$i);
//                    $reservService->hotel_id = $reservations->hotel_id;
//                    $reservService->save();
//                }
//            }
////            $service_price = Services::query()->select(
////                'services.price as price'
////            )->leftJoin('reservation_services', 'reservation_services.id_services', '=', 'services.id')
////                ->where('reservation_services.id_reservations', $id)
////                ->groupBy('reservation_services.id_reservations')
////                ->sum('services.price');
////
////            $reservations->total_price = $price+intval($service_price);
////            $reservations->save();
//        }

        return redirect()->route('reservation.index')->with(['success' => true, 'message'=> 'Saved']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Reservation::destroy($id);
       return back();

    }
}

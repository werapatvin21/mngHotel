<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Reservation;
use App\Models\ReservationService;
use App\Models\Room;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->hotel_id;
        $data = [];
        $report = DB::select('select year(reservations.check_in) as year, month(reservations.check_in) as month, count(reservations.id) as total from reservations group by year(reservations.check_in), month(reservations.check_in)');
//dd($report);
        $reservations = Reservation::query()->select(
            DB::raw('count(id) as amount, DATE_FORMAT(check_out, "%Y-%m") as date')
        )
            ->whereNotNull('check_out')
            ->where('hotel_id', $id)
            ->groupBy(DB::raw("DATE_FORMAT(check_out, '%Y-%m')"))
            ->get();


        for ($i = 1; $i <= 12; $i++) {
            $data[$i] = 0;
            foreach ($reservations as $r) {
                if (date('Y', strtotime($r->date)) === date('Y')) {
                    $month = date('m', strtotime($r->date));
                    if ($month == $i) {
                        $data[$i] = $r->amount;
                    }
                }
            }
        }


        $y = date('Y');
        $costs = ReservationService::query()->select(
            DB::raw('sum(services.service_cost) as total_cost, reservation_services.id_services, DATE_FORMAT(reservations.check_out, "%Y-%m") as date')
        )
            ->leftJoin('services', 'services.id', '=', 'reservation_services.id_services')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservation_services.id_reservations')
            ->whereNotNull('reservations.check_out')
            ->where('reservations.hotel_id', $id)
            ->groupBy('reservation_services.id_services')
            ->whereYear('reservations.check_out', $y)
            ->groupBy(DB::raw("DATE_FORMAT(reservations.check_out, '%Y-%m')"))
            ->get();
//        dd($costs);
        $total_income = ReservationService::query()->select(
            DB::raw('sum(services.price) as total_income, reservation_services.id_services, DATE_FORMAT(reservations.check_out, "%Y-%m") as date')
        )
            ->leftJoin('services', 'services.id', '=', 'reservation_services.id_services')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservation_services.id_reservations')
            ->whereNotNull('reservations.check_out')
            ->where('reservations.hotel_id', $id)
            ->groupBy('reservation_services.id_services')
            ->whereYear('reservations.check_out', $y)
            ->groupBy(DB::raw("DATE_FORMAT(reservations.check_out, '%Y-%m')"))
            ->get();
//dd($total_income);
        $cost_profit = [];
        if (isset($costs) && count($costs) > 0 && isset($total_income) && count($total_income) > 0) {
            foreach ($costs as $cost) {
                $service = Services::query()->where('id', $cost->id_services)->first();
                if (isset($service) && $service->name) {
                    foreach ($total_income as $income) {
                        if ($cost->id_services == $income->id_services) {
                            array_push($cost_profit, ['total_income' => floatval($income->total_income), 'total_profit' => floatval($income->total_income) - floatval($cost->total_cost), 'total_cost' => floatval($cost->total_cost), 'service_name' => $service->name]);
                        }
                    }
                }
            }
        }

//        dd($cost_profit);



// Income Chart
        $m = date('m');
        $y = date('Y');
        $incomes = Reservation::query()
            ->select(
            DB::raw('sum(total_price) as total_price, DATE_FORMAT(check_out, "%Y-%m-%d") as date')
        )
            ->where('hotel_id', $id)
            ->whereNotNull('check_out')
            ->whereMonth('check_out', $m)
            ->whereYear('check_out', $y)
            ->groupBy(DB::raw("DATE_FORMAT(check_out, '%Y-%m-%d')"))
            ->get();

        $incomes_array =  [];
        if (isset($incomes) && count($incomes) > 0) {
            foreach ($incomes as $income) {
                array_push($incomes_array, ['total_income' => floatval($income->total_price), 'date' => $income->date]);
            }
        }
//        dd($incomes_array);
//        $income = DB::select('select month(reservations.check_out) as month, day(reservations.check_out) as day, sum(total_price) from reservations group by month(reservations.check_out), day(reservations.check_out)');




       // Service chart
        $service_amount = ReservationService::query()->select(
            DB::raw('count(id_services) as amount, id_services')
        )
            ->where('hotel_id', $id)
            ->groupBy('id_services')
            ->get();


        $services = [];
        if(isset($service_amount) && count($service_amount) > 0){
            foreach ($service_amount as $s) {
                $service = Services::find($s->id_services);
                    if(isset($service) && $service->name){
                        array_push($services, ["amount" => $s->amount, "service_name" => $service->name]);
                    }
                }

        }




        // Top country chart
        $countries = Guest::query()->select(
            DB::raw('count(guest_country) as amount, guest_country')
        )
            ->where('hotel_id', $id)
            ->groupBy('guest_country')
            ->orderByDesc(DB::raw('count(guest_country)'))
            ->limit(5)
            ->get()->toArray();

//        dd($countries);



        // Top Room chart
        $rooms = Room::query()->select(
            DB::raw('count(room_types.name) as amount, room_types.name')
        )
            ->leftJoin('reservations', 'reservations.room_id', '=', 'rooms.id')
            ->leftJoin('room_types', 'room_types.id', '=', 'rooms.room_type')
            ->where('reservations.hotel_id', $id)
            ->groupBy('room_types.name')
            ->get()->toArray();

//        dd($rooms);



        // Top guests chart
        $top_guests = Reservation::query()->select(
            DB::raw('count(id) as amount, id_guest')
        )
            ->where('hotel_id', $id)
            ->groupBy('id_guest')
            ->orderByDesc(DB::raw('count(id)'))
            ->limit(5)
            ->get();

        $guests = [];
        if (isset($total_income) && count($total_income) > 0) {
            foreach ($top_guests as $top) {
                $guest = Guest::find($top->id_guest);
                if (isset($guest)) {
                    array_push($guests, ["amount" => $top->amount, "guest_name" => $guest->first_name . " " . $guest->last_name]);
                }
            }
        }
//        dd($guests);

        return view('report/list', compact('data', 'services', 'rooms', 'countries', 'guests', 'incomes_array', 'cost_profit'));
    }


    function getIncomeData(Request $request) {
        $m = date('m');
        $y = date('Y');
        $incomes = Reservation::query()
            ->where('hotel_id', Auth::user()->hotel_id)
            ->whereNotNull('check_out');

            if ($request->get('type') == "day") {
                $incomes
                    ->select(
                        DB::raw("sum(total_price) as total_price, DATE_FORMAT(check_out, '%Y-%m-%d') as date")
                    )
                    ->whereMonth('check_out', $m)
                    ->whereYear('check_out', $y)
                    ->groupBy(DB::raw("DATE_FORMAT(check_out, '%Y-%m-%d')"));
            } else if ($request->get('type') == "month") {
                $incomes
                    ->select(
                        DB::raw("sum(total_price) as total_price, DATE_FORMAT(check_out, '%Y-%m') as date")
                    )
                    ->whereYear('check_out', $y)
                    ->groupBy(DB::raw("DATE_FORMAT(check_out, '%Y-%m')"));
            } else if ($request->get('type') == "year"){
                $incomes
                    ->select(
                        DB::raw("sum(total_price) as total_price, DATE_FORMAT(check_out, '%Y') as date")
                    )
                    ->groupBy(DB::raw("DATE_FORMAT(check_out, '%Y')"));
            }
        $incomes = $incomes->get();

        $incomes_array =  [];
        if (isset($incomes) & count($incomes) > 0) {
            foreach ($incomes as $income) {
                array_push($incomes_array, ['total_income' => floatval($income->total_price), 'date' => $income->date]);
            }
        }

        return $incomes_array;
    }

    function getCostProfitData(Request $request) {
        $y = date('Y');
        $costs = ReservationService::query()
            ->leftJoin('services', 'services.id', '=', 'reservation_services.id_services')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservation_services.id_reservations')
            ->whereNotNull('reservations.check_out')
            ->where('reservations.hotel_id', Auth::user()->hotel_id)
            ->groupBy('reservation_services.id_services');

        $income = ReservationService::query()
            ->leftJoin('services', 'services.id', '=', 'reservation_services.id_services')
            ->leftJoin('reservations', 'reservations.id', '=', 'reservation_services.id_reservations')
            ->whereNotNull('reservations.check_out')
            ->where('reservations.hotel_id', Auth::user()->hotel_id)
            ->groupBy('reservation_services.id_services');

        if ($request->get('type') == "month") {
            $costs
                ->select(
                    DB::raw('sum(services.service_cost) as total_cost, reservation_services.id_services, DATE_FORMAT(reservations.check_out, "%Y-%m") as date')
                )
                ->whereYear('reservations.check_out', $y)
                ->groupBy(DB::raw("DATE_FORMAT(reservations.check_out, '%Y-%m')"));

            $income
                ->select(
                    DB::raw('sum(services.price) as total_income, reservation_services.id_services, DATE_FORMAT(reservations.check_out, "%Y-%m") as date')
                )
                ->whereYear('reservations.check_out', $y)
                ->groupBy(DB::raw("DATE_FORMAT(reservations.check_out, '%Y-%m')"));
        } else if ($request->get('type') == "year"){
            $costs
                ->select(
                    DB::raw('sum(services.service_cost) as total_cost, reservation_services.id_services, DATE_FORMAT(reservations.check_out, "%Y") as date')
                )
                ->groupBy(DB::raw("DATE_FORMAT(reservations.check_out, '%Y')"));

            $income
                ->select(
                    DB::raw('sum(services.price) as total_income, reservation_services.id_services, DATE_FORMAT(reservations.check_out, "%Y") as date')
                )
                ->groupBy(DB::raw("DATE_FORMAT(reservations.check_out, '%Y')"));
        }
        $costs = $costs->get();
        $total_income = $income->get();

        $cost_profit = [];
        if (isset($costs) && count($costs) > 0 && isset($total_income) && count($total_income) > 0) {
            foreach ($costs as $cost) {
                $service = Services::query()->where('id', $cost->id_services)->first();
                if (isset($service) && $service->name) {
                    foreach ($total_income as $income) {
                        if ($cost->id_services == $income->id_services) {
                            array_push($cost_profit, ['total_income' => floatval($income->total_income), 'total_profit' => floatval($income->total_income) - floatval($cost->total_cost), 'total_cost' => floatval($cost->total_cost), 'service_name' => $service->name]);
                        }
                    }
                }
            }
        }

        return $cost_profit;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\User;
use Colors\RandomColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;
use Yajra\DataTables\DataTables;

class StaffEventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::query()
            ->where('hotel_id','=',Auth::user()->hotel_id)->get();
        ;
        $staffs = User::query()
            ->where('hotel_id','=',Auth::user()->hotel_id)
            ->orderByDesc('name')->get();
        return view('staff/list',compact('events', 'staffs'));
    }

    public function getStaffEvent(Request $request) {
        $search = $request->get('search', null);
        $events = Event::query()
            ->where('hotel_id','=',Auth::user()->hotel_id);
        if ($search) {
            $events->where('event_name', 'like', '%'.$search.'%')
                ->orWhere('staff_id', 'like', '%'.$search.'%');
        }

        $events->orderByDesc('event_name');
//        $search->where('hotel_id',Auth::user()->hotel_id);


//        if(Auth::user()->staff_role === 'user'){
//            $date = new \DateTime(date('Y-m-d'));
//            $date->modify('last day of this month');
//            $events->whereBetween('start_at',[date('Y-m-01'),$date->format('Y-m-d')]);
//        }
//        dd($events->get());
        return Datatables::of($events)->toJson();
    }

    public function calendar() {
        $data = Event::query()
            ->select(
                'events.id as id',
                'events.event_name as event_name',
                'events.start_at as start_at',
                'events.end_at as end_at',
                'users.name as staff_name',
                'users.id as staff_id'
            )
            ->where('events.hotel_id','=',Auth::user()->hotel_id)
            ->leftJoin('users', 'users.id', '=', 'events.staff_id');

//        if(Auth::user()->staff_role === 'user'){
//            $date = new \DateTime(date('Y-m-d'));
//            $date->modify('last day of this month');
//            $data->whereBetween('start_at',[date('Y-m-01'),$date->format('Y-m-d')]);
//        }

        $staff_events = $data->get();
        $max_end_at = $data->orderByDesc('events.end_at')->first();

        $colors = [];
//        dd(RandomColor::one());
        foreach ($staff_events as $key => $event) {
            array_push($colors, RandomColor::one());
        }
//        dd($colors);
//        $events = [];
//        if($staff_events->count()) {
//            foreach ($staff_events as $key => $value) {
//                $events[] = Calendar::event(
//                    $value->event_name,
//                    true,
//                    new \DateTime($value->start_at),
//                    new \DateTime($value->start_at.' +'.$value->id.'day'),
//                    null,
//                    // Add color and link on event
//                    [
//                        'color' => '#f05050',
//                        'url' => route('staff_event.create',["id"=>$value->id]),
//                    ]
//                );
//            }
//        }
//        $calendar = Calendar::addEvents($events);
        return view('staff.calendar', compact('max_end_at','staff_events', 'calendar', 'colors'));
    }

    public function getEvent(Request $request) {
        $event_id = $request->get('event_id');
        $event = Event::query()->select(
            'events.id as id',
                    'events.event_name as event_name',
            'events.start_at as start_at',
            'events.end_at as end_at',
            'users.name as staff_name'
        )
            ->where('events','=',Auth::user()->hotel_id)
            ->leftJoin('users', 'users.id', '=', 'events.staff_id')
            ->where('events.id', $event_id)->first();
        return $event;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if($request->get('id')){
            $data = Event::find($request->get('id'));
        }else{
            $data = new Event();
        }

        $staffs = User::query()
            ->where('users.hotel_id','=',Auth::user()->hotel_id)
            ->orderByDesc('name')->get();
        $detail = null;
        return view('staff/add_event',compact('data', 'staffs', 'detail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->update($request, 0);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data = Event::find($id);
        $staffs = User::query()
            ->where('users.hotel_id','=',Auth::user()->hotel_id)
            ->orderByDesc('name')->get();
        $detail = $request->get('detail') ?: 0;
        return view('staff/add_event',compact('data', 'staffs', 'detail'));
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
        if (!$id) {
            $events = new Event;
        } else {
            $events = Event::find($id);
            $self_name = $events->event_name;
        }

        $event_name = $request->get('event_name');
//        $duplic_name = $events->where('event_name', $event_name)->first();
//        if (isset($self_name) && $self_name == $event_name){
//            $duplic_name = null;
//        }

//        if ($duplic_name) {
//            return redirect('/event_calendar')->with(['success' => false, 'message' => 'Duplicate event name']);
//        } else {
            $events->event_name = $request->get('event_name');
            $events->staff_id = $request->get('staff_id');
            $start_date = strtotime($request->get('start_at'));
            $start_at = date('Y-m-d', $start_date);
            $events->start_at = $start_at;
            $end_date = strtotime($request->get('end_at'));
            $end_at = date('Y-m-d', $end_date);
            $events->end_at = $end_at;
            $events->hotel_id = Auth::user()->hotel_id;
            $events->created_by = Auth::user()->id;

            $events->save();
//        return Redirect(url('event_calendar'));
            return redirect('/event_calendar')->with(['success' => true, 'message' => 'Saved']);
//        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $events= Event::find($id);
        $events->delete();
        return redirect('/staff')->with(['success' => true, 'message' => 'Deleted']);
    }
}

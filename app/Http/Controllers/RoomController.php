<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Event;
use App\Models\Promotion;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\SpecialPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('room/list');
    }

    public function getRoom(Request $request) {
        $search = $request->get('search', null);
        $room = Room::query()
            ->select(
                'room_types.name as room_type_name',
                'rooms.name as name',
                'rooms.price as price',
                'rooms.status as status',
                'rooms.room_special_price as room_special_price',
                'rooms.id as id'
            )
            ->where('rooms.hotel_id',Auth::user()->hotel_id)
            ->leftJoin('room_types', 'room_types.id', '=', 'rooms.room_type');
        if ($search) {
            $room->where(function($q) use ($search) {
                $q->where('rooms.name', 'like', '%'.$search.'%')
                    ->orWhere('room_types.name', 'like', '%'.$search.'%')
                    ->orWhere('rooms.price', 'like', '%'.$search.'%')
                    ->orWhere('rooms.status', 'like', '%'.$search.'%')
                    ->orWhere('rooms.room_special_price', 'like', '%'.$search.'%');
            });
        }
//        $room->orderByDesc('rooms.updated_at');
        $room->orderBy('rooms.name');
//        dd($events->get());
        return Datatables::of($room)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Room();
        $detail = null;
        $room_types = RoomType::query()
            ->where('room_types.hotel_id',Auth::user()->hotel_id)
            ->get();
        $special_price = SpecialPrice::query()->where('hotel_id',Auth::user()->hotel_id)->first();
        if(!$special_price){
            $special_price = new SpecialPrice();
        }

        return view('room.add',compact('data','detail','room_types','special_price'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->update($request, 0);
        return redirect()->route('room.index')->with(['success' => true, 'message'=> 'Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request , $id)
    {
        $data = Room::find($id);
        $detail = $request->get('detail',0);
        $room_types = RoomType::query()
            ->where('room_types.hotel_id',Auth::user()->hotel_id)
            ->get();
        $special_price = SpecialPrice::query()->where('hotel_id',Auth::user()->hotel_id)->first();
        if(!$special_price){
            $special_price = new SpecialPrice();
        }
        return view('room.add',compact('data','detail','room_types','special_price'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function edit(Room $room)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$id){
            $room = new Room();
        }else{
            $room = Room::find($id);
        }
        $room->name = $request->get('name');
        $room->room_type = $request->get('room_type');
        $room->price = $request->get('room_price');
        $room->room_special_price = $request->get('room_specialPrice');
        $room->room_season_price = $request->get('room_seasonPrice');
        $room->status = $request->get('room_status');
        $room->created_by = Auth::user()->id;
        $room->hotel_id = Auth::user()->hotel_id;

        $room->save();

        return redirect()->route('room.index')->with(['success' => true, 'message'=> 'Saved']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Room::destroy($id);
        return redirect()->route('room.index')->with(['success' => true, 'message'=> 'Deleted']);
    }

    public  function get_price_room(Request $request){

        try{
            $room = Room::query()->select('price','promotion_code')
                ->where('rooms.hotel_id',Auth::user()->hotel_id)
                ->where('id',$request->get('id'))->first();

            return response()->json([
                'success' => true,
                'data' => $room
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }

    }
    public  function  checkPromotion($id){
        $promotion = Promotion::find($id);
        $start_at = $promotion->start_at;
        $end_at = $promotion->end_at;
        if(date('Y-m-d') <= $end_at && date('Y-m-d') >= $start_at){
            $promotion->status = 'active';
        }
        if(date('Y-m-d') > $end_at && date('Y-m-d') > $start_at){
            $promotion->status = 'expired';
        }
        $promotion->save();
        return $promotion;

    }

    public  function get_promotion(Request $request){
        try{
            $promotion = Promotion::query()
                ->where('promotions.hotel_id',Auth::user()->hotel_id)
                ->where('code',$request->get('code'))
//                ->where('status','=','active')
                ->first();

            if($promotion && !$promotion->status){
                $promotion = $this->checkPromotion($promotion->id);

            }


//            if(!$promotion->status && $promotion->start_at >= date('Y-m-d')){
//                $promotion->status = 'active';
//            }
//            if($promotion && $promotion->status && $promotion->end_at < date('Y-m-d')){
//                $promotion->status = 'expired';
//            }
            return response()->json([
                'success' => true,
                'data' => $promotion,
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }

    }

}

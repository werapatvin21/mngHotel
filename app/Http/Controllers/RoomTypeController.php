<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $room_type = RoomType::query()->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {


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
        $room_id = $request->get('room_id');
        if(!$room_id){
            return redirect()->route('room.create')->with(['success' => true, 'message'=> 'Saved','RoomType' => true]);

        }else{
            return redirect()->route('room.show',['id'=> $room_id])->with(['success' => true, 'message'=> 'Saved']);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $room_type = RoomType::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function edit(RoomType $roomType)
    {
        $room_type = RoomType::find(11);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $room_id = $request->get('room_id');
        if(!$id){
            $room_type = new RoomType();
        }else{
            $room_type = RoomType::find($id);
        }
        $room_type->name = $request->get('name_room_types');
        $room_type->created_by = Auth::user()->id;
        $room_type->hotel_id = Auth::user()->hotel_id;
        $room_type->save();

        if(!$room_id){
            return redirect()->route('room.create')->with(['success' => true, 'message'=> 'Saved']);

        }else{
            return redirect()->route('room.show',['id'=> $room_id])->with(['success' => true, 'message'=> 'Saved']);

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RoomType  $roomType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $Room = Room::query()->where('room_type',$id)->count();
        if($Room > 0){
            return redirect()->route('room.create')->with(['success' => false, 'message'=> 'Room type was used']);

        }else{
            RoomType::destroy($id);
            return redirect()->route('room.index')->with(['success' => true, 'message'=> 'Deleted']);
        }

    }
}

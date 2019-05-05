<?php

namespace App\Http\Controllers;

use App\Models\SpecialPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpecialPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $this->update($request, 0);
        return redirect()->route('room.index')->with(['success' => true, 'message'=> 'Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SpecialPrice  $specialPrice
     * @return \Illuminate\Http\Response
     */
    public function show(SpecialPrice $specialPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SpecialPrice  $specialPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(SpecialPrice $specialPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SpecialPrice  $specialPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $room_id = $request->get('room_id');

        if(!$id){
            $specialPrice = new SpecialPrice();
        }else{
            $specialPrice = SpecialPrice::find($id);
        }
        $monday = $request->input('monday')?:false;
        if($monday === 'on'){
            $monday = true;
        }

        $tuesday = $request->input('tuesday')?:false;
        if($tuesday === 'on'){
            $tuesday = true;
        }
        $wednesday = $request->input('wednesday')?:false;
        if($wednesday === 'on'){
            $wednesday = true;
        }

        $thursday = $request->input('thursday')?:false;
        if($thursday === 'on'){
            $thursday = true;
        }

        $friday = $request->input('friday')?:false;
        if($friday === 'on'){
            $friday = true;
        }

        $saturday = $request->input('saturday')?:false;
        if($saturday === 'on'){
            $saturday = true;
        }

        $sunday = $request->input('sunday')?:false;
        if($sunday === 'on'){
            $sunday = true;
        }


        $date_start = strtotime($request->get('season_start'));
        $season_start = date('Y-m-d',$date_start);

        $date_end = strtotime($request->get('season_end'));
        $season_end = date('Y-m-d',$date_end);


        $specialPrice->monday = $monday;
        $specialPrice->tuesday = $tuesday;
        $specialPrice->wednesday = $wednesday;
        $specialPrice->thursday =$thursday;
        $specialPrice->friday = $friday;
        $specialPrice->saturday = $saturday;
        $specialPrice->sunday = $sunday;
        $specialPrice->season_start = $season_start;
        $specialPrice->season_end = $season_end;
        $specialPrice->created_by = Auth::user()->id;
        $specialPrice->hotel_id =  Auth::user()->hotel_id;


        $specialPrice->save();
        if(!$room_id){
            return redirect()->route('room.create')->with(['success' => true, 'message'=> 'Saved']);

        }else{
            return redirect()->route('room.show',['id'=> $room_id])->with(['success' => true, 'message'=> 'Saved']);

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SpecialPrice  $specialPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpecialPrice $specialPrice)
    {
        //
    }
}

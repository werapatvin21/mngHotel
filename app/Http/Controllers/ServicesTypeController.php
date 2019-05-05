<?php

namespace App\Http\Controllers;

use App\Models\RoomType;
use App\Models\Services;
use App\Models\ServicesType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicesTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services_types = ServicesType::query()
            ->where('services_types.hotel_id',Auth::user()->hotel_id)
            ->where('created_by',Auth::user()->id)
            ->get();
        return $services_types;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return redirect()->route('services.index')->with(['success' => true, 'message'=> 'Saved']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $ServicesType = new ServicesType();
        $ServicesType->name = $request->get('name');
        $ServicesType->created_by = Auth::user()->id;
        $ServicesType->hotel_id = Auth::user()->hotel_id;
        $ServicesType->save();
        return $ServicesType;
//        $this->update($request, 0);
//        return redirect()->route('services.index')->with(['success' => true, 'message'=> 'Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServicesType  $servicesType
     * @return \Illuminate\Http\Response
     */
    public function show(ServicesType $servicesType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServicesType  $servicesType
     * @return \Illuminate\Http\Response
     */
    public function edit(ServicesType $servicesType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServicesType  $servicesType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$id){
            $ServicesType = new ServicesType();
        }else{
            $ServicesType = ServicesType::find($id);
        }
        $ServicesType->name = $request->get('name');
        $ServicesType->created_by = Auth::user()->id;
        $ServicesType->hotel_id = Auth::user()->hotel_id;
        $ServicesType->save();
        return $ServicesType;
//        return redirect()->route('services.index')->with(['success' => true, 'message'=> 'Saved']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServicesType  $servicesType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $check = Services::query()->where('service_type','=',$id)->get();
       if(count($check) > 0){
           return redirect()->route('services.index')->with(['success' => false, 'message'=> 'Unavailable removed! Service was used']);
       }
        ServicesType::destroy($id);
        return redirect()->route('services.index')->with(['success' => true, 'message'=> 'Deleted']);
    }
}

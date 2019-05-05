<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\RoomType;
use App\Models\Services;
use App\Models\ServicesType;
use App\Models\SpecialPrice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Integer;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new Services();
        $detail = null;
        $services_types = ServicesType::query()
            ->where('services_types.hotel_id',Auth::user()->hotel_id)
            ->where('created_by',Auth::user()->id)
            ->get();
        if(!$services_types){
            $services_types = new ServicesType();
        }
        return view('services.list',compact('data','detail','services_types'));
    }

    public function getServices(Request $request) {
        $search = $request->get('search', null);
        $services = Services::query()
            ->select(
                'services_types.name as services_type_name',
                'services.name as name',
                'services.price as price',
                'services.service_cost as cost',
                'services.status as status',
                'services.id as id'
            )
            ->where('services.hotel_id',Auth::user()->hotel_id)
            ->leftJoin('services_types', 'services_types.id', '=', 'services.service_type');

        if ($search) {
            $services->where(function($q) use ($search) {
                $q->where('services.name', 'like', '%'.$search.'%')
                    ->orWhere('services_types.name', 'like', '%'.$search.'%')
                    ->orWhere('services.price', 'like', '%'.$search.'%')
                    ->orWhere('services.status', 'like', '%'.$search.'%');
            });
        }
         $services->orderByDesc('services.updated_at');
        return DataTables::of($services)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Services();
        $detail = null;
        $services_types = ServicesType::query()
            ->where('services_types.hotel_id',Auth::user()->hotel_id)
            ->where('created_by',Auth::user()->id)
            ->get();
        if(!$services_types){
            $services_types = new ServicesType();
        }
        return view('services.add',compact('data','detail','services_types'));
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
        return redirect()->route('services.index')->with(['success' => true, 'message'=> 'Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request , $id)
    {
        $data = Services::find($id);
        $detail = $request->get('detail',0);
        $services_types = ServicesType::query()
            ->where('services_types.hotel_id',Auth::user()->hotel_id)
            ->get();
        if(!$services_types){
            $services_types = new ServicesType();
        }
        return view('services.add',compact('data','detail','services_types'));
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
            $Services = new Services();
        }else{
            $Services = Services::find($id);
        }
        $Services->name = $request->get('name');
        $Services->service_type = $request->get('service_type');
        $Services->price = (Integer) $request->get('price');
        $Services->service_cost =  (Integer) $request->get('cost');
        $Services->status = $request->get('status');
        $Services->created_by = Auth::user()->id;
        $Services->hotel_id = Auth::user()->hotel_id;
        $Services->save();
        return redirect()->route('services.index')->with(['success' => true, 'message'=> 'Saved']);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        Services::destroy($id);
        return redirect()->route('services.index')->with(['success' => true, 'message'=> 'Deleted']);
    }

    public  function get_price_service(Request $request){

        try{
            $service = Services::query()->select('price')
                ->where('services.hotel_id',Auth::user()->hotel_id)
                ->where('id',$request->get('serviceId'))->first();
            return response()->json([
                'success' => true,
                'data' => $service
            ],200);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ],400);
        }

    }
}

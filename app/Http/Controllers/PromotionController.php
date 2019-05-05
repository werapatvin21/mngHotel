<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = new Promotion();
        $detail = 0;
        return view('promotion/list',compact('data','detail'));
    }

    public  function getPromotionAll(Request $request){


        $search = $request->get('search', null);
        $room = Promotion::query()
            ->select(
                'id','name','code','start_at','end_at',
                'discount','status','unit','note'
            )
            ->where('promotions.hotel_id',Auth::user()->hotel_id);
        if ($search) {
            $room->where(function($q) use ($search) {
                $q->where('promotions.name', 'LIKE', '%' . $search . '%')
                    ->orWhere('promotions.start_at', 'like', '%'.$search.'%')
                    ->orWhere('promotions.code', 'like', '%'.$search.'%')
                    ->orWhere('promotions.end_at', 'like', '%'.$search.'%')
                    ->orWhere('promotions.discount', 'like', '%'.$search.'%')
                    ->orWhere('promotions.unit', 'like', '%'.$search.'%');
            });
        }
        $room->orderByDesc('promotions.updated_at');
//        dd($events->get());

        return DataTables::of($room)->toJson();




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new Promotion();
        $detail = null;

        return view('promotion/add',compact('data','detail'));
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
        return redirect()->route('promotion.index')->with(['success' => true, 'message'=> 'Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        $detail = $request->get('detail',0);
        $data = Promotion::find($id);
        return view('promotion/add',compact('data','detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function edit(Promotion $promotion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!$id){
            $promotion = new Promotion();
        }else{
            $promotion = Promotion::find($id);
        }

        $date_start = strtotime($request->get('start_at'));
        $start = date('Y-m-d',$date_start);

        $date_end = strtotime($request->get('end_at'));
        $end = date('Y-m-d',$date_end);


        $promotion->name = $request->get('name');
        $promotion->code = $request->get('code');
        $promotion->start_at = $start;
        $promotion->end_at = $end;
        $promotion->discount = $request->get('discount');
        $promotion->status = $request->get('status');
        $promotion->unit = $request->get('unit');
        $promotion->note = $request->get('note');
        $promotion->created_by = Auth::user()->id;
        $promotion->hotel_id = Auth::user()->hotel_id;
        $promotion->save();
        return redirect()->route('promotion.index')->with(['success' => true, 'message'=> 'Saved']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Promotion::destroy($id);
        return redirect()->route('promotion.index')->with(['success' => true, 'message'=> 'Deleted']);
    }


}

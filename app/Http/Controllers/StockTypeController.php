<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\StockType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_type = StockType::query()->get();
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
        $stock_id = $request->get('stock_id');
        if(!$stock_id){
            return redirect()->route('stock.create')->with(['success' => true, 'message'=> 'Saved','StockType' => true]);

        }else{
            return redirect()->route('stock.show',['id'=> $stock_id])->with(['success' => true, 'message'=> 'Saved']);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock_type = StockType::query()->get();
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
        $stock_id = $request->get('stock_id');
        if(!$id){
            $stock_type = new StockType();
        }else{
            $stock_type = StockType::find($id);
        }
        $stock_type->name = $request->get('name_stock_types');
        $stock_type->created_by = Auth::user()->id;
        $stock_type->hotel_id = Auth::user()->hotel_id;
        $stock_type->save();

        if(!$stock_id){
            return redirect()->route('stock.create')->with(['success' => true, 'message'=> 'Saved']);

        }else{
            return redirect()->route('stock.show',['id'=> $stock_id])->with(['success' => true, 'message'=> 'Saved']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Stock = Stock::query()->where('type',$id)->count();
        if($Stock > 0){
            return redirect()->route('stock.create')->with(['success' => false, 'message'=> 'Stock type was used']);

        }else{
            StockType::destroy($id);
            return redirect()->route('stock.index')->with(['success' => true, 'message'=> 'Deleted']);
        }
    }
}

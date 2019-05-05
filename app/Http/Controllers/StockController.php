<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Services;
use App\Models\Stock;
use App\Models\StockType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class StockController extends Controller
{
    protected $default_prefix = 'storage/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stock_types = StockType::query()
            ->where('stock_types.hotel_id',Auth::user()->hotel_id)
            ->get();

        $product_types = DB::table('product_type')
            ->where('product_type.hotel_id',Auth::user()->hotel_id)
            ->orderByDesc('product_type.name')->get();
        $data = new Stock ();
        $stocks = Stock::query()->select('product_name')
            ->where('hotel_id',Auth::user()->hotel_id)
            ->groupBy('product_name')->get();
        return view('stock/list', compact('product_types', 'data','stocks', 'stock_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getStock(Request $request){
        $search = $request->get('search', null);
        $stocks = Stock::query()
            ->select(
                'stocks.created_at as created_at',
                'stocks.list_name as list_name',
                'stocks.product_name as product_name',
                'stocks.number_report as number_report',
                'product_type.name as product_type',
                'stocks.status as status',
                'stocks.bring as bring',
                'stocks.receive as receive',
                'stocks.pay as pay',
                'stocks.total as total',
                'users.name as by',
                'stocks.id as stock_id',
                'stocks.file as file'
            )
            ->where('stocks.hotel_id',Auth::user()->hotel_id)
            ->leftJoin('product_type', 'product_type.id', '=', 'stocks.type')
            ->leftJoin('users', 'users.id', '=', 'stocks.by');

        if ($search) {
            $stocks->where(function($q) use ($search) {
                $q->where('stocks.list_name', 'like', '%'.$search.'%')
                    ->orWhere('stocks.product_name', 'like', '%'.$search.'%')
                    ->orWhere('stocks.number_report', 'like', '%'.$search.'%')
                    ->orWhere('product_type.name', 'like', '%'.$search.'%')
                    ->orWhere('stocks.status', 'like', '%'.$search.'%')
                    ->orWhere('users.name', 'like', '%'.$search.'%');
            });
        }
        $stocks->orderByDesc('stocks.updated_at');
        if(Auth::user()->staff_role === 'user'){
            $checks = Stock::query()
                ->select('id as stock_id','product_name','created_at')
                ->where('stocks.hotel_id',Auth::user()->hotel_id)
                ->orderByDesc('created_at')
                ->get()
                ->groupBy('product_name');
            $id =[];
            foreach ($checks as $index =>  $check ){
                if(count($check) >= 1){
                    array_push($id,$check[0]['stock_id']);

                }
            }
            if($id){
                $stocks->whereIn('stocks.id',$id);
            }

        }
//        dd($events->get());
        return DataTables::of($stocks)->toJson();
    }
    public function create()
    {
        $stock_types = StockType::query()
            ->where('stock_types.hotel_id',Auth::user()->hotel_id)
            ->get();
        $product_type = DB::table('product_type')
            ->where('product_type.hotel_id',Auth::user()->hotel_id)
            ->orderByDesc('name')->get();
        $data  = new Stock ();
        return view('stock/list',compact('product_type','data', 'stock_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $update =  $this->update($request,0);

        if($update && !$update['success']){
            return redirect()->route('stock.index')->with(['success' => false, 'message'=> $update['message']]);

        }else{
            return redirect()->route('stock.index')->with(['success' => true, 'message'=> 'Saved']);

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        $stock_types = StockType::query()
            ->where('stock_types.hotel_id',Auth::user()->hotel_id)
            ->get();
        $product_types = DB::table('product_type')
            ->where('product_type.hotel_id',Auth::user()->hotel_id)
            ->orderByDesc('name')->get();
        $data = Stock::find($id);
        $detail = $request->get('detail',0);
        $stocks = Stock::query()->select('product_name')
            ->where('stocks.hotel_id',Auth::user()->hotel_id)
            ->groupBy('product_name')->get();
        return view('stock/add',compact('product_types','data','detail','stocks', 'stock_types'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function edit(Stock $stock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $number_report = $request->get('number_report');
        $amount = $request->get('amount');
        $type = $request->get('type');
        $status = $request->get('status');
        $list_name = $request->get('list_name');
        $product_name = $request->get('product_name');

        if(!$id){
            $stocks = new Stock();
            if($list_name === 'In'){
                $stocks->status =  'bring';
                $stocks->bring =  $amount;
                $stocks->total = $amount;
                $bring = Stock::query()
                    ->where('stocks.hotel_id',Auth::user()->hotel_id)
                    ->where('product_name',$product_name)
                    ->where('type',$type)
                    ->limit(1)
                    ->orderByDesc('created_at')
                    ->first();

//                if($bring){
//                    return
//                        [
//                            'success' => false,
////                            'message' => 'ยอดรายการยกมาของ สินค้า:'.$product_name.' มีอยู่เเล้ว'.''
//                            'message' => 'The amount of the goods brought forward'
//
//                        ];
//                }


            }else if ($list_name == 'Out'){
                $bring = Stock::query()
                    ->where('stocks.hotel_id',Auth::user()->hotel_id)
                    ->where('product_name',$product_name)
                    ->where('type',$type)
                    ->limit(1)
                    ->orderByDesc('created_at')
                    ->first();
                if(!$bring){
                    return
                        [
                            'success' => false,
                            'message' => 'No found'

                        ];
                }
                if ($bring->total < $amount){
                    return
                        [
                            'success' => false,
                            'message' => 'Insufficient amount'

                        ];
                }
                $stocks->pay = $amount;
                $stocks->total =  ($bring->total - $amount);
                $stocks->status =  'pay';
            }else{
                $bring = Stock::query()
                    ->where('stocks.hotel_id',Auth::user()->hotel_id)
                    ->where('product_name',$product_name)
                    ->where('type',$type)
                    ->limit(1)
                    ->orderByDesc('created_at')
                    ->first();
                if(!$bring){
                    return
                        [
                            'success' => false,
                            'message' => 'No found'

                        ];
                }
                $stocks->status =  'receive';
                $stocks->receive = $amount;
                $stocks->total =  ($bring->total + $amount);
            }
        }else{
            $stocks = Stock::find($id);
        }

        $stocks->list_name = $list_name;
        $stocks->product_name = $product_name;
        $stocks->by =  Auth::user()->id;
        $stocks->created_by =  Auth::user()->id;
        $stocks->hotel_id =  Auth::user()->hotel_id;
        $stocks->number_report = $number_report;
        $stocks->type = $type;

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $response = $this->uploadFile($image, 'images', $image->getClientOriginalName());
            $stocks->file =  $response->path;
        }

        $stocks->save();


        if(!$id){
            return
                [
                    'success' => true,
                    'message' => 'Saved'

                ];

        }



        return redirect()->route('stock.index')->with(['success' => true, 'message'=> 'Saved']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock  $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Stock::destroy($id);
        return redirect()->route('stock.index')->with(['success' => true, 'message'=> 'Deleted']);
    }

    public function uploadFile($file, $prefix = '', $name = null, $extension = null)
    {
        if ($extension == null) {
            $extension = $file->getClientOriginalExtension();
        }
        if ($name == null) {
            $name = uniqid() . (($extension != '') ? '.' . $extension : '');
        } else if ($extension != '' && strpos($name, '.') === false) {
            $name .= '.' . $extension;
        }


        $filePath = $this->default_prefix . $prefix . ((substr($prefix, -strlen($prefix)) === '/' || $prefix == '') ? '' : '/');

        $res = $file->move(public_path() . '/' . $filePath, $name);

        return (object)['status' => ($res) ? true : false, 'path' => $filePath . $name, 'name' => $name];
    }
}

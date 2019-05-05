<?php

namespace App\Http\Controllers;

use App\Model\Guest;
use App\Models\Reservation;
use App\Models\Room;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class GuestController extends Controller
{
    protected $default_prefix = 'storage/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $data = \App\Models\Guest::query()
            ->where('guests.hotel_id',Auth::user()->hotel_id)
            ->orderByDesc('updated_at')->get();
        return view('guests/list',compact('data'));
    }

    public function getStaffAll(Request $request) {
        $search = $request->get('search', null);
        $guest = \App\Models\Guest::query()
            ->where('guests.hotel_id',Auth::user()->hotel_id);

        if ($search) {
            $guest->where(function($q) use ($search) {
                $q->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('card_id', 'like', '%'.$search.'%')
                    ->orWhere('passport_id', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('phone', 'like', '%'.$search.'%')
                    ->orWhere('guest_country', 'like', '%'.$search.'%');
            });
        }
        $guest->orderBy('first_name');
        return Datatables::of($guest)->toJson();
    }

    public function getGuestBooking(Request $request) {
        $search = $request->get('search', null);
        $guest = Reservation::query()->select(
            'reservations.id as id',
            'reservations.check_in as check_in',
            'reservations.check_out as check_out',
            'guests.first_name as first_name',
            'guests.last_name as last_name',
            'guests.card_id as card_id',
            'guests.passport_id as passport_id',
            'guests.email as email',
            'guests.phone as phone',
            'guests.guest_country as guest_country'
        )
            ->where('reservations.hotel_id',Auth::user()->hotel_id)

            ->leftJoin('guests', 'guests.id', '=', 'reservations.id_guest')
        ;
        if ($search) {
            $guest->where(function($q) use ($search) {
                $q->where('reservations.id', 'like', '%'.$search.'%')
                    ->orWhere('guests.first_name', 'like', '%'.$search.'%')
                    ->orWhere('guests.last_name', 'like', '%'.$search.'%')
                    ->orWhere('guests.card_id', 'like', '%'.$search.'%')
                    ->orWhere('guests.passport_id', 'like', '%'.$search.'%')
                    ->orWhere('guests.email', 'like', '%'.$search.'%')
                    ->orWhere('guests.phone', 'like', '%'.$search.'%')
                    ->orWhere('guest_country', 'like', '%'.$search.'%');
            });
        }
        if(auth()->user()->staff_role === 'user'){
            $guest->whereYear('reservations.check_in', '=',  date('Y'))
                ->whereMonth('reservations.check_in', '=',  date('m'));
        }
        $guest->orderBy('reservations.check_in');
        return Datatables::of($guest)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = new \App\Models\Guest();
        $detail = $request->get('detail') ?: 0;
        return view('guests/add',compact('data','detail'));
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

        if($request->get('add_guests_for_reservations')?: 'no' === 'yes'){
            return redirect()->route('reservation.create')->with(['success' => true, 'message'=> 'Saved']);


        }
        return redirect()->route('guest.index')->with(['success' => true, 'message'=> 'Saved']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        $data = \App\Models\Guest::find($id);
        $detail = $request->get('detail') ?: 0;

        return view('guests/add',compact('data','detail'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(!$id){
            $guest = new  \App\Models\Guest();
        }else{
            $guest = \App\Models\Guest::find($id);
        }
//        $request->validate([
//            'email' => 'required|unique:guests,email,'.$guest->id,
//            'card_id' => 'required|unique:guests,card_id,'.$guest->id,
//            'passport_id' => 'unique:guests,passport_id,'.$guest->id
//        ]);

        $guest->first_name = $request->get('first_name');
        $guest->last_name = $request->get('last_name');
        $guest->card_id = $request->get('card_id');
        $guest->passport_id = $request->get('passport_id');
        $guest->email = $request->get('email');
        $guest->phone = $request->get('phone');
        $guest->guest_country = $request->get('country');
        $guest->address = $request->get('address');
        $guest->file_type = $request->get('file_type');
        $file = $request->file('file');
        if($file){
            $response = $this->uploadFile($file, 'images', $file->getClientOriginalName());
            $guest->file = $response->path;
        }


        $guest->note = $request->get('note');
        $guest->hotel_id = Auth::user()->hotel_id;
        $guest->created_by = Auth::user()->id;
        $guest->save();

        if($request->get('add_guests_for_reservations')?: 'no' === 'yes'){
            return redirect()->route('reservation.create')->with(['success' => true, 'message'=> 'Saved']);


        }
        return redirect()->route('guest.index')->with(['success' => true, 'message'=> 'Saved']);





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Guest  $guest
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \App\Models\Guest::destroy($id);
        return redirect('/guest')->with(['success' => true, 'message' => 'Deleted']);
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

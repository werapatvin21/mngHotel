<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Integer;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    protected $default_prefix = 'storage/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::query()
            ->where('users.id',Auth::user()->id)
            ->where('users.hotel_id',Auth::user()->hotel_id)
            ->get();
        return view('staff/list',compact('users'));
    }

    public function getStaffAll(Request $request) {
        $search = $request->get('search', null);
        $users = User::query()->orderBy('name')
            ->where('users.hotel_id',Auth::user()->hotel_id)
        ;
        if ($search) {
            $users->where(function($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%')
                    ->orWhere('staff_phone', 'like', '%'.$search.'%')
                    ->orWhere('staff_role', 'like', '%'.$search.'%');
            });
        }
        if(Auth::user()->staff_role === 'user'){
            $users->where('id',Auth::user()->id);
        }
        return Datatables::of($users)->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = new User();
        $detail = null;
        return view('staff/add',compact('data','detail'));
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
        return redirect('/staff')->with(['success'=> true, 'message'=> 'Saved']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request ,$id)
    {
        $data = User::find($id);
        $detail = $request->get('detail') ?: 0;
        return view('staff/add',compact('data','detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


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
        if(!$id){
            $users = new User;
        }else{
            $users = User::find($id);
        }

        $request->validate([
            'staff_pic' => 'mimes:jpeg,png',
//            'staff_file' => 'mimes:pdf,csv,txt',
        ],[
            'staff_pic.mimes' => 'รูปแบบไฟล์ไม่ถูกต้อง',
//            'staff_file.mimes' => 'รูปแบบไฟล์ไม่ถูกต้อง'
        ]);

        $request->validate([
            'email' => 'required|unique:users,email,'.($users->id  ?: 0)
        ]);
//        $request->validate([
//            'staff_file' => 'mimes:pdf,csv,txt'
//        ],[
////            'staff_file.required' => 'เตือน: กรุณาเลือกไฟล์เพิ่ออัพโหลด',
//            'staff_file.mimes' => 'รูปแบบไฟล์ไม่ถูกต้อง'
//        ]);
//        try {
            $users->name = $request->get('staff_name');
            $users->email = $request->get('email');
            $users->staff_username = $request->get('staff_username');

            if (!$id) {
                $users->password = Hash::make($request->get('password'));
            }

            $time = strtotime($request->get('staff_birth'));
            $staff_birth = date('Y-m-d',$time);
            $users->staff_birth = $staff_birth;
            $users->staff_age = (Integer) $request->get('staff_age');
            $users->staff_height = (Integer) $request->get('staff_height');
            $users->staff_weight = (Integer) $request->get('staff_weight');
            //        if($request->get('staff_role') === 'Reception'){
            //            $users->staff_role_reception =true;
            //        } else if ($request->get('staff_role') === 'Housekeeping') {
            //            $users->staff_role_housekeeping = true;
            //        } else if ($request->get('staff_role') === 'Food and Beverage') {
            //            $users->staff_role_food_and_beverage = true;
            //        }
            $users->department = $request->get('department');
            $users->staff_pos = $request->get('staff_pos');
            $users->staff_address = $request->get('staff_address');
            $users->staff_address2 = $request->get('staff_address2');
            $users->staff_address3 = $request->get('staff_address3');
            $users->staff_province = $request->get('staff_province');
            $users->staff_phone = (Integer) $request->get('staff_phone');
            $users->staff_status = $request->get('staff_status');
            $users->staff_previous_job = $request->get('staff_previous_job');


        $admin = $request->input('admin')?:false;
        if($admin === 'on'){
            $admin = true;
        }

        $user= $request->input('user')?:false;
        if($user === 'on'){
            $user = true;
        }

            if ($admin) {
//                $users->staff_role = $request->get('admin');
                $users->staff_role = $admin ?: false;
            }  else {
//                $users->staff_role = $request->get('user');
                $users->staff_role = $user ?: false;
            }

            //            $users->staff_pic = $request->get('staff_pic');
            //            $users->staff_file = $request->get('staff_file');

            if ($request->hasFile('staff_pic')) {
                $image = $request->file('staff_pic');
//                $image_name = rand() . time() . '.' . $image->getClientOriginalExtension();
//                $image->move(st_path('uploads/images'), $image_name);

                $response = $this->uploadFile($image, 'images', $image->getClientOriginalName());
                $users->staff_pic =  $response->path;
            }

            if ($request->hasFile('staff_file')) {
                $file = $request->file('staff_file');
//                $file_name = rand() . time() . '.' . $file->getClientOriginalExtension();
//                $file->move(public_path('uploads/files'), $file_name);
//                $users->staff_file = $file_name;

                $response = $this->uploadFile($file, 'file', $file->getClientOriginalName());
                $users->staff_file =  $response->path;

            }

            $users->staff_note = $request->get('staff_note');
            $users->hotel_id = Auth::user()->hotel_id;
//            dd($users);
            $users->save();

            return redirect('/staff')->with(['success'=> true, 'message'=> 'Saved']);
//            } else {
//                return \Redirect::back()->with(['success'=> false,'message'=> 'บันทึกข้อมูลไม่สำเร็จ']);
//            }


//        } catch (\Exception $e) {
//            return \Redirect::back()->with(['success'=> false,'message'=> 'บันทึกข้อมูลไม่สำเร็จ']);
//        }

    }

    public function updatePwd(Request $request, $id) {
        $users = User::find($id);
        if(auth()->user()->staff_role == 'admin') {
            $users->password = Hash::make($request->get('new_pwd'));
            $users->save();
            if($users->save()) {
                return \Redirect::back()->with(['success'=>true, 'message'=>'Password was changed successful']);
            } else {
                return \Redirect::back()->with(['success' => false, 'message' => 'Password was not changed']);
            }
        } else {
            if ($request->get('current_pwd')) {
                if (Hash::check($request->get('current_pwd'), $users->password)) {
                    $users->password = Hash::make($request->get('new_pwd'));
                    $users->save();
                    if ($users->save()) {
                        return \Redirect::back()->with(['success' => true, 'message' => 'Password was changed successful']);
                    } else {
                        return \Redirect::back()->with(['success' => false, 'message' => 'Change password']);
                    }
                } else {
                    return \Redirect::back()->with(['message' => 'Password is incorrect']);
                }
            }
        }

    }

    public function changePwd(Request $request) {
        $staff_id = $request->get('staff_id');
        $user = User::find($staff_id);
        return view('staff.changePwd')->with(['success'=>true, 'data'=>$user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if((int)$id === Auth::user()->id){
            return redirect('/staff')->with(['success' => false, 'message' => 'Unavailable remove self data']);
        }
        $users = User::find($id);
        if (auth()->user()->staff_role !== 'admin') {
            return redirect('/staff')->with(['success' => false, 'message' => 'No permission to remove this data']);
        }

        if($users->staff_pic) {
            Storage::delete('public/uploads/images/'.$users->staff_pic);
        }

        if($users->staff_pic) {
            Storage::delete('public/uploads/files/'.$users->staff_file);
        }

        $users->delete();
        return redirect('/staff')->with(['success' => true, 'message' => 'Deleted']);
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

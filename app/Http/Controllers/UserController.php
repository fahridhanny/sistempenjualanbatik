<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use SweetAlert;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        $user = User::where('id', auth()->user()->id)->first();
        $data = [
            'user' => $user
        ];
        return view('pages/customer/profile', $data);
    }
    public function ubahProfile(Request $request){
        $user = User::where('id', auth()->user()->id)->first();

        $user->name = $request->name;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;
        $user->negara_asal = $request->negara_asal;
        $user->save();

        return redirect('/profile');
    }
    public function editPassword(){
        return view('pages/customer/editPassword');
    }
    
    // admin
    
    public function profileAdmin(){
        $user = User::where('id', auth()->user()->id)->where('hak_akses', 1)->first();
        $data = [
            'user' => $user
        ];
        return view('pages/admin/profile', $data);
    }
    public function ubahProfileAdmin(Request $request){
        $user = User::where('id', auth()->user()->id)->where('hak_akses', 1)->first();

        $user->name = $request->name;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;
        $user->negara_asal = $request->negara_asal;
        $user->email = $request->email;
        $user->save();

        return redirect('/profile/admin');
    }
    public function user(){
        $user = User::where('hak_akses', 0)->paginate(5);
        $data = [
            'user' => $user
        ];
        return view('pages/admin/user', $data);
    }
    public function hapusUser($id){
        $user = User::where('id', $id)->first();
        $user->delete();
        
        return redirect('/user');
    }
}

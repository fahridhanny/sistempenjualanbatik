<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use SweetAlert;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPassword;

class UserController extends Controller
{
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
        $id = base64_decode($id);

        $user = User::where('id', $id)->first();
        if($user){
            $user->delete();
            return redirect('/user');
        }else{
            return redirect('/');
        }
    }
    public function resetPassword(){
        return view('auth/passwords/email');
    }
    public function gantiPassword($id){
        $id = base64_decode($id);
        
        $user = User::where('id', $id)->first();
        if($user){
            $data = [
                'user' => $user
            ];
            return view('auth/passwords/reset', $data);
        }else{
            return redirect('login');
        }
    }
    public function kirimEmail(Request $request){
        $this->validate($request, [
            'email' => ['required']
        ],[
            'email.required' => 'email tidak boleh kosong'
        ]);

        $user = User::where('email', $request->email)->first();
        if($user){
            Mail::to($user->email)->send(new ResetPassword($user));
            return redirect('/resetPassword');
        }else{
            return redirect('/resetPassword');
        }

    }
    public function ubahPassword($id, Request $request){
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ],[
            'password.required' => 'password tidak boleh kosong',
            'password.confirmed' => 'password tidak sama'
        ]);

        $id_user = base64_decode($id);
        $user = User::where('id', $id_user)->first();
        if($user){
            $user->password = Hash::make($request->password);
            $user->save();
            return redirect('login');        
        }else{
            return redirect('/gantiPassword/'+$id);
        }
    }
}

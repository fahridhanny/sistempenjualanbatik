<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Product;
use App\Models\Ukuran;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $manProduct = Product::where('id_category', 1)->get();
        $womenProduct = Product::where('id_category', 2)->get();
        $kidsProduct = Product::where('id_category', 3)->get();
        $data = [
            'manProduct' => $manProduct,
            'womenProduct' => $womenProduct,
            'kidsProduct' => $kidsProduct
        ];
        return view('pages/customer/home', $data);
    }
    public function categoriesMan(){
        $manProduct = Product::where('id_category', 1)->get();
        $data = [
            'manProduct' => $manProduct
        ];
        return view('pages/customer/man', $data);
    }
    public function categoriesWoman(){
        $womenProduct = Product::where('id_category', 2)->get();
        $data = [
            'womenProduct' => $womenProduct
        ];
        return view('pages/customer/woman', $data);
    }
    public function categoriesKids(){
        $kidsProduct = Product::where('id_category', 3)->get();
        $data = [
            'kidsProduct' => $kidsProduct
        ];
        return view('pages/customer/kids', $data);
    }
    public function about(){
        return view('pages/customer/about');
    }

    // admin
    public function dashboard(){
        $pesanan_detail = PesananDetail::get();
        $product = Product::get();
        $user = User::where('hak_akses', 0)->get();
        
        $data = [
            'pesanan_detail' => $pesanan_detail,
            'product' => $product,
            'user' => $user
        ];

        return view('pages/admin/dashboard', $data);
    }
}

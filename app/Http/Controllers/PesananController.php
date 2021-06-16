<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Product;
use App\Models\Ukuran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;
use RealRashid\SweetAlert\Facades\Alert;

class PesananController extends Controller
{
    public function getPesanan(){
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        
        if(empty($pesanan)){
            return redirect('/');
        }

        if (!empty($pesanan)) {
            $pesanan_detail = PesananDetail::join('pesanans', 'pesanan_details.pesanan_id', '=', 'pesanans.id')
                                            ->join('products', 'pesanan_details.product_id', '=', 'products.id')
                                            ->where('pesanan_id', $pesanan->id)
                                            ->get();
            $data = [
                'pesanan_detail' => $pesanan_detail,
                'pesanan' => $pesanan
            ];
            return view('pages/customer/cart', $data);
        }

        return view('pages/customer/cart');
    }

    public function pesananDetail($id){
        $product = Product::where('id', $id)->first();
        $ukuran = Ukuran::where('id_product', $product->id)->get();
        $data = [
            'product' => $product,
            'ukuran' => $ukuran,
        ];
        return view('pages/customer/pesananDetail', $data);
    }
    public function pesanan(Request $request, $id){

        $tanggal = Carbon::now();
        $product = Product::where('id', $id)->first();
        $ukuran = Ukuran::where('id_product', $id)->where('ukuran', $request->ukuran)->first();
        $cek_pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();

        // validasi ukuran tidak boleh kosong
        if($request->ukuran == ""){
            return redirect('/pesanan/detail/'.$id);   
        }
        
        // validasi jumlah pesanan tidak boleh lebih dari stok
        if($request->jumlah_pesanan > $ukuran->stok){
            return redirect('/pesanan/detail/'.$id);
        }

        // validasi 1 pesanan bisa membeli banyak produk
        if(empty($cek_pesanan)){
            $pesanan = new Pesanan();
            $pesanan->user_id = auth()->user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0;
            $pesanan->total_harga = 0;
            $pesanan->save();
        }

        $cek_pesanan2 = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $cek_pesanan_detail = PesananDetail::where('pesanan_id', $cek_pesanan2->id)
                                            ->where('product_id', $id)
                                            ->where('ukuran', $request->ukuran)->first();
        // validasi jika memesan produk yang sama 
        if(empty($cek_pesanan_detail)){
            $pesanan_detail = new PesananDetail();
            $pesanan_detail->pesanan_id = $cek_pesanan2->id;
            $pesanan_detail->product_id = $id;
            $pesanan_detail->ukuran = $request->ukuran;
            $pesanan_detail->jumlah = $request->jumlah_pesanan;
            $pesanan_detail->jumlah_harga = $product->harga * $request->jumlah_pesanan;
            $pesanan_detail->save();
        }else{
            $cek_pesanan_detail->jumlah = $cek_pesanan_detail->jumlah + $request->jumlah_pesanan;
            $cek_pesanan_detail->jumlah_harga = $cek_pesanan_detail->jumlah_harga + ($product->harga * $request->jumlah_pesanan);
            $cek_pesanan_detail->save();
        }
        // update total harga di pesanan
        $cek_pesanan2->total_harga = $cek_pesanan2->total_harga + ($product->harga * $request->jumlah_pesanan);
        $cek_pesanan2->save();

        return redirect('/pesanan');
    }
    public function pesananHapus($product_id, $ukuran){
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->where('product_id', $product_id)->where("ukuran", $ukuran)->first();
    
        $pesanan_detail->delete();

        $jumlah_pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get()->sum("jumlah_harga");
        $pesanan->total_harga = $jumlah_pesanan_detail;
        
        $pesanan->save();

        $pesanan_true = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        if(count($pesanan_true) == 0){
            $pesanan->delete();
            return redirect('/');    
        }

        return redirect('/pesanan');
    }
    public function mengambilDataUkuranById($id, $ukuran){
        $product = Product::where('id', $id)->first();
        $ukuran = Ukuran::where('id_product', $product->id)->where('ukuran', $ukuran)->first();

        return response()->json([
            'ukuran' => $ukuran->stok
        ], 200);
    }
    public function checkoutProduct(Request $request){
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
        
        // untuk menampilkan array pesanan detail
        foreach ($pesanan_detail as $item ) {
            $product = Product::where('id', $item->product_id)->get();
            // untuk menampilkan array product
            foreach ($product as $value) {
                $product_id = $item->product_id;
                $ukuran = $item->ukuran;
                $item->jumlah = $request->input("jumlah-$product_id-$ukuran");
                $item->jumlah_harga = $value->harga * $request->input("jumlah-$product_id-$ukuran");
                $item->save();
            }
        }
        // update total harga di pesanan
        $jumlah_pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get()->sum('jumlah_harga');
        $pesanan->total_harga = $jumlah_pesanan_detail;
        $pesanan->save();

        return redirect('/checkout');
    }
    public function checkout(){
        $user = User::where('id', auth()->user()->id)->first();
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        
        if(empty($pesanan)){
            return redirect('/');
        }
        
        if(!empty($pesanan)){
            $data = [
                'user' => $user,
                'pesanan' => $pesanan
            ];
            return view('pages/customer/checkout', $data);
        }
    }
    public function buatPesanan(Request $request){
        $user = User::where('id', auth()->user()->id)->first();
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        foreach ($pesanan_detail as $item) {
            $ukuran = Ukuran::where('id_product', $item->product_id)->where('ukuran', $item->ukuran)->get();
            foreach ($ukuran as $data) {
                $data->stok = $data->stok - $item->jumlah;
                $data->save();
            }
        }

        if(empty($request->all())){
            return redirect('/checkout');
        }

        $user->name = $request->name;
        $user->alamat = $request->alamat;
        $user->no_telp = $request->no_telp;
        $user->negara_asal = $request->negara_asal;
        $user->save();

        $pesanan->status = 1;
        $pesanan->save();

        return redirect('/');
    }
}

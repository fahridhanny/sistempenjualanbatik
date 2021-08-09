<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Product;
use App\Models\Ukuran;
use App\Models\User;
use App\Models\Provinsi;
use App\Models\Kota;
use App\Models\Kurir;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;
use RealRashid\SweetAlert\Facades\Alert;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Illuminate\Support\Facades\Hash;

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
        $id = base64_decode($id);
        $product = Product::where('id', $id)->first();
        if($product){
            $ukuran = Ukuran::where('id_product', $product->id)->get();
            $data = [
                'product' => $product,
                'ukuran' => $ukuran,
            ];
            return view('pages/customer/pesananDetail', $data);
        }else{
            return redirect('/');
        }
    }
    public function pesanan(Request $request, $id){
        $id = base64_decode($id);

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
        $product_id = base64_decode($product_id);
        $ukuran = base64_decode($ukuran);
        
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
        $pesanan_detail = PesananDetail::join('products', 'pesanan_details.product_id', '=', 'products.id')
                                        ->where('pesanan_id', $pesanan->id)->get();
        $kurir = Kurir::all();

        if(empty($pesanan)){
            return redirect('/');
        }
        
        if(!empty($pesanan)){

            $data = [
                'user' => $user,
                'pesanan' => $pesanan,
                'pesanan_detail' => $pesanan_detail,
                'kurir' => $kurir,
            ];
            return view('pages/customer/checkout', $data);
        }
    }
    public function cekOngkir($id){

        if($id == "0"){
            return response()->json([
                'message' => 'id yang dicari tidak ada'
            ], 200);    
        }else{
            $user = User::where('id', auth()->user()->id)->first();
            $admin = User::where('hak_akses', 1)->first();
            $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
            $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();
            $berat = count($pesanan_detail) * 1000;

            $kurir = Kurir::where('id', $id)->first();

            $ongkir = RajaOngkir::ongkosKirim([
                    'origin'        => $admin->kota,     // ID kota/kabupaten asal
                    'destination'   => $user->kota,      // ID kota/kabupaten tujuan
                    'weight'        => $berat,    // berat barang dalam gram
                    'courier'       => $kurir->code    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
            ])->get();

            $simpanPesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
            $simpanPesanan->total_ongkir = $ongkir[0]["costs"][0]["cost"][0]["value"];
            $simpanPesanan->total_pesanan = $pesanan->total_harga + $ongkir[0]["costs"][0]["cost"][0]["value"];
            $simpanPesanan->kurir = $kurir->id;
            $simpanPesanan->save(); 

            return response()->json([
                'pesanan' => $pesanan,
                'ongkir'  => $ongkir[0]["costs"][0]["cost"][0]["value"]
            ], 200);
        }
    }
    public function buatPesanan(){
        
        $cekPesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        if (empty($cekPesanan->total_ongkir) && empty($cekPesanan->total_pesanan)) {
            return redirect('/checkout');
        }
        $cekPesanan_02 = Pesanan::where('user_id', auth()->user()->id)->where('status', 1)->first();
        if (empty($cekPesanan) && empty($cekPesanan_02)) {
            return redirect('/checkout');
        }

        $user = User::where('id', auth()->user()->id)->first();
        $admin = User::where('hak_akses', 1)->first();
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
        $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();

        //Set Your server key
        \Midtrans\Config::$serverKey = "SB-Mid-server-aNfjAA_qK6v0IleYdwZ43BJu";

        // Required
        $transaction_details = array(
            'order_id' => $pesanan->id.time(),
            'gross_amount' => $pesanan->total_pesanan, // no decimal allowed for creditcard
        );

        // Optional
        $billing_address = array(
            'first_name'    => "Sdr, ",
            'last_name'     => $user->name,
            'address'       => $user->alamat,
            'city'          => $user->kota,
            'phone'         => $user->no_telp,
            'country_code'  => 'IDN'
        );

        // Optional
        $shipping_address = array(
            'first_name'    => "Sdr, ",
            'last_name'     => $admin->name,
            'address'       => $admin->alamat,
            'city'          => $admin->kota,
            'phone'         => $admin->no_telp,
            'country_code'  => 'IDN'
        );

        // Optional
        $customer_details = array(
            'first_name'    => "Sdr, ",
            'last_name'     => $user->name,
            'email'         => $user->email,
            'phone'         => $user->no_telp,
            'billing_address'  => $billing_address,
            'shipping_address' => $shipping_address
        );

        // Fill SNAP API parameter
        $params = array(
            'transaction_details' => $transaction_details,
            'customer_details' => $customer_details,
        );

        try {
            // Get Snap Payment Page URL
            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
            
            // Redirect to Snap Payment Page
            return redirect($paymentUrl);
        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function notification(Request $request){
        $payload = $request->getContent();
        $notif = json_decode($payload);

        $transaction = $notif->transaction_status;

        $id_pesanan = substr($notif->order_id, 0, 2);

        if ($transaction == 'capture') {

            $transaksi = new Transaksi();
            $transaksi->id_order = $notif->order_id;
            $transaksi->total_bayar = $notif->gross_amount;
            $transaksi->type_pembayaran = $notif->payment_type;
            $transaksi->status_transaksi = $transaction;
            $transaksi->tgl_transaksi = $notif->transaction_time;
            $transaksi->save();

            $pesanan = Pesanan::where('id', $id_pesanan)->where('status', 0)->first();
            $pesanan->id_transaksi = $notif->order_id;
            $pesanan->status = 1;
            $pesanan->save();
        }
        else if ($transaction == 'pending') {

            $transaksi = new Transaksi();
            $transaksi->id_order = $notif->order_id;
            $transaksi->total_bayar = $notif->gross_amount;
            $transaksi->type_pembayaran = $notif->payment_type;
            $transaksi->status_transaksi = $transaction;
            $transaksi->tgl_transaksi = $notif->transaction_time;
            $transaksi->save();

            $pesanan = Pesanan::where('id', $id_pesanan)->where('status', 0)->first();
            $pesanan->id_transaksi = $notif->order_id;
            $pesanan->status = 1;
            $pesanan->save();
        }
        else if ($transaction == 'expire') {

            $pesanan = Pesanan::where('id', $id_pesanan)->where('status', 1)->first();
            $pesanan->id_transaksi = null;
            $pesanan->status = 0;
            $pesanan->save();

            $transaksi = Transaksi::where('id_order', $notif->order_id)->first();
            $transaksi->delete();

            //Set Your server key
            \Midtrans\Config::$serverKey = "SB-Mid-server-aNfjAA_qK6v0IleYdwZ43BJu";

            \Midtrans\Transaction::cancel($notif->order_id);
        }
        else if ($transaction == 'settlement') {

            $pesanan = Pesanan::where('id', $id_pesanan)->where('status', 1)->first();
            $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)->get();

            foreach ($pesanan_detail as $item) {
                $ukuran = Ukuran::where('id_product', $item->product_id)->where('ukuran', $item->ukuran)->get();
                foreach ($ukuran as $data) {
                    $data->stok = $data->stok - $item->jumlah;
                    $data->save();
                }
            }

            $transaksi = Transaksi::where('id_order', $notif->order_id)->first();
            $transaksi->status_transaksi = $transaction;
            $transaksi->tgl_transaksi = $notif->transaction_time;
            $transaksi->save();

            $pesanan_transaksi = Pesanan::where('id', $id_pesanan)->where('status', 1)->first();
            $pesanan_transaksi->status = 2;
            $pesanan_transaksi->save();
        }
    }
    public function finish(Request $request){
        $transaction = $request->query('transaction_status');
        $status = $request->query('status_code');
        $order_id = $request->query('order_id');

        $pesanan = Pesanan::where('id_transaksi', $order_id)->first();
        if ($pesanan) {
            return redirect('/');
        }   
    }
    public function unfinish(Request $request){
        $transaction = $request->query('transaction_status');
        $status = $request->query('status_code');
        $order_id = $request->query('order_id');

        $pesanan = Pesanan::where('id_transaksi', $order_id)->first();
        if (!$pesanan) {
            return redirect('/');
        }   
    }
    public function error(Request $request){
        $transaction = $request->query('transaction_status');
        $status = $request->query('status_code');
        $order_id = $request->query('order_id');

        $pesanan = Pesanan::where('id_transaksi', $order_id)->first();
        if (!$pesanan) {
            return redirect('/');
        }   
    }
    public function cancel($id){
        
        $pesanan_id = substr($id, 0, 2);

        $pesanan = Pesanan::where('id', $pesanan_id)->where('status', 1)->first();
        if ($pesanan) {
            $pesanan->id_transaksi = null;
            $pesanan->status = 0;
            $pesanan->save();

            $transaksi = Transaksi::where('id_order', $id)->first();
            $transaksi->delete();

            // hapus transaksi di midtrans
            \Midtrans\Config::$serverKey = "SB-Mid-server-aNfjAA_qK6v0IleYdwZ43BJu";
            \Midtrans\Transaction::cancel($id);

            return redirect('/');
        }else{
            return redirect('/transaksi');
        }
    }
    public function transaksi(){
        $pesanan = Pesanan::where('user_id', auth()->user()->id)->where('status', 1)->first();
        if ($pesanan) {
            $transaksi = Transaksi::where('id_order', $pesanan->id_transaksi)->first();
            $data = [
                'pesanan' => $pesanan,
                'transaksi' => $transaksi
            ];
            return view('pages/customer/transaksi', $data);
        }else{
            return redirect('/');
        }
    }
}

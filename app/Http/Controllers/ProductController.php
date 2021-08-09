<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use App\Models\Product;
use App\Models\Ukuran;
use ArrayIterator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MultipleIterator;

class ProductController extends Controller
{
    public function product(){
        $ukuran = Product::join('ukurans', 'ukurans.id_product', '=', 'products.id')
                            ->join('categories', 'products.id_category', '=' , 'categories.id')    
                            ->paginate(5);
        $data = [
            'products' => $ukuran
        ];
        return view('pages/admin/product', $data);
    }
    public function tambahProduct(){
        $category = Category::all();
        $data = [
            'category' => $category
        ];
        return view('pages/admin/tambah_product', $data);
    }
    public function prosesTambahProduct(Request $request){
    
        $namaProduct = Product::where('nama_product', $request->nama_product)->first();
        if ($namaProduct) {
            return redirect('/tambah/product');
        }

        $gambar = $request->gambar;
        $gambarName = $request->nama_product.'.'.$gambar->extension();
        $gambar->move(public_path('assets/frontend/images'), $gambarName);

        $product = new Product();
        $product->nama_product = $request->nama_product;
        $product->id_category = $request->id_category;
        $product->harga = $request->harga;
        $product->desk = $request->desk;
        $product->gambar = $gambarName;
        $product->save();
        
        $ukuran = $request->ukuran;
        $stok = $request->stok;
        $ukuranDanStok = new MultipleIterator();
        $ukuranDanStok->attachIterator(new ArrayIterator($ukuran));
        $ukuranDanStok->attachIterator(new ArrayIterator($stok));
        
        foreach ($ukuranDanStok as $value) {
            list($ukuran, $stok) = $value;
            $productUkuran = new Ukuran();
            $newProduct = Product::where('nama_product', $request->nama_product)->first();
            $productUkuran->id_product = $newProduct->id;
            $productUkuran->ukuran = $ukuran;
            $productUkuran->stok = $stok;
            $productUkuran->save();
        }

        return redirect('/product');
    }
    public function editProduct($nama_product, $ukuran){
        $nama_product = base64_decode($nama_product);
        $ukuran = base64_decode($ukuran);

        $product = Product::where('nama_product', $nama_product)->first();
        if($product){
            $ukuran = Ukuran::where('id_product', $product->id)->where('ukuran', $ukuran)->first();
            if($ukuran){
                $category = Category::all();
                $data = [
                    'product' => $product,
                    'ukuran' => $ukuran,
                    'category' => $category
                ];
                return view('pages/admin/edit_product', $data);
            }else{
                return redirect('/dashboard');
            }
        }else{
            return redirect('/dashboard');
        }
    }
    public function prosesEditProduct($id, $ukuran, Request $request){
        $id = base64_decode($id);
        $ukuran = base64_decode($ukuran);

        $product = Product::where('id', $id)->first();
        if($product){
            $dataUkuran = Ukuran::where('id_product', $product->id)->where('ukuran', $ukuran)->first();
            if ($dataUkuran) {
                if (empty($request->file("gambar"))) {
                    $product = Product::where('id', $id)->first();
                    $product->nama_product = $request->nama_product ? $request->nama_product : $product->nama_product;
                    $product->id_category = $request->id_category ? $request->id_category : $product->id_category;
                    $product->desk = $request->desk ? $request->desk : $product->desk;
                    $product->berat = $request->berat ? $request->berat : $product->berat;
                    $product->harga = $request->harga ? $request->harga : $product->harga;
                    $product->save();
                }else{
                    $product = Product::where('id', $id)->first();

                    $gambar = $request->gambar ? $request->gambar : $produc->gambar;
                    $gambarName = $request->nama_product.'.'.$gambar->extension();
                    $gambar->move(public_path('assets/frontend/images'), $gambarName);

                    $product->nama_product = $request->nama_product ? $request->nama_product : $product->nama_product;
                    $product->id_category = $request->id_category ? $request->id_category : $product->id_category;
                    $product->desk = $request->desk ? $request->desk : $product->desk;
                    $product->berat = $request->berat ? $request->berat : $product->berat;
                    $product->harga = $request->harga ? $request->harga : $product->harga;
                    $product->gambar = $gambarName;
                    $product->save();
                }
                
                $productUkuran = Ukuran::where('id_product', $id)->where('ukuran', $ukuran)->first();
                $productUkuran->ukuran = $request->ukuran;
                $productUkuran->stok = $request->stok;
                $productUkuran->save();

                return redirect('/product');       
            }else{
                return redirect('/dashboard');
            }
        }else{
            return redirect('/dashboard');
        }
    }
    public function hapusProduct($nama_product, $ukuran){
        $nama_product = base64_decode($nama_product);
        $ukuran = base64_decode($ukuran);

        $product = Product::where('nama_product', $nama_product)->first();
        if($product){
            $dataUkuran = Ukuran::where('id_product', $product->id)->where('ukuran', $ukuran)->first();
            if($dataUkuran){
                $pesanans = Pesanan::where('status', 0)->get();
                foreach ($pesanans as $pesanan) {
                    $pesanan_detail = PesananDetail::where('pesanan_id', $pesanan->id)
                                                ->where('product_id', $product->id)
                                                ->where('ukuran', $ukuran)->get();
                    if($pesanan_detail){
                        foreach ($pesanan_detail as $value) {
                            $value->delete();
                        }
                    }
                    
                }
                $deleteUkuran = Ukuran::where('id_product', $product->id)->where('ukuran', $ukuran)->first();
                $deleteUkuran->delete();

                return redirect('/product');
            }else{
                return redirect('/dashboard');    
            }
        }else{
            return redirect('/dashboard');
        }
    }
}

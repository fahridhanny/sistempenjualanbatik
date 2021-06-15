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
    public function __construct()
    {
        $this->middleware('auth');
    }

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
        $product = Product::where('nama_product', $nama_product)->first();
        $ukuran = Ukuran::where('id_product', $product->id)->where('ukuran', $ukuran)->first();
        $category = Category::all();
        $data = [
            'product' => $product,
            'ukuran' => $ukuran,
            'category' => $category
        ];
        return view('pages/admin/edit_product', $data);
    }
    public function prosesEditProduct($id, $ukuran, Request $request){
        
        if (empty($request->gambar)) {
            $product = Product::where('id', $id)->first();
            $product->nama_product = $request->nama_product;
            $product->id_category = $request->id_category;
            $product->harga = $request->harga;
            $product->save();
        }else{
            
            $gambar = $request->gambar;
            $gambarName = $request->nama_product.'.'.$gambar->extension();
            $gambar->move(public_path('assets/frontend/images'), $gambarName);

            $product = Product::where('id', $id)->first();
            $product->nama_product = $request->nama_product;
            $product->id_category = $request->id_category;
            $product->harga = $request->harga;
            $product->gambar = $gambarName;
            $product->save();
        }
        
        $productUkuran = Ukuran::where('id_product', $id)->where('ukuran', $ukuran)->first();
        $productUkuran->ukuran = $request->ukuran;
        $productUkuran->stok = $request->stok;
        $productUkuran->save();

        return redirect('/product');
    }
    public function hapusProduct($nama_product, $ukuran){

        $product = Product::where('nama_product', $nama_product)->first();

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

        $ukuran = Ukuran::where('id_product', $product->id)->where('ukuran', $ukuran)->first();
        $ukuran->delete();

        return redirect('/product');
    }
}

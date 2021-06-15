@extends('base/customer/index')

@section('content')
<!-- Breadcrumbs -->
<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <ul class="bread-list">
                        <li><a href="index1.html">Home<i class="ti-arrow-right"></i></a></li>
                        <li class="active"><a href="blog-single.html">Cart</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
        
<!-- Shopping Cart -->
<div class="shopping-cart section">
    <div class="container">
        <form action="/checkout/product" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead>
                        <tr class="main-hading">
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Ukuran</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Jumlah Harga</th> 
                            <th class="text-center"><i class="ti-trash remove-icon"></i></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($pesanan))
                        @foreach ($pesanan_detail as $item)
                        <tr>
                            <td class="image" data-title="No"><img src="{{ url('assets/frontend/images/'.$item->gambar) }}" alt="#"></td>
                            <td class="product-des" data-title="Description">
                                <p class="product-name"><a href="#">{{ $item->nama_product }}</a></p>
                                <p class="product-des">{{ $item->desk }}</p>
                            </td>
                            <td class="image" data-title="No"><p class="product-des">{{ $item->ukuran }}</p></td>
                            <td class="qty" data-title="Qty"><!-- Input Order -->
                                <div class="input-group">
                                    <div class="button minus">
                                        <button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="jumlah-{{ $item->product_id }}-{{ $item->ukuran }}">
                                            <i class="ti-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="jumlah-{{ $item->product_id }}-{{ $item->ukuran }}" class="input-number"  data-min="1" data-max="100" value="{{ $item->jumlah }}">
                                    <div class="button plus">
                                        <button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="jumlah-{{ $item->product_id }}-{{ $item->ukuran }}">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                <!--/ End Input Order -->
                            </td>
                            <td class="total-amount" data-title="Total"><span>Rp. {{ number_format($item->jumlah_harga) }}</span></td>
                            <td class="action" data-title="Remove"><a href="/pesanan/detail/hapus/{{ $item->product_id }}/{{ $item->ukuran }}"><i class="ti-trash remove-icon"></i></a></td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Total Amount -->
                <div class="total-amount">
                    <div class="row">
                        <div class="col-lg-8 col-md-5 col-12">
                            <div class="left">
                                
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-7 col-12">
                            <div class="right">
                                @if (!empty($pesanan))
                                <ul>
                                    <li>Total Harga<span>Rp. {{ number_format($pesanan->total_harga) }}</span></li>
                                    <li class="last"><span></span></li>
                                    <li><button type="submit" class="btn btn-primary">Checkout</button></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!--/ End Total Amount -->
            </div>
        </div>
        </form>
    </div>
</div>
<!--/ End Shopping Cart -->
@endsection
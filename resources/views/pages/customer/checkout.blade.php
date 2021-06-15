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
                        <li class="active"><a href="blog-single.html">Checkout</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Breadcrumbs -->
        
<!-- Start Checkout -->
<section class="shop checkout section">
    <div class="container">
        <form class="form" method="POST" action="/buatPesanan">
        @csrf 
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="checkout-form">
                    <h2>Checkout</h2>
                    <p>Silahkan mengisi biodata terlebih dahulu sebelum membuat pesanan</p>
                    <!-- Form -->
                    
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Full Name<span>*</span></label>
                                    <input type="text" name="name" placeholder="" required="required" value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Alamat<span>*</span></label>
                                    <input type="text" name="alamat" placeholder="" required="required" value="{{ $user->alamat }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>No Telp<span>*</span></label>
                                    <input type="number" name="no_telp" placeholder="" required="required" value="{{ $user->no_telp }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Negara Asal<span>*</span></label>
                                    <input type="text" name="negara_asal" placeholder="" required="required" value="{{ $user->negara_asal }}">
                                </div>
                            </div>
                        </div>
                    
                    <!--/ End Form -->
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <div class="order-details">
                    <!-- Order Widget -->
                    <div class="single-widget">
                        <h2>CART TOTALS</h2>
                        <div class="content">
                            @if (!empty($pesanan))
                            <?php $admin = 2500 ?>
                            <ul>
                                <li>Total Harga<span>Rp. {{ number_format($pesanan->total_harga) }}</span></li>
                                <li>Biaya Admin<span>Rp. {{ number_format($admin) }}</span></li>
                                <li class="last">Total Pembayaran<span>Rp. {{ number_format($pesanan->total_harga + $admin) }}</span></li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    <!--/ End Order Widget -->
                    <!-- Button Widget -->
                    <div class="single-widget get-button">
                        <div class="content">
                            <div class="button">
                                <button type="submit" class="btn">Buat Pesanan</button>
                            </div>
                        </div>
                    </div>
                    <!--/ End Button Widget -->
                </div>
            </div>
        </div>
        </form>
    </div>
</section>
<!--/ End Checkout -->
@endsection
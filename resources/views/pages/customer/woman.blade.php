@extends('base/customer/index')

@section('content')
<!-- Slider Area -->
<section class="hero-slider">
    <!-- Single Slider -->
    <img src="{{url ('assets/frontend/images/banner.jpg') }}" alt="logo" width="100%">
    <!--/ End Single Slider -->
</section>
<!--/ End Slider Area -->

<!-- Start Product Area -->
<div class="product-area section">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Woman</h2>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach($womenProduct as $data)
            <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                <div class="single-product">
                    <div class="product-img">
                        <a href="/pesanan/detail/{{ $data->id }}">
                            <img class="default-img" src="{{ url('assets/frontend/images/'.$data->gambar) }}" 
                            alt="{{ $data->nama_product }}" style="height: 270px;">
                        </a>
                    </div>
                    <div class="product-content">
                        <h3><a href="/pesanan/detail/{{ $data->id }}">{{ $data->nama_product }}</a></h3>
                        <div class="product-price">
                            <span>Rp. {{ number_format($data->harga) }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- End Product Area -->
@endsection
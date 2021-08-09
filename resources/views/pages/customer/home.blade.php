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
                    <h2>Category</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="product-info">
                    <div class="nav-main">
                        <!-- Tab Nav -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#man" role="tab">Man</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#women" role="tab">Woman</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#kids" role="tab">Kids</a></li>
                        </ul>
                        <!--/ End Tab Nav -->
                    </div>
                    <div class="tab-content" id="myTabContent">
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade show active" id="man" role="tabpanel">
                            <div class="tab-single">
                                <div class="row">
                                    @foreach($manProduct as $data)
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <?php $dataProduct = base64_encode($data->id) ?>
                                                <a href="/pesanan/detail/{{ $dataProduct }}">
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
                        <!--/ End Single Tab -->
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade" id="women" role="tabpanel">
                            <div class="tab-single">
                                <div class="row">
                                    @foreach($womenProduct as $data)
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <?php $dataProduct = base64_encode($data->id) ?>
                                                <a href="/pesanan/detail/{{ $dataProduct }}">
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
                        <!--/ End Single Tab -->
                        <!-- Start Single Tab -->
                        <div class="tab-pane fade" id="kids" role="tabpanel">
                            <div class="tab-single">
                                <div class="row">
                                    @foreach($kidsProduct as $data)
                                    <div class="col-xl-3 col-lg-4 col-md-4 col-12">
                                        <div class="single-product">
                                            <div class="product-img">
                                                <?php $dataProduct = base64_encode($data->id) ?>
                                                <a href="/pesanan/detail/{{ $dataProduct }}">
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
                        <!--/ End Single Tab -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Product Area -->
@endsection
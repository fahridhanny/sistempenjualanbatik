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
                        <li class="active"><a href="#">Profile</a></li>
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
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="checkout-form">
                    <h2 class="mb-5">Profile</h2>
                    <!-- Form -->
                    <form class="form" method="POST" action="/ubahProfile">
                        @csrf 
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
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col">
                                
                            </div>
                            <div class="col-4">
                                {{-- <a href="/edit/password" class="btn bg-olive btn-block text-center text-white">Ganti Password</a> --}}
                                <button type="submit" class="btn bg-olive btn-block mt-5" style="padding-top:18px; padding-bottom:18px; ">Simpan</button>
                            </div>
                        </div>
                    </form>
                    <!--/ End Form -->
                </div>
            </div>
        </div>
    </div>
</section>
<!--/ End Checkout -->
@endsection
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
        <div class="row">
            <div class="col-lg-8 col-12">
                <div class="checkout-form">
                    <h2>Checkout</h2>
                    <p>Silahkan mengisi biodata terlebih dahulu sebelum membuat pesanan</p>
                    <!-- Form -->
                    <form class="form">
                        {{-- @csrf  --}}
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Full Name<span>*</span></label>
                                    <input type="text" name="name" placeholder="" required="required" value="{{ $user->name }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Alamat<span>*</span></label>
                                    <input type="text" name="alamat" placeholder="" required="required" value="{{ $user->alamat }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>No Telp<span>*</span></label>
                                    <input type="number" name="no_telp" placeholder="" required="required" value="{{ $user->no_telp }}" disabled>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <label>Negara Asal<span>*</span></label>
                                    <input type="text" name="negara_asal" placeholder="" required="required" value="{{ $user->negara_asal }}" disabled>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!--/ End Form -->
                    <a href="/profile" class="btn" style="color: white;">Isi Biodata</a>
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
                                <li>Total Harga<span>Rp.{{ $pesanan->total_harga }}</span></li>
                                <li>Total Ongkir<span>Rp.<span id="total_ongkir">0</span></span>
                                </li>
                                <li class="last">Total Pembayaran<span>Rp.<span id="total_pemesanan">0</span></span></li>
                            </ul>
                            @endif
                        </div>
                    </div>
                    <!--/ End Order Widget -->
                    <!-- Button Widget -->
                    <div class="single-widget get-button">
                        <div class="content">
                            <div class="button">
                                <a href="/buatPesanan" class="btn" style="color: white;">Buat Pesanan</a>
                            </div>
                        </div>
                    </div>
                    <!--/ End Button Widget -->
                </div>
            </div>
        </div>
        <div class="row mt-4">
        <div class="col-lg-8 col-12">
            <div class="checkout-form">
                    <h2>Pilih Kurir</h2>
                    <!-- Form -->
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <select class="form-select" id="kurir" 
                                    onchange="changeValue()">
                                      <option value="0" selected>--- Pilih Kurir ---</option>
                                      @foreach ($kurir as $data_kurir)
                                        <option value="{{ $data_kurir->id }}">{{ $data_kurir->nama_kurir }}</option>
                                      @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    <!--/ End Form -->
            </div>
        </div>
        </div>
        <div class="row mt-4">
        <div class="col-lg-8 col-12">
        <!-- Shopping Summery -->
                <table class="table shopping-summery">
                    <thead class="thead-dark">
                        <tr class="main-hading">
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Ukuran</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Jumlah Harga</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @if (!empty($pesanan))
                        @foreach ($pesanan_detail as $item)
                        <tr>
                            <td class="image" data-title="No">
                                <img src="{{ url('assets/frontend/images/'.$item->gambar) }}" alt="#">
                            </td>
                            <td class="product-des" data-title="Description">
                                <p class="product-name"><a href="#">{{ $item->nama_product }}</a></p>
                                <p class="product-des">{{ $item->desk }}</p>
                            </td>
                            <td class="image" data-title="No">
                                <p class="product-des">{{ $item->ukuran }}</p>
                            </td>
                            <td class="qty" data-title="Qty">
                                <span>{{ $item->jumlah }}</span>
                            </td>
                            <td class="total-amount" data-title="Total">
                                <span>Rp. {{ number_format($item->jumlah_harga) }}</span>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
                <!--/ End Shopping Summery -->
            </div>
            </div>
    </div>
</section>
<!--/ End Checkout -->
        <script type="text/javascript">

        function changeValue(){
            var kurir = $('#kurir').val();

            $.ajax({
                url: '/cekOngkir/'+kurir
            }).success(function(data){
                $('#total_ongkir').html(data.ongkir);
                var total_pemesanan = data.pesanan.total_harga + data.ongkir; 
                $('#total_pemesanan').html(total_pemesanan);
            });
        }
        </script> 
@endsection
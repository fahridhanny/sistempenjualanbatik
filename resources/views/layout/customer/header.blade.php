<!-- Preloader -->
<div class="preloader">
    <div class="preloader-inner">
        <div class="preloader-icon">
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- End Preloader -->


<!-- Header -->
<header class="header shop">
    <div class="middle-inner">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-12">
                    <!-- Logo -->
                    <div>
                        <a href="/"><img src="{{url ('assets/frontend/images/logo_batik.png') }}" alt="logo" width="120" height="32"></a>
                    </div>
                    <!--/ End Logo -->
                </div>
                <div class="col-lg-8 col-md-12 col-12">
                    <div class="right-bar">
                        @guest
                        <div class="sinlge-bar">
                            <ul class="list-main">
                                @if (Route::has('register'))
                                    <li><i class="ti-user"></i> <a href="{{ route('register') }}">Register</a></li>
                                @endif
                                @if (Route::has('login'))
                                    <li><i class="ti-power-off"></i><a href="{{ route('login') }}">Login</a></li>
                                @endif
                            </ul>
                        </div>
                        @else
                            <?php
                                $pesanan_detail;
                                $pesanan = App\Models\Pesanan::where('user_id', auth()->user()->id)->where('status', 0)->first();
                                $transaksi = App\Models\Pesanan::where('user_id', auth()->user()->id)
                                                            ->where('status', 1)->first();
                                if (!empty($pesanan)) {
                                    $pesanan_detail = App\Models\PesananDetail::where('pesanan_id', $pesanan->id)->count();
                                    $get_pesanan_detail = App\Models\PesananDetail::join('pesanans', 'pesanan_details.pesanan_id', '=', 'pesanans.id')
                                                                                ->join('products', 'pesanan_details.product_id', '=', 'products.id')
                                                                                ->where('pesanan_id', $pesanan->id)->get();
                                }
                            ?>
                        <div class="sinlge-bar">
                            <a href="/profile" class="single-icon"><i class="fas fa-user"></i></a>
                        </div>
                        <div class="sinlge-bar">
                            <a href="/transaksi" class="single-icon">
                                <i class="fas fa-dolly-flatbed"></i>
                                @if($transaksi)
                                    <span class="total-count">!</span>
                                @endif
                            </a>
                        </div>
                        <div class="sinlge-bar shopping">
                            <a href="/pesanan" class="single-icon"><i class="fas fa-shopping-cart"></i> 
                                @if(!empty($pesanan))
                                    <span class="total-count">{{ $pesanan_detail }}</span>
                                @endif
                            </a>
                            <!-- Shopping Item -->
                            @if (!empty($pesanan))
                            <div class="shopping-item">
                                <div class="dropdown-cart-header">
                                    @if(!empty($pesanan))
                                        <span>{{ $pesanan_detail }} Items</span>
                                    @endif
                                    <a href="/pesanan">View Cart</a>
                                </div>
                                <ul class="shopping-list">
                                    @foreach ($get_pesanan_detail as $item)
                                    <li>
                                        <a class="cart-img" href="/pesanan"><img src="{{ url('assets/frontend/images/'.$item->gambar) }}" alt="{{ $item->nama_product }}"></a>
                                        <h4><a href="/pesanan">{{ $item->nama_product }}</a></h4>
                                        <p class="quantity">{{ $item->jumlah }}x - <span class="amount">Rp. {{ number_format($item->jumlah_harga) }}</span>
                                            <br><span class="amount">{{ $item->ukuran }}</span></p>
                                    </li>
                                    @endforeach
                                </ul>
                                <div class="bottom">
                                    <div class="total">
                                        <span>Total</span>
                                        @if (!empty($pesanan))
                                        <span class="total-amount">Rp. {{ number_format($pesanan->total_harga) }}</span>
                                        @endif
                                    </div>
                                    <a href="/checkout" class="btn animate">Checkout</a>
                                </div>
                            </div>
                            @endif
                            <!--/ End Shopping Item -->
                        </div>
                        <div class="sinlge-bar">
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();" class="single-icon">
                            <i class="fas fa-sign-out-alt"></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header Inner -->
    <div class="header-inner">
        <div class="container">
            <div class="cat-nav-head">
                <div class="row">
                    <div class="col-lg-9 col-12">
                        <div class="menu-area">
                            <!-- Main Menu -->
                            <nav class="navbar navbar-expand-lg">
                                <div class="navbar-collapse">	
                                    <div class="nav-inner">	
                                        <ul class="nav main-menu menu navbar-nav">
                                                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                                                <?php 
                                                    $category;
                                                    $category = App\Models\Category::all();
                                                ?>
                                                @foreach ($category as $item)
                                                    <li class="{{ request()->is($item->nama_category) ? 'active' : '' }}">
                                                        <a href="/{{ $item->nama_category }}">{{ $item->nama_category }}</a>
                                                    </li>
                                                @endforeach
                                                <li class="{{ request()->is('about') ? 'active' : '' }}"><a href="/about">About Me</a></li>
                                            </ul>
                                    </div>
                                </div>
                            </nav>
                            <!--/ End Main Menu -->	
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ End Header Inner -->
</header>
<!--/ End Header -->
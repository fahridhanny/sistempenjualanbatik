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
								<li class="active"><a href="blog-single.html">Product Detail</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Breadcrumbs -->
			
		<!-- Start Blog Single -->
		<section class="blog-single section">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-12">
						<div class="blog-single-main">
							<div class="row">
								<div class="col-12">
									<div class="image">
										<img src="{{ url('assets/frontend/images/'.$product->gambar) }}" alt="#" style="height: 300px;">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-8 col-12">
						<div class="main-sidebar">
							<!-- Single Widget -->
							<div class="single-widget newsletter">
								<h3 class="title">Product Detail</h3>
								<div class="letter-inner">
									<div class="form-inner">
										
										<?php 
											$id_produk = base64_encode($product->id);
										?>

										<form action="/pesanan/{{ $id_produk }}" method="POST">
										@csrf

										<table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Nama</td>
                                                    <td>:</td>
                                                    <td>{{ $product->nama_product }}</td>
                                                </tr>
												<tr>
                                                    <td>Ukuran</td>
                                                    <td>:</td>
                                                    <td>
														<select class="form-control form-control-sm" name="ukuran" id="ukuranProduk" onchange="changeValue({{ $product->id }})">
															<option value=""></option>
															@foreach ($ukuran as $data)
																<option value="{{ $data->ukuran }}">{{ $data->ukuran }}</option>
															@endforeach
													  	</select>
													</td>
                                                </tr>
                                                <tr>
                                                    <td>Stok</td>
                                                    <td>:</td>
                                                    <td id="stok"></td>
                                                </tr>
												<tr>
                                                    <td>Harga</td>
                                                    <td>:</td>
                                                    <td>Rp. {{ number_format($product->harga) }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Jumlah</td>
                                                    <td>:</td>
                                                    <td>
														<div class="input-group">
															<div class="button minus">
																<button type="button" class="btn btn-primary btn-number" disabled="disabled" data-type="minus" data-field="jumlah_pesanan">
																	<i class="ti-minus"></i>
																</button>
															</div>
															<input type="text" name="jumlah_pesanan" class="input-number form-control"  data-min="1" data-max="100" value="{{ 1 }}" style="text-align: center;">
															<div class="button plus">
																<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="jumlah_pesanan">
																	<i class="ti-plus"></i>
																</button>
															</div>
														</div>
														<!--/ End Input Order -->
                                                    </td>
                                                </tr>
												<tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><button type="submit" class="btn btn-primary mt-3"><i class="fas fa-shopping-cart"></i> Masukkan Keranjang</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
										</form>
									</div>
								</div>
							</div>
							<!--/ End Single Widget -->
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End Blog Single -->
		<script type="text/javascript">
		function changeValue(id){
			var ukuran = $('#ukuranProduk').val();
			$.ajax({
				url: '/pesanan/'+id+'/'+ukuran
			}).success(function(data){
				$('#stok').html(data.ukuran);
			});
		}
		</script> 
@endsection
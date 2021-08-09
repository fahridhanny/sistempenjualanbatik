@extends('base/admin/index')

@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">                
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-fw fa-home"></i> Home</a></li>
            <li class="active">Product</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data Product</h3>                                    
                    </div><!-- /.box-header -->
                    <a href="/tambah/product" class="btn btn-primary" style="margin-left: 10px;">Tambah Product</a>
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Product</th>
                                    <th>Category</th>
                                    <th>Ukuran</th>
                                    <th>Stok</th>
                                    <th>Harga</th>
                                    <th>Desk</th>
                                    <th>Gambar</th>
                                    <th colspan="2" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $no => $data)
                                <?php 
                                    $nama_product = base64_encode($data->nama_product);
                                    $ukuran = base64_encode($data->ukuran);
                                ?>
                                <tr>
                                    <td>{{ $products->firstItem()+$no }}</td>
                                    <td>{{ $data->nama_product }}</td>
                                    <td>{{ $data->nama_category }}</td>
                                    <td>{{ $data->ukuran }}</td>
                                    <td>{{ $data->stok }}</td>
                                    <td>Rp. {{ number_format($data->harga) }}</td>
                                    <td>{{ $data->desk }}</td>
                                    <td><img src="{{url('assets/frontend/images/'.$data->gambar) }}" alt="" width="80px"></td>
                                    <td><a href="/edit/product/{{ $nama_product }}/{{ $ukuran }}" class="btn btn-primary">Edit</a></td>
                                    <td><a href="/hapus/product/{{ $nama_product }}/{{ $ukuran }}" class="btn btn-danger">Hapus</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->
@endsection
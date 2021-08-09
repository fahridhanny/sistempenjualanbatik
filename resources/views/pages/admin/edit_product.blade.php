@extends('base/admin/index')

@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Edit Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-fw fa-home"></i> Home</a></li>
            <li class="active">Edit Product</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Edit Product</h3>
                    </div><!-- /.box-header -->
                    <?php 
                        $id_product = base64_encode($product->id);
                        $ukuran_product = base64_encode($ukuran->ukuran);
                    ?>
                    <!-- form start -->
                    <form role="form" action="/edit/product/proses/{{ $id_product }}/{{ $ukuran_product }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Nama Product</label>
                                <input type="text" class="form-control" placeholder="Nama Product" name="nama_product" value="{{ $product->nama_product }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="id_category" id="" class="form-control" required>
                                    <option value="">--- Pilih Category ---</option>
                                    @foreach ($category as $data)
                                        <option value="{{ $data->id }}" @if ($product->id_category == $data->id)   
                                        selected @endif>{{ $data->nama_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Ukuran</label>
                                <input type="text" class="form-control" placeholder="Ukuran" name="ukuran" id="ukuran" value="{{ $ukuran->ukuran }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Stok</label>
                                <input type="text" class="form-control" placeholder="Stok" name="stok" id="stok" value="{{ $ukuran->stok }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="number" class="form-control" placeholder="Harga" name="harga" value="{{ $product->harga }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Berat</label>
                                <input type="number" class="form-control" placeholder="Harga" name="berat" value="{{ $product->berat }}" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="desk" id="" cols="30" rows="10" class="form-control" value="{{ $product->desk }}" required>{{ $product->desk }}</textarea>
                            </div>
                            <div>
                                <table>
                                    <thead>
                                        <tr>
                                            <th><img src="{{url('assets/frontend/images/'.$product->gambar) }}" alt="" width="100px"></th>
                                            <th><p>{{ $product->gambar }}</p></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            <div class="form-group">
                                <label for="">File input</label>
                                <input type="file" id="" name="gambar"> 
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
@endsection
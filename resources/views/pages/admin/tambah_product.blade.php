@extends('base/admin/index')

@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Tambah Product
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-fw fa-home"></i> Home</a></li>
            <li class="active">Tambah Product</li>
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
                        <h3 class="box-title">Tambah Product</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/tambah/product/proses" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Nama Product</label>
                                <input type="text" class="form-control" placeholder="Nama Product" name="nama_product" required>
                            </div>
                            <div class="form-group">
                                <label for="">Kategori</label>
                                <select name="id_category" id="" class="form-control" required>
                                    <option value="">--- Pilih Category ---</option>
                                    @foreach ($category as $data)
                                        <option value="{{ $data->id }}">{{ $data->nama_category }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="listUkuran">
                                <div class="form-group">
                                    <label for="">Ukuran</label>
                                    <input type="text" class="form-control" placeholder="Ukuran" name="ukuran[0]" id="ukuran" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="text" class="form-control" placeholder="Stok" name="stok[0]" id="stok" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <a href="" class="btn btn-primary" onclick="tambah_ukuran(); return false">
                                    <i class="glyphicon glyphicon-plus"></i>
                                </a>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="number" class="form-control" placeholder="Harga" name="harga" required>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <textarea name="desk" id="" cols="30" rows="10" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">File input</label>
                                <input type="file" id="" name="gambar" required> 
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
<script type="text/javascript">
    var i = 1;
    function tambah_ukuran(){
        var listUkuran = document.getElementById("listUkuran");

        var div_ukuran = document.createElement('div');
        div_ukuran.setAttribute('class', 'form-group');
        var label_ukuran = document.createElement('label');
        label_ukuran.innerHTML = "Ukuran";
        var input_ukuran = document.createElement('input');
        input_ukuran.setAttribute('type', 'text');
        input_ukuran.setAttribute('class', 'form-control');
        input_ukuran.setAttribute('placeholder', 'Ukuran');
        input_ukuran.setAttribute('name', 'ukuran['+i+']');
        input_ukuran.setAttribute('id', 'ukuran');

        listUkuran.appendChild(div_ukuran);
        div_ukuran.appendChild(label_ukuran);
        div_ukuran.appendChild(input_ukuran);

        var div_stok = document.createElement('div');
        div_stok.setAttribute('class', 'form-group');
        var label_stok = document.createElement('label');
        label_stok.innerHTML = "Stok";
        var input_stok = document.createElement('input');
        input_stok.setAttribute('type', 'text');
        input_stok.setAttribute('class', 'form-control');
        input_stok.setAttribute('placeholder', 'Stok');
        input_stok.setAttribute('name', 'stok['+i+']');
        input_stok.setAttribute('id', 'stok');

        listUkuran.appendChild(div_stok);
        div_stok.appendChild(label_stok);
        div_stok.appendChild(input_stok);

        var div_hapus = document.createElement('div');
        div_hapus.setAttribute('class', 'form-group');
        var hapus = document.createElement('span');
        hapus.innerHTML = '<button class="btn btn-small btn-danger"><i class="glyphicon glyphicon-trash"></i></button>';
        
        listUkuran.appendChild(div_hapus);
        div_hapus.appendChild(hapus);

        hapus.onclick = function () {
            div_ukuran.parentNode.removeChild(div_ukuran);
            div_stok.parentNode.removeChild(div_stok);
        };

        i++;
    }

</script>
@endsection
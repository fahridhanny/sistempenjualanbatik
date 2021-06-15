@extends('base/admin/index')

@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Profile
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-fw fa-home"></i> Home</a></li>
            <li class="active">Profile</li>
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
                        <h3 class="box-title">Profile</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="/ubah/profile/admin" method="POST">
                        @csrf
                        <div class="box-body">
                            <div class="form-group">
                                <label for="">Nama Lengkap</label>
                                <input type="text" class="form-control" placeholder="Nama" name="name" required value="{{ $user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="">Alamat</label>
                                <input type="text" class="form-control" placeholder="Alamat" name="alamat" required value="{{ $user->alamat }}">
                            </div>
                            <div class="form-group">
                                <label for="">No Telp</label>
                                <input type="number" class="form-control" placeholder="No Telp" name="no_telp" required value="{{ $user->no_telp }}">
                            </div>
                            <div class="form-group">
                                <label for="">Negara Asal</label>
                                <input type="text" class="form-control" placeholder="Negara Asal" name="negara_asal" required value="{{ $user->negara_asal }}">
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" class="form-control" placeholder="Email" name="email" required value="{{ $user->email }}">
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->
@endsection
@extends('base/admin/index')

@section('content')
<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">                
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data User
        </h1>
        <ol class="breadcrumb">
            <li><a href="/dashboard"><i class="fa fa-fw fa-home"></i> Home</a></li>
            <li class="active">User</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Data User</h3>                                    
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Alamat</th>
                                    <th>No. Telp</th>
                                    <th>Negara Asal</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $no => $data)
                                <tr>
                                    <td>{{ $user->firstItem()+$no }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->alamat }}</td>
                                    <td>{{ $data->no_telp }}</td>
                                    <td>{{ $data->negara_asal }}</td>
                                    <td>{{ $data->email }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $user->links() }}
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>
        </div>

    </section><!-- /.content -->
</aside><!-- /.right-side -->
@endsection
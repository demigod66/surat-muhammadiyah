@extends('backend.template')
@section('sub-judul','Klasifikasi')
@section('halaman-sekarang','Klasifikasi')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <a class="btn btn-primary btn-sm" href="{{ route('klasifikasi.create') }}"><i class="fas fa-plus-square"></i>    Tambah</a>
                </div>
            </div>
            <div class="card-body table-responsive">

                @if(session('pesan'))
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-success alert-sm alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> {{ session('pesan') }}!</h5>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>Nama</th>
                            <th>Kode</th>
                            <th>Uraian</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($klasifikasi as $ka)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ka->nama }}</td>
                            <td>{{ $ka->kode }}</td>
                            <td>{{ $ka->uraian }}</td>
                            <td>
                                <a href="{{ route('klasifikasi.edit', $ka->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="{{ url('backend/klasifikasi/delete', $ka->id) }}" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
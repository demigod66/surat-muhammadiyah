@extends('backend.template')
@section('sub-judul','Surat Keluar')
@section('halaman-sekarang','Surat Keluar')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <a href="{{ route('suratkeluar.create') }}" class="btn btn-primary btn-sm" ><i class="fas fa-plus"></i>    Tambah</a>
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
                            <th width="5%">No</th>
                            <th>No. Surat</th>
                            <th>Tujuan Surat</th>
                            <th>Isi</th>
                            <th>Kode</th>
                            <th>Tgl. Catat</th>
                            <th>Tgl. Surat</th>
                            <th>Keterangan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($suratkeluar as $sk)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sk->no_surat }}</td>
                            <td>{{ $sk->tujuan_surat }}</td>
                            <td>{{ $sk->isi }}</td>
                            <td>{{ $sk->kode }}</td>
                            <td>{{ date('d-m-Y', strtotime($sk->tgl_catat)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($sk->tgl_surat)) }}</td>
                            <td>{{ $sk->keterangan }}</td>
                            <td>
                                <a href="{{ route('suratkeluar.edit', $sk->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="{{ url('suratkeluar/delete', $sk->id) }}" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                <a href="{{ asset($sk->filekeluar) }}" class="btn btn-info btn-sm"><i class="fa fa-file"></i></a>
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
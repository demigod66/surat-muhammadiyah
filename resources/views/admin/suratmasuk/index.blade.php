@extends('backend.template')
@section('sub-judul','Surat Masuk')
@section('halaman-sekarang','Surat Masuk')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <a href="{{ route('suratmasuk.create') }}" class="btn btn-primary btn-sm" ><i class="fas fa-plus"></i>    Tambah</a>
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
                            <th>Asal Surat</th>
                            <th>Isi</th>
                            <th>Kode</th>
                            <th>Tgl. Surat</th>
                            <th>Tgl. Terima</th>
                            <th>Keterangan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($suratmasuk as $sm)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sm->no_surat }}</td>
                            <td>{{ $sm->asal_surat }}</td>
                            <td>{{ $sm->isi }}</td>
                            <td>{{ $sm->kode }}</td>
                            <td>{{ date('d-m-Y', strtotime($sm->tgl_surat)) }}</td>
                            <td>{{ date('d-m-Y', strtotime($sm->tgl_terima)) }}</td>
                            <td>{{ $sm->keterangan }}</td>
                            <td>
                                <a href="{{ route('suratmasuk.edit', $sm->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                <a href="{{ url('suratmasuk/delete', $sm->id) }}" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                <a href="{{ asset($sm->file_masuk) }}" class="btn btn-info btn-sm"><i class="fa fa-file"></i></a>
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
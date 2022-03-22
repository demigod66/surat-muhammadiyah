@extends('template')
@section('sub-judul', 'Surat Masuk')
@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        @if (Auth::user()->tipe == 1)
                            <a href="{{ url('suratmasuk/create') }}" class="btn btn-primary btn-sm">Tambah</a>
                        @endif
                    </div>
                </div>

                <div class="card-body table-responsive">

                    @if (session('pesan'))
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="alert alert-success alert-sm alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">&times;</button>
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
                                <th>Tgl. Surat</th>
                                {!! Auth::user()->tipe == 1 ? '<th>Disposisi Saat Ini</th>' : '' !!}
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($suratmasuk as $sm)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $sm->no_surat }}</td>
                                    <td>{{ $sm->asal_surat }}</td>
                                    <td>{{ $sm->isi }}</td>
                                    <td>{{ date('d-m-Y', strtotime($sm->tgl_surat)) }}</td>
                                    @if (Auth::user()->tipe == 1)
                                        <td>
                                            @if ($sm->suratmasuk_id == null)
                                                <a href="{{ url('suratmasuk/disposisi', $sm->id) }}"
                                                    class="btn btn-secondary btn-sm"><i class="fa fa-share"
                                                        title="Disposisi"></i></a>
                                                Menunggu Disposisi
                                            @else
                                                <p>{{ $sm->name }}</p>
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if (Auth::user()->tipe == 1)
                                            <a href="{{ url('suratmasuk/edit', $sm->id) }}" class="btn btn-primary btn-sm"
                                                title="Edit"><i class="fa fa-edit"></i></a>
                                            <a href="{{ url('suratmasuk/delete', $sm->id) }}"
                                                class="btn btn-danger btn-sm" title="Delete"><i
                                                    class="fa fa-trash"></i></a>
                                        @endif
                                        <a href="{{ asset($sm->file_masuk) }}" class="btn btn-info btn-sm"><i
                                                class="fa fa-file" title="File"></i></a>
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

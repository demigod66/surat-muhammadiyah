@extends('template')
@section('sub-judul','Agenda Surat Masuk')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="float-right">
                    <a href="{{ route('auth.cetak_pdf') }}" class="btn btn-danger btn-sm" target="_blank" role="button">Cetak Pdf</a>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table id="example2" class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th width="10%">No</th>
                            <th>No. Surat</th>
                            <th>Asal Surat</th>
                            <th>Isi</th>
                            <th>Kode</th>
                            <th>Tgl. Surat</th>
                            <th>Tgl. Terima</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($suratmasuk as $result)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $result->no_surat }}</td>
                            <td>{{ $result->asal_surat }}</td>
                            <td>{{ $result->isi }}</td>
                            <td>{{ $result->nama }}</td>
                            <td>{{ $result->tgl_surat }}</td>
                            <td>{{ $result->tgl_terima }}</td>
                            <td>{{ $result->keterangan }}</td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
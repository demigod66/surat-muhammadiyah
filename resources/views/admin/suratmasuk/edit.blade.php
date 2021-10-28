@extends('backend.template')
@section('sub-judul','Edit Surat Masuk')
@section('halaman-sekarang','Edit Surat Masuk')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-right">
          <a href="{{ route('suratmasuk.index') }}" class="btn btn-warning btn-sm">Kembali</a>
        </div>
      </div>
      <div class="card-body">

        <div class="row justify-content-center">
          <div class="col-md-6">
            <form class="form-horizontal" action="{{ route('suratmasuk.update', $suratmasuk->id) }}" enctype="multipart/form-data" method="POST">
              @csrf
              @method('PATCH')

              <div class="form-group">
                <label>No.Surat</label>
                <input type="text" class="form-control" name="no_surat" id="no_surat" value="{{ $suratmasuk->no_surat }}" readonly>
                <div class="text-danger">@error('no_surat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Isi Ringkas</label>
                <textarea class="form-control" name="isisurat" id="isisurat" rows="5">{{ $suratmasuk->isi }}</textarea>
                <div class="text-danger">@error('isisurat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label for="">Tanggal Surat</label>
                <input type="date" name="tgl_surat" class="form-control" id="tgl_surat" value="{{ $suratmasuk->tgl_surat}}" readonly>
              </div>
              <div class="form-group">
                <label for="">Tanggal Catat</label>
                <input type="date" name="tgl_catat" class="form-control" id="tgl_catat" value="{{ $suratmasuk->tgl_terima }}" readonly>
              </div>
              <div class="form-group">
                <label>Kode Klasifikasi</label>
                <select name="klasifikasi" class="form-control" id="klasifikasi"
                value="{{$suratmasuk->kode}}">
                @foreach($klasifikasi as $result)
                <option value="{{$result->kode}}" {{ $suratmasuk->kode == $result->kode ? 'selected' : '' }}>{{$result->nama}} ( {{$result->kode}} )
                </option>
                @endforeach
              </select>
              <div class="text-danger">@error('klasifikasi'){{ $message }}@enderror</div>
            </div>
            <div class="form-group">
              <label>Keterangan</label>
              <input type="text" class="form-control" name="keterangan" id="keterangan" value="{{ $suratmasuk->keterangan }}">
              <div class="text-danger">@error('keterangan'){{ $message }}@enderror</div>
            </div>
            <div class="form-group">
              <label>File</label>
              <input type="file" class="form-control" name="filemasuk" id="filemasuk" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx">
              <div class="text-danger">@error('keterangan'){{ $message }}@enderror</div>
              <small>
                Pastikan file anda ( jpg,jpeg,png,doc,docx,pdf ) !!!
              </small>
            </div>
            <button type="submit" class="btn btn-info">Simpan</button>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
</div>

@endsection
@extends('backend.template')
@section('sub-judul','Edit Surat Keluar')
@section('halaman-sekarang','Edit Surat Keluar')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-right">
          <a href="{{ route('suratkeluar.index') }}" class="btn btn-warning btn-sm">Kembali</a>
        </div>
      </div>
      <div class="card-body">

        <div class="row justify-content-center">
          <div class="col-md-6">
            <form class="form-horizontal" method="POST" action="{{ route('suratkeluar.update', $suratkeluar->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PATCH')
              <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Input Nomor Surat" value="{{ $suratkeluar->no_surat }}" readonly>
                <div class="text-danger">@error('no_surat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Isi Ringkas</label>
                <textarea class="form-control"  name="isisurat" id="isisurat" rows="5">{{ $suratkeluar->isi }}</textarea>
                <div class="text-danger">@error('isisurat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Kode Klasifikasi</label>
                <select class="form-control" name="klasifikasi" id="klasifikasi">
                  <option value="" holder>Pilih Kode Klasifikasi</option>
                  @foreach ($klasifikasi as $result)
                  <option value="{{$result->kode }}" {{ $suratkeluar->kode == $result->kode ? 'selected' : '' }}>{{ $result->nama }} ( {{$result->kode}} )</option>
                  @endforeach
                </select>
                <div class="text-danger">@error('klasifikasi'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label for="">Tanggal Surat</label>
                <input type="date" name="tgl_surat" class="form-control" id="tgl_surat" value="{{ $suratkeluar->tgl_surat }}" readonly>
                <div class="text-danger">@error('tgl_surat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label for="">Tanggal Catat</label>
                <input type="date" name="tgl_catat" class="form-control" id="tgl_catat" value="{{ $suratkeluar->tgl_catat }}" readonly>
                <div class="text-danger">@error('tgl_catat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label for="">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Input Keterangan" value="{{ $suratkeluar->keterangan }}">
                <div class="text-danger">@error('keterangan'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <input type="file" name="file_keluar" id="file_keluar" class="form-control" accept=".jpg, .jpeg, .png, .doc, .docx, .pdf">
                <div class="text-danger">@error('file_keluar'){{ $message }}@enderror</div>
                <small id="validatedCustomFile" class="text-danger">
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

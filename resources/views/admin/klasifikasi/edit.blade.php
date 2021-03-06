@extends('template')
@section('sub-judul','Edit Klasifikasi')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-right">
          <a href="{{ url('klasifikasi') }}" class="btn btn-warning btn-sm">Kembali</a>
        </div>
      </div>
      <div class="card-body">

        <div class="row justify-content-center">
          <div class="col-md-6">
            <form class="form-horizontal" method="POST" action="{{ url('klasifikasi/update', $klasifikasi->id) }}" enctype="multipart/form-data">
              @csrf
              <div class="form-group">
                <label>Kode</label>
                <input type="text" class="form-control" name="kode" id="kode" placeholder="Input Kode Klasifikasi" value="{{ $klasifikasi->kode }}" readonly>
                <div class="text-danger">@error('kode'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" id="nama" placeholder="Input Nama Klasifikasi" value="{{ $klasifikasi->nama }}">
                <div class="text-danger">@error('nama'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Uraian</label>
                <textarea class="form-control"  name="uraian" id="uraian" rows="5">{{ $klasifikasi->uraian }}</textarea>
                <div class="text-danger">@error('uraian'){{ $message }}@enderror</div>
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

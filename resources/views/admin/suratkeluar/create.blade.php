@extends('backend.template')
@section('sub-judul','Tambah Surat Keluar')
@section('halaman-sekarang','Tambah Surat Keluar')
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
              <form class="form-horizontal" method="POST" action="{{ route('suratkeluar.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                  <label>Nomor Surat</label>
                  <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Input Nomor Surat">
                    @error('no_surat')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                  <label>Tujuan Surat</label>
                  <input type="text" class="form-control" name="tujuan_surat" id="tujuan_surat" placeholder="Input Tujuan Surat">
                  @error('tujuan_surat')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Isi Ringkas</label>
                    <textarea class="form-control"  name="isisurat" id="isisurat"></textarea>
                    @error('isisurat')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label>Kode Klasifikasi</label>
                    <select class="form-control" name="klasifikasi" id="klasifikasi">
                      <option value="" holder>Pilih Kode Klasifikasi</option>
                      @foreach ($klasifikasi as $result)
                      <option value="{{$result->kode }}">{{ $result->nama }} ( {{$result->kode}} )</option>
                      @endforeach
                    </select>
                    @error('klasifikasi')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                      <label for="">Tanggal Surat</label>
                      <input type="date" name="tgl_surat" class="form-control" id="tgl_surat">
                      @error('tgl_surat')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">
                    <label for="">Tanggal Catat</label>
                    <input type="date" name="tgl_catat" class="form-control" id="tgl_catat">
                    @error('tgl_catat')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Keterangan</label>
                    <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Input Keterangan">
                    @error('keterangan')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="file" name="file_masuk" id="file_masuk" class="form-control">
                    @error('file_masuk')
                        <div class="form-text text-danger">{{ $message }}</div>
                    @enderror
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

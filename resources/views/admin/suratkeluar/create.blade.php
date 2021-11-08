@extends('template')
@section('sub-judul','Tambah Surat Keluar')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-right">
          <a href="{{ url('suratkeluar') }}" class="btn btn-warning btn-sm">Kembali</a>
        </div>
      </div>
      <div class="card-body">

        <form class="form-horizontal" method="POST" action="{{ url('suratkeluar/store') }}" enctype="multipart/form-data">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Input Nomor Surat">
                <div class="text-danger">@error('no_surat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Tujuan Surat</label>
                <input type="text" class="form-control" name="tujuan_surat" id="tujuan_surat" placeholder="Input Tujuan Surat">
                <div class="text-danger">@error('tujuan_surat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Isi Ringkas</label>
                <textarea class="form-control"  name="isisurat" id="isisurat" rows="5"></textarea>
                <div class="text-danger">@error('isisurat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label for="">Keterangan</label>
                <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Input Keterangan">
                <div class="text-danger">@error('keterangan'){{ $message }}@enderror</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kode Klasifikasi</label>
                <select class="form-control" name="klasifikasi" id="klasifikasi">
                  <option value="" holder>Pilih Kode Klasifikasi</option>
                  @foreach ($klasifikasi as $result)
                  <option value="{{$result->kode }}">{{ $result->nama }} ( {{$result->kode}} )</option>
                  @endforeach
                </select>
                <div class="text-danger">@error('klasifikasi'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label for="">Tanggal Surat</label>
                <input type="date" name="tgl_surat" class="form-control" id="tgl_surat">
                <div class="text-danger">@error('tgl_surat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label for="">Tanggal Terima</label>
                <input type="date" name="tgl_terima" class="form-control" id="tgl_terima">
                <div class="text-danger">@error('tgl_terima'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>File</label>
                <input type="file" name="file_keluar" id="file_keluar" class="form-control" accept=".jpg, .jpeg, .png, .doc, .docx, .pdf">
                <div class="text-danger">@error('file_keluar'){{ $message }}@enderror</div>
                <small>
                  Pastikan file anda ( jpg,jpeg,png,doc,docx,pdf ) !!!
                </small>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-info">Simpan</button>
        </form>

      </div>
    </div>
  </div>
</div>

@endsection

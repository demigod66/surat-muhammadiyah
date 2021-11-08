@extends('template')
@section('sub-judul','Tambah Surat Masuk')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-right">
          <a href="{{ url('suratmasuk') }}" class="btn btn-warning btn-sm">Kembali</a>
        </div>
      </div>
      <div class="card-body">

        <form class="form-horizontal" action="{{ url('suratmasuk/store') }}" enctype="multipart/form-data" method="POST">
          @csrf

          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nomor Surat</label>
                <input type="text" class="form-control" name="no_surat" id="no_surat" placeholder="Input Nomor Surat">
                <div class="text-danger">@error('no_surat'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Asal Surat</label>
                <input type="text" class="form-control" name="asal_surat" id="asal_surat" placeholder="Input Asal Surat">
                <div class="text-danger">@error('asal_surat'){{ $message }}@enderror</div>
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
                <input type="file" name="file_masuk" id="file_masuk" class="form-control">
                <div class="text-danger">@error('file_masuk'){{ $message }}@enderror</div>
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
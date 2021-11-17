@extends('template')
@section('sub-judul','Tambah User')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-right">
          <a href="{{ url('user') }}" class="btn btn-warning btn-sm">Kembali</a>
        </div>
      </div>
      <div class="card-body">

        <div class="row justify-content-center">
          <div class="col-md-6">
            
            <form class="form-horizontal" id="form" method="POST" action="{{ url('user/store') }}" enctype="multipart/form-data">
              @csrf

              <div class="form-group">
                <label>Nama User</label>
                <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Input Nama">
                <div class="text-danger">@error('nama_user'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="input email">
                <div class="text-danger">@error('email'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Tipe User</label>
                <select name="tipe" id="tipe" class="form-control">
                  <option value="">Pilih Tipe User</option>
                  <option value="1">Administrator</option>
                  <option value="0">User</option>
                </select>
                <div class="text-danger">@error('tipe'){{ $message }}@enderror</div>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password">
                <div class="text-danger">@error('password'){{ $message }}@enderror</div>
              </div>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </form>

          </div>
        </div>

      </div>
    </div>
  </div>
</div>

@endsection
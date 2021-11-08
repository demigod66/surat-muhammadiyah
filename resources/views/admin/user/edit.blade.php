@extends('template')
@section('sub-judul','Edit User')
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

            <form class="form-horizontal" id="form" action="{{ url('user/update', $user->id) }}" method="POST">
              @csrf

              <div class="form-group">
                <label>Nama User</label>
                <input type="text" class="form-control" name="nama_user" id="nama_user" placeholder="Input Nama" value="{{ $user->name }}">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" id="email" placeholder="input email" value="{{ $user->email }}">
              </div>
              <div class="form-group">
                <label>Tipe User</label>
                <select class="form-control" name="tipe" id="tipe">
                  <option value="">Pilih Tipe User</option>
                  <option value="1" {{ $user->tipe == 1 ? 'selected' : '' }}>Administrator</option>
                  <option value="0" {{ $user->tipe == 0 ? 'selected' : '' }}>Pegawai</option>
                </select>
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" name="password" id="password">
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
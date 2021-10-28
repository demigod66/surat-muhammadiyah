@extends('backend.template')
@section('sub-judul','User')
@section('halaman-sekarang','User')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-right">
          <a href="{{ route('user.create') }}" class="btn btn-primary btn-sm" ><i class="fas fa-plus"></i>  Tambah</a>
        </div>
      </div>
      <div class="card-body table-responsive">
        <table id="example2" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th width="10%">No</th>
              <th>Nama Pegawai</th>
              <th>Email</th>
              <th>Tipe User</th>
              <th width="10%">Aksi</th>
            </tr>
          </thead>
          <tbody>

            @foreach($user as $u)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $u->name }}</td>
              <td>{{ $u->email }}</td>
              <td>{{ $u->tipe == 1 ? 'Tata Usaha' : 'Guru' }}</td>
              <td>
                <a href="{{ route('user.edit', $u->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                <a href="{{ url('user/delete', $u->id) }}" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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
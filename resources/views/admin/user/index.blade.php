@extends('template')
@section('sub-judul','User')
@section('content')

<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <div class="float-right">
          <a href="{{ url('user/create') }}" class="btn btn-primary btn-sm" >Tambah</a>
        </div>
      </div>
      <div class="card-body table-responsive">

        @if(session('pesan'))
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <div class="alert alert-success alert-sm alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-check"></i> {{ session('pesan') }}!</h5>
              </div>
            </div>
          </div>
        </div>
        @endif
        
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
                <a href="{{ url('user/edit', $u->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
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
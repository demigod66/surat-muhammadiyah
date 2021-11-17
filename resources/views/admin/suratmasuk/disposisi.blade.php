@extends('template')
@section('sub-judul','Disposisi Surat Masuk')
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

        <form class="form-horizontal" action="{{ url('suratmasuk/disposisi/kirim') }}" enctype="multipart/form-data" method="POST">
          @csrf

          <input type="hidden" name="id" value="{{ $suratmasuk->id }}">
          <div class="row justify-content-center">
            <div class="col-lg-8">
              <div class="form-group row">
                <label class="col-lg-3">Nomor Surat</label>
                <div class="col-lg-6">
                  <p>{{ $suratmasuk->no_surat }}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3">Perihal Surat</label>
                <div class="col-lg-6">
                  <p>{{ $suratmasuk->keterangan }}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3">Dari Bagian</label>
                <div class="col-lg-6">
                  <p>{{ Auth::user()->tipe == 1 ? 'Administrator' : 'User' }}</p>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3">Disposisi Kepada</label>
                <div class="col-lg-6">
                  <select class="form-control" name="disposisi">
                    <option value="">- Pilih -</option>
                    <?php foreach ($user as $u): ?>
                      <?php if ($u->tipe != 1): ?>
                        <option value="{{ $u->id }}">{{ $u->name }}</option>
                      <?php endif ?>
                    <?php endforeach ?>
                  </select>
                  <div class="text-danger">@error('disposisi'){{ $message }}@enderror</div>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-lg-3">Isi Disposisi</label>
                <div class="col-lg-6">
                  <textarea class="form-control" name="isi_disposisi" rows="5"></textarea>
                  <div class="text-danger">@error('isi_disposisi'){{ $message }}@enderror</div>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                  <button class="btn btn-primary btn-sm" type="submit">Kirim</button>
                  <a href="{{ url('suratmasuk') }}" class="btn btn-secondary btn-sm">Batal</a>
                </div>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>



@endsection
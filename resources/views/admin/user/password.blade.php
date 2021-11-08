@extends('template')
@section('sub-judul','Password')
@section('content')

<div class="row justify-content-center">
	<div class="col-md-9">
		<div class="card">
			<div class="card-body">

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

				<form action="{{ url('user/ubah-password') }}" method="POST">
					@csrf
					
					<div class="form-group row">
						<label for="" class="col-sm-3">Password Lama</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="pass_lama">
							<div class="text-danger">@error('pass_lama') {{ $message }} @enderror</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="" class="col-sm-3">Password Baru</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="pass_baru">
							<div class="text-danger">@error('pass_baru') {{ $message }} @enderror</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="" class="col-sm-3">Confirmasi Password</label>
						<div class="col-sm-6">
							<input type="password" class="form-control" name="pass_conf">
							<div class="text-danger">@error('pass_conf') {{ $message }} @enderror</div>
						</div>
					</div>
					<div class="form-group row">
						<div class="col-sm-6">
							<button type="submit" class="btn btn-primary">Simpan</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
@endsection

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Klasifikasi;

class KlasifikasiController extends Controller
{
	public function index(){
		$klasifikasi = Klasifikasi::all();
		return view('admin.klasifikasi.index' , compact('klasifikasi'));
	}

	public function create(){
		return view('admin.klasifikasi.create');
	}

	public function store(Request $request){
		$request->validate([
			'nama' => 'required',
			'kode' => 'required',
			'uraian' => 'required'
		]);

		Klasifikasi::create([
			'nama' => $request->nama,
			'kode' => $request->kode,
			'uraian' => $request->uraian
		]);

		return redirect('klasifikasi')->with('pesan', 'Berhasil ditambahkan');
	}

	public function edit($id){
		$klasifikasi = Klasifikasi::findOrFail($id);
		return view('admin.klasifikasi.edit', compact('klasifikasi'));
	}

	public function update(Request $request, $id){
		$klasifikasi = Klasifikasi::findOrFail($id);

		$request->validate([
			'nama' => 'required',
			'kode' => 'required',
			'uraian' => 'required'
		]);

		$klasifikasi->nama = $request->nama;
		$klasifikasi->kode = $request->kode;
		$klasifikasi->uraian = $request->uraian;

		$klasifikasi->save();

		return redirect('klasifikasi')->with('pesan', 'Berhasil diubah');
	}

	public function destroy($id){
		$klasifikasi =  Klasifikasi::findOrFail($id)->delete();
		return redirect('klasifikasi')->with('pesan', 'Berhasil dihapus');
	}
}

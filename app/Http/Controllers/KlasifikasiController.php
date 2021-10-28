<?php

namespace App\Http\Controllers;
use Yajra\DataTables\Facades\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use App\Imports\KlasifikasiImport;
use App\Models\Klasifikasi;
use Illuminate\Http\Request;

class KlasifikasiController extends Controller
{
    public function index()
    {
        $klasifikasi = Klasifikasi::all();
        return view('admin.klasifikasi.index' , compact('klasifikasi'));
    }

    public function create(){
        return view('admin.klasifikasi.create');
    }

    public function store(Request $request)
    {
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

        return redirect('backend/klasifikasi')->with('pesan', 'Berhasil ditambahkan');
    }

    public function edit($id)
    {
        $klasifikasi = Klasifikasi::findOrFail($id);
        return view('admin.klasifikasi.edit', compact('klasifikasi'));
    }

    public function update(Request $request, $id)
    {
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

        return redirect('backend/klasifikasi')->with('pesan', 'Berhasil diupdate');
    }

    public function destroy($id)
    {
        $klasifikasi =  Klasifikasi::findOrFail($id)->delete();
        return redirect('backend/klasifikasi')->with('pesan', 'Berhasil dihapus');
    }


    public function import(Request $request){
        $this->validate($request, [
            'klasifikasi' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('klasifikasi');
        $nama_file = rand().$file->getClientOriginalName();
        $file->move('klasifikasi_file',$nama_file);
        Excel::import(new KlasifikasiImport, public_path('/klasifikasi_file/'.$nama_file));
        return redirect()->back()->with('sukses', 'Import Data Berhasil');
        return view('klasifikasi.index');

    }
}

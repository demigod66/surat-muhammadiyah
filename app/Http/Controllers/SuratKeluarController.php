<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{SuratKeluar, Klasifikasi};

class SuratKeluarController extends Controller
{
    public function index()
    {
        $suratkeluar = SuratKeluar::all();
        return view('admin.suratkeluar.index', compact('suratkeluar'));
    }

    public function create()
    {
        $klasifikasi = Klasifikasi::all();
        return view('admin.suratkeluar.create', compact('klasifikasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'required',
            'tujuan_surat' => 'required',
            'isisurat' => 'required',
            'klasifikasi' => 'required',
            'tgl_surat' => 'required',
            'tgl_catat' => 'required',
            'keterangan' => 'required',
            'file_keluar' => 'required|mimes:pdf,doc,jpg,jpeg,png,docx'
        ]);

        $file_keluar = $request->file_keluar;
        $new_file = time(). $file_keluar->getClientOriginalName();
        $file_keluar->move('uploads/suratkeluar/', $new_file);

        SuratKeluar::create([
            'no_surat' => $request->no_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'isi' => $request->isisurat,
            'kode' => $request->klasifikasi,
            'tgl_catat' => $request->tgl_catat,
            'tgl_surat' => $request->tgl_surat,
            'filekeluar' => 'uploads/suratkeluar/' .$new_file,
            'keterangan' => $request->keterangan
        ]);

        return redirect('suratkeluar')->with('pesan', 'Berhasil ditambahkan');
    }

    public function edit($id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);
        $klasifikasi = Klasifikasi::all();
        return view('admin.suratkeluar.edit', compact('suratkeluar', 'klasifikasi'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'no_surat' => 'required',
            'isisurat' => 'required',
            'klasifikasi' => 'required',
            'tgl_surat' => 'required',
            'tgl_catat' => 'required',
            'keterangan' => 'required',
            'file_keluar' => 'mimes:pdf,doc,jpg,jpeg,png,docx'
        ]);

        $suratkeluar = SuratKeluar::findOrFail($id);

        if ($request->has('file_keluar')) {
            $file = $request->file_keluar;
            $new_file = Str::random(16) .$file->getClientOriginalName();
            $file->move('uploads/suratkeluar/', $new_file);

            if ($surakeluar->filekeluar != '') {
                unlink($surakeluar->filekeluar);
            }
        }

        $suratkeluar->isi = $request->isisurat;
        $suratkeluar->kode = $request->klasifikasi;
        $suratkeluar->keterangan = $request->keterangan;
        $suratkeluar->filekeluar = $request->file_keluar != '' ? $new_file : $suratkeluar->filekeluar;
        $suratkeluar->save();

        return redirect('suratkeluar')->with('pesan', 'Berhasil diupdate');
    }

    public function destroy($id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);
        unlink($suratkeluar->filekeluar);
        $suratkeluar->delete();

        return redirect('suratkeluar')->with('pesan', 'Berhasil dihapus');
    }
}

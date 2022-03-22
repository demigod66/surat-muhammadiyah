<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{SuratKeluar, Klasifikasi, Instansi};
use PDF;
use Illuminate\Support\Str;

class SuratKeluarController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $suratkeluar = SuratKeluar::select('tbl_klasifikasi.nama', 'suratkeluar.*')->join('tbl_klasifikasi', 'tbl_klasifikasi.id', '=', 'suratkeluar.kode')->get();
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
            'tgl_terima' => 'required',
            'keterangan' => 'required',
            'file_keluar' => 'required|mimes:pdf,doc,jpg,jpeg,png,docx'
        ]);

        $file_keluar = $request->file_keluar;
        $new_file = time() . $file_keluar->getClientOriginalName();
        $file_keluar->move('uploads/suratkeluar/', $new_file);

        SuratKeluar::create([
            'no_surat' => $request->no_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'isi' => $request->isisurat,
            'kode' => $request->klasifikasi,
            'tgl_catat' => $request->tgl_terima,
            'tgl_surat' => $request->tgl_surat,
            'filekeluar' => 'uploads/suratkeluar/' . $new_file,
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
            'isisurat' => 'required',
            'klasifikasi' => 'required',
            'keterangan' => 'required',
            'file_keluar' => 'mimes:pdf,doc,jpg,jpeg,png,docx'
        ]);

        $suratkeluar = SuratKeluar::findOrFail($id);

        if ($request->has('file_keluar')) {
            $file = $request->file_keluar;
            $new_file = Str::random(16) . $file->getClientOriginalName();
            $file->move('uploads/suratkeluar/', $new_file);

            // if ($surakeluar->filekeluar != '') {
            //     unlink($surakeluar->filekeluar);
            // }
        }

        $suratkeluar->isi = $request->isisurat;
        $suratkeluar->kode = $request->klasifikasi;
        $suratkeluar->keterangan = $request->keterangan;
        $suratkeluar->filekeluar = $request->file_keluar != '' ? $new_file : $suratkeluar->filekeluar;
        $suratkeluar->save();

        return redirect('suratkeluar')->with('pesan', 'Berhasil diubah');
    }

    public function destroy($id)
    {
        $suratkeluar = SuratKeluar::findOrFail($id);
        unlink($suratkeluar->filekeluar);
        $suratkeluar->delete();

        return redirect('suratkeluar')->with('pesan', 'Berhasil dihapus');
    }

    public function agenda()
    {
        $suratkeluar = SuratKeluar::select('tbl_klasifikasi.nama', 'suratkeluar.*')->join('tbl_klasifikasi', 'tbl_klasifikasi.id', '=', 'suratkeluar.kode')->get();
        return view('admin.suratkeluar.agenda', compact('suratkeluar'));
    }

    public function agendakeluar_pdf()
    {
        $suratkeluar = SuratKeluar::select('tbl_klasifikasi.nama', 'suratkeluar.*')->join('tbl_klasifikasi', 'tbl_klasifikasi.id', '=', 'suratkeluar.kode')->get();
        $inst = Instansi::first();
        $pdf = PDF::loadview('admin.suratkeluar.print', compact('suratkeluar', 'inst'))->setPaper('A4', 'potrait');
        return $pdf->stream("agenda-suratkeluar.pdf", array("Attachment" => false));
        exit(0);
    }
}

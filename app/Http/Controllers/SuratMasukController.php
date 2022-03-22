<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Klasifikasi, SuratMasuk, Instansi, User, Disposisi};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

class SuratMasukController extends Controller
{
    public function index()
    {
        if (Auth::user()->tipe == 1) {
            $suratmasuk = SuratMasuk::select('tbl_klasifikasi.nama', 'suratmasuk.*', 'disposisi.suratmasuk_id', 'users.name')->join('tbl_klasifikasi', 'tbl_klasifikasi.id', '=', 'suratmasuk.kode')->join('disposisi', 'disposisi.suratmasuk_id', '=', 'suratmasuk.id', 'left')->join('users', 'users.id', '=', 'disposisi.tujuan', 'left')->get();
        } else {
            $suratmasuk = Disposisi::select('suratmasuk.*')->join('suratmasuk', 'suratmasuk.id', '=', 'disposisi.suratmasuk_id')->where('tujuan', Auth::user()->id)->get();
        }
        return view('admin.suratmasuk.index', compact('suratmasuk'));
    }

    public function create()
    {
        $klasifikasi = Klasifikasi::all();
        return view('admin.suratmasuk.create', compact('klasifikasi'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'no_surat' => 'required',
            'asal_surat' => 'required',
            'isisurat' => 'required',
            'klasifikasi' => 'required',
            'tgl_surat' => 'required',
            'keterangan' => 'required',
            'file_masuk' => 'required|mimes:pdf,doc,jpg,jpeg,png,docx'
        ]);

        $file_masuk = $request->file_masuk;
        $new_file = time() . $file_masuk->getClientOriginalName();
        $file_masuk->move('uploads/suratmasuk/', $new_file);

        SuratMasuk::create([
            'no_surat' => $request->no_surat,
            'asal_surat' => $request->asal_surat,
            'isi' => $request->isisurat,
            'kode' => $request->klasifikasi,
            'tgl_surat' => $request->tgl_surat,
            'file_masuk' => 'uploads/suratmasuk/' . $new_file,
            'keterangan' => $request->keterangan
        ]);

        return redirect('suratmasuk')->with('pesan', 'Berhasil ditambahkan');
    }

    public function edit($id)
    {
        $klasifikasi = Klasifikasi::all();
        $suratmasuk = SuratMasuk::findorfail($id);
        return view('admin.suratmasuk.edit', compact('suratmasuk', 'klasifikasi'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'isisurat' => 'required',
            'klasifikasi' => 'required',
            'keterangan' => 'required',
            'file_masuk' => 'mimes:pdf,doc,jpg,jpeg,png,docx'
        ]);

        $suratmasuk = SuratMasuk::findorfail($id);

        if ($request->has('filemasuk')) {
            $file = $request->filemasuk;
            $new_file = time() . $file->getClientOriginalName();
            $file->move('uploads/suratmasuk/', $new_file);

            // if ($suratmasuk->file_masuk != '') {
            //     unlink($suratmasuk->file_masuk);
            // }
        }

        $suratmasuk->isi = $request->isisurat;
        $suratmasuk->kode = $request->klasifikasi;
        $suratmasuk->keterangan = $request->keterangan;
        $suratmasuk->file_masuk = $request->filemasuk != '' ? $new_file : $suratmasuk->file_masuk;
        $suratmasuk->save();

        return redirect('suratmasuk')->with('pesan', 'Berhasil diubah');
    }

    public function destroy($id)
    {
        $suratmasuk = SuratMasuk::findOrFail($id);
        unlink($suratmasuk->file_masuk);
        $suratmasuk->delete();

        return redirect('suratmasuk')->with('pesan', 'Berhasil dihapus');
    }

    public function disposisi($id)
    {
        $suratmasuk = SuratMasuk::findOrFail($id);
        $user = User::all();

        return view('admin.suratmasuk.disposisi', compact('suratmasuk', 'user'));
    }

    public function kirim(Request $request)
    {
        request()->validate([
            'disposisi' => 'required',
            'isi_disposisi' => 'required',
        ]);

        Disposisi::create([
            'tujuan' => $request->disposisi,
            'isi' => $request->isi_disposisi,
            'users_id' => Auth::user()->id,
            'suratmasuk_id' => $request->id
        ]);

        return redirect('suratmasuk')->with('pesan', 'Disposisi surat berhasil');
    }

    public function agenda()
    {
        $this->middleware('admin');
        $suratmasuk = SuratMasuk::select('tbl_klasifikasi.nama', 'suratmasuk.*')->join('tbl_klasifikasi', 'tbl_klasifikasi.id', '=', 'suratmasuk.kode')->get();
        return view('admin.suratmasuk.agenda', compact('suratmasuk'));
    }

    public function agendamasuk_pdf()
    {
        $suratmasuk = SuratMasuk::select('tbl_klasifikasi.nama', 'suratmasuk.*')->join('tbl_klasifikasi', 'tbl_klasifikasi.id', '=', 'suratmasuk.kode')->get();
        $inst = Instansi::first();
        $pdf = PDF::loadview('admin.suratmasuk.print', compact('suratmasuk', 'inst'))->setPaper('A4', 'potrait');
        return $pdf->stream("agenda-suratmasuk.pdf", array("Attachment" => false));
        exit(0);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Klasifikasi, SuratMasuk, Instansi};
use PDF;

class SuratMasukController extends Controller
{
    public function index(){
        $suratmasuk = SuratMasuk::select('tbl_klasifikasi.nama', 'suratmasuk.*')->join('tbl_klasifikasi', 'tbl_klasifikasi.id', '=', 'suratmasuk.kode')->get();
        return view('admin.suratmasuk.index', compact('suratmasuk'));
    }

    public function create(){
        $klasifikasi = Klasifikasi::all();
        return view('admin.suratmasuk.create', compact('klasifikasi'));
    }

    public function store(Request $request){
        request()->validate([
            'no_surat' => 'required',
            'asal_surat' => 'required',
            'isisurat' => 'required',
            'klasifikasi' => 'required',
            'tgl_surat' => 'required',
            'tgl_terima' => 'required',
            'keterangan' => 'required',
            'file_masuk' => 'required|mimes:pdf,doc,jpg,jpeg,png,docx'
        ]);

        $file_masuk = $request->file_masuk;
        $new_file = time().$file_masuk->getClientOriginalName();
        $file_masuk->move('uploads/suratmasuk/', $new_file);

        SuratMasuk::create([
            'no_surat' => $request->no_surat,
            'asal_surat' => $request->asal_surat,
            'isi' => $request->isisurat,
            'kode' => $request->klasifikasi,
            'tgl_surat' => $request->tgl_surat,
            'tgl_terima' => $request->tgl_terima,
            'file_masuk' => 'uploads/suratmasuk/' .$new_file,
            'keterangan' => $request->keterangan
        ]);

        return redirect('suratmasuk')->with('pesan', 'Berhasil ditambahkan');

    }

    public function edit($id){
        $klasifikasi = Klasifikasi::all();
        $suratmasuk = SuratMasuk::findorfail($id);
        return view('admin.suratmasuk.edit', compact('suratmasuk','klasifikasi'));
    }

    public function update(Request $request, $id){
        request()->validate([
            'isisurat' => 'required',
            'klasifikasi' => 'required',
            'keterangan' => 'required',
            'file_masuk' => 'mimes:pdf,doc,jpg,jpeg,png,docx'
        ]);

        $suratmasuk = SuratMasuk::findorfail($id);

        if ($request->has('filemasuk')) {
            $file = $request->filemasuk;
            $new_file = time().$file->getClientOriginalName();
            $file->move('uploads/suratmasuk/', $new_file);

            if ($suratmasuk->file_masuk != '') {
                unlink($suratmasuk->file_masuk);
            }
        }

        $suratmasuk->isi = $request->isisurat;
        $suratmasuk->kode = $request->klasifikasi;
        $suratmasuk->keterangan = $request->keterangan;
        $suratmasuk->file_masuk = $request->filemasuk != '' ?$new_file : $suratmasuk->file_masuk;
        $suratmasuk->save();

        return redirect('suratmasuk')->with('pesan', 'Berhasil diubah');
    }

    public function destroy($id){
        $suratmasuk = SuratMasuk::findOrFail($id);
        unlink($suratmasuk->file_masuk);
        $suratmasuk->delete();

        return redirect('suratmasuk')->with('pesan', 'Berhasil dihapus');
    }

    public function agenda(){
        $suratmasuk = SuratMasuk::select('tbl_klasifikasi.nama', 'suratmasuk.*')->join('tbl_klasifikasi', 'tbl_klasifikasi.id', '=', 'suratmasuk.kode')->get();
        return view('admin.suratmasuk.agenda', compact('suratmasuk'));
    }
    
    public function agendamasuk_pdf(){
        $suratmasuk = SuratMasuk::select('tbl_klasifikasi.nama', 'suratmasuk.*')->join('tbl_klasifikasi', 'tbl_klasifikasi.id', '=', 'suratmasuk.kode')->get();
        $inst = Instansi::first();
        $pdf = PDF::loadview('admin.suratmasuk.print', compact('suratmasuk','inst'))->setPaper('A4','potrait');
        return $pdf->stream( "agenda-suratmasuk.pdf", array("Attachment" => false));
        exit(0);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use App\Models\Klasifikasi;
use App\Models\SuratMasuk;
use PDF;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class SuratMasukController extends Controller
{
    public function index()
    {
        $suratmasuk = SuratMasuk::all();
        if (Request()->ajax()) {
            return DataTables::of($suratmasuk)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="'.route('suratmasuk.edit', $row->id).'" title="Ubah" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';

                    $btn = $btn . '   <a href="'.asset($row->file_masuk).'" title="Unduh" target="__blank"  class="btn btn-warning btn-sm"><i class="fas fa-download"></i></a>';

                    $btn = $btn . '<a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onClick="hapus(' . $row->id . ')"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
            }

            return view('admin.suratmasuk.index');
    }

    public function create()
    {
        $klasifikasi = Klasifikasi::all();
        return view('admin.suratmasuk.create', compact('klasifikasi'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'file_masuk' => 'required|max:2048'
        ]);

        $file_masuk = $request->file_masuk;
        $new_file = time(). $file_masuk->getClientOriginalName();

        SuratMasuk::create([
            'no_surat' => $request->no_surat,
            'asal_surat' => $request->asal_surat,
            'isi' => $request->isisurat,
            'kode' => $request->klasifikasi,
            'tgl_surat' => $request->tgl_surat,
            'tgl_terima' => $request->tgl_catat,
            'file_masuk' => 'uploads/suratmasuk/' .$new_file,
            'keterangan' => $request->keterangan
        ]);

        $file_masuk->move('uploads/suratmasuk/', $new_file);

        echo json_encode(["status" => TRUE]);
    }
    function edit($id)
    {
        $klasifikasi = Klasifikasi::all();
        $suratmasuk = SuratMasuk::findorfail($id);
        return view('admin.suratmasuk.edit', compact('suratmasuk','klasifikasi'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'filemasuk' => 'mimes:pdf'
        ]);


        if ($request->has('filemasuk')) {
            $file = $request->filemasuk;
            $new_file = Str::random(16) .$file->getClientOriginalName();
            $file->move('uploads/suratmasuk/', $new_file);
            $suratmasuk = SuratMasuk::findorfail($id);

            if ($suratmasuk->file_masuk != '') {
                unlink($suratmasuk->file_masuk);
            }

            $file_data['file_masuk'] = 'uploads/suratmasuk/'. $new_file;
            SuratMasuk::whereId($id)->update($file_data);
            echo json_encode(["status" => TRUE]);

        }
    }
    public function destroy($id)
    {
        $suratmasuk = SuratMasuk::findOrFail($id);
        unlink($suratmasuk->file_masuk);
        $suratmasuk->delete();

        echo json_encode(["status" => TRUE]);
    }

    public function agenda(){
        $suratmasuk = SuratMasuk::all();
        return view('admin.suratmasuk.agenda', compact('suratmasuk'));

    }

    public function agendamasuk_pdf(){
        $suratmasuk = SuratMasuk::all();
        $inst = Instansi::first();
        $pdf = PDF::loadview('admin.suratmasuk.print', compact('suratmasuk','inst'))->setPaper('A4','potrait');
        return $pdf->stream( "agenda-suratmasuk.pdf", array("Attachment" => false));
        exit(0);
    }
}

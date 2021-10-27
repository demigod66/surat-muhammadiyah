<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{SuratKeluar, Klasifikasi};
use Yajra\DataTables\Facades\DataTables;

class SuratKeluarController extends Controller
{

    public function index()
    {
        $suratkeluar = SuratKeluar::all();
        if (Request()->ajax()) {
            return DataTables::of($suratkeluar)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="'.route('suratkeluar.edit', $row->id).'" title="Ubah" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn = $btn . ' <a href="'.asset($row->filekeluar).'" title="Unduh" class="edit btn btn-warning btn-sm"><i class="fas fa-download"></i></a> ';

                    $btn = $btn . ' <a href="javascript:void(0)" title="Hapus" class="btn btn-danger btn-sm" onclick="hapus('."'".$row->id."'".')"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.suratkeluar.index');
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
            'file_masuk' => 'required'
        ]);

        $file_keluar = $request->file_keluar;
        $new_file = time(). $file_keluar->getClientOriginalName();
        $file_keluar->move('uploads/suratkeluar/', $new_file);

        SuratKeluar::created([
            'no_surat' => $request->no_surat,
            'tujuan_surat' => $request->tujuan_surat,
            'isi' => $request->isisurat,
            'kode' => $request->klasifikasi,
            'tgl_catat' => $request->tgl_catat,
            'tgl_surat' => $request->tgl_surat,
            'filekeluar' => 'uploads/suratkeluar/' .$new_file,
            'keterangan' => $request->keterangan
        ]);
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;
use Auth;

class InstansiController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $instansi = Instansi::where('id', 1)->first();
        return view('admin.instansi.index', compact('instansi'));
    }

    public function show()
    {
        $instansi = Instansi::where('id', 1)->first();
        return view('admin.instansi.show', compact('instansi'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'file|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|email',
            'nama' => 'required|min:5',
            'pimpinan' => 'required|min:5',
        ]);

        $instansi = Instansi::findorfail($id);

        if ($request->has('file')) {
            $file = $request->file;
            $new_file = time() . $file->getClientOriginalName();
            $file->move('uploads/logo', $new_file);

            // if ($instansi->file != '') {
            //     unlink(public_path($instansi->file));
            // }
        }

        $instansi->nama = $request->nama;
        $instansi->alamat = $request->alamat;
        $instansi->pimpinan = $request->pimpinan;
        $instansi->email = $request->email;
        $instansi->file = $request->file != '' ? $new_file : $instansi->file;
        $instansi->save();
        return redirect('instansi');
    }
}

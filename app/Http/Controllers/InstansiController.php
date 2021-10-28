<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Illuminate\Http\Request;

class InstansiController extends Controller
{
    public function index(){
        $instansi = Instansi::where('id',1)->first();
        return view('admin.instansi.index', compact('instansi'));
    }

    public function show()
    {
        $instansi = Instansi::where('id', 1)->first();
        return view('admin.instansi.show', compact('instansi') );
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'file' => 'file|mimes:png,jpg,jpeg|max:2048',
            'email' => 'required|email',
            'nama' => 'required|min:5',
            'pimpinan'=> 'required|min:5',

        ]);

        if ($request->file != '') {
            $file = $request->file;
            $new_file = time() .$file->getClientOriginalName();
            $file->move('uploads/logo/', $new_file);
            $file = Instansi::findorfail($id);

            if ($file->file != '') {
                unlink($file->file);
            }

            $file_data['file'] = 'uploads/logo/'. $new_file;
        }

        $file_data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'pimpinan' => $request->pimpinan,
            'email' => $request->email,
        ];

        Instansi::whereId($id)->update($file_data);
        return redirect('instansi');
    }

}
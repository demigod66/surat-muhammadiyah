<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, Hash};
use App\Models\User;

class UserController extends Controller
{
	public function index() {
		$user = User::all();
		return view('admin.user.index', compact('user'));
	}

	public function create() {
		return view('admin.user.create');
	}

	public function store(Request $request) {

		$request->validate([
			'nama_user' => 'required',
			'email' => 'required',
			'tipe' => 'required',
			'password' => 'required',
		]);

		User::create([
			'name' => $request->nama_user,
			'email' => $request->email,
			'tipe' => $request->tipe,
			'password' =>  bcrypt($request->password)
		]);

		return redirect('user')->with('pesan', 'Berhasil ditambahkan');
	}

	public function edit($id) {
		$user = User::findorfail($id);
		return view('admin.user.edit' , compact('user'));
	}


	public function update(Request $request, $id) {

		$request->validate([
			'nama_user' => 'required',
			'email' => 'required',
			'tipe' => 'required'
		]);

		$user = User::findorfail($id);

		$user->name = $request->nama_user;
		$user->email = $request->email;
		$user->tipe = $request->tipe;
		$user->password = $request->password != '' ? bcrypt($request->password) : $user->password;
		$user->save();

		return redirect('user')->with('pesan', 'Berhasil diubah');

	}

	public function destroy($id) {
		$user = User::findOrFail($id);
		$user->delete();

        return redirect('user')->with('pesan', 'Berhasil dihapus');
	}

    public function profil(){
        $user = Auth::user();
        return view('admin.user.profil', compact('user'));
    }

    public function ubah_profil(Request $request, $id){
    	$user = User::findorfail($id);

        $request->validate([
            'nama' => 'required',
        ]);

        $user->name = $request->nama;
        $user->save();

		return redirect('user/profil')->with('pesan', 'Berhasil diubah');
    }
    
    public function password(){
        return view('admin.user.password');
    }

    public function ubah_password(Request $request){
    	$user = Auth::user();

        $request->validate([
            'pass_lama' => 'required',
            'pass_baru' => 'required|same:pass_conf',
            'pass_conf' => 'required'
        ]);

        $user->password = bcrypt($request->pass_conf);
        $user->save();

		return redirect('user/password')->with('pesan', 'Berhasil diubah');
    }
}

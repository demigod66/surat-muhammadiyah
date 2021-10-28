<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('admin.user.index', compact('user'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        if ($request->input('password')){
            $password = bcrypt($request->password);
            }else {
                $password = bcrypt(123456);
            }

            $foto = $request->foto;
            $new_foto = time(). $foto->getClientOriginalName();

            User::create([
                'name' => $request->nama_user,
                'email' => $request->email,
                'tipe' => $request->tipe,
                'foto' => 'uploads/foto/' .$new_foto,
                'password' =>  $password
            ]);


            $foto->move('uploads/foto/', $new_foto);


        echo json_encode(["status" => TRUE]);
    }

    public function edit($id)
    {
        $user = User::findorfail($id);
        return view('admin.user.edit' , compact('user'));
    }


    public function update(Request $request, $id)
    {
        if($request->input('password')) {
            $user_data = [
                'name' => $request->nama_user,
                'email' => $request->email,
                'tipe' => $request->tipe,
                'password' => bcrypt($request->password)
                ];
         }
         else{
            $user_data = [
                'name' => $request->nama_user,
                'email' => $request->email,
                'tipe' => $request->tipe,
                ];
         }
         User::whereId($id)->update($user_data);
         echo json_encode(["status" => TRUE]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        echo json_encode(["status" => TRUE]);
    }
}

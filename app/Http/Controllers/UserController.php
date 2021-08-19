<?php

namespace App\Http\Controllers;

use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        if (Request()->ajax()) {
            return DataTables::of($user)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $btn =  '<a href="'.route('user.edit', $row->id).'" title="Ubah" class="edit btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>';

                    $btn = $btn . ' <a href="javascript:void(0)" title="Delete" class="btn btn-danger btn-sm" onClick="hapus(' . $row->id . ')"><i class="fas fa-trash"></i></a>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

    public function show($id)
    {
        //
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

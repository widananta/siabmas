<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
class DosenController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dosen = User::where('role', 'dosen')->get();
        return view('dashboard.admin.dosen', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'image' => 'max:3000|mimes:jpg,jpeg,png',
            'name' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'password' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'role' => 'required',
            'tgl_lahir' => 'required',
        ];

        $rulesMessages = [
            'max' => 'Maksimal file 3MB!',
            'required' => 'Wajib diisi!',
            'mimes' => 'Format harus jpg, jpeg, png!'
        ];
        $this->validate($request, $rules, $rulesMessages);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'nip' => $request->nip,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
        ];
        if ($request->hasFile('image')) {
            
            $name = Carbon::now()->format('d_m_Y') . "_" . mt_rand(0001, 9999);
            $image = $request->image;
            $image_name = "Foto_Profil_" . $name . '.' . $image->getClientOriginalExtension();
            // return($image_name);
            $image->storeAs('public/profil/', $image_name);
            $data['foto'] = (string) $image_name;
        } 
        User::create($data);

        return back()->withStatus(__('Data Dosen berhasil ditambahkan'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $rules = [
            'name' => 'required',
            'nip' => 'required',
            'email' => 'required',
            'id' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tgl_lahir' => 'required',
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!',
        ];
        $this->validate($request, $rules, $rulesMessages);
        $User = User::find($request->id);
        $data = [
            'name' => $request->name,
            'nip' => $request->nip,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tgl_lahir' => $request->tgl_lahir,
        ];
        if($request->password!=null){
            $data['password'] = Hash::make($request->password);
        }
        $User->update($data);
        return back()->withStatus(__('Data Dosen berhasil diubah'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $User = User::find($id);
        if(!$User->pengampu->isEmpty()){
            return view('errors/404');
        }
        $User->delete();
        return back()->withStatus(__('Data Dosen berhasil dihapus'));
    }
}

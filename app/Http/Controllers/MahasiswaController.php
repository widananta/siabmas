<?php

namespace App\Http\Controllers;


use App\Mahasiswa;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->reguuid = '/[0-9a-fA-F]{8}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{4}\-[0-9a-fA-F]{12}/';
    }
    public function index()
    {
        $mahasiswa = mahasiswa::latest()->get();
        return view('dashboard/admin/mahasiswa', ['data' => $mahasiswa, 'status' => '']);
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
            'nama' => 'required',
            'nim' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'angkatan' => 'required',
        ];

        $rulesMessages = [
            'max' => 'Maksimal file 3MB!',
            'required' => 'Wajib diisi!',
            'mimes' => 'Format harus jpg, jpeg, png!'
        ];
        $this->validate($request, $rules, $rulesMessages);
        $data = [
            'id' => (string) Str::uuid(),
            'nama' => $request->nama,
            'nim' => $request->nim,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->prodi.' '.$request->angkatan,
        ];
        if ($request->hasFile('image')) {
            
            $name = Carbon::now()->format('d_m_Y') . "_" . mt_rand(0001, 9999);
            $image = $request->image;
            $image_name = "Foto_Mahasiswa_" . $name . '.' . $image->getClientOriginalExtension();
            // return($image_name);
            $image->storeAs('public/mahasiswa/', $image_name);
            $data['foto'] = (string) $image_name;
        } 
        mahasiswa::create($data);

        return back()->withStatus(__('Data Mahasiswa berhasil ditambahkan'));
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
        //
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
            'image' => 'max:3000|mimes:jpg,jpeg,png',
            'nama' => 'required',
            'nim' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'prodi' => 'required',
            'angkatan' => 'required',
        ];

        $rulesMessages = [
            'max' => 'Maksimal file 3MB!',
            'required' => 'Wajib diisi!',
            'mimes' => 'Format harus jpg, jpeg, png!'
        ];
        $Mahasiswa = Mahasiswa::find($request->id);
        $data = [
            'nama' => $request->nama,
            'nim' => $request->nim,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kelas' => $request->prodi.' '.$request->angkatan,
        ];
        if ($request->hasFile('image')) {
            $filepath = public_path() . '/storage/mahasiswa/' . $Mahasiswa->foto;
            if (is_file($filepath)) {
                unlink($filepath);
            }
            $name = Carbon::now()->format('d_m_Y') . "_" . mt_rand(0001, 9999);
            $image = $request->image;
            $image_name = "Foto_Mahasiswa_" . $name . '.' . $image->getClientOriginalExtension();
            // return($image_name);
            $image->storeAs('public/mahasiswa/', $image_name);
            $data['foto'] = (string) $image_name;
        } 
        $Mahasiswa->update($data);
        return back()->withStatus(__('Data Mahasiswa berhasil diubah'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $match = preg_match($this->reguuid, $id);
        // return($match);
        if ($match == '0') {
            return view('errors/404');
        }
        $mahasiswa = mahasiswa::find($id);
        if ($mahasiswa == null) {
            return view('errors/404');
        }
        $mahasiswa->delete();
        return back()->withStatus(__('Data Mahasiswa berhasil dihapus'));
    }
}

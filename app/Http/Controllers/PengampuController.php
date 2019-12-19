<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Pengampu;
use App\Matkul;
use App\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
class PengampuController extends Controller
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
        $pengampu = pengampu::latest()->get();
        $matkul = matkul::orderBy('nama_matkul','asc')->get();
        $dosen = User::where('role', 'dosen')->orderBy('name','asc')->get();
        return view('dashboard/admin/pengampu', ['data' => $pengampu, 'matkul'=>$matkul,'dosen'=>$dosen,]);
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
            'tahun' => 'required',
            'dosen' => 'required',
            'mata_kuliah' => 'required',
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!',
        ];
        $this->validate($request, $rules, $rulesMessages);
        $data = [
            'id' => (string) Str::uuid(),
            'tahun' => $request->tahun,
            'user_id' => $request->dosen,
            'matkul_id' => $request->mata_kuliah,
        ];
        pengampu::create($data);

        return back()->withStatus(__('Data Matkul dan Dosen Pengampu berhasil ditambahkan'));
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
            'tahun' => 'required',
            'dosen' => 'required',
            'mata_kuliah' => 'required',
        ];

        $rulesMessages = [
            'required' => 'Wajib diisi!',
        ];
        $this->validate($request, $rules, $rulesMessages);
        $data = [
            'tahun' => $request->tahun,
            'user_id' => $request->dosen,
            'matkul_id' => $request->mata_kuliah,
        ];
        $pengampu = pengampu::find($request->id);
        $pengampu->update($data);

        return back()->withStatus(__('Data Matkul dan Dosen Pengampu berhasil ditambahkan'));
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
        $pengampu = pengampu::find($id);
        if ($pengampu == null) {
            return view('errors/404');
        }
        $pengampu->delete();
        return back()->withStatus(__('Data Pengampu Mata Kuliah berhasil dihapus'));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pengampu;
use App\mahasiswa;

class PengampumhsController extends Controller
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
        $pengampu = pengampu::where('user_id',auth()->user()->id)->latest()->get();
        // $matkul = matkul::orderBy('nama_matkul','asc')->get();
        // $dosen = User::where('role', 'dosen')->orderBy('name','asc')->get();
        return view('dashboard/dosen/pengampu_mhs', ['data' => $pengampu]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        return view('forms/show/pengampu_mhs', ['data' => $pengampu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
        $mahasiswa = mahasiswa::latest()->get();
        return view('forms/edit/pengampu_mhs', ['data' => $mahasiswa,'pengampu'=>$pengampu]);
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
        $match = preg_match($this->reguuid, $request->id);
        // return($match);
        if ($match == '0') {
            return view('errors/404');
        }
        $pengampu = pengampu::find($request->id);
        if ($pengampu == null) {
            return view('errors/404');
        }
        if($request->mahasiswa_id!=null){
            for ($i = 0; $i < count($request->mahasiswa_id); $i++) {
                $data[$request->id[$i]]=['mahasiswa_id' => $request->mahasiswa_id[$i]];
            }
            $pengampu->mahasiswa()->sync($data);
        }else{
            $pengampu->mahasiswa()->delete();
        }
        return redirect('dashboard/pengampu_mhs')->withStatus(__('Daftar Mahasiswa'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

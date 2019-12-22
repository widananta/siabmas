<?php

namespace App\Http\Controllers;

use App\matkul;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class MatkulController extends Controller
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
        $matkul = matkul::latest()->get();
        return view('dashboard/admin/matkul', ['data' => $matkul, 'status' => '']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_matkul' => 'required',
            'sks' => 'required',
        ]);
        matkul::create([
            'id' => (string) Str::uuid(),
            'nama_matkul' => $request->nama_matkul,
            'sks' => $request->sks,
        ]);
        return redirect('dashboard/matkul')->withStatus(__('Matkul Berhasil Ditambahkan'));
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
        $this->validate($request, [
            'nama_matkul' => 'required',
            'sks' => 'required',
        ]);
        $matkul = matkul::find($request->id);
        $matkul->nama_matkul = $request->nama_matkul;
        $matkul->sks = $request->sks;
        $matkul->save();
        return redirect('dashboard/matkul')->withStatus(__('Matkul Berhasil Diubah'));
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
        $matkul = matkul::find($id);
        if ($matkul == null) {
            return view('errors/404');
        }
        if(!$matkul->pengampu->isEmpty()){
            return view('errors/404');
        }
        $matkul->delete();
        return redirect('dashboard/matkul')->withStatus(__('Matkul Berhasil Dihapus'));
    }
}

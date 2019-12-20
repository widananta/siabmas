<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\mahasiswa;
use App\pengampu;
use App\absent;
class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
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
        //1.cari mahasiswa
        $mahasiswa = mahasiswa::where('nim',$request->nim)->first();

        //2.cek jika mahasiswa tak ditemukan
        if($mahasiswa==null){
            return back()->with('peringatan', 'warning')->with('status', 'NIM tidak Ditemukan');
        }

        //3.deklarasi jam sekarang
        $now = date('Y-m-d H:i:s');

        //4.cari absent
        $absent = absent::where('kode',$request->kode)->whereDate('ends',$now)->first();

        //5.cek jika absent tak ditemukan
        if($absent==null){
            return back()->with('peringatan', 'warning')->with('status', 'Absent tidak Ditemukan');
        }

        //6.cek mahasiswa terdaftar atau tidak
        if($absent->pengampu->mahasiswa->contains($mahasiswa->id)){
        }else{
            return back()->with('peringatan', 'warning')->with('status', 'Anda tidak terdaftar di Mata Kuliah '. $absent->pengampu->matkul->nama_matkul.' '.$absent->pengampu->tahun);
        }

        //7.cek jika absent sudah berakhir
        if($absent->ends<$now){
            return back()->with('peringatan', 'warning')->with('status', 'Absent Mata Kuliah '. $absent->pengampu->matkul->nama_matkul.' '.$absent->pengampu->tahun.' , pertemuan ke '.$absent->pertemuan_ke.' telah berakhir');
        }
        
        //8.cari data di tabel pivot
        $absent_mahasiswa = DB::table('absent_mahasiswa')->where('mahasiswa_id',$mahasiswa->id)->where('absent_id',$absent->id)->first();
        if($absent_mahasiswa==null){
            DB::table('absent_mahasiswa')->insert(
                ['mahasiswa_id' => $mahasiswa->id,
                 'absent_id' => $absent->id,
                 'created_at' => $now,
                 'updated_at' => $now,
                 ]
            );
        }
        return back()->with('peringatan', 'success')->with('status', 'Selamat! Anda berhasil '. $absent->pengampu->matkul->nama_matkul.' '.$absent->pengampu->tahun.' , pertemuan ke '.$absent->pertemuan_ke.' atas nama '.$mahasiswa->nama);

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
    public function update(Request $request, $id)
    {
        //
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

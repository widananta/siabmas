<?php

namespace App\Http\Controllers;

use App\User;
use App\pengampu;
use App\Matkul;
use App\Mahasiswa;
class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(Auth()->user()->role == 'dosen'){
            $pengampu=pengampu::where('user_id',Auth()->User()->id)->get();
            $mahasiswa=0;
            $absent=0;
            foreach($pengampu as $p){
                //jml total mahasiswa
                $mahasiswa+=$p->mahasiswa->count();
                //jml total absent
                $absent+=$p->absent->count();
            }
            return view('dashboard', ['mahasiswa' => $mahasiswa,'absent' => $absent]);
        }else{
            $dosen=user::where('role','dosen')->count();
            $matkul=matkul::count();
            $pengampu=pengampu::count();
            $mahasiswa=mahasiswa::count();
            return view('dashboard', ['matkul' => $matkul,'dosen' => $dosen,'pengampu' => $pengampu,'mahasiswa' => $mahasiswa]);
        }
    }
}

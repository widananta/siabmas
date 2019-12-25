<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\pengampu;
use App\mahasiswa;
use App\absent;
class AbsentController extends Controller
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
    public function index($id)
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
        $absent = absent::where('pengampu_id',$id)->get();
        $latestabsent = absent::where('pengampu_id',$id)->orderBy('ends', 'DESC')->first();
        return view('dashboard/dosen/absent', ['pengampu' => $pengampu,'data'=>$absent,'latestabsent'=>$latestabsent]);
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
        $starts =date('Y-m-d H:i:s');
        $ends =strtotime(date('Y-m-d H:i:s'))+900;
        $ends =date('Y-m-d H:i:s',$ends);
        //autorisasi password
        if (auth()->user() && Hash::check($request->password, auth()->user()->password)) {
            //mencari jumlah absent sebelumnya
            $latestabsent = absent::where('pengampu_id',$request->id)->get()->count();
            //deklarasi data
            $data = [
                'id' => (string) Str::uuid(),
                'pertemuan_ke' => $latestabsent+1,
                'kode' => rand(100000,999999),
                'starts' => $starts,
                'ends' => $ends,
                'pengampu_id' => $request->id,
            ];
            absent::create($data);
            return back()->with('peringatan', 'success')->with('status', 'Absent Berhasil Ditambahkan');
        }else{
            return back()->with('peringatan', 'danger')->with('status', 'Password yang anda masukkan Salah');
        }
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
        $absent = absent::find($id);
        if ($absent == null) {
            return view('errors/404');
        }
        return view('forms/show/absent', ['data'=>$absent]);
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

<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    
    public function index()
    {
        return view('dashboard.profile');
    }
    public function edit()
    {
        return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());
        return back()->withStatus(__('Profil Berhasil Dirubah'));

    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_photo(Request $request)
    { 
        $rules = [
            'image' => 'max:3000|mimes:jpg,jpeg,png'
        ];

        $rulesMessages = [
            'max' => 'Maksimal file 3MB!',
            'required' => 'Wajib diisi!',
            'mimes' => 'Format harus jpg, jpeg, png!'
        ];

        $this->validate($request, $rules, $rulesMessages);

        if ($request->hasFile('image')) {
            // $name = Carbon::now()->format('d_m_Y') . "_" . mt_rand(0001, 9999);
            $filepath = public_path() . '/storage/profil/' . auth()->user()->foto;
            if (is_file($filepath)) {
                unlink($filepath);
            }
            $name = Carbon::now()->format('d_m_Y') . "_" . mt_rand(0001, 9999);
            $image = $request->image;
            $image_name = "Foto_Profil_" . $name . '.' . $image->getClientOriginalExtension();
            // return($image_name);
            $image->storeAs('public/profil/', $image_name);
            $data['foto'] = (string) $image_name;
        } 
        auth()->user()->update($data);
        return back()->withStatus(__('Foto Profil Berhasil Dirubah'));
    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withPasswordStatus(__('Password successfully updated.'));
    }
}

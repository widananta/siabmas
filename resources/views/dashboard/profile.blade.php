@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('users.partials.header', [
        'title' => __('Hallo Admin') . ' '. auth()->user()->name,
        'description' => __(' \'ve made with your work and manage your projects or assigned tasks'),
        'class' => 'col-lg-7'
    ])   

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-12">
                <div class="card card-profile shadow">
                    <div class="row justify-content-center">
                        <div class="col-lg-3 order-lg-2">
                            <div class="card-profile-image">
                                <a href="#">
                                    @if(is_file(public_path() . '/storage/profil/' . Auth::user()->foto))
                                        <img src="{{ asset('storage/profil/'.Auth::user()->foto)}}" alt=""  height="175px" width="175px" class="rounded-circle">
                                    @else
                                        @if(Auth::user()->jenis_kelamin=='l')
                                            <img src="{{ asset('foto') }}/default/male.png" class="rounded-circle" height="175px" width="175px">
                                        @else
                                            <img src="{{ asset('foto') }}/default/female.png" class="rounded-circle" height="175px" width="175px">
                                        @endif
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-8 pt-md-4 pb-0 pb-md-4">
                        <div class="d-flex justify-content-between">
                        </div>
                    </div>
                    <div class="card-body pt-0 pt-md-4">
                        <div class="row">
                            <div class="col">
                                <div class="card-profile-stats d-flex justify-content-center mt-md-3">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <a href="javascript:void(0)" class="btn btn-info" data-toggle="modal" data-target="#change_photo">Ganti Foto</a>
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @include('modals.edit.profilephoto')
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title display-3">Informasi Pribadi</div>
                    </div>
                    <div class="card-body">
                        <table border="0" class="">
                            <tr >
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{Auth::user()->name}}</td>
                            </tr>
                            <tr>
                                <td>NIP</td>
                                <td>:</td>
                                <td>{{Auth::user()->nip}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{Auth::user()->email}}</td>
                            </tr>
                            <tr>
                                <td>Jenis Kelamin</td>
                                <td>:</td>
                                <td>
                                    @if(Auth::user()->jenis_kelamin=='l')
                                        Laki-laki
                                    @elseif(Auth::user()->jenis_kelamin=='p')
                                    Perempuan
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Tgl Lahir</td>
                                <td>:</td>
                                <td>{{ \Carbon\Carbon::parse(Auth::user()->tgl_lahir, 'Asia/Jakarta')->formatLocalized('%d %B %Y') }}</td>
                            </tr>
                            <tr>
                                <td>No Telp</td>
                                <td>:</td>
                                <td>{{Auth::user()->no_telp}}</td>
                            </tr>
                            <tr>
                                <td>alamat</td>
                                <td>:</td>
                                <td>{{Auth::user()->alamat}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="text-left">
                            <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#change_profil">Ubah Profil</a>
                            <a href="javascript:void(0)" class="btn btn-warning" data-toggle="modal" data-target="#change_password">Ganti Password</a>
                        </div>
                    </div>
                    @include('modals.edit.profile')
                    @include('modals.edit.profilepassword')
                </div>
            </div>
            <div class="col-md-6 mt-2">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title display-3">Data Mengajar</div>
                    </div>
                    @if(Auth::user()->role=='root_user')
                    <div class="card-body">
                        Anda adalah root_user anda tak memiliki Data Mengajar
                    </div>
                    @elseif(Auth::user()->role=='dosen')
                    <div class="card-body">
                        Data mengajar anda sebagai berikut
                        
                        <table border="0">
                            <tr >
                                <td>Jumlah Mata Kuliah yang diajar</td>
                                <td>:</td>
                                <td>{{Auth::user()->pengampu->count()}}</td>
                            </tr>
                            <tr>
                                <td class="align-top" rowspan="{{Auth::user()->pengampu->count()}}">Daftar Matkul</td>
                                <td class="align-top" rowspan="{{Auth::user()->pengampu->count()}}">:</td>
                                @foreach (Auth::user()->pengampu as $d)
                                <td>-{{$d->matkul->nama_matkul}}</td>
                            </tr>
                            <tr>
                                @endforeach
                            </tr>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection

@section('js')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    jQuery('#preview').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
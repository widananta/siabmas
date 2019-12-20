@extends('layouts.app', ['title' => __('Mata Kuliah')])

@section('content')
    @include('layouts.headers.nocards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                    <input type="hidden" name="id" value="{{$pengampu->id}}">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{$pengampu->matkul->nama_matkul}}</h3>
                                    <table border="0" class="table table-flush">
                                        <tr>
                                            <td>Nama Matkul</td>
                                            <td>:</td>
                                            <td>{{$pengampu->matkul->nama_matkul}}</td>
                                            <td>SKS</td>
                                            <td>:</td>
                                            <td>{{$pengampu->matkul->sks}}</td>
                                            <td>Total Pertemuan</td>
                                            <td>:</td>
                                            <td>{{$pengampu->absent->count()}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tahun</td>
                                            <td>:</td>
                                            <td>{{$pengampu->tahun}}</td>
                                            <td>Jumlah Mahasiswa</td>
                                            <td>:</td>
                                            <td>{{$pengampu->mahasiswa->count()}}</td>
                                            <td colspan="3"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="9">
                                            @if($pengampu->mahasiswa->count()>0)
                                                @if($latestabsent==null)
                                                    <a class="btn btn-sm btn-flush btn-success" href="javascript:void(0)" data-toggle="modal" data-target="#mulai_absent">Mulai Absent Baru</a>
                                                @else
                                                    <?php 
                                                        $date = new DateTime($latestabsent->ends); 
                                                        $now = new DateTime();    
                                                    ?>  
                                                    @if($now>$date)
                                                        <a class="btn btn-sm btn-flush btn-success" href="javascript:void(0)" data-toggle="modal" data-target="#mulai_absent">Mulai Absent Baru</a>
                                                    @endif
                                                @endif
                                                <a class="btn btn-sm btn-flush btn-info" href="javascript:void(0)" data-toggle="modal" data-target="#show_statistic">Lihat Statistik</a>
                                            @else
                                                Tidak bisa membuat absen karena jumlah mahasiswa = 0
                                            @endif
                                            </td>
                                            {{-- absentmodal --}}
                                            <div class="modal fade" id="mulai_absent" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="post" action="/dashboard/absent/store" autocomplete="off">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="editModalLabel">Mulai Absen Baru</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                                                    <input type="hidden" name="id" value="{{$pengampu->id}}">
                                                                    <label class="form-control-label" for="input-password">{{ __('Masukkan Password untuk memulai absen baru') }}</label>
                                                                    <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="" required>
                                                                        
                                                                    @if ($errors->has('password'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('password') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-primary"><i class="fa fa-pencil"></i>Simpan</button>
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>                        
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- endabsentmodal --}}
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                @if (session('status'))
                                    <div class="alert alert-{{(session('peringatan'))}} alert-dismissible fade show" role="alert">
                                        {{ session('status') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                            </div>

                            <div class="table-responsive">
                                <table class="table align-items-center table-flush" id="data_table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">{{ __('No') }}</th>
                                            <th scope="col">{{ __('Pertemuan Ke') }}</th>
                                            <th scope="col">{{ __('Kode') }}</th>
                                            <th scope="col">{{ __('Mulai') }}</th>
                                            <th scope="col">{{ __('Selesai') }}</th>
                                            <th scope="col">{{ __('Status') }}</th>
                                            <th scope="col">{{ __('Total Absent') }}</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $no=>$d)
                                        <tr>
                                            <td>{{$no+1}}</td>
                                            <td>{{$d->pertemuan_ke}}</td>
                                            <td>{{$d->kode}}</td>
                                            <td>{{ \Carbon\Carbon::parse($d->starts, 'Asia/Jakarta')->formatLocalized('%d %B %Y, %H:%M') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($d->ends, 'Asia/Jakarta')->formatLocalized('%d %B %Y, %H:%M') }}</td>
                                            <?php $date = new DateTime($d->ends); ?>  
                                            <td>
                                              @if($now>$date)
                                                <span class="badge badge-info">Absen Selesai</span>
                                              @else
                                                <span class="badge badge-success">{{$date->diff($now)->format("Tinggal %i Menit")}}</span>
                                              @endif
                                            </td>
                                            <td>{{$d->mahasiswa->count()}}</td>
                                            <td>
                                                <a href="/dashboard/absent/show/{{$d->id}}" class="btn btn-sm btn-info"><li class="fa fa-eye"></li></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/dashboard/pengampu_mhs" class="btn btn-warning">Keluar</a>
                        </div>
                    </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection
@section('js')
    <script src="{{ asset('assets/js/plugin/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#data_table").DataTable({
                "oLanguage": {
                    "sLengthMenu": "    Tampilkan _MENU_ data Absen",
                    "sZeroRecords": "Belum ada data Absen ",
                    "sInfoEmpty": "Menampilkan 0 data",
                    "sInfoFiltered": "",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ data Absen ",
                    "sSearch": "Cari: ",
                    "oPaginate": {
                        "sNext": ">",
                        "sPrevious": "<",
                    }
                },
                stateSave: true
            });
        });
    </script>
@endsection
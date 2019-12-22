@extends('layouts.app', ['title' => __('Mata Kuliah')])

@section('content')
    @include('layouts.headers.nocards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                <h3 class="mb-0">{{ __('Absensi ') }}{{$data->pengampu->matkul->nama_matkul}}</h3>
                                <?php 
                                    $now = new DateTime();    
                                    $date = new DateTime($data->ends);
                                ?> 
                                <table class="table table-flush">
                                    <tr>
                                        <td>Tanggal dan Jam</td>
                                        <td>:</td>
                                        <td>{{ \Carbon\Carbon::parse($data->starts, 'Asia/Jakarta')->formatLocalized('%d %B %Y, %H:%M') }}</td>
                                        <td>Status</td>
                                        <td>:</td>
                                        <td>
                                            @if($now>$date)
                                                <span class="badge badge-info">Absen Selesai</span>
                                              @else
                                                <span class="badge badge-success">{{$date->diff($now)->format("Tinggal %i Menit")}}</span>
                                              @endif
                                        </td>
                                        <td>Kode</td>
                                        <td>:</td>
                                        <td>{{$data->kode}}</td>
                                    </tr>
                                    <tr>
                                        <td>Pertemuan Ke</td>
                                        <td>:</td>
                                        <td>{{$data->pertemuan_ke}}</td>
                                        <td>Jumlah Hadir</td>
                                        <td>:</td>
                                        <td>{{$data->mahasiswa->count()}}</td>
                                        <td colspan="3"></td>
                                    </tr>
                                </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="col-12">
                                @if (session('status'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
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
                                            <th scope="col">{{ __('Nama') }}</th>
                                            <th scope="col">{{ __('NIM') }}</th>
                                            <th scope="col">{{ __('Kelas') }}</th>
                                            <th scope="col">{{ __('Jenis Kelamin') }}</th>
                                            <th scope="col">{{ __('Waktu Absent') }}</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data->mahasiswa as $no=>$d)
                                        <tr>
                                            <td>{{$no+1}}</td>
                                            <td>{{$d->nama}}</td>
                                            <td>{{$d->nim}}</td>
                                            <?php 
                                            $kelas[$no]=explode(':',$d->kelas); 
                                            $kelas[$no]=implode(" ",$kelas[$no]);
                                            ?>
                                            <td>{{$kelas[$no]}}</td>
                                            <td>
                                                @if($d->jenis_kelamin=='l')
                                                    Laki-laki
                                                @elseif($d->jenis_kelamin=='p')
                                                Perempuan
                                                @endif
                                            </td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($d->pivot->created_at, 'Asia/Jakarta')->formatLocalized('%d %B %Y, %H:%M') }}
                                            </td>
                                            <td  class="text-right">
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="javascript:history.go(-1)" class="btn btn-warning">Keluar</a>
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
                    "sLengthMenu": "    Tampilkan _MENU_ data Mahasiswa",
                    "sZeroRecords": "Belum ada data Mahasiswa ",
                    "sInfoEmpty": "Menampilkan 0 data",
                    "sInfoFiltered": "",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ data Mahasiswa ",
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
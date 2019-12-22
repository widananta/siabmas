@extends('layouts.app', ['title' => __('Mata Kuliah')])

@section('content')
    @include('layouts.headers.nocards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                    <input type="hidden" name="id" value="{{$data->id}}">
                    <div class="card shadow">
                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="col-8">
                                    <h3 class="mb-0">{{ __('Data matkul') }}</h3>
                                    <table border="0" class="table table-flush">
                                        <tr>
                                            <td>Nama Matkul</td>
                                            <td>:</td>
                                            <td>{{$data->matkul->nama_matkul}}</td>
                                            <td>SKS</td>
                                            <td>:</td>
                                            <td>{{$data->matkul->sks}}</td>
                                        </tr>
                                        <tr>
                                            <td>Tahun</td>
                                            <td>:</td>
                                            <td>{{$data->tahun}}</td>
                                            <td>Jumlah Mahasiswa</td>
                                            <td>:</td>
                                            <td>{{$data->mahasiswa->count()}}</td>
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
                                            <th scope="col">{{ __('Foto') }}</th>
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
                                            @if(is_file(public_path() . '/storage/mahasiswa/' . $d->foto))
                                                <img src="{{ asset('storage/mahasiswa/'.$d->foto)}}" alt=""  height="40px" width="40px" class="rounded-circle">
                                            @else
                                                @if($d->jenis_kelamin=='l')
                                                    <img src="{{ asset('foto') }}/default/male.png" class="rounded-circle" height="40px" width="40px">
                                                @else
                                                    <img src="{{ asset('foto') }}/default/female.png" class="rounded-circle" height="40px" width="40px">
                                                @endif
                                            @endif
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
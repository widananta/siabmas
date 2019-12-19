@extends('layouts.app', ['title' => __('Data Pengampu')])

@section('content')
    @include('layouts.headers.nocards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Data Pengampu') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#create_pengampu">Tambah Pengampu Mata Kuliah</a>
                                @include('modals.create.pengampu')
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
                                        <th scope="col">{{ __('Mata Kuliah') }}</th>
                                        <th scope="col">{{ __('Tahun') }}</th>
                                        <th scope="col">{{ __('Dosen Pengampu') }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $no=>$d)
                                    <tr>
                                        <td>{{$no+1}}</td>
                                        <td>{{$d->matkul->nama_matkul}}</td>
                                        <td>{{$d->tahun}}</td>
                                        <td>{{$d->user->name}}</td>
                                        <td  class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <a class="dropdown-item" href="javascript:void(0)"data-toggle="modal" data-target="#change_pengampu_{{$d->id}}">{{ __('Edit') }}</a>
                                                    <a class="dropdown-item" href="javascript:void(0)"data-toggle="modal" data-target="#delete_pengampu_{{$d->id}}">{{ __('Delete') }}</a>
                                                </div>
                                            </div>
                                            @include('modals.edit.pengampu')
                                            {{-- deletemodal --}}
                                            <div class="modal fade" id="delete_pengampu_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Hapus Data Pengampu?</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="/dashboard/pengampu/delete/{{$d->id}}" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</a>
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>                                       
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- enddeletemodal --}}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
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
                    "sLengthMenu": "    Tampilkan _MENU_ data Pengampu Mata Kuliah",
                    "sZeroRecords": "Belum ada data Pengampu Mata Kuliah ",
                    "sInfoEmpty": "Menampilkan 0 data",
                    "sInfoFiltered": "",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ data Pengampu Mata Kuliah ",
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
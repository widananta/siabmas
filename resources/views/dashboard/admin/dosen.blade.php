@extends('layouts.app', ['title' => __('Data Dosen')])

@section('content')
    @include('layouts.headers.nocards')
            <div class="container-fluid mt--7">
                <div class="row">
                    <div class="col">
                        <div class="card shadow">
                            <div class="card-header border-0">
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <h3 class="mb-0">{{ __('Data Dosen') }}</h3>
                                    </div>
                                    <div class="col-4 text-right">
                                        <a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#CreateUser">Tambah Dosen</a>
                                        @include('modals.create.dosen')
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
                                    <table class="table align-items-center table-flush" id="data_Table">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>{{ __('Nama') }}</th>
                                                <th>{{ __('NIP') }}</th>
                                                <th>{{ __('Email') }}</th>
                                                <th>{{ __('No Telp') }}</th>
                                                <th>{{ __('Foto') }}</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dosen as $data)
                                                <tr>
                                                    <td>{{ $data->name }}</td>
                                                    <td>{{ $data->nip }}</td>
                                                    <td>
                                                        <a href="mailto:{{ $data->email }}">{{ $data->email }}</a>
                                                    </td>
                                                    <td>{{ $data->no_telp }}</td>
                                                    <td>
                                                    @if(is_file(public_path() . '/storage/profil/' . $data->foto))
                                                        <img src="{{ asset('storage/profil/'.$data->foto)}}" alt=""  height="40px" width="40px" class="rounded-circle">
                                                    @else
                                                        @if($data->jenis_kelamin=='l')
                                                            <img src="{{ asset('foto') }}/default/male.png" class="rounded-circle" height="40px" width="40px">
                                                        @else
                                                            <img src="{{ asset('foto') }}/default/female.png" class="rounded-circle" height="40px" width="40px">
                                                        @endif
                                                    @endif
                                                    </td>
                                                    <td class="text-right">
                                                        <div class="dropdown">
                                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fas fa-ellipsis-v"></i>
                                                            </a>
                                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                                @if ($data->id != auth()->id())
                                                                    <form action="" method="post">
                                                                        @csrf
                                                                        @method('delete')
                                                                        
                                                                        <a class="dropdown-item" href="javascript:void(0)"data-toggle="modal" data-target="#change_dosen_{{$data->id}}">{{ __('Edit') }}</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)"data-toggle="modal" data-target="#delete_dosen_{{$data->id}}">{{ __('Delete') }}</a>
                                                                    </form>    
                                                                @else
                                                                    <a class="dropdown-item" href="javascript:void(0)"data-toggle="modal" data-target="#change_dosen">{{ __('Edit') }}</a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @include('modals.edit.dosen')
                                                        {{-- deletemodal --}}
                                                        <div class="modal fade" id="delete_dosen_{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel">Hapus Data Dosen?</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <a href="/dashboard/dosen/delete/{{$data->id}}" class="btn btn-danger"><i class="fa fa-trash"></i>Hapus</a>
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
                            <div class="card-footer py-4">
                                <nav class="d-flex justify-content-end" aria-label="...">
                                    {{-- {{ $users->links() }} --}}
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                    
                {{-- @include('layouts.footers.auth') --}}
            </div>
     
@endsection
@section('js')
    <script src="{{ asset('assets/js/plugin/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#data_Table").DataTable({
                "oLanguage": {
                    "sLengthMenu": "    Tampilkan _MENU_ data dosen",
                    "sZeroRecords": "Belum ada data dosen",
                    "sInfoEmpty": "Menampilkan 0 data",
                    "sInfoFiltered": "",
                    "sInfo": "Menampilkan _START_ - _END_ dari _TOTAL_ data dosen",
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
    <script>
        // WRITE THE VALIDATION SCRIPT.
        function isNumber(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if ((iKeyCode > 47 && iKeyCode < 58) || (iKeyCode==187))
                return true;

            return false;
        }    
        function isLetter(evt) {
            var iKeyCode = (evt.which) ? evt.which : evt.keyCode
            if ((iKeyCode > 64 && iKeyCode < 91) || (iKeyCode > 96 && iKeyCode < 123) || (iKeyCode==32))
                return true;

            return false;
        }    
    </script>
@endsection
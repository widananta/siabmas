<!-- Modal -->
<div class="modal fade" id="show_mahasiswa{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">{{$d->nama}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card card-profile shadow">
                        <div class="row justify-content-center">
                            <div class="col-lg-3 order-lg-2">
                                <div class="card-profile-image">
                                    <a href="#">
                                        @if(is_file(public_path() . '/storage/mahasiswa/' . $d->foto))
                                            <img src="{{ asset('storage/mahasiswa/'.$d->foto)}}" alt=""  height="175px" width="175px" class="rounded-circle">
                                        @else
                                            @if($d->jenis_kelamin=='l')
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
                            <div class="text-left">
                                <table border="0">
                                    <tr >
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{$d->nama}}</td>
                                    </tr>
                                    <tr>
                                        <td>NIP</td>
                                        <td>:</td>
                                        <td>{{$d->nim}}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                        <td>{{$d->kelas}}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kelamin</td>
                                        <td>:</td>
                                        <td>
                                            @if($d->jenis_kelamin=='l')
                                                Laki-laki
                                            @elseif($d->jenis_kelamin=='p')
                                            Perempuan
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>:</td>
                                        <td>{{$d->alamat}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                        <td>{{$d->no_telp}}</td>
                                    </tr>
                                </table>                                 
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" data-dismiss="modal">Tutup</button>                        
                </div>
            </form>
        </div>
    </div>
</div>
{{-- endmodal --}}
<!-- Modal -->
<div class="modal fade" id="change_photo" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/dashboard/profile/change_photo" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Ganti Foto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group @error('image') has-error @enderror pt-0">
                         @if(is_file(public_path() . '/storage/profil/' . Auth::user()->foto))
                            <img id="preview" src="{{ asset('storage/profil/'.Auth::user()->foto)}}" alt=""  height="150px" width="150px" class="rounded-circle">
                        @else
                            @if(Auth::user()->jenis_kelamin=='l')
                                <img id="preview" src="{{ asset('foto') }}/default/male.png" class="rounded-circle" height="150px" width="150px">
                            @else
                                <img id="preview" src="{{ asset('foto') }}/default/female.png" class="rounded-circle" height="150px" width="150px">
                            @endif
                        @endif
                        <input type="file" required class="btn waves-effect waves-light btn-success" id="image" name="image" onchange="readURL(this);">
                        @error('image')
                            <span class="form-text text-danger">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <!-- <button class="btn btn-success btn-block"><i class="fa fa-pencil"></i>Tambah Penulis</!-->
                    
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary"><i class="fa fa-pencil"></i>Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>       
                </div>
            </form>
        </div>
    </div>
</div>
{{-- endmodal --}}
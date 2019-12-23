<!-- Modal -->
<div class="modal fade" id="create_mahasiswa" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/dashboard/mahasiswa/store" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Tambah Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col md-5">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Nama') }}</label>
                                <input type="text" name="nama" id="input-name" class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}" placeholder="{{ __('nama') }}" value="{{ old('nama') }}" required autofocus onkeypress="javascript:return isLetter(event)">

                                @if ($errors->has('nama'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nama') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('nim') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-nim">{{ __('NIM') }}</label>
                                <input type="text" name="nim" id="input-nim" class="form-control form-control-alternative{{ $errors->has('nim') ? ' is-invalid' : '' }}" placeholder="{{ __('nim') }}" value="{{ old('nim') }}" required autofocus onkeypress="javascript:return isNumber(event)" maxlength="11" minlength="11">

                                @if ($errors->has('nim'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nim') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('prodi') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Prodi') }}</label>
                                <select name="prodi" required class="form-control" class="form-control form-control-alternative{{ $errors->has('prodi') ? ' is-invalid' : '' }}" value="l">
                                    <option value="">Pilih salah satu</option>
                                    <option value="Manajemen Informatika">Manajemen Informatika</option>
                                    <option value="Pendidikan Teknologi Informasi">Pendidikan Teknologi Informasi</option>
                                    <option value="Teknik Informatika">Teknik Informatika</option>
                                    <option value="Sistem Informasi">Sistem Informasi</option>
                                </select>
                                @if ($errors->has('prodi'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('prodi') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('angkatan') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-angkatan">{{ __('Angkatan') }}</label>
                                <input type="text" name="angkatan" id="input-angkatan" class="form-control form-control-alternative{{ $errors->has('angkatan') ? ' is-invalid' : '' }}" placeholder="{{ __('angkatan') }}" value="{{ old('angkatan') }}" required autofocus onkeypress="javascript:return isNumber(event)" maxlength="4" minlength="4">

                                @if ($errors->has('angkatan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('angkatan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col md-5">
                            <div class="form-group{{ $errors->has('jenis_kelamin') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Jenis Kelamin') }}</label>
                                <select name="jenis_kelamin" required class="form-control" class="form-control form-control-alternative{{ $errors->has('jenis_kelamin') ? ' is-invalid' : '' }}" value="l">
                                    <option value="">Pilih salah satu</option>
                                    <option value="l">Laki-laki</option>
                                    <option value="p">Perempuan</option>
                                </select>
                                @if ($errors->has('jenis_kelamin'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('jenis_kelamin') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('no_telp') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Nomor Telp') }}</label>
                                <input type="text" name="no_telp" id="input-name" class="form-control form-control-alternative{{ $errors->has('no_telp') ? ' is-invalid' : '' }}" placeholder="{{ __('Nomor Telp') }}" value="{{ old('no_telp') }}" required autofocus onkeypress="javascript:return isNumber(event)" maxlength="12" minlength="11">

                                @if ($errors->has('no_telp'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('no_telp') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('alamat') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Alamat') }}</label>
                                <textarea class="form-control rounded-0" rows="3" name="alamat" placeholder="Alamat">{{ old('alamat') }}</textarea>

                                @if ($errors->has('alamat'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('alamat') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group @error('image') has-error @enderror pt-0">
                            <img id="preview" src="{{ asset('foto') }}/default/male.png" class="rounded-circle" height="150px" width="150px">
                            <input type="file" class="btn waves-effect waves-light btn-success" id="image" name="image" onchange="readURL(this);">
                            @error('image')
                                <span class="form-text text-danger">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
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
{{-- endmodal --}}
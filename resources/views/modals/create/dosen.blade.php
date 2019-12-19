<!-- Modal -->
<div class="modal fade" id="CreateUser" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/dashboard/dosen/store" autocomplete="off" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="role" value="dosen">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Tambah Dosen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col md-5">
                            <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name') }}" required autofocus onkeypress="javascript:return isLetter(event)">

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('nip') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-nip">{{ __('NIP') }}</label>
                                <input type="text" name="nip" id="input-nip" class="form-control form-control-alternative{{ $errors->has('nip') ? ' is-invalid' : '' }}" placeholder="{{ __('NIP') }}" value="{{ old('nip') }}" required autofocus onkeypress="javascript:return isNumber(event)" maxlength="18" minlength="18">

                                @if ($errors->has('nip'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nip') }}</strong>
                                    </span>
                                @endif
                            </div>
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
                        </div>
                        <div class="col md-5">
                            
                            <div class="form-group">
                                <label class="form-control-label" for="input-name">{{ __('Tgl Lahir') }}</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control datepicker" id="datepicker" name="tgl_lahir" placeholder="Select date" type="text" value="{{ old('tgl_lahir') }}">
                                </div>
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
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <label class="form-control-label" for="input-password">{{ __('Password') }}</label>
                                <input type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="" required>
                                    
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
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
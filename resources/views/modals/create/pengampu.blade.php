<!-- Modal -->
<div class="modal fade" id="create_pengampu" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/dashboard/pengampu/store" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Tambah Pengampu Matkul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('tahun') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('Tahun') }}</label>
                        <input type="text" name="tahun" id="input-name" class="form-control form-control-alternative{{ $errors->has('tahun') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama') }}" value="{{date('Y')}}" required readonly autofocus>
                        @if ($errors->has('tahun'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('tahun') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('mata_kuliah') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('Mata Kuliah') }}</label>
                        <select name="mata_kuliah" required class="form-control" class="form-control form-control-alternative{{ $errors->has('mata_kuliah') ? ' is-invalid' : '' }}" value="l">
                            <option value="">Pilih salah satu</option>
                            @foreach ($matkul as $optmatkul)
                                <option value="{{$optmatkul->id}}">{{$optmatkul->nama_matkul}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('mata_kuliah'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mata_kuliah') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('dosen') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('Dosen Pengampu') }}</label>
                        <select name="dosen" required class="form-control" class="form-control form-control-alternative{{ $errors->has('dosen') ? ' is-invalid' : '' }}" value="l">
                            <option value="">Pilih salah satu</option>
                            @foreach ($dosen as $optdosen)
                                <option value="{{$optdosen->id}}">{{$optdosen->name}}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('dosen'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('dosen') }}</strong>
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
{{-- endmodal --}}
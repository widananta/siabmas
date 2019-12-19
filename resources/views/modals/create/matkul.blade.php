<!-- Modal -->
<div class="modal fade" id="create_matkul" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/dashboard/matkul/store" autocomplete="off">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Tambah Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('nama_matkul') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('Nama Matkul') }}</label>
                        <input type="text" name="nama_matkul" id="input-name" class="form-control form-control-alternative{{ $errors->has('nama_matkul') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama') }}" value="{{ old('name') }}" required autofocus>
                        @if ($errors->has('nama_matkul'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nama_matkul') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('sks') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('SKS') }}</label>
                        <select name="sks" required class="form-control" class="form-control form-control-alternative{{ $errors->has('sks') ? ' is-invalid' : '' }}" value="l">
                            <option value="">Pilih salah satu</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="6">6</option>
                        </select>
                        @if ($errors->has('sks'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('sks') }}</strong>
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
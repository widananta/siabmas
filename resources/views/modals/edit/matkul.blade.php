<!-- Modal -->
<div class="modal fade" id="change_matkul_{{$d->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/dashboard/matkul/update" autocomplete="off">
                @csrf
                <input type="hidden" name="id" value="{{$d->id}}">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Mata Kuliah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group{{ $errors->has('nama_matkul') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('Nama Matkul') }}</label>
                        <input type="text" name="nama_matkul" id="input-name" class="form-control form-control-alternative{{ $errors->has('nama_matkul') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama') }}" value="{{$d->nama_matkul}}" required autofocus>

                        @if ($errors->has('nama_matkul'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nama_matkul') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group{{ $errors->has('sks') ? ' has-danger' : '' }}">
                        <label class="form-control-label" for="input-name">{{ __('SKS') }}</label>
                        <select name="sks" required class="form-control" class="form-control form-control-alternative{{ $errors->has('sks') ? ' is-invalid' : '' }}" value="l">
                            <option value=""
                                @if ($d->sks=='')
                                selected
                                @endif
                            >Pilih salah satu</option>
                            <option value="2"
                                @if ($d->sks=='2')
                                selected
                                @endif
                            >2</option>
                            <option value="3"
                                @if ($d->sks=='3')
                                selected
                                @endif
                            >3</option>
                            <option value="4"
                                @if ($d->sks=='4')
                                selected
                                @endif
                            >4</option>
                            <option value="6"
                                @if ($d->sks=='6')
                                selected
                                @endif
                            >6</option>
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
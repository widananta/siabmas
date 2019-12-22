@extends('layouts.welcome', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        @if (session('status'))
                            <div class="alert alert-{{(session('peringatan'))}} alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <form role="form" method="POST" action="/store">
                            @csrf

                            <div class="form-group{{ $errors->has('nim') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-nim-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('nim') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan NIM') }}" type="text" name="nim" value="{{ old('nim') }}" autofocus onkeypress="javascript:return isNumber(event)" maxlength="11" minlength="11">
                                </div>
                                @if ($errors->has('nim'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('nim') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('kode') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-kode-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('kode') ? ' is-invalid' : '' }}" placeholder="{{ __('Masukkan Kode Absen') }}" type="text" name="kode" value="{{ old('kode') }}" autofocus onkeypress="javascript:return isNumber(event)" maxlength="6" minlength="6">
                                </div>
                                @if ($errors->has('kode'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('kode') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4">{{ __('Login') }}</button>
                            </div>
                        </form>
                        <a href="javascript:void(0)"data-toggle="modal" data-target="#about_us">
                            <span class="text-muted">{{ __('Tentang Kami') }}</span>
                        </a>
                        @include('modals.show.about_us')
                    </div>
                </div>
                <div class="row mt-3">
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
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
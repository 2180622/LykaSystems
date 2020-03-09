@extends('layout.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <span class="text-muted">Insira os seus dados de autenticação para aceder a aplicação, por favor.</span>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group row">

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">

                        <div class="col-md-6">
                            <input id="password" type="password"
                                   class="form-control @error('password') is-invalid @enderror" name="password" required
                                   autocomplete="current-password">

                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

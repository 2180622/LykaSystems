@extends('layout.app')

@section('content')
<div class="login-form">
    <div>
        <p>Insira os seus dados de autenticação para aceder a aplicação, por favor.</p>
        <div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div>
                    <div>
                        <input id="username" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" required autocomplete="off" autofocus placeholder="Endereço eletrónico">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div>
                    <div>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required
                        autocomplete="current-password" placeholder="Palavra-chave">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div>
                    <div>
                        <button type="submit" class="btn submit-button">
                            {{ __('Iniciar Sessão') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

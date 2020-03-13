@extends('layout.app')

@section('content')

<div class="login-form">
    <div>
        <p>Confirmação de conta - <b>{{$user->admin->nome}} {{$user->admin->apelido}}</b> </p>
        <div>
            <form class="form-group" action="{{route('confirmation.update', $user)}}" method="post">
                @csrf
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="password"/>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input id="password-conf" type="password" class="form-control" name="password_confirmation" placeholder="confirmar password" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@extends('layout.app')

@section('content')

<div class="login-form">
    <div>
        <p>Confirmação de conta - <b>{{$user->admin->nome}} {{$user->admin->apelido}}</b> </p>
        <br>
        <div>
            <form class="form-group" action="{{route('confirmation.update', $user)}}" method="post">
                @csrf
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="password" />
                </div>
                <strong>{{session('error')}}</strong>
                <div class="form-group">
                    <input id="password-conf" type="password" class="form-control" name="password-confirmation" placeholder="confirmar password" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

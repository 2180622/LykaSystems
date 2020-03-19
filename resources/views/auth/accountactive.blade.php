@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

<div class="login-form">
    <div>
        <h4 class="text-center">Bem-vindo {{$user->admin->nome.' '.$user->admin->apelido}}!</h4>
        <br>
        <p class="text-center">Para utilizar a sua conta lyka, basta clicar no botão abaixo e inserir o seu e-mail e password.</p>
        <br>
        <div class="form-group">
            <a href="{{route('login')}}">
                <button type="submit" class="btn submit-button">
                    Iniciar Sessão
                </button>
            </a>
        </div>
    </div>
</div>

@endsection

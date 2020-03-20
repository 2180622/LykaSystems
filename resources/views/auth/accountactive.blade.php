@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

<div class="login-form">
    <div>
      @if ($user->tipo == 'admin')
        <h4 class="text-center">Bem-vindo {{$user->admin->nome.' '.$user->admin->apelido}}!</h4>
      @elseif ($user->tipo == 'agente')
        <h4 class="text-center">Bem-vindo {{$user->agente->nome.' '.$user->agente->apelido}}!</h4>
      @else
        <h4 class="text-center">Bem-vindo {{$user->cliente->nome.' '.$user->cliente->apelido}}!</h4>
      @endif
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

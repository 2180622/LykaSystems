@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

<div class="login-form">
    <div>
        <h4>Bem-Vindo {{$user->admin->nome.' '.$user->admin->apelido}}!</h4>
        <p>Para utilizar a sua conta LYKA, basta clicar no botão abaixo e inserir o seu e-mail e password.</p>
        <button type="button" name="button">
          <a href="{{route('login')}}">Iniciar Sessão!</a>
        </button>
        <p>Bom trabalho.</p>
    </div>
</div>

@endsection

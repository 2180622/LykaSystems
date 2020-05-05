@extends('layout.app')

@section('title', 'Conta desativada')

@section('content')

<div class="restore-account-form">
    <div>
        @if ($user->tipo == 'admin')
        <h4 class="ml-5">Olá {{$user->admin->nome.' '.$user->admin->apelido}}!</h4>
        @elseif ($user->tipo == 'agente')
        <h4 class="ml-5">Olá {{$user->agente->nome.' '.$user->agente->apelido}}!</h4>
        @else
        <h4 class="ml-5">Olá {{$user->cliente->nome.' '.$user->cliente->apelido}}!</h4>
        @endif
        <br>
        <p>Lamentamos imenso informar, mas a sua conta foi desativada devido a um grande período de tempo após a receção do e-mail para a ativação da mesma</p>
        <p>Caso queira restaurar a sua conta, insira o seu e-mail no local abaixo disponível.</p>
        @if (isset($error))
        <strong class="text-center" style="color:#e3342f; display: inherit; margin-top: 20px; margin-bottom: -25px; font-size:14px; padding:0 50px;">
            {{$error}}
        </strong>
        @endif
        <form class="email-form mt-5" action="{{route('confirmation.restore', $user)}}" method="POST">
            @csrf
            @method('get')
            <div class="form-group">
                <input id="email" class="form-control" type="email" name="email" placeholder="Endereço eletrónico">
            </div>
            <div class="form-group">
                <button type="submit" class="btn submit-button">restaurar conta</button>
            </div>
        </form>
    </div>
</div>

@endsection

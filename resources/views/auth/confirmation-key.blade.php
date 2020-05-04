@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

<div class="login-form">
    <div>
        <p class="text-center">Ativação de conta</p>
        <p class="text-center">Introduza o código de autenticação fornecido para dar continuidade a ativação da sua conta.</p>
        @if (isset($error))
        <strong class="text-center" style="color:#e3342f; display: inherit; margin-top: 20px; margin-bottom: -15px;">
            {{$error}}
        </strong>
        @endif
        <div>
            <form class="email-form" action="{{route('confirmation.key', $user)}}" method="POST">
                @csrf
                @method('get')
                <div class="form-group">
                    <input id="email" type="text" class="form-control" name="key" placeholder="Código de autenticação" maxlength="5" autocomplete="off">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

<div class="login-form">
    <div>
        <p>Ativação de conta.</p>
        <p>Introduza uma palavra-chave segura que irá ser necessária para aceder à sua conta.</p>
        @if (isset($error))
        <strong class="text-center" style="color:#e3342f; display: inherit; margin-top: 20px; margin-bottom: -15px;">
            {{$error}}
        </strong>
        @endif
        <div>
            <form class="form-group" action="{{route('confirmation.password', $user)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Palavra-chave" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A palavra-chave deve conter letras maiúsculas, minúsculas, números e não deve ser menor que 8 caracteres.">
                </div>
                <div class="form-group">
                    <input id="password-conf" type="password" class="form-control" name="password-confirmation" placeholder="Confirmar palavra-chave" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="A palavra-chave deve conter letras maiúsculas, minúsculas, números e não deve ser menor que 8 caracteres.">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

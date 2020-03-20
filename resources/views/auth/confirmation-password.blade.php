@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

<div class="login-form">
    <div>
        <p class="text-center">Ativação de conta</p>
        <p class="text-center">Introduza uma palavra-chave segura que irá ser necessária para aceder à sua conta.</p>
        @if ($error == null)
        @else
        <strong class="text-center" style="color:#e3342f; display: inherit; margin-top: 20px; margin-bottom: -15px;">
            {{$error}}
        </strong>
        @endif
        <div>
            <form class="form-group" action="{{route('confirmation.update', $user)}}" method="post">
                @csrf
                <div class="form-group">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" />
                </div>
                <div class="form-group">
                    <input id="password-conf" type="password" class="form-control" name="password-confirmation" placeholder="Confirmar password" />
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

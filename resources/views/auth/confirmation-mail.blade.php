@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

<div class="login-form">
    <div>
        <p class="text-center">Ativação de conta</p>
        <p class="text-center">Introduza o seu e-mail para dar continuidade a ativação da sua conta.</p>
        @if ($error == null)
        @else
        <strong class="text-center" style="color:#e3342f; display: inherit; margin-top: 20px; margin-bottom: -15px;">
            {{$error}}
        </strong>
        @endif
        <div>
            <form class="email-form" action="{{route('confirmation.mail', $user)}}" method="get">
                @csrf
                <div class="form-group">
                    <input id="email" type="email" class="form-control" name="email" placeholder="Endereço eletrónico">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

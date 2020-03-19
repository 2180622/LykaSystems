@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

<div class="login-form">
    <div>
        <p class="text-center">Ativação de conta</p>
        <p class="text-center">Introduza o seu e-mail para dar continuidade a ativação da sua conta.</p>
        @if (session('error') == null)
        @else
        <strong style="color:#e3342f; display: inherit;">
            {{session('error')}}
        </strong>
        <br>
        @endif
        <div>
            <form class="email-form" action="{{route('confirmation.mail', $user)}}" method="post">
                <div class="form-group">
                    <input id="email" type="email" class="form-control" name="email" placeholder="endereço eletrónico">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
        </div>


        {{-- <div>
            <form class="form-group" action="{{route('confirmation.update', $user)}}" method="post">
        @csrf
        <div class="form-group">
            <input id="password" type="password" class="form-control" name="password" placeholder="password" />
        </div>
        <div class="form-group">
            <input id="password-conf" type="password" class="form-control" name="password-confirmation" placeholder="confirmar password" />
        </div>
        <div class="form-group">
            <button type="submit" class="btn submit-button">Confirmar</button>
        </div>
        </form>
    </div> --}}
</div>
</div>

@endsection

@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

@if(isset($success))
<div style="padding: 0 50px;" class="mt-5">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{$success}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
@endif

<div class="login-form" @if(isset($success)) style="top:5% !important;" @endif>
    <div>
        <p>Ativação de conta.</p>
        <p>Introduza o código de autenticação fornecido para dar continuidade a ativação da sua conta.</p>
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
                    <input id="code" type="text" class="form-control" name="key" maxlength="5" autocomplete="off" placeholder="Código de autenticação">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn submit-button">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    @endsection

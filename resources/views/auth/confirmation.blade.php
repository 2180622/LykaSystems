@extends('layout.app')

@section('title', 'Ativação de conta')

@section('content')

<div class="login-form">
    <div>
        <p>Ativação de conta - <b style="color:#252525;">{{$user->admin->nome.' '.$user->admin->apelido}}</b> </p>
        <br>
        @if (session('error') == null)
        @else
        <strong style="color:#e3342f; display: inherit;">
            {{session('error')}}
        </strong>
        <br>
        @endif
        <div>
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
        </div>
    </div>
</div>

@endsection

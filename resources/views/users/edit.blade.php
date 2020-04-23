@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar Utilizador')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/users.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')

<div class="container mt-2">
    {{-- Navegação --}}
    <div class="float-left buttons">
        <a href="javascript:history.go(-1)" title="Voltar">
            <ion-icon name="arrow-back-outline" class="button-back"></ion-icon>
        </a>
        <a href="javascript:window.history.forward();" title="Avançar">
            <ion-icon name="arrow-forward-outline" class="button-foward"></ion-icon>
        </a>
    </div>
    <div class="float-right">
        <a href="#" class="top-button">reportar problema</a>
    </div>

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Editar utilizador</h6>
        </div>
        <br>
        <p>Está neste momento a editar o utilizador <b>{{$user->admin->nome.' '.$user->admin->apelido}}</b>.</p>
        <form method="POST" action="{{route('users.update', $user)}}" class="form-group needs-validation pt-3" id="form-user" enctype="multipart/form-data" novalidate>
            @csrf
            @method("PUT")
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" name="nome" required value="{{old('nome', $user->admin->nome)}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="inputFullname">Apelido:</label>
                        <input type="text" class="form-control" name="apelido" required value="{{old('apelido', $user->admin->apelido)}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="inputEmail">E-mail:</label>
                        <input type="text" class="form-control" name="email" id="inputEmail" required value="{{old('email', $user->email)}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="inputFullname">Data de Nascimento:</label>
                        <input type="text" class="form-control" name="dataNasc" required value="{{old('dataNasc', $user->admin->dataNasc)}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for="inputFullname">Telefone Princial:</label>
                        <input type="text" class="form-control" name="telefone1" required value="{{old('telefone1', $user->admin->telefone1)}}">
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label for="inputFullname">Telefone Secundário (Opcional):</label>
                        <input type="text" class="form-control" name="telefone2" value="{{old('telefone2', $user->admin->telefone2)}}">
                    </div>
                </div>
            </div>

            <div class="form-group text-right">
                <br>
                <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Atualizar utilizador</button>
                <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

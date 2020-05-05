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
        <a href="{{asset('report')}}" class="top-button">reportar problema</a>
    </div>

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Edição do utilizador: {{$user->admin->nome.' '.$user->admin->apelido}}</h6>
        </div>
        <br>
        <div class="payment-card shadow-sm">
            <form method="POST" action="{{route('users.edit', $user)}}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label for="nome">Primeiro nome *</label>
                        <br>
                        <input type="text" name="nome" required placeholder="Inserir primeiro nome" value="{{old('nome', $user->admin->nome)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="inputFullname">Último nome *</label>
                        <br>
                        <input type="text" name="apelido" required placeholder="Inserir último nome" value="{{old('apelido', $user->admin->apelido)}}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputEmail">Endereço eletrónico *</label>
                        <br>
                        <input type="text" name="email" id="inputEmail" placeholder="Inserir endereço eletrónico" required value="{{old('email', $user->email)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="inputFullname">Data de Nascimento *</label>
                        <br>
                        <input type="date" name="dataNasc" required value="{{old('dataNasc', $user->admin->dataNasc)}}">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputFullname">Telefone Princial *</label>
                        <br>
                        <input type="text" name="telefone1" required placeholder="Inserir número de telefone principal" value="{{old('telefone1', $user->admin->telefone1)}}">
                    </div>
                    <div class="col-md-6">
                        <label for="inputFullname">Telefone Secundário</label>
                        <br>
                        <input type="text" name="telefone2" placeholder="Inserir número de telefone secundário" value="@if(old('telefone2', $user->admin->telefone2 == null)) N/A @else {{old('telefone2', $user->admin->telefone2)}} @endif">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <label for="inputFullname">Género</label>
                        <br>
                        <select type="text" name="genero" id="genero" required>
                            @if ($user->admin->genero == 'M')
                              <option value="M" selected>Masculino</option>
                              <option value="F">Feminino</option>
                            @else
                              <option value="M">Masculino</option>
                              <option value="F" selected>Feminino</option>
                            @endif
                        </select>
                    </div>
                </div>
        </div>

        <div class="form-group text-right">
            <br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar administrador</button>
            <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
        </div>
        </form>
    </div>
</div>
@endsection

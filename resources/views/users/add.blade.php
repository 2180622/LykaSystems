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
    <div class="float-left">
        <a href="javascript:history.go(-1)" title="Voltar"><i class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
        <a href="javascript:window.history.forward();" title="Avançar"><i class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
    </div>
    <div class="float-right">
        <a href="#" class="top-button">reportar problema</a>
    </div>

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Adicionar utilizador</h6>
        </div>
        <br>
        <p><b>Nota:</b> Ao adicionar um utilizador está a colocar esse mesmo utilizador como perfil de <b>administrador</b>.</p>
        <form method="POST" action="{{route('users.storeAdmin')}}" class="form-group needs-validation pt-3" id="form-user" enctype="multipart/form-data" novalidate>
            @csrf
            @include('users.partials.add-edit')
            <div class="form-group text-right">
                <br>
                <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar utilizador</button>
                <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection

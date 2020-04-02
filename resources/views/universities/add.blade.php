@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Adicionar Universidade')

{{-- Estilos de CSS --}}
@section('styleLinks')
<link href="{{asset('css/university.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
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
            <h6>Adicionar Universidade</h6>
        </div>
        <br>

        <form method="POST" action="{{route('universities.store')}}" class="form-group needs-validation pt-3"
        id="form_university" enctype="multipart/form-data" novalidate>
        @csrf
        @include('universities.partials.add-edit')
        <div class="form-group text-right">
            <br><br>
            <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar universidade</button>
            <a href="javascript:history.go(-1)" class="top-button">Cancelar</a>
        </div>
    </form>

    </div>
</div>


@endsection



{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/university.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}
<script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection

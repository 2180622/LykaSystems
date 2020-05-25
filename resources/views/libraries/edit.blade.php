@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Editar Informação do ficheiro')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/inputs.css')}}" rel="stylesheet">
<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">
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

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Editar informação do ficheiro</h6>
        </div>
        <br>
        <div class="card shadow-sm p-3" style="border-radius:10px;">
        <form id="form_library" method="POST" action="{{route('libraries.update',$library)}}" class="form-group needs-validation pt-3"
            enctype="multipart/form-data" novalidate>
            @csrf
            @method("PUT")
            @include('libraries.partials.add-edit')
            <br>


        </div>
        <div class="text-right mt-4">
            <button type="submit" class="top-button mr-2" name="submit"></i>Guardar ficheiro</button>
            <a href="{{route('libraries.index')}}" class="cancel-button">Cancelar</a>
        </div>
    </form>
    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')

<script src="{{asset('/js/library.js')}}"></script>

@endsection

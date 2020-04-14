@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar ficheiro')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/clients.css')}}" rel="stylesheet">
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
    <div class="float-right">
        <a href="#" class="top-button">reportar problema</a>
    </div>

    <br><br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Adicionar ficheiro</h6>
        </div>
        <br>
        <form method="POST" action="{{route('clients.store')}}" class="form-group needs-validation pt-3" id="form_client" enctype="multipart/form-data" novalidate>
            @csrf
            @include('libraries.partials.addfile')

        </form>
    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
{{-- <script src="{{asset('/js/clients.js')}}"></script> --}}

{{-- script permite definir se um input recebe só numeros OU so letras --}}
{{-- <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script> --}}

@endsection

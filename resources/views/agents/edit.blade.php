@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Editar informações')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('css/clients.css')}}" rel="stylesheet">
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
            <h6>Editar informações</h6>
        </div>
        <br>


        <form method="POST" action="{{route('agents.update',$agent)}}" class="form-group needs-validation pt-3"
            id="form_agent" enctype="multipart/form-data" novalidate>
            @csrf
            @method("PUT")
            @include('agents.partials.add-edit')
            <div class="form-group text-right" style="min-width:285px">
                <br><br>
                <button type="submit" class="top-button mr-2" name="submit"></i>Guardar ficha</button>
                <a href="javascript:history.go(-1)" class="cancel-button">Cancelar</a>
            </div>
        </form>


    </div>
</div>



@endsection





{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/agent.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}
<script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection

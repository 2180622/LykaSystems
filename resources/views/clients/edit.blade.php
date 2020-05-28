@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Editar informações')

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
        <div class="row">
            <div class="col">
                <div class="title">
                    <h6>Editar informações do estudante {{$client->nome}} {{$client->apelido}}</h6>
                </div>
            </div>
            <div class="col text-right">
                <div class="text-muted"><small>Adicionado em:
                        {{ date('d-M-y', strtotime($client->created_at)) }}</small></div>

                <div class="text-muted"><small>Ultima atualização:
                        {{ date('d-M-y', strtotime($client->updated_at)) }}</small></div>
            </div>
        </div>


        <form method="POST" action="{{route('clients.update',$client)}}" class="form-group needs-validation " id="form_client" enctype="multipart/form-data" novalidate>
            @csrf
            @method("PUT")
            @include('clients.partials.add-edit')
            <div class="row">

                @if (Auth::user()->tipo == "admin")
                    <div class="col">
                        <a href="{{route('clients.sendActivationEmail', $client)}}" class="top-button">Enviar e-mail para ativção de conta</a>
                    </div>
                @endif

                <div class="col">
                    <div class="form-group text-right" style="min-width:285px">
                        <button type="submit" class="top-button mr-2" name="submit"></i>Guardar informações</button>
                        <a href="{{route('clients.index')}}" class="cancel-button">Cancelar</a>
                    </div>
                </div>
            </div>

        </form>


    </div>
</div>



@endsection





{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/clients.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}
<script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>


<script src="{{asset('/js/editable_comboBox.js')}}"></script>

@endsection

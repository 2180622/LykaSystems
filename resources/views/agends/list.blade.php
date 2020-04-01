@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Agenda')


{{-- Estilos de CSS --}}
@section('styleLinks')

<link href="{{asset('css/datatables_general.css')}}" rel="stylesheet">
<link href="{{asset('css/agends.css')}}" rel="stylesheet" />
<link href="{{asset('vendor/fullcalendar/core/main.css')}}" rel='stylesheet' />
<link href="{{asset('vendor/fullcalendar/daygrid/main.css')}}" rel='stylesheet' />
<link href="{{asset('vendor/fullcalendar/list/main.css')}}" rel='stylesheet' />
<link href="{{asset('vendor/fullcalendar/timegrid/main.css')}}" rel='stylesheet' />
@endsection


{{-- Conteudo da Página --}}
@section('content')

<!-- MODAL DE INFORMAÇÔES -->

<div class="container mt-2 ">

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
        <a href="#" class="top-button">Novo Evento</a>
    </div>

    <br><br>

    <div class="cards-navigation">
        <div class="title">
            <h6>Agenda</h6>
        </div>
        <br>

        <div id='calendar'></div>


    </div>
</div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')
<script src="{{asset('/vendor/fullcalendar/core/main.js')}}"></script>
<script src="{{asset('/vendor/fullcalendar/rrule.js')}}"></script>
<script src="{{asset('/vendor/fullcalendar/interaction/main.js')}}"></script>
<script src="{{asset('/vendor/fullcalendar/daygrid/main.js')}}"></script>
<script src="{{asset('/vendor/fullcalendar/timegrid/main.js')}}"></script>
<script src="{{asset('/vendor/fullcalendar/list/main.js')}}"></script>
<script src="{{asset('/vendor/fullcalendar/rrule/main.js')}}"></script>
<script src="{{asset('/js/agends.js')}}"></script>

@endsection

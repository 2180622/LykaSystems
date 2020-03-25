@extends('layout.master')


{{-- Titulo da Página --}}
@section('title', 'Agenda')


{{-- Estilos de CSS --}}
@section('styleLinks')

    <link href="{{asset('css/datatables_general_style.css')}}" rel="stylesheet">

@endsection


{{-- Conteudo da Página --}}
@section('content')

    <!-- MODAL DE INFORMAÇÔES -->

    <div class="container mt-2 ">

        {{-- Navegação --}}
        <div class="float-left">
            <a href="javascript:history.go(-1)" title="Voltar"><i
                    class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
            <a href="javascript:window.history.forward();" title="Avançar"><i
                    class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
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



        </div>
    </div>
@endsection

{{-- Utilização de scripts: --}}
@section('scripts')

    {{-- <script src="{{asset('/js/)}}"></script>--}}

@endsection

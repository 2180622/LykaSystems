@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Página Inicial')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/dashboard.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')
<div class="container mt-2">
    <div class="float-right">
        <a href="{{route('report')}}" class="top-button">reportar problema</a>
    </div>
    <br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Navegação rápida</h6>
        </div>
        <br>
        <div class="row cards-group">
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button">
                        <span>
                            ?
                        </span>
                    </div>
                    <div class="info">
                        <p class="number">{{$clienteCount}}</p>
                        <p class="word">clientes</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button">
                        <span>
                            ?
                        </span>
                    </div>
                    <div class="info">
                        <p class="number">{{$universidadeCount}}</p>
                        <p class="word">universidades</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button">
                        <span>
                            ?
                        </span>
                    </div>
                    <div class="info">
                        <p class="number">{{$agenteCount}}</p>
                        <p class="word">agentes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="report">
        <div class="row">
            <div class="title col-md-10">
                <h6>Relatório e contas</h6>
            </div>
            <div class="col-md-2 text-right">
                <button type="button" name="button">ver todos</button>
            </div>
        </div>
        <div class="row graphic-group">
            <div class="col-md-8">
                <div class="graphic">

                </div>
            </div>
            <div class="col-md-4">
                <div class="graphic">

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection

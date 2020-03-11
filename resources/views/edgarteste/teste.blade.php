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
        <button type="button" name="button" id="report-problem">reportar problema</button>
    </div>
    <br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Navegação rápida</h6>
        </div>
        <br>
        <div class="row cards-group">
            @foreach()
            <div class="col-md-4">
                <div class="card-navigation">
                    <div class="help-button"></div>
                    <div class="info">
                        <p class="number">503</p>
                        <p class="word">Criar Dados</p>
                    </div>
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
@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar Universidade')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('/css/university.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')

    <div class="container mt-2">
        <div class="float-right">
            <a href="#" class="top-button">Reportar Problema</a>
        </div>
        <br>
        <div class="cards-navigation">
            <div class="title">
                <h6>Adicionar Universidade</h6>
            </div>
            <br>
            <form method="POST" action="{{route('universities.store')}}" class="form-group pt-3" id="form_universities"
                  enctype="multipart/form-data">
                @csrf
                @include('universities.partials.add-edit')
                <div class="form-group text-right">
                    <br><br>
                    <button type="button" class="top-button" name="ok" id="buttonSubmit"><i
                            class="fas fa-plus text-white-50 mr-2"></i>Adicionar Universidade
                    </button>
                    <a href="{{route('universities.index')}}" class="top-button">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
@endsection

{{-- Scripts --}}
@section('scripts')

    {{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}

@endsection

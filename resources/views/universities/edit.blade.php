@extends('layout.master')

{{-- Titulo da Página --}}
@section('title', 'Editar Universidade')

{{-- Estilos de CSS --}}
@section('styleLinks')
    <link href="{{asset('css/university.css')}}" rel="stylesheet">
@endsection

{{-- Conteudo da Página --}}
@section('content')

    <div class="container mt-2">
        {{-- Navegação --}}
        <div class="float-left">
            <a href="javascript:history.go(-1)" title="Voltar"><i
                    class="fas fa-arrow-left rounded-circle p-2 nav_btns mr-3"></i></a>
            <a href="javascript:window.history.forward();" title="Avançar"><i
                    class="fas fa-arrow-right rounded-circle p-2 nav_btns"></i></a>
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

            <form method="POST" action="{{route('universities.update',$university)}}" class="form-group needs-validation"
                  enctype="multipart/form-data" novalidate>
                @csrf
                @method("PUT")
                @include('universities.partials.add-edit')
                <div class="form-group text-right">
                    <br><br>
                    <button type="submit" class="top-button mr-2" name="submit" title="Guardar">Guardar</button>
                    <a href="javascript:history.go(-1)" class="top-button" title="Cancelar">Cancelar</a>
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

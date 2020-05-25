@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Editar informações')

{{-- CSS Style Link --}}
@section('styleLinks')
    <link href="{{asset('css/produtos.css')}}" rel="stylesheet">
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
                <h6>Editar informações</h6>
            </div>
            <br>
            <p>Está neste momento a editar a fase stock - <b>{{$fasestock->descricao}}</b>.</p>

            <form method="POST" action="{{route('fasestock.update',$fasestock)}}" class="form-group needs-validation pt-3" id="form_client"
                  enctype="multipart/form-data" novalidate>
                @csrf
                @method("PUT")
                @include('fasestock.partials.add-edit')
                <div class="form-group text-right">
                    <br><br>
                    <button type="submit" class="top-button mr-2" name="submit"></i>Guardar ficha</button>
                    <a href="javascript:history.go(-1)" class="top-button">Cancelar</a>
                </div>
            </form>


        </div>
    </div>



@endsection





{{-- Scripts --}}
@section('scripts')

    {{-- script contem: datatable configs, input configs, validações --}}
    <script src="{{asset('/js/produtos.js')}}"></script>

    {{-- script permite definir se um input recebe só numeros OU so letras --}}
    <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection

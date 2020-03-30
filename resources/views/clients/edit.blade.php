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


            <form method="POST" action="{{route('clients.update',$client)}}" class="form-group needs-validation pt-3" id="form_client"
                  enctype="multipart/form-data" novalidate>
                @csrf
                @method("PUT")
                @include('clients.partials.add-edit')
                <div class="form-group text-right">
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
    <script src="{{asset('/js/clients.js')}}"></script>

    {{-- script permite definir se um input recebe só numeros OU so letras --}}
    <script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection

@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar estudante')

{{-- CSS Style Link --}}
@section('styleLinks')

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

    <br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Adicionar estudante</h6>
        </div>
        <br>
        <form method="POST" action="{{route('clients.store')}}" class="form-group pt-3" id="form_client"
            enctype="multipart/form-data">
            @csrf
            @include('clients.partials.add-edit')
            <div class="form-group text-right">
                <br><br>
                <button type="submit" class="top-button mr-2" name="ok" id="buttonSubmit">Adicionar estudante</button>
                <a href="javascript:history.go(-1)" class="top-button">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection



{{-- Scripts --}}
@section('scripts')
<script src="{{asset('/js/clients.js')}}"></script>
<script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection

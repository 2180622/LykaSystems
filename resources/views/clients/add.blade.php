@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar estudante')

{{-- CSS Style Link --}}
@section('styleLinks')

@endsection

{{-- Page Content --}}
@section('content')

<div class="container mt-2">
    <div class="float-right">
        <a href="#" class="top-button">reportar problema</a>
    </div>
    <br>
    <div class="cards-navigation">
        <div class="title">
            <h6>Adicionar estudante</h6>
        </div>
        <br>
        <form method="POST" action="{{route('clients.store')}}" class="form-group pt-3" id="form_client" enctype="multipart/form-data">
            @csrf
            @include('clients.partials.add-edit')
            <div class="form-group text-right">
                <br><br>
                <button type="submit" class="top-button" name="ok" id="buttonSubmit">Adicionar estudante</button>
                <a href="{{route('clients.index')}}" class="top-button">Cancelar</a>
            </div>
        </form>
    </div>
</div>

@endsection

{{-- Scripts --}}
@section('scripts')
{{-- <script src="{{asset('/js/NOME_DO_FICHEIR.js')}}"></script> --}}
@endsection

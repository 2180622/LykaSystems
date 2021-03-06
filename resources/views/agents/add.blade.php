@extends('layout.master')

{{-- Page Title --}}
@section('title', 'Adicionar agente')

{{-- CSS Style Link --}}
@section('styleLinks')
<link href="{{asset('/css/inputs.css')}}" rel="stylesheet">
@endsection

{{-- Page Content --}}
@section('content')



<div class="container-fluid my-4">

    <div class="bg-white shadow-sm mb-4 p-4 ">

                <div class="row">

            <div class="col">
                <div class="title">
                    <h4><strong>Adicionar Agente</strong></h4>
                </div>
            </div>
        </div>

        <hr>

        <form method="POST" action="{{route('agents.store')}}" class="form-group needs-validation" id="form_agent"
            enctype="multipart/form-data" novalidate>
            @csrf
            @include('agents.partials.add-edit')

    </div>

    <div class="row mt-4">

        {{-- Informação de envio de e-mail --}}
        <div class="col">
            <div class="alert alert-primary " role="alert">
                <i class="fas fa-info-circle mr-2"></i><strong>Nota: </strong>O agente irá receber um e-mail para
                ativação da sua conta pessoal
            </div>
        </div>

        {{-- Butões Submit / Cancelar --}}
        <div class="col col-3 text-right pt-2">
            <button type="submit" class="btn btn-sm btn-success px-2 m-1 mr-2" name="ok" id="buttonSubmit"><i
                    class="fas fa-plus mr-2"></i>Adicionar Agente</button>
            <a href="{{route('agents.index')}}" class="btn btn-sm btn-secondary m-1 px-2">Cancelar</a>
        </div>

    </div>

    </form>
</div>



@endsection

{{-- Scripts --}}
@section('scripts')

{{-- script contem: datatable configs, input configs, validações --}}
<script src="{{asset('/js/agent.js')}}"></script>

{{-- script permite definir se um input recebe só numeros OU so letras --}}
<script src="{{asset('/js/jquery-key-restrictions.min.js')}}"></script>

@endsection
